<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Ujian
		<small>Menambah ujian, mengubah ujian, dan menghapus ujian</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Tambah ujian</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($url.'/tambah_tes','id="form-tambah-tes"  class="form-horizontal"'); ?>
                <div class="box-header with-border">
                    <div class="box-title">Mengelola Ujian</div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="col-xs-6">
                        <div id="form-pesan-tes"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Modul / Bank Soal</label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm select2" id="tambah-modul-ref" name="tambah-modul-ref" style="width: 100%;">
                                    <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                                </select>
                                <p class="help-block">Pilih Modul & Mata Pelajaran untuk otomatisasi Nama Ujian</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mata Pelajaran</label>
                            <div class="col-sm-9">
                                <select style="width: 100%" class="form-control input-sm select2" id="tambah-topik-ref" name="tambah-topik-ref">
                                    <option value="kosong">Pilih Mata Pelajaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Group/Kelas</label>
                            <div class="col-sm-9">
                                <select class="form-control input-sm select2" id="tambah-group" name="tambah-group[]" multiple style="width: 100%;">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                                <p class="help-block">Mendukung multi-kelas sekaligus</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Ujian</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="tambah-id" id="tambah-id" />
                                <input type="hidden" name="tambah-nama-lama" id="tambah-nama-lama" />
                                <input type="text" name="tambah-nama" id="tambah-nama" class="form-control input-sm" placeholder="Otomatis terisi jika Mata Pelajaran & Kelas dipilih..." readonly />
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea name="tambah-deskripsi" id="tambah-deskripsi" class="form-control input-sm" >-</textarea>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">Rentang Waktu</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" name="tambah-rentang-waktu" id="tambah-rentang-waktu" class="form-control input-sm" value="<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>" readonly />
                                </div>
                                <p class="help-block">Rentang waktu ujian dilaksanakan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Waktu Ujian</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-waktu" id="tambah-waktu" class="form-control input-sm" value="30" />
                                <p class="help-block">Waktu ujian dalam satuan menit</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Poin Dasar</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin" id="tambah-poin" class="form-control input-sm" value="1.00" />
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Jawaban Salah</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin-salah" id="tambah-poin-salah" class="form-control input-sm" value="0.00" />
                                <p class="help-block">Poin untuk jawaban salah</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Jawaban Kosong</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin-kosong" id="tambah-poin-kosong" class="form-control input-sm" value="0.00" />
                                <p class="help-block">Poin untuk jawaban kosong</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tunjukkan Hasil</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="tambah-tunjukkan-hasil" id="tambah-tunjukkan-hasil" value="1" checked>
                                <p class="help-block">Menunjukkan hasil ke user saat ujian sudah selesai</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Detail Hasil</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="tambah-detail-hasil" id="tambah-detail-hasil" value="1" >
                                <p class="help-block">Menunjukkan detail jawaban ke user saat ujian sudah selesai</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Token</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="tambah-token" id="tambah-token" value="1" >
                                <p class="help-block">Saat awal ujian, user memasukkan Token dari operator</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Intro Ujian</label>
                            <div class="col-sm-9">
								<input type="checkbox" name="tambah-intro" id="tambah-intro" value="1" >
								<input type="hidden" name="tambah-intro-isi" id="tambah-intro-isi" />
                                <p class="help-block">Intro sebelum mengerjakan Ujian. Bisa berisi informasi, materi singkat.</p>
                            </div>
                        </div>
						<div class="form-group hide" id="form-isi-intro-tes">
                            <label class="col-sm-3 control-label">Isi Intro Ujian</label>
                            <div class="col-sm-9">
								<button type="button" id="btn-intro" class="btn btn-default btn-sm">Isi Intro Ujian</button>
                                <p class="help-block">Klik Tombol Isi Intro diatas untuk mengisi Intro Ujian</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" id="btn-tambah-simpan" class="btn btn-primary pull-right">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row hide" id="kolom-soal">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Tambah Soal <div id="judul-tambah-soal"></div></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php echo form_open($url.'/tambah_soal','id="form-tambah-soal"  class="form-horizontal"'); ?>
                        <div id="form-pesan-soal"></div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Modul</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="soal-tes-id" id="soal-tes-id">
                                <select class="form-control input-sm" id="soal-modul" name="soal-modul" >
                                    <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Mata Pelajaran</label>
                            <div class="col-sm-9">
                                <select style="width: 100%" class="form-control input-sm" id="soal-topik" name="soal-topik" >
                                    <option value="">Pilih Mata Pelajaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Pilihan Ganda</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-1" id="soal-jml-1" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Essay</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-2" id="soal-jml-2" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Jawaban Singkat</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-3" id="soal-jml-3" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Menjodohkan</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-4" id="soal-jml-4" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Checklist</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-5" id="soal-jml-5" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left:0px; margin-right:0px;">
                                    <label class="control-label">Benar / Salah</label>
                                    <div class="input-group">
                                        <input type="number" name="soal-jml-6" id="soal-jml-6" class="form-control input-sm" value="0" min="0">
                                        <span class="input-group-addon">Soal</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Acak Soal</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="soal-acak-soal" id="soal-acak-soal" class="input-sm" value="1" checked>
                                <p class="help-block">Mengacak Soal Ujian</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-sm-3 control-label">Acak Jawaban</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="soal-acak-jawaban" id="soal-acak-jawaban" class="input-sm" value="1" checked>
                                <p class="help-block">Mengacak Jawaban Ujian</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total Komposisi</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="total-komposisi" class="form-control input-sm" value="0" readonly style="font-weight: 700; background-color: #f1f5f9; color: var(--accent-color, #6366f1); font-size: 14px;" />
                                    <span class="input-group-addon" style="font-weight: 700; background: rgba(99, 102, 241, 0.1); color: var(--accent-color, #6366f1);">Total Soal Keseluruhan</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" id="btn-tambah-soal" class="btn btn-primary pull-right">Simpan Komposisi Soal</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table id="table-soal" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Mata Pelajaran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>                          
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" id="btn-tambah-daftar" class="btn btn-default">Daftar Ujian</button>
                    <button type="button" id="btn-tambah-selesai" class="btn btn-primary pull-right">Selesai</button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal" id="modal-intro" data-backdrop="static" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog" style="min-width:80%;min-height:90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div>Intro Ujian</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                                <label>Isi Intro Ujian</label>
                                <textarea class="textarea" id="tambah_intro_isi" name="tambah_intro_isi" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
								<p class="help-block">Klik Fullscreen untuk memudahkan memasukkan Intro Ujian</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-intro-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }

    function refresh_topik(){
        $("#modal-proses").modal('show');
        // Pastikan modul disinkronisasikan terlebih dahulu
        $('#soal-modul').val($('#tambah-modul-ref').val());
        
        var modul = $('#soal-modul').val();
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_topik_by_modul/'+modul, function(data){
            if(data.data==1){
                $('#soal-topik').html(data.select_topik);
                var targetTopik = $("#tambah-topik-ref").val();
                if(targetTopik && targetTopik != 'kosong') {
                    $('#soal-topik').val(targetTopik);
                }
            }
            $("#modal-proses").modal('hide');
        }).fail(function() {
            $("#modal-proses").modal('hide');
            notify_error("Gagal mengambil data Mata Pelajaran.");
        });
    }

    function refresh_topik_ref(){
        $("#modal-proses").modal('show');
        var modul = $('#tambah-modul-ref').val();
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_topik_by_modul/'+modul, function(data){
            if(data.data==1){
                $('#tambah-topik-ref').html(data.select_topik);
                // Biarkan auto-nama trigger ketika load beres kalau ini load bukan empty
                auto_generate_name();
            }
            $("#modal-proses").modal('hide');
        }).fail(function() {
            $("#modal-proses").modal('hide');
            notify_error("Gagal mengambil data Mata Pelajaran.");
        });
    }

    function auto_generate_name() {
        var topikName = $('#tambah-topik-ref option:selected').text();
        // Remove question count like " [100 soal]" from text
        topikName = topikName.replace(/ \[\d+ soal\]/g, "");
        
        if($('#tambah-topik-ref').val() == 'kosong' || !topikName) {
            topikName = "Ujian";
        }

        var groups = [];
        $('#tambah-group option:selected').each(function() {
            groups.push($(this).text());
        });

        var groupText = groups.length > 0 ? "_Kelas " + groups.join(", ") : "";
        $('#tambah-nama').val(topikName + groupText);
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#tambah-id').val(data.id);
                $('#soal-tes-id').val(data.id);

                $('#tambah-nama').val(data.nama);
                $('#tambah-nama-lama').val(data.nama);
                $('#tambah-deskripsi').val(data.deskripsi);
                $('#tambah-waktu').val(data.waktu);
                $('#tambah-poin').val(data.poin);
                $('#tambah-poin-kosong').val(data.poin_kosong);
                $('#tambah-poin-salah').val(data.poin_salah);
                $('#tambah-rentang-waktu').val(data.rentang_waktu);
                if(data.tunjukkan_hasil==1){
                    $('#tambah-tunjukkan-hasil').prop("checked", true);
                }else{
                    $('#tambah-tunjukkan-hasil').prop("checked", false);
                }
                if(data.detail_hasil==1){
                    $('#tambah-detail-hasil').prop("checked", true);
                }else{
                    $('#tambah-detail-hasil').prop("checked", false);
                }
                if(data.token==1){
                    $('#tambah-token').prop("checked", true);
                }else{
                    $('#tambah-token').prop("checked", false);
                }
				if(data.intro==1){
                    $('#tambah-intro').prop("checked", true);
                }else{
                    $('#tambah-intro').prop("checked", false);
                }
				if(data.intro==1){
					$("#form-isi-intro-tes").removeClass('hide');
				}

                refresh_topik();
                refresh_table();

                $('#kolom-soal').removeClass('hide');
            }
            $("#modal-proses").modal('hide');
        }).fail(function() {
            $("#modal-proses").modal('hide');
            notify_error("Gagal mengambil data Ujian.");
        });
    }
	
	function intro(){
		var tes_id = $("#tambah-id").val();
		if(!tes_id){
			$("#modal-intro").modal('show');
		}else{
			$("#modal-proses").modal('show');
			$.getJSON('<?php echo site_url().'/'.$url; ?>/get_intro_by_id/'+tes_id+'', function(data){
				if(data.data==1){
					CKEDITOR.instances.tambah_intro_isi.setData(data.intro_isi);
				}else{
					CKEDITOR.instances.tambah_intro_isi.setData("");
				}
				$("#modal-proses").modal('hide');
				$("#modal-intro").modal('show');
			}).fail(function() {
				$("#modal-proses").modal('hide');
				notify_error("Gagal mengambil data Intro.");
			});
		}
	}

    function hapus_soal(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/hapus_soal_by_id/'+id+'', function(data){
            if(data.data==1){
                notify_success(data.pesan);

                refresh_table();
            }else{
                notify_error(data.pesan);                
            }
            $("#modal-proses").modal('hide');
        }).fail(function() {
            $("#modal-proses").modal('hide');
            notify_error("Gagal menghapus soal.");
        });
    }

    function selesai(){
        $('#tambah-id').val('');
        $('#tambah-nama').val('');
        $('#tambah-nama-lama').val('');
        $('#tambah-deskripsi').val('');
        $('#tambah-waktu').val('30');
        $('#tambah-poin').val('1.00');
        $('#tambah-poin-kosong').val('0.00');
        $('#tambah-poin-salah').val('0.00');
        $('#tambah-rentang-waktu').val('<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>');
        $('#tambah-group option:selected').removeAttr('selected');
        $('#tambah-acak-jawaban').prop("checked", true);

        $('#soal-tes-id').val('');

        $('#kolom-soal').addClass('hide');
        $('#tambah-nama').focus();
    }

    $(function(){
        
        function hitung_total_komposisi() {
            var total = 0;
            $('input[id^="soal-jml-"]').each(function() {
                var val = parseInt($(this).val()) || 0;
                total += val;
            });
            $('#total-komposisi').val(total);
        }

        $('input[id^="soal-jml-"]').on('input change keyup', function() {
            hitung_total_komposisi();
        });

        $('#tambah-rentang-waktu').daterangepicker({timePicker: true, timePickerIncrement: 10, format: 'YYYY-MM-DD H:mm'});
        $('#btn-tambah-selesai').click(function(){
            window.open("<?php echo site_url(); ?>/manager/tes_tambah", "_self");
        });

        $('#btn-tambah-daftar').click(function(){
            window.open("<?php echo site_url(); ?>/manager/tes_daftar", "_self");
        });

        $("#soal-modul").change(function(){
            refresh_topik();
        });

        $("#tambah-modul-ref").change(function(){
            refresh_topik_ref();
            // Juga update bagian bawah jika sudah terbuka
            if(!$('#kolom-soal').hasClass('hide')) {
                refresh_topik();
            }
        });

        $("#tambah-topik-ref").change(function(){
            auto_generate_name();
            // Selalu update bagian bawah agar sinkron
            refresh_topik();
        });

        $("#tambah-group").change(function(){
            auto_generate_name();
        });
        
        $('.select2').select2({ placeholder: "Pilih..." });
        
        // Memuat Topik pada saat awal halaman diload
        setTimeout(function(){
            $("#tambah-modul-ref").trigger('change');
        }, 500);
		
		$('#btn-intro-simpan').click(function(){
			$('#tambah-intro-isi').val(CKEDITOR.instances.tambah_intro_isi.getData());
            $("#modal-intro").modal('hide');
        });
		$('#btn-intro').click(function(){
            intro();
        });
		$("#tambah-intro").click(function(){
			if($("#tambah-intro").prop("checked") == false){
				$("#form-isi-intro-tes").addClass('hide');
			}else{
				$("#form-isi-intro-tes").removeClass('hide');
			}
        });
		CKEDITOR.replace('tambah_intro_isi', {
			extraPlugins : 'pastebase64,imageresizerowandcolumn,justify,youtube'
		});

        $('#form-tambah-tes').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah_tes",
                    type:"POST",
                    data:$('#form-tambah-tes').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $('#form-pesan-tes').html('');
                            $("#tambah-id").val(obj.tes_id);
                            $("#tambah-nama-lama").val(obj.tes_nama);
                            // menampilkan tambah soal
                            refresh_topik()
                            $("#soal-tes-id").val(obj.tes_id);
                            $('#kolom-soal').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-tes').html(pesan_err(obj.pesan));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        $("#modal-proses").modal('hide');
                        notify_error(textstatus);
                    }
            });
            return false;
        });

        $('#form-tambah-soal').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah_soal",
                    type:"POST",
                    data:$('#form-tambah-soal').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-soal').html('');
                            refresh_table();                            
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-soal').html(pesan_err(obj.pesan));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        $("#modal-proses").modal('hide');
                        notify_error(textstatus);
                    }
            });
            return false;
        });

        $('#table-soal').DataTable({
                  "paging": false,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable_soal/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes-id", "value": $('#soal-tes-id').val()} );
                  }
         });  

        <?php if(!empty($data_tes)){ echo $data_tes; } ?>
    });
</script>