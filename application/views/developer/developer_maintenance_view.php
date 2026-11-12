<style>
    .status-pulse {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 12px;
        position: relative;
    }
    .pulse-active { background: #f43f5e; box-shadow: 0 0 15px #f43f5e; animation: pulse-red 2s infinite; }
    .pulse-inactive { background: #10b981; box-shadow: 0 0 15px #10b981; animation: pulse-green 2s infinite; }
    
    @keyframes pulse-red { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }
    @keyframes pulse-green { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }

    .btn-lock {
        background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important;
        border: 2px solid white !important;
        color: white !important;
        font-weight: 900 !important;
        border-radius: 12px !important;
        padding: 15px 35px !important;
        box-shadow: 0 10px 25px rgba(244, 63, 94, 0.4) !important;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
    }
    .btn-unlock {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: 2px solid white !important;
        color: white !important;
        font-weight: 900 !important;
        border-radius: 12px !important;
        padding: 15px 35px !important;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4) !important;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
    }
    .btn-lock:hover, .btn-unlock:hover { transform: translateY(-3px) scale(1.02); }
</style>

<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Maintenance Mode</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">System Shield & Safety Lock</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <div class="col-md-6">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Global System Lockdown</h3>
                </div>

                <div style="text-align: center; padding: 20px 0 40px 0;">
                    <div style="font-size: 80px; margin-bottom: 25px; color: <?php echo ($maintenance_mode == 'TRUE' ? '#f43f5e' : 'var(--gold-primary)'); ?>; filter: drop-shadow(0 0 20px <?php echo ($maintenance_mode == 'TRUE' ? 'rgba(244,63,94,0.4)' : 'rgba(245,158,11,0.4)'); ?>);">
                        <i class="fa <?php echo ($maintenance_mode == 'TRUE' ? 'fa-shield' : 'fa-unlock-alt'); ?>"></i>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                        <span class="status-pulse <?php echo ($maintenance_mode == 'TRUE' ? 'pulse-active' : 'pulse-inactive'); ?>"></span>
                        <h4 style="color: #cbd5e1; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: 2px;">
                            System: <span style="color: <?php echo ($maintenance_mode == 'TRUE' ? '#f43f5e' : '#10b981'); ?>;"><?php echo ($maintenance_mode == 'TRUE' ? 'LOCKED' : 'NOMINAL'); ?></span>
                        </h4>
                    </div>
                    
                    <p style="color: #64748b; font-size: 14px; margin-top: 15px; line-height: 1.6; max-width: 80%; margin-left: auto; margin-right: auto;">
                        "Saat lockdown aktif, seluruh operasional publik engine terhenti. Hanya akses tingkat Developer yang diizinkan melintasi shield."
                    </p>
                </div>

                <div style="display: flex; justify-content: center; gap: 20px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
                    <?php if($maintenance_mode == 'FALSE'): ?>
                        <button class="btn btn-lock btn-toggle-maintenance" data-status="TRUE">
                            <i class="fa fa-power-off"></i> Activate Lockdown
                        </button>
                    <?php else: ?>
                        <button class="btn btn-unlock btn-toggle-maintenance" data-status="FALSE">
                            <i class="fa fa-unlock"></i> Restore Access
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div style="background: rgba(245, 158, 11, 0.05); border: 2px solid var(--gold-primary); border-radius: 24px; padding: 30px; box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.1);">
                <h4 style="color: var(--gold-primary); font-weight: 900; font-size: 16px; margin-bottom: 20px;"><i class="fa fa-info-circle"></i> Protocol Note</h4>
                <p style="color: #94a3b8; line-height: 1.8; font-size: 14px;">
                    Mode ini digunakan saat Anda melakukan injeksi database besar atau migrasi aset inti. <span class="gold-text">Siswa tidak akan bisa login</span>, dan mereka akan disambut dengan tampilan pemberitahuan yang estetik.
                </p>
            </div>
            
            <div class="elite-card" style="margin-top: 30px; text-align: center; padding: 40px; opacity: 0.5; border-style: dashed !important;">
                <i class="fa fa-wifi" style="font-size: 50px; color: #475569; margin-bottom: 20px;"></i>
                <p style="color: #64748b; font-style: italic; font-size: 13px;">"Neural network connection continues to monitor system integrity during lockdowns."</p>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.btn-toggle-maintenance').click(function(){
            var status = $(this).data('status');
            var msg = (status == 'TRUE' ? 'Apakah Anda yakin ingin MENGUNCI seluruh sistem? Semua user aktif akan terputus.' : 'Apakah Anda yakin ingin MEMBUKA sistem kembali?');
            
            if(confirm(msg)){
                $("#modal-proses").modal('show');
                $.post('<?php echo site_url("developer/toggle_maintenance"); ?>', {status: status}, function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1){
                        notify_success(obj.pesan);
                        if(status == 'TRUE') $(document).trigger('ghcbt:maintenance-on');
                        else                 $(document).trigger('ghcbt:maintenance-off');
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else{
                        notify_error(obj.pesan);
                    }
                    $("#modal-proses").modal('hide');
                });
            }
        });
    });
</script>
