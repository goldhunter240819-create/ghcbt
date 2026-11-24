<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-area-chart"></i>
        </div>
        <div>
            <h2>System Monitor</h2>
            <p>Live Surveillance &bull; Telemetri Aktivitas User & Pantauan Heartbeat Server Real-time</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> LIVE TELEMETRY
    </div>
</div>

<style>
    .monitor-card-header {
        background: #ffffff;
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pulse-glow {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #10b981;
        margin-right: 10px;
        box-shadow: 0 0 10px #10b981;
    }

    .activity-row {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .activity-row:hover { 
        background: #fffbeb; 
    }

    .activity-avatar {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: #fffbeb;
        color: var(--gold-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 16px;
        border: 1px solid #fde68a;
        flex-shrink: 0;
    }

    .error-log-line {
        font-family: 'JetBrains Mono', 'Consolas', monospace;
        font-size: 11px;
        color: #991b1b;
        padding: 12px 16px;
        background: #fef2f2;
        border-radius: 12px;
        margin-bottom: 12px;
        border-left: 4px solid #ef4444;
        line-height: 1.6;
        word-break: break-all;
    }

    .ai-panel-elite {
        background: #ffffff;
        border: 1px solid #fde68a;
        border-radius: 20px;
        padding: 25px;
        box-shadow: var(--shadow-floating);
        margin-top: 25px;
        position: relative;
    }
</style>

<section class="content" style="padding: 0;">
    <div class="row row-flex-eq">
        <!-- Live Activity Stream -->
        <div class="col-md-7">
            <div class="elite-card" style="padding: 0 !important; overflow: hidden;">
                <div class="monitor-card-header">
                    <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 15px; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center;">
                        <span class="pulse-glow"></span> Telemetri Aktivitas Pengguna
                    </h3>
                    <div style="background: #ecfdf5; color: #059669; font-size: 10px; font-weight: 800; padding: 5px 12px; border-radius: 10px; border: 1px solid #a7f3d0; letter-spacing: 0.5px;">LIVE STREAM</div>
                </div>
                <div style="background: #ffffff; min-height: 480px; max-height: 580px; overflow-y: auto;" id="activity-viewport">
                    <div id="activity-list"></div>
                </div>
            </div>
        </div>

        <!-- System Heartbeat & AI -->
        <div class="col-md-5">
            <div class="elite-card" style="padding: 0 !important; overflow: hidden; margin-bottom: 0;">
                <div class="monitor-card-header" style="background: #fef2f2; border-bottom: 1px solid #fecdd3;">
                    <h3 style="margin: 0; font-weight: 800; color: #991b1b; font-size: 15px; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="fa fa-heartbeat" style="color: #ef4444; margin-right: 6px;"></i> Server Heartbeat & Errors
                    </h3>
                </div>
                <div style="background: #ffffff; padding: 20px; min-height: 280px; max-height: 380px; overflow-y: auto;">
                    <div id="error-heartbeat"></div>
                </div>
            </div>

            <!-- AI Assistant Panel -->
            <div id="ai-assistant-panel" class="ai-panel-elite" style="display:none;">
                <div style="display: flex; align-items: center; margin-bottom: 18px;">
                    <div style="width: 44px; height: 44px; border-radius: 14px; background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; margin-right: 15px; color: white; font-size: 18px; flex-shrink: 0;">
                        <i class="fa fa-bolt"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px;">AI Autonomous Diagnostic</h4>
                        <p style="margin: 3px 0 0; font-size: 11px; color: var(--gold-primary); font-weight: 700; text-transform: uppercase;">Deteksi Masalah Otomatis</p>
                    </div>
                </div>
                
                <p style="font-size: 13px; color: #475569; line-height: 1.6; margin-bottom: 18px;">
                    Sistem mendeteksi adanya sinyal error di server. Anda dapat menjalankan analisis mendalam untuk menemukan penyebab dan langkah solusinya.
                </p>
                
                <div id="ai-action-buttons" style="display: flex; gap: 10px;">
                    <button id="btn-self-heal" class="btn btn-gold-elite" style="flex: 1; padding: 12px !important; font-size: 11px !important;">
                        <i class="fa fa-search" style="margin-right: 5px;"></i> Run Analysis
                    </button>
                    <button id="btn-auto-fix" class="btn" style="flex: 1; padding: 12px !important; background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; font-weight: 800; border-radius: 12px; border: none; font-size: 11px; text-transform: uppercase;">
                        <i class="fa fa-wrench" style="margin-right: 5px;"></i> Auto-Repair
                    </button>
                </div>

                <div id="ai-diagnosis-result" style="display:none; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border-light);">
                    <div style="margin-bottom: 18px;">
                        <h5 style="color: #0f172a; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Akar Masalah (Root Analysis)</h5>
                        <div id="diag-analysis" style="font-size: 13px; color: #334155; background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid var(--border-light); line-height: 1.6;"></div>
                    </div>
                    
                    <div>
                        <h5 style="color: #b45309; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Strategi Perbaikan</h5>
                        <div id="diag-plan" style="font-size: 13px; color: #78350f; background: #fffbeb; padding: 14px; border-radius: 12px; border: 1px solid #fde68a; border-left: 4px solid #f59e0b; line-height: 1.6;"></div>
                    </div>

                    <div style="margin-top: 18px; padding-top: 15px; border-top: 1px dashed var(--border-light);">
                        <h5 style="color: #0891b2; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;"><i class="fa fa-map-marker"></i> Lokasi Berkas</h5>
                        <div id="diag-source" style="font-family: 'JetBrains Mono', monospace; font-size: 12px; color: #0e7490; background: #ecfeff; padding: 10px 16px; border-radius: 10px; border: 1px solid #a5f3fc; word-break: break-all;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        var lastError = null;

        function updateMonitor(){
            $.getJSON('<?php echo site_url("developer/get_live_activity"); ?>', function(data){
                // Update Activities
                var actHtml = '';
                if(data.activities && data.activities.length > 0){
                    $.each(data.activities, function(i, act){
                        actHtml += '<div class="activity-row">';
                        actHtml += '<div class="activity-avatar"><i class="fa fa-user"></i></div>';
                        actHtml += '<div>';
                        actHtml += '<h5 style="margin: 0; color: #0f172a; font-weight: 800; font-size: 13px;">' + act.username + ' <span style="font-weight: 600; color: var(--gold-primary); margin-left: 8px;">' + act.log + '</span></h5>';
                        actHtml += '<small style="color: #64748b; font-size: 11px; margin-top: 4px; display: block; font-weight: 600;"><i class="fa fa-clock-o"></i> ' + act.ts + '</small>';
                        actHtml += '</div></div>';
                    });
                } else {
                    actHtml = '<div class="text-center" style="padding: 60px 20px; color: #64748b;"><i class="fa fa-users" style="font-size: 40px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>Belum ada aktivitas user tercatat.</div>';
                }
                $('#activity-list').html(actHtml);

                // Update Errors
                var errHtml = '';
                if(data.errors && data.errors.length > 0){
                    var latestErrorInList = data.errors[0];
                    if(lastError !== null && lastError !== latestErrorInList){
                        notify_error('Sinyal anomali sistem terdeteksi! Periksa panel Heartbeat.');
                        $('#ai-assistant-panel').fadeIn();
                    }
                    lastError = latestErrorInList;

                    $.each(data.errors, function(i, line){
                        errHtml += '<div class="error-log-line">' + line + '</div>';
                    });
                } else {
                    errHtml = '<div class="text-center" style="padding: 70px 20px; color: #64748b;"><i class="fa fa-check-circle" style="font-size: 50px; margin-bottom: 12px; color: #10b981; display: block;"></i><h4 style="font-weight: 800; color: #0f172a; margin: 0 0 4px 0; text-transform: uppercase; font-size: 14px;">STATUS NORMAL</h4><p style="font-size: 12px; margin: 0; color: #64748b;">Tidak ada anomali atau sinyal error pada server.</p></div>';
                }
                $('#error-heartbeat').html(errHtml);
                
                if(data.errors && data.errors.length > 0){
                    $('#ai-assistant-panel').fadeIn();
                } else {
                    $('#ai-assistant-panel').fadeOut();
                    $('#ai-diagnosis-result').hide();
                }
            });
        }

        $('#btn-self-heal').click(function(){
            var logText = $('#error-heartbeat').text();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> Analyzing...');

            $.post('<?php echo site_url("developer/analyze_errors"); ?>', {logs: logText}, function(response){
                var data = JSON.parse(response);
                $('#diag-analysis').html(data.analysis);
                $('#diag-plan').html(data.fix_plan);
                $('#diag-source').html(data.source);
                $('#ai-diagnosis-result').fadeIn();
                btn.prop('disabled', false).html('<i class="fa fa-search"></i> Run Analysis');
            });
        });

        $('#btn-auto-fix').click(function(){
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> Repairing...');

            $.getJSON('<?php echo site_url("developer/auto_fix"); ?>', function(res){
                btn.prop('disabled', false).html('<i class="fa fa-wrench"></i> Auto-Repair');
                if(res.fixes && res.fixes.length > 0){
                    notify_success('Sistem berhasil dipulihkan: ' + res.fix_count + ' masalah teratasi.');
                } else {
                    notify_info('Integritas sistem sudah prima.');
                }
                updateMonitor();
            });
        });

        updateMonitor();
        setInterval(updateMonitor, 5000);
    });
</script>