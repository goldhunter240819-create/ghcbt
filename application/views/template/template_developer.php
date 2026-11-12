<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <title>GHCBT | <?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=10, user-scalable=yes' name='viewport'>
    
    <?php 
      $dev_logo = base_url('public/images/logo_modern.png') . '?v=' . time();
    ?>
    <link rel="icon" href="<?php echo $dev_logo; ?>" type="image/png" />
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    
    <style>
      @font-face { 
        font-family: 'Plus Jakarta Sans'; 
        font-weight: 400; font-style: normal; font-display: swap; 
        src: local('Plus Jakarta Sans'), local('Inter'), local('Segoe UI'), system-ui, sans-serif; 
      }

      :root {
          /* Luxury Gold & Obsidian Amber Brand Palette */
          --bg-body: #f8fafc;
          --bg-wrapper: #f8fafc;
          --bg-sidebar: linear-gradient(180deg, #78350f 0%, #92400e 30%, #b45309 60%, #d97706 100%);
          --bg-nav: linear-gradient(90deg, #78350f 0%, #92400e 25%, #b45309 50%, #d97706 75%, #f59e0b 100%);
          --bg-footer: linear-gradient(90deg, #78350f 0%, #92400e 40%, #b45309 80%, #78350f 100%);
          --sidebar-text: #fef3c7;
          --sidebar-text-hover: #ffffff;
          --bg-box: #ffffff;
          --text-main: #0f172a;
          --text-muted: #64748b;
          --text-bright: #b45309;
          --primary-gradient: linear-gradient(135deg, #b45309 0%, #d97706 50%, #f59e0b 100%);
          --gold-primary: #d97706; 
          --gold-secondary: #f59e0b; 
          --gold-gradient: linear-gradient(135deg, #b45309 0%, #d97706 50%, #f59e0b 100%);
          --border-color: #cbd5e1;
          --border-light: #e2e8f0;
          --shadow-floating: 0 10px 25px -4px rgba(15, 23, 42, 0.06), 0 4px 8px -2px rgba(15, 23, 42, 0.03);
      }

      body { 
          background: var(--bg-body) !important; 
          font-family: 'Plus Jakarta Sans', sans-serif !important; 
          color: var(--text-main); 
          min-height: 100vh; 
          overflow-x: hidden; 
          padding: 0;
          margin: 0;
      }

      .wrapper {
          background: transparent !important;
          min-height: 100vh;
          position: relative;
      }
      
      /* --- NAVBAR HEADER (MATCHING CBT) --- */
      .main-header { 
          background: var(--bg-nav) !important; 
          position: fixed !important; 
          top: 0 !important;
          left: 230px !important; 
          right: 0 !important;
          height: 56px !important;
          z-index: 1030; 
          box-shadow: 0 4px 20px rgba(120, 53, 15, 0.25);
          transition: left 0.3s ease-in-out;
      }
      .main-header .navbar { 
          background: transparent !important; 
          margin-left: 0 !important; 
          border: none !important; 
          height: 100% !important;
          display: flex; 
          align-items: center; 
          justify-content: space-between !important; 
          padding: 0 25px; 
      }
      
      .navbar-brand-pill {
          display: flex;
          align-items: center;
          gap: 10px;
          background: rgba(0, 0, 0, 0.15);
          padding: 6px 16px;
          border-radius: 20px;
          border: 1px solid rgba(255, 255, 255, 0.15);
      }
      .navbar-brand-pill .pulse-dot {
          width: 8px; height: 8px;
          background: #10b981;
          border-radius: 50%;
          box-shadow: 0 0 8px #10b981;
          animation: pulseDot 2s infinite;
      }
      .navbar-brand-pill span {
          font-weight: 800;
          font-size: 12px;
          color: #ffffff;
          letter-spacing: 0.8px;
          text-transform: uppercase;
      }

      .btn-open-cbt {
          background: rgba(255, 255, 255, 0.18);
          color: #ffffff !important;
          border: 1px solid rgba(255, 255, 255, 0.25);
          border-radius: 12px;
          padding: 6px 14px;
          font-size: 11px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.5px;
          text-decoration: none !important;
          transition: all 0.2s ease;
          display: inline-flex;
          align-items: center;
          gap: 6px;
      }
      .btn-open-cbt:hover {
          background: #ffffff;
          color: var(--text-bright) !important;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
          transform: translateY(-1px);
      }

      /* Operator Tag */
      .premium-user-tag {
          background: rgba(255, 255, 255, 0.15);
          border: 1px solid rgba(255, 255, 255, 0.25);
          padding: 5px 15px;
          border-radius: 12px;
          display: flex;
          align-items: center;
          gap: 10px;
          color: #ffffff;
      }
      .user-avatar-glow {
          width: 28px; height: 28px;
          background: #ffffff;
          border-radius: 8px;
          display: flex;
          align-items: center;
          justify-content: center;
          color: var(--gold-primary);
          font-size: 13px;
          font-weight: 900;
      }
      .user-name-gold {
          font-weight: 800;
          font-size: 12px;
          color: #ffffff;
          letter-spacing: 0.5px;
      }

      .btn-terminate {
          color: #fef2f2 !important;
          font-size: 16px;
          margin-left: 15px;
          transition: all 0.25s;
          padding: 8px 12px;
          border-radius: 10px;
          background: rgba(239, 68, 68, 0.25);
          border: 1px solid rgba(239, 68, 68, 0.35);
          display: inline-flex;
          align-items: center;
          text-decoration: none !important;
      }
      .btn-terminate:hover {
          background: #ef4444;
          color: #ffffff !important;
          transform: translateY(-1px);
          box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
      }

      /* --- SIDEBAR (MATCHING CBT LUXURY AMBER) --- */
      .main-sidebar { 
          background: var(--bg-sidebar) !important; 
          width: 230px !important; 
          position: fixed !important; 
          top: 0 !important;
          bottom: 0 !important;
          left: 0 !important;
          height: 100vh !important;
          z-index: 1040; 
          box-shadow: 4px 0 25px rgba(0, 0, 0, 0.12);
          padding-top: 0 !important;
          overflow-y: auto;
          overflow-x: hidden;
      }
      .main-sidebar::-webkit-scrollbar { width: 5px; }
      .main-sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }

      .sidebar-branding {
          padding: 20px 15px 15px;
          border-bottom: 1px solid rgba(254, 243, 199, 0.2);
          margin-bottom: 12px;
          text-align: center;
          background: transparent;
      }
      .sidebar-branding img { 
          max-width: 80%; 
          height: 56px; 
          object-fit: contain;
          filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
          transition: transform 0.3s ease;
      }
      .sidebar-branding img:hover {
          transform: scale(1.05);
      }
      .sidebar-branding .pro-label { 
          color: var(--sidebar-text); 
          font-weight: 800; 
          font-size: 10px; 
          text-transform: uppercase; 
          letter-spacing: 2px;
          display: block;
          margin-top: 5px;
          opacity: 0.9;
      }

      .sidebar-menu { 
          padding: 10px 12px; 
          list-style: none; 
          margin: 0; 
      }
      .sidebar-menu li a { 
          color: var(--sidebar-text); 
          padding: 11px 16px; 
          display: flex; 
          align-items: center; 
          gap: 12px; 
          text-decoration: none; 
          border-radius: 10px; 
          transition: all 0.2s ease; 
          margin-bottom: 5px; 
          font-size: 11.5px; 
          font-weight: 700; 
          text-transform: uppercase;
          letter-spacing: 0.6px;
      }
      .sidebar-menu li a:hover { 
          background: rgba(255, 255, 255, 0.18); 
          color: #ffffff !important; 
          transform: translateX(4px);
      }
      .sidebar-menu li.active a { 
          background: rgba(255, 255, 255, 0.25) !important; 
          color: #ffffff !important; 
          font-weight: 800;
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); 
          border-left: 4px solid #ffffff;
      }
      .sidebar-menu li a i { font-size: 15px; width: 22px; text-align: center; opacity: 0.9; }

      /* --- CONTENT AREA (MATCHING CBT LIGHT) --- */
      .content-wrapper { 
          margin-left: 230px !important; 
          background: var(--bg-body) !important; 
          padding: 24px 28px 80px !important; 
          margin-top: 56px !important;
          min-height: calc(100vh - 56px) !important; 
          box-sizing: border-box !important;
      }

      /* UNIVERSAL PAGE BANNER */
      .content-header-banner {
          background: var(--primary-gradient);
          border-radius: 20px;
          padding: 24px 30px;
          margin-bottom: 25px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          color: #ffffff;
          box-shadow: 0 10px 25px -4px rgba(217, 119, 6, 0.25);
          position: relative;
          overflow: hidden;
      }
      .content-header-banner h2 {
          margin: 0;
          font-weight: 900;
          font-size: 22px;
          letter-spacing: -0.5px;
          color: #ffffff;
      }
      .content-header-banner p {
          margin: 4px 0 0;
          font-size: 13px;
          color: rgba(255, 255, 255, 0.9);
          font-weight: 500;
      }
      .banner-badge-status {
          background: rgba(255, 255, 255, 0.2);
          border: 1px solid rgba(255, 255, 255, 0.35);
          color: #ffffff;
          font-weight: 800;
          font-size: 11px;
          padding: 8px 18px;
          border-radius: 20px;
          letter-spacing: 1px;
          text-transform: uppercase;
          display: flex;
          align-items: center;
          gap: 8px;
          backdrop-filter: blur(10px);
      }

      /* ELITE CARDS (MATCHING CBT LIGHT) */
      .elite-card { 
          background: #ffffff !important; 
          border: 1px solid var(--border-light) !important; 
          border-radius: 20px !important; 
          padding: 30px !important; 
          margin-bottom: 25px; 
          position: relative;
          box-shadow: var(--shadow-floating) !important;
          color: var(--text-main);
      }
      
      .btn-gold-elite { 
          background: var(--primary-gradient) !important; 
          color: #ffffff !important; 
          font-weight: 800 !important; 
          border: none !important; 
          border-radius: 12px !important; 
          padding: 12px 24px !important; 
          text-transform: uppercase; 
          letter-spacing: 1px; 
          transition: all 0.25s ease; 
          font-size: 12px;
          box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25);
      }
      .btn-gold-elite:hover { 
          transform: translateY(-2px); 
          box-shadow: 0 6px 18px rgba(217, 119, 6, 0.35); 
          color: #ffffff !important;
      }

      /* FORM INPUTS */
      .elite-input, .form-control.elite-input {
          background: #ffffff !important;
          border: 1.5px solid var(--border-color) !important;
          border-radius: 12px !important;
          color: var(--text-main) !important;
          transition: all 0.2s ease;
          padding: 12px 16px !important;
          height: auto !important;
          font-weight: 600;
      }
      .elite-input:focus, .form-control.elite-input:focus {
          border-color: var(--gold-primary) !important;
          box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.15) !important;
          outline: none;
      }

      /* TABLES */
      .elite-table {
          background: transparent !important;
          border-collapse: separate !important;
          border-spacing: 0 6px !important;
          width: 100%;
      }
      .elite-table thead th {
          border: none !important;
          color: var(--text-bright) !important;
          text-transform: uppercase !important;
          font-size: 11px !important;
          letter-spacing: 1px !important;
          font-weight: 800 !important;
          padding: 12px 15px !important;
      }
      .elite-table tbody tr {
          background: #f8fafc;
          transition: all 0.2s;
          border-radius: 12px;
      }
      .elite-table tbody tr:hover {
          background: #fffbeb !important;
          transform: translateY(-1px);
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
      }
      .elite-table tbody td {
          border: none !important;
          padding: 14px 15px !important;
          color: var(--text-main);
          vertical-align: middle !important;
          font-weight: 500;
      }
      .elite-table tbody tr td:first-child {
          border-radius: 12px 0 0 12px;
      }
      .elite-table tbody tr td:last-child {
          border-radius: 0 12px 12px 0;
      }

      /* FOOTER */
      .main-footer {
          background: #ffffff !important;
          border-top: 1px solid var(--border-light) !important;
          position: fixed !important;
          bottom: 0 !important;
          left: 230px !important;
          right: 0 !important;
          height: 48px !important;
          padding: 0 25px !important;
          display: flex;
          align-items: center;
          justify-content: space-between;
          font-size: 12px;
          color: var(--text-muted);
          z-index: 1020;
      }
      .footer-badge {
          background: var(--primary-gradient);
          color: #ffffff;
          padding: 3px 10px;
          border-radius: 10px;
          font-size: 11px;
          font-weight: 700;
      }

      @keyframes pulseDot {
          0%, 100% { transform: scale(1); opacity: 1; }
          50% { transform: scale(1.3); opacity: 0.6; }
      }
    </style>
    
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
      
      <!-- Luxury Gold Floating Header -->
      <header class="main-header">
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-left-menu" style="display: flex; align-items: center; gap: 15px;">
            <div class="navbar-brand-pill">
              <span class="pulse-dot"></span>
              <span>GHCBT Developer Suite</span>
            </div>
            <a href="<?php echo site_url('manager/dashboard'); ?>" target="_blank" class="btn-open-cbt" title="Buka Dashboard CBT Manager di Tab Baru">
              <i class="fa fa-external-link"></i> Buka CBT Manager
            </a>
          </div>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" style="display: flex; align-items: center; margin: 0; list-style: none;">
              <li>
                <div class="premium-user-tag">
                  <div class="user-avatar-glow">
                    <i class="fa fa-terminal"></i>
                  </div>
                  <div style="display: flex; flex-direction: column; line-height: 1.2;">
                    <span style="font-size: 9px; opacity: 0.9; text-transform: uppercase; font-weight: 700; letter-spacing: 0.8px;">Developer Node</span>
                    <span class="user-name-gold"><?php echo $this->session->userdata('dev_nama'); ?></span>
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

      <!-- Luxury Amber Sidebar -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="sidebar-branding">
            <img src="<?php echo $dev_logo; ?>" alt="Logo" />
            <span class="pro-label">Architect Edition</span>
          </div>
          
          <ul class="sidebar-menu">
            <li class="<?php echo $kode_menu == 'dev-dashboard' || $kode_menu == 'dev-studio' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer'); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-db' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/database'); ?>"><i class="fa fa-database"></i> <span>DATABASE HUB</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-logs' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/logs'); ?>"><i class="fa fa-terminal"></i> <span>LOG EXPLORER</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-monitor' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/monitor'); ?>"><i class="fa fa-area-chart"></i> <span>SYSTEM MONITOR</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-integrity' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/integrity'); ?>"><i class="fa fa-shield"></i> <span>SECURITY HUB</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-css' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/css_studio'); ?>"><i class="fa fa-magic"></i> <span>DESIGN STUDIO</span></a>
            </li>
            <li class="<?php echo $kode_menu == 'dev-identity' ? 'active' : ''; ?>">
              <a href="<?php echo site_url('developer/identity'); ?>"><i class="fa fa-sliders"></i> <span>IDENTITY HUB</span></a>
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

      <!-- Main Content -->
      <div class="content-wrapper">
        <section class="content" style="padding: 0;">
          <?php echo $content; ?>
        </section>
      </div>

      <!-- Footer -->
      <footer class="main-footer">
        <div>
          &copy; <?php echo date('Y'); ?> <strong><?php echo $site_name; ?></strong>. Developed by <span style="color: var(--gold-primary); font-weight: 700;"><?php echo strip_tags($dev_credits); ?></span>.
        </div>
        <div class="footer-badge"><?php echo $site_version; ?></div>
      </footer>

    </div>
  </body>
</html>
