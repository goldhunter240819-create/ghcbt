<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_kartu extends Member_Controller {
	private $kode_menu = 'peserta-kartu';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_kartu';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_konfigurasi_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
		$data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
		
		$query_group = $this->cbt_user_grup_model->get_group();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="0">KOSONG</option>';
        }
        $data['select_group'] = $select;
		
        $this->template->display_admin($this->kelompok.'/peserta_kartu_view', 'Cetak Kartu Peserta', $data);
    }

	/**
	* Cetak kartu hanya untuk satu grup saja
	*/
    public function cetak_kartu($grup_id=null, $tipe_cetak='all'){
		$data['kode_menu'] = $this->kode_menu;
        $data['tipe_cetak'] = $tipe_cetak;
		
		$data['users'] = array();
        $data['cbt_nama'] = 'MHCBT';
        $data['cbt_keterangan'] = '';
        $data['group_name'] = 'NULL';
        $data['cbt_nama_madrasah'] = '';

		if(!empty($grup_id)){
			$query_user = $this->cbt_user_model->get_by_kolom('user_grup_id', $grup_id);
			if($query_user->num_rows()>0){
				$data['users'] = $query_user->result();
				
				$query_konfig = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
				if($query_konfig->num_rows()>0){
					$data['cbt_nama'] = $query_konfig->row()->konfigurasi_isi;
				}

                $query_konfig_ket = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
				if($query_konfig_ket->num_rows()>0){
					$data['cbt_keterangan'] = $query_konfig_ket->row()->konfigurasi_isi;
				}
				
				$query_group = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $grup_id, 1);
				if($query_group->num_rows()>0){
					$data['group_name'] = $query_group->row()->grup_nama;
				}

                $query_kepala = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_kepala_madrasah', 1);
				if($query_kepala->num_rows()>0){
					$data['cbt_kepala_madrasah'] = $query_kepala->row()->konfigurasi_isi;
				}

                $query_tempat = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tempat_cetak', 1);
				if($query_tempat->num_rows()>0){
					$data['cbt_tempat_cetak'] = $query_tempat->row()->konfigurasi_isi;
				}

                $query_madrasah = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama_madrasah', 1);
				if($query_madrasah->num_rows()>0){
					$data['cbt_nama_madrasah'] = $query_madrasah->row()->konfigurasi_isi;
				}
			}
		}
		
		$this->load->view($this->kelompok.'/peserta_cetak_kartu_view', $data);
	}

	/**
	* Cetak kartu untuk satu siswa saja
	*/
    public function cetak_kartu_peserta($user_id=null, $tipe_cetak='all'){
		$data['kode_menu'] = $this->kode_menu;
        $data['tipe_cetak'] = $tipe_cetak;
		
		$data['users'] = array();
        $data['cbt_nama'] = 'CBTKU';
        $data['cbt_keterangan'] = '';
        $data['group_name'] = '';
        $data['cbt_nama_madrasah'] = '';

		if(!empty($user_id)){
			$query_user = $this->cbt_user_model->get_by_kolom('user_id', $user_id);
			if($query_user->num_rows()>0){
				$data['users'] = $query_user->result();
				$user = $query_user->row();
				
				$query_konfig = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
				if($query_konfig->num_rows()>0){
					$data['cbt_nama'] = $query_konfig->row()->konfigurasi_isi;
				}

                $query_konfig_ket = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
				if($query_konfig_ket->num_rows()>0){
					$data['cbt_keterangan'] = $query_konfig_ket->row()->konfigurasi_isi;
				}
				
				$query_group = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $user->user_grup_id, 1);
				if($query_group->num_rows()>0){
					$data['group_name'] = $query_group->row()->grup_nama;
				}

                $query_kepala = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_kepala_madrasah', 1);
				if($query_kepala->num_rows()>0){
					$data['cbt_kepala_madrasah'] = $query_kepala->row()->konfigurasi_isi;
				}

                $query_tempat = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tempat_cetak', 1);
				if($query_tempat->num_rows()>0){
					$data['cbt_tempat_cetak'] = $query_tempat->row()->konfigurasi_isi;
				}

                $query_madrasah = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama_madrasah', 1);
				if($query_madrasah->num_rows()>0){
					$data['cbt_nama_madrasah'] = $query_madrasah->row()->konfigurasi_isi;
				}
			}
		}
		
		$this->load->view($this->kelompok.'/peserta_cetak_kartu_view', $data);
	}
}