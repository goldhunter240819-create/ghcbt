<?php
$inst = isset($institusi) ? $institusi : null;
$nama_sekolah = $inst ? strtoupper($inst->nama) : 'NAMA SEKOLAH';
$logo = $inst && $inst->logo ? $inst->logo : '';
$logo_url = '/uploads/logo/' . $logo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Papan Nama Ruangan - <?php echo $nama_ruang; ?></title>
    
    <style>
        @page { size: A4 landscape; margin: 0; }
        * { box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            padding: 0; margin: 0; 
            background: #e2e8f0; 
            display: flex; align-items: center; justify-content: center; 
            min-height: 100vh;
        }
        
        .page {
            width: 297mm;
            height: 210mm;
            background: #ffffff;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-top: 20px solid #065f46;
            border-bottom: 20px solid #065f46;
        }

        /* Dekorasi Geometris Sudut */
        .corner-tl { position: absolute; top: -50px; left: -50px; width: 250px; height: 250px; background: #f0fdf4; border-radius: 50%; z-index: 1; }
        .corner-br { position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: #f8fafc; border-radius: 50%; z-index: 1; border: 20px solid #f1f5f9; }
        
        .content-wrapper {
            position: relative;
            z-index: 10;
            text-align: center;
            width: 90%;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: 4px solid #cbd5e1;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }

        .header-logo {
            width: 140px;
            height: 140px;
            object-fit: contain;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .room-title {
            font-size: 110px;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: 4px;
            margin: 0;
            line-height: 1.1;
            text-transform: uppercase;
            text-shadow: 2px 2px 0px #e2e8f0;
        }

        .room-subtitle {
            font-size: 35px;
            font-weight: 700;
            color: #065f46;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: #d1fae5;
            display: inline-block;
            padding: 10px 40px;
            border-radius: 50px;
        }

        .school-name {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #475569;
            letter-spacing: 3px;
            z-index: 10;
            text-transform: uppercase;
        }

        .print-btn {
            position: fixed; top: 20px; right: 20px;
            background: #065f46; color: white; border: none; padding: 15px 30px;
            font-size: 16px; font-weight: bold; border-radius: 50px; cursor: pointer;
            box-shadow: 0 10px 25px rgba(6, 95, 70, 0.3); z-index: 100;
            font-family: 'Plus Jakarta Sans', sans-serif; transition: transform 0.2s;
        }
        .print-btn:hover { transform: scale(1.05); }

        @media print {
            body { background: none; }
            .print-btn { display: none; }
            .page { 
                box-shadow: none; 
                border-top: 15mm solid #065f46 !important;
                border-bottom: 15mm solid #065f46 !important;
                -webkit-print-color-adjust: exact; print-color-adjust: exact; 
            }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body>
    <button class="print-btn" onclick="window.print()">🖨️ CETAK PAPAN RUANG</button>

    <div class="page">
        <div class="corner-tl"></div>
        <div class="corner-br"></div>

        <div class="content-wrapper">
            <?php if(!empty($logo)): ?>
            <img src="<?php echo $logo_url; ?>" class="header-logo" alt="Logo">
            <?php endif; ?>
            
            <div class="room-title"><?php echo $nama_ruang ? $nama_ruang : 'RUANG UJIAN'; ?></div>
            
            <?php if(!empty($keterangan)): ?>
            <div class="room-subtitle"><?php echo $keterangan; ?></div>
            <?php endif; ?>
        </div>

        <div class="school-name"><?php echo $nama_sekolah; ?></div>
    </div>
</body>
</html>
