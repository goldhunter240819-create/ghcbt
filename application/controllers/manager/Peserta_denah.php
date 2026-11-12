<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_denah extends Member_Controller {
	private $kode_menu = 'peserta-denah';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_denah';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_modul_model');
		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();
        
        $this->template->display_admin($this->kelompok.'/peserta_denah_view', 'Cetak Denah Tempat', $data);
    }

    public function cetak(){
        $grup_ids = $this->input->post('grup_id');
        $kolom = $this->input->post('kolom') ? $this->input->post('kolom') : 5;
        $baris = $this->input->post('baris') ? $this->input->post('baris') : 6;
        $modul_id = $this->input->post('modul_id');

        if(empty($grup_ids)){
            echo "Pilih grup terlebih dahulu";
            return;
        }

        if(!empty($modul_id)){
            $modul = $this->db->query("SELECT modul_nama FROM cbt_modul WHERE modul_id = ? LIMIT 1", [$modul_id])->row();
            $data['topik_ujian'] = $modul ? strtoupper($modul->modul_nama) : 'UJIAN / ASESMEN';
        } else {
            $data['topik_ujian'] = 'UJIAN / ASESMEN';
        }

        $grup_names = [];
        $peserta_per_grup = [];
        
        foreach($grup_ids as $g_id){
            $grup = $this->cbt_user_grup_model->get_by_kolom('grup_id', $g_id)->row();
            if($grup){
                $grup_names[] = $grup->grup_nama;
                
                $this->db->where('user_grup_id', $g_id);
                $this->db->order_by('user_firstname', 'ASC');
                $peserta = $this->db->get('cbt_user')->result();
                
                $peserta_per_grup[] = [
                    'id' => $g_id,
                    'nama' => $grup->grup_nama,
                    'peserta' => $peserta,
                    'index' => 0,
                    'total' => count($peserta)
                ];
            }
        }
        
        $data['grup_nama'] = (count($grup_names) > 1) ? "GABUNGAN (".implode(', ', $grup_names).")" : $grup_names[0];
        $data['kolom'] = $kolom;
        $data['baris'] = $baris;

        // Algoritma Interleave per Kolom
        $denah_matriks = [];
        $grup_count = count($peserta_per_grup);
        
        // Peta Lajur: Kolom ke-X milik Grup ke-Y
        $kolom_ke_grup = [];
        for($c=0; $c<$kolom; $c++){
            $kolom_ke_grup[$c] = $c % $grup_count;
        }

        for($r=0; $r<$baris; $r++){
            for($c=0; $c<$kolom; $c++){
                $g_index = $kolom_ke_grup[$c];
                $g_data = &$peserta_per_grup[$g_index]; // pass by reference to update index
                
                if($g_data['index'] < $g_data['total']){
                    $denah_matriks[$r][$c] = $g_data['peserta'][$g_data['index']];
                    $g_data['index']++;
                } else {
                    $denah_matriks[$r][$c] = null; // KOSONG
                }
            }
        }

        $data['denah_matriks'] = $denah_matriks;

        // Get school institution data from core_db
        $data['institusi'] = $this->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();

        $this->load->view($this->kelompok.'/peserta_denah_cetak_view', $data);
    }
}
