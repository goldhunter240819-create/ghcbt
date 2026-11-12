<?php
/**
 * Standalone Activation Page for GHCBT Zenith Pulse
 */
define('BASEPATH', 'system'); // Simulasi agar library bisa diakses
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once 'application/libraries/Licensing.php';
$licensing = new Licensing();
$device_id = $licensing->get_device_id();

$message = '';
if (isset($_POST['activate'])) {
    $input_key = trim($_POST['license_key']);
    if ($licensing->generate_license_key($device_id) === $input_key) {
        $licensing->save_license($input_key);
        header("Location: index.php");
        exit;
    } else {
        $message = '<div class="alert alert-danger">Kunci Aktivasi tidak valid untuk perangkat ini!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenith Pulse | Aktivasi Diperlukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <style>
        :root {
            --zenith-bg: #020617;
            --zenith-primary: #6366f1;
            --zenith-secondary: #0ea5e9;
            --text-main: #f1f5f9;
        }

        body {
            background: var(--zenith-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        /* Animated Background Particles Effect */
        body::before {
            content: '';
            position: absolute;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
            animation: pulse 10s infinite alternate;
            z-index: 0;
        }

        @keyframes pulse {
            0% { transform: translate(-25%, -25%) scale(1); }
            100% { transform: translate(-15%, -15%) scale(1.1); }
        }

        .activation-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 40px;
            border-radius: 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--zenith-primary), var(--zenith-secondary));
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            animation: float 3s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        h1 { font-weight: 800; font-size: 24px; margin-bottom: 10px; letter-spacing: -0.5px; }
        p { color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 30px; }

        .device-id-box {
            background: rgba(15, 23, 42, 0.5);
            border: 1px dashed rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .device-id-label { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: var(--zenith-secondary); font-weight: 700; margin-bottom: 5px; }
        .device-id-value { font-family: monospace; font-size: 18px; font-weight: 700; color: #fff; letter-spacing: 2px; }

        .form-control {
            background: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: white !important;
            border-radius: 12px;
            padding: 12px 20px;
            height: auto;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--zenith-primary) !important;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3) !important;
        }

        .btn-activate {
            background: linear-gradient(135deg, var(--zenith-primary), var(--zenith-secondary));
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);
        }

        .btn-activate:hover { transform: translateY(-2px); box-shadow: 0 12px 20px rgba(99, 102, 241, 0.4); opacity: 0.95; }

        .footer-note { font-size: 11px; color: #64748b; margin-top: 25px; }
        .footer-note a { color: var(--zenith-secondary); text-decoration: none; font-weight: 600; }

        .alert { border-radius: 12px; font-size: 13px; font-weight: 600; text-align: left; }
    </style>
</head>
<body>
    <div class="activation-card">
        <div class="icon-box">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        </div>
        <h1>ZENITH PULSE</h1>
        <p>Aplikasi belum diaktifkan atau lisensi hardware tidak cocok. Salin Device ID di bawah ini dan kirimkan ke Administrator untuk mendapatkan Kunci Aktivasi.</p>

        <?php echo $message; ?>

        <div class="device-id-box">
            <div class="device-id-label">Device Identifier (HWID)</div>
            <div class="device-id-value" id="device_id"><?php echo $device_id; ?></div>
        </div>

        <form method="POST" action="">
            <input type="text" name="license_key" class="form-control" placeholder="Masukkan Kunci Aktivasi" required autocomplete="off">
            <button type="submit" name="activate" class="btn-activate">Aktifkan Sekarang</button>
        </form>

        <div class="footer-note">
            Butuh bantuan? Hubungi <a href="#">Pusat Layanan Zenith</a>
        </div>
    </div>
</body>
</html>
