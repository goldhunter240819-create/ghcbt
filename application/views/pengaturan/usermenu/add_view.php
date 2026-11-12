<!-- Zenith Elite Admin: Inisialisasi Navigasi -->
<section class="content-header">
    <h1 style="color: var(--zenith-cyan); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Inisialisasi Navigasi
        <small style="color: #94a3b8;">Bangun Jalur Akses & Komponen Menu Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-cyan);">Inisialisasi Navigasi</li>
    </ol>
</section>

<section class="content">
    <?php echo form_open('manager/usermenu/add','id="form-tambah-menu" class="form-horizontal"')?>
    <div class="row">
        <div class="col-md-5">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-plus-square" style="color: var(--zenith-gold);"></i>
                    <h3 class="zenith-card-title">Konfigurasi Jalur</h3>
                </div>
                
                <div id="form-pesan"></div>
                <div class="zenith-input-group">
                    <label class="zenith-label">Klasifikasi Menu (Tipe)</label>
                    <select name="tipe" id="tipe" class="zenith-control">
                        <option value="1">Sub-Menu (Child)</option>
                        <option value="0">Induk Utama (Parent)</option>                                
                    </select>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Penugasan Induk (Parent)</label>
                    <div style="background: rgba(15,23,42,0.4); border-radius: 8px; padding: 5px;">
                        <?php if(!empty($parent)){ echo $parent; } ?>
                    </div>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Identitas Sistem (Kode Menu)</label>
                    <input type="text" class="zenith-control" id="kode" name="kode" placeholder="Contoh: menu-01">
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="zenith-card">
                <div class="zenith-card-header">
                    <i class="fa fa-info-circle" style="color: var(--zenith-cyan);"></i>
                    <h3 class="zenith-card-title">Atribut Navigasi</h3>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Nomenklatur Menu (Nama Tampilan)</label>
                    <input type="text" class="zenith-control" id="nama" name="nama" placeholder="Nama Menu">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="zenith-input-group">
                            <label class="zenith-label">Jalur Akses (URL)</label>
                            <input type="text" class="zenith-control" id="url" name="url" value="#">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="zenith-input-group">
                            <label class="zenith-label">Ikon Visual (FontAwesome)</label>
                            <input type="text" class="zenith-control" id="icon" name="icon" value="fa fa-circle-o">
                        </div>
                    </div>
                </div>

                <div class="zenith-input-group">
                    <label class="zenith-label">Urutan Prioritas</label>
                    <input type="text" class="zenith-control" id="urutan" name="urutan" placeholder="Contoh: 1">
                </div>

                <div style="margin-top: 40px; border-top: 1px solid var(--zenith-border); padding-top: 25px; display: flex; justify-content: flex-end;">
                    <button type="submit" id="btn-simpan" class="btn-zenith"><i class="fa fa-save"></i> Sinkronisasi rute Baru</button>
                </div>
            </div>
        </div>
    </div>
</form>
</section>

<script lang="javascript">
    $(function(){
        $('#tipe').change(function(){
            if($('#tipe').val()==0){
                $('#parent').attr('disabled','disabled');
            }else{
                 $('#parent').removeAttr('disabled');
            }
        });
        
        $('#form-tambah-menu').submit(function(){
            $("#modal-proses").modal('show');
                $.ajax({
                    url:"<?php echo site_url(); ?>/manager/usermenu/add",
     			    type:"POST",
     			    data:$('#form-tambah-menu').serialize(),
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