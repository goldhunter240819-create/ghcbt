<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tes_pelanggaran_ai extends Member_Controller {
	private $kode_menu = 'tes-pelanggaran';
	private $kelompok = 'tes';
	private $url = 'manager/tes_pelanggaran_ai';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_tes_model');
		$this->load->model('cbt_tes_user_model');
		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $this->template->display_admin($this->kelompok.'/tes_pelanggaran_ai_view', 'Konfigurasi Suara AI', $data);
    }
}
