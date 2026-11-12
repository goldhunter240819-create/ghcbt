<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Siswa
		<small>Daftar siswa, penambahan siswa, pengubahan data siswa, dan penghapusan data siswa</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Siswa</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">


        <div class="col-md-12">
                <div class="box box-primary" style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                    <div class="box-header with-border" style="padding: 18px 25px; background: rgba(var(--primary-rgb), 0.03) !important;">
                        <h3 class="box-title" style="font-size: 18px; font-weight: 700; color: var(--text-bright);">
                            <i class="fa fa-graduation-cap" style="color: var(--accent-color); margin-right: 8px;"></i> Daftar Siswa
                        </h3>
                        <div class="box-tools">
                            <select name="group" id="group" class="form-control" style="width: 200px; border-radius: 10px; font-weight: 600; border: 1.5px solid var(--border-color); height: 38px; color: var(--text-main); background: var(--bg-body); cursor: pointer;">
                                <option value="semua">-- Semua Kelas --</option>
                                <?php if(!empty($select_group)){ echo $select_group; } ?>
                            </select>
                            <a style="cursor: pointer;" onclick="tambah()" class="btn btn-primary" style="border-radius: 10px; font-weight: 700; padding: 9px 18px; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="fa fa-plus-circle" style="font-size: 15px;"></i> Tambah Siswa
                            </a>
                            <a href="<?php echo site_url('manager/peserta_import'); ?>" class="btn btn-success" style="border-radius: 10px; font-weight: 700; padding: 9px 18px; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: white !important; border: none !important; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa fa-upload" style="font-size: 15px;"></i> Import Siswa
                            </a>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <?php echo form_open($url.'/hapus_daftar_siswa','id="form-hapus"'); ?>
                        <input type="hidden" name="check" id="check" value="0">
                        <table id="table-peserta" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th class="all">Nama</th>
                                    <th>Tempat Tanggal Lahir</th>
                                    <th class="all">Aksi</th>
                                    <th class="all"></th>
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
                        <style>
                            #table-peserta th {
                                text-align: center;
                                vertical-align: middle !important;
                                white-space: nowrap;
                            }
                            #table-peserta td {
                                vertical-align: middle !important;
                            }
                            /* Prevent action buttons from stacking */
                            #table-peserta td .btn-group {
                                display: flex;
                                gap: 4px;
                            }
                        </style>
                        <div class="box-footer">
                            <button type="button" id="btn-edit-hapus" class="btn btn-primary" title="Hapus Siswa yang dipilih">Hapus</button>
                            <button type="button" id="btn-edit-pilih" class="btn btn-default pull-right">Pilih Semua</button>
                        </div>
                </div>
        </div>
    </div>

    <div style="overflow-y:auto;" class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Hapus Siswa</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <strong>Peringatan</strong>
                            Data Siswa yang sudah dipilih akan dihapus, Data Hasil Ujian juga akan terhapus.
                            <br /><br />
                            Apakah anda yakin untuk menghapus data Siswa ?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-hapus" class="btn btn-default pull-left">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open_multipart($url.'/tambah','id="form-tambah"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Tambah Siswa</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="tambah-nama" name="tambah-nama" placeholder="Nama Lengkap Siswa">
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="tambah-tmp-lahir" name="tambah-tmp-lahir" placeholder="Tempat Lahir">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tambah-tgl-lahir" name="tambah-tgl-lahir">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="tambah-email" name="tambah-email" placeholder="Email Siswa (Boleh dikosongkan)">
                            </div>

                            <div class="form-group">
                                <label>Foto Siswa</label>
                                <input type="file" class="form-control" id="tambah-foto" name="tambah-foto" accept="image/*">
                                <p class="help-block">Format: JPG/PNG. Maksimal 1MB.</p>
                            </div>
							
							<div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="tambah-detail" name="tambah-detail" placeholder="Keterangan siswa. (Bisa disi ruang dan sesi)">
								<p class="help-block">Dapat diisi Ruang dan Sesi Siswa. Contoh : Ruang 1, Sesi 1</p>
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="tambah-group" id="tambah-group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                            </div>
                            <div class="alert alert-info">
                                <p>Password akan dibuat secara otomatis oleh sistem.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Tambah</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModalEdit" aria-hidden="true">
    <?php echo form_open_multipart($url.'/edit','id="form-edit"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Edit Siswa</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-edit"></div>
                            <input type="hidden" name="edit-id" id="edit-id">
                            <input type="hidden" name="edit-pilihan" id="edit-pilihan">

                            <div class="form-group">
                                <label>Password</label>
								<div class="input-group">
									<input type="password" id="edit-password" name="edit-password" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-flat" id="btn-show-password" title="Tampilkan Password" type="button"><i id="icon-show-password" class="fa fa-eye"></i></button>
									</span>
								</div>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit-nama" name="edit-nama" placeholder="Nama Lengkap Siswa">
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" id="edit-tmp-lahir" name="edit-tmp-lahir" placeholder="Tempat Lahir">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" id="edit-tgl-lahir" name="edit-tgl-lahir">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="edit-email" name="edit-email" placeholder="Email Siswa (Boleh dikosongkan)">
                            </div>

                            <div class="form-group">
                                <label>Foto Siswa</label>
                                <input type="file" class="form-control" id="edit-foto" name="edit-foto" accept="image/*">
                                <p class="help-block">Format: JPG/PNG. Maksimal 1MB.<br/>Kosongkan jika tidak ingin mengubah foto.</p>
                                <div id="edit-foto-preview"></div>
                            </div>
							
							<div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="edit-detail" name="edit-detail" placeholder="Keterangan siswa. (Bisa disi ruang dan sesi)">
								<p class="help-block">Dapat diisi Ruang dan Sesi Siswa. Contoh : Ruang 1, Sesi 1</p>
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="edit-group" id="edit-group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                            </div>
                            <p>NB : Siswa yang dihapus, maka semua hasil ujian akan ikut terhapus !</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-hapus" class="btn btn-default pull-left">Hapus</button>
                    <button type="button" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->

    <!-- Modal Lihat Foto -->
    <div class="modal fade" id="modal-lihat-foto" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-sm" style="display: flex; align-items: center; justify-content: center; min-height: 100vh;">
            <div class="modal-content" style="background:transparent; border:none; box-shadow:none;">
                <div class="modal-body text-center" style="position:relative;">
                    <button type="button" class="close" data-dismiss="modal" style="position:absolute; top: -15px; right: -10px; color:white; opacity:1; text-shadow:0 0 5px black; font-size: 30px;">&times;</button>
                    <img id="preview-foto-besar" src="" style="max-width:100%; max-height:80vh; border-radius:8px; box-shadow:0 10px 40px rgba(0,0,0,0.8); object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

<script lang="javascript">
    function lihatFoto(url){
        $('#preview-foto-besar').attr('src', url);
        $('#modal-lihat-foto').modal('show');
    }

    function uploadFotoInline(id, inputElement) {
        if(inputElement.files.length === 0) return;
        
        var file = inputElement.files[0];
        var formData = new FormData();
        formData.append('foto', file);
        
        var imgElement = document.getElementById('img-' + id);
        var oldSrc = imgElement.src;
        imgElement.style.opacity = '0.5';
        
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/upload_foto_inline/" + id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(respon) {
                var obj = $.parseJSON(respon);
                if(obj.status == 1) {
                    imgElement.src = obj.image_url;
                    notify_success(obj.pesan);
                } else {
                    notify_error(obj.pesan);
                }
                imgElement.style.opacity = '1';
                inputElement.value = '';
            },
            error: function() {
                notify_error('Terjadi kesalahan sistem saat menghubungi server.');
                imgElement.style.opacity = '1';
                inputElement.value = '';
            }
        });
    }

    function refresh_table(){
        $('#table-peserta').dataTable().fnReloadAjax();
    }
	
	function showpassword(){
		var x = document.getElementById("edit-password");
		if (x.type === "password") {
			x.type = "text";
			$("#icon-show-password").removeClass("fa-eye");
			$("#icon-show-password").addClass("fa-eye-slash");
		} else {
			x.type = "password";
			$("#icon-show-password").removeClass("fa-eye-slash");
			$("#icon-show-password").addClass("fa-eye");
		}
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-username').val('');
        $('#tambah-nama').val('');
        $('#tambah-tmp-lahir').val('');
        $('#tambah-tgl-lahir').val('');
        $('#tambah-alamat').val('');
        $('#tambah-email').val('');
		$('#tambah-detail').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-username').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-password').val(data.password);
                $('#edit-nama').val(data.nama);
                $('#edit-tmp-lahir').val(data.tmp_lahir);
                $('#edit-tgl-lahir').val(data.tgl_lahir);
                $('#edit-email').val(data.email);
				$('#edit-detail').val(data.detail);
                $('#edit-group').val(data.group);
                
                $('#edit-foto-preview').html('');
                if(data.foto != null && data.foto != ''){
                    $('#edit-foto-preview').html('<img src="<?php echo base_url(); ?>public/uploads/siswa/'+data.foto+'" style="max-height: 100px; margin-top: 10px; border: 1px solid #ddd; padding: 2px;">');
                }
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
		$("#btn-show-password").click(function(){
			showpassword();
		});
		
        $("#group").change(function(){
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
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_siswa",
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
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit",
                    type:"POST",
                    data:new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
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
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
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

        $('#table-peserta').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"1%", "sClass":"text-center"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"90px", "sClass":"text-center"},
                        {"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false, "sWidth":"35%"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px", "sClass":"text-center"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"1%", "sClass":"text-center"}],
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