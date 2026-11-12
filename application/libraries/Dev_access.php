<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dev_access {
    
    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->helper('cookie');
        $this->CI->load->model('users_model');
        $this->users_model =& $this->CI->users_model;
    }
    
    /**
     * Developer Login
     * Namespace: dev_
     */
    function login($username, $password){
        $result = $this->users_model->get_login_info($username);
        if($result){
            $password = sha1($password);
            if($password === $result->password){
                $this->CI->session->set_userdata('dev_user_id', $result->username);
                $this->CI->session->set_userdata('dev_nama', $result->nama);
                $this->CI->session->set_userdata('dev_level', $result->level);
                return 1;
            }else{
                return 2;
            }
        }
        return 0;
    }
    
    /**
     * Check if developer session active
     */
    function is_login(){
        return (($this->CI->session->userdata('dev_user_id')) ? TRUE : FALSE);
    }
    
    function cek_akses($kode_menu){
        $level = $this->CI->session->userdata('dev_level');
        if($level === 'developer') return TRUE;
        if($this->users_model->cek_akses($kode_menu, $level) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function cek_akses_crud($kode_menu, $tipe){
        $level = $this->CI->session->userdata('dev_level');
        if($level === 'developer') return TRUE;
        if($this->users_model->cek_akses_crud($kode_menu, $level, $tipe) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function get_username(){ return $this->CI->session->userdata('dev_user_id'); }
    function get_nama(){ return $this->CI->session->userdata('dev_nama'); }
    function get_level(){ return $this->CI->session->userdata('dev_level'); }
    
    /**
     * Developer Logout
     */
    function logout(){
        $this->CI->session->unset_userdata('dev_user_id');
        $this->CI->session->unset_userdata('dev_nama');
        $this->CI->session->unset_userdata('dev_level');
    }
}
