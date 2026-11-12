<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Daftar Soal
		<small>Daftar soal dan jawaban berdasarkan Modul dan Mata Pelajaran</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Daftar Soal</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Pilih Mata Pelajaran</div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <!-- Filter Mata Pelajaran -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-book"></i> Pilih Mata Pelajaran</label>
                                <div id="data-topik">
                                    <select name="topik" id="topik" class="form-control select2">
                                        <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Filter Tipe Soal -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-tags"></i> Pilih Tipe Soal</label>
                                <select name="tipe" id="tipe" class="form-control select2">
                                    <option value="">-- Semua Tipe Soal --</option>
                                    <option value="1">Pilihan Ganda</option>
                                    <option value="5">Checklist</option>
                                    <option value="6">Benar / Salah</option>
                                    <option value="2">Essay (AI)</option>
                                    <option value="4">Menjodohkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="background: #f8fafc; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                    <p class="text-muted"><i class="fa fa-info-circle"></i> Gunakan filter di atas untuk menemukan soal dengan cepat. Filter <b>Mata Pelajaran</b> akan menyesuaikan jika Anda memilih <b>Kelas</b> tertentu.</p>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
    					<div class="box-title">Daftar Soal <span id="judul-daftar-soal"></span></div>
                        <div class="box-tools pull-right">
                            <div class="dropdown pull-right">
                                <a style="cursor: pointer;" onclick="cetak_soal()">Cetak Daftar Soal</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="row" style="margin-bottom: 30px;">
                            <!-- PG -->
                            <div class="col-md-2" style="width: 20%;">
                                <div class="stat-card card-pg">
                                    <div class="stat-icon"><i class="fa fa-list-ul"></i></div>
                                    <div class="stat-content">
                                        <div class="stat-number" id="stat-pg">0</div>
                                        <div class="stat-label">Pilihan Ganda</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checklist -->
                            <div class="col-md-2" style="width: 20%;">
                                <div class="stat-card card-checklist">
                                    <div class="stat-icon"><i class="fa fa-check-square-o"></i></div>
                                    <div class="stat-content">
                                        <div class="stat-number" id="stat-checklist">0</div>
                                        <div class="stat-label">Checklist</div>
                                    </div>
                                </div>
                            </div>
                            <!-- True/False -->
                            <div class="col-md-2" style="width: 20%;">
                                <div class="stat-card card-tf">
                                    <div class="stat-icon"><i class="fa fa-adjust"></i></div>
                                    <div class="stat-content">
                                        <div class="stat-number" id="stat-tf">0</div>
                                        <div class="stat-label">Benar / Salah</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Essay -->
                            <div class="col-md-2" style="width: 20%;">
                                <div class="stat-card card-essay">
                                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                                    <div class="stat-content">
                                        <div class="stat-number" id="stat-essay">0</div>
                                        <div class="stat-label">Essay (AI)</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Matching -->
                            <div class="col-md-2" style="width: 20%;">
                                <div class="stat-card card-matching">
                                    <div class="stat-icon"><i class="fa fa-clone"></i></div>
                                    <div class="stat-content">
                                        <div class="stat-number" id="stat-matching">0</div>
                                        <div class="stat-label">Menjodohkan</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .stat-card {
                                border-radius: 20px;
                                padding: 20px;
                                display: flex;
                                align-items: center;
                                color: white;
                                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                                height: 100px;
                                position: relative;
                                overflow: hidden;
                            }
                            .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
                            
                            .card-pg { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
                            .card-checklist { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
                            .card-tf { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
                            .card-essay { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
                            .card-matching { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

                            .stat-icon { font-size: 36px; opacity: 0.2; position: absolute; right: -5px; bottom: -10px; transform: rotate(-15deg); }
                            .stat-content { z-index: 1; }
                            .stat-number { font-size: 28px; font-weight: 800; line-height: 1; margin-bottom: 5px; }
                            .stat-label { font-size: 13px; font-weight: 600; opacity: 0.9; }
                        </style>
                        <table id="table-soal" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No.</th>
                                    <th style="width: 100px; text-align: center;">Tipe Soal</th>
                                    <th>Isi Pertanyaan</th>
                                    <th style="width: 150px;">Ringkasan Jawaban</th>
                                    <th style="width: 130px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">Sedang memuat data...</td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="modal-hapus-soal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus soal ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <input type="hidden" id="hapus-soal-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="konfirmasi_hapus_soal()" class="btn btn-danger" style="background: #f43f5e !important;">Hapus Permanen</button>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
        update_statistik();
    }

    function update_statistik(){
        var topik_id = $('#topik').val();
        $.ajax({
            url: "<?php echo site_url(); ?>/manager/modul_daftar/get_statistik_soal/"+topik_id,
            type: "GET",
            success: function(respon){
                var obj = $.parseJSON(respon);
                $('#stat-pg').html(obj.pg);
                $('#stat-checklist').html(obj.checklist);
                $('#stat-tf').html(obj.tf);
                $('#stat-essay').html(obj.essay);
                $('#stat-matching').html(obj.matching);
            }
        });
    }

    function hapus_soal(id){
        $('#hapus-soal-id').val(id);
        $('#modal-hapus-soal').modal('show');
    }

    function konfirmasi_hapus_soal(){
        var id = $('#hapus-soal-id').val();
        $("#modal-proses").modal('show');
        $.ajax({
            url: "<?php echo site_url(); ?>/manager/modul_pilihanganda/hapus_soal",
            type: "POST",
            data: { 'hapus-id': id },
            success: function(respon){
                var obj = $.parseJSON(respon);
                $("#modal-proses").modal('hide');
                $('#modal-hapus-soal').modal('hide');
                if(obj.status == 1){
                    notify_success(obj.pesan);
                    refresh_table();
                } else {
                    notify_error(obj.pesan);
                }
            }
        });
    }

    function cetak_soal(){
        var topik_id = $('#topik').val();
        window.open('<?php echo site_url(); ?>/manager/modul_daftar/cetak_soal/'+topik_id,'_blank');
    }

    function refresh_topik(){
        var judul = $('#topik option:selected').text();
        $('#judul-daftar-soal').html(' - ' + judul);
    }

    $(function(){
        $('#topik').select2();
        $('#grup').select2();
        $('#tipe').select2();
        
        $("#topik").change(function(){
            refresh_table();
            refresh_topik();
        });

        $("#grup").change(function(){
            var id = $(this).val();
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url(); ?>/manager/modul_daftar/get_topik_by_grup/"+id,
                type: "GET",
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    $("#modal-proses").modal('hide');
                    if(obj.data==1){
                        $('#topik').html(obj.select);
                        $('#topik').trigger('change');
                    }else{
                        $('#topik').html('<option value="">-- Tidak Ada Mata Pelajaran --</option>');
                        $('#topik').trigger('change');
                    }
                }
            });
        });

        $("#tipe").change(function(){
            refresh_table();
        });

        $('#table-soal').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": true,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false},
    					{"bSearchable": true, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                    aoData.push( { "name": "tipe", "value": $('#tipe').val()} );
                  }
         });
		 
		$( document ).ready(function() {
			refresh_topik();
            update_statistik();
		});
    });
</script>