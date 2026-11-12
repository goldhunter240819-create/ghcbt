<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Label Nomor Meja</title>
    
    <style>
        @page { size: portrait; margin: 10mm; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding: 0; margin: 0; color: #000; }
        .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 5mm; }
        .label-box { border: 2px dashed #000; padding: 10px; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 35mm; box-sizing: border-box; page-break-inside: avoid; }
        .label-title { font-size: 10px; font-weight: 700; margin-bottom: 5px; text-transform: uppercase; }
        .label-number { font-size: 40px; font-weight: 800; line-height: 1; margin-bottom: 5px; }
        .label-room { font-size: 12px; font-weight: 800; background: #000; color: #fff; padding: 2px 10px; border-radius: 4px; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        @media print {
            .no-print { display: none; }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body onload="window.print()">
    <div class="grid">
        <?php for($i = 1; $i <= $jumlah; $i++): ?>
        <div class="label-box">
            <div class="label-title">NOMOR MEJA</div>
            <div class="label-number"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></div>
            <?php if(!empty($nama_ruang)): ?>
            <div class="label-room"><?php echo $nama_ruang; ?></div>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
    </div>
</body>
</html>
