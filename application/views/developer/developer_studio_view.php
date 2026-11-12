<style>
    /* Symmetrical & Responsive Layout Essentials */
    .row-flex-eq {
        display: flex;
        flex-wrap: wrap;
        margin-left: -12px;
        margin-right: -12px;
    }
    .row-flex-eq > [class*='col-'] {
        display: flex;
        flex-direction: column;
        padding-left: 12px;
        padding-right: 12px;
    }
    .row-flex-eq > [class*='col-'] > .elite-card {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Elite Master Hero Banner */
    .dev-hero-banner {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 30px 35px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #ffffff;
        box-shadow: 0 10px 25px -4px rgba(217, 119, 6, 0.28);
        position: relative;
        overflow: hidden;
    }
    .dev-hero-banner::after {
        content: '';
        position: absolute;
        top: -60px; right: -40px;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.18) 0%, transparent 70%);
        pointer-events: none;
    }
    .hero-avatar-box {
        width: 60px; height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #ffffff;
        flex-shrink: 0;
        backdrop-filter: blur(10px);
    }
    .hero-title-box h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: #ffffff;
    }
    .hero-title-box p {
        margin: 5px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }
    .hero-badge-pill {
        background: rgba(255, 255, 255, 0.22);
        border: 1px solid rgba(255, 255, 255, 0.35);
        color: #ffffff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
    }
    .hero-stats-right {
        display: flex;
        align-items: center;
        gap: 20px;
        text-align: right;
    }
    .chronometer-box {
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 16px;
        padding: 12px 20px;
        text-align: center;
        backdrop-filter: blur(10px);
    }
    .chronometer-box .chrono-label {
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 800;
        margin-bottom: 2px;
    }
    .chronometer-box .chrono-time {
        font-family: 'JetBrains Mono', monospace, sans-serif;
        font-size: 22px;
        font-weight: 900;
        color: #ffffff;
        letter-spacing: 2px;
        line-height: 1;
    }

    /* 4-Stat Metric Cards Grid */
    .metric-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }
    .metric-card {
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 18px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow-floating);
        transition: all 0.25s ease;
    }
    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px -4px rgba(217, 119, 6, 0.15);
        border-color: rgba(245, 158, 11, 0.4);
    }
    .metric-info .m-label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 4px;
    }
    .metric-info .m-value {
        font-size: 20px;
        font-weight: 900;
        color: var(--text-bright);
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .metric-icon-box {
        width: 48px; height: 48px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--gold-primary);
        flex-shrink: 0;
    }

    /* Diagnostics Card */
    .box-header-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border-light);
        margin-bottom: 22px;
    }
    .box-header-title h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .box-header-title h3 i {
        color: var(--gold-primary);
    }

    /* Terminal Telemetry */
    .terminal-box {
        background: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 14px;
        padding: 16px 20px;
        font-family: 'JetBrains Mono', 'Consolas', monospace;
        font-size: 12px;
        line-height: 1.6;
        color: #f1f5f9;
        margin-bottom: 22px;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.4);
    }
    .term-prompt { color: #10b981; font-weight: 700; }
    .term-cmd { color: #f8fafc; font-weight: 700; }
    .term-dim { color: #64748b; }
    .term-ok { color: #34d399; }
    .term-gold { color: #fbbf24; font-weight: 700; }

    /* Resource Bars */
    .resource-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 18px;
        margin-bottom: 15px;
    }
    .resource-label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .progress-bar-wrap {
        height: 10px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .progress-bar-fill {
        height: 100%;
        background: var(--primary-gradient);
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    /* Action Tiles (Right Column) */
    .action-tile {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #f8fafc;
        border: 1px solid var(--border-light);
        border-radius: 14px;
        padding: 15px 18px;
        margin-bottom: 12px;
        text-decoration: none !important;
        transition: all 0.25s ease;
    }
    .action-tile:hover {
        background: #fffbeb;
        border-color: #f59e0b;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(245, 158, 11, 0.12);
    }
    .action-tile-icon {
        width: 44px; height: 44px;
        background: #ffffff;
        border: 1px solid #fde68a;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--gold-primary);
        flex-shrink: 0;
        transition: all 0.25s ease;
    }
    .action-tile:hover .action-tile-icon {
        background: var(--primary-gradient);
        color: #ffffff;
        border-color: transparent;
    }
    .action-tile-info .t-name {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-main);
        display: block;
        margin-bottom: 2px;
    }
    .action-tile-info .t-desc {
        font-size: 11px;
        color: var(--text-muted);
        display: block;
    }

    @media (max-width: 991px) {
        .metric-grid { grid-template-columns: repeat(2, 1fr); }
        .dev-hero-banner { flex-direction: column; align-items: flex-start; gap: 20px; }
        .hero-stats-right { width: 100%; justify-content: space-between; text-align: left; }
    }
    @media (max-width: 576px) {
        .metric-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Symmetrical Master Hero Banner -->
<div class="dev-hero-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div class="hero-avatar-box">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="hero-title-box">
            <h1>Selamat Datang, <?php echo $this->session->userdata('dev_nama'); ?></h1>
            <p>Master Developer Studio Node &bull; Pemantauan Performa & Arsitektur Sistem Terpusat</p>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <span class="hero-badge-pill"><i class="fa fa-shield"></i> AUTHORITY: MASTER</span>
                <span class="hero-badge-pill"><i class="fa fa-code-fork"></i> <?php echo $site_version; ?></span>
                <span class="hero-badge-pill" style="background: rgba(16, 185, 129, 0.3); border-color: rgba(16, 185, 129, 0.5);"><i class="fa fa-circle" style="font-size: 8px;"></i> CORE ACTIVE</span>
            </div>
        </div>
    </div>
    <div class="hero-stats-right">
        <div class="chronometer-box">
            <div class="chrono-label">System Chronometer</div>
            <div class="chrono-time" id="live-timer">00:00:00</div>
        </div>
    </div>
</div>

<!-- 4 Symmetrical Metric Grid Cards -->
<div class="metric-grid">
    <div class="metric-card">
        <div class="metric-info">
            <div class="m-label">PHP Engine</div>
            <div class="m-value"><?php echo $php_version; ?></div>
        </div>
        <div class="metric-icon-box">
            <i class="fa fa-code"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="metric-info">
            <div class="m-label">SQL Engine</div>
            <div class="m-value"><?php echo substr($mysql_version, 0, 6); ?></div>
        </div>
        <div class="metric-icon-box">
            <i class="fa fa-database"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="metric-info">
            <div class="m-label">Extensions</div>
            <div class="m-value"><?php echo $php_extensions; ?> Modul</div>
        </div>
        <div class="metric-icon-box">
            <i class="fa fa-cubes"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="metric-info">
            <div class="m-label">Platform OS</div>
            <div class="m-value"><?php echo $os; ?></div>
        </div>
        <div class="metric-icon-box">
            <i class="fa fa-server"></i>
        </div>
    </div>
</div>

<!-- Symmetrical Lower Deck -->
<div class="row row-flex-eq">
    <!-- Left Column: Core System Metrics -->
    <div class="col-lg-7">
        <div class="elite-card">
            <div class="box-header-title">
                <h3><i class="fa fa-tachometer"></i> Diagnostik & Telemetri Sistem</h3>
                <span class="badge" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 700; padding: 5px 12px; border-radius: 12px;">DIAGNOSTIC ACTIVE</span>
            </div>

            <!-- Monospace Telemetry Shell -->
            <div class="terminal-box">
                <span class="term-prompt">[system@ghcbt-v3 ~]$</span> <span class="term-cmd">fetch --all --detailed</span><br>
                <span class="term-dim">Initializing telemetry streams...</span> <span class="term-ok">OK</span><br>
                <span class="term-dim">Accessing hardware acceleration...</span> <span class="term-ok">OK</span><br>
                <span class="term-dim">Engine Integrity:</span> <span class="term-gold">EXCELLENT</span> &bull; <span class="term-dim">Security Level:</span> <span class="term-gold">MAX SECURE</span>
            </div>

            <!-- Resource Gauges -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="resource-card">
                        <div class="resource-label-row">
                            <span style="color: var(--text-main);"><i class="fa fa-hdd-o" style="color: var(--gold-primary); margin-right: 6px;"></i> Alokasi Harddisk</span>
                            <span style="color: var(--gold-primary);"><?php echo round(($disk_free/$disk_total)*100); ?>% Tersedia</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar-fill" style="width: <?php echo round(($disk_free/$disk_total)*100); ?>%;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 11px; color: var(--text-muted); font-weight: 600;">
                            <span>Sisa: <?php echo round($disk_free/1024/1024/1024, 1); ?> GB</span>
                            <span>Total: <?php echo round($disk_total/1024/1024/1024, 1); ?> GB</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="resource-card">
                        <div class="resource-label-row">
                            <span style="color: var(--text-main);"><i class="fa fa-microchip" style="color: var(--gold-primary); margin-right: 6px;"></i> Penggunaan RAM</span>
                            <span style="color: var(--gold-primary);"><?php echo round($memory_usage/1024/1024, 1); ?> MB</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar-fill" style="width: 35%;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 11px; color: var(--text-muted); font-weight: 600;">
                            <span>Limit Engine: <?php echo $memory_limit; ?></span>
                            <span style="color: #059669;">Optimal</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Server Info Note -->
            <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 12px 16px; margin-top: auto; display: flex; align-items: center; justify-content: space-between;">
                <div style="font-size: 12px; color: #92400e; font-weight: 600;">
                    <i class="fa fa-info-circle" style="margin-right: 6px;"></i> Server berjalan optimal di lingkungan XAMPP Apache 2.4 & PHP <?php echo PHP_VERSION; ?>.
                </div>
                <span style="font-size: 11px; color: #b45309; font-weight: 800;">STATUS: HEALTHY</span>
            </div>
        </div>
    </div>

    <!-- Right Column: Quick Commands & Tools -->
    <div class="col-lg-5">
        <div class="elite-card">
            <div class="box-header-title">
                <h3><i class="fa fa-bolt"></i> Menu Kontrol Cepat</h3>
                <span class="badge" style="background: #fffbeb; color: var(--gold-primary); border: 1px solid #fde68a; font-weight: 700; padding: 5px 12px; border-radius: 12px;">COMMAND CENTER</span>
            </div>

            <a href="<?php echo site_url('developer/keymaster'); ?>" class="action-tile">
                <div class="action-tile-icon">
                    <i class="fa fa-key"></i>
                </div>
                <div class="action-tile-info">
                    <span class="t-name">Keymaster Pro</span>
                    <span class="t-desc">Generate lisensi hardware ID & manajemen klien.</span>
                </div>
            </a>

            <a href="<?php echo site_url('developer/identity'); ?>" class="action-tile">
                <div class="action-tile-icon">
                    <i class="fa fa-sliders"></i>
                </div>
                <div class="action-tile-info">
                    <span class="t-name">Identity Hub & Release</span>
                    <span class="t-desc">Kelola versi sistem & build rilis paket ZIP.</span>
                </div>
            </a>

            <a href="<?php echo site_url('developer/database'); ?>" class="action-tile">
                <div class="action-tile-icon">
                    <i class="fa fa-database"></i>
                </div>
                <div class="action-tile-info">
                    <span class="t-name">Database Hub</span>
                    <span class="t-desc">Backup, optimasi tabel, dan restore database CBT.</span>
                </div>
            </a>

            <a href="<?php echo site_url('developer/monitor'); ?>" class="action-tile">
                <div class="action-tile-icon">
                    <i class="fa fa-area-chart"></i>
                </div>
                <div class="action-tile-info">
                    <span class="t-name">System Monitor</span>
                    <span class="t-desc">Pantau aktivitas beban CPU & sesi login aktif.</span>
                </div>
            </a>

            <!-- Developer Footnote Box -->
            <div style="margin-top: auto; padding: 15px 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px;">
                <p style="color: var(--text-muted); font-size: 12px; font-style: italic; margin: 0; line-height: 1.6;">
                    "Sistem berada di bawah pengawasan penuh Anda. Gunakan konsol diagnostik dengan bijak demi stabilitas total."
                </p>
                <div style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <span style="color: var(--gold-primary); font-weight: 800; font-size: 11px;">GHCBT ARCHITECT EDITION</span>
                    <span style="color: #ffffff; background: var(--primary-gradient); padding: 2px 8px; border-radius: 6px; font-size: 9px; font-weight: 800;">VERIFIED</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const timeStr = now.getHours().toString().padStart(2, '0') + ':' + 
                        now.getMinutes().toString().padStart(2, '0') + ':' + 
                        now.getSeconds().toString().padStart(2, '0');
        const timerEl = document.getElementById('live-timer');
        if(timerEl) timerEl.innerText = timeStr;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
