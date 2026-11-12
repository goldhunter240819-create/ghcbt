<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Mata Pelajaran
		<small>Daftar mata pelajaran, penambahan mata pelajaran, pengubahan mata pelajaran, dan penghapusan mata pelajaran berdasarkan Modul</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Mata Pelajaran</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <!-- Modern Horizontal Filter Bar & Action Control Hub -->
            <div class="box" style="border-radius: 18px; margin-bottom: 20px; padding: 18px 25px; background: var(--bg-box); border: 1px solid var(--border-color); box-shadow: var(--shadow-floating);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <div style="display: flex; align-items: center; gap: 14px; flex: 1; min-width: 280px; max-width: 580px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(var(--primary-rgb), 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa fa-folder-open" style="font-size: 20px; color: var(--text-bright);"></i>
                        </div>
                        <div style="flex: 1;" id="data-kelas">
                            <label style="margin: 0 0 4px 0; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block;">
                                Filter Modul Aktif
                            </label>
                            <select name="modul" id="modul" class="form-control" style="border-radius: 10px; font-weight: 700; border: 1.5px solid var(--border-color); height: 42px; font-size: 14px; color: var(--text-main); background: var(--bg-body); cursor: pointer;">
                                <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <button type="button" onclick="tambah()" class="btn btn-primary" style="border-radius: 10px; font-weight: 700; padding: 11px 22px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-plus-circle" style="font-size: 16px;"></i> Tambah Mata Pelajaran
                        </button>
                        <button type="button" onclick="refresh_table()" class="btn btn-default" style="border-radius: 10px; font-weight: 600; padding: 11px 16px; border: 1.5px solid var(--border-color);" title="Segarkan Data">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Full Width Modern Data Table -->
            <div class="box box-primary" style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                <div class="box-header with-border" style="background: rgba(var(--primary-rgb), 0.03) !important; padding: 18px 25px;">
                    <h3 class="box-title" style="font-size: 18px; font-weight: 700; color: var(--text-bright);">
                        <i class="fa fa-book" style="color: var(--accent-color); margin-right: 8px;"></i> Daftar Mata Pelajaran
                    </h3>
                </div>

                <div class="box-body" style="padding: 22px 25px;">
                    <?php echo form_open($url.'/hapus_daftar_topik','id="form-hapus"'); ?>
                    <input type="hidden" name="check" id="check" value="0">
                    <table id="table-topik" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align: center;">No.</th>
                                <th class="all">Nama Mata Pelajaran</th>
                                <th style="width: 120px; text-align: center;">Jml. Soal</th>
                                <th style="width: 120px; text-align: center;">Status</th>
                                <th class="all" style="width: 80px; text-align: center;">Aksi</th>
                                <th class="all" style="width: 40px; text-align: center;"></th>
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
                            </tr>
                        </tbody>
                    </table> 
                    </form>                       
                </div>
                <div class="box-footer" style="padding: 16px 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <button type="button" id="btn-edit-hapus" class="btn btn-danger" style="background: linear-gradient(135deg, #f43f5e, #e11d48) !important; color: white !important; border-radius: 10px; font-weight: 700; padding: 9px 20px; box-shadow: 0 4px 12px rgba(244, 63, 94, 0.3); border: none !important;" title="Hapus Mata Pelajaran yang dipilih">
                        <i class="fa fa-trash" style="margin-right: 6px;"></i> Hapus Terpilih
                    </button>
                    <button type="button" id="btn-edit-pilih" class="btn btn-default" style="border-radius: 10px; font-weight: 700; padding: 9px 20px; border: 1.5px solid var(--border-color);">
                        <i class="fa fa-check-square-o" style="margin-right: 6px;"></i> Pilih Semua
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/tambah','id="form-tambah"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Tambah Mata Pelajaran</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                                <label>Nama Mata Pelajaran</label>
                                <input type="hidden" name="tambah-modul-id" id="tambah-modul-id">
                                <input type="text" class="form-control" id="tambah-topik" name="tambah-topik" placeholder="Nama Mata Pelajaran">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" id="tambah-status" name="tambah-status" value="AKTIF" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/edit','id="form-edit"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Edit Mata Pelajaran</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-edit"></div>
                            <div class="form-group">
                                <label>Nama Mata Pelajaran</label>
                                <input type="hidden" name="edit-id" id="edit-id">
								<input type="hidden" name="edit-modul-id" id="edit-modul-id">
                                <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                                <input type="hidden" name="edit-topik-asli" id="edit-topik-asli">
                                <input type="text" class="form-control" id="edit-topik" name="edit-topik" placeholder="Nama Mata Pelajaran">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" id="edit-status" name="edit-status" value="AKTIF" readonly>
                            </div>
                            <p>NB : Mata Pelajaran yang dihapus, maka semua bank soal akan ikut terhapus !</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-hapus" class="btn btn-default pull-left">Hapus</button>
                    <button type="button" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Hapus Mata Pelajaran</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <strong>Peringatan</strong>
                            Data Mata Pelajaran yang sudah dipilih akan dihapus beserta isi soal didalamnya.
                            <br /><br />
                            Apakah anda yakin untuk menghapus data Mata Pelajaran ?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-hapus" class="btn btn-primary">Hapus</button>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-topik').dataTable().fnReloadAjax();
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-topik').val('');
        $('#tambah-modul-id').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-topik').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-topik').val(data.topik);
                $('#edit-topik-asli').val(data.topik);
				$('#edit-modul-id').val('');
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
        $('.select2').select2();

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

        $("#modul").change(function(){
            refresh_table();
        });

        $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_topik",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
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

        $('#form-edit').submit(function(){
			$('#edit-modul-id').val($('#modul').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-edit").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#form-tambah').submit(function(){
            $('#tambah-modul-id').val($('#modul').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-tambah").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-topik').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "modul", "value": $('#modul').val()} );
                  }
         });          
    });
</script>