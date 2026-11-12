<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_mhcbt extends Member_Controller {
	private $kode_menu = 'user-zyacbt';
	private $kelompok = 'pengaturan';
	private $url = 'manager/pengaturan_mhcbt';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_konfigurasi_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $this->template->display_admin($this->kelompok.'/pengaturan_mhcbt_view', 'Pengaturan MHCBT', $data);
    }

    function simpan(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('mhcbt-nama', 'Nama MHCBT','required|strip_tags');
        $this->form_validation->set_rules('mhcbt-keterangan', 'Keterangan MHCBT','required|strip_tags');
		$this->form_validation->set_rules('mhcbt-link-login', 'Link Login Operator','required|strip_tags');
		$this->form_validation->set_rules('mhcbt-mobile-lock-xambro', 'Lock Mobile Exam Browser','required|strip_tags');
		$this->form_validation->set_rules('mhcbt-proteksi-multilogin', 'Proteksi MultiLogin Peserta','required|strip_tags');
        $this->form_validation->set_rules('mhcbt-tampilkan-histori', 'Tampilkan Histori Ujian Siswa', 'required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['konfigurasi_isi'] = $this->input->post('mhcbt-nama', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_nama', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('mhcbt-keterangan', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_keterangan', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('mhcbt-link-login', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'link_login_operator', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('mhcbt-mobile-lock-xambro', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_mobile_lock_xambro', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('mhcbt-proteksi-multilogin', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'proteksi_multilogin', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('mhcbt-tutup-tes-saat-logout', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_tutuptes_logout', $data);

			$data_history['konfigurasi_isi'] = $this->input->post('mhcbt-tampilkan-histori', true);
            if($this->cbt_konfigurasi_model->count_by_kolom('konfigurasi_kode', 'cbt_show_history')->row()->hasil > 0){
			    $this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_show_history', $data_history);
            }else{
                $data_insert['konfigurasi_kode'] = 'cbt_show_history';
                $data_insert['konfigurasi_isi'] = $this->input->post('mhcbt-tampilkan-histori', true);
                $this->cbt_konfigurasi_model->save($data_insert);
            }

            $data['konfigurasi_isi'] = $this->input->post('mhcbt-nama-madrasah', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_nama_madrasah', $data);

            $data['konfigurasi_isi'] = $this->input->post('mhcbt-tahun-ajaran', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_tahun_ajaran', $data);

            $data['konfigurasi_isi'] = $this->input->post('mhcbt-kepala-madrasah', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_kepala_madrasah', $data);

            $data['konfigurasi_isi'] = $this->input->post('mhcbt-tempat-cetak', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_tempat_cetak', $data);

            $this->load->library('upload');

            if (!empty($_FILES['upload-logo']['name'])) {
                $config_logo['upload_path'] = './public/images/';
                $config_logo['allowed_types'] = 'png|jpg|jpeg';
                $config_logo['overwrite'] = TRUE;
                $config_logo['file_name'] = 'logo.png';
                $this->upload->initialize($config_logo);
                $this->upload->do_upload('upload-logo');
            }

            if (!empty($_FILES['upload-logo-modern']['name'])) {
                $config_modern['upload_path'] = './public/images/';
                $config_modern['allowed_types'] = 'png|jpg|jpeg';
                $config_modern['overwrite'] = TRUE;
                $config_modern['file_name'] = 'logo_modern.png';
                $this->upload->initialize($config_modern);
                $this->upload->do_upload('upload-logo-modern');
            }

            if (!empty($_FILES['upload-favicon']['name'])) {
                $config_fav['upload_path'] = './public/images/';
                $config_fav['allowed_types'] = 'png|ico|jpg|jpeg';
                $config_fav['overwrite'] = TRUE;
                $config_fav['file_name'] = 'favicon.png';
                $this->upload->initialize($config_fav);
                $this->upload->do_upload('upload-favicon');
            }

            $status['status'] = 1;
			$status['pesan'] = 'Pengaturan berhasil disimpan ';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_pengaturan_mhcbt(){
    	$data['data'] = 1;
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'link_login_operator', 1);
		$data['link_login_operator'] = 'ya';
		if($query->num_rows()>0){
			$data['link_login_operator'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
		$data['cbt_nama'] = 'MHCBT';
		if($query->num_rows()>0){
			$data['cbt_nama'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
		$data['cbt_keterangan'] = 'Ujian Online Berbasis Komputer';
		if($query->num_rows()>0){
			$data['cbt_keterangan'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_informasi', 1);
		$data['cbt_informasi'] = 'Silahkan pilih Tes yang diikuti dari daftar tes yang tersedia dibawah ini. Apabila tes tidak muncul, silahkan menghubungi Operator yang bertugas.';
		if($query->num_rows()>0){
			$data['cbt_informasi'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_mobile_lock_xambro', 1);
		$data['mobile_lock_xambro'] = 'ya';
		if($query->num_rows()>0){
			$data['mobile_lock_xambro'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'proteksi_multilogin', 1);
		$data['proteksi_multilogin'] = 'ya';
		if($query->num_rows()>0){
			$data['proteksi_multilogin'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tutuptes_logout', 1);
		$data['cbt_tutuptes_logout'] = 'ya';
		if($query->num_rows()>0){
			$data['cbt_tutuptes_logout'] = $query->row()->konfigurasi_isi;
		}

        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_show_history', 1);
		$data['cbt_show_history'] = 'ya';
		if($query->num_rows()>0){
			$data['cbt_show_history'] = $query->row()->konfigurasi_isi;
		}

        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama_madrasah', 1);
		$data['cbt_nama_madrasah'] = '';
		if($query->num_rows()>0){
			$data['cbt_nama_madrasah'] = $query->row()->konfigurasi_isi;
		}

        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun_ajaran', 1);
		$data['cbt_tahun_ajaran'] = '';
		if($query->num_rows()>0){
			$data['cbt_tahun_ajaran'] = $query->row()->konfigurasi_isi;
		}

        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_kepala_madrasah', 1);
		$data['cbt_kepala_madrasah'] = '';
		if($query->num_rows()>0){
			$data['cbt_kepala_madrasah'] = $query->row()->konfigurasi_isi;
		}

        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tempat_cetak', 1);
		$data['cbt_tempat_cetak'] = '';
		if($query->num_rows()>0){
			$data['cbt_tempat_cetak'] = $query->row()->konfigurasi_isi;
		}
		
		echo json_encode($data);
    }
}