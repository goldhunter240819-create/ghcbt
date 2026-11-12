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
    <meta content='width=device-width, initial-scale=0.9, minimum-scale=0.1, maximum-scale=10, user-scalable=yes' name='viewport'>
	<meta name="description" content="Aplikasi Ujian Online GHCBT">
	<meta name="keywords" content="Aplikasi Ujian Online GHCBT">
	<meta name="author" content="Achmad Lutfi - Gold Hunter">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    
    <!-- Plus Jakarta Sans -->
    <!-- Local Font Fallback (Offline Ready) -->
    <style>
      @font-face {
        font-family: 'Plus Jakarta Sans';
        font-weight: 400;
        font-style: normal;
        font-display: swap;
        src: local('Plus Jakarta Sans'), local('Inter'), local('Segoe UI'), system-ui, sans-serif;
      }
    </style>
    
    
    <!-- CSS Plugins (Localized) -->
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/animatecss/animate.min.css"/>
    <script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    

    <!-- Unified Theme System -->
    <style id="theme-styles">
      [data-theme="skyblue"] {
          /* Sky Blue (Light Mode) - High Contrast Fix */
          --bg-body: #f8fafc;
          --bg-wrapper: #f8fafc;
          --bg-sidebar: #ffffff;
          --bg-box: #ffffff;
          /* Fixed Header: Fully Opaque White to prevent 'tumpuk' effect */
          --bg-nav: #ffffff; 
          --text-main: #0f172a;
          --text-muted: #475569;
          --text-bright: #0284c7;
          /* Stronger Blue for better visibility in Light Mode */
          --primary-gradient: linear-gradient(135deg, #075985 0%, #0284c7 100%);
          --accent-color: #0369a1;
          --primary-rgb: 7, 89, 133;
          --border-color: #cbd5e1;
          --border-light: #e2e8f0;
          --shadow-main: 0 4px 20px rgba(0, 0, 0, 0.08);
          --glass-blur: none; /* Disable blur to keep it solid */
      }

      [data-theme="darkblue"] {
          /* Dark Blue (Dark Mode) */
          --bg-body: #020617;
          --bg-wrapper: #020617;
          --bg-sidebar: linear-gradient(180deg, rgba(15,23,42,0.95) 0%, rgba(30,58,138,0.85) 100%);
          --bg-box: #1e293b;
          --bg-nav: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(37,99,235,0.6) 100%);
          --text-main: #e2e8f0;
          --text-muted: #94a3b8;
          --text-bright: #38bdf8;
          --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
          --accent-color: #3b82f6;
          --primary-rgb: 30, 58, 138;
          --border-color: rgba(255, 255, 255, 0.08);
          --border-light: rgba(255, 255, 255, 0.04);
          --shadow-main: 0 10px 25px rgba(14, 165, 233, 0.1);
          --glass-blur: blur(8px);
          --text-contrast: #ffffff;
      }

      [data-theme="darkblue"] ::placeholder {
          color: #64748b !important;
          opacity: 0.7;
      }

      /* Global Contrast Overrides */
      [data-theme="darkblue"] label, 
      [data-theme="darkblue"] p, 
      [data-theme="darkblue"] span:not(.label), 
      [data-theme="darkblue"] td,
      [data-theme="darkblue"] .box-title,
      [data-theme="darkblue"] table.dataTable td { 
          color: #e2e8f0 !important; 
      }
      
      [data-theme="darkblue"] .table-striped > tbody > tr:nth-of-type(odd) {
          background-color: rgba(255, 255, 255, 0.03) !important;
      }
      [data-theme="darkblue"] .table-striped > tbody > tr:nth-of-type(even) {
          background-color: transparent !important;
      }

      [data-theme="darkblue"] h1, 
      [data-theme="darkblue"] h2, 
      [data-theme="darkblue"] h3, 
      [data-theme="darkblue"] .text-bright { 
          color: var(--text-bright) !important; 
      }

      [data-theme="skyblue"] label,
      [data-theme="skyblue"] p,
      [data-theme="skyblue"] span,
      [data-theme="skyblue"] td,
      [data-theme="skyblue"] h1,
      [data-theme="skyblue"] h2,
      [data-theme="skyblue"] h3,
      [data-theme="skyblue"] .box-title {
          color: #0f172a !important;
      }
      [data-theme="skyblue"] .text-muted {
          color: #475569 !important;
      }
      [data-theme="skyblue"] .navbar-brand b,
      [data-theme="skyblue"] .main-header .navbar .nav > li > a {
          color: #0369a1 !important;
      }

      body {
          font-family: 'Plus Jakarta Sans', sans-serif !important;
          background: var(--bg-body) !important;
          background-attachment: fixed !important;
          color: var(--text-main);
          transition: background 0.3s ease, color 0.3s ease;
          min-height: 100vh;
      }
      .wrapper {
          background: transparent !important;
          min-height: 100vh;
          position: relative;
      }

      /* Premium UI Components */
      .main-header .navbar {
          position: relative !important;
          margin: 10px 20px !important;
          border-radius: 12px;
          background: var(--bg-nav) !important;
          backdrop-filter: var(--glass-blur);
          -webkit-backdrop-filter: var(--glass-blur);
          border: 1px solid var(--border-color) !important;
          box-shadow: var(--shadow-main);
      }
      .navbar-brand { color: var(--text-bright) !important; font-weight: 800; }
      .main-header .navbar .nav > li > a { 
          color: var(--text-main) !important; 
          font-weight: 700; /* Bolder for better visibility */
      }

      .content-wrapper { background: transparent !important; padding-top: 20px !important; padding-bottom: 20px !important; }
      
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
              min-width: 0; /* Memaksa ellipsis bekerja di flex item */
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
      
      .box {
          background: var(--bg-box) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 20px;
          box-shadow: var(--shadow-main) !important;
          padding: 10px;
          color: var(--text-main);
          overflow: hidden;
      }
      .box-header { border-bottom: 1px solid var(--border-light) !important; color: var(--text-bright) !important; }
      .box.box-solid.box-success > .box-header,
      .box.box-solid.box-primary > .box-header {
          background: var(--primary-gradient) !important;
          color: #ffffff !important;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1);
          border-radius: 19px 19px 0 0 !important;
      }
      .box.box-solid > .box-header .box-title { color: #ffffff !important; font-weight: 700; letter-spacing: 0.5px; }
      .box-footer { background: transparent !important; border-top: 1px solid var(--border-light) !important; }
      
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
      
      /* Fix Native Dropdown Transparency */
      select.form-control option, select option {
           background-color: var(--bg-box) !important;
           color: var(--text-main) !important;
      }
      
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
      
      .opsi-checklist {
          margin: 10px 0;
          display: flex;
          align-items: center;
          padding: 15px 20px;
          border-radius: 15px;
          border: 1px solid var(--border-light);
          background: var(--bg-box);
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          cursor: pointer;
      }
      .opsi-checklist:hover {
          background: rgba(var(--primary-rgb), 0.05);
          border-color: var(--accent-color);
          transform: translateX(5px);
      }
      .opsi-checklist.active {
          background: rgba(var(--primary-rgb), 0.1);
          border-color: var(--accent-color);
          box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.15);
      }
      .opsi-checklist label { color: var(--text-main); font-weight: 500; cursor: pointer; margin:0; }
      .opsi-checklist.active label { color: var(--text-bright); font-weight: 700; }

      .btn { border-radius: 12px; font-weight: 700; border: none !important; padding: 10px 20px; transition: all 0.3s ease; }
      .btn-primary { 
          background: var(--primary-gradient) !important; 
          color: #ffffff !important; 
          box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.4); 
          text-shadow: 0 1px 2px rgba(0,0,0,0.1); /* Subtle shadow for text readability */
      }
      .btn-primary:hover, .btn-primary:focus, .btn-primary:active { 
          transform: translateY(-2px); 
          box-shadow: 0 8px 25px rgba(var(--primary-rgb), 0.5); 
          filter: brightness(1.1); 
      }
      .btn-default { background: var(--border-light) !important; color: var(--text-main) !important; }
      .btn-default:hover { background: rgba(var(--primary-rgb), 0.1) !important; }

      /* Form Inputs Theme Overrides */
      .form-control, .short-answer-input, .essay-input {
          background-color: var(--bg-box) !important;
          color: var(--text-main) !important;
          border: 1.5px solid var(--border-color) !important;
          border-radius: 12px !important;
          height: auto !important;
          padding: 10px 15px !important;
          transition: all 0.3s ease;
      }
      .form-control:focus, .short-answer-input:focus, .essay-input:focus {
          border-color: var(--accent-color) !important;
          box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.2) !important;
          outline: none;
      }
      .short-answer-input {
          font-size: 18px !important;
          font-weight: 700 !important;
          letter-spacing: 1px;
          text-align: center;
          margin-bottom: 10px;
      }
      .essay-input {
          min-height: 150px;
          resize: vertical;
      }
      
      /* SwAlert & Modal */
      .swal2-popup, .modal-content {
          background-color: var(--bg-box) !important;
          border-radius: 24px !important;
          border: 1px solid var(--border-color) !important;
          color: var(--text-main) !important;
          backdrop-filter: var(--glass-blur);
      }
      .swal2-title, .modal-title { color: var(--text-bright) !important; }

      /* Animations */
      @keyframes rotation { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
      .premium-loader {
          width: 48px; height: 48px; border-radius: 50%; display: inline-block; position: relative;
          border: 3px solid; border-color: var(--accent-color) var(--accent-color) transparent transparent;
          animation: rotation 1s linear infinite;
      }
      #isi-tes-soal img { display: block; max-width: 100%; height: auto !important; }
	  #box-informasi img { display: block; max-width: 100%; height: auto !important; }
	  #box-informasi iframe { max-width: 100%; }
    </style>

    <script>
      (function() {
          let savedTheme = localStorage.getItem('cbt-global-theme');
          if (!savedTheme || savedTheme === 'skyblue') {
              savedTheme = 'darkblue';
              localStorage.setItem('cbt-global-theme', 'darkblue');
          }
          document.documentElement.setAttribute('data-theme', savedTheme);
      })();
    </script>
    
    <!-- JS Plugins (In head for student template) -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    function notify_success(pesan){
      new PNotify({ title: 'Berhasil', text: pesan, type: 'success', history: false, delay:2000 });
    }
    function notify_info(pesan){
      new PNotify({ title: 'Informasi', text: pesan, type: 'info', history: false, delay:2000 });
    }
    function notify_error(pesan){
      new PNotify({ title: 'Error', text: pesan, type: 'error', history: false, delay:2000 });
    } 
    </script>

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
              <?php if($url == 'tes_kerjakan'){ ?>
                <a href="javascript:void(0)" class="navbar-brand" style="cursor: default;"> <img src="<?php echo base_url(); ?>public/images/logo.png?v=<?php echo time(); ?>" style="max-height: 30px; display: inline-block; margin-right: 10px;" /> <b><?php echo $app_identity; ?></b></a>
              <?php } else { ?>
                <a href="<?php echo base_url(); ?>" class="navbar-brand"> <img src="<?php echo base_url(); ?>public/images/logo.png?v=<?php echo time(); ?>" style="max-height: 30px; display: inline-block; margin-right: 10px;" /> <b><?php echo $app_identity; ?></b></a>
              <?php } ?>
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
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?php echo $foto_src; ?>" class="user-image" alt="User Image" style="width: 25px; height: 25px; border-radius: 50%; object-fit: cover; margin-right: 5px;"/>
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php if(!empty($nama)){ echo $nama; }else{ echo 'User Tes'; } ?></span>
                    </a>
                    <ul class="dropdown-menu" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-main); background: var(--bg-sidebar); width: 280px; padding: 0;">
                      <li class="user-header" style="background: var(--primary-gradient); padding: 25px 20px; text-align: center; color: white; height: auto;">
                        <img src="<?php echo $foto_src; ?>" class="img-circle" alt="User Image" style="width: 70px; height: 70px; border: 3px solid rgba(255,255,255,0.3); box-shadow: 0 5px 15px rgba(0,0,0,0.2); margin: 0 auto; display: block; object-fit: cover;"/>
                        <p style="margin-top: 15px; font-weight: 700; font-size: 16px; letter-spacing: 0.5px; margin-bottom: 0;">
                          <?php if(!empty($nama)){ echo $nama; }else{ echo 'Siswa'; } ?>
                          <small style="display: block; opacity: 0.9; font-weight: 500; font-size: 13px; margin-top: 5px;"><?php if(!empty($group)){ echo $group; } ?></small>
                        </p>
                      </li>
                      <?php if($url != 'tes_kerjakan'){ ?>
                      <li class="user-footer" style="padding: 15px; background: transparent; text-align: center;">
                        <a href="<?php echo site_url('welcome/logout'); ?>" class="btn" style="background: #f43f5e; color: white; border-radius: 10px; font-weight: 600; padding: 10px 20px; width: 100%; box-shadow: 0 4px 10px rgba(244, 63, 94, 0.3); transition: all 0.3s ease; border: none; display: flex; justify-content: center; align-items: center;"><i class="fa fa-power-off" style="margin-right: 8px;"></i> Keluar Akun</a>
                      </li>
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
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

    <div class="modal" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <?php echo form_open('tes_dashboard/password', array('id' => 'form-password'))?>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah Password</h4>
          </div>
          <div class="modal-body">
                <span id="form-pesan-password"></span>
                <div class="box-body">
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control" id="password-old" name="password-old" placeholder="Old Password">
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" id="password-new" name="password-new" placeholder="New Password">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Confirm Password">
                  </div>
                </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="password-submit">Ubah Password</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      <?php echo form_close(); ?> 
    </div><!-- /.modal -->
    
    <div class="modal fade" id="modal-proses" data-backdrop="static" data-keyboard="false" style="padding-top: 15%;">
      <div class="modal-dialog modal-sm" style="width: 300px;">
        <div class="modal-content" style="background: rgba(30, 41, 59, 0.4) !important; backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
          <div class="modal-body" style="padding: 40px 20px;">
            <div style="text-align: center;">
              <div class="premium-loader"></div>
              <p style="margin-top: 25px; color: #ffffff; font-weight: 500; font-size: 16px; letter-spacing: 0.5px;">Memproses Data...</p>
              <div class="progress-bar-loading"></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      // Zenith Screen Wake Lock Protocol
      let wakeLock = null;

      async function requestWakeLock() {
        if ('wakeLock' in navigator) {
          try {
            wakeLock = await navigator.wakeLock.request('screen');
            console.log('Zenith Wake Lock: ACTIVE');
            
            wakeLock.addEventListener('release', () => {
              console.log('Zenith Wake Lock: RELEASED');
            });
          } catch (err) {
            console.warn(`Wake Lock Error: ${err.name}, ${err.message}`);
          }
        }
      }

      // Re-request wake lock when page becomes visible again
      document.addEventListener('visibilitychange', async () => {
        if (wakeLock !== null && document.visibilityState === 'visible') {
          await requestWakeLock();
        }
      });

      function toggleDarkMode() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          const newTheme = currentTheme === 'darkblue' ? 'skyblue' : 'darkblue';
          document.documentElement.setAttribute('data-theme', newTheme);
          localStorage.setItem('cbt-global-theme', newTheme);
          updateToggleIcons();
      }

      function updateToggleIcons() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          if (currentTheme === 'darkblue') {
              $('.theme-toggle-icon').removeClass('fa-moon-o').addClass('fa-sun-o');
              $('.theme-toggle-text').text('Light Mode');
          } else {
              $('.theme-toggle-icon').removeClass('fa-sun-o').addClass('fa-moon-o');
              $('.theme-toggle-text').text('Dark Mode');
          }
      }

        $(function() {
            updateToggleIcons();
            // Activate Zenith Wake-Lock
            requestWakeLock();
        });

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

        $('#modal-password').on('shown.bs.modal', function (e) {
          $('#form-pesan-password').html('');
          $('#password-old').val('');
          $('#password-new').val('');
          $('#password-confirm').val('');
          $('#password-old').focus();
        });
        
        $('#form-password').submit(function(){        
          $.ajax({
            url:"<?php echo site_url(); ?>/tes_dashboard/password",
            type:"POST",
            data:$('#form-password').serialize(),
            cache: false,
            success:function(respon){
              var obj = $.parseJSON(respon);
              if(obj.status==1){
                $('#form-pesan-password').html('');
                $('#modal-password').modal('hide');
                notify_success('Password berhasil diubah');
              }else{
                $('#form-pesan-password').html(pesan_err(obj.error));
              }
            }
          });
          return false;
        });
    });
  </script>


    <!-- Audio Alarm Lokal (Offline Pelanggaran) - Data URI Beep Premium & Support MP3 -->
    <audio id="alarm-peringatan" preload="auto">
        <source src="<?php echo base_url(); ?>public/audio/alarm.mp3" type="audio/mpeg">
        <source src="data:audio/wav;base64,UklGRjIAAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YRAAAAAA/38A/38A/38A/38A/38A/38A/38A/38AAQ==" type="audio/wav">
    </audio>
  </body>
</html>
