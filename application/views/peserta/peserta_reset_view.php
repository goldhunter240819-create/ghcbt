<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Reset Login Siswa
		<small>Digunakan untuk melakukan Reset Login Siswa jika fasilitas membatasi Login Siswa diaktifkan</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Reset Login</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-3">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-title">Pilih Kelas</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group">
							<div class="callout callout-info">
								<p>Halaman ini memonitor status live seluruh siswa di kelas. <span class="label label-success">Online</span> berarti aktif, <span class="label label-danger">Offline</span> berarti belum masuk, dan <span class="label label-warning">Pending</span> berarti keluar tanpa logout.</p>
							</div>
                            <label>Kelas</label>
                            <div id="data-kelas">
                                <select name="group" id="group" class="form-control input-sm">
                                    <option value="semua">Semua Kelas</option>
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <p>Pilih kelas terlebih dahulu untuk menampilkan data siswa yang masih login</p>
                    </div>
                </div>
        </div>

        <div class="col-md-9">
                <div class="box">
                    <div class="box-header with-border">
						<div class="box-title">Monitor Status Peserta & Reset</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <?php echo form_open($url.'/reset_daftar_peserta','id="form-reset"'); ?>
                        <input type="hidden" name="check" id="check" value="0">
                        <table id="table-siswa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th class="all">Nama</th>
                                    <th>Kelas</th>
									<th>Status Live</th>
                                    <th class="all">Aksi</th>
                                    <th class="all">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>  
                        </form>                      
                    </div>
                    <div class="box-footer">
                        <button type="button" id="btn-edit-reset" class="btn btn-primary" title="Reset Siswa yang dipilih">Reset</button>
                        <button type="button" id="btn-edit-pilih" class="btn btn-default pull-right">Pilih Semua</button>
                    </div>
                </div>
        </div>
    </div>

    <div style="overflow-y:auto;" class="modal" id="modal-reset" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Reset Login</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <strong>Peringatan</strong>
                            Data Siswa yang sudah dipilih akan direset.
                            <br /><br />
                            Apakah anda yakin untuk mereset login Siswa?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-reset" class="btn btn-primary pull-left">Reset</button>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
	
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-siswa').dataTable().fnReloadAjax();
    }

    function reset_individu(user_id, nama) {
        Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mereset login untuk ' + nama + '?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!'
        }).then((result) => {
            if (result.isConfirmed) {
                var payload = {};
                payload["edit-user-id[" + user_id + "]"] = "on";

                $("#modal-proses").modal('show');
                $.ajax({
                    url: "<?php echo site_url().'/'.$url; ?>/reset_daftar_peserta",
                    type: "POST",
                    data: payload,
                    cache: false,
                    success: function(respon) {
                        var obj = $.parseJSON(respon);
                        if (obj.status == 1) {
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            Swal.fire('Berhasil!', obj.pesan, 'success');
                        } else {
                            $("#modal-proses").modal('hide');
                            Swal.fire('Gagal!', obj.pesan, 'error');
                        }
                    }
                });
            }
        });
    }

    $(function(){
        // Auto refresh setiap 5 detik
        setInterval(function() {
            if ($('input[type="checkbox"]:checked').length === 0 && !Swal.isVisible()) {
                $('#table-siswa').DataTable().ajax.reload(null, false);
            }
        }, 5000);

        $("#group").change(function(){
            refresh_table();
        });
        $('#btn-edit-pilih').click(function(event) {
            if($('#check').val()==0) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
                $('#check').val('1');
            }else{
                $(':checkbox').each(function() {
                    this.checked = false;
                });
                $('#check').val('0');
            }
        });
        $('#btn-edit-reset').click(function(){
            $("#modal-reset").modal('show');
        });
        $('#btn-reset').click(function(){
            $("#form-reset").submit();
        });

        $('#form-reset').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/reset_daftar_peserta",
                    type:"POST",
                    data:$('#form-reset').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-reset").modal('hide');
                            notify_success(obj.pesan);
                            $('#check').val('0');
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        $('#table-siswa').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false, "sWidth":"80px"},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
				  "aLengthMenu": [[10, 25, 50, 100, 200, 500], [10, 25, 50, 100, 200, 500]],
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "group", "value": $('#group').val()} );
                  }
         });          
    });
</script>

<style>
    .badge-status {
        display: inline-block !important;
        padding: 4px 10px !important;
        border-radius: 6px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }
    .badge-offline { background: linear-gradient(135deg, #ef4444, #dc2626) !important; }
    .badge-online { background: linear-gradient(135deg, #10b981, #059669) !important; }
    .badge-pending { background: linear-gradient(135deg, #f59e0b, #d97706) !important; }
    .badge-minta { background: linear-gradient(135deg, #e11d48, #be123c) !important; animation: blinker 1.5s linear infinite !important;}
</style>