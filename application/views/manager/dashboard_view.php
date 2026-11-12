<style>
    @keyframes wave {
        0% { transform: rotate( 0.0deg) }
        10% { transform: rotate(14.0deg) }  
        20% { transform: rotate(-8.0deg) }
        30% { transform: rotate(14.0deg) }
        40% { transform: rotate(-4.0deg) }
        50% { transform: rotate(10.0deg) }
        60% { transform: rotate( 0.0deg) }  
        100% { transform: rotate( 0.0deg) }
    }
    .premium-welcome-banner {
        background: linear-gradient(135deg, #78350f 0%, #92400e 25%, #b45309 50%, #d97706 75%, #f59e0b 100%) !important;
        border-radius: 20px;
        padding: 40px 35px;
        color: #ffffff !important;
        box-shadow: 0 15px 35px -5px rgba(180, 83, 9, 0.35);
        margin: 0 0 20px 0 !important;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(254, 243, 199, 0.25);
    }
    
    .premium-welcome-banner::before {
        content: ''; position: absolute; right: -80px; top: -80px; width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        border-radius: 50%; animation: floating-orb 15s infinite alternate;
    }
    .premium-welcome-banner::after {
        content: ''; position: absolute; left: 10%; bottom: -50px; width: 150px; height: 150px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
        border-radius: 50%; animation: floating-orb 10s infinite alternate-reverse;
    }
    @keyframes floating-orb {
        from { transform: translate(0, 0); }
        to { transform: translate(30px, 40px); }
    }
    .welcome-title { font-weight: 800; font-size: 32px; margin: 0 0 10px 0; letter-spacing: -0.5px; position: relative; z-index: 10; color: #ffffff !important; text-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .welcome-subtitle { font-size: 15px; color: rgba(255, 255, 255, 0.95) !important; margin: 0; font-weight: 500; position: relative; z-index: 10; max-width: 650px; line-height: 1.6; }
    .badge-wrap { margin-top: 25px; display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 10; }
    .badge-class { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); padding: 8px 18px; border-radius: 12px; font-size: 13px; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.3); color: #ffffff; }
    
    /* Branding Capsules Sync */
    .badge-gold { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); color: #1e293b; padding: 8px 18px; border-radius: 12px; font-size: 13px; font-weight: 800; box-shadow: 0 6px 18px rgba(245, 158, 11, 0.3); border: 1px solid rgba(255,255,255,0.3); display: inline-flex; align-items: center; gap: 8px; }
    .badge-blue { background: rgba(255, 255, 255, 0.2); color: #ffffff; padding: 8px 18px; border-radius: 12px; font-size: 13px; font-weight: 800; border: 1px solid rgba(255,255,255,0.3); display: inline-flex; align-items: center; gap: 8px; }
</style>

<div class="premium-welcome-banner">
    <h1 class="welcome-title">Halo, <?php echo $nama; ?>! <span style="display: inline-block; animation: wave 2.5s infinite; transform-origin: 70% 70%;">👋</span></h1>
    <p class="welcome-subtitle">Selamat Datang di Pusat Kendali Utama <b><?php if(!empty($site_name)){ echo $site_name; } ?></b>. Dashboard Anda telah ditingkatkan ke <b>Elite Edition</b>.</p>
        
    <div class="badge-wrap">
        <span class="badge-class"><i class="fa fa-shield"></i> System Administrator</span>
        <span class="badge-gold"><i class="fa fa-star"></i> PLATFORM PRO</span>
        <span class="badge-blue"><i class="fa fa-code-fork"></i> <?php echo $site_version; ?></span>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <!-- Statistics Info Boxes -->
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="background: var(--bg-box); border: 1px solid var(--border-color); border-radius: 18px; box-shadow: var(--shadow-floating); overflow: hidden; min-height: 90px; transition: transform 0.25s ease, box-shadow 0.25s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-floating-hover)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-floating)';">
                <span class="info-box-icon" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important; color: white; border-radius: 16px 0 0 16px; height: 90px; line-height: 90px;"><i class="fa fa-graduation-cap"></i></span>
                <div class="info-box-content" style="padding: 16px;">
                    <span class="info-box-text" style="color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">Total Siswa</span>
                    <span class="info-box-number" style="font-size: 26px; font-weight: 800; color: #4f46e5;"><?php echo $total_peserta; ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="background: var(--bg-box); border: 1px solid var(--border-color); border-radius: 18px; box-shadow: var(--shadow-floating); overflow: hidden; min-height: 90px; transition: transform 0.25s ease, box-shadow 0.25s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-floating-hover)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-floating)';">
                <span class="info-box-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: white; border-radius: 16px 0 0 16px; height: 90px; line-height: 90px;"><i class="fa fa-book"></i></span>
                <div class="info-box-content" style="padding: 16px;">
                    <span class="info-box-text" style="color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">Bank Soal</span>
                    <span class="info-box-number" style="font-size: 26px; font-weight: 800; color: #10b981;"><?php echo $total_soal; ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="background: var(--bg-box); border: 1px solid var(--border-color); border-radius: 18px; box-shadow: var(--shadow-floating); overflow: hidden; min-height: 90px; transition: transform 0.25s ease, box-shadow 0.25s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-floating-hover)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-floating)';">
                <span class="info-box-icon" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important; color: white; border-radius: 16px 0 0 16px; height: 90px; line-height: 90px;"><i class="fa fa-pencil-square-o"></i></span>
                <div class="info-box-content" style="padding: 16px;">
                    <span class="info-box-text" style="color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">Daftar Ujian</span>
                    <span class="info-box-number" style="font-size: 26px; font-weight: 800; color: #0284c7;"><?php echo $total_tes; ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="background: var(--bg-box); border: 1px solid var(--border-color); border-radius: 18px; box-shadow: var(--shadow-floating); overflow: hidden; min-height: 90px; transition: transform 0.25s ease, box-shadow 0.25s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-floating-hover)';" onmouseout="this.style.transform='none'; this.style.boxShadow='var(--shadow-floating)';">
                <span class="info-box-icon" style="background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important; color: white; border-radius: 16px 0 0 16px; height: 90px; line-height: 90px;"><i class="fa fa-ban"></i></span>
                <div class="info-box-content" style="padding: 16px;">
                    <span class="info-box-text" style="color: var(--text-muted); font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">Pelanggaran</span>
                    <span class="info-box-number" style="font-size: 26px; font-weight: 800; color: #f43f5e;"><?php echo $total_pelanggaran; ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success" style="border-radius: 20px; border: 1px solid var(--border-color); overflow: hidden;">
                <div class="box-header with-border" style="background: var(--bg-box) !important; padding: 18px 25px; border-bottom: 1px solid var(--border-light) !important;">
                    <h3 class="box-title" style="font-weight: 700; color: var(--text-bright);"><i class="fa fa-refresh fa-spin" style="margin-right: 10px;"></i> Radar Monitor Ujian Langsung</h3>
                    <div class="box-tools pull-right">
                        <span id="ai-voice-status" class="badge" style="background: rgba(var(--primary-rgb), 0.1); border: 1px solid var(--border-light); color: var(--text-muted); padding: 5px 12px; margin-right: 10px; display: none;"></span>
                        <span class="badge bg-green" id="active-count" style="background: #10b981 !important; border-radius: 8px; padding: 5px 12px; font-weight: 700;">0 Aktif</span>
                    </div>
                </div>
                <div class="box-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table-monitor" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background: var(--bg-body) !important;">
                                    <th style="padding-left: 25px; width: 30%;">Siswa</th>
                                    <th style="width: 25%;">Ujian / Grup</th>
                                    <th style="width: 15%;">Mulai</th>
                                    <th style="width: 30%; padding-right: 25px;">Progress Pengerjaan</th>
                                </tr>
                            </thead>
                            <tbody id="monitor-body">
                                <tr>
                                    <td colspan="4" class="text-center" style="padding: 40px; color: var(--text-muted);">
                                        <i class="fa fa-info-circle" style="margin-right: 5px;"></i> Tidak ada siswa yang sedang aktif ujian saat ini.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer" id="monitor-pagination-wrapper" style="background: rgba(16, 185, 129, 0.03); border-top: 1px solid var(--border-light); padding: 12px 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div style="color: var(--text-muted); font-size: 13px; font-weight: 600;">
                        Menampilkan <span id="monitor-page-info" style="color: var(--text-bright); font-weight: 700;">0 - 0 dari 0</span> Siswa Aktif
                    </div>
                    <div class="btn-group" id="monitor-pagination-btns">
                        <button type="button" class="btn btn-default btn-sm" id="btn-monitor-prev" onclick="changeMonitorPage(-1)" style="border-radius: 8px 0 0 8px; font-weight: 600;" disabled>
                            <i class="fa fa-chevron-left"></i> Sebelumnya
                        </button>
                        <button type="button" class="btn btn-default btn-sm" id="btn-monitor-page-num" style="font-weight: 700; pointer-events: none; background: #fff; min-width: 70px;">
                            1 / 1
                        </button>
                        <button type="button" class="btn btn-default btn-sm" id="btn-monitor-next" onclick="changeMonitorPage(1)" style="border-radius: 0 8px 8px 0; font-weight: 600;" disabled>
                            Selanjutnya <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-flex-eq" style="margin-bottom: 25px;">
        <div class="col-md-8 col-sm-12">
            <div class="box box-primary" style="border-radius: 20px; overflow: hidden; margin-bottom: 0;">
                <div class="box-header with-border" style="background: rgba(var(--primary-rgb), 0.03) !important; padding: 18px 25px; flex-shrink: 0;">
                    <h3 class="box-title" style="font-size: 18px; font-weight: 700; color: var(--text-bright);"><i class="fa fa-diamond" style="color: var(--accent-color); margin-right: 8px;"></i> Fitur Eksklusif <?php echo $app_identity; ?> <span style="font-weight: 800; color: #f59e0b;">PRO</span></h3>
                </div>
                <div class="box-body" style="padding: 25px; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between;">
                    <p style="font-size: 14px; color: var(--text-main); margin-bottom: 20px; line-height: 1.6;">Selamat datang di Pusat Kendali Utama <b><?php if(!empty($site_name)){ echo $site_name; } ?></b>. Sistem Administrasi Ujian ini diracik dengan standar _Enterprise_ untuk memastikan kenyamanan tingkat tinggi dan keamanan berlapis.</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; flex: 1;">
                        <div style="background: rgba(var(--primary-rgb), 0.04); border: 1px solid var(--border-light); border-radius: 16px; padding: 18px 20px; display: flex; flex-direction: column; justify-content: flex-start; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.borderColor='var(--accent-color)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-light)';">
                            <i class="fa fa-shield" style="font-size: 26px; color: #f43f5e; margin-bottom: 10px; display: block;"></i>
                            <h4 style="font-weight: 700; color: var(--text-bright); margin-top: 0; margin-bottom: 8px; font-size: 15px;">Radar Real-Time</h4>
                            <p style="color: var(--text-muted); font-size: 12.5px; line-height: 1.5; margin: 0;">Sistem terpusat melacak indikasi kecurangan siswa seketika, dan menyajikan notifikasi auto-refresh aktif di layar pengawas.</p>
                        </div>
                        <div style="background: rgba(var(--primary-rgb), 0.04); border: 1px solid var(--border-light); border-radius: 16px; padding: 18px 20px; display: flex; flex-direction: column; justify-content: flex-start; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.borderColor='var(--accent-color)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-light)';">
                            <i class="fa fa-paint-brush" style="font-size: 26px; color: #0ea5e9; margin-bottom: 10px; display: block;"></i>
                            <h4 style="font-weight: 700; color: var(--text-bright); margin-top: 0; margin-bottom: 8px; font-size: 15px;">Glassmorphism UI</h4>
                            <p style="color: var(--text-muted); font-size: 12.5px; line-height: 1.5; margin: 0;">Antarmuka visual tingkat lanjut menggunakan paduan gradasi estetik dan efek kaca tembus pandang yang sempurna.</p>
                        </div>
                        <div style="background: rgba(var(--primary-rgb), 0.04); border: 1px solid var(--border-light); border-radius: 16px; padding: 18px 20px; display: flex; flex-direction: column; justify-content: flex-start; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.borderColor='var(--accent-color)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-light)';">
                            <i class="fa fa-rocket" style="font-size: 26px; color: #10b981; margin-bottom: 10px; display: block;"></i>
                            <h4 style="font-weight: 700; color: var(--text-bright); margin-top: 0; margin-bottom: 8px; font-size: 15px;">Backup Database Ganda</h4>
                            <p style="color: var(--text-muted); font-size: 12.5px; line-height: 1.5; margin: 0;">Fitur pencadangan data otomatis dan manual untuk memastikan integritas data ujian Anda selalu terlindungi 100%.</p>
                        </div>
                        <div style="background: rgba(var(--primary-rgb), 0.04); border: 1px solid var(--border-light); border-radius: 16px; padding: 18px 20px; display: flex; flex-direction: column; justify-content: flex-start; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.borderColor='var(--accent-color)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-light)';">
                            <i class="fa fa-line-chart" style="font-size: 26px; color: #8b5cf6; margin-bottom: 10px; display: block;"></i>
                            <h4 style="font-weight: 700; color: var(--text-bright); margin-top: 0; margin-bottom: 8px; font-size: 15px;">Visual Analisis Statistik</h4>
                            <p style="color: var(--text-muted); font-size: 12.5px; line-height: 1.5; margin: 0;">Ubah angka mentah menjadi wawasan visual melalui grafik Chart.js untuk menganalisis tingkat kesulitan soal secara akurat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-12">
            <div class="box box-info" style="border-radius: 20px; overflow: hidden; margin-bottom: 0;">
                <div class="box-header with-border" style="background: rgba(var(--primary-rgb), 0.03) !important; padding: 18px 25px; flex-shrink: 0;">
                    <h3 class="box-title" style="font-size: 18px; font-weight: 700; color: var(--text-bright);"><i class="fa fa-clock-o" style="color: var(--accent-color); margin-right: 8px;"></i> Jam Sistem Valid</h3>
                </div>
                <div class="box-body no-padding" style="flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between;">
                    <ul class="list-group list-group-unbordered" style="margin: 0; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-around;">
                        <li class="list-group-item" style="padding: 20px 25px; border-left: none; border-right: none; border-top: none; background: transparent; flex: 1; display: flex; flex-direction: column; justify-content: center;">
                            <b style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; display: block;">WAKTU SERVER UTAMA</b>
                            <div style="margin-top: 6px;">
                                <span id="server-date" style="font-size: 13.5px; font-weight: 600; color: var(--text-main); display: block; margin-bottom: 3px;"><i class="fa fa-calendar" style="color: var(--accent-color); margin-right:8px; opacity: 0.85;"></i>Memuat Tanggal...</span>
                                <span id="server-time" style="font-size: 28px; font-weight: 800; color: var(--text-bright); letter-spacing: 1px; text-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.2); font-variant-numeric: tabular-nums;"><i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i></span>
                            </div>
                        </li>
                        <li class="list-group-item" style="padding: 20px 25px; border-left: none; border-right: none; background: transparent; border-top: 1px solid var(--border-light); flex: 1; display: flex; flex-direction: column; justify-content: center;">
                            <b style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; display: block;">WAKTU KOMPUTER DATABASE</b>
                            <div style="margin-top: 6px;">
                                <span id="db-date" style="font-size: 13.5px; font-weight: 600; color: var(--text-main); display: block; margin-bottom: 3px;"><i class="fa fa-calendar" style="color: var(--accent-color); margin-right:8px; opacity: 0.85;"></i>Memuat Tanggal...</span>
                                <span id="db-time" style="font-size: 28px; font-weight: 800; color: var(--text-bright); letter-spacing: 1px; text-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.2); font-variant-numeric: tabular-nums;"><i class="fa fa-spinner fa-spin" style="font-size: 20px;"></i></span>
                            </div>
                        </li>
                    </ul>
                    
                    <div style="padding: 16px 25px; background: rgba(var(--primary-rgb), 0.04); border-top: 1px solid var(--border-light); flex-shrink: 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 13px; font-weight: 600;"><i class="fa fa-upload text-success" style="margin-right: 6px;"></i> PHP Upload Max</span>
                            <span class="badge" style="background: #10b981; border-radius: 8px; font-size: 12px; padding: 4px 12px; font-weight: 700;"><?php echo $upload_max_filesize; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: var(--text-muted); font-size: 13px; font-weight: 600;"><i class="fa fa-database text-info" style="margin-right: 6px;"></i> PHP Post Max</span>
                            <span class="badge" style="background: #0284c7; border-radius: 8px; font-size: 12px; padding: 4px 12px; font-weight: 700;"><?php echo $post_max_size; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // System Clock Synchronizer via Javascript Initialized by Server
    var sStr = '<?php echo $waktu_server; ?>'.replace(/-/g, '/');
    var dStr = '<?php echo $waktu_database; ?>'.replace(/-/g, '/');
    
    var serverTime = new Date(sStr).getTime();
    var dbTime = new Date(dStr).getTime();

    // Fallback if PHP string is invalid for local browser engine parsing
    if(isNaN(serverTime)) serverTime = new Date().getTime();
    if(isNaN(dbTime)) dbTime = new Date().getTime();

    const monthNamesId = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    setInterval(function(){
        // Increment timestamp exactly by 1000 milliseconds (1 second) each cycle
        serverTime += 1000;
        dbTime += 1000;

        let sDate = new Date(serverTime);
        let dDate = new Date(dbTime);

        let sTanggal = sDate.getDate() + ' ' + monthNamesId[sDate.getMonth()] + ' ' + sDate.getFullYear();
        let dTanggal = dDate.getDate() + ' ' + monthNamesId[dDate.getMonth()] + ' ' + dDate.getFullYear();

        let sJam = sDate.getHours().toString().padStart(2, '0') + ':' + 
                   sDate.getMinutes().toString().padStart(2, '0') + '<span style="opacity: 0.6; font-size: 22px;">:' + 
                   sDate.getSeconds().toString().padStart(2, '0') + '</span>';
        
        let dJam = dDate.getHours().toString().padStart(2, '0') + ':' + 
                   dDate.getMinutes().toString().padStart(2, '0') + '<span style="opacity: 0.6; font-size: 22px;">:' + 
                   dDate.getSeconds().toString().padStart(2, '0') + '</span>';

        document.getElementById('server-date').innerHTML = '<i class="fa fa-calendar" style="margin-right:8px; display:inline-block;"></i>' + sTanggal;
        document.getElementById('server-time').innerHTML = sJam;
        
        document.getElementById('db-date').innerHTML = '<i class="fa fa-calendar" style="margin-right:8px; display:inline-block;"></i>' + dTanggal;
        document.getElementById('db-time').innerHTML = dJam;
    }, 1000);

    // Live Exam Monitoring Polling with Tabulation / Pagination (10 per page)
    var allMonitorData = [];
    var currentMonitorPage = 1;
    var monitorPageSize = 10;

    function renderMonitorPage() {
        var total = allMonitorData.length;
        var totalPages = Math.ceil(total / monitorPageSize);
        if(totalPages === 0) totalPages = 1;
        if(currentMonitorPage > totalPages) currentMonitorPage = totalPages;
        if(currentMonitorPage < 1) currentMonitorPage = 1;

        var startIdx = (currentMonitorPage - 1) * monitorPageSize;
        var endIdx = Math.min(startIdx + monitorPageSize, total);
        var pageItems = allMonitorData.slice(startIdx, endIdx);

        if(total > 0) {
            var html = '';
            $.each(pageItems, function(i, item) {
                var percent = Math.round((item.soal_terjawab / item.total_soal) * 100);
                var barColor = 'progress-bar-success';
                if(percent >= 100) barColor = 'progress-bar-success';
                else if(percent >= 70) barColor = 'progress-bar-info';
                else if(percent >= 40) barColor = 'progress-bar-warning';
                else barColor = 'progress-bar-danger';

                html += '<tr>';
                html += '<td style="padding-left: 25px;"><div style="font-weight: 700; color: var(--text-bright);">' + item.nama_siswa + '</div><small class="text-muted">ID: ' + item.tesuser_id + '</small></td>';
                html += '<td><div style="font-weight: 600;">' + item.tes_nama + '</div><small class="text-muted">' + item.grup_nama + '</small></td>';
                html += '<td><span class="label label-default" style="border-radius: 6px;">' + item.menit_berjalan + ' menit lalu</span></td>';
                html += '<td style="padding-right: 25px;">';
                html += '  <div class="progress progress-xs active" style="margin-bottom: 5px; background: rgba(0,0,0,0.06); border-radius: 6px; overflow: hidden;">';
                html += '    <div class="progress-bar ' + barColor + ' progress-bar-striped" role="progressbar" style="width: ' + percent + '%"></div>';
                html += '  </div>';
                html += '  <small class="pull-left text-muted" style="font-weight: 600;">' + item.soal_terjawab + ' / ' + item.total_soal + ' Soal</small>';
                html += '  <small class="pull-right" style="font-weight: 700; color: var(--text-main);">' + percent + '%</small>';
                html += '</td>';
                html += '</tr>';
            });
            $('#monitor-body').html(html);
            $('#monitor-page-info').text((startIdx + 1) + ' - ' + endIdx + ' dari ' + total);
        } else {
            $('#monitor-body').html('<tr><td colspan="4" class="text-center" style="padding: 40px; color: var(--text-muted);"><i class="fa fa-info-circle"></i> Tidak ada siswa yang sedang aktif ujian saat ini.</td></tr>');
            $('#monitor-page-info').text('0 - 0 dari 0');
        }

        $('#btn-monitor-page-num').text(currentMonitorPage + ' / ' + totalPages);
        $('#btn-monitor-prev').prop('disabled', currentMonitorPage <= 1);
        $('#btn-monitor-next').prop('disabled', currentMonitorPage >= totalPages);
    }

    function changeMonitorPage(delta) {
        currentMonitorPage += delta;
        renderMonitorPage();
    }

    function updateMonitoring() {
        $.getJSON('<?php echo site_url('manager/dashboard/get_monitoring_data'); ?>', function(data) {
            allMonitorData = data || [];
            $('#active-count').text(allMonitorData.length + ' Aktif');
            renderMonitorPage();
        });
    }

    // Initial load and interval
    updateMonitoring();
    setInterval(updateMonitoring, 20000); // Update every 20 seconds
</script>