<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Template{
		protected $_ci;
		
		function __construct(){ 
			$this->_ci=&get_instance();
            $this->_ci->load->library('access');
            $this->_ci->load->model('users_model');
			$this->_ci->load->model('cbt_konfigurasi_model');
		}
		
		function display_admin($template, $title, $data=null){
            if(empty($data['kode_menu'])){
                $data['kode_menu'] = 'KOSONG'; 
            }
            //$data['site_name']=$this->_ci->config->item('site_name');
			$query = $this->_ci->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
			if($query->num_rows()>0){
				$data['site_name']=$query->row()->konfigurasi_isi;
			}else{
				$data['site_name']=$this->_ci->config->item('site_name');
			}
			
			// Config-Based Versioning (Double Lock Security)
			$data['site_version'] = $this->_ci->config->item('site_version');

            // Developer Identity Locking (Obfuscated) PHBwYW4gc3R5bGU9ImNvbG9yOiB2YXIoLS1hY2NlbnQtY29sb3IpOyBmb250LXdlaWdodDogNzAwOyI+R29sZCBIdW50ZXI8L3NwYW4+
            $data['dev_credits'] = base64_decode('PHNwYW4gc3R5bGU9ImNvbG9yOiB2YXIoLS1hY2NlbnQtY29sb3IpOyBmb250LXdlaWdodDogNzAwOyI+R29sZCBIdW50ZXI8L3NwYW4+');
            
            // App Identity (Synced with Dynamic Name)
            $data['app_identity'] = $data['site_name'];

			$data['nama']=$this->_ci->access->get_nama();
			$sidemenu = $this->_ci->users_model->get_menu($data['kode_menu'], $this->_ci->access->get_level());
            
            $data['sidemenu'] = $sidemenu;

            $data['content']=$this->_ci->load->view($template,$data,true);
			$data['title']=$title;
			$this->_ci->load->view('template/template_admin.php',$data);
		}

		function display_developer($template, $title, $data=null){
            if(empty($data['kode_menu'])){
                $data['kode_menu'] = 'KOSONG'; 
            }
			$query = $this->_ci->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
			if($query->num_rows()>0){
				$data['site_name']=$query->row()->konfigurasi_isi;
			}else{
				$data['site_name']=$this->_ci->config->item('site_name');
			}
			$data['site_version'] = $this->_ci->config->item('site_version');
            $data['dev_credits'] = base64_decode('PHNwYW4gc3R5bGU9ImNvbG9yOiB2YXIoLS1hY2NlbnQtY29sb3IpOyBmb250LXdlaWdodDogNzAwOyI+R29sZCBIdW50ZXI8L3NwYW4+');
            $data['app_identity'] = $data['site_name'];

			$data['nama']=$this->_ci->access->get_nama();
            $data['content']=$this->_ci->load->view($template,$data,true);
			$data['title']=$title;
			$this->_ci->load->view('template/template_developer.php',$data);
		}
		
		function display_user($template, $title, $data=null){
			//$data['site_name']=$this->_ci->config->item('site_name');
			$query = $this->_ci->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
			if($query->num_rows()>0){
				$data['site_name']=$query->row()->konfigurasi_isi;
			}else{
				$data['site_name']=$this->_ci->config->item('site_name');
			}
			
			// Config-Based Versioning (Double Lock Security)
			$data['site_version'] = $this->_ci->config->item('site_version');

            $data['dev_credits'] = base64_decode('PHNwYW4gc3R5bGU9ImNvbG9yOiB2YXIoLS1hY2NlbnQtY29sb3IpOyBmb250LXdlaWdodDogNzAwOyI+R29sZCBIdW50ZXI8L3NwYW4+');
            $data['app_identity'] = $data['site_name'];

			$data['content']=$this->_ci->load->view($template,$data,true);
			$data['title']=$title;
			$this->_ci->load->view('template/template_user.php',$data);
		}

		function display_tes($template, $title, $data=null){
			//$data['site_name']=$this->_ci->config->item('site_name');
			$query = $this->_ci->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
			if($query->num_rows()>0){
				$data['site_name']=$query->row()->konfigurasi_isi;
			}else{
				$data['site_name']=$this->_ci->config->item('site_name');
			}
			
			// Config-Based Versioning (Double Lock Security)
			$data['site_version'] = $this->_ci->config->item('site_version');

            $data['dev_credits'] = base64_decode('PHNwYW4gc3R5bGU9ImNvbG9yOiB2YXIoLS1hY2NlbnQtY29sb3IpOyBmb250LXdlaWdodDogNzAwOyI+R29sZCBIdW50ZXI8L3NwYW4+');
            $data['app_identity'] = $data['site_name'];

			$data['content']=$this->_ci->load->view($template,$data,true);
			$data['title']=$title;
			$this->_ci->load->view('template/template_tes.php',$data);
		}
		
		function display_clean($template, $data=null){
			$data['_content']=$this->_ci->load->view($template,$data,true);
			$this->_ci->load->view('template/template_clean.php',$data);
		}

	} 
?>