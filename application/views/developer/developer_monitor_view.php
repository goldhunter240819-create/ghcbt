<style>
    .monitor-header {
        background: rgba(15, 23, 42, 0.95);
        padding: 25px 35px;
        border-bottom: 1px solid rgba(245, 158, 11, 0.2);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pulse-glow {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--gold-primary);
        margin-right: 15px;
        box-shadow: 0 0 15px var(--gold-primary);
        animation: pulse-gold 2s infinite;
    }

    @keyframes pulse-gold {
        0% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 5px var(--gold-primary); }
        50% { transform: scale(1.4); opacity: 1; box-shadow: 0 0 25px var(--gold-primary); }
        100% { transform: scale(0.9); opacity: 0.8; box-shadow: 0 0 5px var(--gold-primary); }
    }

    .activity-row {
        padding: 22px 35px;
        border-bottom: 1px solid rgba(245, 158, 11, 0.05);
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .activity-row:hover { 
        background: rgba(245, 158, 11, 0.03); 
    }

    .activity-avatar {
        width: 46px; height: 46px;
        border-radius: 16px;
        background: rgba(245, 158, 11, 0.08);
        color: var(--gold-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 20px;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .error-log-line {
        font-family: 'JetBrains Mono', monospace;
        font-size: 11px;
        color: #fca5a5;
        padding: 15px 20px;
        background: rgba(244, 63, 94, 0.05);
        border-radius: 16px;
        margin-bottom: 15px;
        border-left: 4px solid #f43f5e;
        line-height: 1.6;
    }

    .ai-panel-elite {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.7) 0%, rgba(30, 41, 59, 0.7) 100%);
        backdrop-filter: blur(40px);
        -webkit-backdrop-filter: blur(40px);
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 40px;
        padding: 45px;
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.7);
        margin-top: 30px;
        position: relative;
        overflow: hidden;
        animation: panel-glow 4s infinite alternate;
    }

    @keyframes panel-glow {
        from { box-shadow: 0 40px 100px rgba(0, 0, 0, 0.7); border-color: rgba(245, 158, 11, 0.2); }
        to { box-shadow: 0 40px 100px rgba(245, 158, 11, 0.05); border-color: rgba(245, 158, 11, 0.5); }
    }

    .telemetry-card {
        background: rgba(15, 23, 42, 0.6) !important;
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255,255,255,0.05) !important;
        border-radius: 35px !important;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
</style>

