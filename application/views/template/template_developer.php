<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <title>GHCBT | <?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=10, user-scalable=yes' name='viewport'>
    
    <?php 
      $dev_logo = file_exists(FCPATH . 'public/images/dev_logo.png') ? base_url() . 'public/images/dev_logo.png' : base_url() . 'public/images/logo.png';
    ?>
    <link rel="icon" href="<?php echo $dev_logo; ?>" type="image/png" />
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    
    <style>
      @font-face { font-family: 'Plus Jakarta Sans'; font-weight: 400; font-style: normal; font-display: swap; src: local('Plus Jakarta Sans'), local('Inter'), local('Segoe UI'), system-ui, sans-serif; }
      :root {
          --gold-primary: #f59e0b; 
          --gold-secondary: #fbbf24; 
          --gold-deep: #d97706;
          --gold-gradient: linear-gradient(135deg, #f59e0b 0%, #fbbf24 50%, #d97706 100%);
          --gold-glow: 0 0 15px rgba(245, 158, 11, 0.4); 
          --gold-glow-strong: 0 0 30px rgba(245, 158, 11, 0.6);
          --glass-bg: rgba(15, 23, 42, 0.7); 
          --deep-dark: #020617;
          --zenith-cyan: #06b6d4; 
          --border-light: rgba(245, 158, 11, 0.2);
          --deep-bg: #020617;
      }
      body { 
          background: var(--deep-bg) !important; 
          font-family: 'Plus Jakarta Sans', sans-serif !important; 
          color: #f1f5f9; 
          min-height: 100vh; 
          overflow-x: hidden; 
          padding: 0;
          margin: 0;
          -ms-overflow-style: none;  /* IE and Edge */
          scrollbar-width: none !important;  /* Firefox */
      }
      
      *::-webkit-scrollbar {
          display: none !important; /* Chrome, Safari and Opera */
      }
      
      * {
          -ms-overflow-style: none !important; /* IE and Edge */
          scrollbar-width: none !important; /* Firefox */
      }

      /* --- ZENITH VISUAL ENGINE --- */
      #tsparticles {
          position: fixed;
          inset: 0;
          z-index: 0;
          pointer-events: none;
      }
      .cyber-grid {
          position: fixed;
          top: 20%;
          left: 0;
          width: 100%;
          height: 200%;
          background-image: 
              linear-gradient(rgba(245, 158, 11, 0.05) 1px, transparent 1px),
              linear-gradient(90deg, rgba(245, 158, 11, 0.05) 1px, transparent 1px);
          background-size: 50px 50px;
          transform: perspective(600px) rotateX(60deg);
          z-index: 0;
          animation: gridMove 15s linear infinite;
          pointer-events: none;
      }
      @keyframes gridMove {
          0% { background-position: 0 0; }
          100% { background-position: 0 500px; }
      }
      .scanlines {
          position: fixed;
          inset: 0;
          background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%),
                      linear-gradient(90deg, rgba(245, 158, 11, 0.02), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.02));
          background-size: 100% 2px, 3px 100%;
          pointer-events: none;
          z-index: 1050;
          opacity: 0.15;
      }
      
      /* --- ULTIMATE FLOATING HEADER --- */
      .main-header { 
          background: rgba(15, 23, 42, 0.8) !important; 
          backdrop-filter: blur(30px) !important; 
          border: 1px solid var(--border-light) !important; 
          position: absolute !important; 
          top: 25px !important;
          left: 270px !important; 
          right: 20px !important;
          width: auto !important;
          height: 75px !important;
          border-radius: 20px !important;
          z-index: 1030; 
          box-shadow: 0 15px 50px rgba(0,0,0,0.5);
      }
      .main-header .navbar { 
          background: transparent !important; 
          margin-left: 0 !important; 
          border: none !important; 
          height: 100% !important;
          display: flex; 
          align-items: center; 
          justify-content: flex-end; 
          padding: 0 30px; 
      }
      
      /* --- PREMIUM USER TAG --- */
      .premium-user-tag {
          background: rgba(245, 158, 11, 0.05);
          border: 1px solid rgba(245, 158, 11, 0.3);
          padding: 8px 20px;
          border-radius: 14px;
          display: flex;
          align-items: center;
          gap: 12px;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          cursor: default;
          box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.05);
      }
      .premium-user-tag:hover {
          background: rgba(245, 158, 11, 0.1);
          border-color: var(--gold-primary);
          box-shadow: 0 0 25px rgba(245, 158, 11, 0.2);
          transform: translateY(-2px);
      }
      .user-avatar-glow {
          width: 32px; height: 32px;
          background: var(--gold-gradient);
          border-radius: 10px;
          display: flex;
          align-items: center;
          justify-content: center;
          color: #020617;
          font-size: 14px;
          box-shadow: var(--gold-glow);
      }
      .user-name-gold {
          font-weight: 900;
          font-size: 13px;
          color: #fff;
          text-transform: uppercase;
          letter-spacing: 1.5px;
          background: var(--gold-gradient);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          filter: drop-shadow(0 0 1px rgba(245, 158, 11, 0.5));
      }
      .verified-badge {
          color: var(--gold-primary);
          font-size: 10px;
      }

      .btn-terminate {
          color: #f43f5e !important;
          font-size: 18px;
          margin-left: 20px;
          transition: all 0.3s;
          padding: 10px;
          border-radius: 12px;
      }
      .btn-terminate:hover {
          background: rgba(244, 63, 94, 0.1);
          transform: rotate(90deg) scale(1.2);
      }

      /* --- ZENITH SIDEBAR RE-BRANDED --- */
      .main-sidebar { 
          background: var(--glass-bg) !important; 
          backdrop-filter: blur(40px) !important; 
          border: 1px solid var(--border-light) !important; 
          width: 230px !important; 
          position: fixed !important; 
          top: 25px !important;
          left: 20px !important;
          height: auto !important;
          min-height: 0 !important;
          max-height: calc(100vh - 50px) !important;
          border-radius: 28px !important;
          z-index: 1040; 
          box-shadow: 15px 0 50px rgba(0,0,0,0.4);
          padding-top: 0 !important;
          overflow-y: auto;
          overflow-x: hidden;
      }
      .main-sidebar::-webkit-scrollbar { display: none; }
      .main-sidebar::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.2); border-radius: 10px; }
      .main-sidebar .sidebar { height: auto !important; min-height: 0 !important; }

      .sidebar-branding {
          padding: 30px 20px;
          border-bottom: 1px solid rgba(245, 158, 11, 0.1);
          margin-bottom: 12px;
          text-align: center;
      }
      .sidebar-branding img { 
          max-width: 75%; 
          height: auto; 
          filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.3));
          margin-bottom: 5px;
      }
      .sidebar-branding .pro-label { 
          color: var(--gold-primary); 
          font-weight: 300; 
          font-size: 10px; 
          text-transform: uppercase; 
          letter-spacing: 2px;
          display: block;
      }

      .sidebar-menu { padding: 10px; list-style: none; }
      .sidebar-menu li a { 
          color: rgba(245, 158, 11, 0.7); 
          padding: 10px 18px; 
          display: flex; 
          align-items: center; 
          gap: 12px; 
          text-decoration: none; 
          border-radius: 14px; 
          transition: all 0.3s; 
          margin-bottom: 6px; 
          font-size: 12px; 
          font-weight: 700; 
          text-transform: uppercase;
          letter-spacing: 0.5px;
      }
      .sidebar-menu li.active a, .sidebar-menu li a:hover { 
          background: var(--gold-gradient); 
          color: #020617 !important; 
          box-shadow: var(--gold-glow); 
      }
      .sidebar-menu li a i { font-size: 18px; width: 25px; text-align: center; }

      /* --- CONTENT AREA --- */
      .content-wrapper { 
          margin-left: 0 !important; 
          background: transparent !important; 
          padding: 140px 35px 140px 290px !important; 
          min-height: 100vh; 
      }

      /* ELITE CARDS */
      .elite-card { 
          background: var(--glass-bg); 
          border: 1px solid var(--border-light); 
          border-radius: 32px; 
          padding: 40px; 
          margin-bottom: 35px; 
          position: relative;
          box-shadow: 0 20px 60px rgba(0,0,0,0.3);
          backdrop-filter: blur(15px);
      }
      
      .btn-gold-elite { 
          background: var(--gold-gradient) !important; 
          color: #020617 !important; 
          font-weight: 900 !important; 
          border: none !important; 
          border-radius: 18px !important; 
          padding: 15px 30px !important; 
          text-transform: uppercase; 
          letter-spacing: 2px; 
          transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
          font-size: 12px;
      }
      .btn-gold-elite:hover { transform: translateY(-7px) scale(1.02); box-shadow: var(--gold-glow-strong); }

      /* PREMIUM INPUTS */
      .elite-input, .form-control.elite-input {
          background: rgba(15, 23, 42, 0.6) !important;
          border: 1px solid rgba(245, 158, 11, 0.2) !important;
          border-radius: 16px !important;
          color: #f1f5f9 !important;
          backdrop-filter: blur(10px);
          transition: all 0.3s;
          padding: 12px 20px !important;
          height: auto !important;
      }
      .elite-input:focus, .form-control.elite-input:focus {
          border-color: var(--gold-primary) !important;
          box-shadow: 0 0 15px rgba(245, 158, 11, 0.2) !important;
          background: rgba(15, 23, 42, 0.8) !important;
          outline: none;
      }

      /* SELECT & TEXTAREA REFINEMENT */
      select.elite-input option {
          background: #0f172a;
          color: #f1f5f9;
      }

      /* PREMIUM TABLE STYLING */
      .elite-table {
          background: transparent !important;
          border-collapse: separate !important;
          border-spacing: 0 8px !important;
          margin-top: -8px !important;
      }
      .elite-table thead th {
          border: none !important;
          color: var(--gold-primary) !important;
          text-transform: uppercase !important;
          font-size: 11px !important;
          letter-spacing: 2px !important;
          font-weight: 900 !important;
          padding: 15px !important;
      }
      .elite-table tbody tr {
          background: rgba(255,255,255,0.02);
          transition: all 0.3s;
      }
      .elite-table tbody tr:hover {
          background: rgba(245, 158, 11, 0.05);
          transform: scale(1.01);
      }
      .elite-table tbody td {
          border: none !important;
          border-top: 1px solid rgba(255,255,255,0.05) !important;
          border-bottom: 1px solid rgba(255,255,255,0.05) !important;
          padding: 18px 15px !important;
          color: #cbd5e1;
          vertical-align: middle !important;
      }
      .elite-table tbody tr td:first-child {
          border-left: 1px solid rgba(255,255,255,0.05) !important;
          border-radius: 16px 0 0 16px;
      }
      .elite-table tbody tr td:last-child {
          border-right: 1px solid rgba(255,255,255,0.05) !important;
          border-radius: 0 16px 16px 0;
      }

      /* CODE & TERMINAL STYLING */
      code {
          background: rgba(15, 23, 42, 0.8) !important;
          color: var(--gold-primary) !important;
          padding: 4px 10px !important;
          border-radius: 8px !important;
          border: 1px solid rgba(245, 158, 11, 0.1) !important;
          font-family: 'JetBrains Mono', monospace;
          font-size: 90%;
          font-weight: 700;
      }

      /* FLOATING FOOTER */
      .main-footer { 
          position: absolute !important; 
          bottom: 25px !important; 
          left: 290px !important; 
          right: 25px !important;
          background: rgba(15, 23, 42, 0.9); 
          backdrop-filter: blur(25px); 
          border: 1px solid var(--border-light); 
          border-radius: 20px; 
          padding: 14px 35px; 
          display: flex; 
          align-items: center; 
          justify-content: space-between;
          box-shadow: 0 10px 50px rgba(0,0,0,0.6); 
          z-index: 1000;
          color: #64748b; 
          font-size: 11px; 
          margin: 0 !important; 
          width: auto !important;
      }
      .main-footer strong { color: var(--gold-primary); letter-spacing: 1px; font-weight: 900; }
      .footer-badge { background: var(--gold-gradient); color: #020617; padding: 4px 16px; border-radius: 14px; font-weight: 900; font-size: 9px; letter-spacing: 1px; }

      @media (max-width: 991px) {
          .main-sidebar { transform: translateX(-260px); }
          .sidebar-open .main-sidebar { transform: translateX(0); }
          .main-header { left: 15px !important; }
          .content-wrapper { padding: 110px 15px 120px 15px !important; }
          .main-footer { left: 15px !important; right: 15px !important; flex-direction: column; gap: 8px; text-align: center; }
      }
    </style>
    
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>
  </head>
  <body class="skin-blue">
    <div id="tsparticles"></div>
    <div class="cyber-grid"></div>
    <div class="scanlines"></div>
    <div class="wrapper" style="overflow: hidden; height: auto; min-height: 100%; position: relative;">
      
      <!-- Zenith Floating Header -->
      <header class="main-header">
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" style="display: flex; align-items: center;">
              <li>
                <div class="premium-user-tag">
                  <div class="user-avatar-glow">
                    <i class="fa fa-shield"></i>
                  </div>
                  <div style="display: flex; flex-direction: column; line-height: 1;">
                    <span style="font-size: 9px; color: var(--gold-primary); text-transform: uppercase; font-weight: 800; letter-spacing: 1px; margin-bottom: 3px;">Elite Operator</span>
                    <div style="display: flex; align-items: center; gap: 5px;">
                      <span class="user-name-gold"><?php echo $this->session->userdata('dev_nama'); ?></span>
                      <i class="fa fa-check-circle verified-badge"></i>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <a href="<?php echo site_url('maul/logout'); ?>" class="btn-terminate" title="Logout Developer">
                  <i class="fa fa-power-off"></i>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- Zenith Branding Sidebar -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="sidebar-branding">
            <img src="<?php echo $dev_logo; ?>" alt="Logo" />
          </div>
          
          <ul class="sidebar-menu">
            <li class="<?php echo $kode_menu == 'dev-dashboard' || $kode_menu == 'dev-studio' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer'); ?>"><i class="fa fa-th-large"></i> <span>DASHBOARD</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-db' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/database'); ?>"><i class="fa fa-database"></i> <span>DATABASE HUB</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-logs' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/logs'); ?>"><i class="fa fa-terminal"></i> <span>LOG EXPLORER</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-monitor' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/monitor'); ?>"><i class="fa fa-heartbeat"></i> <span>SYSTEM MONITOR</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-integrity' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/integrity'); ?>"><i class="fa fa-shield"></i> <span>SECURITY HUB</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-css' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/css_studio'); ?>"><i class="fa fa-magic"></i> <span>DESIGN STUDIO</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-identity' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/identity'); ?>"><i class="fa fa-flask"></i> <span>IDENTITY HUB</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-branding' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/branding'); ?>"><i class="fa fa-paint-brush"></i> <span>SUITE BRANDING</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-keymaster' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/keymaster'); ?>"><i class="fa fa-key"></i> <span>KEYMASTER PRO</span></a>
            </li>
          </ul>
        </section>
      </aside>

      <!-- Zenith Main Content -->
      <div class="content-wrapper">
        <section class="content">
          <?php echo $content; ?>
        </section>
      </div>

      <!-- Zenith Floating Footer -->
      <footer class="main-footer">
        <div>
          &copy; <?php echo date('Y'); ?> <strong><?php echo $site_name; ?></strong>. Developed by <span style="color: var(--gold-primary); font-weight: 700;"><?php echo strip_tags($dev_credits); ?></span>.
        </div>
        <div class="footer-badge"><?php echo $site_version; ?></div>
      </footer>

    </div>

    <!-- Modals -->
    <div class="modal fade" id="modal-proses" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="margin-top: 35vh;">
            <div class="modal-content" style="background: var(--glass-bg); border: 1px solid var(--gold-primary); border-radius: 32px; backdrop-filter: blur(20px); text-align: center; padding: 45px; box-shadow: 0 30px 80px rgba(0,0,0,0.7);">
                <div class="modal-body">
                    <div class="fa-spin" style="margin-bottom: 30px;">
                      <i class="fa fa-refresh fa-4x" style="color: var(--gold-primary); opacity: 0.9; filter: drop-shadow(0 0 20px rgba(245, 158, 11, 0.5));"></i>
                    </div>
                    <p style="font-weight: 900; font-size: 15px; color: #fff; text-transform: uppercase; letter-spacing: 4px;">Computing...</p>
                    <div id="build-progress-container" style="display:none; margin-top: 25px;">
                        <div style="background: rgba(255,255,255,0.05); height: 8px; border-radius: 20px; border: 1px solid rgba(245, 158, 11, 0.2); overflow: hidden;">
                            <div id="build-progress-bar" style="width: 0%; height: 100%; background: var(--gold-gradient); transition: width 0.3s ease;"></div>
                        </div>
                        <div id="build-progress-text" style="font-size: 10px; color: var(--gold-primary); font-weight: 900; margin-top: 10px; letter-spacing: 2px;">0% COMPLETION</div>
                    </div>
                    <div id="modal-divider" style="width: 80px; height: 3px; background: var(--gold-gradient); margin: 20px auto; border-radius: 10px; opacity: 0.6;"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // --- ZENITH NEURAL NARRATOR (Elegant Female Voice) ---
        var ZenithVoice = {
            speech: window.speechSynthesis,
            voices: [],
            elegantVoice: null,
            isReady: false,
            hasGreeted: false,

            init: function() {
                var self = this;
                function loadVoices() {
                    self.voices = self.speech.getVoices();
                    var femaleKeywords = ['gadis', 'siti', 'female', 'samantha', 'victoria', 'google US English', 'monica'];
                    var priorityVoices = self.voices.filter(v => v.lang.includes('id-ID'));
                    self.elegantVoice = priorityVoices.find(v => femaleKeywords.some(kw => v.name.toLowerCase().includes(kw)));
                    if(!self.elegantVoice) self.elegantVoice = priorityVoices.find(v => !v.name.toLowerCase().includes('male'));
                    if(!self.elegantVoice) self.elegantVoice = self.voices[0];
                    self.isReady = true;
                }
                loadVoices();
                if (speechSynthesis.onvoiceschanged !== undefined) {
                    speechSynthesis.onvoiceschanged = loadVoices;
                }
            },

            speak: function(text, callback) {
                if(!this.isReady) return;
                this.speech.cancel();
                var msg = new SpeechSynthesisUtterance();
                msg.text = text;
                msg.voice = this.elegantVoice;
                msg.lang = 'id-ID';
                msg.rate = 0.9; 
                msg.pitch = 1.0; 
                if (callback) {
                    msg.onend = function() {
                        if (typeof callback === 'function') callback();
                    };
                }
                this.speech.speak(msg);
            }
        };
        ZenithVoice.init();

        // --- ZENITH NEURAL PARTICLES ---
        tsParticles.load("tsparticles", {
            particles: {
                number: { value: 50, density: { enable: true, value_area: 800 } },
                color: { value: "#f59e0b" },
                shape: { type: "circle" },
                opacity: { value: 0.15, random: true },
                size: { value: 2, random: true },
                move: { enable: true, speed: 0.8, direction: "top", out_mode: "out" },
                links: { enable: true, distance: 150, color: "#f59e0b", opacity: 0.05, width: 1 }
            },
            interactivity: {
                events: { onhover: { enable: true, mode: "grab" }, onclick: { enable: true, mode: "push" } },
                modes: { grab: { distance: 200, line_linked: { opacity: 0.2 } } }
            }
        });

        $(function(){
            $('.btn-terminate').click(function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                ZenithVoice.speak("Sesi developer ditutup. Sampai jumpa kembali Master.", function(){
                    window.location.href = link;
                });
                
                // Backup redirect
                setTimeout(function(){ window.location.href = link; }, 2000);
            });
        });

        function notify_success(pesan){ 
            ZenithVoice.speak("Success. " + pesan);
            new PNotify({ title: 'SUCCESS', text: pesan, type: 'success', history: false, delay: 4000 }); 
        }
        function notify_info(pesan){ 
            new PNotify({ title: 'INFO', text: pesan, type: 'info', history: false, delay: 2000 }); 
        }
        function notify_error(pesan){ 
            ZenithVoice.speak("Awas Master! Mendeteksi ketidakstabilan sistem. Terjadi anomali pada inti pengembang.");

            new PNotify({ title: 'NEURAL ALERT', text: pesan, type: 'error', history: false, delay: 5000 }); 
        }
    </script>
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  </body>
</html>
