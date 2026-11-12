<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Licensing {
    private $salt = 'ZENITH_GHCBT_SECURE_SALT_2024_04_19'; // Kunci rahasia pengacak
    private $license_file = 'license.key';

    public function __construct() {
        $this->license_path = FCPATH . $this->license_file;
    }

    /**
     * Mengambil ID Perangkat Unik (Hardware ID)
     */
    public function get_device_id() {
        static $cached_id = null;
        if ($cached_id !== null) return $cached_id;

        $cache_file = APPPATH . 'cache/hw_id.cache';
        if (file_exists($cache_file)) {
            $cached_id = trim(@file_get_contents($cache_file));
            if (!empty($cached_id)) return $cached_id;
        }

        $cpu_id = 'N/A';
        $mb_serial = 'N/A';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows - Use vol c: which is much faster than wmic
            $vol_info = shell_exec('cmd /c vol c:');
            if (preg_match('/Number is (.*)/i', $vol_info, $matches)) {
                $mb_serial = trim($matches[1]);
            }
            $cpu_id = getenv('COMPUTERNAME');
        } else {
            // Linux/Other - Fallback to machine-id or hostname
            if (file_exists('/etc/machine-id')) {
                $cpu_id = trim(file_get_contents('/etc/machine-id'));
            } else {
                $cpu_id = gethostname();
            }
            $mb_serial = PHP_OS;
        }

        // Gabungkan dan hash untuk mendapatkan Device ID yang cantik
        $raw_id = trim($cpu_id) . '|' . trim($mb_serial);
        $cached_id = strtoupper(substr(md5($raw_id), 0, 16)); // Format: AAAA-BBBB-CCCC-DDDD
        
        // Simpan ke cache untuk request berikutnya
        if (!is_dir(APPPATH . 'cache')) @mkdir(APPPATH . 'cache', 0755, true);
        @file_put_contents($cache_file, $cached_id);

        return $cached_id;
    }

    /**
     * Menghasilkan Lisensi Sah berdasarkan Device ID
     */
    public function generate_license_key($device_id) {
        return strtoupper(md5($device_id . $this->salt));
    }

    /**
     * Memeriksa apakah sistem telah aktif
     */
    public function is_activated() {
        if (!file_exists($this->license_path)) {
            return false;
        }

        $stored_key = trim(file_get_contents($this->license_path));
        $current_device_id = $this->get_device_id();
        $valid_key = $this->generate_license_key($current_device_id);

        return ($stored_key === $valid_key);
    }

    /**
     * Menyimpan License Key ke file
     */
    public function save_license($key) {
        return file_put_contents($this->license_path, $key);
    }
}
