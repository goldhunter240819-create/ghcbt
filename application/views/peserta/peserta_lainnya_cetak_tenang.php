<?php
$inst = isset($institusi) ? $institusi : null;
$nama_sekolah = $inst ? strtoupper($inst->nama) : 'NAMA SEKOLAH';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Poster Harap Tenang</title>
    
    <style>
        @page { size: A4 landscape; margin: 0; }
        * { box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            padding: 0; margin: 0; 
            background: #f1f5f9; 
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
            border: 25px solid #dc2626; /* Red Border */
            outline: 5px solid #ffffff;
            outline-offset: -30px;
        }

        /* Dekorasi Geometris Sudut Merah */
        .corner-tl { position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: #fef2f2; border-radius: 50%; z-index: 1; }
        .corner-br { position: absolute; bottom: -50px; right: -50px; width: 350px; height: 350px; background: #fef2f2; border-radius: 50%; z-index: 1; border: 20px solid #fee2e2; }
        
        .content-wrapper {
            position: relative;
            z-index: 10;
            text-align: center;
            width: 90%;
        }

        .alert-icon {
            width: 160px;
            height: 160px;
            margin-bottom: 20px;
            color: #dc2626;
            animation: pulse 2s infinite;
        }

        .main-title {
            font-size: 140px;
            font-weight: 900;
            color: #dc2626;
            letter-spacing: 5px;
            margin: 0;
            line-height: 1;
            text-transform: uppercase;
            text-shadow: 4px 4px 0px #fca5a5;
        }

        .subtitle {
            font-size: 50px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 25px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .school-name {
            position: absolute;
            bottom: 45px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: 3px;
            z-index: 10;
            text-transform: uppercase;
        }

        .print-btn {
            position: fixed; top: 20px; right: 20px;
            background: #dc2626; color: white; border: none; padding: 15px 30px;
            font-size: 16px; font-weight: bold; border-radius: 50px; cursor: pointer;
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3); z-index: 100;
            font-family: 'Plus Jakarta Sans', sans-serif; transition: transform 0.2s;
        }
        .print-btn:hover { transform: scale(1.05); }

        @media print {
            body { background: none; }
            .print-btn { display: none; }
            .page { 
                box-shadow: none; 
                -webkit-print-color-adjust: exact; print-color-adjust: exact; 
            }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body>
    <button class="print-btn" onclick="window.print()">🖨️ CETAK POSTER</button>

    <div class="page">
        <div class="corner-tl"></div>
        <div class="corner-br"></div>

        <div class="content-wrapper">
            <!-- SVG Alert Icon -->
            <svg class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            
            <div class="main-title">HARAP TENANG</div>
            <div class="subtitle">SEDANG ADA UJIAN</div>
        </div>

        <div class="school-name"><?php echo $nama_sekolah; ?></div>
    </div>
</body>
</html>
