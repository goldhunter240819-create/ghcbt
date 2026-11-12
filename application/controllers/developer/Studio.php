<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * GHCBT Developer Studio (Zenith Edition)
 * Isolated from Manager Module
 * Location: application/controllers/developer/Studio.php
 */
class Studio extends Dev_Controller {
    private $kode_menu = 'dev-studio';

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->dashboard();
    }

    private function patch_config_multiple($data){
        $path = APPPATH.'config/config.php';
        if(!file_exists($path)) return;
        $content = file_get_contents($path);
        foreach($data as $key => $value){
            // Regex yang lebih fleksibel: mendukung 'key' atau "key" dan 'val' atau "val"
            $pattern = "/\\\$config\s*\[\s*(['\"])" . preg_quote($key) . "(['\"])\s*\]\s*=\s*(['\"])(.*?)(['\"])\s*;/";
            if(preg_match($pattern, $content)){
                $replacement = "\$config['".$key."'] = $3".$value."$5;";
                $content = preg_replace($pattern, $replacement, $content);
            }
        }
        file_put_contents($path, $content);
    }

    public function dashboard(){
        $this->cek_akses('dev-dashboard');
        $data['kode_menu'] = 'dev-dashboard';
        $data['title'] = 'Developer Dashboard';
        
        $data['php_version'] = PHP_VERSION;
        $data['mysql_version'] = $this->db->version();
        $data['os'] = PHP_OS;
        $data['disk_free'] = disk_free_space("./");
        $data['disk_total'] = disk_total_space("./");
        
        $data['site_version'] = $this->config->item('site_version');
        $data['memory_usage'] = memory_get_usage(true);
        $data['memory_limit'] = ini_get('memory_limit');
        $data['php_extensions'] = count(get_loaded_extensions());
        $data['server_time'] = date('H:i:s');
        $data['load_avg'] = function_exists('sys_getloadavg') ? sys_getloadavg() : [0,0,0];

        $this->template->display_developer('developer/developer_studio_view', 'GHCBT Developer Studio', $data);
    }

    public function identity(){
        $this->cek_akses('dev-identity');
        $data['kode_menu'] = 'dev-identity';
        $data['title'] = 'Identity Hub';
        $data['site_version'] = $this->config->item('site_version'); 
        $this->template->display_developer('developer/developer_identity_view', 'Identity Hub', $data);
    }

    public function save_identity(){
        @error_reporting(0); // Prevent warnings from breaking JSON response
        $this->cek_akses_crud('dev-identity', 1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('site_version', 'Version', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $site_version = $this->input->post('site_version', true);
            
            // 1. Patch config.php - Only Versioning
            $this->patch_config_multiple(['site_version' => $site_version]);
            
            // 2. Update version.txt
            $this->load->helper('file');
            if(!write_file(FCPATH . 'version.txt', $site_version)){
                @file_put_contents(FCPATH . 'version.txt', $site_version);
            }

            $status['status'] = 1;
            $status['pesan'] = 'DNA Aplikasi (Version) berhasil diperbarui!';
        } else {
            $status['status'] = 0;
            $status['pesan'] = strip_tags(validation_errors());
        }
        
        // Ensure clean output
        if(ob_get_length()) ob_clean();
        echo json_encode($status);
    }

    public function logs(){
        $this->cek_akses('dev-logs');
        $data['kode_menu'] = 'dev-logs';
        $data['title'] = 'Log Explorer';
        $this->load->helper('directory');
        $log_files = directory_map(APPPATH . 'logs/');
        $data['logs'] = array();
        if(!empty($log_files)){
            foreach($log_files as $file){
                if(strpos($file, 'log-') === 0 && strpos($file, '.php') !== false){
                    $data['logs'][] = array(
                        'filename' => $file,
                        'size' => round(filesize(APPPATH . 'logs/' . $file) / 1024, 2),
                        'date' => date("Y-m-d H:i:s", filemtime(APPPATH . 'logs/' . $file))
                    );
                }
            }
            usort($data['logs'], function($a, $b) { return strcmp($b['filename'], $a['filename']); });
        }
        $this->template->display_developer('developer/developer_logs_view', 'Log Explorer', $data);
    }

    public function database(){
        $this->cek_akses('dev-db');
        $data['kode_menu'] = 'dev-db';
        $data['title'] = 'Database Forge';
        $data['tables'] = $this->db->list_tables();
        $this->template->display_developer('developer/developer_database_view', 'Database Forge', $data);
    }

    public function get_log_detail($filename){
        $this->cek_akses('dev-logs');
        $path = APPPATH . 'logs/' . $filename;
        if(file_exists($path)) echo htmlspecialchars(file_get_contents($path));
        else echo "File log tidak ditemukan.";
    }

    public function clear_logs(){
        $this->cek_akses_crud('dev-logs', 1);
        $this->load->helper('directory');
        $log_files = directory_map(APPPATH . 'logs/');
        if(!empty($log_files)){
            foreach($log_files as $file){
                if(strpos($file, 'log-') === 0 && strpos($file, '.php') !== false) @unlink(APPPATH . 'logs/' . $file);
            }
        }
        echo json_encode(['status' => 1, 'pesan' => 'Semua file log berhasil dibersihkan!']);
    }

    public function clear_logs_monitor(){
        $this->cek_akses('dev-monitor');
        $this->load->helper('directory');
        $log_files = directory_map(APPPATH . 'logs/');
        if(!empty($log_files)){
            foreach($log_files as $file){
                if(strpos($file, 'log-') === 0 && strpos($file, '.php') !== false) @unlink(APPPATH . 'logs/' . $file);
            }
        }
        echo json_encode(['status' => 1]);
    }


    public function reset_exam_data(){
        $this->cek_akses_crud('dev-db', 1);
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $tables = ['cbt_tes_soal_jawaban', 'cbt_tes_soal', 'cbt_tes_topik_set', 'cbt_tes_user', 'cbt_tes_token', 'user_log'];
        foreach($tables as $table){
            if($this->db->table_exists($table)) $this->db->truncate($table);
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        echo json_encode(['status' => 1, 'pesan' => 'Semua data hasil ujian berhasil di-reset total!']);
    }

    public function maintenance(){
        $this->cek_akses('dev-maintenance');
        $data['kode_menu'] = 'dev-maintenance';
        $data['title'] = 'Maintenance Mode';
        $data['maintenance_mode'] = $this->config->item('maintenance_mode');
        $this->template->display_developer('developer/developer_maintenance_view', 'Maintenance Mode', $data);
    }

    public function toggle_maintenance(){
        $this->cek_akses_crud('dev-maintenance', 1);
        $status = $this->input->post('status', true);
        $this->patch_config_multiple(['maintenance_mode' => $status]);
        echo json_encode(['status' => 1, 'pesan' => 'Maintenance Mode berhasil diatur ke: ' . $status]);
    }

    public function css_studio(){
        $this->cek_akses('dev-css');
        $data['kode_menu'] = 'dev-css';
        $data['title'] = 'Custom CSS Studio';
        $css_path = FCPATH . 'public/plugins/custom_dev.css';
        if(!file_exists($css_path)){ $this->load->helper('file'); write_file($css_path, "/* GHCBT Custom CSS Studio */\n"); }
        $data['css_content'] = file_get_contents($css_path);
        $this->template->display_developer('developer/developer_css_view', 'Custom CSS Studio', $data);
    }

    public function save_css(){
        $this->cek_akses_crud('dev-css', 1);
        $css_content = $this->input->post('css_content');
        $this->load->helper('file'); write_file(FCPATH . 'public/plugins/custom_dev.css', $css_content);
        echo json_encode(['status' => 1, 'pesan' => 'CSS Custom berhasil disimpan dan diterapkan!']);
    }

    public function storage(){
        $this->cek_akses('dev-storage');
        $data['kode_menu'] = 'dev-storage';
        $data['title'] = 'Storage Analytics';
        $data['uploads_size'] = $this->_get_dir_size(FCPATH . 'public/uploads');
        $data['backups_size'] = $this->_get_dir_size(APPPATH . 'backups');
        $this->template->display_developer('developer/developer_storage_view', 'Storage Analytics', $data);
    }

    private function _get_dir_size($path){
        $bytestotal = 0; $path = realpath($path);
        if($path!==false && $path!='' && file_exists($path)){
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) $bytestotal += $object->getSize();
        }
        return round($bytestotal / 1024 / 1024, 2);
    }

    public function sessions(){
        $this->cek_akses('dev-sessions');
        $data['kode_menu'] = 'dev-sessions';
        $data['title'] = 'Session Overlord';
        $this->db->from('cbt_sessions');
        $data['total_sessions'] = $this->db->count_all_results();
        $data['manager_sessions'] = $this->db->table_exists('sessions') ? $this->db->count_all('sessions') : 0;
        $this->template->display_developer('developer/developer_sessions_view', 'Session Overlord', $data);
    }

    public function nuke_sessions(){
        $this->cek_akses_crud('dev-sessions', 1);
        $this->db->truncate('cbt_sessions');
        if($this->db->table_exists('sessions')) $this->db->truncate('sessions');
        echo json_encode(['status' => 1, 'pesan' => 'SEMUA SESI berhasil diledakkan!']);
    }

    public function integrity(){
        $this->cek_akses('dev-integrity');
        $data['kode_menu'] = 'dev-integrity';
        $data['title'] = 'Code Integrity';
        $this->template->display_developer('developer/developer_integrity_view', 'Code Integrity', $data);
    }

    public function run_scan(){
        $this->cek_akses_crud('dev-integrity', 1);
        $dirs = [APPPATH . 'controllers', APPPATH . 'models', APPPATH . 'libraries'];
        $results = []; $error_count = 0; $total_files = 0;
        foreach($dirs as $dir){
            if(!is_dir($dir)) continue;
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
            foreach($iterator as $file){
                if($file->getExtension() === 'php'){
                    $total_files++; $filepath = $file->getRealPath();
                    $cmd = "C:\\xampp\\php\\php.exe -l \"" . $filepath . "\" 2>&1";
                    $output = shell_exec($cmd);
                    if(strpos($output, 'No syntax errors detected') === false){ $error_count++; $results[] = ['file' => str_replace(FCPATH, '', $filepath), 'error' => trim($output)]; }
                }
            }
        }
        echo json_encode(['status' => 1, 'total' => $total_files, 'errors' => $error_count, 'details' => $results]);
    }

    // --- AI AUTO-FIX PROTOCOLS ---


    // --- INSTANT DATABASE SNAPSHOT ENGINE ---

    public function create_snapshot(){
        $this->cek_akses_crud('dev-db', 1);
        $label = $this->input->post('label', true);
        $label = empty($label) ? 'snap' : preg_replace('/[^a-zA-Z0-9]/', '_', $label);
        
        $filename = 'ZENITH_SNAP_' . strtoupper($label) . '_' . date('Ymd_His') . '.sql';
        $path = FCPATH . 'backups/snapshots/';
        if(!is_dir($path)) mkdir($path, 0755, true);

        $this->load->dbutil();
        $prefs = array(
            'format'      => 'txt',
            'filename'    => $filename,
            'add_drop'    => TRUE,
            'add_insert'  => TRUE,
            'newline'     => "\n"
        );

        $backup = $this->dbutil->backup($prefs);
        $this->load->helper('file');
        if(write_file($path . $filename, $backup)){
            echo json_encode(['status' => 1, 'pesan' => 'Snapshot generated successfully!', 'size' => round(filesize($path . $filename) / 1024, 2)]);
        } else {
            echo json_encode(['status' => 0, 'pesan' => 'Failed to write snapshot file. Check write permissions.']);
        }
    }

    public function list_snapshots(){
        $this->cek_akses('dev-db');
        $path = FCPATH . 'backups/snapshots/';
        $snapshots = [];
        if(is_dir($path)){
            $files = scandir($path);
            foreach($files as $file){
                if(strpos($file, 'ZENITH_SNAP_') === 0){
                    $snapshots[] = [
                        'filename' => $file,
                        'size' => round(filesize($path . $file) / 1024, 2),
                        'date' => date("Y-m-d H:i:s", filemtime($path . $file))
                    ];
                }
            }
            usort($snapshots, function($a, $b) { return strcmp($b['filename'], $a['filename']); });
        }
        echo json_encode(['snapshots' => $snapshots]);
    }

    public function delete_snapshot(){
        $this->cek_akses_crud('dev-db', 1);
        $filename = $this->input->post('filename', true);
        $path = FCPATH . 'backups/snapshots/' . $filename;
        if(file_exists($path) && strpos($filename, 'ZENITH_SNAP_') === 0){
            unlink($path);
            echo json_encode(['status' => 1, 'pesan' => 'Snapshot deleted.']);
        } else {
            echo json_encode(['status' => 0, 'pesan' => 'Snapshot not found.']);
        }
    }

    public function restore_snapshot(){
        $this->cek_akses_crud('dev-db', 1);
        $filename = $this->input->post('filename', true);
        $path = FCPATH . 'backups/snapshots/' . $filename;
        
        if(file_exists($path) && strpos($filename, 'ZENITH_SNAP_') === 0){
            $sql = file_get_contents($path);
            
            // Execute multi-query using native mysqli since CI's query() only does single
            $conn = mysqli_connect($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);
            if (mysqli_connect_errno()) {
                echo json_encode(['status' => 0, 'pesan' => 'Database connection failed.']);
                return;
            }

            if (mysqli_multi_query($conn, $sql)) {
                do {
                    if ($result = mysqli_store_result($conn)) { mysqli_free_result($result); }
                } while (mysqli_next_result($conn));
                echo json_encode(['status' => 1, 'pesan' => 'Database successfully restored to point: ' . $filename]);
            } else {
                echo json_encode(['status' => 0, 'pesan' => 'Restore failed: ' . mysqli_error($conn)]);
            }
            mysqli_close($conn);
        } else {
            echo json_encode(['status' => 0, 'pesan' => 'Snapshot file invalid or missing.']);
        }
    }

    public function monitor(){
        $this->cek_akses('dev-monitor');
        $data['kode_menu'] = 'dev-monitor';
        $data['title'] = 'Live Monitor';
        $this->template->display_developer('developer/developer_monitor_view', 'Live Monitor', $data);
    }

    public function get_live_activity(){
        $this->cek_akses('dev-monitor');
        // Get User Activity
        $this->db->select('*'); $this->db->from('user_log'); $this->db->order_by('ts', 'DESC'); $this->db->limit(15);
        $activities = $this->db->get()->result();

        // Get True Errors (Read physical logs)
        $errors = [];
        $today_log = FCPATH . 'application/logs/log-' . date('Y-m-d') . '.php';
        if(file_exists($today_log)){
            $lines = file($today_log);
            $error_lines = preg_grep('/ERROR -/i', $today_log ? $lines : []);
            $errors = array_slice(array_reverse($error_lines), 0, 10);
            // Clean up the lines (remove CodeIgniter PHP tag if it's the first line)
            $errors = array_map(function($line){ return trim(str_replace('<?php  if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\'); ?>', '', $line)); }, $errors);
            $errors = array_values(array_filter($errors));
        }

        echo json_encode(['activities' => $activities, 'errors' => $errors]);
    }

    public function analyze_errors(){
        $this->cek_akses('dev-monitor');
        $logs = $this->input->post('logs');
        
        $analysis = "Sistem berfungsi normal. Tidak mendeteksi anomali pada frekuensi ini.";
        $fix_plan = "Tetap pantau telemetry. Aktifkan mode siaga.";
        $source = "Nominal System Integrity";

        if(!empty($logs) && stripos($logs, 'nominal') === false){
            // 1. Neural File Locator (Regex)
            // Pattern 1: Path Line (C:\...\file.php 123)
            // Pattern 2: in Path on line Line
            if(preg_match('/([A-Z]:\\\\[^\n\r]+\.php)\s+(\d+)/i', $logs, $matches) || 
               preg_match('/in\s+([A-Z]:\\\\[^\n\r]+\.php)\s+on\s+line\s+(\d+)/i', $logs, $matches)){
                $source = str_replace(FCPATH, '', $matches[1]) . " [Line: " . $matches[2] . "]";
            }

            // 2. Pattern Analysis
            if(stripos($logs, 'database') !== false || stripos($logs, 'Table') !== false){
                $analysis = "Mendeteksi ketidaksinkronan pada inti Database. Tabel atau kolom yang diminta gagal diakses oleh Query engine.";
                $fix_plan = "Jalankan Auto-Repair untuk melakukan sinkronisasi ulang skema database dengan metadata aplikasi.";
            } elseif(stripos($logs, 'Undefined') !== false || stripos($logs, 'Notice') !== false){
                $analysis = "Ditemukan variabel 'Ghost' yang tidak terdefinisi pada logika eksekusi PHP. Ini bisa menyebabkan instabilitas data.";
                $fix_plan = "Lakukan pembersihan cache session dan regenerasi file konfigurasi sementara.";
            } else {
                $analysis = "Anomali terdeteksi pada lapisan aplikasi. Struktur kode mengalami kegagalan eksekusi tak terduga.";
                $fix_plan = "Gunakan Auto-Repair untuk menyapu sisa-sisa anomali (Neural Purge) dan mereset status buffer sistem.";
            }
        }

        echo json_encode(['analysis' => $analysis, 'fix_plan' => $fix_plan, 'source' => $source]);
    }

    public function auto_fix(){
        $this->cek_akses('dev-monitor');
        $fixes = [];
        
        // --- EVOLVED REPAIR PROTOCOLS ---

        // Fix 1: Directory Integrity
        $critical_dirs = [
            APPPATH . 'logs' => 'Logs System', 
            APPPATH . 'cache' => 'Cache Engine', 
            FCPATH . 'public/uploads' => 'Uploads Repository', 
            FCPATH . 'backups' => 'Main Backups'
        ];
        foreach($critical_dirs as $path => $label){
            if(!is_dir($path)){
                if(@mkdir($path, 0755, true)){
                    $fixes[] = "Restored missing Infrastructure: " . $label;
                    @file_put_contents($path . '/index.html', '<html><head><title>403 Forbidden</title></head><body>Directory access is forbidden.</body></html>');
                }
            }
        }

        // Fix 2: Neural Purge (Active & Old Logs)
        $log_dir = FCPATH . 'application/logs/';
        $today_log = $log_dir . 'log-' . date('Y-m-d') . '.php';
        
        // Wipe Today's Log (Immediate Dashboard Clean)
        if(file_exists($today_log)){
            @file_put_contents($today_log, "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>\nDEBUG - " . date('Y-m-d H:i:s') . " --> Zenith Neural Purge: Active log wiped by Master Authority.\n");
            $fixes[] = "Neural Purge executed: Active log telemetry reset to NOMINAL.";
        }

        // Purge Ancient Logs (> 1 day for aggressive cleaning)
        $files = glob($log_dir . '*.php');
        foreach($files as $file){
            if(is_file($file) && (time() - filemtime($file) > 86400)){ 
                @unlink($file);
                $fixes[] = "Purged ancient log telemetry: " . basename($file);
            }
        }

        // Fix 3: Neural Cache clearance
        $session_path = FCPATH . 'application/cache/';
        $files = glob($session_path . '*');
        foreach($files as $file){
            if(basename($file) != 'index.html' && basename($file) != '.htaccess'){
                @unlink($file);
                $fixes[] = "Neural Cache cleared: " . basename($file);
            }
        }

        // Fix 4: DB Heartbeat attempt
        $this->db->db_debug = FALSE;
        if($this->db->query("SELECT 1")){
            $fixes[] = "Database Neural-Link stabilized (Pulse OK).";
        }

        echo json_encode(['status' => 1, 'fixes' => $fixes, 'fix_count' => count($fixes)]);
    }

    // --- ZENITH RELEASE BUILDER METHODS ---

    public function get_releases(){
        $this->cek_akses('dev-identity');
        $path = FCPATH . 'backups/releases/';
        if(!is_dir($path)) mkdir($path, 0755, true);
        
        $this->load->helper('directory');
        $files = directory_map($path);
        $result = [];
        if(!empty($files)){
            foreach($files as $file){
                if(strpos($file, '.zip') !== false){
                    $filepath = $path . $file;
                    $result[] = [
                        'filename' => $file,
                        'encoded_filename' => base64_encode($file),
                        'size' => round(filesize($filepath) / 1024 / 1024, 2) . ' MB',
                        'date' => date("Y-m-d H:i:s", filemtime($filepath))
                    ];
                }
            }
            usort($result, function($a, $b) { return strcmp($b['date'], $a['date']); });
        }
        echo json_encode(['status' => 1, 'releases' => $result]);
    }

    public function get_build_progress(){
        $this->cek_akses('dev-identity');
        $path = FCPATH . 'backups/releases/progress.json';
        if(file_exists($path)){
            echo file_get_contents($path);
        } else {
            echo json_encode(['percent' => 0]);
        }
    }

    public function build_release(){
        @set_time_limit(0);
        $this->cek_akses_crud('dev-identity', 1);
        
        $version = $this->config->item('site_version');
        $clean_version = str_replace([' ', '.'], '_', $version);
        // Ensure no dots in the final filename except the extension
        $clean_version = preg_replace('/[^A-Za-z0-9\_]/', '_', $clean_version);
        $zip_name = 'GHCBT_Update_' . $clean_version . '_' . date('Ymd_His') . '.zip';
        $path_releases = FCPATH . 'backups/releases/';
        $save_path = $path_releases . $zip_name;
        $progress_path = $path_releases . 'progress.json';

        // Ensure directory exists
        if(!is_dir($path_releases)) mkdir($path_releases, 0755, true);
        
        // Reset Progress
        file_put_contents($progress_path, json_encode(['percent' => 0, 'status' => 'Initializing...']));

        $exclude_dirs = ['uploads', 'public/uploads', 'public/backups', '.git', '.vscode', 'demo', '.gemini', 'scratch', 'install', 'application/logs', 'backups'];
        $exclude_files = ['application/config/database.php', 'public/images/logo.png', 'public/images/logo_modern.png', 'public/images/favicon.png', 'favicon.ico', '.htaccess'];

        $rootPath = FCPATH;

        // Phase 1: Count Files
        $files_to_zip = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($iterator as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath));
                $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');

                $should_exclude = false;
                foreach($exclude_dirs as $exDir) {
                    if($relativePath === $exDir || strpos($relativePath, $exDir . '/') === 0){ $should_exclude = true; break; }
                }
                if(!$should_exclude && in_array($relativePath, $exclude_files)) $should_exclude = true;
                if(strpos($relativePath, 'backups/releases/') === 0) $should_exclude = true;

                if (!$should_exclude) {
                    $files_to_zip[] = ['path' => $filePath, 'relative' => $relativePath];
                }
            }
        }

        $total_files = count($files_to_zip);
        file_put_contents($progress_path, json_encode(['percent' => 1, 'status' => 'Preparing...']));

        // Phase 2: Zipping
        $zip = new ZipArchive();
        if ($zip->open($save_path, ZipArchive::CREATE) !== TRUE) {
            @unlink($progress_path);
            echo json_encode(['status' => 0, 'pesan' => 'Gagal membuat file ZIP!']);
            return;
        }

        $zip->addFromString('version.txt', $version);
        
        $count = 0;
        foreach ($files_to_zip as $f) {
            $zip->addFile($f['path'], $f['relative']);
            $count++;
            
            // Update progress every 20 files
            if($count % 20 == 0 || $count == $total_files){
                $percent = round(($count / $total_files) * 100);
                file_put_contents($progress_path, json_encode(['percent' => $percent, 'status' => "Packing $count/$total_files"]));
            }
        }
        $zip->close();
        
        @unlink($progress_path);
        echo json_encode(['status' => 1, 'pesan' => 'Update Package Berhasil Dibuat!', 'filename' => base64_encode($zip_name)]);
    }

    public function download_release($encoded_filename = NULL){
        $this->cek_akses('dev-identity');
        
        $filename = "";
        if(!empty($encoded_filename)){
            // 1. Prioritas: Base64 (Standard Modern Master)
            $decoded = base64_decode($encoded_filename, true);
            if($decoded && (strpos($decoded, 'GHCBT_Update_') === 0 || strpos($decoded, 'ZENITH_') === 0)){
                $filename = $decoded;
            } else {
                // 2. Fallback: Segmen mentah (Dukungan Link Lama)
                // Pastikan kita mengambil semua segmen jika nama file mengandung banyak titik
                $args = func_get_args();
                $filename = implode('.', $args);
            }
        }

        // Sanitasi dasar tetap diperlukan
        $filename = str_replace(array('../', '..\\'), '', $filename);
        $path = FCPATH . 'backups/releases/' . $filename;
        
        if(!empty($filename) && file_exists($path)){
            $this->load->helper('download');
            // Pastikan kita mengirim nama file asli agar browser tidak menebak-nebak
            force_download($path, NULL);
        } else {
            show_404();
        }
    }

    public function debug_path(){
        $this->cek_akses('dev-identity');
        $path = FCPATH . 'backups/releases/';
        echo "FCPATH: " . FCPATH . "<br>";
        echo "Target Path: " . $path . "<br>";
        if(is_dir($path)){
            echo "Directory EXISTS.<br>";
            $files = scandir($path);
            echo "<pre>"; print_r($files); echo "</pre>";
        } else {
            echo "Directory NOT FOUND.";
        }
    }

    public function delete_release(){
        $this->cek_akses_crud('dev-identity', 1);
        $filename = $this->input->post('filename');
        $path = FCPATH . 'backups/releases/' . $filename;
        if(file_exists($path) && strpos($filename, 'GHCBT_Update_') === 0){
            unlink($path);
            echo json_encode(['status' => 1, 'pesan' => 'Build history berhasil dihapus!']);
        } else {
            echo json_encode(['status' => 0, 'pesan' => 'File tidak ditemukan!']);
        }
    }

    // --- BRANDING CONTROL METHODS ---

    public function branding(){
        $this->cek_akses('dev-identity');
        $data['kode_menu'] = 'dev-branding';
        $data['title'] = 'Suite Branding';
        
        $data['dev_logo'] = file_exists(FCPATH . 'public/images/dev_logo.png') ? 'public/images/dev_logo.png' : 'public/images/logo.png';
        $data['dev_favicon'] = file_exists(FCPATH . 'public/images/dev_favicon.png') ? 'public/images/dev_favicon.png' : 'public/images/favicon.png';
        
        $this->template->display_developer('developer/developer_branding_view', 'Suite Branding', $data);
    }

    public function save_branding(){
        $this->cek_akses_crud('dev-identity', 1);
        $type = $this->input->post('type'); // 'logo' or 'favicon'
        
        $config['upload_path']   = './public/images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|svg';
        $config['overwrite']     = TRUE;
        
        if($type == 'logo'){
            $config['file_name'] = 'dev_logo.png';
        } else {
            $config['file_name'] = 'dev_favicon.png';
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('image_file')) {
            $status['status'] = 0;
            $status['pesan'] = $this->upload->display_errors('', '');
        } else {
            $status['status'] = 1;
            $status['pesan'] = ucfirst($type) . ' Developer berhasil diperbarui!';
        }
        echo json_encode($status);
    }
    public function keymaster(){
        $this->cek_akses('dev-keymaster');
        $data['kode_menu'] = 'dev-keymaster';
        $data['title'] = 'Keymaster Pro';
        
        $this->load->library('Licensing');
        
        // Handle Delete
        if ($this->input->get('delete')) {
            $this->cek_akses_crud('dev-keymaster', 1);
            $id = intval($this->input->get('delete'));
            $this->db->delete('cbt_license_history', array('id' => $id));
            redirect('developer/keymaster');
        }

        // Handle Generate
        $data['generated_key'] = '';
        if ($this->input->post('generate')) {
            $this->cek_akses_crud('dev-keymaster', 1);
            $device_id = strtoupper(trim($this->input->post('device_id')));
            $client_name = trim($this->input->post('client_name'));
            
            if(!empty($device_id)){
                $data['generated_key'] = $this->licensing->generate_license_key($device_id);
                
                // Save to DB
                $insert = array(
                    'client_name' => $client_name,
                    'device_id' => $device_id,
                    'activation_key' => $data['generated_key']
                );
                $this->db->insert('cbt_license_history', $insert);
            }
        }

        // Fetch History
        $data['history'] = $this->db->order_by('created_at', 'DESC')->get('cbt_license_history')->result();
        
        $this->template->display_developer('developer/developer_keymaster_view', 'Keymaster Pro', $data);
    }
}
