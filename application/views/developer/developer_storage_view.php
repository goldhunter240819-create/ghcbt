<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-hdd-o"></i>
        </div>
        <div>
            <h2>Storage Hub</h2>
            <p>Manajemen Kapasitas Penyimpanan Node & Pembersihan Berkas Sampah (Cache/Temp)</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> STORAGE HEALTHY
    </div>
</div>

<style>
    .storage-progress-container {
        height: 10px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        margin: 10px 0 20px 0;
    }

    .storage-progress-bar {
        height: 100%;
        background: var(--primary-gradient);
        border-radius: 10px;
    }

    .cleanup-box {
        background: #f8fafc;
        border: 1px solid var(--border-light);
        border-radius: 16px;
        padding: 24px;
        transition: all 0.25s ease;
    }

    .cleanup-box:hover {
        background: #fffbeb;
        border-color: #fde68a;
        transform: translateY(-2px);
    }
</style>

<section class="content" style="padding: 0;">
    <div class="row row-flex-eq">
        <!-- Main Stats -->
        <div class="col-md-4">
            <div class="elite-card">
                <div style="display: flex; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="fa fa-pie-chart" style="color: var(--gold-primary); margin-right: 6px;"></i> Kapasitas Data
                    </h3>
                </div>

                <div style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                        <label style="color: #475569; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin: 0;">Upload Assets</label>
                        <span style="color: var(--gold-primary); font-weight: 900; font-size: 18px;"><?php echo $uploads_size; ?> <small style="font-size: 11px; color: #64748b;">MB</small></span>
                    </div>
                    <div class="storage-progress-container">
                        <div class="storage-progress-bar" style="width: <?php echo min(100, $uploads_size / 2); ?>%;"></div>
                    </div>
                </div>

                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                        <label style="color: #475569; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin: 0;">System Recovery / Backups</label>
                        <span style="color: #059669; font-weight: 900; font-size: 18px;"><?php echo $backups_size; ?> <small style="font-size: 11px; color: #64748b;">MB</small></span>
                    </div>
                    <div class="storage-progress-container">
                        <div class="storage-progress-bar" style="width: <?php echo min(100, $backups_size / 2); ?>%; background: linear-gradient(to right, #10b981, #059669);"></div>
                    </div>
                </div>

                <div style="margin-top: auto; padding-top: 20px; text-align: center;">
                    <i class="fa fa-hdd-o" style="font-size: 50px; color: #cbd5e1;"></i>
                </div>
            </div>
        </div>

        <!-- Cleanup Tools -->
        <div class="col-md-8">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="fa fa-recycle" style="color: var(--gold-primary); margin-right: 6px;"></i> Rekayasa Pembersihan (Cleanup)
                    </h3>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="cleanup-box">
                            <h4 style="color: #0f172a; font-weight: 800; font-size: 15px; margin-top: 0;">Purge Core Cache</h4>
                            <p style="color: #64748b; font-size: 12px; line-height: 1.6; min-height: 40px; margin-bottom: 15px;">Hapus file cache internal CodeIgniter di folder <code>application/cache</code> untuk refresh query.</p>
                            <button class="btn btn-block btn-gold-elite btn-cleanup" data-type="cache" style="padding: 10px !important; font-size: 11px !important;">
                                <i class="fa fa-fire" style="margin-right: 5px;"></i> Bersihkan Cache
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="cleanup-box">
                            <h4 style="color: #0f172a; font-weight: 800; font-size: 15px; margin-top: 0;">Purge Temp Files</h4>
                            <p style="color: #64748b; font-size: 12px; line-height: 1.6; min-height: 40px; margin-bottom: 15px;">Bersihkan sisa update dan file fragmentasi sementara hasil sinkronisasi sistem.</p>
                            <button class="btn btn-block btn-gold-elite btn-cleanup" data-type="temp" style="padding: 10px !important; font-size: 11px !important;">
                                <i class="fa fa-refresh" style="margin-right: 5px;"></i> Bersihkan Temp
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.btn-cleanup').click(function(){
            var type = $(this).data('type');
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

            $.post('<?php echo site_url("developer/purge_storage"); ?>', {type: type}, function(respon){
                btn.prop('disabled', false).html('<i class="fa fa-check"></i> Selesai');
                var obj = $.parseJSON(respon);
                if(obj.status == 1){
                    notify_success(obj.pesan);
                    setTimeout(function(){ location.reload(); }, 1200);
                }else{
                    notify_error(obj.pesan);
                }
            });
        });
    });
</script>