<!-- Zenith Elite Admin: Inisialisasi Pengguna -->
<section class="content-header">
    <h1 style="color: var(--zenith-cyan); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Inisialisasi Personel
        <small style="color: #94a3b8;">Daftarkan Operator & Administrator Sistem Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-cyan);">Inisialisasi Personel</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open_multipart($url.'/add', 'id="form-tambah" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-xs-12">
        <div class="zenith-card">
            <div class="zenith-card-header">
                <i class="fa fa-user-plus" style="color: var(--zenith-gold);"></i>
                <h3 class="zenith-card-title">Kredensial & Profil Dasar</h3>
            </div>
            
            <div class="box-body" style="background: transparent;">
                <div id="form-pesan"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Nama Identifikasi (Username)</label>
                                    <input type="text" class="zenith-control" name="username" id="username" placeholder="Contoh: admin01">
                                </div>
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Kata Sandi Akses</label>
                                    <input type="password" class="zenith-control" name="password" id="password" placeholder="Minimal 6 karakter">
                                </div>
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Nama Lengkap Personel</label>
                                    <input type="text" class="zenith-control" name="nama" id="nama" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Level Otoritas</label>
                                    <div style="background: rgba(15,23,42,0.4); border-radius: 8px; padding: 5px;">
                                        <?php if(!empty($level_opsi)){ echo $level_opsi; } ?>
                                    </div>
                                </div>
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Foto Profil Operator</label>
                                    <div style="display: flex; gap: 15px; align-items: center; background: rgba(15,23,42,0.3); padding: 10px; border-radius: 12px; border: 1px dashed var(--zenith-border);">
                                        <img src="<?php echo base_url().'public/images/avatar.png'; ?>" id="preview-tag" style="height: 60px; width: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--zenith-cyan);">
                                        <div style="flex: 1;">
                                            <input type="file" name="foto" id="foto" class="zenith-control" accept="image/*" onchange="previewImage(this);" style="font-size: 11px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr style="border-color: var(--zenith-border); opacity: 0.1; margin: 30px 0;">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Wewenang Mata Pelajaran (Opsi 1)</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="text" class="zenith-control" id="opsi1" name="opsi1" placeholder="Daftar Mata Pelajaran yang dikelola user" readonly style="flex: 1; border-style: dashed; opacity: 0.7;">
                                        <button class="btn-zenith" type="button" id="btn-topik" style="padding: 8px 15px !important;"><i class="fa fa-list"></i> Pilih Mapel</button>
                                        <button class="btn-zenith" type="button" id="btn-topik-hapus" style="background: rgba(244, 63, 94, 0.2) !important; color: #f43f5e !important; border-color: rgba(244, 63, 94, 0.3) !important;"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <p style="color: #64748b; font-size: 11px; margin-top: 5px;">Bila dikosongkan, maka personel dapat mengelola soal di seluruh mata pelajaran.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Opsi Identifikasi 2</label>
                                    <input type="text" class="zenith-control" id="opsi2" name="opsi2" placeholder="Opsi Tambahan">
                                </div>
                                <div class="zenith-input-group">
                                    <label class="zenith-label">Catatan Keterangan</label>
                                    <input type="text" class="zenith-control" id="keterangan" name="keterangan" placeholder="Keterangan opsional">
                                </div>
                            </div>
                        </div>

                    </div> <!-- end box body -->
                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; border-top: 1px solid var(--zenith-border); padding-top: 25px;">
                        <button type="submit" id="btn-simpan" class="btn-zenith"><i class="fa fa-save"></i> Inisialisasi Akun Personel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
    
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

<script type="text/javascript">
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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
        $('#btn-topik-hapus').click(function(){
            $('#opsi1').val('');
        });
        $('#btn-topik').click(function(){
            $('#form-pesan-topik').html('');
            $("#modal-topik").modal('show');
        });
        // memilih topik berdasarkan modul
        $("#topik-modul").change(function(){
            refresh_table();
        });

        $('#form-tambah').submit(function(){
            $("#modal-proses").modal('show');
            var formData = new FormData(this);

            $.ajax({
                url:"<?php echo site_url($url.'/add'); ?>",
                type:"POST",
                data: formData,
                processData: false,
                contentType: false,
                success:function(respon){
                    $("#modal-proses").modal('hide');
                    var obj = jQuery.parseJSON(respon);
                    if(obj.status==1){
                        var level = "<?php echo $this->session->userdata('cbt_level'); ?>";
                        var adminName = "<?php echo $nama; ?>";
                        var title = (level === 'developer') ? 'Master ' : '';
                        play_ai_voice("Data berhasil disimpan, " + title + adminName);

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
                        play_ai_voice("Gagal menyimpan data. Mohon periksa kembali.");
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