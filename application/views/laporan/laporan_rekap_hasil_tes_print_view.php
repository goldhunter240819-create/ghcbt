<!DOCTYPE html>
<html>
<head>
    <title>Rekap Hasil Ujian - <?php echo $nama_grup; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    <style type="text/css">
        @page {
            size: landscape;
            margin: 10mm;
        }
        body { 
            font-family: 'Inter', -apple-system, sans-serif; 
            font-size: 10px; 
            color: #1e293b; 
            margin: 0; 
            padding: 0; 
            line-height: 1.5;
        }
        
        /* Premium Header Styling */
        .pdf-header { 
            text-align: center;
            border-bottom: 4px double #10b981;
            padding-bottom: 10px;
            margin-bottom: 25px;
            position: relative;
        }
        .pdf-header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 1px;
            background: #10b981;
        }
        .pdf-header h1 { 
            margin: 0; 
            font-size: 20px; 
            font-weight: 800; 
            color: #064e3b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .institution-info {
            margin-top: 5px;
            font-size: 14px;
            color: #047857;
            font-weight: 600;
        }

        /* Summary Card Style */
        .summary-card-table {
            width: 100%;
            margin-bottom: 25px;
            background: #f0fdf4;
            border: 1px solid #bcf0da;
            padding: 15px;
            border-radius: 10px;
            border-spacing: 0;
        }
        .label-cell { color: #64748b; font-weight: 500; font-size: 12px; padding: 4px 0; }
        .value-cell { color: #064e3b; font-weight: 700; font-size: 12px; padding: 4px 0; }
        
        /* Modern Data Table */
        .data { 
            width: 100%; 
            border-collapse: collapse; 
            table-layout: fixed; 
            margin-top: 10px;
        }
        .data th, .data td { 
            border: 1px solid #cbd5e1; 
            padding: 8px 4px; 
            text-align: center; 
            overflow: hidden; 
            text-overflow: ellipsis; 
            white-space: nowrap; 
        }
        .data th { 
            background-color: #10b981; 
            color: white; 
            font-weight: 700; 
            font-size: 9px; 
            text-transform: uppercase;
            border: 1px solid #059669;
        }
        .data tr:nth-child(even) { background-color: #f8fafc; }
        .data .name-col { text-align: left; padding-left: 8px; width: 180px; white-space: normal; font-weight: 500; }
        .data .no-col { width: 30px; }
        
        .score { font-weight: 700; color: #4f46e5; font-size: 11px; }
        .na { color: #94a3b8; font-style: italic; opacity: 0.7; }

        /* Professional Footer */
        .pdf-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #10b981;
            padding-top: 8px;
            font-size: 9px;
            color: #065f46;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .data th { background-color: #10b981 !important; -webkit-print-color-adjust: exact; }
            .score { color: #4f46e5 !important; -webkit-print-color-adjust: exact; }
            .summary-card-table { background: #f0fdf4 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo base_url('public/images/logo.png'); ?>?v=<?php echo time(); ?>" style="width: 80px; height: auto; display: block; margin: 0 auto;">
    </div>

    <div class="pdf-header">
        <h1>REKAPITULASI HASIL UJIAN</h1>
        <div class="institution-info">
            <?php echo strtoupper($nama_madrasah); ?> | TAHUN AJARAN <?php echo $tahun_ajaran; ?>
        </div>
    </div>

    <table class="summary-card-table">
        <tr>
            <td width="50%" style="vertical-align: top;">
                <table style="width: 100%; border-spacing: 0;">
                    <tr>
                        <td width="100" class="label-cell">Kelas / Group</td>
                        <td width="10" class="label-cell">:</td>
                        <td class="value-cell"><?php echo $nama_grup; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Jumlah Ujian</td>
                        <td class="label-cell">:</td>
                        <td class="value-cell"><?php echo $query_tes->num_rows(); ?> Sesi</td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="vertical-align: top;">
                <table style="width: 100%; border-spacing: 0;">
                    <tr>
                        <td width="120" class="label-cell" style="text-align: right;">Rentang Waktu</td>
                        <td width="15" class="label-cell" style="text-align: center;">:</td>
                        <td class="value-cell" style="text-align: left;"><?php echo $rentang_waktu; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell" style="text-align: right;">Waktu Cetak</td>
                        <td class="label-cell" style="text-align: center;">:</td>
                        <td class="value-cell" style="text-align: left;"><?php echo date('d/m/Y H:i'); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th class="no-col">No.</th>
                <th class="name-col">Nama Siswa</th>
                <?php 
                    if($query_tes->num_rows() > 0){
                        foreach($query_tes->result() as $tes){
                            echo '<th>'.$tes->tes_nama.'</th>';
                        }
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                if($query_user->num_rows() > 0 AND $query_tes->num_rows() > 0){
                    $i = 1;
                    $users = $query_user->result();
                    $exams = $query_tes->result();
                    $CI =& get_instance();

                    foreach($users as $user){
                        echo '<tr>';
                        echo '<td>'.$i++.'</td>';
                        echo '<td class="name-col">'.stripslashes($user->user_firstname).'</td>';
                        
                        foreach($exams as $tes){
                            $query_nilai = $CI->cbt_tes_user_model->get_nilai_by_tes_user($tes->tes_id, $user->user_id);
                            if($query_nilai->num_rows() > 0 && $query_nilai->row()->tesuser_id != null){
                                $skor_akhir = $CI->cbt_tes_soal_model->hitung_nilai_prorata($query_nilai->row()->tesuser_id, $tes->tes_id);
                                echo '<td class="score">'.number_format($skor_akhir, 2).'</td>';
                            } else {
                                echo '<td class="na">N/A</td>';
                            }
                        }
                        echo '</tr>';
                    }
                } else {
                    $cols = $query_tes->num_rows() + 2;
                    echo '<tr><td colspan="'.$cols.'" style="padding: 20px; color: #94a3b8;">Data tidak ditemukan untuk kriteria yang dipilih.</td></tr>';
                }
            ?>
        </tbody>
    </table>

    <div style="margin-top: 20px; font-size: 9px; color: #64748b; font-style: italic;">
        <p>* N/A: Siswa tidak mengikuti ujian dalam rentang waktu yang dipilih.</p>
    </div>

    <div class="pdf-footer">
        <div>Dicetak otomatis oleh Sistem GHCBT pada <?php echo date('d/m/Y H:i:s'); ?></div>
        <div>Laporan Rekapitulasi - Halaman 1</div>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 800);
        };
    </script>
</body>
</html>
