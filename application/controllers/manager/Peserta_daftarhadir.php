<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_daftarhadir extends Member_Controller {
	private $kode_menu = 'peserta-daftarhadir';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_daftarhadir';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_konfigurasi_model');
        $this->load->model('cbt_soal_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
		$data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
		
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();

        // Get Guru from Local GHCBT User Table (Level Guru)
        $this->db->select('nama as nama_lengkap');
        $this->db->where('level', 'guru');
        $this->db->order_by('nama', 'ASC');
        $data['select_guru'] = $this->db->get('user')->result();
		
        $this->template->display_admin($this->kelompok.'/peserta_daftarhadir_view', 'Cetak Daftar Hadir', $data);
    }

    function get_topik_by_filter(){
        $modul = $this->input->post('modul', true);
        $grup = $this->input->post('grup', true);

        $this->db->select('topik_id, topik_nama');
        $this->db->from('cbt_topik');
        if($modul != 'all' && !empty($modul)){
            $this->db->where('topik_modul_id', $modul);
        }
        if($grup != 'all' && !empty($grup)){
            $this->db->where('topik_grup_id', $grup);
        }
        $this->db->order_by('topik_nama', 'ASC');
        $query = $this->db->get();

        $select = '<option value="">-- Pilih Mata Pelajaran --</option>';
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $row->topik_id)->row()->hasil;
                $select .= '<option value="'.$row->topik_id.'">'.$row->topik_nama.' ['.$jml_soal.']</option>';
            }
        }
        echo $select;
    }

    public function cetak($topik_id=0, $grup_id=0){
        $data['kode_menu'] = $this->kode_menu;
        
        $tanggal = $this->input->get('tanggal', true);
        $pengawas = $this->input->get('pengawas', true);

        if(empty($topik_id) || empty($grup_id)){
            echo "Parameter tidak lengkap.";
            return;
        }

        // Get Topik Info
        $query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $topik_id);
        if($query_topik->num_rows() == 0){
            echo "Mata Pelajaran tidak ditemukan.";
            return;
        }
        $data['topik'] = $query_topik->row();

        // Get Group Info
        $query_grup = $this->cbt_user_grup_model->get_by_kolom('grup_id', $grup_id);
        if($query_grup->num_rows() == 0){
            echo "Kelas tidak ditemukan.";
            return;
        }
        $data['grup'] = $query_grup->row();

        // Get Users in Group
        $data['users'] = $this->cbt_user_model->get_by_kolom('user_grup_id', $grup_id)->result();

        // Get Configuration from CBT (Fallback)
        $data['cbt_nama'] = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1)->row()->konfigurasi_isi;
        $data['cbt_nama_madrasah'] = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama_madrasah', 1)->row()->konfigurasi_isi;
        $data['cbt_kepala_madrasah'] = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_kepala_madrasah', 1)->row()->konfigurasi_isi;
        $data['cbt_tempat_cetak'] = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tempat_cetak', 1)->row()->konfigurasi_isi;

        // Local CBT Logo as primary
        $data['cbt_logo_master'] = base_url().'public/images/logo.png';

        // Override with CORE Master Data if configured
        try {
            $db_core = $this->load->database('core', TRUE);
            if($db_core && !empty($db_core->conn_id)){
                $query_institusi = $db_core->limit(1)->get('institusi');
                if($query_institusi && $query_institusi->num_rows() > 0){
                    $inst = $query_institusi->row();
                    $data['cbt_nama_madrasah'] = $inst->nama;
                    $data['cbt_alamat_madrasah'] = $inst->alamat.', '.$inst->kecamatan.', '.$inst->kota;
                    $data['cbt_kepala_madrasah'] = $inst->nama_kepala;
                    $data['cbt_tempat_cetak'] = $inst->kota;
                    $data['cbt_logo_master'] = base_url().'../uploads/logo/'.$inst->logo;
                }
            }
        } catch(Exception $e) {}

        $data['tanggal_pilih'] = (!empty($tanggal)) ? $tanggal : date('Y-m-d');
        $data['pengawas_pilih'] = (!empty($pengawas)) ? $pengawas : '............................................';

        $this->load->view($this->kelompok.'/peserta_cetak_daftarhadir_view', $data);
    }
}
