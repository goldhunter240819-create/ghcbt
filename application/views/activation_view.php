<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenith Activation Portal | GHCBT Elite</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/images/favicon.png">
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.5);
            --bg-dark: #020617;
            --card-bg: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent: #38bdf8;
            --border: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(99, 102, 241, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(56, 189, 248, 0.05) 0%, transparent 40%);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .activation-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            z-index: 10;
        }

        .zenith-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .zenith-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .logo-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-box img {
            width: 140px;
            filter: drop-shadow(0 0 15px var(--primary-glow));
        }

        .header-text {
            text-align: center;
            margin-bottom: 35px;
        }

        .header-text h2 {
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
            background: linear-gradient(to bottom right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-text p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .hwid-box {
            background: rgba(15, 23, 42, 0.6);
            border: 1px dashed var(--border);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }

        .hwid-label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .hwid-value {
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 2px;
        }

        .copy-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s;
        }
        .copy-btn:hover { color: #fff; }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .form-control {
            background: rgba(2, 6, 23, 0.5) !important;
            border: 1px solid var(--border) !important;
            border-radius: 12px !important;
            color: #fff !important;
            padding: 12px 15px !important;
            height: auto !important;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        .btn-activate {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            width: 100%;
            padding: 14px;
            font-weight: 700;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-activate:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.6);
            filter: brightness(1.1);
        }

        .status-alert {
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success { background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; }
        .alert-danger { background: rgba(244, 63, 94, 0.1); border: 1px solid #f43f5e; color: #f43f5e; }

        .footer-note {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Abstract animations */
        .glass-orb {
            position: absolute;
            width: 300px; height: 300px;
            background: var(--primary);
            filter: blur(100px);
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="glass-orb" style="top: -150px; left: -150px;"></div>
    <div class="glass-orb" style="bottom: -150px; right: -150px; background: var(--accent);"></div>

    <div class="activation-container">
        <div class="zenith-card">
            <div class="logo-box">
                <img src="<?php echo base_url(); ?>public/images/logo_modern.png" alt="Zenith Logo">
            </div>

            <div class="header-text">
                <h2>Otorisasi Perangkat</h2>
                <p>Silahkan masukkan kunci aktivasi untuk melanjutkan akses manajemen Ujian.</p>
            </div>

            <?php if ($error): ?>
                <div class="status-alert alert-danger">
                    <i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($status): ?>
                <div class="status-alert alert-success">
                    <i class="fa fa-check-circle"></i> <?php echo $status; ?>
                </div>
            <?php endif; ?>

            <div class="hwid-box">
                <span class="hwid-label">Device ID Anda</span>
                <div class="hwid-value" id="device_id"><?php echo $device_id; ?></div>
                <button class="copy-btn" title="Salin ID" onclick="copyHWID()">
                    <i class="fa fa-clone"></i>
                </button>
            </div>

            <?php echo form_open('activation/process'); ?>
                <div class="form-group">
                    <label class="form-label">Kunci Aktivasi (Zenith Key)</label>
                    <input type="text" name="license_key" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX" required autocomplete="off">
                </div>

                <button type="submit" class="btn-activate">
                    VERIFIKASI & AKTIFKAN <i class="fa fa-shield" style="margin-left: 8px;"></i>
                </button>
            <?php echo form_close(); ?>

            <div class="footer-note">
                Sistem ini dilindungi oleh <b>Zenith Shield v1.3</b>.<br>
                Satu lisensi hanya berlaku untuk satu perangkat server.
            </div>
        </div>
    </div>

    <script>
        function copyHWID() {
            const hwid = document.getElementById('device_id').innerText;
            navigator.clipboard.writeText(hwid).then(() => {
                alert('Device ID berhasil disalin ke clipboard.');
            });
        }
    </script>
</body>
</html>
