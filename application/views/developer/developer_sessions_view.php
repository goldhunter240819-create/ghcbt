<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-users"></i>
        </div>
        <div>
            <h2>Session Overlord</h2>
            <p>Pemantauan Sesi Aktif Global & Manajemen Pembubaran Sesi Pengguna Seketika</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> SESSIONS ONLINE
    </div>
</div>

<style>
    .command-center {
        background: #ffffff !important;
        border: 1px solid var(--border-light) !important;
        border-radius: 24px !important;
        box-shadow: var(--shadow-floating) !important;
        padding: 40px;
        position: relative;
        text-align: center;
    }

    .session-hero {
        margin-bottom: 30px;
    }

    .session-hero .label {
        color: var(--gold-primary);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 12px;
        display: block;
        margin-bottom: 10px;
    }

    .huge-counter {
        font-size: 110px;
        font-weight: 900;
        color: #b45309;
        line-height: 1;
        letter-spacing: -2px;
        display: inline-block;
    }

    .authority-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin: 30px auto;
        max-width: 650px;
    }

    .authority-node {
        background: #f8fafc;
        border: 1px solid var(--border-light);
        border-radius: 18px;
        padding: 22px;
        transition: all 0.25s ease;
    }

    .authority-node:hover {
        border-color: #fde68a;
        background: #fffbeb;
        transform: translateY(-2px);
    }

    .authority-node i {
        font-size: 26px;
        color: var(--gold-primary);
        margin-bottom: 12px;
    }

    .authority-node .value {
        font-size: 26px;
        font-weight: 900;
        color: #0f172a;
        display: block;
    }

    .authority-node .desc {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        font-weight: 700;
        margin-top: 4px;
        display: block;
    }

    .nuke-panel {
        background: #fef2f2;
        border: 1px solid #fecdd3;
        border-radius: 20px;
        padding: 30px;
        margin-top: 35px;
    }

    .btn-nuke-elite {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: white !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 16px 40px !important;
        border-radius: 14px !important;
        font-size: 14px !important;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        border: none !important;
        cursor: pointer;
        display: inline-block;
        margin-bottom: 12px;
        transition: all 0.25s ease;
    }

    .btn-nuke-elite:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
    }
</style>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="command-center">

            <div class="session-hero">
                <span class="label">Total Sesi Pengguna Aktif</span>
                <div class="huge-counter" id="total-sessions-display">
                    <?php echo $total_sessions; ?>
                </div>
            </div>

            <div class="authority-grid">
                <div class="authority-node">
                    <i class="fa fa-users"></i>
                    <span class="value"><?php echo $total_sessions; ?></span>
                    <span class="desc">Koneksi Sesi Terbuka</span>
                </div>
                <div class="authority-node">
                    <i class="fa fa-shield"></i>
                    <span class="value"><?php echo $manager_sessions; ?></span>
                    <span class="desc">Sesi Tingkat Admin/Pengawas</span>
                </div>
            </div>

            <div class="nuke-panel">
                <div style="font-size: 12px; color: #dc2626; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px;">
                    <i class="fa fa-warning"></i> Operasi Kritis: Flush Sesi
                </div>
                <button class="btn-nuke-elite" id="btn-nuke-sessions">
                    <i class="fa fa-bomb" style="margin-right: 6px;"></i> Detonate All Sessions
                </button>
                <p style="color: #991b1b; font-size: 12px; max-width: 500px; margin: 0 auto; line-height: 1.6;">
                    "Menjalankan operasi ini akan membersihkan seluruh berkas sesi di server. Seluruh user (siswa, pengawas, dan admin) akan dipaksa logout seketika."
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#btn-nuke-sessions').click(function(){
            if(confirm('OPERASI KRITIS!\n\nSemua sesi akan dihapus dari server. Seluruh siswa dan admin akan dipaksa logout seketika.\n\nLanjutkan?')){
                if(confirm('KONFIRMASI TERAKHIR: Anda yakin ingin membubarkan seluruh sesi aktif?')){
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mereset...');
                    $.getJSON('<?php echo site_url("developer/nuke_sessions"); ?>', function(respon){
                        if(respon.status == 1){
                            notify_success(respon.pesan);
                            setTimeout(function(){
                                window.location.href = '<?php echo site_url("manager/welcome"); ?>';
                            }, 1500);
                        } else {
                            notify_error(respon.pesan);
                            btn.prop('disabled', false).html('<i class="fa fa-bomb"></i> Detonate All Sessions');
                        }
                    });
                }
            }
        });
    });
</script>