<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_lainnya extends Member_Controller {
	private $kode_menu = 'peserta-lainnya';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_lainnya';
	
    function __construct(){
		parent:: __construct();
		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $this->load->model('cbt_user_grup_model');
        $this->load->model('cbt_modul_model');
        
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();
        
        $this->template->display_admin($this->kelompok.'/peserta_lainnya_view', 'Cetak Lain-lain', $data);
    }

    public function cetak(){
        $tipe = $this->input->post('tipe');
        if(empty($tipe)){
            echo "Pilih tipe cetak";
            return;
        }

        // Get school institution data from core_db
        $data['institusi'] = $this->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();

        $data['tipe'] = $tipe;
        
        if($tipe == 'ruang'){
            $data['nama_ruang'] = $this->input->post('nama_ruang');
            $data['keterangan'] = $this->input->post('keterangan');
            $this->load->view($this->kelompok.'/peserta_lainnya_cetak_ruang', $data);
        } else if($tipe == 'harap-tenang'){
            $this->load->view($this->kelompok.'/peserta_lainnya_cetak_tenang', $data);
        } else if($tipe == 'nomor-meja'){
            $data['jumlah'] = $this->input->post('jumlah_meja') ? $this->input->post('jumlah_meja') : 40;
            $data['nama_ruang'] = $this->input->post('nama_ruang');
            $this->load->view($this->kelompok.'/peserta_lainnya_cetak_meja', $data);
        }
    }
}
