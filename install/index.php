<?php
// GHCBT Premium Installation Wizard
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';
$success = '';

if (file_exists('install.lock')) {
    die("<div style='font-family:sans-serif; text-align:center; padding:50px; color:#333;'>
            <h2>Akses Ditolak</h2>
            <p>Aplikasi GHCBT sudah diinstal dan terkunci.</p>
            <p>Harap hapus file <b>install/install.lock</b> jika Anda benar-benar ingin menginstal ulang.</p>
            <a href='../' style='padding:10px 20px; background:#10B981; color:white; text-decoration:none; border-radius:5px;'>Kembali ke Aplikasi</a>
         </div>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = trim($_POST['db_host']);
    $db_user = trim($_POST['db_user']);
    $db_pass = $_POST['db_pass'];
    $db_name = trim($_POST['db_name']);
    $base_url = trim($_POST['base_url']);
    $db_file = trim($_POST['db_file']);

    // 1. Connect to MySQL without DB first
    $conn = @new mysqli($db_host, $db_user, $db_pass);
    
    if ($conn->connect_error) {
        $error = "Koneksi Database gagal. Pastikan User/Password benar! (" . $conn->connect_error . ")";
    } else {
        // 2. Create DB (Using backticks for name safety)
        $sql_create = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8 COLLATE utf8_general_ci;";
        if ($conn->query($sql_create) === TRUE) {
            
            // 3. Select DB
            $conn->select_db($db_name);
            
            // 4. Import SQL
            if (file_exists($db_file)) {
                $sql_content = file_get_contents($db_file);
                
                if (!empty(trim($sql_content))) {
                    // Try to execute multi query
                    if ($conn->multi_query($sql_content)) {
                        do {
                            // discard result sets if any
                            if ($result = $conn->store_result()) {
                                $result->free();
                            }
                        } while ($conn->more_results() && $conn->next_result());
                        
                        // 5. Update application/config/database.php
                        $db_config_path = '../application/config/database.php';
                        if(file_exists($db_config_path)) {
                            $db_content = file_get_contents($db_config_path);
                            $db_content = preg_replace("/'hostname'\s*=>\s*'[^']*'/", "'hostname' => '$db_host'", $db_content);
                            $db_content = preg_replace("/'username'\s*=>\s*'[^']*'/", "'username' => '$db_user'", $db_content);
                            $db_content = preg_replace("/'password'\s*=>\s*'[^']*'/", "'password' => '$db_pass'", $db_content);
                            $db_content = preg_replace("/'database'\s*=>\s*'[^']*'/", "'database' => '$db_name'", $db_content);
                            file_put_contents($db_config_path, $db_content);
                        }

                        // 6. Update base_url in config.php
                        $cfg_config_path = '../application/config/config.php';
                        if(file_exists($cfg_config_path) && !empty($base_url)) {
                            $cfg_content = file_get_contents($cfg_config_path);
                            // We need to carefully replace the base_url
                            $cfg_content = preg_replace("/\$config\['base_url'\]\s*=\s*'[^']*';/", "\$config['base_url'] = '$base_url';", $cfg_content);
                            // If base_url was empty initially
                            $cfg_content = preg_replace("/\$config\['base_url'\]\s*=\s*\"\";/", "\$config['base_url'] = '$base_url';", $cfg_content);
                            
                            file_put_contents($cfg_config_path, $cfg_content);
                        }

                        // 7. Create install.lock
                        file_put_contents('install.lock', 'locked_'.date('Y-m-d H:i:s'));
                        
                        $success = "Aplikasi berhasil diinstal dan dihubungkan ke database. Sistem GHCBT Anda sekarang siap digunakan!";
                    } else {
                        $error = "Terjadi kesalahan saat meng-import database.SQL: " . $conn->error;
                    }
                } else {
                     $error = "File database.sql kosong!";
                }
            } else {
                $error = "File <b>$db_file</b> tidak ditemukan di folder instalasi!";
            }
            
        } else {
            $error = "Gagal membuat database '$db_name'. Pastikan ada hak akses CREATE: " . $conn->error;
        }
        $conn->close();
    }
}

// Auto-detect base_url
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$auto_base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . str_replace("/install/index.php", "", $_SERVER['PHP_SELF']) . "/";

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem GHCBT - Setup Wizard</title>
    <!-- Google Fonts for typography -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #38bdf8; /* Sky Blue */
            --primary-dark: #0284c7; /* Darker Sky Blue */
            --primary-light: #e0f2fe;
            --surface: #1e293b; /* Dark Blue Surface */
            --background: #0f172a; /* Deep Dark Blue Background */
            --text-dark: #f1f5f9; /* Light text for dark mode */
            --text-muted: #94a3b8;
            --border: #334155;
            --error: #ef4444;
            --error-bg: rgba(239, 68, 68, 0.1);
            --success: #38bdf8;
            --success-bg: rgba(56, 189, 248, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--background);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .split-layout {
            display: flex;
            width: 100%;
            max-width: 1100px;
            background: var(--surface);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 
                        0 0 0 1px rgba(255,255,255,0.05);
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        /* Banner Layour - Left Side */
        .banner {
            flex: 1;
            background: linear-gradient(135deg, #1e3a8a 0%, #38bdf8 100%); /* Dark Blue to Sky Blue */
            padding: 60px 40px;
            position: relative;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            min-height: 600px;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="rgba(255,255,255,0.05)"/></svg>');
            mask-image: radial-gradient(circle at center, black, transparent 80%);
        }

        .banner .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        .banner-content {
            position: relative;
            z-index: 10;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .banner .logo-text {
            font-size: 48px;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
        }

        .banner .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        .banner h2 {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .banner p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
            max-width: 90%;
        }

        /* Form Layout - Right Side */
        .form-section {
            flex: 1;
            padding: 60px 50px;
            background: var(--surface);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .form-header {
            margin-bottom: 35px;
            animation: slideLeft 0.6s ease-out 0.2s both;
        }

        .form-header h3 {
            font-size: 28px;
            color: var(--text-dark);
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 22px;
            animation: slideLeft 0.6s ease-out 0.3s both;
        }

        .form-group:nth-child(2) { animation-delay: 0.35s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.45s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid var(--border);
            border-radius: 14px;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color: var(--text-dark);
            background: rgba(15, 23, 42, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.2);
            background: var(--background);
            transform: translateY(-1px);
        }

        .hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
            display: block;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3), 0 4px 6px -2px rgba(16, 185, 129, 0.15);
            margin-top: 15px;
            animation: slideLeft 0.6s ease-out 0.6s both;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: skewX(-20deg);
            transition: 0.5s;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(16, 185, 129, 0.4), 0 8px 10px -6px rgba(16, 185, 129, 0.2);
        }

        .btn:hover::after {
            left: 150%;
        }

        .btn-success {
            background: var(--success);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 30px 0;
            position: relative;
            animation: slideLeft 0.6s ease-out 0.35s both;
        }

        .divider::after {
            content: "DATABASE";
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: var(--surface);
            padding: 0 15px;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.5;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .alert-error {
            background: var(--error-bg);
            border: 1px solid #fecaca;
            color: var(--error);
        }

        .alert-success {
            background: var(--success-bg);
            border: 1px solid #a7f3d0;
            color: var(--success);
            flex-direction: column;
            text-align: center;
            padding: 40px 30px;
        }

        .alert-success .icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: inline-block;
            animation: bounceIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* Loading Screen */
        .loader-overlay {
            display: none;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            z-index: 100;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .split-layout {
                flex-direction: column;
            }
            .banner {
                min-height: 300px;
                padding: 40px 30px;
            }
            .form-section {
                padding: 40px 30px;
            }
            .banner .shape { display: none; }
        }
    </style>
</head>
<body>

<div class="split-layout">
    
    <div id="loader" class="loader-overlay">
        <div class="spinner"></div>
        <p style="font-weight: 600; color: var(--text-dark); font-size:18px;">Memproses Instalasi...</p>
        <p style="color: var(--text-muted); font-size:14px; margin-top:5px;">Mohon tunggu sebentar, sedang membangun database.</p>
    </div>

    <!-- Left Banner -->
    <div class="banner">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="banner-content">
            <div class="logo-text">
                <div class="logo-icon">GH</div>
                GHCBT
            </div>
            <h2>Sistem Terpadu<br>Ujian Modern</h2>
            <p>Selesaikan konfigurasi database dalam hitungan detik. Platform ini dirancang untuk kecepatan, keamanan, dan pengalaman pengguna tingkat premium.</p>
        </div>
    </div>

    <!-- Right Form Area -->
    <div class="form-section">
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <div class="icon">✅</div>
                <h3 style="margin:0 0 10px 0; color:var(--text-dark); font-size:24px;">Setup Berhasil!</h3>
                <p style="margin:0 0 25px 0; color:var(--text-muted);"><?php echo $success; ?></p>
                <a href="../" class="btn btn-success" style="width:100%; box-sizing:border-box;">Mulai Gunakan Aplikasi</a>
            </div>
        <?php else: ?>

            <div class="form-header">
                <h3>Wizard Instalasi</h3>
                <p>Silakan isi informasi server Anda untuk memulai.</p>
            </div>

            <form method="POST" onsubmit="showLoader()">
                <div class="form-group">
                    <label>Base URL Aplikasi (Otomatis)</label>
                    <input type="text" name="base_url" value="<?php echo $auto_base_url; ?>" readonly style="background: rgba(15, 23, 42, 0.8); cursor: not-allowed; color: var(--primary);">
                    <span class="hint">Alamat web terdeteksi otomatis untuk mencegah kesalahan sistem.</span>
                </div>

                <div class="form-group">
                    <label>Tipe Instalasi (Pilih Database)</label>
                    <select name="db_file" required style="width: 100%; padding: 15px 18px; border: 1px solid var(--border); border-radius: 14px; font-family: 'Outfit', sans-serif; font-size: 15px; color: var(--text-dark); background: rgba(15, 23, 42, 0.5);">
                        <option value="database_kosong.sql">Instalasi Baru (Database Kosong)</option>
                        <option value="database_dummy.sql">Mode Demo (Lengkap dengan Contoh Soal)</option>
                        <?php if(file_exists('database.sql')): ?>
                        <option value="database.sql">Database Standard</option>
                        <?php endif; ?>
                    </select>
                    <span class="hint">Pilih "Instalasi Baru" jika ingin menginput data dari nol.</span>
                </div>

                <div class="divider"></div>

                <div class="form-group">
                    <label>Database Host</label>
                    <input type="text" name="db_host" value="localhost" required>
                </div>

                <div class="form-group">
                    <label>Database Username</label>
                    <input type="text" name="db_user" value="root" required>
                </div>

                <div class="form-group">
                    <label>Database Password</label>
                    <input type="password" name="db_pass" placeholder="Kosongkan jika di XAMPP">
                </div>

                <div class="form-group">
                    <label>Nama Database</label>
                    <input type="text" name="db_name" value="ghcbt" required>
                    <span class="hint">Database ini akan dibuat otomatis oleh sistem.</span>
                </div>

                <button type="submit" class="btn">Mulai Instalasi</button>
            </form>

        <?php endif; ?>

    </div>
</div>

<script>
    function showLoader() {
        document.getElementById('loader').style.display = 'flex';
    }
</script>

</body>
</html>
