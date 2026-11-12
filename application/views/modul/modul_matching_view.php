<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Mengelola Pasangan Menjodohkan
		<small>Mengelola pasangan pertanyaan dan jawaban</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Menjodohkan</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="box-header with-border" style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div class="box-title" style="font-weight: 600;">Data Soal Mata Pelajaran <?php if(!empty($topik)){ echo $topik; } ?></div>
                    <a href="<?php echo site_url('manager/modul_import_word/index/4'); ?>" class="btn btn-sm btn-smart-import"><i class="fa fa-magic"></i> SMART IMPORT WORD</a>
                </div>

                <div class="box-body">
                    <div class="col-xs-12">
                        <input type="hidden" name="topik" id="topik" value="<?php if(!empty($id_topik)){ echo $id_topik; } ?>" />
                        <?php if(!empty($soal)){ echo $soal; } ?>
                    </div>
                </div>
                <div class="box-footer">
                    <p>Mengelola Pasangan. Jika sudah selesai, silahkan kembali ke halaman Soal dengan menutup jendela ini.</p>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-12">
                <div class="box">
                    <?php echo form_open_multipart($url.'/tambah','id="form-tambah" class="form-horizontal"'); ?>
                        <div class="box-header with-border">
                            <div class="box-title">Tambah / Ubah Pasangan</div>
                        </div>

                        <div class="box-body">
                            <div id="form-pesan"></div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bagian Kiri (Pertanyaan)</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="tambah-soal-id" id="tambah-soal-id" value="<?php if(!empty($id_soal)){ echo $id_soal; } ?>">
                                    <input type="hidden" name="tambah-matching-id" id="tambah-matching-id" >
                                    <input type="hidden" name="tambah-kiri" id="tambah-kiri" >
                                    <textarea class="textarea" id="tambah_kiri" name="tambah_kiri" style="width: 100%; height: 100px; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bagian Kanan (Pasangan Jawaban)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tambah-kanan" id="tambah-kanan" placeholder="Masukkan jawaban teks (plain text)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" id="btn-tambah-simpan" class="btn btn-primary"><span id="judul-tambah-simpan">Simpan</span></button>
                                    <button type="button" id="btn-tambah-batal" class="btn btn-default"><span>Batal</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                            <div class="box-title">Daftar Pasangan</div>
                    </div>

                    <div class="box-body">
                        <table id="table-matching" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kiri (Pertanyaan)</th>
                                    <th>Kanan (Jawaban)</th>
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
    </div>

    <div class="modal" id="modal-hapus-matching" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hapus_matching','id="form-hapus-matching"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Hapus Pasangan</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-hapus"></div>
                            <div class="form-group">
                                <label>Yakin menghapus pasangan ini?</label>
                                <input type="hidden" name="hapus-id" id="hapus-id">
                                <div id="hapus-kiri"  style="max-height: 250px;overflow: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-hapus-matching" class="btn btn-primary">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-matching').dataTable().fnReloadAjax();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $("#form-pesan").html('');
                $("#tambah-kiri").val('');
                CKEDITOR.instances.tambah_kiri.setData(data.kiri)
                $('#tambah-kanan').val(data.kanan);
                $('#tambah-matching-id').val(data.id);

                $('html, body').animate({
                    scrollTop: $("#form-tambah").offset().top
                }, 500);
            }
            $("#modal-proses").modal('hide');
        });
    }

    function hapus(id){
        $('#hapus-id').val('');
        $('#hapus-kiri').html('');
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#hapus-id').val(data.id);
                $('#hapus-kiri').html(data.kiri);
                $("#modal-hapus-matching").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    function batal_tambah(){
        $("#form-pesan").html('');
        $("#tambah-kiri").val('');
        CKEDITOR.instances.tambah_kiri.setData('');
        $('#tambah-kanan').val('');
        $('#tambah-matching-id').val('');
    }

    $(function(){
        $('#btn-tambah-batal').click(function(){
            batal_tambah();
        });

        $('#form-tambah').submit(function(){
            $('#tambah-kiri').val(CKEDITOR.instances.tambah_kiri.getData());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    timeout: 60000,
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
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
                            notify_error("Gagal menyimpan, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        $('#form-hapus-matching').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_matching",
                    type:"POST",
                    data:$('#form-hapus-matching').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-hapus").html('');
                            $("#modal-hapus-matching").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
		 
		$( document ).ready(function() {
            $('#table-matching').DataTable({
                  "bPaginate": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": true, "bSortable": false},
                        {"bSearchable": true, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "soal", "value": $('#tambah-soal-id').val()} );
                  }
            });

            CKEDITOR.replace('tambah_kiri');

            <?php if(!empty($data_matching)){ echo $data_matching; } ?>
		});
    });
</script>
