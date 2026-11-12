<!-- Zenith Elite Admin: Profil Pengguna -->
<section class="content-header">
    <h1 style="color: var(--zenith-cyan); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Profil Operator
        <small style="color: #94a3b8;">Modifikasi Identitas & Akses Personel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-cyan);">Profil Operator</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open_multipart('manager/useratur/edit','id="form-edit" class="form-horizontal"')?>
    <div class="row">
        <div class="col-md-5">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-user-circle" style="color: var(--zenith-gold);"></i>
                    <h3 class="zenith-card-title">Identitas Inti</h3>
                </div>
                
                <div id="form-pesan"></div>
                <div class="zenith-input-group">
                    <label class="zenith-label">Nama Identifikasi (Username)</label>
                    <input type="text" class="zenith-control" name="username" id="username" value="<?php if(!empty($username)){ echo $username; } ?>" readonly style="border-style: dashed; opacity: 0.7;">
                    <input type="hidden" name="aksi" id="aksi" value="1">
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Kata Sandi Akses</label>
                    <input type="password" class="zenith-control" name="password" id="password" value="kosongkosong">
                    <small style="color: #64748b; font-size: 11px;">Gunakan 'kosongkosong' jika tidak ingin mengubah sandi.</small>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Nama Lengkap Operator</label>
                    <input type="text" class="zenith-control" name="nama" id="nama" value="<?php if(!empty($nama_lengkap)){ echo $nama_lengkap; } ?>">
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Tingkat Otoritas (Level)</label>
                    <div style="background: rgba(15,23,42,0.4); border-radius: 8px; padding: 5px;">
                        <?php if(!empty($level_opsi)){ echo $level_opsi; } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-camera" style="color: var(--zenith-cyan);"></i>
                    <h3 class="zenith-card-title">Atribut Visual & Opsi</h3>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label class="zenith-label">Identitas Visual</label>
                        <div style="background: rgba(15,23,42,0.4); border: 1px dashed var(--zenith-border); border-radius: 12px; padding: 15px; text-align: center;">
                            <?php 
                                $foto_src = base_url().'public/images/avatar.png';
                                if(!empty($foto) && file_exists(FCPATH.'public/uploads/admin/'.$foto)){
                                    $foto_src = base_url().'public/uploads/admin/'.$foto;
                                }
                            ?>
                            <img src="<?php echo $foto_src; ?>" id="preview-tag" style="max-height: 120px; border-radius: 50%; box-shadow: 0 0 15px var(--zenith-cyan-glow);">
                        </div>
                        <input type="file" name="foto" id="foto" class="zenith-control" style="margin-top: 10px; font-size: 11px;" accept="image/*" onchange="previewImage(this);">
                    </div>
                    <div class="col-sm-8">
                        <div class="zenith-input-group">
                            <label class="zenith-label">Wewenang Mata Pelajaran (Opsi 1)</label>
                            <div style="display: flex; gap: 5px;">
                                <input type="text" class="zenith-control" value="<?php if(!empty($opsi1)){ echo $opsi1; } ?>" id="opsi1" name="opsi1" readonly style="flex: 1; border-style: dashed; opacity: 0.7;">
                                <button class="btn-zenith" type="button" id="btn-topik" style="padding: 5px 10px !important;"><i class="fa fa-list"></i></button>
                                <button class="btn-zenith" type="button" id="btn-topik-hapus" style="background: rgba(244, 63, 94, 0.2) !important; color: #f43f5e !important; border-color: rgba(244, 63, 94, 0.3) !important; padding: 5px 10px !important;"><i class="fa fa-trash"></i></button>
                            </div>
                            <small style="color: #64748b; font-size: 11px;">Kosong = Akses Penuh ke seluruh Mapel.</small>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Opsi Identifikasi 2</label>
                                    <input type="text" class="zenith-control" value="<?php if(!empty($opsi2)){ echo $opsi2; } ?>" id="opsi2" name="opsi2">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Catatan Operator</label>
                                    <input type="text" class="zenith-control" value="<?php if(!empty($keterangan)){ echo $keterangan; } ?>" id="keterangan" name="keterangan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--zenith-border); padding-top: 25px;">
                    <button type="button" id="hapus" class="btn-zenith" style="background: rgba(244, 63, 94, 0.2) !important; color: #f43f5e !important; border-color: rgba(244, 63, 94, 0.3) !important;"><i class="fa fa-trash"></i> Hapus Personel</button>
                    <button type="submit" id="simpan" class="btn-zenith"><i class="fa fa-save"></i> Sinkronisasi Profil</button>
                </div>
            </div>
        </div>
    </div>
</section>
</form>

<div class="modal" id="modal-topik" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Pilih Mata Pelajaran</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body form-horizontal">
                            <div id="form-pesan-topik"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pilih Modul</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" name="topik-modul" id="topik-modul">
                                        <?php
                                            if(!empty($select_modul)){
                                                echo $select_modul;
                                            }
                                        ?>
                                    </select>  
                                </div>
                            </div>

                            <table id="table-topik" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="all">Mata Pelajaran</th>
                                    <th>Deskripsi</th>
                                    <th class="all"></th>
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
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
</div>

</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-topik').dataTable().fnReloadAjax();
    }
    function tambah_topik(topik_id, topik_nama){
        var daftar_topik = $('#opsi1').val();
        if(daftar_topik.length>0){
            var array_topik = daftar_topik.split(','), i;
            var counter=0;
            for(i=0;i<array_topik.length;i++){
                if(topik_id==array_topik[i]){
                    counter++;   
                }
            }
            if(counter>0){
                notify_error('Mata Pelajaran '+topik_nama+' sudah berada di Opsi1');
            }else{
                daftar_topik = daftar_topik+","+topik_id;
                $('#opsi1').val(daftar_topik);
                notify_success('Mata Pelajaran '+topik_nama+' berhasil ditambahkan');
            }
        }else{
            daftar_topik = topik_id;
            $('#opsi1').val(daftar_topik);
            notify_success('Mata Pelajaran '+topik_nama+' berhasil ditambahkan');
        }
    }
        $(function(){
            $('#simpan').click(function(){
                $('#form-edit').submit();
            }); 
            $('#hapus').click(function(){
                $("#modal-proses").modal('show');
                $('#aksi').val('0');
                $('#form-edit').submit();
            });
                 
            $('#form-edit').submit(function(){
                $("#modal-proses").modal('show');
                var formData = new FormData(this);

                $.ajax({
                    url:"<?php echo site_url($url.'/edit'); ?>",
                    type:"POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(respon){
                        $("#modal-proses").modal('hide');
                        var level = "<?php echo $this->session->userdata('cbt_level'); ?>";
                        var adminName = "<?php echo $nama; ?>";
                        var title = (level === 'developer') ? 'Master ' : '';
                        play_ai_voice("Data berhasil diperbarui, " + title + adminName);

                        var obj = jQuery.parseJSON(respon);
                        if(obj.status==1){
                            Swal.fire({
                                title: "Sukses",
                                text: obj.pesan,
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });
                            setTimeout(function(){
                                window.open("<?php echo site_url($url); ?>", "_self");
                            }, 1500);
                        }else{
                            play_ai_voice("Gagal memperbarui data. Mohon periksa kembali.");
                            notify_error(obj.pesan);
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
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable_topik/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "modul", "value": $('#topik-modul').val()} );
                  }
         }); 
    });
</script>