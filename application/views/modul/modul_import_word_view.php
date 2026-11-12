<!-- Tambahkan Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --accent-color: #6366f1;
        --shadow-premium: var(--shadow-main);
    }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); }
    .content-header h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--text-bright); letter-spacing: -0.5px; }
    .premium-card {
        background: var(--bg-box);
        backdrop-filter: var(--glass-blur);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-premium);
        margin-bottom: 30px;
        overflow: hidden;
    }
    .premium-header {
        padding: 25px 30px;
        background: rgba(var(--primary-rgb), 0.03);
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .premium-header i { font-size: 24px; color: var(--accent-color); }
    .premium-header .title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-bright); }
    .premium-body { padding: 30px; color: var(--text-main); }
    .step-badge {
        width: 32px; height: 32px;
        background: var(--primary-gradient);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .paste-zone {
        border: 2px dashed var(--border-light);
        border-radius: 15px;
        padding: 10px;
        background: rgba(var(--primary-rgb), 0.02);
        transition: all 0.3s ease;
    }
    .paste-zone:focus-within {
        border-color: var(--accent-color);
        background: transparent;
    }
    .btn-premium {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        transition: all 0.3s;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }
    #import_paste_word[placeholder]:empty:before {
        content: attr(placeholder);
        color: var(--text-muted);
    }
    
    .guide-highlight {
        border: 2px solid var(--accent-color) !important;
        background: rgba(var(--primary-rgb), 0.05) !important;
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.1) !important;
    }
    .guide-highlight .guide-title {
        background: var(--primary-gradient) !important;
        color: white !important;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Smart Paste: <span style="color: var(--accent-color)"><?php echo $tipe_nama; ?></span>
		<small>Mengimpor soal tipe **<?php echo $tipe_nama; ?>** secara instan dengan copy-paste tabel dari Word</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row" id="box-awal">
		<?php echo form_open($url.'/import','id="form-importsoal"'); ?>
        <input type="hidden" name="soal_tipe" value="<?php echo (!empty($soal_tipe)) ? $soal_tipe : 1; ?>">
        <div class="col-md-4">
            <div class="premium-card">
                <div class="premium-header">
                    <i class="fa fa-folder-open"></i>
                    <div class="title">LANGKAH 1</div>
                </div>
                <div class="premium-body">
                    <div class="step-badge">1</div>
                    <label style="color: var(--text-main); font-size: 14px; margin-bottom: 15px; display: block; font-weight: 600;">Pilih Topik Tujuan</label>
                    <select name="topik" id="topik" class="form-control" style="border-radius: 12px; height: 48px; font-weight: 500;">
                        <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                    </select>
                </div>
            </div>
        </div>
		<div class="col-md-8">
            <div class="premium-card">
                <div class="premium-header">
                    <i class="fa fa-clipboard"></i>
                    <div class="title">LANGKAH 2: SMART PASTE</div>
                    <div class="pull-right dropdown">
                        <button class="btn btn-link btn-xs dropdown-toggle" type="button" data-toggle="dropdown" style="color: var(--accent-color); font-weight: 600; text-decoration: none;">
                            <i class="fa fa-download"></i> Unduh Format Word <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" style="border-radius: 12px; border: 1px solid var(--border-light); box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 5px;">
                            <li><a href="#" onclick="unduhTemplate(1); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-dot-circle-o" style="color: var(--accent-color); width: 20px;"></i> Pilihan Ganda</a></li>
                            <li><a href="#" onclick="unduhTemplate(6); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-toggle-on" style="color: var(--accent-color); width: 20px;"></i> Benar / Salah</a></li>
                            <li><a href="#" onclick="unduhTemplate(5); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-check-square-o" style="color: var(--accent-color); width: 20px;"></i> Checklist / M-Answer</a></li>
                            <li><a href="#" onclick="unduhTemplate(2); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-pencil" style="color: var(--accent-color); width: 20px;"></i> Soal Essay</a></li>
                            <li><a href="#" onclick="unduhTemplate(3); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-minus" style="color: var(--accent-color); width: 20px;"></i> Jawaban Singkat</a></li>
                            <li><a href="#" onclick="unduhTemplate(4); return false;" style="padding: 8px 15px; border-radius: 8px; font-weight: 500;"><i class="fa fa-random" style="color: var(--accent-color); width: 20px;"></i> Menjodohkan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="premium-body">
                    <div class="step-badge">2</div>
                    <label style="color: var(--text-main); font-size: 14px; margin-bottom: 15px; display: block; font-weight: 600;">Tempel Tabel Soal dari Word</label>
					<span id="form-pesan"></span>
                    
                    <div class="paste-zone" id="import_paste_container">
                        <input type="hidden" name="import-soal" id="import-soal" >
                        <div id="import_paste_word" contenteditable="true" style="min-height: 250px; max-height: 400px; overflow-y: auto; padding: 20px; outline: none; font-family: inherit; color: var(--text-main);" placeholder="Klik di sini lalu tekan Ctrl+V untuk menempelkan tabel dari Word..."></div>
                    </div>

                    <div style="margin-top: 25px; padding: 20px; background: rgba(99, 102, 241, 0.05); border-radius: 15px; display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fa fa-lightbulb-o" style="font-size: 20px; color: var(--accent-color); margin-top: 3px;"></i>
                        <div style="font-size: 13px; color: #475569; line-height: 1.6;">
                            <p style="margin: 0 0 10px 0;">
                                <b>Cara Cepat:</b> Blokir seluruh tabel di Microsoft Word Anda, lalu tekan <b>Ctrl + V</b> pada area di atas. Sistem akan mendeteksi baris sesuai format tabel Anda (SOAL, JAWABAN, KUNCI, atau MATCH).
                            </p>
                            <div style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; padding: 10px 15px; border-radius: 4px; margin-top: 10px; color: #ef4444;">
                                <b style="display: block; margin-bottom: 5px;"><i class="fa fa-exclamation-triangle"></i> Terkait Rumus Matematika (Equation)</b>
                                Rumus bawaan Microsoft Word sering terbaca sebagai teks berantakan (seperti <i>ex=1+x...</i>) saat di-paste ke peramban. <br>
                                <b>Solusi:</b> Gunakan *Snipping Tool*, cut/screenshot rumus tersebut, dan jadikan <b>Gambar (Picture)</b> di dalam tabel Word Anda sebelum di copy-paste.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="background: white; border-top: 1px solid #f1f5f9; padding: 20px 30px;">
                    <button type="button" class="btn btn-premium pull-right" id="btn-proses-paste-word">
                        PROSES SEKARANG <i class="fa fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </div>
            </div>
        </div>
		</form>
    </div>

    <!-- Tampilan Panduan Format -->
	<div class="row" id="box-panduan">
		<div class="col-md-12">
            <div class="premium-card">
                <div class="premium-header" style="background: rgba(16, 185, 129, 0.05);">
                    <i class="fa fa-book" style="color: #10b981;"></i>
                    <div class="title">PANDUAN FORMAT TABEL WORD</div>
                </div>
                <div class="premium-body" style="padding: 30px;">
                    <p style="margin-bottom: 20px; font-size: 14px;">Pastikan tabel di Word Anda mengikuti salah satu dari format berikut sesuai dengan jenis soal yang ingin Anda masukkan. <strong>Kolom pertama selalu berisi jenis indikator tabel (SOAL / JAWABAN / KUNCI / MATCH)</strong>.</p>
                    <div class="row" style="display: flex; flex-wrap: wrap; align-items: stretch;">
                        <!-- Pilihan Ganda -->
                        <div class="col-md-6">
                            <div id="guide-pg" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">1. Pilihan Ganda</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td>Ibukota Indonesia?</td><td></td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Jakarta</td><td style="width: 15%; text-align: center; color: #10b981; font-weight: bold;">1</td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Bandung</td><td></td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Beri angka <b>1</b> HANYA pada satu jawaban yang benar.</div>
                            </div>
                        </div>

                        <!-- Checklist -->
                        <div class="col-md-6">
                            <div id="guide-checklist" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">2. Checklist (Multi-Answer)</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td>Mana yang termasuk buah?</td><td></td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Apel</td><td style="width: 15%; text-align: center; color: #10b981; font-weight: bold;">1</td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Mangga</td><td style="text-align: center; color: #10b981; font-weight: bold;">1</td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Beri angka <b>1</b> pada SEMUA jawaban yang benar.</div>
                            </div>
                        </div>

                        <!-- Benar / Salah -->
                        <div class="col-md-6">
                            <div id="guide-bs" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">3. Benar / Salah</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td>Bumi itu bulat.</td><td></td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Benar</td><td style="width: 15%; text-align: center; color: #10b981; font-weight: bold;">1</td></tr>
                                    <tr><td style="font-weight:bold;">JAWABAN</td><td>Salah</td><td></td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Format sama seperti Pilihan Ganda.</div>
                            </div>
                        </div>

                        <!-- Menjodohkan -->
                        <div class="col-md-6">
                            <div id="guide-matching" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">4. Menjodohkan (Matching)</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td colspan="2">Pasangkan negaranya!</td></tr>
                                    <tr><td style="font-weight:bold;">MATCH</td><td style="width: 37.5%">Indonesia (Kiri)</td><td style="width: 37.5%">Jakarta (Kanan)</td></tr>
                                    <tr><td style="font-weight:bold;">MATCH</td><td>Jepang (Kiri)</td><td>Tokyo (Kanan)</td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Indikator <b>MATCH</b> kolom ke-2 untuk Kiri, dan ke-3 Kanan.</div>
                            </div>
                        </div>

                        <!-- Essay -->
                        <div class="col-md-6">
                            <div id="guide-essay" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">5. Essay</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td>Jelaskan arti Pancasila!</td></tr>
                                    <tr><td style="font-weight:bold;">KUNCI</td><td>Pancasila dasar negara...</td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Gunakan teks <b>KUNCI</b> untuk merekam referensi AI.</div>
                            </div>
                        </div>

                        <!-- Jawaban Singkat -->
                        <div class="col-md-6">
                            <div id="guide-singkat" style="border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                                <div class="guide-title" style="background: var(--bg-body); padding: 10px 15px; font-weight: 700; border-bottom: 1px solid var(--border-light);">6. Jawaban Singkat</div>
                                <table class="table table-bordered" style="margin: 0; font-size: 13px;">
                                    <tr><td style="font-weight:bold; width: 25%">SOAL</td><td>Presiden pertama RI?</td></tr>
                                    <tr><td style="font-weight:bold;">KUNCI</td><td>Soekarno</td></tr>
                                </table>
                                <div style="padding: 10px 15px; font-size: 12px; color: var(--text-muted); background: white;">Ket: Gunakan indikator <b>KUNCI</b> untuk merekam jawaban eksak.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	<div class="row hide" id="box-konfirmasi">
		<div class="col-md-12">
			<?php echo form_open($url.'/konfirmasi','id="form-konfirmasi"'); ?>
			<div class="premium-card">
                <div class="premium-header">
                    <i class="fa fa-check-circle"></i>
                    <div class="title">LANGKAH 3: VERIFIKASI HASIL <span id="judul-daftar-soal" style="color: var(--accent-color)"></span></div>
                </div>

                <div class="premium-body">
                    <div style="padding: 20px 25px; background: rgba(var(--primary-rgb), 0.05); border-radius: 16px; color: var(--text-main); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                        <i class="fa fa-info-circle" style="color: var(--accent-color); font-size: 20px;"></i>
                        <p style="margin:0; font-weight: 500;">Periksa kembali soal di bawah ini. Jika sudah benar, klik tombol <b>Konfirmasi Simpan</b> untuk memasukkannya ke Bank Soal.</p>
                    </div>

					<input type="hidden" name="konfirmasi-import-soal" id="konfirmasi-import-soal" >
					<input type="hidden" name="konfirmasi-topik" id="konfirmasi-topik" >
                    <input type="hidden" name="konfirmasi-soal-tipe" id="konfirmasi-soal-tipe" value="<?php echo (!empty($soal_tipe)) ? $soal_tipe : 1; ?>">
                    
                    <div id="daftar-soal" style="overflow-y: auto; height: 500px; padding: 10px;">
					
					</div>
                </div>
                <div class="box-footer" style="background: white; border-top: 1px solid #f1f5f9; padding: 25px 30px;">
					<button type="button" class="btn btn-default" id="batal" style="border-radius: 12px; padding: 10px 25px; font-weight: 600;">KEMBALI</button>
                    <button type="submit" class="btn btn-premium pull-right" id="btn-konfirmasi">
                        KONFIRMASI SIMPAN <i class="fa fa-cloud-upload" style="margin-left: 8px;"></i>
                    </button>
                </div>
            </div>
			</form>
		</div>
	</div>
</section><!-- /.content -->

<div class="modal" id="modal-sukses" data-backdrop="static" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informasi Import Soal</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-info">
                    <p>
						Import Soal berhasil disimpan.<br />
						Berikut informasi soal yang berhasil di import :<br/>
						Jumlah Soal : <span id="info-jml-soal"></span><br/>
						Jumlah Jawaban : <span id="info-jml-jawaban"></span><br/>
					</p>
					
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="refresh">OK</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<div class="modal" id="modal-image" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog" style="width: 950px">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Insert Image</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php echo form_open_multipart($url.'/upload_file','id="form-upload-image" class="form-horizontal"'); ?>
                                        <div class="box">
                                            <div class="box-header with-border">
                                                <div class="box-title">Upload File</div>
                                            </div><!-- /.box-header -->

                                            <div class="box-body">
                                                <div class="row-fluid">
                                                    <div class="box-body">
                                                        <div id="form-pesan-upload-image"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">File</label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" id="image-topik-id" name="image-topik-id" >
                                                                <input type="file" id="image-file" name="image-file" >
                                                                <p class="help-block">File yang didukung adalah jpg, jpeg, png</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="image-upload" class="btn btn-primary">Upload File</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xs-6">
                                        <div class="box hide" id="box-preview" >
                                            <div class="box-body">
                                                <div class="row-fluid">
                                                    <div class="box-body" style="height: 132px;">
                                                        <input type="hidden" name="image-isi" id="image-isi">
                                                        <div id="image-preview" style="text-align: center;vertical-align: middle;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btn-image-insert" class="btn btn-primary">Masukkan Gambar</button>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body" style="max-height: 230px;overflow: auto;">
                                            <table id="table-image" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama File</th>
                                                        <th>Preview</th>
                                                        <th>Tanggal</th>
                                                        <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                    </tr>
                                                </tbody>
                                            </table>                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script lang="javascript">

    function batal_tambah(){
        $("#form-pesan").html('');
    }
	
	/**
     * Fungsi untuk upload image dari editor text
     */
    function imageUpload(){
        $('#box-preview').addClass('hide');
        $('#image-preview').html('');
        $('#form-pesan-upload-image').html('');
        $('#image-isi').val('');
        $('#image-file').val('');

        refresh_table_image();

        $("#modal-image").modal("show");
    }
	
	function refresh_table_image(){
        $('#table-image').dataTable().fnReloadAjax();
    }

    function image_preview(posisi, image){
        $('#image-preview').html('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-height: 110px;" />');
        $('#image-isi').val('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-width: 600px;" />');
        $('#box-preview').removeClass('hide');
    }

    $(function(){
		
		$('#batal').click(function(){
			location.reload(); 
		});
		
		$('#refresh').click(function(){
			location.reload(); 
		});

        // Highlight focus pada kotak paste Smart Import
        $('#import_paste_word').on('focus', function() {
            var el = $(this);
            if(el.text().trim() === 'Klik di sini lalu tekan Ctrl+V untuk menempelkan tabel dari Word...') {
                el.empty();
            }
            $('#import_paste_container').css('border-color', 'var(--accent-color)');
            $('#import_paste_container').css('box-shadow', '0 0 0 3px rgba(99, 102, 241, 0.2)');
        }).on('blur', function() {
            $('#import_paste_container').css('border-color', '#e2e8f0');
            $('#import_paste_container').css('box-shadow', 'none');
        });

        // Anti-bloatware submit
        $(document).on('click', '#btn-proses-paste-word', function(e) {
            e.preventDefault();
            
            var raw_html = $('#import_paste_word').html();
            var topik = $('#topik').val();
            
            var html = raw_html;
            var table_node = $('#import_paste_word').find('table').first();
            if(table_node.length > 0) {
                html = table_node.prop('outerHTML'); // 99.9% penghematan payload!
            }
            
            var is_empty = false;
            var raw_text = $('#import_paste_word').text().trim();
            if(!raw_html || raw_html.trim() == '' || raw_html.trim() == '<br>'){
                is_empty = true;
            }else if(raw_text === '' && raw_html.indexOf('<img') === -1){
                is_empty = true;
            }
            
            if(is_empty){
                Swal.fire({
                    title: 'Kotak Kosong!',
                    text: 'Silahkan Copy tabel dari Word lalu Paste (Ctrl+V) di kotak yang disediakan.',
                    icon: 'warning',
                    background: '#1e293b',
                    color: '#f8fafc'
                });
                return;
            }

            if(!topik || topik == 'kosong'){
                Swal.fire({
                    title: 'Topik Belum Dipilih',
                    text: 'Silahkan pilih Mata Pelajaran terlebih dahulu di bagian atas halaman.',
                    icon: 'warning',
                    background: '#1e293b',
                    color: '#f8fafc'
                });
                return;
            }

            $("#modal-proses").modal('show');
            
            $.ajax({
                url: "<?php echo site_url('manager/modul_import_word/import'); ?>",
                type: 'POST',
                data: { 
                    topik: topik,
                    'soal_tipe': $('input[name="soal_tipe"]').val(),
                    'import-soal': html 
                },
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if (obj.status == 1) {
                        $('#daftar-soal').html(obj.soal);
                        $('#konfirmasi-import-soal').val(html);
                        $('#konfirmasi-topik').val(topik);
                        $('#konfirmasi-soal-tipe').val(obj.soal_tipe);
                        $('#box-awal').addClass('hide');
                        $('#box-konfirmasi').removeClass('hide');
                        
                        var judul = $('#topik option:selected').text();
                        $('#judul-daftar-soal').html(" : "+judul);

                        Swal.fire({
                            title: 'Parsing Berhasil!',
                            text: 'Tabel sukses dideteksi.',
                            icon: 'success',
                            background: '#1e293b',
                            color: '#f8fafc',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire('Terjadi Kesalahan!', obj.pesan, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    $("#modal-proses").modal('hide');
                    Swal.fire('Error Server!', 'Gagal menghubungi server.', 'error');
                }
            });
        });
		
		/**
         * Submit form import soal
         */
        $('#form-konfirmasi').submit(function(e){
            e.preventDefault();
            
            var topik = $('#konfirmasi-topik').val();
            var soal = $('#konfirmasi-import-soal').val();
            var tipe = $('#konfirmasi-soal-tipe').val();
            
            if(!topik || !soal){
                Swal.fire('Data Hilang', 'Silahkan ulangi proses paste soal.', 'error');
                return false;
            }

            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url($url.'/konfirmasi'); ?>",
                    type:"POST",
                    timeout: 300000,
                    data:{
                        'konfirmasi-topik': topik,
                        'konfirmasi-import-soal': soal,
                        'konfirmasi-soal-tipe': tipe
                    },
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            // Menampilkan modal konfirmasi berhasil import soal
							$("#info-jml-soal").html(obj.counter_soal)
							$("#info-jml-jawaban").html(obj.counter_jawaban)
							$("#modal-sukses").modal('show');
							// Tombol informasi akan me refresh halaman 
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    statusCode: {
                        500: function(respon) {
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('Terjadi kesalahan saat import soal. Silahkan cek terlebih dahulu format yang di upload.'));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal mengimport Soal, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });
		
		
		$('#btn-image-insert').click(function(){
            var image = $('#image-isi').val();
            CKEDITOR.instances.import_soal.insertHtml(image);
            $("#modal-image").modal("hide");
        });
		/**
         * Submit form upload pada image browser
         */
        $('#form-upload-image').submit(function(){
            $('#image-topik-id').val($('#topik').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/upload_file",
                    type:"POST",
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $('#image-preview').html(obj.image);
                            $('#image-isi').val(obj.image_isi);
                            $('#box-preview').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-upload-image").html('');
                            $('#image-file').val('');
                            refresh_table_image();
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-upload-image').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
		
		$('#table-image').DataTable({
                  "bPaginate": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"90px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable_image/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
            });

        // Highlight guide based on type
        var active_tipe = "<?php echo $soal_tipe; ?>";
        if(active_tipe == 1) $('#guide-pg').addClass('guide-highlight');
        if(active_tipe == 6) $('#guide-bs').addClass('guide-highlight');
        if(active_tipe == 5) $('#guide-checklist').addClass('guide-highlight');
        if(active_tipe == 2) $('#guide-essay').addClass('guide-highlight');
        if(active_tipe == 3) $('#guide-singkat').addClass('guide-highlight');
        if(active_tipe == 4) $('#guide-matching').addClass('guide-highlight');
    });

    function unduhTemplate(tipe) {
        var topik_id = $('#topik').val();
        if (!topik_id || topik_id === 'kosong' || topik_id === '') {
            notify_error("Pilih Mata Pelajaran/Topik terlebih dahulu sebelum mengunduh format!");
            return;
        }
        window.location.href = "<?php echo site_url('manager/modul_import_word/download_template/'); ?>" + tipe + "?topik=" + topik_id;
    }
</script>