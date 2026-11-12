<section class="content-header">
	<h1>
		Elite Developer Studio
		<small style="color: rgba(245, 158, 11, 0.7) !important;">GHCBT Professional Core Engine</small>
	</h1>
</section>

<section class="content">
    <style>

        .welcome-hero {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.8) 100%);
            padding: 40px;
            border-radius: 28px;
            border: 2px solid var(--gold-primary);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--gold-glow-strong);
        }
        
        .welcome-hero::after {
            content: '';
            position: absolute;
            top: -50%; right: -20%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .premium-text-gold {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
            text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
        }

        .terminal-shell {
            background: #000000;
            border-radius: 18px;
            padding: 20px;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            border: 2px solid var(--gold-primary);
            box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.1), 0 0 20px rgba(245, 158, 11, 0.1);
        }

        .cyber-status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .status-node {
            background: rgba(245, 158, 11, 0.05);
            border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 15px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s;
        }
        
        .status-node:hover {
            background: rgba(245, 158, 11, 0.1);
            border-color: var(--gold-primary) !important;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
        }

        .node-value {
            display: block;
            font-size: 20px;
            font-weight: 900;
            color: var(--gold-primary);
            text-shadow: 0 0 8px rgba(245, 158, 11, 0.4);
        }

        .node-label {
            display: block;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .badge-pro-elite { 
            background: var(--gold-gradient); 
            padding: 8px 18px; 
            border-radius: 12px; 
            font-size: 11px; 
            font-weight: 900; 
            color: #0f172a !important; 
            box-shadow: var(--gold-glow); 
            border: 1px solid rgba(255,255,255,0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s;
        }
        .badge-pro-elite:hover {
            transform: translateY(-2px);
            box-shadow: var(--gold-glow-strong);
        }

        .action-button-pro {
            background: rgba(245, 158, 11, 0.05);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 24px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1);
            text-decoration: none !important;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .action-button-pro:hover {
            background: var(--gold-gradient);
            transform: scale(1.05) translateX(8px);
            border-color: white;
            box-shadow: var(--gold-glow-strong);
        }

        .action-button-pro i {
            font-size: 30px;
            color: var(--gold-primary);
            transition: all 0.4s;
            text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
        }

        .action-button-pro:hover i, .action-button-pro:hover .atitle, .action-button-pro:hover .adesc {
            color: #0f172a !important;
            text-shadow: none;
        }

        .action-button-pro .atitle {
            color: #f8fafc;
            font-weight: 800;
            font-size: 17px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .action-button-pro .adesc {
            color: #94a3b8;
            font-size: 12px;
            display: block;
        }

        .pulse-core {
            width: 14px;
            height: 14px;
            background: var(--gold-primary);
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 20px var(--gold-primary);
            animation: core-glow 1s infinite alternate;
        }

        @keyframes core-glow {
            from { opacity: 0.5; transform: scale(0.8); box-shadow: 0 0 8px var(--gold-primary); }
            to { opacity: 1; transform: scale(1.3); box-shadow: 0 0 25px var(--gold-primary); }
        }
        
        .storage-progress-container {
            height: 14px;
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            overflow: hidden;
            margin: 15px 0;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        
        .storage-progress-bar {
            height: 100%;
            background: var(--gold-gradient);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.6);
            border-radius: 20px;
        }
    </style>

    <!-- Welcome Section -->
    <div class="welcome-hero">
        <div class="row">
            <div class="col-md-9">
                <h2 style="margin: 0; font-weight: 400; color: #cbd5e1;">Selamat Datang Kembali,</h2>
                <h1 style="margin: 5px 0 20px 0; font-size: 42px;" class="premium-text-gold">
                    <?php echo $this->session->userdata('dev_nama'); ?>
                </h1>
                <p style="color: #94a3b8; font-size: 16px; max-width: 600px; line-height: 1.6; margin-bottom: 5px;">
                    Anda sedang berada di <span style="color: #f59e0b; font-weight: 700;">GHCBT Elite Developer Node</span>. Seluruh sistem diagnostik dan kontrol inti engine telah dimuat sepenuhnya.
                </p>
                <div style="margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
                    <div class="badge-pro-elite">
                        <i class="fa fa-star"></i> PLATFORM PRO
                    </div>
                    <div class="badge-pro-elite" style="background: rgba(245, 158, 11, 0.1); color: var(--gold-primary) !important; border-color: var(--gold-primary);">
                        <i class="fa fa-code-fork"></i> <?php echo $site_version; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-right hidden-xs">
                <div style="background: rgba(245, 158, 11, 0.1); padding: 20px; border-radius: 24px; border: 1px solid rgba(245, 158, 11, 0.2);">
                    <div style="font-size: 10px; color: #f59e0b; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">Authority Level</div>
                    <div style="font-size: 24px; font-weight: 900; color: white; margin-top: 5px;">MASTER</div>
                    <div style="margin-top: 10px;"><span class="pulse-core"></span> <span style="font-size: 11px; color: #10b981; font-weight: 700;">ENCRYPTED</span></div>
                </div>
                <!-- Master Digital Clock -->
                <div style="margin-top: 15px; background: rgba(0,0,0,0.3); padding: 15px 20px; border-radius: 20px; border: 1px solid rgba(245, 158, 11, 0.1); text-align: center; box-shadow: inset 0 0 20px rgba(0,0,0,0.5);">
                    <div style="font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; font-weight: 800;">System Chronometer</div>
                    <span id="live-timer" style="font-family: 'JetBrains Mono', monospace; color: var(--gold-primary); font-weight: 900; font-size: 26px; text-shadow: 0 0 15px rgba(245, 158, 11, 0.4); letter-spacing: 2px;">00:00:00</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Console & Metrics -->
        <div class="col-lg-8">
            <div class="elite-card">
                <div style="padding: 25px 35px; background: rgba(0,0,0,0.2); display: flex; justify-content: space-between; align-items: center;">
                    <h4 style="margin: 0; font-weight: 800; color: #f8fafc; display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-terminal" style="color: #f59e0b;"></i> CORE SYSTEM METRICS
                    </h4>
                    <span style="font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Diagnostic Mode Active</span>
                </div>
                <div class="box-body" style="padding: 35px;">
                    <div class="terminal-shell" style="margin-bottom: 35px;">
                        <span style="color: #10b981;">[system@ghcbt-v3 ~]$</span> <span style="color: #f1f5f9;">fetch --all --detailed</span><br>
                        <span style="color: #94a3b8; font-size: 12px;">Initializing telemetry streams... OK</span><br>
                        <span style="color: #94a3b8; font-size: 12px;">Accessing hardware acceleration... OK</span><br>
                        <span style="color: #f59e0b; font-size: 12px; font-weight: 700;">Engine Integrity: EXCELLENT / Security Level: MAX</span>
                    </div>

                    <div class="cyber-status-grid">
                        <div class="status-node">
                            <span class="node-value"><?php echo $php_version; ?></span>
                            <span class="node-label">PHP Core</span>
                        </div>
                        <div class="status-node">
                            <span class="node-value"><?php echo substr($mysql_version, 0, 5); ?></span>
                            <span class="node-label">SQL Engine</span>
                        </div>
                        <div class="status-node">
                            <span class="node-value"><?php echo $php_extensions; ?></span>
                            <span class="node-label">Extensions</span>
                        </div>
                        <div class="status-node">
                            <span class="node-value"><?php echo $os; ?></span>
                            <span class="node-label">Environment</span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 40px;">
                        <div class="col-md-6" style="margin-bottom: 25px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 10px;">
                                <h5 style="margin: 0; color: #f8fafc; font-weight: 700;">Disk Allocation</h5>
                                <span style="font-size: 12px; color: #f59e0b; font-weight: 800;"><?php echo round(($disk_free/$disk_total)*100); ?>% Available</span>
                            </div>
                            <div class="storage-progress-container">
                                <div class="storage-progress-bar" style="width: <?php echo round(($disk_free/$disk_total)*100); ?>%;"></div>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #64748b;">
                                <span><?php echo round($disk_free/1024/1024/1024, 1); ?> GB Free</span>
                                <span>Total: <?php echo round($disk_total/1024/1024/1024, 1); ?> GB</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 style="margin: 0 0 15px 0; color: #f8fafc; font-weight: 700;">Memory Performance</h5>
                            <div style="background: rgba(245, 158, 11, 0.05); padding: 18px; border-radius: 20px; border: 1px solid rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <span style="font-size: 24px; font-weight: 900; color: #f59e0b;"><?php echo round($memory_usage/1024/1024, 1); ?></span>
                                    <span style="color: #64748b; font-size: 14px; font-weight: 700;">MB</span>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 10px; color: #64748b; text-transform: uppercase;">Engine Limit</div>
                                    <div style="font-size: 14px; font-weight: 800; color: #f1f5f9;"><?php echo $memory_limit; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Quick Commands -->
        <div class="col-lg-4">
            <div class="elite-card" style="padding: 30px;">
                <h4 style="color: #f59e0b; font-weight: 900; margin-bottom: 30px; letter-spacing: 2px; text-transform: uppercase; font-size: 14px; border-left: 4px solid #f59e0b; padding-left: 15px;">
                    Elite Commands
                </h4>
                
                <a href="<?php echo site_url('developer/identity'); ?>" class="action-button-pro">
                    <i class="fa fa-id-badge"></i>
                    <div>
                        <span class="atitle">Identity Control</span>
                        <span class="adesc">Override brand & app DNA.</span>
                    </div>
                </a>

                <a href="<?php echo site_url('developer/monitor'); ?>" class="action-button-pro">
                    <i class="fa fa-pulse"></i>
                    <div>
                        <span class="atitle">Neural Monitor</span>
                        <span class="adesc">Real-time system brain activity.</span>
                    </div>
                </a>

                <a href="<?php echo site_url('developer/database'); ?>" class="action-button-pro">
                    <i class="fa fa-cubes"></i>
                    <div>
                        <span class="atitle">Database Forge</span>
                        <span class="adesc">Direct engine storage manipulation.</span>
                    </div>
                </a>

                <a href="<?php echo site_url('updater'); ?>" class="action-button-pro" style="background: rgba(16, 185, 129, 0.05); border-color: rgba(16, 185, 129, 0.2);">
                    <i class="fa fa-refresh" style="color: #10b981;"></i>
                    <div>
                        <span class="atitle" style="color: #10b981;">Sync System</span>
                        <span class="adesc">Pull latest GHCBT updates.</span>
                    </div>
                </a>

                <div style="margin-top: 35px; padding: 25px; background: rgba(0,0,0,0.3); border-radius: 24px; border: 1px solid rgba(255,255,255,0.05);">
                    <p style="color: #64748b; font-size: 13px; font-style: italic; margin: 0; line-height: 1.6;">
                        "Sistem berada di bawah pengawasan penuh Anda. Gunakan konsol diagnostik dengan bijak demi stabilitas total."
                    </p>
                    <div style="margin-top: 15px; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #f59e0b; font-weight: 800; font-size: 11px;">GHCBT PRO - <?php echo $site_version; ?></span>
                        <span style="color: #1e293b; background: #f59e0b; padding: 2px 6px; border-radius: 6px; font-size: 9px; font-weight: 900;">ELITE</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
