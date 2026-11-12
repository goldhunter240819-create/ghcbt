<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/images/favicon.png?v=<?php echo time(); ?>">
<link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/favicon.png?v=<?php echo time(); ?>">
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
<script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<style>
    /* Theme Definitions */
    :root, [data-theme-login="midnight"] {
        /* Default: Midnight Glow (Dark) */
        --primary: #6366f1;
        --primary-rgb: 99, 102, 241;
        --primary-hover: #4f46e5;
        --text-muted: #64748b;
        --border-color: rgba(14, 165, 233, 0.1);
        --input-bg: #030712;
        --input-text: #f8fafc;
        --card-bg: #0f172a;
        --bg-grad: radial-gradient(circle at top right, #030712, #0f172a);
        --text-main: #f8fafc;
    }

    [data-theme-login="light"] {
        /* Sky Blue - Dominant White */
        --primary: #0284c7;
        --primary-rgb: 2, 132, 199;
        --primary-hover: #0369a1;
        --bg-grad: radial-gradient(circle at top right, #f8fafc, #ffffff);
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: rgba(14, 165, 233, 0.25);
        --input-bg: #ffffff;
        --input-text: #1e293b;
    }

    [data-theme-login="emerald"] {
        --primary: #10b981;
        --primary-rgb: 16, 185, 129;
        --primary-hover: #059669;
        --bg-grad: radial-gradient(circle at top right, #ecfdf5, #f1f5f9);
    }

    [data-theme-login="rose"] {
        --primary: #f43f5e;
        --primary-rgb: 244, 63, 94;
        --primary-hover: #e11d48;
        --bg-grad: radial-gradient(circle at top right, #fff1f2, #f1f5f9);
    }

    [data-theme-login="ocean"] {
        --primary: #0ea5e9;
        --primary-rgb: 14, 165, 233;
        --primary-hover: #0284c7;
        --bg-grad: radial-gradient(circle at top right, #f0f9ff, #f1f5f9);
    }

    [data-theme-login="midnight"] {
        /* Handled by :root */
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-grad) !important;
        background-color: #030712 !important; /* Fallback */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 20px;
        transition: all 0.5s ease;
    }

    .wrapper, .content-wrapper {
        background: transparent !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        width: 100% !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }
    .main-header, .main-footer {
        display: none !important;
    }

    .login-box {
        width: 100%;
        max-width: 420px;
        margin: auto;
        position: relative;
    }

    .login-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.08);
    }

    .login-logo {
        text-align: center;
        margin-bottom: 30px;
    }
    .login-logo img {
        width: 150px;
        max-width: 85%;
        height: auto;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        object-fit: contain;
    }
    .login-logo img:hover {
        transform: scale(1.03);
    }

    .login-header {
        text-align: center;
        margin-bottom: 35px;
    }
    .login-header h3 {
        margin: 0;
        font-weight: 700;
        color: var(--text-main);
        font-size: 26px;
        white-space: nowrap;
    }
    .login-header p {
        color: var(--text-muted);
        font-size: 15px;
        margin-top: 8px;
    }

    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--text-main);
        font-size: 14px;
        margin-bottom: 8px;
    }

    .input-wrapper {
        position: relative;
    }
    .input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .form-control {
        background-color: var(--input-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 10px !important;
        padding: 12px 45px !important;
        font-size: 15px !important;
        color: var(--input-text) !important;
        width: 100% !important;
        height: auto !important;
        transition: all 0.2s !important;
    }
    .form-control:focus {
        border-color: var(--primary) !important;
        background-color: var(--card-bg) !important;
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1) !important;
        outline: none;
    }
    .toggle-password {
        position: absolute;
        right: 15px;
        left: auto !important;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-muted);
        transition: color 0.2s;
        z-index: 10;
    }
    .toggle-password:hover {
        color: var(--primary);
    }

    .btn-login {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 14px;
        width: 100%;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-login:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(var(--primary-rgb), 0.3);
    }

    .login-footer {
        text-align: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px dashed var(--border-color);
        font-size: 14px;
        color: var(--text-muted);
    }
    .login-footer a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }

    .theme-switcher {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    .theme-toggle-btn {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        padding: 10px 20px;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-main);
        font-weight: 600;
        transition: all 0.3s;
    }
    .theme-toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        border-color: var(--primary);
    }
    .theme-toggle-btn i {
        font-size: 18px;
        color: var(--primary);
    }

    @media (max-width: 480px) {
        .login-card { padding: 30px 20px; }
        .theme-switcher { bottom: 20px; right: 20px; }
    }
</style>

<div class="login-box">
    <div class="login-card">
        <div class="login-logo">
            <img src="<?php echo $logo_modern; ?>" id="login-logo-img" alt="GHCBT Logo" onerror="this.onerror=null; this.src='<?php echo $logo_standard; ?>';">
        </div>
        <div class="login-header">
            <h3><?php if(!empty($site_name)){ echo $site_name; } else { echo "GHCBT"; } ?></h3>
            <p><?php if(!empty($cbt_keterangan)){ echo $cbt_keterangan; }else{ echo 'Ujian Online Berbasis Komputer'; } ?></p>
        </div>

        <?php echo form_open('welcome/login', array('id' => 'form-login'))?>
            <div id="form-pesan"></div>
            <div class="form-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <input type="text" id="username" autocomplete="off" name="username" class="form-control" placeholder="Username"/>
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" autocomplete="off" name="password" class="form-control" placeholder="Kata sandi"/>
                    <i class="fa fa-lock"></i>
                    <i class="fa fa-eye toggle-password" id="toggle-icon" onclick="showpassword()"></i>
                </div>
            </div>
            <button type="submit" class="btn-login">MASUK SEKARANG <i class="fa fa-sign-in"></i></button>
                <p style="text-align: center; margin-top: 15px;">Login Administrator? <a href="<?php echo site_url('manager/welcome'); ?>" style="color: var(--primary); font-weight: 600; text-decoration: none;">Klik di Sini</a></p>
        </form>
        <div style="text-align: center; margin-top: 30px; padding-top: 25px; border-top: 1px solid var(--border-color); font-size: 14px; color: var(--text-muted);">
            <b><?php echo $this->config->item('site_version'); ?></b>
        </div>
    </div>
