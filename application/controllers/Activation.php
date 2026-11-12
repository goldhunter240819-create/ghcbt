<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('licensing');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        // Jika sudah aktif, jangan biarkan masuk ke halaman aktivasi
        if ($this->licensing->is_activated()) {
            redirect('manager/dashboard');
        }

        $data['device_id'] = $this->licensing->get_device_id();
        $data['status'] = $this->session->flashdata('status');
        $data['error'] = $this->session->flashdata('error');

        $this->load->view('activation_view', $data);
    }

    public function process() {
        $key = trim($this->input->post('license_key', TRUE));
        $device_id = $this->licensing->get_device_id();
        $valid_key = $this->licensing->generate_license_key($device_id);

        if ($key === $valid_key) {
            if ($this->licensing->save_license($key)) {
                $this->session->set_flashdata('status', 'Aktivasi Berhasil! Selamat datang di Zenith Elite Edition.');
                redirect('manager/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan lisensi. Pastikan folder root memiliki izin tulis.');
            }
        } else {
            $this->session->set_flashdata('error', 'Kunci Lisensi tidak valid untuk perangkat ini.');
        }

        redirect('activation');
    }
}
