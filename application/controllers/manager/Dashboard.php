<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Member_Controller {
    function __construct(){
		parent:: __construct();
	}
    
    public function index(){
        // Logic pengalihan otomatis dihapus untuk mencegah loop dengan sistem isolasi baru

        $this->load->helper('form');
        $this->load->model('cbt_user_model');
        $this->load->model('cbt_soal_model');
        $this->load->model('cbt_tes_model');
        $this->load->model('cbt_tes_user_model');

        $data['nama'] = $this->access->get_nama();

        $data['total_peserta'] = $this->cbt_user_model->get_datatable_count('user_name', '', 'semua')->row()->hasil;
        $data['total_soal'] = $this->db->count_all('cbt_soal');
        $data['total_tes'] = $this->cbt_tes_model->get_datatable_count('tes_nama', '')->row()->hasil;
        $data['total_pelanggaran'] = $this->cbt_tes_user_model->get_datatable_pelanggaran_count('')->row()->hasil;

        $data['post_max_size'] = ini_get('post_max_size');
        $data['upload_max_filesize'] = ini_get('upload_max_filesize');
        $data['waktu_server'] = date('Y-m-d H:i:s');
		$data['waktu_database'] = $this->users_model->get_tanggal()->row()->tanggal;

        $this->template->display_admin('manager/dashboard_view', 'Dashboard', $data);
    }
	
	function password(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('password-old', 'Password Lama','required|strip_tags');
		$this->form_validation->set_rules('password-new', 'Password Baru','required|strip_tags');
        $this->form_validation->set_rules('password-confirm', 'Confirm Password','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
			$old = $this->input->post('password-old', TRUE);
			$new = $this->input->post('password-new', TRUE);
			$confirm = $this->input->post('password-confirm', TRUE);
			
			$username = $this->access->get_username();
			
			if($this->users_model->get_user_count($username, $old)>0){
				if($new==$confirm){
					$this->users_model->change_password($username, $new);
					$status['status'] = 1;
					$status['error'] = '';
				}else{
					$status['status'] = 0;
					$status['error'] = 'Kedua password baru tidak sama';
				}
			}else{
				$status['status'] = 0;
				$status['error'] = 'Password Lama tidak Sesuai';
			}
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    public function cek_notifikasi() {
        $this->load->database();
        header('Content-Type: application/json');
        
        // 1. Pelanggaran (status = 5)
        $q_pelanggaran = $this->db->query("SELECT tu.tesuser_id as id, u.user_firstname as nama FROM cbt_tes_user tu JOIN cbt_user u ON tu.tesuser_user_id = u.user_id WHERE tu.tesuser_status = 5")->result();
        
        // 2. Request Buka Kunci
        $q_unlock = $this->db->query("SELECT tu.tesuser_id as id, u.user_firstname as nama FROM cbt_tes_user tu JOIN cbt_user u ON tu.tesuser_user_id = u.user_id WHERE tu.tesuser_unlock_request = 1")->result();
        
        // 3. Request Reset Login
        $q_reset = $this->db->query("SELECT user_id as id, user_firstname as nama FROM cbt_user WHERE user_reset_request = 1")->result();
        
        echo json_encode([
            'pelanggaran' => $q_pelanggaran,
            'unlock' => $q_unlock,
            'reset' => $q_reset
        ]);
        exit;
    }

    public function get_monitoring_data() {
        $this->load->model('cbt_tes_user_model');
        $query = $this->cbt_tes_user_model->get_active_monitoring();
        $data = $query->result();
        
        echo json_encode($data);
        exit;
    }
}