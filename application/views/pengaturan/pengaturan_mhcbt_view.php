<!-- Zenith Elite Admin: Pengaturan Aplikasi -->
<section class="content-header">
    <h1 style="color: var(--zenith-cyan); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Konfigurasi Sistem
        <small style="color: #94a3b8;">Kelola Identitas Inti & Keamanan GHCBT</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-cyan);">Konfigurasi Sistem</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open_multipart($url.'/simpan','id="form-pengaturan"'); ?>
                <div class="zenith-card">
                    <div class="zenith-card-header">
                        <i class="fa fa-sliders" style="color: var(--zenith-gold); font-size: 20px;"></i>
                        <h3 class="zenith-card-title">Kontrol Utama GHCBT</h3>
                    </div>

                    <!-- Navigasi Tab Zenith -->
                    <div class="zenith-tabs-nav">
                        <a href="#tab-identity" class="zenith-tab-link active" data-toggle="tab">Pusat Identitas</a>
                        <a href="#tab-branding" class="zenith-tab-link" data-toggle="tab">Identitas Visual</a>
                        <a href="#tab-security" class="zenith-tab-link" data-toggle="tab">Keamanan & Logika</a>
                    </div>

                    <div id="form-pesan"></div>

                    <div class="tab-content" style="background: transparent;">
                        
                        <!-- TAB 1: PUSAT IDENTITAS -->
                        <div class="tab-pane active" id="tab-identity">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Nama Utama Aplikasi</label>
                                        <input type="text" class="zenith-control" id="mhcbt-nama" name="mhcbt-nama" placeholder="ZENITH SYSTEM">
                                        <small style="color: #64748b; font-style: italic;">Identitas sekunder aplikasi yang muncul di header/judul.</small>
                                    </div>
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Nama Madrasah / Instansi</label>
                                        <input type="text" class="zenith-control" id="mhcbt-nama-madrasah" name="mhcbt-nama-madrasah" placeholder="GHCBT ACADEMY">
                                        <small style="color: #64748b; font-style: italic;">Nama organisasi yang akan muncul di laporan PDF & kartu.</small>
                                    </div>
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Slogan / Keterangan Sistem</label>
                                        <input type="text" class="zenith-control" id="mhcbt-keterangan" name="mhcbt-keterangan" placeholder="High-End Computer Based Test Platform">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Tahun Ajaran Aktif</label>
                                        <input type="text" class="zenith-control" id="mhcbt-tahun-ajaran" name="mhcbt-tahun-ajaran" placeholder="2026/2027">
                                    </div>
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Nama Kepala Madrasah / Instansi</label>
                                        <input type="text" class="zenith-control" id="mhcbt-kepala-madrasah" name="mhcbt-kepala-madrasah" placeholder="Achmad Lutfi">
                                    </div>
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Tempat Penerbitan Kartu</label>
                                        <input type="text" class="zenith-control" id="mhcbt-tempat-cetak" name="mhcbt-tempat-cetak" placeholder="Jakarta">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: IDENTITAS VISUAL -->
                        <div class="tab-pane" id="tab-branding">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Logo Horizontal (PNG)</label>
                                        <div style="background: rgba(var(--primary-rgb), 0.05); border: 1px dashed var(--border-color); border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 10px;">
                                            <img id="preview-logo" src="<?php echo base_url('public/images/logo.png'); ?>?v=<?php echo time(); ?>" style="max-height: 50px; opacity: 0.8; filter: drop-shadow(0 0 5px var(--zenith-gold-glow));">
                                        </div>
                                        <input type="file" class="zenith-control" id="upload-logo" name="upload-logo" accept=".png">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Logo Vertikal / Kotak (PNG)</label>
                                        <div style="background: rgba(var(--primary-rgb), 0.05); border: 1px dashed var(--border-color); border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 10px;">
                                            <img id="preview-logo-modern" src="<?php echo base_url('public/images/logo_modern.png'); ?>?v=<?php echo time(); ?>" style="max-height: 50px; opacity: 0.8;">
                                        </div>
                                        <input type="file" class="zenith-control" id="upload-logo-modern" name="upload-logo-modern" accept=".png">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="zenith-input-group">
                                        <label class="zenith-label">Favicon Aplikasi (PNG/ICO)</label>
                                        <div style="background: rgba(var(--primary-rgb), 0.05); border: 1px dashed var(--border-color); border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 10px;">
                                            <img id="preview-favicon" src="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>" style="max-height: 50px; opacity: 0.8;">
                                        </div>
                                        <input type="file" class="zenith-control" id="upload-favicon" name="upload-favicon" accept=".png,.ico">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: KEAMANAN & LOGIKA -->
                        <div class="tab-pane" id="tab-security">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="zenith-input-group" style="display: flex; justify-content: space-between; align-items: center; background: rgba(var(--primary-rgb), 0.05); padding: 15px; border-radius: 12px; border: 1px solid var(--border-light); margin-bottom: 15px;">
                                        <div>
                                            <label class="zenith-label" style="margin-bottom: 2px;">Paksa Exambrowser</label>
                                            <small style="color: var(--text-muted);">Kunci akses ujian hanya melalui Exambrowser resmi.</small>
                                        </div>
                                        <label class="zenith-switch">
                                            <input type="checkbox" id="check-mobile-lock" onchange="$('#mhcbt-mobile-lock-xambro').val(this.checked ? 'ya' : 'tidak')">
                                            <span class="zenith-slider"></span>
                                        </label>
                                        <input type="hidden" id="mhcbt-mobile-lock-xambro" name="mhcbt-mobile-lock-xambro">
                                    </div>

                                    <div class="zenith-input-group" style="display: flex; justify-content: space-between; align-items: center; background: rgba(var(--primary-rgb), 0.05); padding: 15px; border-radius: 12px; border: 1px solid var(--border-light); margin-bottom: 15px;">
                                        <div>
                                            <label class="zenith-label" style="margin-bottom: 2px;">Proteksi Multi-Login</label>
                                            <small style="color: var(--text-muted);">Cegah satu akun login di dua perangkat sekaligus.</small>
                                        </div>
                                        <label class="zenith-switch">
                                            <input type="checkbox" id="check-multilogin" onchange="$('#mhcbt-proteksi-multilogin').val(this.checked ? 'ya' : 'tidak')">
                                            <span class="zenith-slider"></span>
                                        </label>
                                        <input type="hidden" id="mhcbt-proteksi-multilogin" name="mhcbt-proteksi-multilogin">
                                    </div>

                                    <div class="zenith-input-group" style="display: flex; justify-content: space-between; align-items: center; background: rgba(var(--primary-rgb), 0.05); padding: 15px; border-radius: 12px; border: 1px solid var(--border-light); margin-bottom: 15px;">
                                        <div>
                                            <label class="zenith-label" style="margin-bottom: 2px;">Tampilkan Link Operator</label>
                                            <small style="color: var(--text-muted);">Menampilkan 'Log In Operator' di portal siswa.</small>
                                        </div>
                                        <label class="zenith-switch">
                                            <input type="checkbox" id="check-link-login" onchange="$('#mhcbt-link-login').val(this.checked ? 'ya' : 'tidak')">
                                            <span class="zenith-slider"></span>
                                        </label>
                                        <input type="hidden" id="mhcbt-link-login" name="mhcbt-link-login">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="zenith-input-group" style="display: flex; justify-content: space-between; align-items: center; background: rgba(var(--primary-rgb), 0.05); padding: 15px; border-radius: 12px; border: 1px solid var(--border-light); margin-bottom: 15px;">
                                        <div>
                                            <label class="zenith-label" style="margin-bottom: 2px;">Selesaikan Tes saat Logout</label>
                                            <small style="color: var(--text-muted);">Tandai tes selesai otomatis jika siswa logout paksa.</small>
                                        </div>
                                        <label class="zenith-switch">
                                            <input type="checkbox" id="check-tutup-tes" onchange="$('#mhcbt-tutup-tes-saat-logout').val(this.checked ? 'ya' : 'tidak')">
                                            <span class="zenith-slider"></span>
                                        </label>
                                        <input type="hidden" id="mhcbt-tutup-tes-saat-logout" name="mhcbt-tutup-tes-saat-logout">
                                    </div>

                                    <div class="zenith-input-group" style="display: flex; justify-content: space-between; align-items: center; background: rgba(var(--primary-rgb), 0.05); padding: 15px; border-radius: 12px; border: 1px solid var(--border-light); margin-bottom: 15px;">
                                        <div>
                                            <label class="zenith-label" style="margin-bottom: 2px;">Hub Riwayat Siswa</label>
                                            <small style="color: var(--text-muted);">Izinkan siswa melihat riwayat nilai & ujian lama.</small>
                                        </div>
                                        <label class="zenith-switch">
                                            <input type="checkbox" id="check-history" onchange="$('#mhcbt-tampilkan-histori').val(this.checked ? 'ya' : 'tidak')">
                                            <span class="zenith-slider"></span>
                                        </label>
                                        <input type="hidden" id="mhcbt-tampilkan-histori" name="mhcbt-tampilkan-histori">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end tab content -->

                    <div style="margin-top: 30px; display: flex; justify-content: flex-end; border-top: 1px solid var(--zenith-border); padding-top: 25px;">
                        <button type="submit" id="btn-simpan" class="btn-zenith"><i class="fa fa-save"></i> Simpan Konfigurasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script lang="javascript">
    function load_data(){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_pengaturan_mhcbt', function(data){
            if(data.data==1){
                $('#mhcbt-nama').val(data.cbt_nama);
                $('#mhcbt-keterangan').val(data.cbt_keterangan);
                $('#mhcbt-nama-madrasah').val(data.cbt_nama_madrasah);
                $('#mhcbt-tahun-ajaran').val(data.cbt_tahun_ajaran);
                $('#mhcbt-kepala-madrasah').val(data.cbt_kepala_madrasah);
                $('#mhcbt-tempat-cetak').val(data.cbt_tempat_cetak);
                
                // Sync Hidden Inputs & Switches
                $('#mhcbt-link-login').val(data.link_login_operator);
                $('#check-link-login').prop('checked', data.link_login_operator === 'ya');
                
                $('#mhcbt-mobile-lock-xambro').val(data.mobile_lock_xambro);
                $('#check-mobile-lock').prop('checked', data.mobile_lock_xambro === 'ya');
                
                $('#mhcbt-proteksi-multilogin').val(data.proteksi_multilogin);
                $('#check-multilogin').prop('checked', data.proteksi_multilogin === 'ya');
                
                $('#mhcbt-tutup-tes-saat-logout').val(data.cbt_tutuptes_logout);
                $('#check-tutup-tes').prop('checked', data.cbt_tutuptes_logout === 'ya');
                
                $('#mhcbt-tampilkan-histori').val(data.cbt_show_history);
                $('#check-history').prop('checked', data.cbt_show_history === 'ya');
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
        load_data();
        
        // Tab switching logic for custom styled tabs
        $('.zenith-tab-link').on('click', function(e){
            e.preventDefault();
            $('.zenith-tab-link').removeClass('active');
            $(this).addClass('active');
        });

        $('#form-pengaturan').submit(function(){
            $("#modal-proses").modal('show');
            var formData = new FormData(this);
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan",
                    type:"POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
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