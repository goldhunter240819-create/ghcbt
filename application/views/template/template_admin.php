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
    <link href="<?php echo base_url(); ?>public/plugins/custom_admin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>?v=<?php echo time(); ?>">
    
    <!-- Plus Jakarta Sans -->
    <style>
      @font-face {
        font-family: 'Plus Jakarta Sans';
        font-weight: 400; font-style: normal; font-display: swap;
        src: local('Plus Jakarta Sans'), local('Inter'), local('Segoe UI'), system-ui, sans-serif;
      }
    </style>
    <script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    
    <script>
      (function() {
          localStorage.setItem('cbt-global-theme', 'light');
          document.documentElement.setAttribute('data-theme', 'light');
      })();
    </script>







   <script>
       function drawMatchingLines(containerId) {
           const container = document.getElementById(containerId);
           if (!container) return;

           const canvas = container.querySelector('.matching-canvas');
           const ctx = canvas.getContext('2d');
           
           // Set canvas size
           canvas.width = container.offsetWidth;
           canvas.height = container.offsetHeight;

           const containerRect = container.getBoundingClientRect();
           const qItems = container.querySelectorAll('.q-item');
           const aItems = container.querySelectorAll('.a-item');

           const colors = ["#6366f1", "#10b981", "#f43f5e", "#0ea5e9", "#f59e0b", "#8b5cf6"];

           qItems.forEach((qEl, index) => {
               const matchId = qEl.getAttribute('data-match-id');
               const aEl = Array.from(aItems).find(a => a.getAttribute('data-match-id') === matchId);

               if (aEl) {
                   const qRect = qEl.getBoundingClientRect();
                   const aRect = aEl.getBoundingClientRect();

                   const x1 = qRect.right - containerRect.left;
                   const y1 = qRect.top + qRect.height / 2 - containerRect.top;

                   const x2 = aRect.left - containerRect.left;
                   const y2 = aRect.top + aRect.height / 2 - containerRect.top;

                   const distance = Math.abs(x2 - x1);
                   const curve = distance / 2.5;

                   ctx.beginPath();
                   ctx.moveTo(x1, y1);
                   ctx.bezierCurveTo(x1 + curve, y1, aRect.left - containerRect.left - curve, y2, x2, y2);

                   ctx.strokeStyle = colors[index % colors.length];
                   ctx.lineWidth = 3;
                   ctx.lineCap = "round";
                   
                   // Add subtle glow
                   ctx.shadowBlur = 4;
                   ctx.shadowColor = colors[index % colors.length] + "44";
                   
                   ctx.stroke();
                   
                   // Draw dots at ends
                   ctx.beginPath();
                   ctx.arc(x1, y1, 4, 0, Math.PI * 2);
                   ctx.arc(x2, y2, 4, 0, Math.PI * 2);
                   ctx.fillStyle = colors[index % colors.length];
                   ctx.fill();
               }
           });
       }

       window.addEventListener('resize', function() {
           document.querySelectorAll('.matching-container-wrapper').forEach(container => {
               drawMatchingLines(container.id);
           });
       });
   </script>
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>public/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>public/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <!-- summernote dimatikan
    <link href="<?php echo base_url(); ?>public/plugins/summernote/summernote.css" rel="stylesheet" type="text/css" />
    -->

    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="<?php echo base_url(); ?>public/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/animatecss/animate.min.css"/>

    <!-- select2 -->
    <link href="<?php echo base_url(); ?>public/plugins/select2-4.0.5/css/select2.min.css" rel="stylesheet" type="text/css" />

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
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>public/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>public/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>public/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	
	 <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url(); ?>public/plugins/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/demo.js" type="text/javascript"></script>
    
    <!-- summernote dimatikan
    <script src="<?php echo base_url(); ?>public/plugins/summernote/summernote.js" type="text/javascript"></script>
    -->

    <script src="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.js" type="text/javascript"></script>

    <!-- datetimerange -->
    <script src="<?php echo base_url(); ?>public/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <!-- ckeditor -->
    <script src="<?php echo base_url(); ?>public/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    
    <!-- select2 -->
    <script src="<?php echo base_url(); ?>public/plugins/select2-4.0.5/js/select2.min.js" type="text/javascript"></script>

    <!-- membuat gambar responsive pada table -->
    <style type="text/css">
      table img {
        display: block;
        max-width: 100%;
        height: auto;
      }
      /* AI Guardian Premium Status Indicator */
      @keyframes ai-pulse {
          0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
          70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
          100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
      }
      .ai-active {
          background: transparent !important;
          color: #2ecc71 !important; /* Text Green Emerald */
          animation: none !important;
          border: none !important;
          box-shadow: none !important;
      }
      .ai-active i, .ai-active span { color: #2ecc71 !important; }
      
      .ai-disabled {
          background: transparent !important;
          color: #e74c3c !important; /* Text Red Alizarin */
          border: none !important;
          box-shadow: none !important;
      }
      .ai-disabled i, .ai-disabled span { color: #e74c3c !important; }

      #ai-toggle-btn {
          padding: 8px 5px !important;
          background: transparent !important;
      }
      #ai-toggle-btn:hover {
          transform: translateY(-2px);
          filter: brightness(1.1);
      }
    </style>

    <script type="text/javascript">
		function notify_success(pesan){
			new PNotify({
				title: 'Berhasil',
				text: pesan,
				type: 'success',
				history: false,
				delay:3000
			});
		}
        
        function notify_info(pesan, silent = false){
            // Suara ditiadakan sesuai instruksi Master
			new PNotify({
				title: 'Informasi',
				text: pesan,
				type: 'info',
				history: false,
				delay:2000
			});
		}
    
		function notify_error(pesan, silent = false){
			new PNotify({
				title: 'Gagal',
				text: pesan,
				type: 'error',
				history: false,
				delay:2000
			});
		} 
  </script>
  
  <!-- Local Font Fallback (Offline Ready) -->
  <style>
      @font-face {
        font-family: 'Plus Jakarta Sans';
        font-weight: 400; font-style: normal; font-display: swap;
        src: local('Plus Jakarta Sans'), local('Inter'), local('Segoe UI'), system-ui, sans-serif;
      }
  </style>
  <style id="theme-styles">
      :root, [data-theme="light"], [data-theme="skyblue"], [data-theme="dark"], [data-theme="darkblue"], html {
          /* Luxury Gold & Obsidian Slate (GH TECH Brand Palette) */
          --bg-body: #f8fafc; /* Crisp clean modern canvas */
          --bg-wrapper: #f8fafc;
          --bg-sidebar: linear-gradient(180deg, #78350f 0%, #92400e 30%, #b45309 60%, #d97706 100%); /* Radiant Metallic Gold Gradient */
          --bg-nav: linear-gradient(90deg, #78350f 0%, #92400e 25%, #b45309 50%, #d97706 75%, #f59e0b 100%); /* Matching Gold Header */
          --bg-footer: linear-gradient(90deg, #78350f 0%, #92400e 40%, #b45309 80%, #78350f 100%); /* Matching Gold Footer */
          --sidebar-text: #fef3c7; /* Champagne Gold text */
          --sidebar-text-hover: #ffffff;
          --sidebar-hover-bg: rgba(255, 255, 255, 0.18);
          --sidebar-border: rgba(254, 243, 199, 0.25);
          --bg-box: #ffffff;
          --text-main: #0f172a;
          --text-muted: #64748b;
          --text-bright: #b45309; /* Rich Burnished Gold */
          --primary-gradient: linear-gradient(135deg, #b45309 0%, #d97706 50%, #f59e0b 100%);
          --accent-color: #f59e0b; /* Vibrant Gold Accent */
          --primary-rgb: 217, 119, 6;
          --border-color: #cbd5e1;
          --border-light: #e2e8f0;
          --shadow-main: 0 10px 25px -4px rgba(217, 119, 6, 0.18);
          --shadow-floating: 0 10px 25px -4px rgba(15, 23, 42, 0.08), 0 4px 8px -2px rgba(15, 23, 42, 0.04);
          --shadow-floating-hover: 0 16px 32px -4px rgba(217, 119, 6, 0.25), 0 8px 12px -3px rgba(15, 23, 42, 0.06);
          --glass-blur: blur(14px);
          --glass-bg: #ffffff;
          --table-hover: rgba(245, 158, 11, 0.08);
          --card-header-bg: #fffbeb;
      }

      body {
          font-family: 'Plus Jakarta Sans', sans-serif !important;
          background: var(--bg-body) !important;
          color: var(--text-main);
          transition: background 0.3s ease, color 0.3s ease;
          min-height: 100vh;
          margin: 0;
          padding: 0;
      }
      .wrapper {
          background: transparent !important;
          min-height: 100vh;
          position: relative;
      }

      /* Content Wrapper (Symmetrical Modern Canvas) */
      .content-wrapper {
          margin-left: 230px !important;
          margin-right: 0 !important;
          margin-top: 56px !important;
          background: var(--bg-body) !important;
          padding: 24px 24px 30px 24px !important; 
          min-height: calc(100vh - 56px - 53px) !important;
          transition: margin-left 0.3s ease-in-out;
          box-sizing: border-box !important;
      }
      .content {
          padding: 0 !important;
          margin: 0 !important;
      }
      /* Symmetrical Grid Spacing */
      .content .row,
      .content-wrapper > .row {
          margin-left: -10px !important;
          margin-right: -10px !important;
      }
      .content .row > [class*="col-"],
      .content-wrapper > .row > [class*="col-"] {
          padding-left: 10px !important;
          padding-right: 10px !important;
      }

      /* Main Header: Docked, Symmetrical 24px Horizontal Padding */
      .main-header {
          position: fixed !important;
          top: 0 !important;
          left: 230px !important;
          right: 0 !important;
          height: 56px !important;
          z-index: 1030 !important;
          background: var(--bg-nav) !important;
          border-bottom: 1px solid var(--sidebar-border) !important;
          margin: 0 !important;
          padding: 0 !important;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12) !important;
          transition: left 0.3s ease-in-out;
      }
      .main-header .navbar {
          position: relative !important;
          margin: 0 !important;
          padding: 0 24px !important;
          border-radius: 0 !important;
          background: transparent !important;
          border: none !important;
          color: #ffffff !important;
          box-shadow: none !important;
          min-height: 56px !important;
          height: 56px !important;
          display: flex !important;
          align-items: center;
          justify-content: space-between;
      }
      .main-header .sidebar-toggle {
          float: left;
          padding: 17px 18px 17px 0;
          color: #ffffff !important;
          font-size: 16px;
          background: transparent;
          transition: color 0.2s, background 0.2s;
      }
      .main-header .sidebar-toggle:hover {
          color: #fde047 !important;
      }
      .main-header .navbar-custom-menu .nav > li > a {
          color: #e2e8f0 !important;
          font-weight: 600;
          transition: all 0.25s ease;
      }
      .main-header .navbar-custom-menu .nav > li > a:hover {
          color: #ffffff !important;
          background: rgba(255, 255, 255, 0.1) !important;
          border-radius: 10px;
      }
      .main-header .admin-identity-pill-static span {
          background: rgba(255, 255, 255, 0.1) !important;
          border: 1px solid rgba(255, 255, 255, 0.18) !important;
          border-radius: 12px;
          margin: 5px 8px;
          padding: 8px 15px;
          display: inline-block;
          font-weight: 700;
          color: #ffffff !important;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      }
      .main-header .logo {
          display: none !important;
      }

      /* Main Footer: Docked, Symmetrical 24px Horizontal Padding */
      .main-footer {
          position: relative !important;
          margin-left: 230px !important;
          margin-right: 0 !important;
          margin-top: 0 !important;
          margin-bottom: 0 !important;
          border-radius: 0 !important;
          border-left: none !important;
          border-right: none !important;
          border-bottom: none !important;
          border-top: 1px solid var(--sidebar-border) !important;
          background: var(--bg-footer) !important;
          padding: 16px 24px !important;
          z-index: 1020;
          display: flex;
          justify-content: space-between;
          align-items: center;
          color: #cbd5e1 !important;
          box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08) !important;
          transition: margin-left 0.3s ease-in-out;
      }
      .main-footer strong {
          color: #ffffff !important;
      }

      /* Main Sidebar: Docked, Tidak Melayang */
      .main-sidebar {
          position: fixed !important;
          top: 0 !important;
          left: 0 !important;
          bottom: 0 !important;
          height: 100vh !important;
          min-height: 100vh !important;
          background: var(--bg-sidebar) !important;
          border-right: 1px solid var(--sidebar-border) !important;
          border-left: none !important;
          border-top: none !important;
          border-bottom: none !important;
          border-radius: 0 !important;
          padding: 0 !important;
          margin: 0 !important;
          z-index: 1040 !important;
          width: 230px !important;
          box-shadow: 4px 0 20px rgba(0, 0, 0, 0.12) !important;
          transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
      }
      .sidebar {
          background: transparent !important;
          border-radius: 0 !important;
          height: 100% !important; 
          max-height: 100% !important;
          min-height: 100% !important;
          box-shadow: none !important;
          border: none !important;
          overflow-y: auto;
          overflow-x: hidden;
          scrollbar-width: none;
          -ms-overflow-style: none;
          padding: 0 8px 20px 8px !important;
          margin: 0;
          display: flex;
          flex-direction: column;
      }

      /* Sidebar Collapse Adjustments */
      .sidebar-collapse .main-sidebar {
          width: 50px !important;
      }
      .sidebar-collapse .main-header {
          left: 50px !important;
      }
      .sidebar-collapse .content-wrapper,
      .sidebar-collapse .main-footer {
          margin-left: 50px !important;
      }

      @media (max-width: 767px) {
          .main-sidebar {
              transform: translate(-230px, 0);
          }
          .sidebar-open .main-sidebar {
              transform: translate(0, 0);
          }
          .main-header {
              left: 0 !important;
          }
          .content-wrapper, .main-footer {
              margin-left: 0 !important;
              padding: 15px !important;
          }
          .content-header {
              padding: 20px 18px !important;
              flex-direction: column !important;
              align-items: flex-start !important;
          }
      }
      .sidebar::-webkit-scrollbar {
          display: none !important;
      }
      .sidebar-menu {
          padding-top: 8px;
      }
      .sidebar-menu > li > a {
          color: var(--sidebar-text) !important;
          font-size: 13px;
          font-weight: 600;
          transition: all 0.25s ease;
          border-radius: 10px;
          margin: 4px 8px;
          padding: 10px 14px;
          display: flex;
          align-items: center;
          gap: 10px;
      }
      .sidebar-menu > li > a > i {
          color: #fde047 !important;
          font-size: 16px;
          width: 20px;
          text-align: center;
          flex-shrink: 0;
          transition: all 0.25s ease;
      }
      .sidebar-menu > li:hover > a {
          background-color: var(--sidebar-hover-bg) !important;
          color: var(--sidebar-text-hover) !important;
          box-shadow: 0 4px 12px rgba(0,0,0,0.15);
          transform: translateX(4px);
      }
      .sidebar-menu > li:hover > a > i {
          transform: scale(1.15);
          color: #ffffff !important;
      }
      /* Hide scrollbar for Chrome, Safari and Opera */
      .sidebar::-webkit-scrollbar {
          display: none !important;
      }
      .sidebar-menu > li.active > a {
          background: linear-gradient(135deg, rgba(254, 243, 199, 0.28) 0%, rgba(245, 158, 11, 0.25) 100%) !important;
          border: 1px solid rgba(251, 191, 36, 0.45) !important;
          color: #ffffff !important;
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
          transform: translateY(-1px);
      }
      /* Developer Specific overrides are handled in the developer-block above */
      .sidebar-menu > li.active > a > i {
          color: #fef08a !important;
      }

      /* Fix Table Hover - Never blind white */
      .table-hover > tbody > tr:hover,
      .table-hover > tbody > tr:hover > td,
      .table-hover > tbody > tr:hover > th,
      .table > tbody > tr:hover,
      .table > tbody > tr:hover > td,
      #table-monitor > tbody > tr:hover,
      #table-monitor > tbody > tr:hover > td {
          background-color: rgba(245, 158, 11, 0.08) !important;
          color: var(--text-main) !important;
      }

      /* Symmetrical Equal Height Rows (Overrides Bootstrap 3 floats and pseudo-elements) */
      .row-flex-eq {
          display: flex !important;
          flex-wrap: wrap !important;
          align-items: stretch !important;
      }
      .row-flex-eq:before,
      .row-flex-eq:after {
          display: none !important;
          content: none !important;
      }
      .row-flex-eq > [class*="col-"] {
          display: flex !important;
          flex-direction: column !important;
          float: none !important;
      }
      .row-flex-eq > [class*="col-"] > .box {
          display: flex !important;
          flex-direction: column !important;
          flex: 1 1 100% !important;
          height: 100% !important;
          margin-bottom: 0 !important;
      }
      .sidebar-menu .treeview-menu {
          background-color: rgba(0, 0, 0, 0.18) !important;
          border-radius: 12px !important;
          margin: 4px 8px 8px 8px !important;
          padding: 6px 4px !important;
          border: 1px solid rgba(254, 243, 199, 0.15) !important;
      }
      .sidebar-menu .treeview-menu > li > a {
          color: var(--sidebar-text) !important;
          font-size: 12.5px !important;
          font-weight: 600 !important;
          padding: 8px 12px !important;
          margin: 2px 4px !important;
          border-radius: 8px !important;
          display: flex !important;
          align-items: center !important;
          gap: 10px !important;
          transition: all 0.2s ease !important;
      }
      .sidebar-menu .treeview-menu > li > a > i {
          color: #fde047 !important;
          font-size: 14px !important;
          width: 18px !important;
          text-align: center !important;
          flex-shrink: 0 !important;
          transition: all 0.2s ease !important;
      }
      .sidebar-menu .treeview-menu > li:hover > a {
          background-color: rgba(255, 255, 255, 0.15) !important;
          color: #ffffff !important;
          transform: translateX(3px) !important;
      }
      .sidebar-menu .treeview-menu > li:hover > a > i {
          transform: scale(1.15) !important;
          color: #ffffff !important;
      }
      .sidebar-menu .treeview-menu > li.active > a {
          background: linear-gradient(135deg, rgba(254, 243, 199, 0.3) 0%, rgba(245, 158, 11, 0.32) 100%) !important;
          border: 1px solid rgba(251, 191, 36, 0.5) !important;
          color: #ffffff !important;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.18) !important;
          font-weight: 700 !important;
          transform: none !important;
      }
      .sidebar-menu .treeview-menu > li.active > a > i {
          color: #fef08a !important;
          transform: scale(1.1) !important;
      }
      .box {
          background: var(--glass-bg) !important;
          backdrop-filter: var(--glass-blur);
          -webkit-backdrop-filter: var(--glass-blur);
          border: 1px solid var(--border-color) !important;
          border-radius: 16px;
          box-shadow: var(--shadow-floating) !important;
          padding: 20px;
          color: var(--text-main);
          transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
          overflow: hidden;
          margin-bottom: 24px;
      }
      .box:hover {
          transform: translateY(-2px);
          box-shadow: var(--shadow-floating-hover) !important;
      }
      /* Pengecualian agar CKEditor Maximize tidak terjebak di dalam kotak */
      .box:has(.cke_maximized) {
          backdrop-filter: none !important;
          -webkit-backdrop-filter: none !important;
          transform: none !important;
          transition: none !important;
          overflow: visible !important;
          z-index: 9999 !important;
      }
      .cke_maximized {
          z-index: 99999 !important;
      }
      .box-header {
          border-bottom: 1px solid var(--border-light) !important;
          color: var(--text-bright) !important;
          background: rgba(var(--primary-rgb), 0.02) !important;
          border-radius: 19px 19px 0 0 !important;
          position: relative !important;
          padding: 16px 22px !important;
          display: flex !important;
          justify-content: space-between !important;
          align-items: center !important;
          flex-wrap: wrap !important;
          gap: 12px !important;
          min-height: 58px !important;
      }
      .box-header:before,
      .box-header:after {
          display: none !important;
          content: none !important;
      }
      .box-header > .box-tools,
      .box-header .box-tools {
          position: static !important;
          float: none !important;
          top: auto !important;
          right: auto !important;
          margin: 0 !important;
          display: flex !important;
          align-items: center !important;
          gap: 10px !important;
          flex-wrap: wrap !important;
      }
      .box-header > .box-title,
      .box-header .box-title {
          margin: 0 !important;
          font-size: 18px !important;
          font-weight: 700 !important;
          color: var(--text-bright) !important;
          display: inline-flex !important;
          align-items: center !important;
          gap: 8px !important;
          line-height: normal !important;
          float: none !important;
      }
      /* Premium Page Header Banner (Applied across all submodules) */
      .content-header {
          background: linear-gradient(135deg, #78350f 0%, #92400e 25%, #b45309 50%, #d97706 75%, #f59e0b 100%) !important;
          border-radius: 20px !important;
          padding: 28px 32px !important;
          color: #ffffff !important;
          box-shadow: 0 12px 30px -5px rgba(180, 83, 9, 0.3) !important;
          margin: 0 0 24px 0 !important;
          position: relative !important;
          overflow: hidden !important;
          border: 1px solid rgba(254, 243, 199, 0.25) !important;
          display: flex !important;
          justify-content: space-between !important;
          align-items: center !important;
          flex-wrap: wrap !important;
          gap: 16px !important;
      }
      .content-header::before {
          content: '';
          position: absolute;
          right: -50px;
          top: -50px;
          width: 220px;
          height: 220px;
          background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
          border-radius: 50%;
          pointer-events: none;
      }
      .content-header::after {
          content: '';
          position: absolute;
          left: 25%;
          bottom: -60px;
          width: 160px;
          height: 160px;
          background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
          border-radius: 50%;
          pointer-events: none;
      }
      .content-header > h1 {
          margin: 0 !important;
          font-size: 24px !important;
          font-weight: 800 !important;
          color: #ffffff !important;
          letter-spacing: -0.3px !important;
          position: relative !important;
          z-index: 2 !important;
          display: flex !important;
          flex-direction: column !important;
          gap: 6px !important;
          text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
          line-height: 1.3 !important;
      }
      .content-header > h1 small {
          font-size: 13.5px !important;
          font-weight: 500 !important;
          color: rgba(254, 243, 199, 0.95) !important;
          letter-spacing: 0.1px !important;
          line-height: 1.5 !important;
          display: block !important;
          margin-top: 4px !important;
          max-width: 750px !important;
          text-shadow: none !important;
      }
      .content-header > .breadcrumb {
          position: relative !important;
          top: auto !important;
          right: auto !important;
          float: none !important;
          margin: 0 !important;
          padding: 8px 18px !important;
          background: rgba(0, 0, 0, 0.22) !important;
          backdrop-filter: blur(10px) !important;
          -webkit-backdrop-filter: blur(10px) !important;
          border-radius: 12px !important;
          border: 1px solid rgba(254, 243, 199, 0.3) !important;
          z-index: 2 !important;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
      }
      .content-header > .breadcrumb > li {
          color: rgba(254, 243, 199, 0.85) !important;
          font-size: 12.5px !important;
          font-weight: 600 !important;
          display: inline-flex !important;
          align-items: center !important;
      }
      .content-header > .breadcrumb > li + li:before {
          color: rgba(254, 243, 199, 0.6) !important;
          content: "\f105" !important;
          font-family: 'FontAwesome' !important;
          padding: 0 8px !important;
      }
      .content-header > .breadcrumb > li > a {
          color: #ffffff !important;
          transition: color 0.2s ease !important;
          text-decoration: none !important;
      }
      .content-header > .breadcrumb > li > a:hover {
          color: #fef08a !important;
      }
      .content-header > .breadcrumb > .active {
          color: #fef08a !important;
          font-weight: 700 !important;
      }
      label {
          color: var(--text-main) !important;
      }
      .help-block {
          color: var(--text-muted) !important;
      }
      
      /* Premium Button Styles */
      .btn-smart-import {
          background: var(--primary-gradient) !important;
          color: #ffffff !important;
          border: none;
          border-radius: 8px;
          font-weight: 600;
          padding: 6px 15px;
          box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          display: inline-flex;
          align-items: center;
          gap: 6px;
      }
      .btn-smart-import:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 15px rgba(var(--primary-rgb), 0.4);
          filter: brightness(1.1);
      }
      
      /* Box and Component Improvements */
      .box.box-solid.box-success > .box-header {
          background: var(--primary-gradient) !important;
          color: #ffffff !important;
          border-bottom: none !important;
          border-radius: 19px 19px 0 0 !important;
      }
      .box.box-solid.box-info > .box-header {
          background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%) !important;
          color: #ffffff !important;
          border-radius: 19px 19px 0 0 !important;
      }
      .box.box-solid {
          border: 1px solid var(--border-color) !important;
      }
      
      .box-footer {
          background-color: transparent !important;
          border-top: 1px solid var(--border-light) !important;
          color: var(--text-main);
          border-radius: 0 0 20px 20px !important;
      }
      
      /* Premium Table Styling & Hover Fix */
      .table { border: none !important; border-collapse: separate !important; border-spacing: 0 4px !important; width: 100% !important; }
      .table > thead > tr > th { 
          background: rgba(var(--primary-rgb), 0.08) !important; 
          color: var(--text-bright) !important; 
          border: none !important;
          border-radius: 10px;
          font-weight: 700;
          padding: 15px 18px !important;
          text-transform: uppercase;
          font-size: 11px;
          letter-spacing: 1px;
      }
      
      [data-theme="skyblue"] .table > thead > tr > th {
          background: #f8fafc !important;
          border-bottom: 2px solid #e2e8f0 !important;
      }
      .table > tbody > tr {
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          border-radius: 12px;
      }
      .table > tbody > tr > td {
          border: none !important;
          background: rgba(var(--primary-rgb), 0.02) !important;
          color: var(--text-main) !important;
          padding: 15px 18px !important;
          vertical-align: middle !important;
          transition: all 0.3s ease;
      }
      .table > tbody > tr > td:first-child { border-radius: 12px 0 0 12px; }
      .table > tbody > tr > td:last-child { border-radius: 0 12px 12px 0; }
      
      .table-hover > tbody > tr:hover > td {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          color: var(--text-bright) !important;
          transform: scale(1.002);
      }
      .table-hover > tbody > tr:hover {
          box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
          z-index: 10;
          position: relative;
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
          border-radius: 16px !important;
          border-left-width: 6px !important;
          background: rgba(var(--primary-rgb), 0.05) !important;
          backdrop-filter: blur(5px);
          border: 1px solid var(--border-color);
          box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      }
      .callout.callout-info { border-left-color: var(--accent-color) !important; }
      .callout.callout-warning { border-left-color: #f59e0b !important; }
      .callout.callout-danger { border-left-color: #f43f5e !important; }

      /* Zenith Force Dark Elements (Anti-White Cleanup) */
      select, input[type="text"], input[type="password"], input[type="email"], textarea {
          background-color: var(--bg-body) !important;
          border: 1px solid var(--border-color) !important;
          color: var(--text-main) !important;
          border-radius: 10px !important;
          transition: all 0.3s ease;
      }
      
      [data-theme="darkblue"] select, 
      [data-theme="darkblue"] input[type="text"], 
      [data-theme="darkblue"] input[type="password"], 
      [data-theme="darkblue"] input[type="email"], 
      [data-theme="darkblue"] textarea {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          color: var(--text-bright) !important;
          border-color: var(--border-color) !important;
      }
      
      /* Select2 Elite Zenith Styling */
      .select2-container--default .select2-selection--single, 
      .select2-container--default .select2-selection--multiple {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 12px !important;
          height: 42px !important;
          display: flex !important;
          align-items: center !important;
          transition: all 0.3s ease;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: var(--text-bright) !important;
          line-height: 42px !important;
          padding-left: 15px !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 40px !important;
      }
      .select2-dropdown {
          background-color: var(--bg-box) !important;
          backdrop-filter: blur(20px) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 16px !important;
          box-shadow: var(--shadow-main) !important;
          overflow: hidden;
          margin-top: 5px;
      }
      .select2-results__option { color: var(--text-main) !important; padding: 10px 15px !important; }
      .select2-results__option--highlighted[aria-selected] {
          background-color: var(--accent-color) !important;
          color: white !important;
      }
      .select2-search__field {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 8px !important;
          color: var(--text-bright) !important;
      }

      /* DataTables Search Input Lock */
      .dataTables_filter input {
          background: rgba(var(--primary-rgb), 0.05) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 20px !important;
          padding: 6px 15px !important;
          color: var(--text-bright) !important;
          outline: none !important;
      }
      
      /* Modern Post-Cleanup Tab Enhancements */
      .nav-tabs-custom {
          background: transparent !important;
          box-shadow: none !important;
          border: none !important;
      }
      .nav-tabs-custom > .nav-tabs {
          background: var(--bg-body) !important;
          border-radius: 16px !important;
          padding: 5px !important;
          margin-bottom: 20px !important;
          border: 1px solid var(--border-color) !important;
          display: inline-flex !important;
      }
      
      [data-theme="darkblue"] .nav-tabs-custom > .nav-tabs {
          background: rgba(var(--primary-rgb), 0.05) !important;
      }
      
      .nav-tabs-custom > .nav-tabs > li { margin-right: 5px !important; border: none !important; }
      .nav-tabs-custom > .nav-tabs > li > a {
          border-radius: 12px !important;
          border: none !important;
          color: var(--text-muted) !important;
          font-weight: 700 !important;
          padding: 8px 20px !important;
          transition: all 0.3s ease;
      }
      .nav-tabs-custom > .nav-tabs > li.active > a {
          background: var(--primary-gradient) !important;
          color: white !important;
          box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3) !important;
      }
      .nav-tabs-custom > .tab-content { background: transparent !important; padding: 0 !important; }
      .callout.callout-info { border-left: 5px solid #0ea5e9 !important; }
      .callout.callout-danger { border-left: 5px solid #f43f5e !important; }
      .callout.callout-warning { border-left: 5px solid #f59e0b !important; }
      .callout.callout-success { border-left: 5px solid #10b981 !important; }
      
      /* Content consistency fix */
      table.dataTable tbody td * {
          background-color: transparent !important;
          color: inherit !important;
      }
      table.dataTable tbody td img {
          background-color: #fff !important;
          border-radius: 8px;
          padding: 5px;
          display: inline-block !important; /* Fix for center display override */
      }

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
          background: linear-gradient(135deg, #b45309 0%, #d97706 50%, #f59e0b 100%) !important;
          color: white !important;
          box-shadow: 0 4px 15px rgba(217, 119, 6, 0.35);
      }
      .btn-primary:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 20px rgba(217, 119, 6, 0.5);
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
      .btn-default {
          background: var(--border-light) !important;
          color: var(--text-main) !important;
      }
      .btn-default:hover {
          background: var(--border-color) !important;
          color: var(--text-bright) !important;
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
           box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.2) !important;
      }
      
      /* Fix Native Dropdown Transparency */
      select.form-control option, select option {
           background-color: var(--bg-box) !important;
           color: var(--text-main) !important;
      }
      
      /* Select2 Theme Overrides */
      .select2-container--default .select2-selection--single,
      .select2-container--default .select2-selection--multiple {
          background-color: var(--bg-box) !important;
          border: 1px solid var(--border-light) !important;
          border-radius: 10px !important;
          min-height: 42px !important;
          box-shadow: none !important;
          transition: all 0.3s ease;
      }
      .select2-container--default .select2-selection--single {
          display: flex;
          align-items: center;
      }
      .select2-container--default .select2-selection--multiple .select2-selection__choice {
          background-color: rgba(var(--primary-rgb), 0.1) !important;
          border: 1px solid var(--border-color) !important;
          color: var(--text-bright) !important;
          border-radius: 8px !important;
          margin-top: 6px !important;
          padding: 4px 8px !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: var(--text-bright) !important;
          padding-left: 15px !important;
          line-height: normal !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 40px !important;
          right: 10px !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow b {
          border-color: var(--text-muted) transparent transparent transparent !important;
      }
      .select2-dropdown {
          background: var(--bg-box) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 12px !important;
          box-shadow: 0 10px 30px rgba(0,0,0,0.6) !important;
          overflow: hidden;
          z-index: 1060; /* Higher than modal */
      }
      .select2-search--dropdown .select2-search__field {
          background-color: rgba(var(--primary-rgb), 0.05) !important;
          border: 1px solid var(--border-light) !important;
          color: var(--text-bright) !important;
          border-radius: 8px !important;
          padding: 8px 12px !important;
          margin-bottom: 5px !important;
          width: calc(100% - 10px) !important;
          margin-left: 5px !important;
      }
      .select2-results__option {
          padding: 8px 15px !important;
          color: var(--text-main) !important;
          transition: all 0.2s;
      }
      .select2-container--default .select2-results__option--highlighted[aria-selected] {
          background: var(--primary-gradient) !important;
          color: #ffffff !important;
      }
      .select2-container--default .select2-results__option[aria-selected=true] {
          background-color: rgba(var(--primary-rgb), 0.2) !important;
          color: var(--text-bright) !important;
      }
      .select2-container--default .select2-search--dropdown .select2-search__field {
          outline: none !important;
      }
      table.dataTable {
          border-collapse: separate !important;
          border-spacing: 0 !important;
          border-radius: 12px;
          overflow: hidden;
          width: 100% !important;
          color: var(--text-main);
      }
      table.dataTable thead th {
          background-color: var(--bg-body) !important;
          border-bottom: 1px solid var(--border-light) !important;
          color: var(--text-muted) !important;
          font-weight: 600;
          text-transform: uppercase;
          font-size: 12px;
          letter-spacing: 0.5px;
          padding: 15px !important;
      }
      table.dataTable tbody td {
          border-top: 1px solid var(--border-color) !important;
          padding: 10px !important;
          color: var(--text-main);
          vertical-align: middle !important;
      }
      table.dataTable tbody tr {
          background-color: transparent !important;
      }
      table.dataTable tbody tr:hover {
          background-color: rgba(255, 255, 255, 0.03) !important;
      }
      [data-theme="light"] table.dataTable tbody tr:hover {
          background-color: rgba(0, 0, 0, 0.02) !important;
      }
      .info-box {
          background: var(--bg-box) !important;
          backdrop-filter: var(--glass-blur);
          border: 1px solid var(--border-color);
          border-radius: 16px;
          box-shadow: var(--shadow-main) !important;
          overflow: hidden;
      }
      .info-box-icon {
          border-radius: 16px 0 0 16px !important;
          background: var(--primary-gradient) !important;
          color: white !important;
      }
      .modal-content {
          background-color: var(--bg-box) !important;
          backdrop-filter: blur(20px) !important;
          -webkit-backdrop-filter: blur(20px) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 20px !important;
          color: var(--text-main) !important;
          box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
          overflow: hidden;
      }
      .modal-header {
          border-bottom: 1px solid var(--border-light) !important;
          padding: 20px 25px !important;
      }
      .modal-header .modal-title {
          font-weight: 700 !important;
          color: var(--text-bright) !important;
          display: flex;
          align-items: center;
          gap: 10px;
      }
      .modal-body {
          padding: 25px !important;
          color: var(--text-main) !important;
      }
      .modal-footer {
          border-top: 1px solid var(--border-light) !important;
          padding: 15px 25px !important;
          background: rgba(var(--primary-rgb), 0.02);
      }
      .modal-backdrop.in {
          opacity: 0.7 !important;
          backdrop-filter: blur(4px);
      }
      .pagination>li>a, .pagination>li>span {
          background-color: var(--bg-body) !important;
          border: 1px solid var(--border-light) !important;
          color: var(--text-muted) !important;
      }
      .pagination>li.active>a, .pagination>li.active>span {
          background: var(--primary-gradient) !important;
          color: #fff !important;
          border-color: transparent !important;
      }
      
      /* Theme Switcher Styles */
      .theme-switch-btn {
          padding: 15px 20px;
          cursor: pointer;
          color: var(--text-main);
          display: flex;
          align-items: center;
          gap: 8px;
          transition: all 0.3s;
      }
      .theme-switch-btn:hover { color: var(--text-bright); background: rgba(255,255,255,0.05); }
      .theme-dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }
      
      /* Premium Skinning for External Plugins (Dark Mode) */
      [data-theme="darkblue"] .daterangepicker, 
      [data-theme="darkblue"] .daterangepicker .calendar-date,
      [data-theme="darkblue"] .datepicker,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget {
          background-color: rgba(15, 23, 42, 0.9) !important;
          backdrop-filter: blur(20px) !important;
          -webkit-backdrop-filter: blur(20px) !important;
          border: 1px solid rgba(255, 255, 255, 0.1) !important;
          color: var(--text-main) !important;
          box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4) !important;
          border-radius: 16px !important;
          padding: 10px !important;
      }
      
      [data-theme="darkblue"] .daterangepicker .calendar-table,
      [data-theme="darkblue"] .datepicker table,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget table {
          background-color: transparent !important;
      }

      /* Fix daterangepicker arrows */
      [data-theme="darkblue"] .daterangepicker.opensright:after,
      [data-theme="darkblue"] .daterangepicker.openscenter:after,
      [data-theme="darkblue"] .daterangepicker.opensleft:after {
          border-bottom-color: rgba(15, 23, 42, 0.9) !important;
      }
      [data-theme="darkblue"] .daterangepicker.dropup:after {
          border-top-color: rgba(15, 23, 42, 0.9) !important;
      }

      [data-theme="darkblue"] .daterangepicker td.off, 
      [data-theme="darkblue"] .daterangepicker td.off.in-range,
      [data-theme="darkblue"] .datepicker table tr td.old,
      [data-theme="darkblue"] .datepicker table tr td.new {
          color: var(--text-muted) !important;
          opacity: 0.3;
      }

      [data-theme="darkblue"] .daterangepicker td.available:hover,
      [data-theme="darkblue"] .datepicker table tr td.day:hover,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget td span:hover {
          background-color: rgba(var(--primary-rgb), 0.2) !important;
          color: var(--text-bright) !important;
          border-radius: 8px !important;
      }

      [data-theme="darkblue"] .daterangepicker td.active, 
      [data-theme="darkblue"] .daterangepicker td.active:hover,
      [data-theme="darkblue"] .datepicker table tr td.active,
      [data-theme="darkblue"] .datepicker table tr td.active:hover,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget td.active {
          background: var(--primary-gradient) !important;
          color: #fff !important;
          border-radius: 8px !important;
          box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.4) !important;
      }

      [data-theme="darkblue"] .daterangepicker .calendar-table td,
      [data-theme="darkblue"] .daterangepicker .calendar-table th,
      [data-theme="darkblue"] .datepicker table tr td,
      [data-theme="darkblue"] .datepicker table tr th,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget table td,
      [data-theme="darkblue"] .bootstrap-datetimepicker-widget table th {
          color: var(--text-main) !important;
          border: none !important;
      }

      [data-theme="darkblue"] .daterangepicker .drp-buttons {
          border-top: 1px solid var(--border-light) !important;
          padding-top: 10px !important;
      }

      [data-theme="darkblue"] .daterangepicker .drp-selected {
          color: var(--text-muted) !important;
      }

      [data-theme="darkblue"] .daterangepicker .input-mini,
      [data-theme="darkblue"] .daterangepicker select,
      [data-theme="darkblue"] .daterangepicker .ranges li {
          background-color: rgba(255,255,255,0.05) !important;
          border: 1px solid var(--border-light) !important;
          color: var(--text-main) !important;
          border-radius: 8px !important;
      }

      /* Fix Table Headers in Dark Mode */
      [data-theme="darkblue"] thead th {
          background: rgba(var(--primary-rgb), 0.15) !important;
          color: var(--text-bright) !important;
          border-bottom: 2px solid var(--accent-color) !important;
      }

      /* Fix Select and Input Backgrounds */
      [data-theme="darkblue"] .form-control,
      [data-theme="darkblue"] select {
          background-color: rgba(15, 23, 42, 0.6) !important;
      }

      /* DataTables UI Overlap Fixes */

      table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child,
      table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child {
          padding-left: 48px !important;
          position: relative;
      }
      table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before,
      table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
          top: 50% !important;
          transform: translateY(-50%) !important;
          left: 12px !important;
          background-color: #10b981 !important;
          border: 2px solid #fff !important;
          box-shadow: 0 4px 10px rgba(0,0,0,0.2) !important;
      }
      table.dataTable thead th.sorting,
      table.dataTable thead th.sorting_asc,
      table.dataTable thead th.sorting_desc {
          padding-right: 35px !important;
      }
      table.dataTable thead th:first-child,
      table.dataTable tbody td:first-child {
          min-width: 65px !important;
          text-align: center !important;
      }
      /* Ensure search box and labels are clean */
      .dataTables_filter input {
          margin-bottom: 10px;
      }

      /* Premium Loading Styles */
      .premium-loader {
          width: 48px;
          height: 48px;
          border-radius: 50%;
          display: inline-block;
          position: relative;
          border: 3px solid;
          border-color: #6366f1 #6366f1 transparent transparent;
          box-sizing: border-box;
          animation: rotation 1s linear infinite;
      }
      .premium-loader::after,
      .premium-loader::before {
          content: '';  
          box-sizing: border-box;
          position: absolute;
          left: 0;
          right: 0;
          top: 0;
          bottom: 0;
          margin: auto;
          border: 3px solid;
          border-color: transparent transparent #a855f7 #a855f7;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          box-sizing: border-box;
          animation: rotationBack 0.5s linear infinite;
          transform-origin: center center;
      }
      .premium-loader::before {
          width: 32px;
          height: 32px;
          border-color: #f43f5e #f43f5e transparent transparent;
          animation: rotation 1.5s linear infinite;
      }
          
      @keyframes rotation {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      } 
      @keyframes rotationBack {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(-360deg); }
      }

      .progress-bar-loading {
          width: 100px;
          height: 3px;
          background: rgba(255,255,255,0.1);
          border-radius: 10px;
          margin: 15px auto 0;
          position: relative;
          overflow: hidden;
      }
      .progress-bar-loading::after {
          content: '';
          width: 40px;
          height: 3px;
          background: linear-gradient(90deg, #6366f1, #a855f7, #f43f5e);
          position: absolute;
          top: 0;
          left: -40px;
          border-radius: 10px;
          animation: loading-slide 1.5s infinite ease-in-out;
      }
      @keyframes loading-slide {
          0% { left: -40px; }
          50% { width: 60px; }
          100% { left: 100px; }
      }

      /* SwAlert Overrides - Theme Aware */
      .swal2-popup {
          border-radius: 20px !important;
          background-color: var(--bg-box) !important;
          color: var(--text-main) !important;
          border: 1px solid var(--border-color) !important;
          backdrop-filter: var(--glass-blur);
          box-shadow: var(--shadow-main) !important;
      }
      .swal2-title, .swal2-html-container {
          color: var(--text-main) !important;
      }
      .swal2-confirm {
          background: var(--primary-gradient) !important;
          border-radius: 10px !important;
          font-weight: 600 !important;
          box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.3);
      }
      .swal2-cancel {
          background: var(--bg-body) !important;
          border: 1px solid var(--border-color) !important;
          border-radius: 10px !important;
          color: var(--text-muted) !important;
      }

      /* Premium Question Styling for Preview */
      .matching-grid-wrapper {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 30px;
          margin-top: 20px;
          position: relative;
      }
      .matching-column {
          display: flex;
          flex-direction: column;
          gap: 12px;
      }
      .matching-header-label {
          text-align: center; 
          color: var(--text-muted); 
          font-size: 11px; 
          font-weight: 700; 
          text-transform: uppercase; 
          margin-bottom: 5px; 
          letter-spacing: 1.5px;
          opacity: 0.7;
      }
      .matching-card {
          background: var(--bg-box);
          border: 1px solid var(--border-light);
          padding: 12px 20px;
          border-radius: 12px;
          color: var(--text-main);
          font-weight: 500;
          text-align: center;
          transition: all 0.2s;
          position: relative;
          min-height: 48px;
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 5;
          font-size: 14px;
      }
      .matching-card:hover {
          border-color: var(--accent-color);
          transform: translateY(-2px);
          box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.15);
      }
      .matching-card.kunci {
          border-left: 4px solid var(--accent-color);
          background: rgba(var(--primary-rgb), 0.02);
      }
      .matching-badge {
          position: absolute;
          top: -10px;
          right: -10px;
          background: var(--primary-gradient);
          color: white;
          padding: 2px 8px;
          border-radius: 10px;
          font-size: 10px;
          font-weight: bold;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      }
      .short-answer-wrapper {
          padding: 30px;
          background: rgba(var(--primary-rgb), 0.03);
          border-radius: 20px;
          border: 2px dashed var(--border-light);
          text-align: center;
      }
      .short-answer-input {
          max-width: 600px !important;
          margin: 0 auto !important;
          text-align: center;
          font-size: 20px !important;
          font-weight: 600 !important;
          letter-spacing: 1px;
          padding: 15px !important;
          border-radius: 15px !important;
          height: 60px !important;
      }
      .essay-wrapper {
          position: relative;
          background: var(--bg-box);
          border-radius: 20px;
          border: 1px solid var(--border-light);
          padding: 5px;
          transition: all 0.3s ease;
          margin-top: 15px;
      }
      .essay-wrapper:focus-within {
          border-color: var(--accent-color);
          box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
      }
      .essay-input {
          border: none !important;
          box-shadow: none !important;
          background: transparent !important;
          padding: 20px !important;
          min-height: 250px !important;
          font-size: 16px !important;
          color: var(--text-main) !important;
      }
      .essay-footer {
          padding: 15px 20px;
          background: rgba(var(--primary-rgb), 0.05);
          border-top: 1px solid var(--border-light);
          border-radius: 0 0 20px 20px;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      .opsi-checklist {
          position: relative;
          display: block;
          margin-bottom: 12px;
          padding: 15px 20px;
          background: var(--bg-box);
          border-radius: 12px;
          border: 1px solid var(--border-light);
          transition: all 0.3s ease;
      }
      .opsi-checklist label {
          padding-left: 5px;
          margin-bottom: 0;
          font-weight: 500;
          color: var(--text-main);
          width: 100%;
      }
  </style>
  <script>
      function toggleDarkMode() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          const newTheme = (currentTheme === 'dark' || currentTheme === 'darkblue') ? 'light' : 'dark';
          document.documentElement.setAttribute('data-theme', newTheme);
          localStorage.setItem('cbt-global-theme', newTheme);
          updateToggleIcons();
      }
      
      function updateToggleIcons() {
          const currentTheme = document.documentElement.getAttribute('data-theme');
          var icons = document.querySelectorAll('.theme-toggle-icon');
          var texts = document.querySelectorAll('.theme-toggle-text');
          
          if (currentTheme === 'light' || currentTheme === 'skyblue') {
              icons.forEach(el => { el.className = 'fa fa-moon-o theme-toggle-icon'; });
              texts.forEach(el => el.innerText = 'Gelap');
          } else {
              icons.forEach(el => { el.className = 'fa fa-sun-o theme-toggle-icon'; });
              texts.forEach(el => el.innerText = 'Terang');
          }
      }

      document.addEventListener('DOMContentLoaded', updateToggleIcons);
  </script>

  <style>
    /* Clean Docked Header & Navbar */
    .main-header {
        position: fixed !important;
        top: 0 !important;
        left: 230px !important;
        right: 0 !important;
        height: 56px !important;
        z-index: 1030 !important;
        background: var(--bg-nav) !important;
        border-bottom: 1px solid var(--border-color) !important;
        margin: 0 !important;
        padding: 0 !important;
        transition: left 0.3s ease-in-out;
    }
    .main-header .navbar {
        margin: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        min-height: 56px !important;
        height: 56px !important;
        padding: 0 15px !important;
        display: flex !important;
        align-items: center;
        justify-content: flex-end;
    }
    .sidebar-collapse .main-header {
        left: 50px !important;
    }
    .main-header .navbar .navbar-custom-menu {
        float: none !important;
        margin-left: auto;
    }
    .main-header .navbar .nav {
        display: flex !important;
        align-items: center;
        margin-right: 10px !important;
        gap: 6px;
        height: 56px;
    }
    .main-header .navbar .nav > li {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .main-header .navbar .nav > li > a {
        background: transparent !important;
        color: var(--text-main) !important;
        font-weight: 600 !important;
        padding: 8px 14px !important;
        border-radius: 8px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .main-header .navbar .nav > li:hover > a {
        background: rgba(var(--primary-rgb), 0.1) !important;
        color: var(--text-bright) !important;
    }
    .main-header .navbar .nav > li:last-child > a { 
        color: #f43f5e !important; 
        font-weight: 700 !important;
    }
    .main-header .navbar .nav > li:last-child:hover > a {
        background: rgba(244, 63, 94, 0.1) !important;
    }
  </style>
  <!-- GHCBT Custom CSS Studio -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/custom_dev.css?v=<?php echo time(); ?>">
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo site_url(); ?>/manager" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>" style="max-height: 30px; margin: 10px auto;" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>" style="max-height: 40px; margin-top: 5px; display: inline-block;" /> <b><?php echo $app_identity; ?></b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar Toggle Button -->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="Toggle Sidebar" style="float: left; padding: 17px 18px; color: #ffffff; font-size: 16px; background: transparent; transition: color 0.2s;">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- AI Voice Status Toggle -->
              <li id="ai-guardian-status" style="display: none;">
                <a href="javascript:void(0)" onclick="toggleAIVoice()" title="Toggle AI Guardian" id="ai-toggle-btn" class="ai-disabled" style="margin: 6px 6px; padding: 7px 14px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.1) !important; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; color: #ffffff !important; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                  <i class="fa fa-shield" id="ai-status-icon"></i> 
                  <span class="hidden-xs" id="ai-status-text" style="font-size: 10px; font-weight: 800; text-transform: uppercase;">AI READY</span>
                </a>
              </li>
              <!-- Admin Elite Identity Dashboard -->
              <?php 
                $admin_foto = base_url().'public/images/avatar.png';
                $session_admin_foto = $this->session->userdata('cbt_foto');
                if(!empty($session_admin_foto) && file_exists(FCPATH.'public/uploads/admin/'.$session_admin_foto)){
                    $admin_foto = base_url().'public/uploads/admin/'.$session_admin_foto;
                }
              ?>
              <li class="admin-identity-pill-static">
                <span class="hidden-xs" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 12px; margin: 6px 6px; padding: 7px 14px; display: inline-flex; align-items: center; gap: 8px; font-weight: 700; color: #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                  <i class="fa fa-shield" style="color: var(--accent-color);"></i> 
                  <?php echo $nama; ?>
                </span>
              </li>

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 10px 15px !important; margin-top: 5px;">
                  <img src="<?php echo $admin_foto; ?>" class="user-image" alt="Admin Image" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.3); box-shadow: 0 2px 8px rgba(0,0,0,0.2);"/>
                </a>
                <ul class="dropdown-menu" style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-main); background: var(--bg-sidebar); width: 280px; padding: 0; margin-top: 15px;">
                  <li class="user-header" style="background: var(--primary-gradient); padding: 35px 20px 35px 20px; text-align: center; color: white; height: auto !important; min-height: 180px;">
                    <img src="<?php echo $admin_foto; ?>" class="img-circle" alt="Admin Image" style="width: 90px; height: 90px; border: 4px solid rgba(255,255,255,0.2); box-shadow: 0 10px 25px rgba(0,0,0,0.3); margin: 0 auto; display: block; object-fit: cover;"/>
                    <div style="margin-top: 15px; padding-bottom: 10px;">
                        <p style="font-weight: 800; font-size: 18px; letter-spacing: 0.5px; margin-bottom: 0; line-height: 1.2;">
                          <?php echo $nama; ?>
                        </p>
                        <small style="display: block; opacity: 0.9; font-weight: 600; font-size: 11px; margin-top: 10px; text-transform: uppercase; letter-spacing: 1.5px;">Administrator Portal</small>
                    </div>
                  </li>
                  <li class="user-footer" style="padding: 20px; background: transparent; text-align: center;">
                    <a href="javascript:void(0)" onclick="adminLogoutSound()" class="btn btn-danger" style="background: linear-gradient(135deg, #f43f5e, #e11d48) !important; color: white !important; border-radius: 14px !important; font-weight: 700; padding: 12px 20px; width: 100%; box-shadow: 0 8px 20px rgba(244, 63, 94, 0.4); border: none !important; display: flex; justify-content: center; align-items: center; letter-spacing: 1px;">
                      <i class="fa fa-power-off" style="margin-right: 10px; font-size: 16px;"></i> KELUAR SISTEM
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Logo Section -->
          <div style="text-align: center; padding: 18px 12px 14px 12px; margin-bottom: 8px; border-bottom: 1px solid var(--sidebar-border); background: transparent;">
            <img src="<?php echo base_url(); ?>public/images/logo_modern.png?v=<?php echo time(); ?>" style="height: 78px; width: auto; max-width: 92%; object-fit: contain; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.25)); display: inline-block; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.04)';" onmouseout="this.style.transform='scale(1)';" />
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <?php 
            $show_std_dash = true;
            if($this->session->userdata('cbt_level') == 'developer' && defined('GHCBT_DEV_SUITE') && GHCBT_DEV_SUITE === true){
                $show_std_dash = false;
            }

            if($show_std_dash){ 
            ?>
			<li><a href="<?php echo site_url('manager'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <?php } ?>
            <?php 
            if(!empty($sidemenu)){
                echo $sidemenu;
            }
            /* 
            if($this->session->userdata('cbt_level') == 'admin'){
              $active = ($this->uri->segment(2) == 'system_update') ? 'active' : '';
              echo '<li class="'.$active.'"><a href="'.site_url('manager/system_update').'"><i class="fa fa-cloud-upload"></i> <span>Update System</span></a></li>';
            }
            */

            ?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<?php 
			if(!empty($content)){
				echo $content;
			}
		?>
      </div><!-- /.content-wrapper -->

      <!-- Modifikasi Footer Kapsul Melayang (Floating Box) -->
      <footer class="main-footer">
          <div>
              &copy; <?php echo date('Y'); ?> <strong><?php if(!empty($site_name)){ echo $site_name; } else { echo base64_decode('R0hDQlQ='); } ?></strong>. Developed by <span style="background:transparent !important; color: var(--accent-color); font-weight: 700; text-shadow: 0 0 10px rgba(var(--primary-rgb), 0.3);"><?php echo strip_tags($dev_credits); ?></span>.
          </div>
          <div style="font-weight: 600;">
              Version <span style="background: var(--primary-gradient); color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; margin-left: 5px; box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);"><?php echo $site_version; ?></span>
          </div>
      </footer>

    </div><!-- ./wrapper -->
	
	<div class="modal" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
						<span id="form-pesan-password">
                        </span>
						<?php echo form_open('manager/dashboard/password','id="form-password"')?>
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
                        <?php echo form_close(); ?>   
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="password-submit">Change</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    
    <div class="modal fade" id="modal-preview-soal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 24px; overflow: hidden; border: 1px solid var(--border-color);">
                <div class="modal-header" style="background: var(--primary-gradient); color: white; padding: 20px 25px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-weight: 700; display: flex; align-items: center; gap: 10px;">
                        <i class="fa fa-eye"></i> Preview Tampilan Siswa
                    </h4>
                </div>
                <div class="modal-body" id="preview-soal-body" style="padding: 30px; background: var(--bg-body); min-height: 200px;">
                    <!-- Diisi via AJAX -->
                </div>
                <div class="modal-footer" style="padding: 15px 25px; background: var(--bg-sidebar);">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 10px 25px;">Tutup Preview</button>
                </div>
            </div>
        </div>
    </div>

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
	
	<script>
    $(function () {
      // Matikan popup alert gaya kuno "Invalid JSON" jika Admin logout otomatis
      $.fn.dataTable.ext.errMode = 'none';
      $(document).on('error.dt', function(e, settings, techNote, message) {
          console.warn('DataTables Info: Sesi mungkin telah berakhir (Invalid JSON).');
      });
                        
      //Form Ubah Password
			$('#modal-password').on('shown.bs.modal', function (e) {
				$('#form-pesan-password').html('');
				$('#password-old').val('');
				$('#password-new').val('');
				$('#password-confirm').val('');
				$('#password-old').focus();
			});
			
			$('#password-submit').click(function(){
        $('#form-password').submit();
			});
			
			$('#form-password').submit(function(){        
        $.ajax({
          url:"<?php echo site_url(); ?>/manager/dashboard/password",
          type:"POST",
          data:$('#form-password').serialize(),
          cache: false,
          success:function(respon){
            var obj = $.parseJSON(respon);
            if(obj.status==1){
              $('#form-pesan-password').html(pesan_succ('Password berhasil diubah !'));
              setTimeout(function(){$('#modal-password').modal('hide')}, 1500);
            }else{
              $('#form-pesan-password').html(pesan_err(obj.error));
            }
          }
        });
        return false;
			});
    });

    /**
     * Fungsi Global Preview Soal
     */
    function preview_soal(id, controller_url){
        $("#modal-proses").modal('show');
        $.ajax({
            url: "<?php echo site_url(); ?>/" + controller_url + "/get_preview/" + id,
            type: "GET",
            cache: false,
            success: function(respon){
                var data = $.parseJSON(respon);
                if(data.status == 1){
                    $('#preview-soal-body').html(data.html);
                    $('#modal-preview-soal').modal('show');
                } else {
                    notify_error('Gagal mengambil data preview soal.');
                }
                $("#modal-proses").modal('hide');
            },
            error: function(){
                $("#modal-proses").modal('hide');
                notify_error('Kesalahan koneksi ke server.');
            }
        });
    }


    // =========================================================
    // GLOBAL AI VOICE GUARDIAN - FEMALE EDITION
    // =========================================================
    var notified_keys = JSON.parse(localStorage.getItem('notified_keys')) || {};
    var ai_enabled = localStorage.getItem('ai_voice_enabled') !== 'false'; // Default TRUE
    var idVoice = null;
    var audioUnlocked = false;

    function updateAIUI() {
        var btn = $('#ai-toggle-btn');
        var text = $('#ai-status-text');
        
        if (ai_enabled) {
            btn.removeClass('ai-disabled').addClass('ai-active');
            text.text('AI ACTIVE');
        } else {
            btn.removeClass('ai-active').addClass('ai-disabled');
            text.text('AI DISABLED');
        }
    }

    function toggleAIVoice() {
        ai_enabled = !ai_enabled;
        localStorage.setItem('ai_voice_enabled', ai_enabled);
        updateAIUI();
        if (ai_enabled) {
            play_ai_voice('Asisten A I diaktifkan.');
        } else {
            // Suara konfirmasi saat dimatikan (opsional tapi bagus untuk feedback)
            var msg = new SpeechSynthesisUtterance("Asisten A I dinonaktifkan.");
            msg.lang = 'id-ID';
            window.speechSynthesis.speak(msg);
        }
    }

    function adminLogoutSound() {
        var adminName = "<?php echo $nama; ?>";
        var level = "<?php echo $this->session->userdata('cbt_level'); ?>";
        var title = (level === 'developer') ? 'Master ' : '';
        var text = "Sampai jumpa kembali " + title + adminName + ". Menutup sesi administrator.";
        
        if (window.speechSynthesis) {
            window.speechSynthesis.cancel(); // Stop any pending voice
            var msg = new SpeechSynthesisUtterance(text);
            msg.lang = 'id-ID';
            msg.rate = 0.95;
            msg.pitch = 1.0;
            
            msg.onend = function() {
                window.location.href = "<?php echo site_url('manager/welcome/logout'); ?>";
            };

            window.speechSynthesis.speak(msg);
            
            // Backup redirect after 2 seconds if speech fails to fire onend
            setTimeout(function() {
                window.location.href = "<?php echo site_url('manager/welcome/logout'); ?>";
            }, 2000);
        } else {
            window.location.href = "<?php echo site_url('manager/welcome/logout'); ?>";
        }
    }

    function findFemaleVoice() {
        if (!window.speechSynthesis) return;
        var voices = window.speechSynthesis.getVoices();
        
        // AGGRESSIVE FEMALE FILTER (Prioritize Gadis, Siti, Female, avoid known male names)
        var idPriority = voices.filter(v => v.lang.includes('id-ID'));
        var femaleKeywords = ['gadis', 'siti', 'female', 'samantha', 'victoria', 'google US English', 'monica'];

        idVoice = idPriority.find(v => femaleKeywords.some(kw => v.name.toLowerCase().includes(kw)));
        
        if (!idVoice) {
            idVoice = idPriority.find(v => !v.name.toLowerCase().includes('male'));
        }
        
        if (idVoice) {
            console.log("AI Engine Selected: " + idVoice.name);
            $('#ai-guardian-status').show();
            updateAIUI();
        }
    }

    if (window.speechSynthesis) {
        window.speechSynthesis.onvoiceschanged = findFemaleVoice;
        findFemaleVoice();
    }

    function play_ai_voice(text) {
        if (!window.speechSynthesis || !ai_enabled || !text) return;
        
        // Memisahkan kalimat agar jeda antar nama lebih natural
        var sentences = text.split('. ');
        sentences.forEach(function(s) {
            if (s.trim() === "") return;
            var msg = new SpeechSynthesisUtterance(s.trim() + '.');
            msg.lang = 'id-ID';
            msg.rate = 0.95; 
            msg.pitch = 1.0; 
            msg.volume = 1.0;
            if (idVoice) msg.voice = idVoice;
            window.speechSynthesis.speak(msg);
        });
    }

    // Site-wide Audio Unlocker
    $(document).on('click mousemove scroll keydown touchstart', function() {
        if (audioUnlocked) return;
        var primer = new SpeechSynthesisUtterance('');
        window.speechSynthesis.speak(primer);
        audioUnlocked = true;
        console.log("Global AI Audio Unlocked");
    });

    // Persistence Intervals (Safe from Refresh)
    var last_pelanggaran_alert_time = parseInt(localStorage.getItem('last_pel_time')) || 0;
    var last_unlock_alert_time = parseInt(localStorage.getItem('last_unl_time')) || 0;
    var last_reset_alert_time = parseInt(localStorage.getItem('last_res_time')) || 0;

    function check_global_notifications() {
        $.getJSON('<?php echo site_url("manager/dashboard/cek_notifikasi"); ?>', function(data) {
            var voiceQueued = "";
            var newCount = 0;
            var currentTime = Date.now();
            
            var hasPelanggaran = (data.pelanggaran && data.pelanggaran.length > 0);
            var hasUnlock = (data.unlock && data.unlock.length > 0);
            var hasReset = (data.reset && data.reset.length > 0);

            // 1. Pelanggaran (Looping 5 Menit)
            if (hasPelanggaran) {
                var pelMsg = "";
                var isNewPel = false;
                $.each(data.pelanggaran, function(i, item) {
                    var key = 'v' + item.id;
                    if (!notified_keys[key]) {
                        notified_keys[key] = true;
                        isNewPel = true;
                        newCount++;
                    }
                    pelMsg += item.nama + ", melakukan pelanggaran. ";
                });

                // Play if NEW or if 5 minutes passed since last pelanggaran alert
                if (isNewPel || (currentTime - last_pelanggaran_alert_time > (5 * 60 * 1000))) {
                    voiceQueued += pelMsg;
                    last_pelanggaran_alert_time = currentTime;
                    localStorage.setItem('last_pel_time', currentTime);
                }
            }

            // 2. Unlock Request (Looping 15 Detik)
            if (hasUnlock) {
                var unlMsg = "";
                var isNewUnl = false;
                $.each(data.unlock, function(i, item) {
                    var key = 'u' + item.id;
                    if (!notified_keys[key]) {
                        notified_keys[key] = true;
                        isNewUnl = true;
                        newCount++;
                    }
                    unlMsg += item.nama + ", minta buka kunci. ";
                });

                if (isNewUnl || (currentTime - last_unlock_alert_time > 15000)) {
                    voiceQueued += unlMsg;
                    last_unlock_alert_time = currentTime;
                    localStorage.setItem('last_unl_time', currentTime);
                }
            }

            // 3. Reset Request (Looping 15 Detik)
            if (hasReset) {
                var resMsg = "";
                var isNewRes = false;
                $.each(data.reset, function(i, item) {
                    var key = 'r' + item.id;
                    if (!notified_keys[key]) {
                        notified_keys[key] = true;
                        isNewRes = true;
                        newCount++;
                    }
                    resMsg += item.nama + ", minta reset login. ";
                });

                if (isNewRes || (currentTime - last_reset_alert_time > 15000)) {
                    voiceQueued += resMsg;
                    last_reset_alert_time = currentTime;
                    localStorage.setItem('last_res_time', currentTime);
                }
            }

            if (voiceQueued !== "") {
                if (audioUnlocked) {
                    play_ai_voice(voiceQueued);
                    localStorage.setItem('notified_keys', JSON.stringify(notified_keys));
                    
                    // PNotify - Minimalist Visual (Silent voice because play_ai_voice already called above)
                    if (hasReset || hasUnlock) {
                        notify_error(voiceQueued, true);
                    } else {
                        notify_info(voiceQueued, true);
                    }
                }
            }
        });
    }

    // Polling Global - Optimized Responsiveness
    setTimeout(function() {
        check_global_notifications(); // Initial check as soon as possible
    }, 2000);

    setInterval(check_global_notifications, 3000); // Pulse every 3 seconds

    // AI Welcome Voice - Exclusive for Admin (One-time per session)
    document.addEventListener('DOMContentLoaded', function() {
        if (!sessionStorage.getItem('admin_greeted')) {
            setTimeout(function() {
                var adminName = "<?php echo $nama; ?>";
                var level = "<?php echo $this->session->userdata('cbt_level'); ?>";
                var title = (level === 'developer') ? 'Master ' : '';
                var text = "Selamat datang " + title + adminName + " di portal admin ujian berbasis komputer";
                
                var msg = new SpeechSynthesisUtterance();
                msg.text = text;
                msg.lang = 'id-ID';
                msg.rate = 0.9; // Slightly slower for elegance
                msg.pitch = 1.1; // Professional tone
                
                window.speechSynthesis.speak(msg);
                sessionStorage.setItem('admin_greeted', 'true');
            }, 100); // Super-fast 0.1s delay for instant login feel
        }
    });
  </script>
  </body>
</html>
