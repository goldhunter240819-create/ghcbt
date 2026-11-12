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
$qr_data = "Jadwal Ujian ".$topik_ujian." Kelas ".strtoupper($grup_name)." telah disahkan oleh ".$nama_kepala." pada tanggal ".$tanggal_cetak;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Jadwal Ujian - <?php echo $grup_name; ?></title>
    <style>
        @page { size: landscape; margin: 10mm; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding: 20px; color: #000; background-color: #f1f5f9; display: flex; flex-direction: column; align-items: center; }
        
        .print-area {
            width: 297mm;
            min-height: 200mm;
            padding: 12mm 15mm;
            box-sizing: border-box;
            background: #ffffff;
            margin: 0 auto;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
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
        
        .signature-section { margin-top: 15px; margin-bottom: 10px; display: flex; justify-content: flex-end; padding-right: 20px; }
        .signature-box { display: flex; align-items: center; gap: 10px; }
        .qr-signature { width: 60px; height: 60px; border: 1px solid #ddd; padding: 2px; background: #fff; }
        .signature-text { text-align: left; }
        .signature-text p { margin: 2px 0; font-size: 12px; }
        .signature-name { font-weight: bold; text-decoration: underline; margin-top: 25px !important; }
        
        .print-footer { margin-top: 20px; display: flex; justify-content: space-between; font-size: 9px; color: #64748b; border-top: 1px solid #cbd5e1; padding-top: 5px; font-family: 'Plus Jakarta Sans', sans-serif; }

        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; background: #fff; }
            .print-area {
                width: 297mm;
                height: 205mm;
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 10mm 15mm !important;
                margin: 0 !important;
            }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
        }
    </style>
<link rel="stylesheet" href="/public/assets/css/plus-jakarta-sans.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: center; width: 297mm; display: flex; justify-content: flex-end; gap: 10px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); font-family: 'Plus Jakarta Sans', sans-serif; display: inline-flex; align-items: center; gap: 6px;">🖨️ CETAK SEKARANG</button>
        <button id="btn-download-image" style="padding: 10px 20px; cursor: pointer; background: #3b82f6; color: white; border: none; border-radius: 8px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); font-family: 'Plus Jakarta Sans', sans-serif; display: inline-flex; align-items: center; gap: 6px;">💾 DOWNLOAD GAMBAR (PNG)</button>
    </div>

    <div id="capture-target" class="print-area">
        <div>
            <div class="header-kop">
                <img src="<?php echo $logo_url; ?>" class="header-logo" alt="Logo Sekolah">
                <div class="header-text">
                    <h1>JADWAL PELAKSANAAN UJIAN</h1>
                    <h2><?php echo $topik_ujian; ?></h2>
                    <h3><?php echo $nama_sekolah; ?></h3>
                    <p><?php echo $alamat; ?></p>
                </div>
                <div class="header-spacer"></div>
            </div>

            <div class="subtitle">
                KELAS: <?php echo strtoupper($grup_name); ?>
            </div>

    <?php
    // Prepare active days to display in a single table
    $active_days = [];
    $days_to_check = [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12];
    if (isset($used_days)) {
        foreach($days_to_check as $d){
            if(isset($used_days[$d])){
                $active_days[] = $d;
            }
        }
    }
    ?>

    <?php if(!empty($active_days)): ?>
        <table>
            <thead>
                <tr>
                    <th class="time-col">WAKTU</th>
                    <?php 
                    foreach($active_days as $d){
                        // Determine name
                        if($d < 6){
                            $day_label = $days_name[$d] . ' (M1)';
                        } else {
                            $day_label = $days_name[$d - 7] . ' (M2)';
                        }
                        
                        // Determine date
                        $day_date = date('d/m/Y', strtotime($start_date . ' +' . $d . ' days'));
                        
                        echo '<th>' . $day_label . '<br><span style="font-weight: normal; font-size: 10px; color: #d1fae5; display: block; margin-top: 2px;">' . $day_date . '</span></th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($used_slots as $range => $val){
                    echo '<tr>';
                    echo '<td class="time-col">'.$range.'</td>';
                    foreach($active_days as $d){
                        $mapel = isset($jadwal[$range][$d]) ? $jadwal[$range][$d] : '-';
                        $cell_class = ($mapel == 'ISTIRAHAT') ? 'break-cell' : '';
                        echo '<td class="'.$cell_class.'"><span class="mapel-name">'.$mapel.'</span></td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center; padding: 20px; font-weight: bold; border: 1px solid #cbd5e1; border-radius: 8px;">
            Tidak ada jadwal untuk kelas ini.
        </div>
    <?php endif; ?>

        </div>

        <div>
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

            <div class="print-footer">
                <div>Dicetak otomatis melalui <strong>Sistem CBT Terpadu</strong> pada <?php echo date('d/m/Y H:i'); ?></div>
                <div><strong>&copy; <?php echo date('Y'); ?> <?php echo $nama_sekolah; ?></strong> — Dokumen Sah & Terverifikasi</div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('btn-download-image').addEventListener('click', function() {
            var target = document.getElementById('capture-target');
            var btn = this;
            var originalText = btn.innerHTML;
            btn.innerHTML = '⏳ MEMPROSES...';
            btn.disabled = true;

            // Wait 200ms to ensure QR is completely rendered before capture
            setTimeout(function() {
                html2canvas(target, {
                    useCORS: true,
                    scale: 2,
                    backgroundColor: '#ffffff'
                }).then(function(canvas) {
                    var link = document.createElement('a');
                    link.download = 'Jadwal_Ujian_<?= $grup_name ?>.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                    
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }).catch(function(err) {
                    alert('Gagal mendownload gambar: ' + err);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
            }, 200);
        });
    </script>
</body>
</html>
