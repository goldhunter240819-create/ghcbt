<style>
    .scanner-spinner {
        border: 4px solid rgba(245, 158, 11, 0.05);
        border-top: 4px solid var(--gold-primary);
        border-radius: 50%;
        width: 70px;
        height: 70px;
        animation: spin 0.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) infinite;
        margin: 0 auto 30px auto;
        box-shadow: 0 0 30px rgba(245, 158, 11, 0.4);
    }

    .fix-spinner {
        border: 4px solid rgba(6, 182, 212, 0.05);
        border-top: 4px solid #06b6d4;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        animation: spin 0.6s linear infinite;
        margin: 0 auto 30px auto;
        box-shadow: 0 0 30px rgba(6, 182, 212, 0.4);
    }

    .error-item-elite {
        background: rgba(244, 63, 94, 0.03);
        border: 1px solid rgba(244, 63, 94, 0.2);
        border-radius: 24px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .error-pre-elite {
        background: #000000 !important;
        color: #fca5a5 !important;
        border: 1px solid rgba(244, 63, 94, 0.2) !important;
        border-radius: 16px;
        padding: 20px;
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-size: 13px;
        line-height: 1.8;
    }

    .fix-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 18px;
        border-radius: 14px;
        margin-bottom: 10px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.6;
        transition: all 0.2s;
    }

    .fix-item.ok       { background: rgba(16, 185, 129, 0.06);  border: 1px solid rgba(16, 185, 129, 0.15); color: #86efac; }
    .fix-item.repaired { background: rgba(6, 182, 212, 0.08);   border: 1px solid rgba(6, 182, 212, 0.25);  color: #67e8f9; }
    .fix-item.warning  { background: rgba(245, 158, 11, 0.06);  border: 1px solid rgba(245, 158, 11, 0.2);  color: #fde68a; }
    .fix-item.icon     { font-size: 18px; flex-shrink: 0; margin-top: 2px; }

    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>

<section class="content-header" style="padding: 35px 35px 10px 35px;">
    <h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
        <span class="gold-text">Integrity Guard</span>
        <small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Neural Syntax Validator & Smart Auto-Fix</small>
    </h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">

        <!-- LEFT: Syntax Scanner -->
        <div class="col-md-7">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <div>
                        <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Syntax Scanner</h3>
                        <p style="margin:4px 0 0; font-size: 11px; color: rgba(245,158,11,0.6); text-transform: uppercase; letter-spacing: 2px;">Controllers · Models · Libraries</p>
                    </div>
                    <button class="btn btn-gold-elite" id="btn-run-scan">
                        <i class="fa fa-crosshairs"></i> Execute Scan
                    </button>
                </div>

                <div id="scan-viewport" style="min-height: 420px; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.15); border-radius: 24px; border: 1px solid rgba(255,255,255,0.03); padding: 40px;">
                    <!-- Idle -->
                    <div id="scan-idle" class="text-center">
                        <i class="fa fa-shield" style="font-size: 90px; color: var(--gold-primary); opacity: 0.05; margin-bottom: 30px; filter: drop-shadow(0 0 15px rgba(245,158,11,0.2));"></i>
                        <h4 style="color: #cbd5e1; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; font-size: 15px;">Ready for Authentication</h4>
                        <p style="color: rgba(245,158,11,0.5); font-size: 13px; margin-top: 10px;">Klik Execute Scan untuk memulai pemeriksaan sintaksis.</p>
                    </div>

                    <!-- Loading -->
                    <div id="scan-loading" class="text-center" style="display: none;">
                        <div class="scanner-spinner"></div>
                        <h4 style="color: #f59e0b; font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">Authenticating Files...</h4>
                        <p style="color: #64748b; font-size: 12px; margin-top: 5px;">Scanning neural data streams...</p>
                    </div>

                    <!-- Report -->
                    <div id="scan-report" style="display: none; width: 100%;">
                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-sm-4">
                                <div style="background: rgba(245,158,11,0.05); border: 1px solid rgba(245,158,11,0.15); border-radius: 18px; padding: 20px; text-align: center;">
                                    <div style="font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; font-weight: 800;">Processed</div>
                                    <div id="stat-total" style="font-size: 36px; font-weight: 900; color: #f8fafc;">0</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="background: rgba(245,158,11,0.05); border: 1px solid rgba(245,158,11,0.15); border-radius: 18px; padding: 20px; text-align: center;">
                                    <div style="font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; font-weight: 800;">Anomalies</div>
                                    <div id="stat-errors" style="font-size: 36px; font-weight: 900; color: #f43f5e;">0</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="background: rgba(245,158,11,0.05); border: 1px solid rgba(245,158,11,0.15); border-radius: 18px; padding: 20px; text-align: center;">
                                    <div style="font-size: 10px; color: var(--gold-primary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; font-weight: 900;">Integrity</div>
                                    <div id="stat-status" style="font-size: 20px; font-weight: 900; margin-top: 10px;">—</div>
                                </div>
                            </div>
                        </div>
                        <div id="error-list"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Smart Auto-Fix Panel -->
        <div class="col-md-5">
            <div class="elite-card" style="border: 1px solid rgba(6, 182, 212, 0.35) !important;">
                <!-- Cyan shimmer bar -->
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #06b6d4, var(--gold-primary), #06b6d4, transparent); opacity: 0.7; animation: zenithShimmer 5s linear infinite;"></div>

                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 25px;">
                    <div style="width: 45px; height: 45px; border-radius: 14px; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(6,182,212,0.4); flex-shrink: 0;">
                        <i class="fa fa-magic" style="font-size: 18px; color: white;"></i>
                    </div>
                    <div>
                        <h4 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 16px; text-transform: uppercase; letter-spacing: 1px;">Smart Auto-Fix</h4>
                        <p style="margin: 3px 0 0; font-size: 11px; color: rgba(6,182,212,0.7); text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">System Self-Repair Engine</p>
                    </div>
                </div>

                <div style="background: rgba(6,182,212,0.05); border: 1px solid rgba(6,182,212,0.15); border-radius: 16px; padding: 20px; margin-bottom: 25px; font-size: 13px; color: #94a3b8; line-height: 1.7;">
                    <i class="fa fa-info-circle" style="color: #06b6d4; margin-right: 8px;"></i>
                    Engine akan memeriksa dan memperbaiki sistem secara otomatis:
                    <ul style="margin: 12px 0 0 20px; padding: 0; color: #cbd5e1;">
                        <li>Folder kritis yang hilang / permission rusak</li>
                        <li>File cache yang menumpuk</li>
                        <li>Log oversized (&gt; 5MB)</li>
                        <li>File placeholder & CSS custom yang hilang</li>
                        <li>Verifikasi tabel database kritis</li>
                    </ul>
                </div>

                <button class="btn btn-block" id="btn-auto-fix" style="background: linear-gradient(135deg, #06b6d4, #0891b2) !important; color: white !important; font-weight: 900 !important; border-radius: 12px !important; padding: 16px !important; border: 2px solid rgba(255,255,255,0.2) !important; box-shadow: 0 10px 30px rgba(6,182,212,0.3) !important; text-transform: uppercase; letter-spacing: 2px; font-size: 13px; transition: all 0.3s ease;">
                    <i class="fa fa-magic"></i> Run Auto-Fix Now
                </button>

                <!-- Fix Result Viewport -->
                <div id="fix-viewport" style="margin-top: 25px; display: none;">
                    <!-- Loading -->
                    <div id="fix-loading" class="text-center" style="padding: 30px 0;">
                        <div class="fix-spinner"></div>
                        <p style="color: #06b6d4; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Analysing & Repairing System...</p>
                    </div>

                    <!-- Results -->
                    <div id="fix-results" style="display: none;">
                        <!-- Summary badges -->
                        <div id="fix-summary" style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;"></div>
                        <!-- Fix items list -->
                        <div id="fix-items" style="max-height: 360px; overflow-y: auto;"></div>
                        <!-- Skipped items -->
                        <div id="fix-skipped" style="margin-top: 15px;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
$(function(){

    // ===================== SYNTAX SCANNER =====================
    $('#btn-run-scan').click(function(){
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Scanning...');
        $('#scan-idle').hide();
        $('#scan-report').hide();
        $('#scan-loading').show();

        $.getJSON('<?php echo site_url("developer/run_scan"); ?>', function(data){
            $('#scan-loading').hide();
            $('#scan-report').show();
            btn.prop('disabled', false).html('<i class="fa fa-crosshairs"></i> Execute Scan');

            $('#stat-total').text(data.total);
            $('#stat-errors').text(data.errors);

            if(data.errors > 0){
                $('#stat-status').text('VULNERABLE').css('color', '#f43f5e');
                var html = '<h4 style="color:#f1f5f9; font-weight:900; margin-bottom:20px; border-left:4px solid #f43f5e; padding-left:15px; font-size:14px; text-transform:uppercase;">Bug Repository:</h4>';
                $.each(data.details, function(i, item){
                    html += '<div class="error-item-elite">';
                    html += '<h5 style="color:#fca5a5; font-weight:800; margin-top:0; margin-bottom:12px; font-size:13px;"><i class="fa fa-bug"></i> ' + item.file + '</h5>';
                    html += '<pre class="error-pre-elite">' + item.error + '</pre>';
                    html += '</div>';
                });
                $('#error-list').html(html);
            } else {
                $('#stat-status').text('NOMINAL').css('color', '#10b981');
                $('#error-list').html('<div class="text-center" style="padding:40px;"><i class="fa fa-shield" style="font-size:70px; color:#10b981; margin-bottom:20px; opacity:0.8;"></i><h4 style="color:#f8fafc; font-weight:900; text-transform:uppercase; letter-spacing:2px;">System Integrity Validated</h4><p style="color:#64748b; font-size:14px;">No syntax vulnerabilities found.</p></div>');
            }
        }).fail(function(){
            btn.prop('disabled', false).html('<i class="fa fa-crosshairs"></i> Execute Scan');
            notify_error('Scan gagal — pastikan PHP CLI tersedia di server.');
        });
    });

    // ===================== SMART AUTO-FIX =====================
    $('#btn-auto-fix').click(function(){
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Running...');
        $('#fix-viewport').show();
        $('#fix-loading').show();
        $('#fix-results').hide();

        $.getJSON('<?php echo site_url("developer/auto_fix"); ?>', function(data){
            btn.prop('disabled', false).html('<i class="fa fa-magic"></i> Run Auto-Fix Now');
            $('#fix-loading').hide();
            $('#fix-results').show();

            // Summary badges
            var summaryHtml = '';
            summaryHtml += '<div style="background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.3); border-radius:10px; padding:8px 16px; font-size:12px; font-weight:900; color:#06b6d4;">'
                         + '<i class="fa fa-wrench"></i> ' + data.fix_count + ' Fixed</div>';
            summaryHtml += '<div style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:10px; padding:8px 16px; font-size:12px; font-weight:900; color:#10b981;">'
                         + '<i class="fa fa-check"></i> ' + data.ok_count + ' OK</div>';
            if(data.skipped && data.skipped.length > 0){
                summaryHtml += '<div style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.3); border-radius:10px; padding:8px 16px; font-size:12px; font-weight:900; color:#f59e0b;">'
                             + '<i class="fa fa-exclamation-triangle"></i> ' + data.skipped.length + ' Skipped</div>';
            }
            $('#fix-summary').html(summaryHtml);

            // Fix items
            var itemsHtml = '';
            $.each(data.fixes, function(i, fix){
                var cls = fix.type === 'ok' ? 'ok' : 'repaired';
                var icon = fix.type === 'ok' ? '✔' : '✦';
                itemsHtml += '<div class="fix-item ' + cls + '">'
                           + '<span class="icon">' + icon + '</span>'
                           + '<span>' + fix.msg + '</span></div>';
            });
            $('#fix-items').html(itemsHtml);

            // Skipped
            if(data.skipped && data.skipped.length > 0){
                var skipHtml = '<div style="border-top:1px solid rgba(255,255,255,0.05); padding-top:15px; margin-top:5px;">'
                             + '<div style="font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:10px; font-weight:900;">Manual Action Required:</div>';
                $.each(data.skipped, function(i, s){
                    skipHtml += '<div class="fix-item warning"><span class="icon">⚠</span><span>' + s.msg + '</span></div>';
                });
                skipHtml += '</div>';
                $('#fix-skipped').html(skipHtml);
            }

            if(data.fix_count > 0){
                notify_success(data.fix_count + ' masalah berhasil diperbaiki secara otomatis!');
            } else {
                notify_success('Sistem dalam kondisi prima — tidak ada yang perlu diperbaiki.');
            }
            $(document).trigger('ghcbt:autofix-done', [data.fix_count]);
        }).fail(function(){
            btn.prop('disabled', false).html('<i class="fa fa-magic"></i> Run Auto-Fix Now');
            $('#fix-loading').hide();
            notify_error('Auto-Fix gagal dijalankan. Periksa koneksi server.');
        });
    });

});
</script>
