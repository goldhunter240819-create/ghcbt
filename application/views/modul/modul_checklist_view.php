<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Input Soal Checklist
		<small>Mengelola soal dengan jawaban lebih dari satu</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Soal Checklist</li>
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
                        <a href="<?php echo site_url('manager/modul_import_word/index/5'); ?>" class="btn btn-sm btn-smart-import"><i class="fa fa-magic"></i> SMART IMPORT WORD</a>
                    </div>
                </div>
                <div class="box-body" style="padding: 25px;">
                    <div class="form-group row">
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
            <?php echo form_open($url.'/simpan','id="form-checklist" class="form-horizontal"'); ?>
            <div class="modal fade" id="modal-edit-soal" role="dialog" data-backdrop="static">
                <div class="modal-dialog modal-lg" style="width: 90%; max-width: 1200px;">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: var(--primary-gradient); color: white; padding: 20px 25px; border-radius: 20px 20px 0 0;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                            <h4 class="modal-title" style="font-weight: 700;"><i class="fa fa-pencil-square-o"></i> <span id="judul-modal">Input Detail Soal Checklist (Manual)</span></h4>
                        </div>
                        
                        <div class="modal-body" style="padding: 30px; max-height: calc(100vh - 200px); overflow-y: auto; background: var(--bg-wrapper);">
                            <div id="form-pesan"></div>
                            <input type="hidden" name="soal_id" id="soal_id">
                            <input type="hidden" name="topik_id" id="topik_id">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pertanyaan</label>
                                <div class="col-sm-10">
                                    <textarea id="soal_text" name="soal_text" class="form-control"></textarea>
                                    <p class="help-block">Tuliskan pertanyaan Anda di sini. Gunakan editor untuk menambahkan gambar jika diperlukan.</p>
                                </div>
                            </div>

                            <hr style="border-top: 1px solid var(--border-light); margin: 30px 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                <h4 style="margin: 0; font-weight: 600; color: var(--text-bright); padding-left: 15px;">Pilihan Jawaban & Kunci</h4>
                                <button type="button" id="btn-preview" class="btn btn-info" style="border-radius: 12px; padding: 8px 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(14, 165, 233, 0.2);"><i class="fa fa-eye"></i> Tampilkan Preview Soal</button>
                            </div>
                            
                            <?php 
                            $labels = ['A', 'B', 'C', 'D', 'E'];
                            foreach($labels as $l): 
                            ?>
                            <div class="form-group opsi-row" style="margin-bottom: 15px; background: var(--bg-body); padding: 15px; border-radius: 16px; margin-left: 0; margin-right: 0; border: 1px solid var(--border-light);">
                                <label class="col-sm-2 control-label">Jawaban <?php echo $l; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="opsi[<?php echo $l; ?>]" id="opsi_<?php echo $l; ?>" class="form-control opsi-input" data-label="<?php echo $l; ?>" placeholder="Teks jawaban <?php echo $l; ?>...">
                                    <div class="status-toggle-group" style="display: flex; gap: 10px; margin-top: 10px;">
                                        <button type="button" class="btn-status-toggle btn btn-default active" data-value="0" data-target="status_<?php echo $l; ?>" style="flex: 1; border: 1px solid var(--border-light) !important; font-weight: 600;">Salah</button>
                                        <button type="button" class="btn-status-toggle btn btn-default" data-value="1" data-target="status_<?php echo $l; ?>" style="flex: 1; border: 1px solid var(--border-light) !important; font-weight: 600;">Benar</button>
                                        <input type="hidden" name="status[<?php echo $l; ?>]" id="status_<?php echo $l; ?>" value="0">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="modal-footer" style="padding: 15px 30px; background: #f8fafc; border-top: 1px solid var(--border-light); border-radius: 0 0 20px 20px;">
                            <button type="button" id="btn-batal" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 12px; padding: 10px 30px;">Batal</button>
                            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 12px; padding: 10px 30px;"><i class="fa fa-save"></i> Simpan Soal Checklist</button>
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
                <div class="modal-header" style="background: var(--primary-gradient); color: white; border: none; padding: 20px 25px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 600; font-size: 18px;"><i class="fa fa-eye"></i> Preview Tampilan Siswa</h4>
                </div>
                <div class="modal-body" style="padding: 30px; background: #f8fafc;">
                    <div id="student-preview-card" style="background: #ffffff; border-radius: 20px; padding: 25px; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                        <div id="preview-question" style="font-size: 16px; font-weight: 600; color: #1e293b; margin-bottom: 25px; line-height: 1.6;">
                            [Pertanyaan]
                        </div>
                        <div id="preview-options">
                            <!-- Options go here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #ffffff; border-top: 1px solid var(--border-light); padding: 15px 25px;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="border-radius: 12px; padding: 8px 25px;">Tutup Preview</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles for Preview -->
    <style>
        #preview-question img { max-width: 100%; height: auto; border-radius: 12px; margin: 15px 0; border: 1px solid var(--border-light); }
        .opsi-checklist-preview {
            margin: 12px 0;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .opsi-checklist-preview:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(5px);
        }
        .opsi-checklist-preview input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 18px;
            accent-color: #0ea5e9;
        }
        .opsi-checklist-preview label {
            margin: 0;
            width: 100%;
            font-weight: 500;
            color: #334155;
            font-size: 15px;
            cursor: pointer;
        }
        .opsi-checklist-preview:has(input:checked) {
            background: #f0f9ff;
            border-color: #bae6fd;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
        }
        .opsi-checklist-preview:has(input:checked) label {
            color: #0ea5e9;
        }
        .btn-status-toggle.active[data-value="1"] {
            background: #10b981 !important;
            color: white !important;
            border-color: #10b981 !important;
        }
        .btn-status-toggle.active[data-value="0"] {
            background: #f43f5e !important;
            color: white !important;
            border-color: #f43f5e !important;
        }
    </style>




    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-light);">
                <div class="box-header with-border" style="padding: 20px;">
                    <h3 class="box-title" style="font-weight: 700; color: var(--text-bright);">Daftar Soal Checklist</h3>
                </div>
                <div class="box-body" style="padding: 20px;">
                    <table id="table-checklist" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr style="background: var(--bg-body);">
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>Pertanyaan</th>
                                <th style="width: 120px; text-align: center;">Jml Opsi</th>
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
                <div class="modal-header" style="background: var(--bg-body);">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 16px;">Apakah Anda yakin ingin menghapus soal ini?</p>
                    <input type="hidden" id="hapus-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-konfirmasi-hapus" class="btn btn-danger" style="background: #f43f5e !important;">Hapus Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Initialization
        $('#topik').select2({
            placeholder: "-- Pilih Mata Pelajaran --"
        });
        
        CKEDITOR.replace('soal_text');
        
        // Manual Preview Logic
        $('#btn-preview').click(function() {
            var data = CKEDITOR.instances.soal_text.getData();
            $('#preview-question').html(data || '<div class="text-muted">[Pertanyaan belum diisi]</div>');
            updatePreviewOptions();
            $('#modal-preview').modal('show');
        });

        function updatePreviewOptions() {
            var html = '';
            var count = 0;
            $('.opsi-input').each(function() {
                var val = $(this).val();
                if (val.trim() !== '') {
                    var id = 'pc-' + count;
                    html += '<div class="opsi-checklist-preview"><input type="checkbox" id="' + id + '"> <label for="' + id + '">' + val + '</label></div>';
                    count++;
                }
            });
            if (html === '') html = '<div class="preview-item text-muted" style="padding:10px;">[Belum ada pilihan jawaban]</div>';
            $('#preview-options').html(html);
        }

        // Status Toggle Logic (Benar/Salah)
        $('.btn-status-toggle').click(function() {
            var targetId = $(this).data('target');
            var value = $(this).data('value');
            
            // Reset active state in group
            $('[data-target="' + targetId + '"]').removeClass('active btn-success btn-danger').addClass('btn-default');
            
            // Set current active
            $(this).addClass('active');
            $('#' + targetId).val(value);
        });

        var table = $('#table-checklist').DataTable({
            "paging": true,
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "searching": true,
            "sAjaxSource": "<?php echo site_url($url.'/get_datatable'); ?>",
            "autoWidth": false,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "topik", "value": $('#topik').val()});
            }
        });

        $('#topik').change(function() {
            table.draw();
        });

        $('#btn-batal').click(function() {
            clearForm();
        });

        function clearForm() {
            $('#soal_id').val('');
            CKEDITOR.instances.soal_text.setData('');
            $('input[type="text"]').val('');
            $('.btn-status-toggle').removeClass('active');
            $('.btn-status-toggle[data-value="0"]').addClass('active');
            $('input[type="hidden"][id^="status_"]').val('0');
            $('#preview-question').html('[Klik tombol Preview untuk melihat]');
            $('#preview-options').html('<div class="preview-item">[Pilihan jawaban akan muncul di sini]</div>');
        }

        $('#form-checklist').submit(function(e) {
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

        window.tambah_soal = function() {
            var topik_id = $('#topik').val();
            if(!topik_id || topik_id == 'kosong' || topik_id == '') {
                notify_error('Silahkan pilih Mata Pelajaran terlebih dahulu!');
                return;
            }
            clearForm();
            $('#judul-modal').text('Input Detail Soal Checklist (Manual)');
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
                    
                    var labels = ['A', 'B', 'C', 'D', 'E'];
                    $.each(data.jawaban, function(index, j) {
                        if (index < 5) {
                            var l = labels[index];
                            $('#opsi_' + l).val(j.jawaban_detail);
                            var val = j.jawaban_benar;
                            $('#status_' + l).val(val);
                            
                            // Update toggle buttons
                            $('[data-target="status_' + l + '"]').removeClass('active');
                            $('[data-target="status_' + l + '"][data-value="' + val + '"]').addClass('active');
                        }
                    });
                    
                    $('#preview-question').html(data.soal);
                    updatePreviewOptions();

                    $('#judul-modal').text('Edit Detail Soal Checklist (Manual)');
                    $('#modal-edit-soal').modal('show');

                    setTimeout(function() {
                        CKEDITOR.instances.soal_text.setData(data.soal);
                    }, 300);
                }
            });
        };

        // Hapus function
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

        // Auto-edit from URL hash
        setTimeout(function() {
            var hash = window.location.hash;
            if(hash.indexOf('#edit-') !== -1){
                var id = hash.replace('#edit-', '');
                if(id) edit(id);
            }
        }, 500);
    });
</script>
