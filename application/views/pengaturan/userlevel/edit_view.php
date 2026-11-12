<!-- Zenith Elite Admin: Editor Level -->
<section class="content-header">
    <h1 style="color: var(--zenith-gold); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Override Otoritas
        <small style="color: #94a3b8;">Modifikasi Izin Keamanan & Hak Akses Peran</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-gold);">Override Otoritas</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open('manager/userlevel/edit','id="form-edit-level" class="form-horizontal"')?>
    <div class="row">
        <div class="col-md-4">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-id-badge" style="color: var(--zenith-cyan);"></i>
                    <h3 class="zenith-card-title">Profil Peran</h3>
                </div>
                
                <div class="zenith-input-group">
                    <label class="zenith-label">Penetapan Level</label>
                    <input type="hidden" id="aksi" name="aksi">
                    <input type="text" class="zenith-control" value="<?php if(!empty($level)){ echo $level; } ?>" id="level" name="level" readonly style="border-style: dashed; opacity: 0.7;">
                </div>
                
                <div class="zenith-input-group">
                    <label class="zenith-label">Detail Penetapan</label>
                    <input type="text" class="zenith-control" value="<?php if(!empty($keterangan)){ echo $keterangan; } ?>" id="keterangan" name="keterangan" readonly style="border-style: dashed; opacity: 0.7;">
                </div>

                <div style="margin-top: 40px; border-top: 1px solid var(--zenith-border); padding-top: 20px; display: flex; flex-direction: column; gap: 10px;">
                    <button type="button" id="simpan" class="btn-zenith"><i class="fa fa-save"></i> Sinkronisasi Matriks</button>
                    <button type="button" id="hapus" class="btn-zenith" style="background: rgba(244, 63, 94, 0.2) !important; color: #f43f5e !important; border: 1px solid rgba(244, 63, 94, 0.3) !important;"><i class="fa fa-trash"></i> Hapus Level</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-key" style="color: var(--zenith-gold);"></i>
                    <h3 class="zenith-card-title">Matriks Izin</h3>
                </div>
                
                <div id="form-pesan"></div>
                <div style="max-height: 60vh; overflow-y: auto; padding-right: 15px;" class="ghost-scroll">
                    <?php if(!empty($data_menu)){ echo $data_menu; } ?>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

<script lang="javascript">
    $(function(){
        $('#simpan').click(function(){
            $("#modal-proses").modal('show');
            $('#aksi').val('1');
            $('#form-edit-level').submit();
        }); 
        $('#hapus').click(function(){
            $("#modal-proses").modal('show');
            $('#aksi').val('0');
            $('#form-edit-level').submit();
        });
        
        $('#form-edit-level').submit(function(){
                $.ajax({
                    url:"<?php echo site_url(); ?>/manager/userlevel/edit",
     			    type:"POST",
     			    data:$('#form-edit-level').serialize(),
     			    cache: false,
      		        success:function(respon){
         		    	var obj = $.parseJSON(respon);
      		            if(obj.status==1){
      		                $("#modal-proses").modal('hide');
      		                $('#form-pesan').html(pesan_succ(obj.pesan));
                            setTimeout(function(){ window.open("<?php echo site_url(); ?>/manager/userlevel","_self"); }, 1000);
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