</div>

<div class="theme-switcher">
    <div class="theme-toggle-btn" onclick="toggleLoginTheme()">
        <i class="fa fa-moon-o" id="login-theme-icon"></i>
        <span id="login-theme-text">Dark Mode</span>
    </div>
</div>

<div class="modal fade" id="modal-proses" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin-top: 30vh;">
        <div class="modal-content" style="border-radius: 15px; border: none; padding: 20px; text-align: center;">
            <div class="modal-body">
                <i class="fa fa-circle-o-notch fa-spin fa-3x" style="color: var(--primary); margin-bottom: 15px;"></i>
                <p style="font-weight: 500; font-size: 16px; margin: 0;">Sedang Memproses...</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function setLoginTheme(theme) {
        document.documentElement.setAttribute('data-theme-login', theme);
        localStorage.setItem('cbt-global-theme', theme);
        
        if (theme === 'midnight') {
            $('#login-theme-icon').removeClass('fa-moon-o').addClass('fa-sun-o');
            $('#login-theme-text').text('Light Mode');
        } else {
            $('#login-theme-icon').removeClass('fa-sun-o').addClass('fa-moon-o');
            $('#login-theme-text').text('Dark Mode');
        }
    }

    function toggleLoginTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme-login');
        const newTheme = currentTheme === 'midnight' ? 'light' : 'midnight';
        setLoginTheme(newTheme);
    }

    function showpassword(){
      var x = document.getElementById("password");
      var icon = document.getElementById("toggle-icon");
      if (x.type === "password") {
        x.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        x.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }

    function adjustHeaderSize() {
        var $h3 = $('.login-header h3');
        var maxWidth = $('.login-header').width();
        var fontSize = 26;
        $h3.css('font-size', fontSize + 'px');
        while ($h3[0].scrollWidth > maxWidth && fontSize > 12) {
            fontSize--;
            $h3.css('font-size', fontSize + 'px');
        }
    }

    $(function() {
        // Run dynamic header font scaling
        adjustHeaderSize();
        $(window).on('resize', adjustHeaderSize);

        // Reset status welcome voice agar setiap login baru suara muncul kembali
        sessionStorage.removeItem('welcome_played');

        const savedTheme = localStorage.getItem('cbt-global-theme') || 'midnight';
        setLoginTheme(savedTheme);
        
        $('#username').focus();

        $('#form-login').submit(function(e){
            e.preventDefault();
            $("#modal-proses").modal('show');
            $.ajax({
                url:"<?php echo site_url(); ?>/welcome/login",
                type:"POST",
                data:$('#form-login').serialize(),
                cache: false,
                success:function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status==1){
                        window.open("<?php echo site_url(); ?>/tes_dashboard","_self");
                    }else{
                        if(obj.active_login == 1) {
                            $("#modal-proses").modal('hide');
                            Swal.fire({
                                title: 'Akun Sedang Aktif!',
                                text: 'Sistem mendeteksi Anda masih login di perangkat lain. Ingin meminta Admin mereset status login Anda?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#0ea5e9',
                                cancelButtonColor: '#f43f5e',
                                confirmButtonText: 'Ya, Kirim Request!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#modal-proses").modal('show');
                                    $.ajax({
                                        url: "<?php echo site_url(); ?>/welcome/request_reset_login",
                                        type: "POST",
                                        data: { username: $('#username').val() },
                                        success: function(resp) {
                                            $("#modal-proses").modal('hide');
                                            var obj2 = $.parseJSON(resp);
                                            if(obj2.status == 1) {
                                                Swal.fire({
                                                    title: 'Terkirim!',
                                                    text: obj2.pesan,
                                                    icon: 'success',
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false
                                                });
                                                // Jalankan Polling untuk cek kapan Admin me-reset
                                                pollResetStatus($('#username').val());
                                            } else {
                                                Swal.fire('Gagal!', obj2.pesan, 'error');
                                            }
                                        }
                                    });
                                }
                            });
                        } else {
                            $('#form-pesan').html(pesan_err(obj.error));
                            $("#modal-proses").modal('hide');
                            $('#username').focus();
                        }
                    }
                }
            });
            return false;
        });
    });

    var resetPollingInterval;
    function pollResetStatus(username) {
        if (resetPollingInterval) clearInterval(resetPollingInterval);
        
        resetPollingInterval = setInterval(function() {
            $.ajax({
                url: "<?php echo site_url(); ?>/welcome/ajax_check_reset_status",
                type: "POST",
                data: { username: username },
                success: function(resp) {
                    var obj = $.parseJSON(resp);
                    if (obj.status == 1) {
                        clearInterval(resetPollingInterval);
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'User sudah direset silakan login kembali',
                            icon: 'success',
                            confirmButtonColor: '#0ea5e9'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                }
            });
        }, 3000); // Polling setiap 3 detik
    }
</script>