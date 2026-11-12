<?php
/**
 * ZENITH PULSE - KEYMASTER PRO
 * Alat Manajemen Lisensi dan Penjualan.
 */
define('BASEPATH', 'system');
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

require_once '../application/libraries/Licensing.php';
$licensing = new Licensing();

// Database connection for history tracking
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'ghcbt';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

$generated_key = '';
$input_device_id = '';
$input_client_name = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM cbt_license_history WHERE id = $id");
    header("Location: zenith_generator.php");
    exit;
}

// Handle Generate
if (isset($_POST['generate'])) {
    $input_device_id = strtoupper(trim($_POST['device_id']));
    $input_client_name = trim($_POST['client_name']);
    
    if (!empty($input_device_id)) {
        $generated_key = $licensing->generate_license_key($input_device_id);
        
        // Save to Database
        $stmt = $conn->prepare("INSERT INTO cbt_license_history (client_name, device_id, activation_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $input_client_name, $input_device_id, $generated_key);
        $stmt->execute();
    }
}

// Fetch History
$history = $conn->query("SELECT * FROM cbt_license_history ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenith Suite | Admin Keymaster</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/adminlte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/adminlte/dist/css/AdminLTE.min.css">
    <style>
        body { background: #020617; color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px 20px; }
        .gen-container { max-width: 900px; margin: 0 auto; }
        
        .gen-card { background: #0f172a; border: 1px solid #1e293b; padding: 35px; border-radius: 24px; text-align: center; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4); margin-bottom: 40px; }
        h2 { color: #ffd700; font-weight: 800; font-size: 24px; letter-spacing: 1px; margin-bottom: 10px; }
        
        .form-control { background: #020617 !important; border: 1px solid #334155 !important; color: #ffd700 !important; border-radius: 12px; height: 50px; text-align: center; font-family: monospace; font-size: 16px; margin-bottom: 20px; transition: all 0.3s; }
        .form-control:focus { border-color: #ffd700 !important; box-shadow: 0 0 15px rgba(255, 215, 0, 0.2) !important; }
        
        .btn-gold { background: linear-gradient(135deg, #ffd700, #b8860b); color: #000; border: none; font-weight: 800; padding: 15px; border-radius: 12px; width: 100%; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; }
        .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3); opacity: 0.9; }
        
        .result-box { margin-top: 30px; padding: 25px; background: #ffd700; color: #000; border-radius: 16px; animation: slideUp 0.5s ease-out; }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .result-box label { display: block; font-size: 11px; text-transform: uppercase; font-weight: 900; margin-bottom: 5px; opacity: 0.6; }
        .result-box strong { font-size: 20px; font-family: monospace; letter-spacing: 2px; }

        .history-card { background: #0f172a; border: 1px solid #1e293b; border-radius: 24px; padding: 30px; }
        .history-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .history-title { font-size: 18px; font-weight: 700; color: #94a3b8; }
        
        .table { color: #cbd5e1; margin-bottom: 0; }
        .table th { border-bottom: 2px solid #1e293b !important; color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .table td { border-top: 1px solid #1e293b !important; vertical-align: middle; padding: 15px 10px; font-size: 13px; }
        .badge-id { font-family: monospace; background: #020617; border: 1px solid #334155; padding: 4px 8px; border-radius: 6px; color: #e2e8f0; }
        .badge-key { font-family: monospace; color: #ffd700; font-weight: 700; }
        
        .btn-delete { color: #ef4444; border: 1px solid #ef4444; background: transparent; padding: 5px 10px; border-radius: 8px; font-size: 11px; transition: all 0.3s; }
        .btn-delete:hover { background: #ef4444; color: white; }
    </style>
</head>
<body>
    <div class="gen-container">
        <div class="gen-card">
            <h2>ZENITH KEYMASTER PRO</h2>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 30px;">Panel Manajemen Penjualan & Lisensi Perangkat</p>
            
            <form method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="client_name" class="form-control" placeholder="Nama Klien / Sekolah" required autocomplete="off">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="device_id" class="form-control" placeholder="Masukkan Device ID Klien" required autocomplete="off">
                    </div>
                </div>
                <button type="submit" name="generate" class="btn-gold">Generate Kunci Aktivasi</button>
            </form>

            <?php if (!empty($generated_key)): ?>
                <div class="result-box">
                    <label>Berhasil Dibuat!</label>
                    <strong><?php echo $generated_key; ?></strong>
                    <div style="font-size: 10px; margin-top: 10px; opacity: 0.6;">Kunci ini telah disimpan ke Riwayat Penjualan.</div>
                </div>
            <?php endif; ?>
        </div>

        <div class="history-card">
            <div class="history-header">
                <div class="history-title">Riwayat Penjualan & Aktivasi</div>
                <div style="font-size: 12px; color: #64748b;"><?php echo $history->num_rows; ?> Lisensi Terdaftar</div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Klien</th>
                            <th>Device ID</th>
                            <th>Activation Key</th>
                            <th style="width: 50px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $history->fetch_assoc()): ?>
                            <tr>
                                <td style="color: #475569;"><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                                <td style="font-weight: 700;"><?php echo htmlspecialchars($row['client_name']); ?></td>
                                <td><span class="badge-id"><?php echo $row['device_id']; ?></span></td>
                                <td><span class="badge-key"><?php echo $row['activation_key']; ?></span></td>
                                <td>
                                    <a href="?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus riwayat ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($history->num_rows == 0): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #64748b; padding: 40px;">Belum ada riwayat penjualan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px; font-size: 11px; color: #334155; letter-spacing: 1px;">
            &copy; 2026 ZENITH SUITE • PROPRIETARY LICENSING CORE
        </div>
    </div>
</body>
</html>
