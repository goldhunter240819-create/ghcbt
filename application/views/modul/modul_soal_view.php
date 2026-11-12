<?php
$title_soal = '';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Mengelola Soal
		<small>Mengelola soal berdasarkan mata pelajaran</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Soal</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="box-header with-border" style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div class="box-title" style="font-weight: 700; font-size: 16px;"><i class="fa fa-pencil-square-o text-primary"></i> Input & Kelola Bank Soal</div>
                    <div class="pull-right" style="display: flex; gap: 6px; flex-wrap: wrap; align-items: center;">
                        <button type="button" onclick="tambah_soal(1)" class="btn btn-sm btn-primary" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-plus-circle"></i> + PG
                        </button>
                        <button type="button" onclick="tambah_soal(5)" class="btn btn-sm btn-success" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-check-square-o"></i> + Checklist
                        </button>
                        <button type="button" onclick="tambah_soal(6)" class="btn btn-sm" style="background: #7c3aed; color: #fff; border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-toggle-on"></i> + B/S
                        </button>
                        <button type="button" onclick="tambah_soal(2)" class="btn btn-sm btn-warning" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-pencil"></i> + Esai
                        </button>
                        <button type="button" onclick="tambah_soal(4)" class="btn btn-sm btn-info" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-exchange"></i> + Menjodohkan
                        </button>
                        <button type="button" onclick="tambah_soal(3)" class="btn btn-sm btn-danger" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-font"></i> + Isian Singkat
                        </button>
                        <a href="<?php echo site_url('manager/modul_import_word/index/1'); ?>" class="btn btn-sm btn-smart-import" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-magic"></i> Smart Import
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body" style="padding: 20px 25px;">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-weight: 700; color: var(--text-bright); margin-bottom: 8px;"><i class="fa fa-book"></i> Pilih Mata Pelajaran (Topik)</label>
                                <select name="topik" id="topik" class="form-control select2" style="width: 100%;">
                                    <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="background: rgba(var(--primary-rgb), 0.03); border-top: 1px solid var(--border-light); padding: 12px 25px;">
                    <p style="margin: 0; color: var(--text-muted); font-size: 13px;"><i class="fa fa-info-circle text-primary"></i> Pilih terlebih dahulu Mata Pelajaran yang akan digunakan sebelum menambah atau mengubah soal.</p>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-12">
    <div class="modal fade" id="modal-edit-soal" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" style="width: 90%; max-width: 1200px;">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <?php echo form_open_multipart($url.'/tambah','id="form-tambah" class="form-horizontal"'); ?>
                <div class="modal-header" style="background: var(--primary-gradient); color: white; padding: 20px 25px; border-radius: 20px 20px 0 0;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 700;"><i class="fa fa-pencil-square-o"></i> <span id="judul-modal">Mengelola Soal (Manual)</span></h4>
                </div>
                
                <div class="modal-body" style="padding: 30px; max-height: calc(100vh - 200px); overflow-y: auto; background: var(--bg-wrapper);">
                    <div id="form-pesan"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Soal</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="tambah-topik-id" id="tambah-topik-id" >
                            <input type="hidden" name="tambah-soal-id" id="tambah-soal-id" >
                            <input type="hidden" name="tambah-soal" id="tambah-soal" >
                            <textarea class="textarea" id="tambah_soal" name="tambah_soal" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            <p class="help-block">File gambar dapat di copy langsung atau di upload terlebih dahulu. File gambar yang didukung adalah jpg dan png.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">File Audio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" id="tambah-nama-audio" name="tambah-nama-audio" readonly>
                        </div>
                        <div class="col-sm-4">
                            <input type="file" id="tambah-audio" name="tambah-audio" >
                            <p class="help-block">File audio yang akan ditambah pada soal. ( mp3). Jika ingin menghapus audio pada soal, maka Soalnya harus dihapus dahulu, setelah itu membuat soal ulang.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Putar Sekali</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="tambah-putar" name="tambah-putar">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <p class="help-block">Memutar Audio sebanyak satu kali dalam satu Tes</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipe Soal</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="tambah-tipe" name="tambah-tipe">
                                <option value="1">Pilihan Ganda</option>
                                <option value="5">Checklist / Jawaban Kompleks</option>
                                <option value="6">Benar / Salah</option>
                                <option value="2">Esai (AI)</option>
                                <option value="4">Menjodohkan</option>
                                <option value="3">Jawaban Singkat</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Tingkat Kesulitan</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="tambah-kesulitan" name="tambah-kesulitan">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group hide" id="form-tambah-jawaban">
                        <label class="col-sm-2 control-label">Kunci Jawaban Singkat</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" id="tambah-kunci-jawaban-singkat" name="tambah-kunci-jawaban-singkat" >
                            <p class="help-block">
                                Kunci Jawaban untuk Tipe Soal Jawaban Singkat.<br />
                                Pastikan kunci jawaban hanya satu kata untuk menghindari kesalahan penulisan. Untuk angka desimal gunakan tanda koma.
                            </p>
                        </div>
                    </div>
                    <div class="form-group hide" id="form-tambah-benar-salah">
                        <label class="col-sm-2 control-label">Kunci Jawaban</label>
                        <div class="col-sm-4">
                            <select class="form-control input-sm" id="tambah-kunci-benar-salah" name="tambah-kunci-benar-salah">
                                <option value="1">Benar</option>
                                <option value="0">Salah</option>
                            </select>
                            <p class="help-block">Tentukan apakah isi pernyataan soal bernilai Benar atau Salah.</p>
                        </div>
                    </div>
                    <?php if(!empty($info_tambahan)) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="callout callout-info" style="margin-bottom: 0;">
                                <i class="fa fa-info-circle"></i> <?php echo $info_tambahan; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="modal-footer" style="padding: 15px 30px; background: #f8fafc; border-top: 1px solid var(--border-light); border-radius: 0 0 20px 20px;">
                    <button type="button" id="btn-tambah-batal" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 12px; padding: 10px 30px;">Batal</button>
                    <button type="submit" id="btn-tambah-simpan" class="btn btn-primary btn-lg" style="border-radius: 12px; padding: 10px 30px;"><i class="fa fa-save"></i> <span id="judul-tambah-simpan">Simpan</span></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-floating);">
                <div class="box-header with-border" style="padding: 18px 25px; background: rgba(var(--primary-rgb), 0.02); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div class="box-title" style="font-weight: 700; font-size: 16px; color: var(--text-bright);"><i class="fa fa-list-alt text-primary"></i> Daftar Soal: <span id="judul-daftar-soal" style="color: var(--accent-color);"></span></div>
                    <div class="box-tools pull-right" style="display: flex; gap: 10px; align-items: center;">
                        <button type="button" class="btn btn-info btn-sm" onclick="preview_semua()" style="border-radius: 8px; font-weight: 600; box-shadow: 0 4px 10px rgba(14, 165, 233, 0.2);"><i class="fa fa-desktop"></i> Preview Semua Soal (Siswa)</button>
                        <button type="button" class="btn btn-default btn-sm" onclick="refresh_table()" style="border-radius: 8px; font-weight: 600;"><i class="fa fa-refresh"></i> Refresh Data</button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body" style="padding: 20px 25px;">
                    <table id="table-soal" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr style="background: var(--bg-body);">
                                <th style="width: 50px; text-align: center;">No.</th>
                                <th>Konten Soal</th>
                                <th style="width: 140px; text-align: center;">Jumlah Jawaban</th>
                                <th style="width: 160px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

    <div class="modal" id="modal-hapus-soal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hapus_soal','id="form-hapus-soal"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Hapus Soal</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-hapus"></div>
                            <div class="form-group">
                                <label>Soal</label>
                                <input type="hidden" name="hapus-id" id="hapus-id">
                                <div id="hapus-soal"  style="max-height: 250px;overflow: auto;"></div>
                            </div>
                            <p>Perhatian, soal yang dihapus akan membuat daftar jawaban ikut terhapus.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-hapus-soal" class="btn btn-primary">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }

    function refresh_table_image(){
        $('#table-image').dataTable().fnReloadAjax();
    }
	
	function refresh_topik(){
        var judul = $('#topik option:selected').text();
        $('#judul-daftar-soal').html(judul);
        $('#judul-tambah-soal').html(judul);
	}

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $("#form-pesan").html('');
                $('#tambah-soal').val('');
                
                $('#tambah-tipe').val(data.tipe);
                $('#tambah-topik-id').val(data.id_topik);
                $('#tambah-soal-id').val(data.id);
                $('#tambah-putar').val(data.putar);
                $('#tambah-audio').val('');
				$('#tambah-kesulitan').val(data.kesulitan);
                $('#tambah-nama-audio').val(data.audio);
                $('#topik').val(data.id_topik).trigger('change');
                if(data.tipe==3){
                    $('#form-tambah-jawaban').removeClass('hide');
                    $('#form-tambah-benar-salah').addClass('hide');
                    $('#tambah-kunci-jawaban-singkat').val(data.kunci);
                } else if(data.tipe==6){
                    $('#form-tambah-benar-salah').removeClass('hide');
                    $('#form-tambah-jawaban').addClass('hide');
                    $('#tambah-kunci-benar-salah').val(data.kunci_tf);
                } else {
                    $('#form-tambah-jawaban').addClass('hide');
                    $('#form-tambah-benar-salah').addClass('hide');
                }

                $('#judul-modal').text('Edit Mengelola Soal (Manual)');
                $('#modal-edit-soal').modal('show');

                setTimeout(function() {
                    CKEDITOR.instances.tambah_soal.setData(data.soal);
                }, 300);
            }
            $("#modal-proses").modal('hide');
        });
    }

    function tambah_soal(tipe){
        var topik_id = $('#topik').val();
        if(!topik_id || topik_id == 'kosong' || topik_id == '') {
            notify_error('Silahkan pilih Mata Pelajaran terlebih dahulu!');
            return;
        }
        batal_tambah();
        if(tipe){
            $('#tambah-tipe').val(tipe).trigger('change');
        }
        var namaTipe = $('#tambah-tipe option:selected').text();
        $('#judul-modal').text('Input Soal: ' + namaTipe);
        $('#modal-edit-soal').modal('show');
    }

    function hapus(id){
        $('#hapus-id').val('');
        $('#hapus-soal').html('');
        $('#form-pesan-hapus').html('');
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#hapus-id').val(data.id);
                $('#hapus-soal').html(data.soal);
                
				$("#modal-proses").modal('hide');
                $("#modal-hapus-soal").modal("show");
            }else{
				$("#modal-proses").modal('hide');
			}
        });
    }

    function jawaban(id){
        window.open('<?php echo site_url(); ?>/manager/modul_jawaban/index/'+id);
    }

    function matching(id){
        window.open('<?php echo site_url(); ?>/manager/modul_matching/index/'+id);
    }

    function preview_semua(){
        var topik_id = $('#topik').val();
        if(!topik_id || topik_id == 'kosong'){
            notify_error('Silakan pilih Mata Pelajaran terlebih dahulu!');
            return;
        }

        $("#modal-proses").modal('show');
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/get_preview_all/" + topik_id,
            type: "GET",
            cache: false,
            success: function(respon){
                var data = $.parseJSON(respon);
                if(data.status == 1){
                    $('#preview-soal-body').html(data.html);
                    $('#modal-preview-soal').modal('show');
                } else {
                    notify_error(data.pesan || 'Gagal mengambil data preview.');
                }
                $("#modal-proses").modal('hide');
            },
            error: function(){
                $("#modal-proses").modal('hide');
                notify_error('Kesalahan koneksi ke server.');
            }
        });
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

    function image_preview(posisi, image){
        $('#image-preview').html('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-height: 110px;" />');
        $('#image-isi').val('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-width: 600px;" />');
        $('#box-preview').removeClass('hide');
    }

    function batal_tambah(){
        $("#form-pesan").html('');
        $('#tambah-topik-id').val('');
        $('#tambah-soal-id').val('');
        $('#tambah-soal').val('');
        $('#tambah-putar').val('0');
        $('#tambah-audio').val('');
        $('#tambah-nama-audio').val('');
        if($('#tipe_soal_filter').val() != ""){
            $('#tambah-tipe').val($('#tipe_soal_filter').val());
        } else {
            $('#tambah-tipe').val('1');
        }
		$('#tambah-kesulitan').val('1');
        $('#tambah-kunci-jawaban-singkat').val('');
        $('#tambah-kunci-benar-salah').val('1');
        $('#form-tambah-jawaban').addClass('hide');
        $('#form-tambah-benar-salah').addClass('hide');

        CKEDITOR.instances.tambah_soal.setData('');
    }

    $(function(){
        $('#topik').select2();
        
        $("#topik").change(function(){
            refresh_topik();
            refresh_table();
        });

        $('#tambah-audio').change(function(e){
            var fileName = e. target. files[0]. name;
            $('#tambah-nama-audio').val(fileName);
        });

        $('#btn-image-insert').click(function(){
            var image = $('#image-isi').val();
            CKEDITOR.instances.tambah_soal.insertHtml(image);
            $("#modal-image").modal("hide");
        });

        $('#tambah-tipe').change(function(e){
            var tipe = $('#tambah-tipe').val();

            if(tipe==3){
                $('#form-tambah-jawaban').removeClass('hide');
                $('#form-tambah-benar-salah').addClass('hide');
            }else if(tipe==6){
                $('#form-tambah-benar-salah').removeClass('hide');
                $('#form-tambah-jawaban').addClass('hide');
            }else{
                $('#form-tambah-jawaban').addClass('hide');
                $('#form-tambah-benar-salah').addClass('hide');
            }
        });

        $('#btn-tambah-batal').click(function(){
            batal_tambah();
        });

        /**
         * Submit form tambah soal
         */
        $('#form-tambah').submit(function(){
            $('#tambah-soal').val(CKEDITOR.instances.tambah_soal.getData());
            $('#tambah-topik-id').val($('#topik').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    timeout: 60000,
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $('#modal-edit-soal').modal('hide');
                            batal_tambah();
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyimpan Soal, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form hapus soal
         */
        $('#form-hapus-soal').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_soal",
                    type:"POST",
                    data:$('#form-hapus-soal').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-hapus").html('');
                            $("#modal-hapus-soal").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
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
                            refresh_table();
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
		 
		$( document ).ready(function() {
            refresh_topik();
            $('#table-soal').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
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
                    aoData.push( { "name": "tipe", "value": $('#tipe_soal_filter').val()} );
                  }
            });

            CKEDITOR.replace('tambah_soal');


            <?php if(!empty($data_soal)){ echo $data_soal; } ?>
		});
    });
</script>