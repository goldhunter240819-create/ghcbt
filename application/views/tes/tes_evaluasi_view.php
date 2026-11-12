<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Evaluasi Jawaban Essay
		<small>Evaluasi jawaban essay dari user masukkan</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Evaluasi</li>
	</ol>
</section>

<!-- Main content -->
<style>
    #table-jawaban {
        table-layout: fixed !important;
        width: 100% !important;
    }
    #table-jawaban td {
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        white-space: normal !important;
        vertical-align: top !important;
    }
    .answer-wrapper {
        max-width: 100%;
        overflow-x: hidden;
        line-height: 1.6;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Filter Jawaban</div>
                </div><!-- /.box-header -->
                <div class="box-body form-horizontal">
                    <div class="col-xs-2">
                    </div>
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Modul</label>
                            <div class="col-sm-9">
                                <select name="pilih-modul" id="pilih-modul" class="form-control input-sm">
                                    <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tes</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="check" id="check" value="0">
                                <select name="pilih-tes" id="pilih-tes" class="form-control input-sm">
                                    <?php if(!empty($select_tes)){ echo $select_tes; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Urutkan</label>
                            <div class="col-sm-5">
                                <select name="pilih-urutkan" id="pilih-urutkan" onclick="refresh_table()" class="form-control input-sm">
                                    <option value="soal">Soal</option>  
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="box-title">Daftar Jawaban</div>
                    <div class="box-tools pull-right">
                        <button type="button" id="btn-evaluasi-massal" class="btn btn-warning btn-sm" style="font-weight: 600;"><i class="fa fa-magic"></i> Evaluasi AI Massal</button>
                        <button type="button" id="btn-reset-evaluasi" class="btn btn-danger btn-sm" style="font-weight: 600; margin-left: 5px;"><i class="fa fa-undo"></i> Reset Evaluasi (Undo)</button>
                    </div>
				</div><!-- /.box-header -->

                <div class="box-body">
                    <input type="hidden" name="edit-pilihan" id="edit-pilihan">
					<table id="table-jawaban" class="table table-bordered table-hover">
						<thead>
                            <tr>
                                <th>No.</th>
                                <th>Soal</th>
                                <th>Jawaban</th>
                                <th></th>
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

        <div class="modal" id="modal-evaluasi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <?php echo form_open($url.'/simpan_nilai','id="form-nilai"'); ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                        <div id="trx-judul">Evaluasi Jawaban</div>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="box-body">
                                <div id="form-pesan-evaluasi"></div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="hidden" id="evaluasi-testlog-id" name="evaluasi-testlog-id" >
                                    <input type="hidden" id="evaluasi-nilai-min" name="evaluasi-nilai-min" >
                                    <input type="hidden" id="evaluasi-nilai-max" name="evaluasi-nilai-max" >
                                    <input type="text" class="form-control" id="evaluasi-nilai" name="evaluasi-nilai" placeholder="Contoh: 0.8" >
                                    <p class="help-block">Masukkan nilai antara 0.1 sampai 1.0 (Skala 1.0 = Benar Mutlak)</p>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="btn-evaluasi-ai" class="btn btn-success btn-block" style="border-radius: 12px; font-weight: 600; margin-bottom: 15px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                                        <i class="fa fa-magic"></i> Bantu dengan AI (Skala 0.1-1.0)
                                    </button>
                                </div>
                                <div class="form-group">
                                    <label>Rentang Nilai: <b><span id="nilai-min"></span></b> s/d <b><span id="nilai-max"></span></b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-nilai-simpan" class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-jawaban').dataTable().fnReloadAjax();
    }

    function evaluasi(id, nilai_min, nilai_max){
        $("#modal-proses").modal('show');

        $("#nilai-min").html(nilai_min);
        $("#nilai-max").html(nilai_max);

        $("#evaluasi-testlog-id").val(id);
        $("#evaluasi-nilai").val('');
        $("#evaluasi-nilai-min").val(nilai_min);
        $("#evaluasi-nilai-max").val(nilai_max);

        $("#modal-evaluasi").modal("show");
        $("#evaluasi-nilai").focus();
        
        $("#modal-proses").modal('hide');
    }

    function evaluasi_ai_single(tessoal_id){
        $("#btn-ai-"+tessoal_id).html('<i class="fa fa-spinner fa-spin"></i>').addClass('disabled');
        $.ajax({
            url:"<?php echo site_url().'/'.$url; ?>/evaluasi_ai_simpan",
            type:"POST",
            data:{tessoal_id: tessoal_id},
            cache: false,
            success:function(respon){
                var obj = $.parseJSON(respon);
                if(obj.status==1){
                    notify_success("AI Berhasil: "+obj.pesan);
                    refresh_table();
                }else{
                    notify_error(obj.pesan);
                    $("#btn-ai-"+tessoal_id).html('<i class="fa fa-magic"></i> AI').removeClass('disabled');
                }
            },
            error: function(){
                notify_error("Gagal menghubungi server AI.");
                $("#btn-ai-"+tessoal_id).html('<i class="fa fa-magic"></i> AI').removeClass('disabled');
            }
        });
    }

    $(function(){
        $('#pilih-rentang-waktu').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD H:mm'});

        $("#pilih-modul").change(function(){
            var modul = $(this).val();
            $("#modal-proses").modal('show');
            $.getJSON('<?php echo site_url().'/'.$url; ?>/get_ujian_by_modul/'+modul, function(data){
                if(data.data==1){
                    $('#pilih-tes').html(data.select_tes);
                    refresh_table();
                }
                $("#modal-proses").modal('hide');
            }).fail(function() {
                $("#modal-proses").modal('hide');
                notify_error("Gagal mengambil data Ujian.");
            });
        });

        $('#pilih-tes, #pilih-urutkan').change(function(){
            refresh_table();
        });

        $('#btn-evaluasi-ai').click(function(){
            var id = $("#evaluasi-testlog-id").val();
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url().'/'.$url; ?>/evaluasi_ai",
                type: "POST",
                data: { tessoal_id: id },
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if(obj.status == 1){
                        $("#evaluasi-nilai").val(obj.nilai);
                        notify_success(obj.pesan);
                    } else {
                        notify_error(obj.pesan);
                    }
                },
                error: function(){
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal menghubungi server penilaian AI.");
                }
            });
        });

        // Evaluasi AI Massal
        $('#btn-evaluasi-massal').click(function(){
            var tes_id = $('#pilih-tes').val();
            if(!tes_id) {
                notify_error("Pilih Ujian terlebih dahulu");
                return;
            }

            Swal.fire({
                title: 'Evaluasi Massal dengan AI?',
                text: "Sistem akan menilai seluruh jawaban essay yang belum dikoreksi satu persatu secara otomatis. Proses ini mungkin memakan waktu.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Mulai Evaluasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    mulai_evaluasi_massal(tes_id);
                }
            });
        });

        function mulai_evaluasi_massal(tes_id) {
            var modul_id = $('#pilih-modul').val();
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url().'/'.$url; ?>/get_unevaluated",
                type: "POST",
                data: { tes: tes_id, modul: modul_id },
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1 && obj.ids.length > 0){
                        var ids = obj.ids;
                        var total = ids.length;
                        var current = 0;
                        var delay = 5000; // Tingkatkan ke 5 detik (Limit Gemini Free: 15 RPM)
                        
                        Swal.fire({
                            title: 'Mengevaluasi Jawaban...',
                            html: 'Proses <b id="eval-progress">0</b> dari ' + total,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                                proses_satu_satu(ids, current, total, delay);
                            }
                        });
                        
                    } else {
                        $("#modal-proses").modal('hide');
                        Swal.fire('Selesai', 'Tidak ada jawaban essay yang perlu dievaluasi pada ujian ini.', 'info');
                    }
                },
                error: function(){
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal menghubungi server penilaian AI.");
                }
            });
        }

        function proses_satu_satu(ids, current, total, delay) {
            if(current >= total) {
                Swal.fire('Selesai!', total + ' jawaban telah dievaluasi oleh AI.', 'success');
                refresh_table();
                return;
            }

            $('#eval-progress').text((current+1));

            $.ajax({
                url: "<?php echo site_url().'/'.$url; ?>/evaluasi_ai_simpan",
                type: "POST",
                data: { tessoal_id: ids[current] },
                success: function(respon){
                    // Next sequence
                    setTimeout(function() {
                        proses_satu_satu(ids, current+1, total, delay);
                    }, delay);
                },
                error: function(){
                    setTimeout(function() {
                        proses_satu_satu(ids, current+1, total, delay);
                    }, delay);
                }
            });
        }

        $('#form-nilai').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan_nilai",
                    type:"POST",
                    data:$('#form-nilai').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-evaluasi").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        // Reset Evaluasi (Undo)
        $('#btn-reset-evaluasi').click(function(){
            var tes_id = $('#pilih-tes').val();
            var modul_id = $('#pilih-modul').val();

            if(!modul_id && !tes_id) {
                notify_error("Pilih Modul atau Ujian terlebih dahulu");
                return;
            }

            Swal.fire({
                title: 'Reset Evaluasi Essay?',
                text: "Seluruh nilai essay pada filter terpilih akan dihapus dan dikosongkan kembali. Tindakan ini tidak dapat dibatalkan!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Semua Nilai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#modal-proses").modal('show');
                    $.ajax({
                        url: "<?php echo site_url().'/'.$url; ?>/reset_evaluasi",
                        type: "POST",
                        data: { tes: tes_id, modul: modul_id },
                        success: function(respon){
                            var obj = $.parseJSON(respon);
                            $("#modal-proses").modal('hide');
                            if(obj.status == 1){
                                Swal.fire('Berhasil!', obj.pesan, 'success');
                                refresh_table();
                            } else {
                                notify_error(obj.pesan);
                            }
                        },
                        error: function(){
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghubungi server.");
                        }
                    });
                }
            });
        });

        $('#table-jawaban').DataTable({
                  "paging": true,
                  "iDisplayLength":25,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"30px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"40%"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"45%"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"120px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "aLengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes", "value": $('#pilih-tes').val()} );
                    aoData.push( { "name": "modul", "value": $('#pilih-modul').val()} );
                    aoData.push( { "name": "urutkan", "value": $('#pilih-urutkan').val()} );
                  }
         });          
    });
</script>