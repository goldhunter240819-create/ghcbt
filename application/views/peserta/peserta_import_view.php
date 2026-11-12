<!-- Tambahkan Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<style>
    .content-header h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--text-bright); letter-spacing: -0.5px; }
    
    .premium-card {
        background: var(--bg-box);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-main);
        margin-bottom: 30px;
        overflow: hidden;
    }
    .premium-header {
        padding: 20px 25px;
        background: rgba(var(--primary-rgb), 0.05);
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .premium-header i { font-size: 20px; color: var(--accent-color); }
    .premium-header .title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-bright); }
    
    .premium-body { padding: 25px; }

    .paste-zone {
        border: 2px dashed var(--border-light);
        border-radius: 15px;
        padding: 8px;
        background: rgba(var(--primary-rgb), 0.02);
        transition: all 0.3s ease;
    }
    .paste-zone:focus-within {
        border-color: var(--accent-color);
        background: var(--bg-box);
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
    }

    .btn-premium {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.2);
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(var(--primary-rgb), 0.3);
        color: white;
    }

    .step-label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        font-weight: 700;
        color: var(--accent-color);
        font-size: 14px;
    }
    .step-num {
        width: 24px; height: 24px;
        background: var(--primary-gradient);
        color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px;
    }

    #import_paste_word[placeholder]:empty:before {
        content: attr(placeholder);
        color: var(--text-muted);
    }

    .guide-box {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
    }
    .guide-header { background: rgba(var(--primary-rgb), 0.03); padding: 10px 15px; font-weight: 700; font-size: 13px; border-bottom: 1px solid var(--border-light); color: var(--text-bright); }
    .guide-table { font-size: 12px; margin-bottom: 0 !important; color: var(--text-main); }
    .guide-table th { background: rgba(var(--primary-rgb), 0.05); text-align: center; color: var(--text-muted); border-bottom: 1px solid var(--border-light) !important; }
    .guide-table td { border-color: var(--border-light) !important; }

    /* Fix for Table Striped in Dark/Light themes - Round 2 aggressive fix */
    #preview-siswa-container table tr {
        background-color: transparent !important;
        color: var(--text-main) !important;
    }
    #preview-siswa-container table tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.04) !important;
    }
    #preview-siswa-container table tr:hover {
        background-color: rgba(var(--primary-rgb), 0.1) !important;
    }
    #preview-siswa-container table td {
        border-color: var(--border-light) !important;
        color: var(--text-main) !important;
        padding: 12px !important;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Import Data Siswa
		<small>Pilih metode import yang paling nyaman bagi Anda</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Import Siswa</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div style="background: rgba(var(--primary-rgb), 0.05); border-left: 5px solid var(--accent-color); padding: 15px; border-radius: 0 12px 12px 0; margin-bottom: 25px; display: flex; gap: 15px; align-items: center;">
                <div style="width: 40px; height: 40px; background: var(--primary-gradient); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                    <i class="fa fa-info-circle"></i>
                </div>
                <div style="font-size: 13px; color: var(--text-main); line-height: 1.5;">
                    Data Siswa yang di-import akan digunakan untuk akun login ujian. 
                    Pastikan <b>Daftar Kelas (Grup)</b> sudah terdaftar sebelum melakukan proses import.
                </div>
            </div>
        </div>
    </div>

    <!-- SINGLE FOCUS INTERFACE: SMART PASTE -->
    <div class="row">
        <div class="col-md-12">
            <div class="premium-card" id="box-smart-paste" style="box-shadow: var(--shadow-main); padding: 40px;">
                <div class="row">
                    <div class="col-md-8">
                        <h3 style="font-weight: 800; color: var(--text-bright); margin-bottom: 25px; font-family: 'Plus Jakarta Sans', sans-serif;">
                            <i class="fa fa-clipboard" style="margin-right: 12px; color: var(--accent-color);"></i>
                            Smart Paste Siswa
                        </h3>
                        <div class="step-label" style="font-size: 16px; margin-bottom: 20px;">
                            <div class="step-num" style="width: 32px; height: 32px; font-size: 14px;">1</div>
                            <div>Tempelkan Tabel Siswa dari Microsoft Word di sini:</div>
                        </div>

                        <div class="paste-zone">
                            <div id="import_paste_word" contenteditable="true" style="min-height: 250px; max-height: 450px; overflow-y: auto; padding: 20px; outline: none; font-size: 14px; color: var(--text-main); line-height: 1.6;" placeholder="Blok tabel di Word, Copy (Ctrl+C), lalu klik di sini dan tekan Ctrl+V..."></div>
                        </div>

                        <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="font-size: 13px; color: var(--text-muted);">
                                <i class="fa fa-check-circle" style="color: #10b981; margin-right: 5px;"></i> 
                                Cukup paste 4 kolom: Nama, TTL, dan Kelas. Username & Password otomatis ter-generate.
                            </div>
                            <button type="button" class="btn btn-premium" id="btn-proses-paste" style="padding: 12px 40px; font-size: 16px;">
                                PARSING DATA SEKARANG <i class="fa fa-arrow-right" style="margin-left: 10px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="guide-box" style="margin-top: 80px; background: rgba(var(--primary-rgb), 0.02); border-style: dashed;">
                            <div class="guide-header" style="background: transparent;"><i class="fa fa-mouse-pointer"></i> INSTRUKSI CEPAT</div>
                            <div style="padding: 20px; font-size: 14px; color: var(--text-main); line-height: 1.8;">
                                <ol style="padding-left: 20px;">
                                    <li>Buka <b>Microsoft Word</b>.</li>
                                    <li>Blok/Sorot seluruh tabel siswa.</li>
                                    <li>Tekan <b>Ctrl + C</b> untuk menyalin.</li>
                                    <li><b>Klik</b> pada kotak di samping kiri.</li>
                                    <li>Tekan <b>Ctrl + V</b> untuk menempel.</li>
                                    <li>Klik tombol <b>Parsing Data</b>.</li>
                                </ol>
                                <div style="margin-top: 15px; border-top: 1px solid var(--border-light); padding-top: 15px; font-size: 12px; color: var(--text-muted); font-style: italic;">
                                    *Pastikan Nama Kelas sudah sesuai dengan daftar grup sekolah.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Verifikasi Data (Hidden by default) -->
            <div id="box-verifikasi" class="premium-card hide" style="padding: 40px; border-top: 4px solid #10b981;">
                 <h3 style="font-weight: 800; color: #10b981; margin-bottom: 25px; font-family: 'Plus Jakarta Sans', sans-serif;">
                    <i class="fa fa-check-circle" style="margin-right: 12px;"></i>
                    Konfirmasi Data Siswa
                 </h3>
                 <div id="preview-siswa-container" style="max-height: 500px; overflow-y: auto; border: 1px solid var(--border-light); border-radius: 15px; background: var(--bg-box); margin-bottom: 30px;">
                    <!-- Hasil Parsing Muncul Di Sini -->
                </div>
                
                <input type="hidden" id="html-raw-input">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button type="button" class="btn btn-default" id="btn-batal" style="padding: 12px 30px; font-size: 15px;">
                        <i class="fa fa-undo"></i> ULANGI PASTE
                    </button>
                    <div style="text-align: right;">
                        <span style="display: block; font-size: 12px; color: var(--text-muted); margin-bottom: 5px;">Pastikan semua data sudah benar</span>
                        <button type="button" class="btn btn-success btn-premium" id="btn-simpan-final" style="padding: 15px 50px; font-size: 16px;">
                            SIMPAN KE DATABASE <i class="fa fa-database" style="margin-left: 10px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANDUAN FORMAT TABEL -->
    <div class="row">
        <div class="col-md-12">
            <div class="premium-card">
                <div class="premium-header" style="background: var(--bg-body);">
                    <i class="fa fa-book" style="color: var(--accent-color);"></i>
                    <div class="title">PANDUAN FORMAT TABEL WORD</div>
                </div>
                <div class="premium-body">
                    <p style="font-size: 14px; color: var(--text-main); margin-bottom: 20px;">Lakukan Copy-Paste tabel dari Microsoft Word Anda dengan urutan kolom sebagai berikut agar data terbaca dengan benar oleh sistem:</p>
                    
                    <div class="guide-box">
                        <div class="guide-header">CONTOH FORMAT TABEL DI WORD</div>
                        <table class="table table-bordered guide-table">
                            <thead>
                                <tr>
                                    <th>NAMA</th>
                                    <th>TEMPAT LAHIR</th>
                                    <th>TGL LAHIR</th>
                                    <th>KELAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>M AZIZ SULAIMAN</td>
                                    <td>LAMPUNG BARAT</td>
                                    <td>27-12-2000</td>
                                    <td>XI MIPA 1</td>
                                </tr>
                                <tr>
                                    <td>SITI AMINAH</td>
                                    <td>LAMPUNG BARAT</td>
                                    <td>15-05-2001</td>
                                    <td>XI MIPA 1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 15px; background: #fffbeb; border: 1px solid #fef3c7; padding: 12px; border-radius: 10px; display: flex; gap: 10px; align-items: flex-start;">
                        <i class="fa fa-lightbulb-o" style="color: #d97706; font-size: 18px;"></i>
                        <div style="font-size: 12px; color: #92400e;">
                            <strong>Tips:</strong> Pastikan Nama Kelas di Word sama persis dengan Nama Kelas yang sudah Anda buat di menu <b>Daftar Kelas (Grup)</b>. Jika penulisan berbeda, sistem tidak akan mengenali kelas siswa tersebut.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Sukses -->
