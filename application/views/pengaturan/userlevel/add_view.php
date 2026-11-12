<!-- Zenith Elite Admin: Pembuatan Level -->
<section class="content-header">
    <h1 style="color: var(--zenith-gold); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Inisialisasi Otoritas
        <small style="color: #94a3b8;">Tetapkan Izin Keamanan & Peran Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-gold);">Inisialisasi Otoritas</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open('manager/userlevel/add','id="form-tambah-level" class="form-horizontal"')?>
    <div class="row">
        <div class="col-md-4">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-plus-circle" style="color: var(--zenith-cyan);"></i>
                    <h3 class="zenith-card-title">Identitas Peran Baru</h3>
                </div>
                
                <div class="zenith-input-group">
                    <label class="zenith-label">Nama Level (Unik)</label>
                    <input type="text" class="zenith-control" id="level" name="level" placeholder="Contoh: SUPERVISOR">
                </div>
                
                <div class="zenith-input-group">
                    <label class="zenith-label">Deskripsi Peran</label>
                    <input type="text" class="zenith-control" id="keterangan" name="keterangan" placeholder="Jelaskan tujuan level ini">
                </div>

                <div style="margin-top: 40px; border-top: 1px solid var(--zenith-border); padding-top: 20px;">
                    <button type="submit" id="btn-simpan" class="btn-zenith" style="width: 100%;"><i class="fa fa-save"></i> Sinkronisasi Peran Baru</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-key" style="color: var(--zenith-gold);"></i>
                    <h3 class="zenith-card-title">Matriks Izin Awal</h3>
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
        $('#form-tambah-level').submit(function(){
            $("#modal-proses").modal('show');
                $.ajax({
                    url:"<?php echo site_url(); ?>/manager/userlevel/add",
     			    type:"POST",
     			    data:$('#form-tambah-level').serialize(),
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