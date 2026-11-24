<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-shield"></i>
        </div>
        <div>
            <h2>Integrity Guard</h2>
            <p>Pemeriksaan Integritas Sintaksis PHP & Pemulihan Sistem Otomatis (Smart Auto-Fix)</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> DEFENSE SYSTEM READY
    </div>
</div>

<style>
    .scanner-spinner {
        border: 4px solid #fde68a;
        border-top: 4px solid var(--gold-primary);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 0.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) infinite;
        margin: 0 auto 20px auto;
    }

    .fix-spinner {
        border: 4px solid #cffafe;
        border-top: 4px solid #0891b2;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 0.6s linear infinite;
        margin: 0 auto 20px auto;
    }

    .error-item-elite {
        background: #fef2f2;
        border: 1px solid #fecdd3;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .error-pre-elite {
        background: #0f172a !important;
        color: #fca5a5 !important;
        border: 1px solid #334155 !important;
        border-radius: 12px;
        padding: 16px;
        font-family: 'JetBrains Mono', 'Consolas', monospace;
        font-size: 12px;
        line-height: 1.6;
        margin-top: 10px;
    }

    .fix-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 10px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
    }

    .fix-item.ok       { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
    .fix-item.repaired { background: #ecfeff; border: 1px solid #a5f3fc; color: #0e7490; }
    .fix-item.warning  { background: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
    .fix-item .icon    { font-size: 16px; flex-shrink: 0; }

    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>

<section class="content" style="padding: 0;">
    <div class="row row-flex-eq">

        <!-- LEFT: Syntax Scanner -->
        <div class="col-md-7">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light); flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-crosshairs" style="color: var(--gold-primary);"></i> Syntax Scanner
                        </h3>
                        <p style="margin: 4px 0 0; font-size: 12px; color: #64748b;">Controllers &bull; Models &bull; Libraries &bull; Core Helpers</p>
                    </div>
                    <button class="btn btn-gold-elite" id="btn-run-scan">
                        <i class="fa fa-crosshairs" style="margin-right: 6px;"></i> Execute Scan
                    </button>
                </div>

                <div id="scan-viewport" style="min-height: 380px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: 18px; border: 1px solid var(--border-light); padding: 30px;">
                    <!-- Idle -->
                    <div id="scan-idle" class="text-center">
                        <i class="fa fa-shield" style="font-size: 70px; color: #cbd5e1; margin-bottom: 20px; display: block;"></i>
                        <h4 style="color: #0f172a; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 15px; margin: 0 0 8px 0;">Siap Melakukan Pemeriksaan</h4>
                        <p style="color: #64748b; font-size: 13px; margin: 0;">Klik <strong>Execute Scan</strong> untuk memulai audit sintaksis seluruh file PHP.</p>
                    </div>

                    <!-- Loading -->
                    <div id="scan-loading" class="text-center" style="display: none;">
                        <div class="scanner-spinner"></div>
                        <h4 style="color: #b45309; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 15px;">Memeriksa Kode Sumber...</h4>
                        <p style="color: #64748b; font-size: 12px; margin-top: 5px;">Menganalisis berkas MVC dengan PHP Lint engine...</p>
                    </div>

                    <!-- Report -->
                    <div id="scan-report" style="display: none; width: 100%;">
                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-sm-4">
                                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: 14px; padding: 18px; text-align: center;">
                                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; font-weight: 800;">Processed</div>
                                    <div id="stat-total" style="font-size: 32px; font-weight: 900; color: #0f172a; line-height: 1;">0</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: 14px; padding: 18px; text-align: center;">
                                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; font-weight: 800;">Anomalies</div>
                                    <div id="stat-errors" style="font-size: 32px; font-weight: 900; color: #dc2626; line-height: 1;">0</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div style="background: #ffffff; border: 1px solid var(--border-light); border-radius: 14px; padding: 18px; text-align: center;">
                                    <div style="font-size: 11px; color: var(--gold-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; font-weight: 800;">Integrity</div>
                                    <div id="stat-status" style="font-size: 22px; font-weight: 900; line-height: 1.4;">—</div>
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
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="width: 45px; height: 45px; border-radius: 14px; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(6,182,212,0.3); flex-shrink: 0;">
                            <i class="fa fa-magic" style="font-size: 18px; color: white;"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px;">Smart Auto-Fix</h4>
                            <p style="margin: 3px 0 0; font-size: 11px; color: #0891b2; text-transform: uppercase; letter-spacing: 1px; font-weight: 800;">System Self-Repair Engine</p>
                        </div>
                    </div>
                </div>

                <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 16px; padding: 18px; margin-bottom: 22px; font-size: 13px; color: #134e4a; line-height: 1.6;">
                    <i class="fa fa-info-circle" style="color: #0d9488; margin-right: 6px;"></i>
                    Fitur ini secara otomatis memeriksa dan memulihkan:
                    <ul style="margin: 10px 0 0 18px; padding: 0; color: #115e59; font-size: 12px;">
                        <li>Folder sistem yang hilang atau permission rusak</li>
                        <li>File cache yang menumpuk</li>
                        <li>Log raksasa (&gt; 5MB) yang membebani disk</li>
                        <li>File CSS custom yang belum ada</li>
                        <li>Verifikasi tabel database kritis</li>
                    </ul>
                </div>

                <button class="btn btn-block" id="btn-auto-fix" style="background: linear-gradient(135deg, #06b6d4, #0891b2) !important; color: white !important; font-weight: 800 !important; border-radius: 12px !important; padding: 14px !important; border: none !important; box-shadow: 0 4px 15px rgba(6,182,212,0.3) !important; text-transform: uppercase; letter-spacing: 1px; font-size: 12px; transition: all 0.25s ease;">
                    <i class="fa fa-magic" style="margin-right: 6px;"></i> Run Auto-Fix Now
                </button>

                <!-- Fix Result Viewport -->
                <div id="fix-viewport" style="margin-top: 22px; display: none;">
                    <!-- Loading -->
                    <div id="fix-loading" class="text-center" style="padding: 25px 0;">
                        <div class="fix-spinner"></div>
                        <p style="color: #0891b2; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Memperbaiki Sistem...</p>
                    </div>

                    <!-- Results -->
                    <div id="fix-results" style="display: none;">
                        <!-- Summary badges -->
                        <div id="fix-summary" style="display: flex; gap: 10px; margin-bottom: 16px; flex-wrap: wrap;"></div>
                        <!-- Fix items list -->
                        <div id="fix-items" style="max-height: 320px; overflow-y: auto;"></div>
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
                $('#stat-status').text('ANOMALY').css('color', '#dc2626');
                var html = '<h4 style="color:#0f172a; font-weight:800; margin-bottom:15px; border-left:4px solid #dc2626; padding-left:12px; font-size:13px; text-transform:uppercase;">Daftar Isu Sintaksis:</h4>';
                $.each(data.details, function(i, item){
                    html += '<div class="error-item-elite">';
                    html += '<h5 style="color:#dc2626; font-weight:800; margin-top:0; margin-bottom:8px; font-size:13px;"><i class="fa fa-bug"></i> ' + item.file + '</h5>';
                    html += '<pre class="error-pre-elite">' + item.error + '</pre>';
                    html += '</div>';
                });
                $('#error-list').html(html);
            } else {
                $('#stat-status').text('NOMINAL').css('color', '#059669');
                $('#error-list').html('<div class="text-center" style="padding:30px;"><i class="fa fa-check-circle" style="font-size:50px; color:#059669; margin-bottom:15px; display:block;"></i><h4 style="color:#0f172a; font-weight:800; text-transform:uppercase; letter-spacing:1px; margin:0 0 6px 0;">Sistem Sehat & Bebas Error</h4><p style="color:#64748b; font-size:13px; margin:0;">Tidak ditemukan satupun kerentanan sintaksis pada berkas aplikasi.</p></div>');
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
            summaryHtml += '<div style="background:#ecfeff; border:1px solid #a5f3fc; border-radius:10px; padding:6px 14px; font-size:11px; font-weight:800; color:#0e7490;">'
                         + '<i class="fa fa-wrench"></i> ' + data.fix_count + ' Diperbaiki</div>';
            summaryHtml += '<div style="background:#ecfdf5; border:1px solid #a7f3d0; border-radius:10px; padding:6px 14px; font-size:11px; font-weight:800; color:#065f46;">'
                         + '<i class="fa fa-check"></i> ' + data.ok_count + ' Sempurna</div>';
            if(data.skipped && data.skipped.length > 0){
                summaryHtml += '<div style="background:#fffbeb; border:1px solid #fde68a; border-radius:10px; padding:6px 14px; font-size:11px; font-weight:800; color:#92400e;">'
                             + '<i class="fa fa-exclamation-triangle"></i> ' + data.skipped.length + ' Dilewati</div>';
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
                var skipHtml = '<div style="border-top:1px solid var(--border-light); padding-top:12px; margin-top:8px;">'
                             + '<div style="font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; font-weight:800;">Perhatian Manual:</div>';
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