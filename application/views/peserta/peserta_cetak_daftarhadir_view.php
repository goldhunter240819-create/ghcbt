<?php
if (!isset($nama_sekolah)) {
    $CI =& get_instance();
    $inst = $CI->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();
    $nama_sekolah = $inst ? $inst->nama : 'NAMA SEKOLAH';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    

    <meta charset="UTF-8">
    <title>Daftar Hadir | <?php echo $topik->topik_nama; ?></title>
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            margin: 0; 
            padding: 40px; 
            font-size: 11pt; 
            color: #000;
            background: #fff;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px double #000; 
            padding-bottom: 15px; 
        }
        .header h1 { 
            margin: 0; 
            font-size: 18pt; 
            text-transform: uppercase; 
            font-weight: 700;
        }
        .header h2 { 
            margin: 5px 0 0 0; 
            font-size: 14pt; 
            font-weight: 600;
        }
        .info-table { 
            width: 100%; 
            margin-bottom: 25px; 
            border-collapse: collapse;
        }
        .info-table td { 
            padding: 4px 0; 
            vertical-align: top;
        }
        .main-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 40px;
        }
        .main-table th, .main-table td { 
            border: 1px solid #000; 
            padding: 5px 8px; 
            text-align: left; 
        }
        .main-table th { 
            background: #f0f0f0; 
            text-align: center; 
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10pt;
        }
        .text-center { text-align: center !important; }
        .footer { 
            margin-top: 30px; 
        }
        .footer-table { 
            width: 100%; 
            border-collapse: collapse;
        }
        .footer-table td { 
            width: 50%; 
            text-align: center; 
            vertical-align: top;
        }
        .sign-area {
            height: 80px;
        }
        .sign-line {
            display: inline-block;
            width: 200px;
            border-bottom: 1px solid #000;
            margin-top: 60px;
            font-weight: 700;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
            @page { 
                size: A4; 
                margin: 1.5cm; 
            }
        }
        .btn-print {
            background: #10b981;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    
        .print-footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 10px; color: #64748b; border-top: 1px solid #cbd5e1; padding-top: 8px; font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .print-footer { border-top: 1px solid #000; color: #000; padding-top: 5px; margin-top: 40px; page-break-inside: avoid; }
        }

    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body>
    <?php 
        $bulan = array(1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember');
        $t_pilih = strtotime($tanggal_pilih);
        $tgl_pilih_indo = date('d', $t_pilih).' '.$bulan[(int)date('m', $t_pilih)].' '.date('Y', $t_pilih); 
    ?>
    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button class="btn-print" onclick="window.print()">
            <i data-lucide="printer"></i> CETAK DAFTAR HADIR
        </button>
    </div>

    <div class="header-kop" style="display: flex; align-items: center; justify-content: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
        <img src="<?php echo $cbt_logo_master; ?>" class="header-logo" alt="Logo" style="width: 70px; height: 70px; object-fit: contain; margin-right: 15px;">
        <div class="header-text" style="text-align: center; flex: 1;">
            <h1 style="margin: 0; font-size: 16pt; font-weight: 800; text-transform: uppercase;">DAFTAR HADIR UJIAN</h1>
            <h2 style="margin: 3px 0; font-size: 13pt; font-weight: 700; color: #333;"><?php echo strtoupper($topik->modul_nama); ?></h2>
            <h3 style="margin: 0; font-size: 14pt; font-weight: 700; text-transform: uppercase;"><?php echo $cbt_nama_madrasah; ?></h3>
            <p style="margin: 2px 0 0 0; font-size: 10pt;"><?php echo $cbt_alamat_madrasah; ?></p>
        </div>
        <div class="header-spacer" style="width: 85px;"></div>
    </div>

    <table class="info-table" style="margin-top: 20px;">
        <tr>
            <td width="15%">Mata Pelajaran</td>
            <td width="40%">: <strong><?php echo $topik->topik_nama; ?></strong></td>
            <td width="15%">Kelas</td>
            <td width="30%">: <strong><?php echo $grup->grup_nama; ?></strong></td>
        </tr>
        <tr>
            <td>Hari / Tanggal</td>
            <td>: <strong><?php echo $tgl_pilih_indo; ?></strong></td>
            <td>Waktu</td>
            <td>: <strong>............ s.d ............</strong></td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="20%">USERNAME</th>
                <th width="40%">NAMA LENGKAP</th>
                <th width="25%" colspan="2">TANDA TANGAN</th>
                <th width="10%">KET</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($users)): ?>
                <?php $i = 1; foreach($users as $user): ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $user->user_name; ?></td>
                        <td><?php echo stripslashes($user->user_firstname); ?></td>
                        <td width="12.5%" style="border-right: none; border-bottom: 1px solid #000; vertical-align: top; padding-top: 5px;">
                            <?php if($i % 2 != 0) echo $i . ". ................."; ?>
                        </td>
                        <td width="12.5%" style="border-left: none; border-bottom: 1px solid #000; vertical-align: bottom; padding-bottom: 2px;">
                            <?php if($i % 2 == 0) echo $i . ". ................."; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php $i++; endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data siswa dalam kelas ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td>
                    Mengetahui,<br>
                    Kepala <?php echo $cbt_nama_madrasah; ?><br>
                    <div class="sign-line" style="margin-top: 50px;"><?php echo $cbt_kepala_madrasah; ?></div>
                </td>
                <td>
                    <?php echo $cbt_tempat_cetak; ?>, <?php echo $tgl_pilih_indo; ?><br>
                    Pengawas Ujian,<br>
                    <div class="sign-line"><?php echo $pengawas_pilih; ?></div>
                </td>
            </tr>
        </table>
    </div>

    <div style="height: 60px;"></div><div class="print-footer no-print-if-card">
        <div>Dicetak otomatis melalui <strong>Sistem CBT Terpadu</strong> pada <?php echo date('d/m/Y H:i'); ?></div>
        <div><strong>&copy; <?php echo date('Y'); ?> <?php echo $nama_sekolah; ?></strong> â€” Dokumen Sah & Terverifikasi</div>
    </div>

</body>
</html>

