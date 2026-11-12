<?php
if (!isset($kop_nama_sekolah)) {
    $CI =& get_instance();
    $inst = $CI->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();
    $kop_nama_sekolah = $inst ? $inst->nama : 'NAMA SEKOLAH';
    $kop_logo         = $inst && !empty($inst->logo) ? '/public/uploads/logo/'.$inst->logo : '';
    $kop_alamat       = '';
    $kop_telepon      = '';
    $kop_email        = '';
    $kop_website      = '';
    $kop_kota         = '';
    $kop_nama_kepala  = '';
    $kop_nip_kepala   = '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Soal - <?php echo htmlspecialchars($topik_nama); ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/logo_modern.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
           GLOBAL RESET
        ============================================================ */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        html, body {
            background: #e5e7eb;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            color: #000;
        }

        /* ============================================================
           TOOLBAR (hanya di layar, tersembunyi saat print)
        ============================================================ */
        .toolbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #1e293b;
            color: #fff;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .toolbar-left span {
            font-size: 9pt;
            color: #94a3b8;
            font-family: Arial, sans-serif;
        }
        .toolbar-left strong {
            color: #e2e8f0;
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        .btn-print {
            background: #10b981;
            color: white;
            border: none;
            padding: 8px 22px;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            transition: background 0.2s;
        }
        .btn-print:hover { background: #059669; }

        /* ============================================================
           F4 PAGE WRAPPER (tampilan layar)
        ============================================================ */
        .pages-wrapper {
            padding: 60px 20px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }

        /* ============================================================
           HALAMAN F4
        ============================================================ */
        .f4-page {
            width: 215mm;
            min-height: 330mm;
            background: #fff;
            padding: 18mm 14mm 12mm 14mm;
            box-shadow: 0 4px 20px rgba(0,0,0,0.18);
            position: relative;
            overflow: hidden;
        }

        /* ============================================================
           KOP SURAT
        ============================================================ */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            border-bottom: 3px double #000;
            padding-bottom: 4pt;
            margin-bottom: 4pt;
        }
        .kop-logo-td {
            width: 20mm;
            vertical-align: middle;
            padding-right: 3mm;
        }
        .kop-logo-td img {
            width: 18mm;
            height: 18mm;
            object-fit: contain;
            display: block;
        }
        .kop-text-td {
            text-align: center;
            vertical-align: middle;
        }
        .kop-text-td .kop-nama {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.1;
            margin: 0;
        }
        .kop-text-td .kop-sub {
            font-size: 8.5pt;
            margin-top: 1pt;
            line-height: 1.2;
        }
        .kop-spacer-td {
            width: 20mm;
        }

        /* ============================================================
           JUDUL DOKUMEN
        ============================================================ */
        .doc-title {
            text-align: center;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 2pt 0;
            margin: 3pt 0;
        }
        .doc-title h2 {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
            line-height: 1.1;
        }
        .doc-title p {
            font-size: 8.5pt;
            margin: 0;
            line-height: 1.1;
        }

        /* ============================================================
           METADATA (identitas ujian)
        ============================================================ */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 4pt;
            line-height: 1.2;
        }
        .meta-table td {
            padding: 0.5pt 4pt 0.5pt 0;
            vertical-align: top;
        }
        .meta-label {
            width: 36mm;
            font-weight: normal;
            color: #333;
        }
        .meta-sep {
            width: 4mm;
        }

        /* ============================================================
           SECTION HEADER (Bagian Pilihan Ganda / Essay dll)
        ============================================================ */
        .section-hdr {
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #000;
            border-left: 6px solid #000;
            background: #f1f5f9;
            padding: 4pt 8pt;
            margin: 12pt 0 6pt 0;
            line-height: 1.2;
            page-break-after: avoid;
        }

        /* ============================================================
           SOAL PILIHAN GANDA — 2 KOLOM
        ============================================================ */
        .questions-2col {
            column-count: 2;
            column-gap: 7mm;
        }
        .question-block {
            break-inside: avoid;
            page-break-inside: avoid;
            -webkit-column-break-inside: avoid;
            margin-bottom: 6pt;
        }
        .question-text {
            display: flex;
            font-size: 10pt;
            font-weight: normal;
            line-height: 1.2;
            margin-bottom: 1pt;
        }
        .q-num {
            width: 18pt;
            flex-shrink: 0;
        }
        .q-body {
            flex: 1;
            word-break: break-word;
        }
        .q-body p { margin: 0; padding: 0; }
        .question-block img {
            max-width: 75mm !important; /* Batasi maksimal lebarnya */
            height: auto !important; /* Paksa height auto agar proporsional dan tidak penyok/cemet */
            object-fit: contain;
            display: block;
            margin: 4pt 0;
        }

        /* Opsi A B C D */
        .options-wrap {
            padding-left: 18pt;
            font-size: 10pt;
            line-height: 1.2;
        }
        .opt-item {
            display: flex;
            gap: 4pt;
            margin-bottom: 0;
        }
        .opt-label {
            min-width: 11pt;
            flex-shrink: 0;
            font-weight: normal;
        }

        /* ============================================================
           SOAL ESSAY / ISIAN — 1 KOLOM
        ============================================================ */
        .questions-1col {
            column-count: 1;
        }

        /* ============================================================
           MENJODOHKAN
        ============================================================ */
        .matching-table {
            margin-left: 13pt;
            margin-top: 2pt;
            width: calc(100% - 13pt);
            border-collapse: collapse;
            font-size: 9pt;
            line-height: 1.2;
        }
        .matching-table th {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 1.5pt 5pt;
            font-weight: 700;
            font-size: 8.5pt;
        }
        .matching-table td {
            border: 1px solid #d1d5db;
            padding: 1.5pt 5pt;
        }

        /* ============================================================
           TANDA TANGAN
        ============================================================ */
        .ttd-wrap {
            display: flex;
            justify-content: flex-end;
            margin-top: 10pt;
        }
        .ttd-box {
            text-align: center;
            width: 55mm;
            font-size: 10pt;
            line-height: 1.3;
        }
        .ttd-box .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 15mm;
            display: block;
        }
        .ttd-box .ttd-nip {
            font-size: 9pt;
        }

        /* ============================================================
           PRINT MEDIA — tampilan cetak
        ============================================================ */
        @media print {
            html, body {
                background: white;
            }
            .toolbar { display: none !important; }
            .pages-wrapper {
                padding: 0;
                background: white;
            }
            .f4-page {
                width: 100%;
                min-height: auto;
                box-shadow: none;
                padding: 0; /* Hapus padding, biarkan @page yang mengatur margin tiap lembarnya */
                margin: 0;
            }
            @page {
                size: 215mm 330mm;
                margin: 15mm 12mm 15mm 12mm; /* Margin (Atas, Kanan, Bawah, Kiri) di SETIAP halaman fisik */
            }
        }
    </style>
