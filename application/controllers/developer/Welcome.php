<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->library('dev_access'); // Use isolated developer access
    }

    public function index(){
        $this->load->library('user_agent');
        
        if ($this->agent->is_browser()){
            if($this->agent->browser()=='Internet Explorer' ){
                $this->template->display_user('blokbrowser_view', 'Browser yang didukung');
            }else{
                if(!$this->dev_access->is_login()){
                    $data['title'] = 'Zenith Access | Developer Portal';
                    $this->load->view('developer/login_view', $data);
                }else{
                    // Isolated check: If logged in as developer, go to studio
                    if($this->session->userdata('dev_level') == 'developer'){
                        redirect('developer');
                    } else {
                        // Fallback but should not happen if maul is pure
                        $this->dev_access->logout();
                        redirect('maul');
                    }
                }
            }
        }else{
            $this->template->display_user('blokbrowser_view', 'Browser yang didukung');
        }
    }
    
    public function login(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username','required|strip_tags');
        $this->form_validation->set_rules('password', 'Password','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $username = $this->input->post('username',TRUE);
            $password = $this->input->post('password',TRUE);
            
            $login = $this->dev_access->login($username, $password);
            
            if($login == 1){
                if($this->session->userdata('dev_level') == 'developer'){
                    $status['status'] = 1;
                    $status['target'] = site_url('developer');
                } else {
                    $this->dev_access->logout();
                    $status['status'] = 0;
                    $status['error'] = 'AKSES DITOLAK: Portal ini hanya untuk level Developer.';
                }
            } else if($login == 2){
                $status['status'] = 0;
                $status['error'] = 'Password Salah';
            } else {
                $status['status'] = 0;
                $status['error'] = 'Username tidak dikenal';
            }
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }
        echo json_encode($status);
    }
    
    public function self_heal(){
        $this->dev_access->logout();
        $status['status'] = 1;
        $status['pesan'] = 'Sistem berhasil disegarkan! Silakan coba login kembali.';
        echo json_encode($status);
    }

    public function logout(){
        $this->dev_access->logout();
        redirect('maul');
    }
}
