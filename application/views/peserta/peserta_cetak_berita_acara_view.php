<?php
if (!isset($nama_sekolah)) {
    $CI =& get_instance();
    $inst = $CI->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();
    $nama_sekolah = $inst ? $inst->nama : 'NAMA SEKOLAH';
}
?>
<!DOCTYPE html>
<html>
<head>
    

    <title>Berita Acara - <?php echo $topik->topik_nama; ?></title>
    <style>
        @media print {
            .no-print { display: none; }
            @page { size: A4; margin: 2cm; }
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #000; line-height: 1.6; margin: 0; padding: 0; font-size: 12pt; }
        .header-kop { display: flex; align-items: center; justify-content: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 20px; }
        .header-logo { width: 80px; height: 80px; object-fit: contain; margin-right: 15px; }
        .header-text { text-align: center; flex: 1; }
        .header-text h1 { margin: 0; font-size: 16pt; font-weight: 800; text-transform: uppercase; }
        .header-text h2 { margin: 3px 0; font-size: 13pt; font-weight: 700; }
        .header-text h3 { margin: 0; font-size: 14pt; font-weight: 700; }
        .header-text p { margin: 0; font-size: 10pt; }
        .header-spacer { width: 95px; }

        .content { text-align: justify; }
        .title { text-align: center; text-decoration: underline; font-weight: 800; font-size: 14pt; margin: 20px 0; }
        
        .info-table { width: 100%; margin: 20px 0; border-collapse: collapse; }
        .info-table td { padding: 5px 0; vertical-align: top; }
        .info-table td.col-label { width: 280px; white-space: nowrap; }
        .info-table td.col-separator { width: 20px; }

        .footer { margin-top: 50px; }
        .footer-table { width: 100%; border-collapse: collapse; }
        .footer-table td { width: 50%; text-align: center; vertical-align: top; padding-top: 20px; }
        .sign-line { margin-top: 80px; font-weight: 800; text-decoration: underline; }

        .btn-print { background: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: 600; }
    
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
        $hari = array('Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu');
        
        $t_pilih = strtotime($tanggal_pilih);
        $hari_pilih = $hari[date('l', $t_pilih)];
        $tgl_pilih_indo = date('d', $t_pilih).' '.$bulan[(int)date('m', $t_pilih)].' '.date('Y', $t_pilih); 
    ?>

    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button class="btn-print" onclick="window.print()">CETAK BERITA ACARA</button>
    </div>

    <div class="header-kop">
        <img src="<?php echo $cbt_logo_master; ?>" class="header-logo" alt="Logo">
        <div class="header-text">
            <h1>BERITA ACARA PELAKSANAAN</h1>
            <h2><?php echo strtoupper($topik->modul_nama); ?></h2>
            <h3><?php echo $cbt_nama_madrasah; ?></h3>
            <p><?php echo $cbt_alamat_madrasah; ?></p>
        </div>
        <div class="header-spacer"></div>
    </div>

    <div class="content">
        <p>Pada hari ini <strong><?php echo $hari_pilih; ?></strong> tanggal <strong><?php echo $tgl_pilih_indo; ?></strong>, telah dilaksanakan <strong><?php echo $topik->modul_nama; ?></strong> di <strong><?php echo $cbt_nama_madrasah; ?></strong> untuk mata pelajaran sebagai berikut:</p>
        
        <table class="info-table">
            <tr>
                <td class="col-label">Mata Pelajaran</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong><?php echo $topik->topik_nama; ?></strong></td>
            </tr>
            <tr>
                <td class="col-label">Kelas / Ruang</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong><?php echo $grup->grup_nama; ?></strong></td>
            </tr>
            <tr>
                <td class="col-label">Waktu</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong>............ s.d ............</strong></td>
            </tr>
            <tr>
                <td class="col-label">Jumlah Peserta Seharusnya</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong><?php echo $jml_peserta; ?> Orang</strong></td>
            </tr>
            <tr>
                <td class="col-label">Jumlah Peserta Hadir</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong>............ Orang</strong></td>
            </tr>
            <tr>
                <td class="col-label">Jumlah Peserta Tidak Hadir</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong>............ Orang</strong></td>
            </tr>
            <tr>
                <td class="col-label">Nama Peserta Tidak Hadir</td>
                <td class="col-separator">:</td>
                <td>&nbsp; <strong>....................................................................................................</strong></td>
            </tr>
        </table>

        <p>Catatan selama pelaksanaan ujian:</p>
        <div style="border: 1px solid #000; min-height: 120px; padding: 10px; margin-bottom: 20px;">
            <!-- Kotak Kosong untuk Catatan Manual -->
        </div>

        <p>Berita acara ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td>
                    Mengetahui,<br>
                    Kepala <?php echo $cbt_nama_madrasah; ?><br>
                    <div class="sign-line" style="margin-top: 60px;"><?php echo $cbt_kepala_madrasah; ?></div>
                </td>
                <td>
                    <?php echo $cbt_tempat_cetak; ?>, <?php echo $tgl_pilih_indo; ?><br>
                    Pengawas Ujian,<br>
                    <div class="sign-line" style="margin-top: 60px;"><?php echo $pengawas_pilih; ?></div>
                </td>
            </tr>
        </table>
    </div>

    <div style="height: 60px;"></div><div class="print-footer no-print-if-card">
        <div>Dicetak otomatis melalui <strong>Sistem CBT Terpadu</strong> pada <?php echo date('d/m/Y H:i'); ?></div>
        <div><strong>&copy; <?php echo date('Y'); ?> <?php echo $nama_sekolah; ?></strong> — Dokumen Sah & Terverifikasi</div>
    </div>

</body>
</html>