</head>
<body>

    <!-- ===== TOOLBAR (layar saja) ===== -->
    <div class="toolbar no-print">
        <div class="toolbar-left">
            <svg width="18" height="18" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <div>
                <strong><?php echo htmlspecialchars($topik_nama); ?></strong>
                <span>— <?php echo htmlspecialchars($modul_nama); ?><?php if(!empty($grup_nama)): ?> / <?php echo htmlspecialchars($grup_nama); ?><?php endif; ?></span>
            </div>
        </div>
        <button class="btn-print" onclick="window.print()">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-2 4H8v-4h8v4z"/></svg>
            Cetak Sekarang
        </button>
    </div>

    <!-- ===== HALAMAN F4 ===== -->
    <div class="pages-wrapper">
        <div class="f4-page">

            <!-- KOP SURAT -->
            <table class="kop-table">
                <tr>
                    <td class="kop-logo-td">
                        <?php if(!empty($kop_logo)): ?>
                            <img src="<?php echo $kop_logo; ?>" alt="Logo">
                        <?php endif; ?>
                    </td>
                    <td class="kop-text-td">
                        <div class="kop-nama"><?php echo strtoupper($kop_nama_sekolah); ?></div>
                        <?php if(!empty($kop_alamat)): ?>
                            <div class="kop-sub"><?php echo $kop_alamat; ?></div>
                        <?php endif; ?>
                        <?php
                            $kontak = [];
                            if(!empty($kop_telepon)) $kontak[] = 'Telp: '.$kop_telepon;
                            if(!empty($kop_email))   $kontak[] = 'Email: '.$kop_email;
                            if(!empty($kop_website)) $kontak[] = $kop_website;
                            if($kontak):
                        ?>
                            <div class="kop-sub"><?php echo implode(' | ', $kontak); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="kop-spacer-td"></td>
                </tr>
            </table>

            <!-- JUDUL DOKUMEN -->
            <div class="doc-title">
                <h2>Lembar Soal Ujian</h2>
                <p>
                    <?php echo htmlspecialchars($modul_nama); ?>
                </p>
            </div>

            <!-- METADATA -->
            <table class="meta-table">
                <tr>
                    <td class="meta-label">Mata Pelajaran</td>
                    <td class="meta-sep">:</td>
                    <td><?php echo htmlspecialchars($topik_nama); ?></td>
                    <td class="meta-label" style="padding-left:8mm;">Tanggal Cetak</td>
                    <td class="meta-sep">:</td>
                    <td><?php echo date('d/m/Y'); ?></td>
                </tr>
                <?php if(!empty($grup_nama)): ?>
                <tr>
                    <td class="meta-label">Kelas / Grup</td>
                    <td class="meta-sep">:</td>
                    <td><?php echo htmlspecialchars($grup_nama); ?></td>
                    <td class="meta-label" style="padding-left:8mm;">Waktu</td>
                    <td class="meta-sep">:</td>
                    <td>............... Menit</td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td class="meta-label">Nama Siswa</td>
                    <td class="meta-sep">:</td>
                    <td>__________________________________</td>
                    <td class="meta-label" style="padding-left:8mm;">No. Absen</td>
                    <td class="meta-sep">:</td>
                    <td>______________</td>
                </tr>
            </table>

            <!-- ===== DAFTAR SOAL ===== -->
            <?php
                // Types classification
                $type_2col  = [1, 5, 6];   // Pilihan Ganda, Checklist, B/S → 2 kolom
                $type_1col  = [2, 3, 4];   // Essay, Isian, Menjodohkan → 1 kolom
                $labels_pg  = ['a', 'b', 'c', 'd', 'e', 'f'];
                $global_no  = 1;

                foreach($daftar_soal_grouped as $tipe_id => $group):
                    $is2col = in_array($tipe_id, $type_2col);
            ?>
                <!-- Section Header -->
                <div class="section-hdr"><?php echo htmlspecialchars($group['label']); ?></div>

                <!-- Questions wrapper -->
                <div class="<?php echo $is2col ? 'questions-2col' : 'questions-1col'; ?>">
                <?php foreach($group['items'] as $soal): ?>
                    <div class="question-block">
                        <!-- Nomor & teks soal -->
                        <div class="question-text">
                            <div class="q-num"><?php echo $global_no++; ?>.</div>
                            <div class="q-body">
                                <?php echo str_replace('[base_url]', base_url(), $soal['soal_detail']); ?>
                            </div>
                        </div>

                        <!-- Opsi Jawaban (PG / Checklist / B-S) -->
                        <?php if(in_array($tipe_id, [1, 5, 6]) && !empty($soal['jawaban'])): ?>
                            <div class="options-wrap">
                                <?php
                                    $idx = 0;
                                    foreach($soal['jawaban'] as $jaw):
                                        if($tipe_id == 5 || $tipe_id == 6){
                                            $lbl = '○';
                                        } else {
                                            $lbl = (isset($labels_pg[$idx]) ? $labels_pg[$idx] : chr(97+$idx)).'.';
                                        }
                                        $idx++;
                                ?>
                                <div class="opt-item">
                                    <div class="opt-label"><?php echo $lbl; ?></div>
                                    <div>
                                        <?php echo str_replace('[base_url]', base_url(), $jaw['jawaban_detail']); ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>


                        <!-- Tabel Menjodohkan -->
                        <?php if($tipe_id == 4 && !empty($soal['matching'])): ?>
                            <table class="matching-table">
                                <thead>
                                    <tr>
                                        <th style="width:46%;">Pernyataan A</th>
                                        <th style="width:8%;"></th>
                                        <th style="width:46%;">Pasangan B</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($soal['matching'] as $m): ?>
                                    <tr>
                                        <td><?php echo $m['matching_kiri']; ?></td>
                                        <td style="text-align:center;">—</td>
                                        <td><?php echo $m['matching_kanan']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div><!-- end questions wrapper -->

            <?php endforeach; ?>



        </div><!-- end .f4-page -->
    </div><!-- end .pages-wrapper -->

    <style>
        .arabic-text {
            font-family: 'Amiri', 'Noto Naskh Arabic', 'Traditional Arabic', serif;
            font-size: 1.85em;
            line-height: 1.8;
            direction: rtl;
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var walk = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
        var n;
        var textNodes = [];
        // Deteksi karakter Arab (huruf, angka arab, tanda baca)
        var arabicRegex = /([\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF\u060C\u061B\u061F\u0660-\u0669]+)/;
        
        while(n = walk.nextNode()) {
            if(n.parentNode && n.parentNode.tagName !== 'SCRIPT' && n.parentNode.tagName !== 'STYLE' && !n.parentNode.classList.contains('arabic-text')) {
                if(arabicRegex.test(n.nodeValue)) {
                    textNodes.push(n);
                }
            }
        }
        
        textNodes.forEach(function(node) {
            var frag = document.createDocumentFragment();
            var parts = node.nodeValue.split(arabicRegex);
            for(var i = 0; i < parts.length; i++) {
                if(parts[i]) {
                    if(arabicRegex.test(parts[i])) {
                        var span = document.createElement('span');
                        span.className = 'arabic-text';
                        span.textContent = parts[i];
                        frag.appendChild(span);
                    } else {
                        frag.appendChild(document.createTextNode(parts[i]));
                    }
                }
            }
            node.parentNode.replaceChild(frag, node);
        });
    });
    </script>
</body>
</html>
