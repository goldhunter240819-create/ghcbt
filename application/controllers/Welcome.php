<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * MHCBT
 * Achmad Lutfi
 * achmdlutfi@gmail.com
 * achmadlutfi.wordpress.com
 */
class Welcome extends CI_Controller
{
	private $kelompok = 'ujian';
	private $url = 'welcome';

	function __construct()
	{
		parent::__construct();
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_tes_user_model');
		$this->load->library('access_tes');
		$this->load->library('user_agent');
		$this->load->library('licensing');
		if(!$this->licensing->is_activated()){
			redirect('activation');
		}
	}

	public function index()
	{
		$data['url'] = $this->url;
		$data['timestamp'] = strtotime(date('Y-m-d H:i:s'));
		if ($this->agent->is_browser()) {
			if ($this->agent->browser() == 'Internet Explorer') {
				$this->template->display_user('blokbrowser_view', 'Browser yang didukung');
			} else {
				$akses_cbt = 1;
				if ($this->agent->is_mobile()) {
					$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_mobile_lock_xambro', 1);
					if ($query->row()->konfigurasi_isi == "ya") {
						$agent = $this->agent->agent_string();
						if (strpos($agent, 'MHCBT') == false) {
							$akses_cbt = 0;
						}
					}
				}
				if ($akses_cbt == 1) {
					if (!$this->access_tes->is_login()) {
						$data['link_login_operator'] = "tidak";
						$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'link_login_operator', 1);
						if ($query_konfigurasi->num_rows() > 0) {
							$data['link_login_operator'] = $query_konfigurasi->row()->konfigurasi_isi;
						}

						$data['cbt_keterangan'] = "Ujian Online Berbasis Komputer";
						$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
						if ($query_konfigurasi->num_rows() > 0) {
							$data['cbt_keterangan'] = $query_konfigurasi->row()->konfigurasi_isi;
						}

						// Ambil Logo Dynamic
						$data['logo_modern'] = base_url() . 'public/images/logo_modern.png?v=' . time();
						$data['logo_standard'] = base_url() . 'public/images/logo.png?v=' . time();

						$this->template->display_user($this->kelompok . '/welcome_view', 'Selamat Datang', $data);
					} else {
						redirect('tes_dashboard');
					}
				} else {
					$this->template->display_user('lockmobile_view', 'Exam Browser');
				}
			}
		} else {
			$this->template->display_user('blokbrowser_view', 'Browser yang didukung');
		}
	}

	function login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required|strip_tags');
		$this->form_validation->set_rules('password', 'Password', 'required|strip_tags');
		if ($this->form_validation->run() == TRUE) {
			$this->form_validation->set_rules('token', 'token', 'callback_check_login');
			if ($this->form_validation->run() == FALSE) {
				//Jika login gagal
				$status['status'] = 0;
				$status['error'] = validation_errors();
			} else {
				//Jika sukses
				$username = $this->input->post('username', TRUE);

				//Cek proteksi_multilogin aktif
				$hasil = 1;
				$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'proteksi_multilogin', 1);
				if ($query_konfigurasi->num_rows() > 0) {
					if ($query_konfigurasi->row()->konfigurasi_isi == 'ya') {
						//Jika aktif, cek apakah user sudah login
						if ($this->cbt_user_model->count_by_login($username)->row()->hasil > 0) {
							// User terdeteksi login, info kalau user sudah login diperangkat lain
							$hasil = 0;
						} else {
							// User belum terdeteksi login, update user_login dan user_login_date
							$data['user_login'] = 1;
							$data['user_login_date'] = date('Y-m-d');
							;

							if (!empty($username)) {
								$this->cbt_user_model->update('user_name', $username, $data);
							}
						}
					}
				}
				if ($hasil == 1) {
					$result = $this->cbt_user_model->get_by_username($username);

					// Menyimpan session
					$tanda = '@MHCBT@';
					$this->session->set_userdata('cbt_tes_tanda', $tanda . $result->user_name . $tanda);
					$this->session->set_userdata('cbt_tes_user_id', $result->user_name);
					$this->session->set_userdata('cbt_tes_nama', stripslashes($result->user_firstname));
					$this->session->set_userdata('cbt_tes_group', $result->grup_nama);
					$this->session->set_userdata('cbt_tes_group_id', $result->grup_id);
					$this->session->set_userdata('cbt_tes_foto', $result->user_foto);

					$status['status'] = 1;
				} else {
					$status['status'] = 0;
					$status['error'] = 'User terdeteksi masih Login. Silahkan hubungi Petugas.';
					$status['active_login'] = 1; // Flag UI Frontend
				}
			}
		} else {
			$status['status'] = 0;
			$status['error'] = validation_errors();
		}
		echo json_encode($status);
	}

	function logout()
	{
		//Update user_login menjadi 0
		$data['user_login'] = 0;
		$username = $this->access_tes->get_username();
		if (!empty($username)) {
			$this->cbt_user_model->update('user_name', $username, $data);
		}

		// Cek apakah konfigurasi menutup Tes saat Logout aktif
		$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tutuptes_logout', 1);
		if ($query_konfigurasi->num_rows() > 0) {
			$query_konfigurasi = $query_konfigurasi->row();
			if ($query_konfigurasi->konfigurasi_isi == 'ya') {
				// Menutup semua Tes saat Logout
				$query_user = $this->cbt_user_model->get_by_kolom_limit('user_name', $username, 1);
				if ($query_user->num_rows() > 0) {
					$user_id = $query_user->row()->user_id;
					$query_tes = $this->cbt_tes_user_model->get_by_user_status($user_id);
					if ($query_tes->num_rows() > 0) {
						$query_tes = $query_tes->result();
						foreach ($query_tes as $tes) {
							$data_tes['tesuser_status'] = 4;
							$this->cbt_tes_user_model->update('tesuser_id', $tes->tesuser_id, $data_tes);
						}
					}
				}
			}
		}

		$this->access_tes->logout();
		redirect(base_url());
	}

	function check_login()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$login = $this->access_tes->login($username, $password, $this->input->ip_address());
		if ($login == 1) {
			return TRUE;
		} else if ($login == 2) {
			$this->form_validation->set_message('check_login', 'Password yang dimasukkan salah');
			return FALSE;
		} else {
			$this->form_validation->set_message('check_login', 'Username yang dimasukkan tidak dikenal');
			return FALSE;
		}
	}

	function request_reset_login()
	{
		$username = $this->input->post('username', TRUE);
		$status['status'] = 0;
		$status['pesan'] = 'Gagal melakukan request konfirmasi';

		if (!empty($username)) {
			$data['user_reset_request'] = 1;
			// Update flag minta request
			$this->cbt_user_model->update('user_name', $username, $data);
			$status['status'] = 1;
			$status['pesan'] = 'Request Reset berhasil dikirim. Silakan tunggu konfirmasi Petugas sebelum mencoba login kembali.';
		}

	}

	function ajax_check_reset_status()
	{
		$username = $this->input->post('username', TRUE);
		$status['status'] = 0; // 0 = Still locked, 1 = Reset and ready

		if (!empty($username)) {
			$query = $this->cbt_user_model->get_by_kolom_limit('user_name', $username, 1);
			if ($query->num_rows() > 0) {
				$user = $query->row();
				// Jika request sudah 0 DAN user_login sudah 0, berarti sudah direset Admin
				if ($user->user_reset_request == 0 && $user->user_login == 0) {
					$status['status'] = 1;
				}
			}
		}

		echo json_encode($status);
	}

	function sso() {
		$token = $this->input->get('token', TRUE);
		$redirect = $this->input->get('redirect', TRUE);
		if (!$redirect) { $redirect = 'tes_dashboard'; }

		if (!empty($token)) {
			// Get core database for SSO token verification
			$db_core = $this->load->database('core', TRUE);
			$query = $db_core->query("SELECT * FROM sso_tokens WHERE token = ? AND expires_at > NOW()", array($token));
			if ($query->num_rows() > 0) {
				$username = $query->row()->username;
				// Delete token after use (one-time token)
				$db_core->query("DELETE FROM sso_tokens WHERE token = ?", array($token));

				// Auto login as user in test
				$result = $this->cbt_user_model->get_by_username($username);
				if ($result) {
					$tanda = '@MHCBT@';
					$this->session->set_userdata('cbt_tes_tanda', $tanda . $result->user_name . $tanda);
					$this->session->set_userdata('cbt_tes_user_id', $result->user_name);
					$this->session->set_userdata('cbt_tes_nama', stripslashes($result->user_firstname));
					$this->session->set_userdata('cbt_tes_group', $result->grup_nama);
					$this->session->set_userdata('cbt_tes_group_id', $result->grup_id);
					$this->session->set_userdata('cbt_tes_foto', $result->user_foto);

					redirect($redirect);
				}
			}
		}
		redirect('welcome');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */