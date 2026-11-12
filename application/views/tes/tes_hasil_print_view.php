<!DOCTYPE html>
<html>
<head>
    <title><?php echo $nama_tes.' ---- ('.$nama_grup.')'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    <style type="text/css">
        @page {
            size: A4;
            margin: 1.5cm;
        }
        body { 
            font-family: 'Inter', -apple-system, sans-serif; 
            margin: 0; 
            line-height: 1.5; 
            color: #1e293b;
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

        /* Summary Card */
        .summary-card {
            background: #f0fdf4;
            border: 1px solid #bcf0da;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .summary-box { width: 48%; }
        .summary-row { margin-bottom: 5px; font-size: 13px; display: flex; }
        .label { color: #64748b; font-weight: 500; width: 120px; }
        .value { color: #064e3b; font-weight: 700; }

        /* Modern Table */
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
        }
        .data-table th { 
            background-color: #10b981; 
            color: #ffffff;
            font-weight: 700; 
            text-transform: uppercase; 
            font-size: 11px;
            padding: 12px 8px;
            border: 1px solid #059669;
        }
        .data-table td { 
            padding: 10px 8px; 
            font-size: 12px; 
            border: 1px solid #d1d5db;
        }
        .data-table tr:nth-child(even) { background-color: #f9fafb; }
        
        .text-center { text-align: center !important; }
        .badge-score {
            display: inline-block;
            padding: 4px 10px;
            background: #064e3b;
            color: #ffffff;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
        }

        /* Professional Footer */
        .pdf-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #10b981;
            padding-top: 8px;
            font-size: 10px;
            color: #065f46;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
        }

        @media print {
            .no-print { display: none !important; }
            .summary-card { background-color: #f0fdf4 !important; -webkit-print-color-adjust: exact; }
            .data-table th { background-color: #10b981 !important; -webkit-print-color-adjust: exact; }
            .badge-score { background-color: #064e3b !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Center Logo -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="<?php echo base_url('public/images/logo.png'); ?>?v=<?php echo time(); ?>" style="width: 100px; height: auto; display: block; margin: 0 auto;">
        </div>

        <!-- Main Title -->
        <div class="pdf-header">
            <h1>LAPORAN HASIL UJIAN ASSESMEN MADRASAH 2026</h1>
            <div class="institution-info">
                <?php echo strtoupper($nama_madrasah); ?> | TAHUN AJARAN <?php echo $tahun_ajaran; ?>
            </div>
        </div>

        <table style="width: 100%; margin-bottom: 25px; background: #f0fdf4; border: 1px solid #bcf0da; padding: 15px; border-radius: 10px; border-spacing: 0;">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table style="width: 100%; font-size: 13px; color: #1e293b;">

                        <tr>
                            <td width="110" style="color: #64748b; font-weight: 500; padding: 4px 0; vertical-align: top;">Mata Pelajaran</td>
                            <td width="10" style="color: #64748b; font-weight: 500; padding: 4px 0; vertical-align: top;">:</td>
                            <td style="color: #064e3b; font-weight: 700; padding: 4px 0; vertical-align: top;"><?php echo $nama_tes; ?></td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; font-weight: 500; padding: 4px 0; vertical-align: top;">Target Kelas</td>
                            <td style="color: #64748b; font-weight: 500; padding: 4px 0; vertical-align: top;">:</td>
                            <td style="color: #064e3b; font-weight: 700; padding: 4px 0; vertical-align: top;"><?php echo $nama_grup; ?></td>
                        </tr>
                    </table>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <table style="width: 100%; font-size: 13px; color: #1e293b;">
                        <tr>
                            <td width="120" style="color: #64748b; font-weight: 500; padding: 4px 0; text-align: right; vertical-align: top;">Waktu Cetak</td>
                            <td width="15" style="color: #64748b; font-weight: 500; padding: 4px 0; text-align: center; vertical-align: top;">:</td>
                            <td width="110" style="color: #064e3b; font-weight: 700; padding: 4px 0; vertical-align: top;"><?php echo date('d/m/Y H:i'); ?></td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; font-weight: 500; padding: 4px 0; text-align: right; vertical-align: top;">Total Siswa</td>
                            <td style="color: #64748b; font-weight: 500; padding: 4px 0; text-align: center; vertical-align: top;">:</td>
                            <td style="color: #064e3b; font-weight: 700; padding: 4px 0; vertical-align: top;"><?php echo $query->num_rows(); ?> Orang</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No.</th>
                    <th width="35%">Nama Peserta Ujian</th>
                    <th width="15%" class="text-center">Username</th>
                    <th width="25%" class="text-center">Waktu Selesai</th>
                    <th width="20%" class="text-center">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($query->num_rows() > 0){
                        $i = 1;
                        foreach($query->result() as $temp){
                            $skor = $this->cbt_tes_soal_model->hitung_nilai_prorata($temp->tesuser_id, $temp->tes_id);
                            echo '
                            <tr>
                                <td class="text-center">'.$i++.'</td>
                                <td style="font-weight: 600; color: #111;">'.stripslashes($temp->user_firstname).'</td>
                                <td class="text-center">'.$temp->user_name.'</td>
                                <td class="text-center">'.($temp->tesuser_creation_time ? $temp->tesuser_creation_time : '-').'</td>
                                <td class="text-center">
                                    <span class="badge-score">'.number_format($skor, 2).'</span>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Data hasil ujian tidak tersedia.</td></tr>';
                    }
                ?>
            </tbody>
        </table>

        <div class="pdf-footer">
            <div>Dokumen ini dihasilkan secara otomatis oleh CBT <?php echo $nama_madrasah; ?></div>
            <div>Waktu Sistem: <?php echo date('d-m-Y H:i:s'); ?></div>
        </div>
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