<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Live Surveillance</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Real-time Neural Stream</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <!-- Live Activity Stream -->
        <div class="col-md-7">
            <div class="telemetry-card">
                <div class="monitor-header">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; display: flex; align-items: center;">
                        <span class="pulse-glow"></span> ACTIVITY TELEMETRY
                    </h3>
                    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 10px; font-weight: 900; padding: 6px 14px; border-radius: 12px; border: 1px solid rgba(16,185,129,0.3); letter-spacing: 1px;">NEURAL STREAM</div>
                </div>
                <div style="background: rgba(2, 6, 23, 0.2); min-height: 550px; max-height: 650px; overflow-y: auto;" id="activity-viewport">
                    <div id="activity-list"></div>
                </div>
            </div>
        </div>

        <!-- System Heartbeat & AI -->
        <div class="col-md-5">
            <div class="telemetry-card" style="margin-bottom: 0;">
                <div class="monitor-header" style="background: rgba(244, 63, 94, 0.05); border-bottom-color: rgba(244, 63, 94, 0.1);">
                    <h3 style="margin:0; font-weight: 900; color: #fca5a5; font-size: 16px; text-transform: uppercase; letter-spacing: 2px;"><i class="fa fa-heartbeat"></i> Heartbeat log</h3>
                </div>
                <div style="background: rgba(2, 6, 23, 0.4); padding: 30px; min-height: 350px; max-height: 450px; overflow-y: auto;">
                    <div id="error-heartbeat"></div>
                </div>
            </div>

            <!-- AI Assistant Panel -->
            <div id="ai-assistant-panel" class="ai-panel-elite" style="display:none;">
                <div style="display: flex; align-items: center; margin-bottom: 25px;">
                    <div style="width: 50px; height: 50px; border-radius: 18px; background: var(--gold-gradient); display: flex; align-items: center; justify-content: center; margin-right: 20px; box-shadow: var(--gold-glow-strong); border: 2px solid white;">
                        <i class="fa fa-bolt" style="font-size: 22px; color: #0f172a;"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-weight: 900; color: #f8fafc; font-size: 15px; text-transform: uppercase; letter-spacing: 1px;">AI Neural Repair</h4>
                        <p style="margin:0; font-size: 11px; color: var(--gold-primary); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Autonomous Diagnostic protocol</p>
                    </div>
                </div>
                
                <p style="font-size: 13px; color: #94a3b8; line-height: 1.7; margin-bottom: 25px;">Sistem mendeteksi adanya kegagalan eksekusi. Aktifkan protokol analisa untuk membedah akar masalah.</p>
                
                <div id="ai-action-buttons" style="display: flex; gap: 10px;">
                    <button id="btn-self-heal" class="btn btn-gold-elite" style="flex: 1; padding: 15px !important;">
                        <i class="fa fa-search"></i> Run Analysis
                    </button>
                    <button id="btn-auto-fix" class="btn btn-gold-elite" style="flex: 1; padding: 15px !important; background: linear-gradient(135deg, #06b6d4, #0891b2); border-color: rgba(6,182,212,0.3);">
                        <i class="fa fa-wrench"></i> Auto-Repair
                    </button>
                </div>

                <div id="ai-diagnosis-result" style="display:none; margin-top: 30px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
                    <div style="margin-bottom: 25px;">
                        <h5 style="color: var(--gold-primary); font-weight: 900; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px;">Root Analysis</h5>
                        <div id="diag-analysis" style="font-size: 13px; color: #cbd5e1; background: rgba(0,0,0,0.4); padding: 20px; border-radius: 18px; border: 1px solid rgba(245, 158, 11, 0.1); line-height: 1.8;"></div>
                    </div>
                    
                    <div>
                        <h5 style="color: #f59e0b; font-weight: 900; font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">Repair Strategy</h5>
                        <div id="diag-plan" style="font-size: 13px; color: #fef3c7; background: rgba(245, 158, 11, 0.05); padding: 15px; border-radius: 16px; border: 1px solid rgba(245, 158, 11, 0.1); border-left: 4px solid #f59e0b; line-height: 1.6;"></div>
                    </div>

                    <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed rgba(245, 158, 11, 0.2);">
                        <h5 style="color: #06b6d4; font-weight: 900; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;"><i class="fa fa-map-marker"></i> Anomaly Coordinates</h5>
                        <div id="diag-source" style="font-family: 'JetBrains Mono', monospace; font-size: 12px; color: #a5f3fc; background: rgba(6, 182, 212, 0.1); padding: 12px 20px; border-radius: 14px; border: 1px solid rgba(6, 182, 212, 0.2); word-break: break-all;"></div>
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
                $.each(data.activities, function(i, act){
                    actHtml += '<div class="activity-row">';
                    actHtml += '<div class="activity-avatar"><i class="fa fa-user"></i></div>';
                    actHtml += '<div>';
                    actHtml += '<h5 style="margin:0; color:#f8fafc; font-weight:900; font-size:14px;">' + act.username + ' <span style="font-weight:600; color:var(--gold-primary); margin-left:10px;">' + act.log + '</span></h5>';
                    actHtml += '<small style="color:rgba(245, 158, 11, 0.6); font-size:11px; text-transform:uppercase; letter-spacing:1px; margin-top:5px; display:block; font-weight:700;"><i class="fa fa-clock-o"></i> ' + act.ts + '</small>';
                    actHtml += '</div></div>';
                });
                $('#activity-list').html(actHtml);

                // Update Errors
                var errHtml = '';
                if(data.errors.length > 0){
                    var latestErrorInList = data.errors[0];
                    if(lastError !== null && lastError !== latestErrorInList){
                        notify_error('NEW SYSTEM ANOMALY DETECTED! Check the Heartbeat feed.');
                        $('#ai-assistant-panel').fadeIn();
                        $(document).trigger('ghcbt:new-error', [latestErrorInList]);
                    }
                    lastError = latestErrorInList;

                    $.each(data.errors, function(i, line){
                        errHtml += '<div class="error-log-line">' + line + '</div>';
                    });
                } else {
                    errHtml = '<div class="text-center" style="padding: 100px 40px; color: #334155;"><i class="fa fa-shield" style="font-size: 80px; margin-bottom: 25px; opacity:0.1; color: var(--gold-primary); filter: drop-shadow(0 0 15px rgba(245, 158, 11, 0.2));"></i><br><h4 style="font-weight:900; color:#cbd5e1; margin:0; text-transform: uppercase; letter-spacing: 2px;">SYSTEM NOMINAL</h4><p style="font-size:12px; margin-top:5px; color: #64748b;">No active error signals detected.</p></div>';
                }
                $('#error-heartbeat').html(errHtml);
                
                if(data.errors.length > 0){
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
            ZenithVoice.speak("Initiating neural analysis. Please wait.");
            btn.prop('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> Analyzing...');

            $.post('<?php echo site_url("developer/analyze_errors"); ?>', {logs: logText}, function(response){
                var data = JSON.parse(response);
                $('#diag-analysis').html(data.analysis);
                $('#diag-plan').html(data.fix_plan);
                $('#diag-source').html(data.source);
                $('#ai-diagnosis-result').fadeIn();
                ZenithVoice.speak("Analysis complete. Location identified.");
                btn.prop('disabled', false).html('<i class="fa fa-search"></i> Run Analysis');
            });
        });

        $('#btn-auto-fix').click(function(){
            var btn = $(this);
            ZenithVoice.speak("Engaging system repair protocols. Stabilizing environment.");
            btn.prop('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> Repairing...');

            $.getJSON('<?php echo site_url("developer/auto_fix"); ?>', function(res){
                btn.prop('disabled', false).html('<i class="fa fa-wrench"></i> Auto-Repair');
                if(res.fixes && res.fixes.length > 0){
                    notify_success('System Repaired. ' + res.fix_count + ' anomalies resolved.');
                    ZenithVoice.speak("System restored. Anomalies resolved.");
                } else {
                    notify_info('System Integrity Nominal. No repairs needed.');
                    ZenithVoice.speak("System integrity is already at nominal levels.");
                }
                updateMonitor();
            });
        });

        updateMonitor();
        setInterval(updateMonitor, 5000);
    });
</script>
