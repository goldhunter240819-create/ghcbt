<!-- Zenith Elite Admin: Override Navigasi -->
<section class="content-header">
    <h1 style="color: var(--zenith-cyan); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Override Navigasi
        <small style="color: #94a3b8;">Modifikasi Parameter Jalur & Komponen Menu</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-cyan);">Override Navigasi</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open('manager/usermenu/edit','id="form-edit-menu" class="form-horizontal"')?>
    <div class="row">
        <div class="col-md-5">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-sliders" style="color: var(--zenith-gold);"></i>
                    <h3 class="zenith-card-title">Parameter Rute</h3>
                </div>
                
                <div id="form-pesan"></div>
                <div class="zenith-input-group">
                    <label class="zenith-label">Klasifikasi (Tipe)</label>
                    <input type="hidden" value="<?php if(!empty($id)){ echo $id; } ?>" id="id" name="id" readonly>
                    <input type="hidden" id="aksi" name="aksi" readonly>
                    <input type="text" class="zenith-control" value="<?php if(!empty($tipe)){ echo $tipe; } ?>" id="tipe" name="tipe" readonly style="border-style: dashed; opacity: 0.7;">
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Relasi Induk (Parent)</label>
                    <input type="text" class="zenith-control" value="<?php if(!empty($parent)){ echo $parent; } ?>" id="parent" name="parent" readonly style="border-style: dashed; opacity: 0.7;">
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Identitas Sistem</label>
                    <input type="text" class="zenith-control" value="<?php if(!empty($kode)){ echo $kode; } ?>" id="kode" name="kode" readonly style="border-style: dashed; opacity: 0.7;">
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-pencil-square" style="color: var(--zenith-cyan);"></i>
                    <h3 class="zenith-card-title">Atribut Modifikasi</h3>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Nomenklatur Menu</label>
                    <input type="text" class="zenith-control" value="<?php if(!empty($nama_menu)){ echo $nama_menu; } ?>" id="nama" name="nama" placeholder="Nama Menu">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="zenith-input-group">
                            <label class="zenith-label">Jalur Akses (URL)</label>
                            <input type="text" class="zenith-control" id="url" name="url" value="<?php if(!empty($url)){ echo $url; } ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="zenith-input-group">
                            <label class="zenith-label">Ikon Visual</label>
                            <input type="text" class="zenith-control" id="icon" name="icon" value="<?php if(!empty($icon)){ echo $icon; } ?>">
                        </div>
                    </div>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Urutan Prioritas</label>
                    <input type="text" class="zenith-control" id="urutan" name="urutan" value="<?php if(!empty($urutan)){ echo $urutan; } ?>">
                </div>

                <div style="margin-top: 40px; display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--zenith-border); padding-top: 25px;">
                    <button type="button" id="hapus" class="btn-zenith" style="background: rgba(244, 63, 94, 0.2) !important; color: #f43f5e !important; border-color: rgba(244, 63, 94, 0.3) !important;"><i class="fa fa-trash"></i> Hapus Menu</button>
                    <button type="button" id="simpan" class="btn-zenith"><i class="fa fa-save"></i> Sinkronisasi Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</form>
</section>
</section><!-- /.content -->

<script lang="javascript">
    $(function(){
        $('#simpan').click(function(){
            $("#modal-proses").modal('show');
            $('#aksi').val('1');
            $('#form-edit-menu').submit();
        }); 
        $('#hapus').click(function(){
            $("#modal-proses").modal('show');
            $('#aksi').val('0');
            $('#form-edit-menu').submit();
        });
             
        $('#form-edit-menu').submit(function(){
                $.ajax({
                    url:"<?php echo site_url(); ?>/manager/usermenu/edit",
     			    type:"POST",
     			    data:$('#form-edit-menu').serialize(),
     			    cache: false,
      		        success:function(respon){
         		    	var obj = $.parseJSON(respon);
      		            if(obj.status==1){
      		                $("#modal-proses").modal('hide');
      		                $('#form-pesan').html(pesan_succ(obj.pesan));
                            setTimeout(function(){ window.open("<?php echo site_url(); ?>/manager/usermenu","_self"); }, 1000);
          		        }else{
          		            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
          		        }
         			}
      		});
            
      		return false;
        });
    });
</script>