<div class="modal fade" id="modal-import-sukses" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-body text-center" style="padding: 30px;">
                <div style="width: 60px; height: 60px; background: rgba(var(--primary-rgb), 0.1); color: var(--accent-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 24px;">
                    <i class="fa fa-check"></i>
                </div>
                <h4 style="font-weight: 700;">Import Berhasil!</h4>
                <p id="info-hasil-import" style="font-size: 13px; color: var(--text-main);"></p>
                <div id="info-hasil-error" style="font-size: 11px; color: var(--text-muted); margin-top: 10px;"></div>
                <button type="button" class="btn btn-primary btn-block" onclick="location.reload()" style="margin-top: 20px; border-radius: 10px; font-weight: 600;">SELESAI</button>
            </div>
        </div>
    </div>
</div>

<script lang="javascript">
    $(function(){
        // Efek Placeholder pada ContentEditable
        $('#import_paste_word').on('focus', function() {
            var el = $(this);
            if(el.text().trim() === 'Buka file Word > Blok Tabel Siswa > Copy (Ctrl+C) > Tempel (Ctrl+V) di sini...') {
                el.empty();
            }
        });

        // Event Tombol Parsing
        $('#btn-proses-paste').click(function(){
            var html = $('#import_paste_word').html();
            var text = $('#import_paste_word').text().trim();

            if(!text && html.indexOf('<table') === -1){
                notify_error('Peringatan: Area paste masih kosong. Silahkan copy tabel dari Word dulu.');
                return;
            }

            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url($url.'/import_word'); ?>",
                type: 'POST',
                data: { 'import-siswa': html },
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if (obj.status == 1) {
                        $('#preview-siswa-container').html(obj.siswa);
                        $('#html-raw-input').val(obj.html_raw);
                        $('#box-smart-paste').addClass('hide');
                        $('#box-verifikasi').removeClass('hide');
                        notify_success('Data berhasil dideteksi. Periksa hasil verifikasi di bawah.');
                    } else {
                        Swal.fire('Oops!', obj.pesan, 'warning');
                    }
                },
                error: function() {
                    $("#modal-proses").modal('hide');
                    notify_error('Gagal menghubungi server. Periksa koneksi Anda.');
                }
            });
        });

        // Tombol Batal Verifikasi
        $('#btn-batal').click(function(){
            $('#box-verifikasi').addClass('hide');
            $('#box-smart-paste').removeClass('hide');
        });

        // Tombol Simpan Final
        $('#btn-simpan-final').click(function(){
            var html = $('#html-raw-input').val();
            
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url($url.'/konfirmasi_word'); ?>",
                type: 'POST',
                data: { 'konfirmasi-import-siswa': html },
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if (obj.status == 1) {
                        $('#info-hasil-import').html('Jumlah Siswa Masuk: <b>' + obj.jmldatasukses + '</b><br>Gagal: ' + obj.jmldataerror);
                        if(obj.pesan_error) $('#info-hasil-error').html(obj.pesan_error);
                        $('#modal-import-sukses').modal('show');
                    } else {
                        Swal.fire('Error!', obj.pesan, 'error');
                    }
                },
                error: function() {
                    $("#modal-proses").modal('hide');
                    notify_error('Terjadi kesalahan sistem saat menyimpan data.');
                }
            });
        });
    });
</script>