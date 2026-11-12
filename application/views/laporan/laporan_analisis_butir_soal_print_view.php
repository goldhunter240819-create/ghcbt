<!DOCTYPE html>
<html>
<head>
    <title>Analisis Butir Soal - <?php echo $nama_tes; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    <style type="text/css">
        @page {
            size: landscape;
            margin: 10mm;
        }
        body { 
            font-family: 'Inter', -apple-system, sans-serif; 
            font-size: 8px; 
            color: #1e293b; 
            margin: 0; 
            padding: 0; 
            line-height: 1.4;
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
            padding: 6px 2px; 
            text-align: center; 
            overflow: hidden; 
            text-overflow: ellipsis; 
            white-space: nowrap; 
        }
        .data th { 
            background-color: #10b981; 
            color: white; 
            font-weight: 700; 
            font-size: 8px; 
            text-transform: uppercase;
            border: 1px solid #059669;
        }
        
        /* Vertical Header Rotation */
        .data th.rotate-header {
            height: 55px;
            padding: 0;
            position: relative;
        }
        .data th.rotate-header > div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-90deg);
            width: 100px;
            text-align: center;
            white-space: nowrap;
            line-height: 1;
            font-size: 6.5pt;
            text-transform: uppercase;
            font-weight: 700;
        }

        /* Diff label rotation */
        .rotate-label {
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .rotate-label > div {
            transform: rotate(-90deg);
            white-space: nowrap;
            width: 15px;
        }

        .data tr:nth-child(even) { background-color: #f8fafc; }
        .data .name-col { text-align: left; padding-left: 8px; width: 150px; white-space: normal; font-weight: 500; }
        .data .no-col { width: 30px; }
        
        .correct { color: #10b981; font-weight: 800; font-size: 10px; }
        .incorrect { color: #94a3b8; font-weight: 500; }
        .empty { color: #f43f5e; font-weight: 800; font-size: 10px; }

        /* Summary Row Styles */
        .stat-label { text-align: right !important; padding-right: 12px !important; font-weight: 700; background: #f8fafc !important; color: #64748b; font-size: 9px; }
        .stat-value { font-weight: 700; background: #fff !important; font-size: 9px; vertical-align: middle !important; }
        .diff-low { color: #10b981; } /* Mudah */
        .diff-med { color: #3b82f6; } /* Sedang */
        .diff-high { color: #f43f5e; } /* Sulit */

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
            .correct { color: #10b981 !important; -webkit-print-color-adjust: exact; }
            .empty { color: #f43f5e !important; -webkit-print-color-adjust: exact; }
            .summary-card-table { background: #f0fdf4 !important; -webkit-print-color-adjust: exact; }
            .stat-label { background: #f1f5f9 !important; -webkit-print-color-adjust: exact; }
            .diff-low { color: #10b981 !important; -webkit-print-color-adjust: exact; }
            .diff-med { color: #3b82f6 !important; -webkit-print-color-adjust: exact; }
            .diff-high { color: #f43f5e !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo base_url('public/images/logo.png'); ?>?v=<?php echo time(); ?>" style="width: 80px; height: auto; display: block; margin: 0 auto;">
    </div>

    <div class="pdf-header">
        <h1>LAPORAN ANALISIS BUTIR SOAL</h1>
        <div class="institution-info">
            <?php echo strtoupper($nama_madrasah); ?> | TAHUN AJARAN <?php echo $tahun_ajaran; ?>
        </div>
    </div>

    <table class="summary-card-table">
        <tr>
            <td width="50%" style="vertical-align: top;">
                <table style="width: 100%; border-spacing: 0;">
                    <tr>
                        <td width="100" class="label-cell">Mata Ujian</td>
                        <td width="10" class="label-cell">:</td>
                        <td class="value-cell"><?php echo $nama_tes; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Group / Kelas</td>
                        <td class="label-cell">:</td>
                        <td class="value-cell"><?php echo $nama_grup; ?></td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="vertical-align: top;">
                <table style="width: 100%; border-spacing: 0;">
                    <tr>
                        <td width="120" class="label-cell" style="text-align: right;">Waktu Cetak</td>
                        <td width="15" class="label-cell" style="text-align: center;">:</td>
                        <td class="value-cell" style="text-align: left;"><?php echo date('d/m/Y H:i'); ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell" style="text-align: right;">Keterangan</td>
                        <td class="label-cell" style="text-align: center;">:</td>
                        <td class="value-cell" style="text-align: left;">1=Benar, 0=Salah, X=Kosong</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th class="no-col">No.</th>
                <th class="name-col">Nama Peserta</th>
                <?php 
                    for($i=1; $i<=$max_soal; $i++){
                        echo '<th class="rotate-header"><div>Soal '.$i.'</div></th>';
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Initialize stats
                $soal_stats = array();
                for($i=1; $i<=$max_soal; $i++) {
                    $soal_stats[$i] = array('benar' => 0, 'kosong' => 0, 'total' => 0);
                }

                if($query_user->num_rows() > 0){
                    $n = 1;
                    $users = $query_user->result();
                    $CI =& get_instance();
                    
                    foreach($users as $user){
                        echo '<tr>';
                        echo '<td>'.$n++.'</td>';
                        echo '<td class="name-col">'.stripslashes($user->user_firstname).'</td>';
                        
                        $query_soal_tes = $CI->cbt_tes_soal_model->get_by_testuser_order_soal($user->tesuser_id);
                        $soal_count = $query_soal_tes->num_rows();
                        
                        if($soal_count > 0){
                            $soal_tes = $query_soal_tes->result();
                            $idx = 1;
                            foreach($soal_tes as $soal){
                                if($idx > $max_soal) break; 
                                
                                $soal_stats[$idx]['total']++;
                                
                                // Logic for "Unanswered" (Kosong)
                                if(empty($soal->tessoal_change_time)){
                                    echo '<td class="empty" title="Tidak Dijawab">X</td>';
                                    $soal_stats[$idx]['kosong']++;
                                } else {
                                    if($soal->tessoal_nilai > 0){
                                        echo '<td class="correct">1</td>';
                                        $soal_stats[$idx]['benar']++;
                                    } else {
                                        echo '<td class="incorrect">0</td>';
                                    }
                                }
                                $idx++;
                            }
                            
                            // Fill remaining columns if student has fewer questions than max
                            if($idx <= $max_soal){
                                for($j=$idx; $j<=$max_soal; $j++){
                                    echo '<td>-</td>';
                                }
                            }
                        } else {
                            for($j=1; $j<=$max_soal; $j++){
                                echo '<td>-</td>';
                            }
                        }
                        echo '</tr>';
                    }

                    // ADD SUMMARY ROWS
                    // 1. JML BENAR
                    echo '<tr><td colspan="2" class="stat-label">JUMLAH BENAR</td>';
                    for($i=1; $i<=$max_soal; $i++) {
                        echo '<td class="stat-value" style="color:#10b981">'.$soal_stats[$i]['benar'].'</td>';
                    }
                    echo '</tr>';

                    // 2. JML KOSONG
                    echo '<tr><td colspan="2" class="stat-label">JUMLAH KOSONG (X)</td>';
                    for($i=1; $i<=$max_soal; $i++) {
                        echo '<td class="stat-value" style="color:#f43f5e">'.$soal_stats[$i]['kosong'].'</td>';
                    }
                    echo '</tr>';

                    // 3. TINGKAT KESULITAN
                    echo '<tr><td colspan="2" class="stat-label">TINGKAT SOAL</td>';
                    for($i=1; $i<=$max_soal; $i++) {
                        $total = $soal_stats[$i]['total'];
                        $benar = $soal_stats[$i]['benar'];
                        $ratio = $total > 0 ? ($benar / $total) : 0;
                        
                        $label = 'High';
                        $class = 'diff-high';
                        if($ratio > 0.7) {
                            $label = 'Low';
                            $class = 'diff-low';
                        } else if ($ratio >= 0.3) {
                            $label = 'Med';
                            $class = 'diff-med';
                        }
                        
                        echo '<td class="stat-value '.$class.'"><div class="rotate-label"><div>'.$label.'</div></div></td>';
                    }
                    echo '</tr>';

                }
            ?>
        </tbody>
    </table>

    <div class="pdf-footer">
        <div>Dicetak otomatis oleh Sistem GHCBT pada <?php echo date('d/m/Y H:i:s'); ?></div>
        <div>Halaman 1 dari 1</div>
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
