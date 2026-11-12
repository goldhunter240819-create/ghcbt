<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Login Siswa | <?php echo $cbt_nama; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <style>
        :root {
            --primary: #1e293b;
            --accent: #4f46e5;
            --text-dark: #0f172a;
            --text-muted: #475569;
            --border: #e2e8f0;
            --bg-card: #ffffff;
        }

        @media print {
            @page { 
                size: A4; 
                margin: 10mm; 
            }
            body { 
                background: white !important; 
                margin: 0; 
                padding: 0; 
            }
            .no-print { display: none !important; }
            .container { 
                padding: 0 !important; 
                gap: 5mm !important; 
                max-width: none !important;
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                width: 100% !important;
            }
            .card { 
                break-inside: avoid; 
                border: 0.5pt solid #ccc !important;
                box-shadow: none !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
            color: var(--text-dark);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            width: 100%;
            max-width: 900px;
        }

        /* Ukuran KTP Standar ISO/IEC 7810 ID-1: 85.6mm x 53.98mm */
        .card {
            width: 85.6mm;
            height: 54mm;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 4mm;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* Watermark Background Logo */
        .card::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 160px;
            height: 160px;
            background-image: url('<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>'), url('<?php echo base_url(); ?>public/images/logo.png?v=<?php echo time(); ?>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            transform: translate(-50%, -50%);
            opacity: 0.15; /* Opacity watermark logo ditambahkan */
            z-index: 0;
            pointer-events: none;
        }

        .card-header, .card-footer {
            color: white;
            padding: 5px 12px; /* Padatkan header/footer */
            display: flex;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .card-header { 
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.15' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z'%3E%3C/path%3E%3C/svg%3E"), linear-gradient(135deg, #1e3a8a 0%, #0ea5e9 100%);
            background-size: cover;
            background-position: top center;
            border-bottom: 2px solid #38bdf8;
        }

        .card-footer { 
            background: linear-gradient(135deg, #1e3a8a 0%, #0c4a6e 100%);
            border-top: 1.5px solid #38bdf8; 
            margin-top: auto; 
            padding: 6px 12px; 
        }

        .card-header img {
            height: 28px;
            margin-right: 12px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .header-title { line-height: 1.2; }
        .header-title h1 {
            margin: 0;
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
        }
        .header-title h2 {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .card-body {
            display: flex;
            padding: 10px 15px;
            position: relative;
            z-index: 1;
            flex-grow: 1;
        }

        .photo-section {
            width: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 18px;
            flex-shrink: 0;
        }

        .student-photo {
            width: 22mm;
            height: 30mm;
            border: 1px solid #f8fafc;
            border-radius: 1.5mm;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-photo svg { width: 50%; opacity: 0.2; }

        .info-section {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Penyelarasan Titik Dua (Colon) */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Kunci lebar kolom agar tidak meluber */
        }

        .info-table td {
            font-size: 10px;
            padding: 2.5px 0;
            vertical-align: top;
            color: var(--text-dark);
        }

        .label-col {
            width: 58px;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1px;
            font-size: 10px;
        }

        .colon-col { 
            width: 6px; 
            text-align: center; 
            font-weight: 700; 
            color: var(--accent); 
        }

        .value-col { 
            font-weight: 700; 
            text-transform: uppercase; 
            padding-left: 2px !important; 
            font-size: 11px;
        }

        .value-name {
            display: inline-block;
            width: 100%;
            max-width: 115px; /* Batas aman sebenarnya untuk kartu 85.6mm */
            white-space: nowrap;
            overflow: hidden;
            font-size: 12px;
            line-height: 1.2;
            vertical-align: middle;
        }

        .value-col.mono { 
            font-family: 'JetBrains Mono', monospace; 
            color: var(--accent); 
            letter-spacing: 0.5px; 
        }

        .signature-section {
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .qr-side { flex-shrink: 0; }
        .text-side { text-align: left; flex-grow: 1; }

        .signature-label { font-size: 7px; color: var(--text-muted); margin-bottom: 1px; font-weight: 500; }

        .qr-signature {
            width: 10mm;
            height: 10mm;
            border: 0.5px solid #f1f5f9;
            padding: 1px;
            background: #fff;
            border-radius: 0.8mm;
        }

        .headmaster-name {
            font-size: 7.5px;
            font-weight: 700;
            margin-top: 2px;
            border-top: 0.5px solid var(--text-dark);
            padding-top: 1px;
            display: inline-block;
            min-width: 100px;
        }

        /* CARD BACK SIDE */
        .card-back {
            background: #fff;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .rules-container {
            padding: 10px 15px;
            flex-grow: 1;
            z-index: 2;
        }

        .rules-title {
            font-size: 9px;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            margin-bottom: 8px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            padding-bottom: 4px;
        }

        .rule-item {
            display: flex;
            gap: 8px;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .rule-num {
            flex-shrink: 0;
            width: 12px;
            height: 12px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7px;
            font-weight: 700;
        }

        .rule-text {
            font-size: 8px;
            color: var(--text-dark);
            font-weight: 400;
        }

        .footer-content {
            width: 100%;
            text-align: center;
            font-size: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.39);
            z-index: 1000;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .print-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45); }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">Cetak Kartu Sekarang</button>

    <div class="container">
        <?php 
            if(!empty($users)): 
                $bulan = array(1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember');
                $tgl_cetak = date('d').' '.$bulan[(int)date('m')].' '.date('Y');
        ?>
            <?php foreach($users as $user): ?>
                <div class="card">
                    <!-- Header Sabuk -->
                    <div class="card-header">
                        <img src="<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>" alt="Logo" onerror="this.src='<?php echo base_url(); ?>public/images/logo.png?v=<?php echo time(); ?>'">
                        <div class="header-title">
                            <h1><?php echo $cbt_nama; ?></h1>
                            <h2>KARTU PESERTA UJIAN</h2>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="photo-section">
                            <div class="student-photo">
                                <?php if(!empty($user->user_foto) && file_exists('./public/uploads/siswa/'.$user->user_foto)): ?>
                                    <img src="<?php echo base_url(); ?>public/uploads/siswa/<?php echo $user->user_foto; ?>" alt="Foto">
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="info-section">
                            <table class="info-table">
                                <tr>
                                    <td class="label-col">Nama</td>
                                    <td class="colon-col">:</td>
                                    <td class="value-col"><span class="value-name"><?php echo stripslashes($user->user_firstname); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="label-col">Kelas</td>
                                    <td class="colon-col">:</td>
                                    <td class="value-col"><?php echo $group_name; ?></td>
                                </tr>
                                <tr>
                                    <td class="label-col">Username</td>
                                    <td class="colon-col">:</td>
                                    <td class="value-col" style="text-transform: none !important;"><?php echo $user->user_name; ?></td>
                                </tr>
                                <tr>
                                    <td class="label-col">Password</td>
                                    <td class="colon-col">:</td>
                                    <td class="value-col" style="text-transform: none !important;"><?php echo $user->user_password; ?></td>
                                </tr>
                            </table>

                            <!-- Tanda Tangan & QR Modern Layout -->
                            <div class="signature-section">
                                <div class="qr-side">
                                    <?php 
                                        $qr_data = "Kartu Milik ".$user->user_firstname." telah disahkan oleh ".$cbt_kepala_madrasah." Kepala ".$cbt_nama_madrasah." Pada Tanggal ".$tgl_cetak;
                                    ?>
                                    <img class="qr-signature" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode($qr_data); ?>" alt="QR">
                                </div>
                                <div class="text-side">
                                    <div class="signature-label"><?php echo $cbt_tempat_cetak; ?>, <?php echo $tgl_cetak; ?></div>
                                    <div class="signature-label" style="font-weight: 700; color: var(--text-dark); margin-top: -2px;">Kepala <?php echo $cbt_nama_madrasah; ?></div>
                                    <div class="headmaster-name"><?php echo $cbt_kepala_madrasah; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Sabuk -->
                    <div class="card-footer">
                        <div class="footer-content">
                            &copy; <?php echo date('Y'); ?> <strong><?php echo $cbt_nama_madrasah; ?></strong>
                        </div>
                    </div>
                </div>

                <!-- SISI BELAKANG (TATA TERTIB) -->
                <?php if(!isset($tipe_cetak) || $tipe_cetak != 'depan'): ?>
                <div class="card card-back">
                    <div class="card-header">
                        <img src="<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>" alt="Logo" onerror="this.src='<?php echo base_url(); ?>public/images/logo.png?v=<?php echo time(); ?>'">
                        <div class="header-title">
                            <h1><?php echo $cbt_nama; ?></h1>
                            <h2>TATA TERTIB PESERTA</h2>
                        </div>
                    </div>

                    <div class="rules-container">
                        <div class="rule-item">
                            <div class="rule-num">1</div>
                            <div class="rule-text">Peserta masuk (login) menggunakan Username dan Password yang tertera pada kartu bagian depan.</div>
                        </div>
                        <div class="rule-item">
                            <div class="rule-num">2</div>
                            <div class="rule-text">Jaga kerahasiaan password Anda. Dilarang membagikan password kepada orang lain demi keamanan data.</div>
                        </div>
                        <div class="rule-item">
                            <div class="rule-num">3</div>
                            <div class="rule-text">Dilarang berpindah tab browser atau meminimalkan jendela ujian. Sistem akan mendeteksi pelanggaran secara otomatis.</div>
                        </div>
                        <div class="rule-item">
                            <div class="rule-num">4</div>
                            <div class="rule-text">Gunakan browser Google Chrome versi terbaru guna memastikan kestabilan performa ujian.</div>
                        </div>
                        <div class="rule-item">
                            <div class="rule-num">5</div>
                            <div class="rule-text">Pastikan menekan tombol "SELESAI" untuk mengirimkan jawaban ke server sebelum waktu habis.</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="footer-content">
                            &copy; <?php echo date('Y'); ?> <strong><?php echo $cbt_nama; ?></strong>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: span 2; padding: 50px; text-align: center;">
                <h3>Data siswa tidak tersedia</h3>
            </div>
        <?php endif; ?>
    </div>
    <script type="text/javascript">
        $(function() {
            // Zenith Ultra-Dynamic Shrink Logic (Strict 1-Line - Tight Boundary 115px)
            $('.value-name').each(function() {
                var el = $(this);
                var fontSize = 12; // Start from 12px
                
                // Secara agresif mengecilkan font sampai muat dalam 115px (batas fisik kartu)
                while (el[0].scrollWidth > 115 && fontSize > 6) {
                    fontSize -= 0.5;
                    el.css('font-size', fontSize + 'px');
                }
            });
        });
    </script>
</body>
</html>