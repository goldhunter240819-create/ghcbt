<?php
$inst = isset($institusi) ? $institusi : null;
$nama_sekolah = $inst ? strtoupper($inst->nama) : 'NAMA SEKOLAH';
$alamat = $inst ? $inst->alamat : 'ALAMAT SEKOLAH';
$logo = $inst && $inst->logo ? $inst->logo : 'logo_sekolah.png';
$logo_url = '/uploads/logo/' . $logo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Tempat Duduk - <?php echo $grup_nama; ?></title>
    
    <style>
        @page { size: portrait; margin: 15mm; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding: 0; margin: 0; color: #000; }
        
        .header-kop { display: flex; align-items: center; justify-content: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 10px; }
        .header-logo { width: 70px; height: 70px; object-fit: contain; margin-right: 15px; }
        .header-text { text-align: center; flex: 1; }
        .header-text h1 { margin: 0; font-size: 18px; font-weight: 800; text-transform: uppercase; }
        .header-text h2 { margin: 2px 0; font-size: 15px; font-weight: 700; text-transform: uppercase; }
        .header-text h3 { margin: 2px 0; font-size: 14px; font-weight: 700; text-transform: uppercase; }
        .header-text p { margin: 2px 0 0 0; font-size: 11px; }
        .header-spacer { width: 85px; }
        
        .subtitle { text-align: center; margin: 10px 0 15px 0; font-size: 14px; font-weight: bold; }

        .pengawas-box {
            width: 250px;
            margin: 0 auto 30px auto;
            border: 2px solid #000;
            padding: 12px;
            text-align: center;
            font-weight: 800;
            background: #f1f5f9;
            border-radius: 6px;
            font-size: 15px;
            letter-spacing: 2px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(<?php echo $kolom; ?>, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .desk {
            border: 1.5px solid #000;
            border-radius: 6px;
            padding: 8px;
            text-align: center;
            height: 125px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #fff;
            page-break-inside: avoid;
        }

        .desk-number { font-size: 11px; font-weight: 800; color: #000; margin-bottom: 3px; border-bottom: 1px dotted #ccc; padding-bottom: 2px; width: 100%; }
        .desk-photo { width: 50px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 3px; }
        .desk-name { font-size: 11px; font-weight: 700; line-height: 1.1; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; width: 100%; }
        .desk-empty { background: #f8fafc; border: 1.5px dashed #94a3b8; color: #94a3b8; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

        @media print {
            .no-print { display: none; }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body onload="window.print()">
    
    <div class="header-kop">
        <img src="<?php echo $logo_url; ?>" class="header-logo" alt="Logo Sekolah">
        <div class="header-text">
            <h1>DENAH TEMPAT DUDUK PESERTA UJIAN</h1>
            <h2><?php echo $topik_ujian; ?></h2>
            <h3><?php echo $nama_sekolah; ?></h3>
            <p><?php echo $alamat; ?></p>
        </div>
        <div class="header-spacer"></div>
    </div>

    <div class="subtitle">
        KELAS: <?php echo $grup_nama; ?>
    </div>

    <div class="pengawas-box">
        MEJA PENGAWAS
    </div>

    <div class="grid-container">
        <?php 
            for($r=0; $r<$baris; $r++): 
                for($c=0; $c<$kolom; $c++):
                    $p = $denah_matriks[$r][$c];
                    if($p):
                    
                    $foto = base_url('public/images/avatar.png');
                    if(!empty($p->user_foto)){
                        if(strpos($p->user_foto, 'http') !== false){
                            $foto = $p->user_foto;
                        }elseif(file_exists('./public/uploads/siswa/'.$p->user_foto)){
                            $foto = base_url('public/uploads/siswa/'.$p->user_foto);
                        }
                    }
        ?>
            <div class="desk">
                <div class="desk-number"><?php echo $p->user_name; ?></div>
                <img src="<?php echo $foto; ?>" class="desk-photo">
                <div class="desk-name"><?php echo strtoupper($p->user_firstname); ?></div>
            </div>
        <?php else: ?>
            <div class="desk desk-empty">
                <div class="desk-name">KOSONG</div>
            </div>
        <?php 
                    endif;
                endfor; 
            endfor;
        ?>
    </div>

</body>
</html>
