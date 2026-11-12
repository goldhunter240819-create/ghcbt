<style>
    .command-center {
        background: var(--glass-bg) !important;
        backdrop-filter: blur(30px) !important;
        -webkit-backdrop-filter: blur(30px) !important;
        border: 1px solid rgba(245, 158, 11, 0.4) !important;
        border-radius: 40px !important;
        box-shadow: 0 30px 100px rgba(0, 0, 0, 0.8), inset 0 0 40px rgba(245, 158, 11, 0.05) !important;
        padding: 60px;
        position: relative;
        overflow: hidden;
        text-align: center;
        margin-top: 20px;
    }

    .command-center::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 4px;
        background: var(--gold-gradient);
        box-shadow: 0 0 30px var(--gold-primary);
        z-index: 10;
    }

    .grid-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(245, 158, 11, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.3;
        z-index: 0;
        pointer-events: none;
    }

    .session-hero {
        position: relative;
        z-index: 1;
        margin-bottom: 50px;
    }

    .session-hero .label {
        color: var(--gold-primary);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 5px;
        font-size: 14px;
        display: block;
        margin-bottom: 10px;
        text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
    }

    .huge-counter {
        font-size: 160px;
        font-weight: 900;
        background: var(--gold-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 0.8;
        letter-spacing: -5px;
        filter: drop-shadow(0 20px 40px rgba(245, 158, 11, 0.4));
        display: inline-block;
        position: relative;
    }

    .huge-counter::after {
        content: 'ACTIVE NEURAL PATHS';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 10px;
        letter-spacing: 8px;
        -webkit-text-fill-color: rgba(245, 158, 11, 0.6);
        white-space: nowrap;
    }

    .authority-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin: 60px auto;
        max-width: 800px;
        position: relative;
        z-index: 1;
    }

    .authority-node {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 24px;
        padding: 30px;
        transition: all 0.3s ease;
    }

    .authority-node:hover {
        border-color: var(--gold-primary);
        background: rgba(245, 158, 11, 0.05);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .authority-node i {
        font-size: 32px;
        color: var(--gold-primary);
        margin-bottom: 20px;
        opacity: 0.8;
    }

    .authority-node .value {
        font-size: 28px;
        font-weight: 900;
        color: #f8fafc;
        display: block;
    }

    .authority-node .desc {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #64748b;
        font-weight: 700;
    }

    .nuke-panel {
        background: rgba(244, 63, 94, 0.05);
        border: 1px solid rgba(244, 63, 94, 0.2);
        border-radius: 30px;
        padding: 40px;
        margin-top: 50px;
        position: relative;
        z-index: 1;
    }

    .btn-nuke-elite {
        background: linear-gradient(135deg, #f43f5e 0%, #9f1239 100%) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        color: white !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 25px 60px !important;
        border-radius: 20px !important;
        font-size: 18px !important;
        box-shadow: 0 15px 40px rgba(244, 63, 94, 0.4) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        display: inline-block;
        margin-bottom: 20px;
    }

    .btn-nuke-elite:hover {
        transform: scale(1.05) translateY(-5px);
        box-shadow: 0 25px 60px rgba(244, 63, 94, 0.6) !important;
        border-color: white !important;
    }

    .btn-nuke-elite:active {
        transform: scale(0.95);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 15px;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 100px;
        color: #10b981;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    .pulse {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 10px #10b981;
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
</style>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="command-center">
            <div class="grid-bg"></div>

            <div class="status-badge">
                <div class="pulse"></div>
                Command Presence Confirmed
            </div>

            <div class="session-hero">
                <span class="label">Ocular Telemetry</span>
                <div class="huge-counter" id="total-sessions-display">
                    <?php echo $total_sessions; ?>
                </div>
            </div>

            <div class="authority-grid">
                <div class="authority-node">
                    <i class="fa fa-users"></i>
                    <span class="value"><?php echo $total_sessions; ?></span>
                    <span class="desc">Neural Connections</span>
                </div>
                <div class="authority-node">
                    <i class="fa fa-shield"></i>
                    <span class="value"><?php echo $manager_sessions; ?></span>
                    <span class="desc">Authority Nodes</span>
                </div>
            </div>

            <div class="nuke-panel">
                <div style="font-size: 12px; color: #f43f5e; font-weight: 800; text-transform: uppercase; letter-spacing: 5px; margin-bottom: 25px;">Critical Action Layer</div>
                <button class="btn-nuke-elite" id="btn-nuke-sessions">
                    <i class="fa fa-bomb"></i> Detonate Neural Grid
                </button>
                <p style="color: #64748b; font-size: 12px; font-style: italic; max-width: 500px; margin: 0 auto; line-height: 1.6;">
                    "Initiating the detonation sequence will purge the entire session cache. Every active connection will be severed instantaneously."
                </p>
            </div>

            <div style="margin-top: 60px; color: rgba(245, 158, 11, 0.3); font-size: 10px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase;">
                GHCBT Presence Authority Engine // Unit-01
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#btn-nuke-sessions').click(function(){
            Swal.fire({
                title: 'OPERASI KRITIS!',
                text: 'Semua sesi akan dihapus dari server. Seluruh siswa dan admin akan dipaksa logout seketika.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                cancelButtonColor: '#1e293b',
                confirmButtonText: 'Iya, Ledakkan Grid!',
                cancelButtonText: 'Batalkan',
                background: '#1e293b',
                color: '#f8fafc'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Konfirmasi Terakhir',
                        text: 'Anda sangat yakin ingin meledakkan seluruh sesi aktif?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#f43f5e',
                        confirmButtonText: 'KONFIRMASI PENUH',
                        background: '#1e293b',
                        color: '#f8fafc'
                    }).then((final) => {
                        if(final.isConfirmed) {
                            $("#modal-proses").modal('show');
                            $.getJSON('<?php echo site_url("developer/nuke_sessions"); ?>', function(respon){
                                if(respon.status == 1){
                                    notify_success(respon.pesan);
                                    setTimeout(function(){
                                        window.location.href = '<?php echo site_url("manager/welcome"); ?>';
                                    }, 1500);
                                }
                                $("#modal-proses").modal('hide');
                            });
                        }
                    });
                }
            });
        });

        // Subtitle header refresh for developers
        $('.content-header h1').html('<span class="gold-text">Session Overlord</span> <small style="color: rgba(245, 158, 11, 0.6);">Neural Presence Authority</small>');
    });
</script>
