<?php
$foto_src = base_url() . 'public/images/avatar.png';
$session_foto = $this->session->userdata('cbt_tes_foto');
if(!empty($session_foto) && file_exists(FCPATH . 'public/uploads/siswa/' . $session_foto)) {
    $foto_src = base_url() . 'public/uploads/siswa/' . $session_foto;
}
?>
<!DOCTYPE html>
<html data-theme="darkblue">
  <head>
    <meta charset="UTF-8">
    <title><?php if(!empty($site_name)){ echo $site_name; } ?> | <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=10, user-scalable=yes' name='viewport'>
	<meta name="description" content="Aplikasi Ujian Online GHCBT">
	<meta name="keywords" content="Aplikasi Ujian Online GHCBT">
	<meta name="author" content="Achmad Lutfi - Gold Hunter">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    <script>
      (function() {
          let savedTheme = localStorage.getItem('cbt-global-theme');
          if (!savedTheme || savedTheme === 'darkblue') {
              savedTheme = 'dark';
          } else if (savedTheme === 'skyblue') {
              savedTheme = 'light';
          }
          document.documentElement.setAttribute('data-theme', savedTheme);
      })();
    </script>
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>public/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>public/plugins/html5shiv/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>public/plugins/respond/respond.min.js"></script>
    <![endif]-->
    
    
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/app.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>public/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>
    <!-- Local Font Fallback (Offline Ready) -->
    <style>
      @font-face {
        font-family: 'Outfit';
        font-weight: 400; font-style: normal; font-display: swap;
        src: local('Outfit'), local('Inter'), local('Segoe UI'), system-ui, sans-serif;
      }
    </style>
    <style id="theme-styles">
      :root, [data-theme="light"], [data-theme="skyblue"] {
          /* Light Mode */
          --bg-body: #f1f5f9;
          --bg-wrapper: transparent;
          --bg-sidebar: #ffffff;
          --bg-box: rgba(255, 255, 255, 0.88);
          --bg-nav: #ffffff;
          --text-main: #1e293b;
          --text-muted: #64748b;
          --text-bright: #0284c7;
          --primary-gradient: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
          --accent-color: #0284c7;
          --primary-rgb: 2, 132, 199;
          --border-color: rgba(226, 232, 240, 0.9);
          --border-light: rgba(241, 245, 249, 0.8);
          --shadow-main: 0 10px 25px rgba(15, 23, 42, 0.08);
          --shadow-floating: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
          --shadow-floating-hover: 0 16px 32px -4px rgba(15, 23, 42, 0.12);
          --glass-blur: blur(14px);
      }

      [data-theme="dark"], [data-theme="darkblue"] {
          /* Dark Mode */
          --bg-body: #090d16;
          --bg-wrapper: #090d16;
          --bg-sidebar: #0f172a;
          --bg-box: rgba(22, 30, 49, 0.75);
          --bg-nav: #0f172a;
          --text-main: #f1f5f9;
          --text-muted: #94a3b8;
          --text-bright: #38bdf8;
          --primary-gradient: linear-gradient(135deg, #2563eb 0%, #38bdf8 100%);
          --accent-color: #38bdf8;
          --primary-rgb: 56, 189, 248;
          --border-color: rgba(255, 255, 255, 0.09);
          --border-light: rgba(255, 255, 255, 0.05);
          --shadow-main: 0 15px 35px -5px rgba(0, 0, 0, 0.55);
          --shadow-floating: 0 15px 35px -5px rgba(0, 0, 0, 0.55), 0 0 1px 1px rgba(255, 255, 255, 0.05);
          --shadow-floating-hover: 0 20px 40px -5px rgba(0, 0, 0, 0.7);
          --glass-blur: blur(16px);
      }

      body {
          font-family: 'Outfit', sans-serif !important;
          background: var(--bg-body) !important;
          color: var(--text-main);
          transition: background 0.3s ease, color 0.3s ease;
          min-height: 100vh;
          margin: 0;
          padding: 0;
      }
      .wrapper {
          background: transparent !important;
          transition: background 0.3s ease;
      }
      .main-header {
          position: fixed !important;
          top: 0 !important;
          left: 0 !important;
          right: 0 !important;
          z-index: 1030 !important;
          background: var(--bg-nav) !important;
          border-bottom: 1px solid var(--border-color) !important;
          height: 56px !important;
          margin: 0 !important;
      }
      .main-header .navbar {
          position: relative !important;
          margin: 0 !important;
          border-radius: 0 !important;
          background: transparent !important;
          border: none !important;
          color: var(--text-bright) !important;
          box-shadow: none !important;
          min-height: 56px !important;
          height: 56px !important;
          padding: 0 20px !important;
          display: flex !important;
          align-items: center;
          justify-content: space-between;
      }
      .main-header .navbar .nav > li > a {
          color: var(--text-main) !important;
          font-weight: 500;
      }
      .main-header .navbar .nav > li > a:hover {
          color: var(--text-bright) !important;
      }
      .navbar-brand {
          color: var(--text-bright) !important;
          font-weight: 700;
          letter-spacing: 1px;
      }
      .content-wrapper {
          background-color: transparent !important;
          margin-top: 56px !important;
          padding: 30px 20px !important;
      }
      .box {
          background: var(--bg-box) !important;
          backdrop-filter: var(--glass-blur);
          -webkit-backdrop-filter: var(--glass-blur);
          border: 1px solid var(--border-color) !important;
          border-radius: 16px;
          box-shadow: var(--shadow-floating) !important;
          padding: 24px;
          color: var(--text-main);
          overflow: hidden;
          transition: transform 0.25s ease, box-shadow 0.25s ease !important;
      }
      .box:hover {
          transform: translateY(-2px);
          box-shadow: var(--shadow-floating-hover) !important;
      }
      .box-header {
          border-bottom: 1px solid var(--border-light) !important;
          color: var(--text-bright) !important;
          background: transparent !important;
      }
      
      /* Global Theme Sync Overrides */
      h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
          color: var(--text-bright) !important;
      }
      .content-header > h1 small {
          color: var(--text-muted) !important;
      }
      label {
          color: var(--text-main) !important;
      }
      .help-block {
          color: var(--text-muted) !important;
      }
      
      /* Box and Component Improvements */
      .box.box-solid.box-success > .box-header,
      .box.box-solid.box-primary > .box-header {
          background: var(--primary-gradient) !important;
          color: #ffffff !important;
          border-bottom: none !important;
          border-radius: 15px 15px 0 0 !important;
      }
      .box.box-solid {
          border: 1px solid var(--border-color) !important;
      }
      
      .box-footer {
          background-color: transparent !important;
          border-top: 1px solid var(--border-light) !important;
          color: var(--text-main);
          border-radius: 0 0 16px 16px;
      }
      
      /* Premium Table Styling & Hover Fix */
      .table { border: none !important; border-collapse: separate !important; border-spacing: 0 !important; }
      .table > thead > tr > th { 
          background: rgba(var(--primary-rgb), 0.05) !important; 
          color: var(--text-bright) !important; 
          border-bottom: 2px solid var(--border-light) !important;
          border-top: none !important;
          font-weight: 700;
          padding: 15px 10px !important;
      }
      .table > tbody > tr > td {
          border-top: 1px solid var(--border-light) !important;
          background: transparent !important;
          color: var(--text-main) !important;
          padding: 12px 10px !important;
          vertical-align: middle !important;
          transition: all 0.2s ease;
      }
      .table-bordered { border: none !important; }
      .table-bordered > thead > tr > th, .table-bordered > tbody > tr > td { border-left: none !important; border-right: none !important; }
      
      .table-hover > tbody > tr { transition: all 0.2s ease; }
      .table-hover > tbody > tr:hover > td {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          color: var(--text-bright) !important;
      }
      .dataTables_empty {
          background: transparent !important;
          color: var(--text-muted) !important;
          font-style: italic;
          padding: 20px !important;
      }
      .dataTables_wrapper .row { margin: 0 !important; }
      .pagination > li > a, .pagination > li > span {
          background-color: var(--bg-box) !important;
          border-color: var(--border-light) !important;
          color: var(--text-main) !important;
      }
      .pagination > .active > a {
          background-color: var(--accent-color) !important;
          border-color: var(--accent-color) !important;
          color: white !important;
      }
      .pagination > li > a:hover {
          background-color: rgba(var(--primary-rgb), 0.2) !important;
      }
      .callout {
          border-radius: 12px !important;
          background-color: var(--bg-box) !important;
          border: 1px solid var(--border-light) !important;
          color: var(--text-main) !important;
          box-shadow: none !important;
      }
      .callout.callout-info { border-left: 5px solid #0ea5e9 !important; }
      .callout.callout-danger { border-left: 5px solid #f43f5e !important; }
      .callout.callout-warning { border-left: 5px solid #f59e0b !important; }
      .callout.callout-success { border-left: 5px solid #10b981 !important; }
      
      .cke_chrome {
          filter: var(--theme-filter, invert(0.85) hue-rotate(180deg));
          border-radius: 12px !important;
          overflow: hidden;
          border: 1px solid rgba(0,0,0,0.2) !important;
      }
      [data-theme="light"] .cke_chrome {
          --theme-filter: none;
      }

      .btn {
          border-radius: 10px;
          font-weight: 600;
          transition: all 0.3s ease;
          border: none !important;
          letter-spacing: 0.5px;
      }
      .btn-primary {
          background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
          color: white !important;
          box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
      }
      .btn-primary:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
      }
      .btn-success {
          background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
          box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
          color: white !important;
      }
      .btn-success:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5) !important;
      }
      .form-control {
           background-color: var(--bg-body) !important;
           border: 1px solid var(--border-light) !important;
           border-radius: 10px !important;
           padding: 10px 15px !important;
           color: var(--text-bright) !important;
           box-shadow: none !important;
           height: auto !important;
           min-height: 42px !important;
           transition: all 0.3s ease;
      }
      .form-control:focus {
           border-color: var(--accent-color) !important;
           box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
      }
      
      /* Fix Native Dropdown Transparency */
      select.form-control option, select option {
           background-color: var(--bg-box) !important;
           color: var(--text-main) !important;
      }
      .main-footer {
          position: relative !important;
          margin: 40px 20px 20px !important;
          border-radius: 12px !important;
          background: var(--bg-nav) !important;
          backdrop-filter: var(--glass-blur);
          -webkit-backdrop-filter: var(--glass-blur);
          border: 1px solid var(--border-color) !important;
          padding: 12px 25px !important;
          z-index: 1030;
          display: flex;
          justify-content: space-between;
          align-items: center;
          color: var(--text-muted);
          box-shadow: var(--shadow-main) !important;
      }
      @media (max-width: 767px) {
          .main-header .navbar {
              margin: 0 !important;
              border-radius: 0 0 16px 16px !important;
              border-top: none !important;
              padding: 0 !important;
          }
          .main-header .navbar > .container {
              display: flex !important;
              align-items: center !important;
              justify-content: space-between !important;
              width: 100% !important;
              padding: 0 10px !important;
          }
          .navbar-header {
              float: none !important;
              flex: 1;
              min-width: 0;
          }
          .main-header .navbar-brand {
              font-size: 14px !important;
              padding: 10px 5px !important;
              white-space: nowrap !important;
              overflow: hidden !important;
              text-overflow: ellipsis !important;
              display: block !important;
              width: 100%;
              line-height: 30px !important;
          }
          .main-header .navbar-brand img {
              max-height: 24px !important;
              margin-right: 5px !important;
              vertical-align: middle;
          }
          .navbar-custom-menu {
              float: none !important;
              flex-shrink: 0;
          }
          .navbar-custom-menu .navbar-nav {
              margin: 0 !important;
              display: flex !important;
              flex-direction: row !important;
              align-items: center;
          }
          .navbar-custom-menu .navbar-nav > li {
              float: none !important;
          }
          .navbar-custom-menu .navbar-nav > li > a {
              padding: 10px 8px !important;
              line-height: 30px !important;
          }
          
          .main-footer {
              margin: 0 !important;
              bottom: 0 !important;
              border-radius: 16px 16px 0 0 !important;
              border-bottom: none !important;
              border-left: none !important;
              border-right: none !important;
              padding: 10px !important;
              flex-direction: column !important;
              justify-content: center !important;
              gap: 6px !important;
              text-align: center !important;
              font-size: 11px !important;
          }
          .content-wrapper {
              padding-top: 20px !important;
              padding-bottom: 20px !important;
          }
      }
      .wrapper {
          width: 100% !important;
          box-shadow: 0 0 30px rgba(0,0,0,0.5) !important;
          background-color: var(--bg-wrapper) !important;
          position: relative;
          min-height: 100vh;
      }
      
      /* Theme Switcher Styles */
      .theme-switch-btn {
          padding: 10px 15px;
          cursor: pointer;
          color: var(--text-main);
          display: flex;
          align-items: center;
          gap: 8px;
          transition: all 0.3s;
          border-radius: 8px;
      }
      .theme-switch-btn:hover { color: var(--text-bright); background: rgba(255,255,255,0.05); }
      .theme-dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }
    </style>
    <script>
      function toggleDarkMode() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          const newTheme = currentTheme === 'darkblue' ? 'skyblue' : 'darkblue';
          document.documentElement.setAttribute('data-theme', newTheme);
          localStorage.setItem('cbt-global-theme', newTheme);
          updateToggleIcons();
      }
      
      function updateToggleIcons() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          if (currentTheme !== 'darkblue') {
              $('.theme-toggle-icon').removeClass('fa-sun-o').addClass('fa-moon-o');
              $('.theme-toggle-text').text('Dark Mode');
          } else {
              $('.theme-toggle-icon').removeClass('fa-moon-o').addClass('fa-sun-o');
              $('.theme-toggle-text').text('Light Mode');
          }
      }

      $(function() {
          updateToggleIcons();
      });

      function notify_info(msg) { /* Placeholder */ }
    </script>

    </style>
  <!-- GHCBT Custom CSS Studio -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/custom_dev.css?v=<?php echo time(); ?>">
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url(); ?>" class="navbar-brand"> <b><?php echo $app_identity; ?></b></a>
            </div>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Theme Switcher -->
                <li>
                  <a href="javascript:void(0)" onclick="toggleDarkMode()" title="Toggle Dark Mode">
                    <i class="fa fa-moon-o theme-toggle-icon"></i> <span class="hidden-xs theme-toggle-text">Dark Mode</span>
                  </a>
                </li>
                <li><a href="#"><span id="timestamp"></span></a></li>

                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $foto_src; ?>" class="user-image" alt="User Image" style="width: 25px; height: 25px; border-radius: 50%; margin-right: 5px; object-fit: cover;"/>
                    <span class="hidden-xs"><?php if(!empty($nama)){ echo $nama; }else{ echo 'Siswa'; } ?></span>
                  </a>
                  <ul class="dropdown-menu" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-main); background: var(--bg-sidebar); width: 280px; padding: 0;">
                    <li class="user-header" style="background: var(--primary-gradient); padding: 25px 20px; text-align: center; color: white; height: auto;">
                      <img src="<?php echo $foto_src; ?>" class="img-circle" alt="User Image" style="width: 70px; height: 70px; border: 3px solid rgba(255,255,255,0.3); box-shadow: 0 5px 15px rgba(0,0,0,0.2); margin: 0 auto; display: block; object-fit: cover;"/>
                      <p style="margin-top: 15px; font-weight: 700; font-size: 16px; letter-spacing: 0.5px; margin-bottom: 0;">
                        <?php if(!empty($nama)){ echo $nama; }else{ echo 'Siswa'; } ?>
                        <small style="display: block; opacity: 0.9; font-weight: 500; font-size: 13px; margin-top: 5px;"><?php if(!empty($group)){ echo $group; } ?></small>
                      </p>
                    </li>
                    <li class="user-footer" style="padding: 15px; background: transparent; text-align: center;">
                      <a href="<?php echo site_url('welcome/logout'); ?>" class="btn" style="background: #f43f5e; color: white; border-radius: 10px; font-weight: 600; padding: 10px 20px; width: 100%; box-shadow: 0 4px 10px rgba(244, 63, 94, 0.3); transition: all 0.3s ease; border: none; display: flex; justify-content: center; align-items: center;"><i class="fa fa-power-off" style="margin-right: 8px;"></i> Keluar Akun</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
            <?php 
            if(!empty($content)){
                echo $content; 
            }
            ?>
      </div><!-- /.content-wrapper -->
      <!-- Modifikasi Footer Kapsul Melayang (Floating Box) -->
      <footer class="main-footer no-print">
          <div>
              &copy; <?php echo date('Y'); ?> <strong><?php if(!empty($site_name)){ echo $site_name; } else { echo base64_decode('R0hDQlQ='); } ?></strong>. Developed by <?php echo $dev_credits; ?>.
          </div>
          <div style="font-weight: 600;">
              Version <span style="background: var(--primary-gradient); color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; margin-left: 5px; box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);"><?php echo $site_version; ?></span>
          </div>
      </footer>
    </div><!-- ./wrapper -->

    <div class="modal" id="modal-proses" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div style="text-align: center;">
              <img width="50" src="<?php echo base_url(); ?>public/images/loading.gif" /> <br />Data Sedang diproses...              
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <script type="text/javascript">
    $(function () {
        var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
        var counterTime=0;
        var date;

        setInterval(function() {
          date = new Date();

          serverTime = serverTime+1;

          date.setTime(serverTime*1000);
          time = date.toLocaleTimeString();
          $("#timestamp").html(time);
        }, 1000);
    });
  </script>
  </body>
</html>
