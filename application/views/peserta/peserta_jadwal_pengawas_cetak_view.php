<?php
$inst = isset($institusi) ? $institusi : null;
$nama_sekolah = $inst ? strtoupper($inst->nama) : 'NAMA SEKOLAH';
$alamat = $inst ? $inst->alamat : 'ALAMAT SEKOLAH';
$kota = $inst ? $inst->kota : 'KOTA';
$nama_kepala = $inst ? $inst->nama_kepala : 'KEPALA MADRASAH';
$nip_kepala = $inst ? $inst->nip_kepala : '';
$logo = $inst && $inst->logo ? $inst->logo : 'logo_sekolah.png';
$topik_ujian = isset($modul) && $modul ? strtoupper($modul->modul_nama) : 'UJIAN / ASESMEN';

// Format logo URL based on siakad layout
$logo_url = '/uploads/logo/' . $logo;

// Format Tanggal Indonesia
$bulan = array(
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
);
$tanggal_cetak = date('d') . ' ' . $bulan[(int)date('m')] . ' ' . date('Y');
$qr_data = "Jadwal Pengawas Ujian ".$topik_ujian." Kelas ".strtoupper($grup_name)." telah disahkan oleh ".$nama_kepala." pada tanggal ".$tanggal_cetak;
?>
<!DOCTYPE html>
<html>
<head>
    

    <title>Cetak Jadwal Pengawas - <?php echo $grup_name; ?></title>
    <style>
        @page { size: landscape; margin: 10mm 10mm 20mm 10mm; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding: 10px; color: #000; }
        
        .header-kop { display: flex; align-items: center; justify-content: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 10px; }
        .header-logo { width: 70px; height: 70px; object-fit: contain; margin-right: 15px; }
        .header-text { text-align: center; flex: 1; }
        .header-text h1 { margin: 0; font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .header-text h2 { margin: 2px 0; font-size: 15px; font-weight: bold; text-transform: uppercase; }
        .header-text h3 { margin: 2px 0; font-size: 14px; font-weight: bold; text-transform: uppercase; }
        .header-text p { margin: 2px 0 0 0; font-size: 11px; }
        .header-spacer { width: 85px; } /* To keep text centered despite logo */
        
        .subtitle { text-align: center; margin: 5px 0 10px 0; font-size: 14px; font-weight: bold; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 5px; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 5px 4px; text-align: center; font-size: 11px; word-wrap: break-word; height: 32px; }
        th { background-color: #065f46; color: #ffffff; font-weight: bold; text-transform: uppercase; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        
        .time-col { font-weight: bold; width: 110px; background-color: #f8fafc; color: #000; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .mapel-name { font-weight: bold; }
        .break-cell { background-color: #fde047; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        
        .signature-section { margin-top: 15px; margin-bottom: 30px; display: flex; justify-content: flex-end; padding-right: 20px; }
        .signature-box { display: flex; align-items: center; gap: 10px; }
        .qr-signature { width: 60px; height: 60px; border: 1px solid #ddd; padding: 2px; background: #fff; }
        .signature-text { text-align: left; }
        .signature-text p { margin: 2px 0; font-size: 12px; }
        .signature-name { font-weight: bold; text-decoration: underline; margin-top: 25px !important; }
        
        .print-footer { margin-top: 20px; display: flex; justify-content: space-between; font-size: 9px; color: #64748b; border-top: 1px solid #cbd5e1; padding-top: 5px; font-family: 'Plus Jakarta Sans', sans-serif; }

        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
            .print-footer { position: fixed; bottom: 0; left: 0; width: 100%; border-top: 1px solid #000; color: #000; padding: 3px 10mm; box-sizing: border-box; }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #10b981; color: white; border: none; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">🖨️ CETAK SEKARANG</button>
    </div>

    <div class="header-kop">
        <img src="<?php echo $logo_url; ?>" class="header-logo" alt="Logo Sekolah">
        <div class="header-text">
            <h1>JADWAL PENGAWAS UJIAN</h1>
            <h2><?php echo $topik_ujian; ?></h2>
            <h3><?php echo $nama_sekolah; ?></h3>
            <p><?php echo $alamat; ?></p>
        </div>
        <div class="header-spacer"></div>
    </div>

    <div class="subtitle">
        KELAS: <?php echo strtoupper($grup_name); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th class="time-col">WAKTU</th>
                <?php 
                foreach($days_name as $idx => $name){
                    if(isset($used_days[$idx])){
                        echo '<th>'.$name.'</th>';
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($used_slots as $range => $val){
                echo '<tr>';
                echo '<td class="time-col">'.$range.'</td>';
                foreach($days_name as $idx => $name){
                    if(isset($used_days[$idx])){
                        $mapel = isset($jadwal[$range][$idx]) ? $jadwal[$range][$idx] : '-';
                        $cell_class = ($mapel == 'ISTIRAHAT') ? 'break-cell' : '';
                        echo '<td class="'.$cell_class.'"><span class="mapel-name">'.$mapel.'</span></td>';
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <script src="/public/assets/js/qrcode.min.js"></script>
            <div id="qrcode" class="qr-signature" style="display:flex; justify-content:center; align-items:center;"></div>
            <script>
                new QRCode(document.getElementById("qrcode"), {
                    text: "<?php echo addslashes($qr_data); ?>",
                    width: 40,
                    height: 40,
                    correctLevel : QRCode.CorrectLevel.L
                });
                setTimeout(() => {
                    let qrEl = document.getElementById("qrcode");
                    if(qrEl) {
                        let img = qrEl.querySelector('img');
                        if(img) img.style.width = '100%';
                        let canvas = qrEl.querySelector('canvas');
                        if(canvas) canvas.style.display = 'none';
                    }
                }, 100);
            </script>
            <div class="signature-text">
                <p><?php echo $kota; ?>, <?php echo $tanggal_cetak; ?></p>
                <p>Kepala Madrasah,</p>
                <p class="signature-name"><?php echo $nama_kepala; ?></p>
                <?php if(!empty($nip_kepala) && $nip_kepala != '-'): ?>
                <p>NIP. <?php echo $nip_kepala; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div style="height: 30px;"></div><div class="print-footer">
        <div>Dicetak otomatis melalui <strong>Sistem CBT Terpadu</strong> pada <?php echo date('d/m/Y H:i'); ?></div>
        <div><strong>&copy; <?php echo date('Y'); ?> <?php echo $nama_sekolah; ?></strong> — Dokumen Sah & Terverifikasi</div>
    </div>

    <script type="text/javascript">
        // window.print();
    </script>
</body>
</html>
