<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends Member_Controller {
    private $kode_menu = 'user-zyacbt'; // Using same access as settings
    private $backup_dir = './public/backups/';

    function __construct(){
		parent:: __construct();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        
        parent::cek_akses($this->kode_menu);

        if (!is_dir($this->backup_dir)) {
            mkdir($this->backup_dir, 0777, true);
            write_file($this->backup_dir.'index.html', '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
        }
	}

    public function do_backup() {
        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'ghcbt_backup_'.date('Y-m-d_His').'.sql'
        );

        $backup = $this->dbutil->backup($prefs);
        $db_name = 'ghcbt_backup_'.date('Y-m-d_His').'.zip';
        $save = $this->backup_dir.$db_name;

        if (write_file($save, $backup)) {
            $status['status'] = 1;
            $status['pesan'] = 'Backup berhasil dibuat: '.$db_name;
        } else {
            $status['status'] = 0;
            $status['pesan'] = 'Gagal menyimpan file backup ke folder publik.';
        }

        echo json_encode($status);
    }

    public function get_backups() {
        $files = get_filenames($this->backup_dir);
        $data = [];
        foreach ($files as $file) {
            if ($file != 'index.html' && $file != '.htaccess') {
                $data[] = [
                    'name' => $file,
                    'size' => round(filesize($this->backup_dir.$file) / 1024, 2).' KB',
                    'date' => date("Y-m-d H:i:s", filemtime($this->backup_dir.$file)),
                    'url' => base_url().'public/backups/'.$file
                ];
            }
        }
        
        // Sort by date desc
        usort($data, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        echo json_encode($data);
    }

    public function delete_backup() {
        $filename = $this->input->post('filename', true);
        if (file_exists($this->backup_dir.$filename)) {
            unlink($this->backup_dir.$filename);
            $status['status'] = 1;
            $status['pesan'] = 'Backup berhasil dihapus.';
        } else {
            $status['status'] = 0;
            $status['pesan'] = 'File tidak ditemukan.';
        }
        echo json_encode($status);
    }
}
