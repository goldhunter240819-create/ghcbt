<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-shield"></i>
        </div>
        <div>
            <h2>Maintenance Mode</h2>
            <p>System Shield & Penguncian Akses Publik Selama Pemeliharaan atau Migrasi</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: <?php echo ($maintenance_mode == 'TRUE' ? '#ef4444' : '#10b981'); ?>; border-radius: 50%;"></span> 
        <?php echo ($maintenance_mode == 'TRUE' ? 'LOCKDOWN ACTIVE' : 'SYSTEM OPEN'); ?>
    </div>
</div>

<style>
    .status-pulse {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
    }
    .pulse-active { background: #ef4444; box-shadow: 0 0 10px #ef4444; }
    .pulse-inactive { background: #10b981; box-shadow: 0 0 10px #10b981; }

    .btn-lock {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: white !important;
        font-weight: 800 !important;
        border-radius: 12px !important;
        padding: 14px 30px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 13px;
        transition: all 0.25s ease;
    }
    .btn-unlock {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: white !important;
        font-weight: 800 !important;
        border-radius: 12px !important;
        padding: 14px 30px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 13px;
        transition: all 0.25s ease;
    }
    .btn-lock:hover, .btn-unlock:hover { transform: translateY(-2px); }
</style>

<section class="content" style="padding: 0;">
    <div class="row row-flex-eq">
        <div class="col-md-6">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="fa fa-lock" style="color: var(--gold-primary); margin-right: 6px;"></i> Global System Lockdown
                    </h3>
                </div>

                <div style="text-align: center; padding: 20px 0 30px 0;">
                    <div style="font-size: 70px; margin-bottom: 20px; color: <?php echo ($maintenance_mode == 'TRUE' ? '#ef4444' : 'var(--gold-primary)'); ?>;">
                        <i class="fa <?php echo ($maintenance_mode == 'TRUE' ? 'fa-shield' : 'fa-unlock-alt'); ?>"></i>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                        <span class="status-pulse <?php echo ($maintenance_mode == 'TRUE' ? 'pulse-active' : 'pulse-inactive'); ?>"></span>
                        <h4 style="color: #0f172a; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                            Status Engine: <span style="color: <?php echo ($maintenance_mode == 'TRUE' ? '#dc2626' : '#059669'); ?>;"><?php echo ($maintenance_mode == 'TRUE' ? 'LOCKED / TERKUNCI' : 'NOMINAL / TERBUKA'); ?></span>
                        </h4>
                    </div>
                    
                    <p style="color: #64748b; font-size: 13px; margin-top: 12px; line-height: 1.6; max-width: 85%; margin-left: auto; margin-right: auto;">
                        "Saat lockdown aktif, seluruh siswa dan operator non-developer tidak dapat mengakses atau login ke sistem ujian."
                    </p>
                </div>

                <div style="display: flex; justify-content: center; gap: 15px; padding-top: 20px; border-top: 1px solid var(--border-light);">
                    <?php if($maintenance_mode == 'FALSE'): ?>
                        <button class="btn btn-lock btn-toggle-maintenance" data-status="TRUE">
                            <i class="fa fa-power-off" style="margin-right: 6px;"></i> Aktifkan Lockdown
                        </button>
                    <?php else: ?>
                        <button class="btn btn-unlock btn-toggle-maintenance" data-status="FALSE">
                            <i class="fa fa-unlock" style="margin-right: 6px;"></i> Buka Akses Sistem
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 20px; padding: 25px; margin-bottom: 25px;">
                <h4 style="color: #92400e; font-weight: 800; font-size: 15px; margin: 0 0 12px 0; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-info-circle" style="color: #b45309;"></i> Protokol Pemeliharaan
                </h4>
                <p style="color: #78350f; line-height: 1.7; font-size: 13px; margin: 0;">
                    Mode ini digunakan saat Anda melakukan migrasi database besar, update source code, atau sinkronisasi berkas penting. <strong style="color: #92400e;">Siswa tidak akan dapat login</strong>, dan akan diarahkan ke halaman pemeliharaan resmi yang elegan.
                </p>
            </div>
            
            <div class="elite-card" style="text-align: center; padding: 30px; border-style: dashed !important;">
                <i class="fa fa-wifi" style="font-size: 45px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                <p style="color: #64748b; font-style: italic; font-size: 13px; margin: 0;">"Pemantauan jaringan dan diagnostik tetap berjalan di latar belakang selama masa pemeliharaan."</p>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.btn-toggle-maintenance').click(function(){
            var st = $(this).data('status');
            var pesanKonfirm = (st == 'TRUE') ? 'Aktifkan Maintenance Mode? Siswa tidak akan bisa login.' : 'Nonaktifkan Maintenance Mode? Sistem akan dibuka kembali untuk umum.';
            if(confirm(pesanKonfirm)){
                var btn = $(this);
                btn.prop('disabled', true);
                $.post('<?php echo site_url("developer/toggle_maintenance"); ?>', {status: st}, function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1){
                        notify_success(obj.pesan);
                        setTimeout(function(){ location.reload(); }, 1200);
                    }else{
                        notify_error(obj.pesan);
                        btn.prop('disabled', false);
                    }
                });
            }
        });
    });
</script>