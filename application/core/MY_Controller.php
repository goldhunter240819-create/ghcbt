<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
}

class Member_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->access->is_login()){
			// diredirect ke bagian login
			redirect('manager/welcome');
		}

        // Zenith Shield: Advanced Licensing Enforcement
        $this->load->library('licensing');
        if(!$this->licensing->is_activated()){
            // Allow access to activation controller to resolve license
            if($this->uri->segment(1) != 'activation'){
                redirect('activation');
            }
        }
	}
	
	function is_login(){
		return $this->access->is_login();
	}
	
	function cek_akses($kode_menu){
		if(!$this->access->cek_akses($kode_menu)){
            // Jika akses ditolak, cek apakah user adalah admin. Jika admin, izinkan akses ke modul-soal
            if($this->session->userdata('cbt_level')=='admin' && $kode_menu=='modul-soal'){
                return TRUE;
            }
			redirect('manager');
		}
	}
    
    function cek_akses_crud($kode_menu, $tipe){
		if(!$this->access->cek_akses_crud($kode_menu, $tipe)){
			redirect('manager');
		}
	}

    function get_preview($soal_id = null){
        $data['status'] = 0;
        if(!empty($soal_id)){
            $this->load->helper('soal');
            $data['status'] = 1;
            $data['html'] = render_soal_premium($soal_id);
        }
        echo json_encode($data);
    }
}

/**
 * Dev_Controller: Isolated base for Developer Suite
 */
class Dev_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('dev_access');
		
		if(!$this->dev_access->is_login()){
			redirect('maul');
		}
	}
	
	function is_login(){
		return $this->dev_access->is_login();
	}
	
	function cek_akses($kode_menu){
		if(!$this->dev_access->cek_akses($kode_menu)){
			redirect('maul');
		}
	}
    
    function cek_akses_crud($kode_menu, $tipe){
		if(!$this->dev_access->cek_akses_crud($kode_menu, $tipe)){
			redirect('maul');
		}
	}
}

class Tes_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('access_tes');
		
		if(!$this->access_tes->is_login()){
			// diredirect ke bagian login
			redirect('welcome');
		}

        // Zenith Shield: Advanced Licensing Enforcement
        $this->load->library('licensing');
        if(!$this->licensing->is_activated()){
            $this->load->view('errors/html/error_maintenance', ['message' => 'System License Expired or Invalid. Please contact administrator.']);
            $this->_ci_view_outputs();
            exit();
        }

        // Maintenance Mode Check (GHCBT Pro)
        $maintenance = $this->config->item('maintenance_mode');
        if($maintenance == 'TRUE'){
            $this->load->view('errors/html/error_maintenance');
            $this->_ci_view_outputs();
            exit();
        }
	}
	
	function is_login(){
		return $this->access_tes->is_login();
	}
}