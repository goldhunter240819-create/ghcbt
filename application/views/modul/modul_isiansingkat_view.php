<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Input Soal Isian Singkat
		<small>Mengelola soal dengan koreksi jawaban otomatis</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Soal Isian Singkat</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="box-header with-border" style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-bolt"></i> Aksi Cepat</h3>
                    <div class="pull-right">
                        <button type="button" onclick="tambah_soal()" class="btn btn-sm btn-primary" style="margin-right: 10px; border-radius: 6px; font-weight: 600;">
                            <i class="fa fa-plus"></i> TAMBAH SOAL MANUAL
                        </button>
                        <a href="<?php echo site_url('manager/modul_import_word/index/3'); ?>" class="btn btn-sm btn-smart-import"><i class="fa fa-magic"></i> SMART IMPORT WORD</a>
                    </div>
                </div>
                <div class="box-body" style="padding: 25px;">
                    <div class="form-group row" style="margin-bottom: 0;">
                        <label class="col-sm-3 control-label" style="font-size: 16px; margin-top: 8px;">Mata Pelajaran</label>
                        <div class="col-sm-9">
                            <select name="topik" id="topik" class="form-control select2" style="width: 100%;">
                                <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo form_open($url.'/simpan','id="form-isiansingkat" class="form-horizontal"'); ?>
            <div class="modal fade" id="modal-edit-soal" role="dialog" data-backdrop="static">
                <div class="modal-dialog modal-lg" style="width: 90%; max-width: 1200px;">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: var(--primary-gradient); color: white; padding: 20px 25px; border-radius: 20px 20px 0 0;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                            <h4 class="modal-title" style="font-weight: 700;"><i class="fa fa-pencil-square-o"></i> <span id="judul-modal">Input Detail Soal Isian Singkat (Manual)</span></h4>
                        </div>
                        
                        <div class="modal-body" style="padding: 30px; max-height: calc(100vh - 200px); overflow-y: auto; background: var(--bg-wrapper);">
                            <div id="form-pesan"></div>
                            <input type="hidden" name="soal_id" id="soal_id">
                            <input type="hidden" name="topik_id" id="topik_id">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pertanyaan</label>
                                <div class="col-sm-10">
                                    <textarea id="soal_text" name="soal_text" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kunci Jawaban</label>
                                <div class="col-sm-10">
                                    <input type="text" id="kunci_text" name="kunci_text" class="form-control" placeholder="Masukkan jawaban singkat yang benar...">
                                    <p class="help-block">Jawaban siswa akan disesuaikan secara otomatis dengan teks ini (Tidak sensitif huruf besar/kecil di sistem).</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bobot Nilai</label>
                                <div class="col-sm-3">
                                    <input type="number" id="bobot" name="bobot" class="form-control" value="1" style="border-radius: 10px;">
                                    <p class="help-block">Bobot nilai jika jawaban benar.</p>
                                </div>
                                <div class="col-sm-7" style="text-align: right;">
                                    <button type="button" id="btn-preview" class="btn btn-info" style="border-radius: 12px; padding: 10px 25px; font-weight: 600;"><i class="fa fa-eye"></i> Tampilkan Preview</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer" style="padding: 15px 30px; background: #f8fafc; border-top: 1px solid var(--border-light); border-radius: 0 0 20px 20px;">
                            <button type="button" id="btn-batal" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 12px; padding: 10px 30px;">Batal</button>
                            <button type="submit" class="btn btn-success btn-lg" style="padding: 12px 50px; border-radius: 15px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;"><i class="fa fa-save"></i> Simpan Soal Isian</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview -->
    <div class="modal fade" id="modal-preview" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 20px 25px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 600;"><i class="fa fa-eye"></i> Preview Tampilan Siswa (Isian Singkat)</h4>
                </div>
                <div class="modal-body" style="padding: 30px; background: #f8fafc;">
                    <div id="student-preview-card" style="background: #ffffff; border-radius: 20px; padding: 25px; border: 1px solid #e2e8f0;">
                        <div id="preview-question" style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 25px; line-height: 1.6;">
                            [Pertanyaan]
                        </div>
                        <div id="preview-input">
                            <input type="text" class="form-control" placeholder="Siswa akan mengetik jawaban singkat di sini..." style="border-radius: 15px; border: 2px solid #e2e8f0; padding: 15px; height: 50px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 15px 25px; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 12px; padding: 8px 25px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0;">
                <div class="box-header with-border" style="padding: 20px;">
                    <h3 class="box-title" style="font-weight: 700; color: #1e293b;">Daftar Soal Isian Singkat</h3>
                </div>
                <div class="box-body" style="padding: 20px;">
                    <table id="table-isiansingkat" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>Pertanyaan</th>
                                <th style="width: 150px; text-align: center;">Kunci</th>
                                <th style="width: 100px; text-align: center;">Bobot</th>
                                <th style="width: 100px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Hapus -->
    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus soal isian singkat ini?</p>
                    <input type="hidden" id="hapus-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-konfirmasi-hapus" class="btn btn-danger" style="background: #f43f5e !important;">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#topik').select2({ placeholder: "-- Pilih Mata Pelajaran --" });
        CKEDITOR.replace('soal_text');

        var table = $('#table-isiansingkat').DataTable({
            "paging": true, "iDisplayLength": 10, "bProcessing": true, "bServerSide": true, "searching": true,
            "sAjaxSource": "<?php echo site_url($url.'/get_datatable'); ?>",
            "autoWidth": false,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "topik", "value": $('#topik').val()});
            }
        });

        $('#topik').change(function() { table.draw(); });

        $('#btn-preview').click(function() {
            var data = CKEDITOR.instances.soal_text.getData();
            $('#preview-question').html(data || '<div class="text-muted">[Pertanyaan belum diisi]</div>');
            $('#modal-preview').modal('show');
        });

        $('#form-isiansingkat').submit(function(e) {
            e.preventDefault();
            $('#topik_id').val($('#topik').val());
            $('#soal_text').val(CKEDITOR.instances.soal_text.getData());
            $("#modal-proses").modal('show');
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if (obj.status == 1) {
                        notify_success(obj.pesan);
                        $('#modal-edit-soal').modal('hide');
                        clearForm();
                        table.draw();
                    } else {
                        $('#form-pesan').html(pesan_err(obj.pesan));
                    }
                }
            });
        });

        function clearForm() {
            $('#soal_id').val('');
            CKEDITOR.instances.soal_text.setData('');
            $('#kunci_text').val('');
            $('#bobot').val('1');
        }

        $('#btn-batal').click(function() { clearForm(); });

        window.tambah_soal = function() {
            var topik_id = $('#topik').val();
            if(!topik_id || topik_id == 'kosong' || topik_id == '') {
                notify_error('Silahkan pilih Mata Pelajaran terlebih dahulu!');
                return;
            }
            clearForm();
            $('#judul-modal').text('Input Detail Soal Isian Singkat (Manual)');
            $('#modal-edit-soal').modal('show');
        };

        window.edit = function(id) {
            $("#modal-proses").modal('show');
            $.getJSON("<?php echo site_url($url.'/get_by_id/'); ?>" + id, function(data) {
                $("#modal-proses").modal('hide');
                if (data.data == 1) {
                    clearForm();
                    $('#topik').val(data.id_topik).trigger('change');
                    $('#soal_id').val(data.id);
                    $('#kunci_text').val(data.kunci);
                    $('#bobot').val(data.bobot);

                    $('#judul-modal').text('Edit Detail Soal Isian Singkat (Manual)');
                    $('#modal-edit-soal').modal('show');

                    setTimeout(function() {
                        CKEDITOR.instances.soal_text.setData(data.soal);
                    }, 300);
                }
            });
        };

        window.hapus = function(id) {
            $('#hapus-id').val(id);
            $('#modal-hapus').modal('show');
        };

        $('#btn-konfirmasi-hapus').click(function() {
            var id = $('#hapus-id').val();
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url($url.'/hapus_soal'); ?>",
                type: "POST", data: { 'hapus-id': id },
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    $('#modal-hapus').modal('hide');
                    if (obj.status == 1) {
                        notify_success(obj.pesan);
                        table.draw();
                    } else {
                        notify_error(obj.pesan);
                    }
                }
            });
        });
    });
</script>
