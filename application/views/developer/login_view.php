<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('public/images/favicon.png'); ?>">
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
    
    <style>
        @font-face { font-family: 'Plus Jakarta Sans'; src: local('Plus Jakarta Sans'), sans-serif; }
        
        :root {
            --gold-primary: #f59e0b;
            --gold-secondary: #fbbf24;
            --gold-glow: rgba(245, 158, 11, 0.4);
            --gold-gradient: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gold-glow-strong: 0 0 25px rgba(245, 158, 11, 0.6);
            --deep-bg: #020617;
            --glass-card: rgba(15, 23, 42, 0.85);
            --border-light: rgba(245, 158, 11, 0.25);
            --neon-blue: #3b82f6;
            --neon-cyan: #06b6d4;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--deep-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #f1f5f9;
            height: 100vh;
            display: flex;
            scrollbar-width: none !important;  /* Firefox */
        }
        
        *::-webkit-scrollbar {
            display: none !important; /* Chrome, Safari and Opera */
        }
        
        * {
            -ms-overflow-style: none !important; /* IE and Edge */
            scrollbar-width: none !important; /* Firefox */
        }

        #tsparticles {
            position: fixed;
            inset: 0;
            z-index: 1;
        }

        /* Cyberpunk Grid Background */
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
        }

        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 0 500px; }
        }

        /* Scanline Effect */
        .scanlines {
            position: fixed;
            inset: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%),
                        linear-gradient(90deg, rgba(255, 0, 0, 0.02), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.02));
            background-size: 100% 2px, 3px 100%;
            pointer-events: none;
            z-index: 2;
            opacity: 0.3;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
            z-index: 10;
            position: relative;
        }

        .login-card {
            background: var(--glass-card);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--border-light);
            border-radius: 32px;
            padding: 50px 45px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.8), 
                        inset 0 0 30px rgba(245, 158, 11, 0.02);
            position: relative;
            overflow: hidden;
            animation: cardEntrance 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardEntrance {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Decorative Glitch Corners */
        .corner-light {
            position: absolute;
            width: 30px; height: 30px;
            border: 2px solid var(--gold-primary);
            opacity: 0.4;
        }
        .lt { top: 20px; left: 20px; border-right: 0; border-bottom: 0; }
        .rb { bottom: 20px; right: 20px; border-left: 0; border-top: 0; }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo img {
            height: 70px;
            width: auto;
            filter: drop-shadow(0 0 15px var(--gold-primary));
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .login-header h2 {
            font-weight: 900;
            font-size: 24px;
            letter-spacing: 2px;
            margin-bottom: 8px;
            text-transform: uppercase;
            background: linear-gradient(to right, #fff, var(--gold-primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-header p {
            font-size: 10px;
            color: var(--gold-primary);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 800;
            opacity: 0.8;
        }

        .form-group label {
            display: block;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--gold-primary);
            opacity: 0.7;
            margin-bottom: 12px;
            padding-left: 4px;
        }

        .input-group-zenith {
            position: relative;
        }
        .input-group-zenith i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-primary);
            font-size: 16px;
            opacity: 0.5;
        }
        .input-group-zenith input {
            width: 100%;
            background: rgba(245, 158, 11, 0.03);
            border: 1px solid rgba(245, 158, 11, 0.15);
            border-radius: 16px;
            padding: 18px 20px 18px 55px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .input-group-zenith input:focus {
            outline: none;
            border-color: var(--gold-primary);
            background: rgba(245, 158, 11, 0.08);
            box-shadow: 0 0 25px rgba(245, 158, 11, 0.15);
        }

        .btn-zenith {
            width: 100%;
            background: var(--gold-gradient);
            color: #020617;
            border: none;
            border-radius: 18px;
            padding: 18px;
            font-weight: 900;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .btn-zenith:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: var(--gold-glow-strong);
        }

        .self-heal-area {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid rgba(255,255,255,0.05);
            text-align: center;
        }
        .btn-heal {
            background: transparent;
            border: 1px solid rgba(244, 63, 94, 0.3);
            color: #f43f5e;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .btn-heal:hover {
            background: rgba(244, 63, 94, 0.1);
            border-color: #f43f5e;
        }

        #form-pesan {
            margin-bottom: 25px;
        }
        .alert-zenith {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.3);
            color: #fca5a5;
            padding: 15px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Quantum Loading Overlay */
        #zenith-loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.95);
            backdrop-filter: blur(20px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .loading-ring {
            width: 120px;
            height: 120px;
            border: 2px solid transparent;
            border-top: 2px solid var(--gold-primary);
            border-radius: 50%;
            animation: ringRotate 2s linear infinite;
            position: relative;
            box-shadow: 0 0 30px rgba(245, 158, 11, 0.1);
        }
        .loading-ring::before {
            content: "";
            position: absolute;
            inset: -10px;
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-bottom: 1px solid var(--gold-primary);
            border-radius: 50%;
            animation: ringRotate 3.5s linear reverse infinite;
        }
        .loading-text {
            margin-top: 40px;
            font-size: 11px;
            font-weight: 900;
            color: var(--gold-primary);
            text-transform: uppercase;
            letter-spacing: 5px;
            animation: textPulse 1.5s ease-in-out infinite;
            text-align: center;
        }
        @keyframes ringRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes textPulse {
            0%, 100% { opacity: 0.4; text-shadow: 0 0 10px transparent; }
            50% { opacity: 1; text-shadow: 0 0 20px var(--gold-primary); }
        }
    </style>
</head>
<body>
    <div id="zenith-loading-overlay">
        <div class="loading-ring"></div>
        <div class="loading-text">Authorizing Neural Link...<br><span style="font-size: 9px; opacity: 0.6; letter-spacing: 2px; margin-top: 10px; display: block;">Master Authentication in Progress</span></div>
    </div>
    <div id="tsparticles"></div>
    <div class="cyber-grid"></div>
    <div class="scanlines"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="corner-light lt"></div>
            <div class="corner-light rb"></div>

            <div class="login-logo">
                <img src="<?php echo base_url('public/images/dev_logo.png'); ?>" alt="Dev Logo">
            </div>
            <div class="login-header">
                <h2>Developer Portal</h2>
                <p>Arsitek Ekosistem Digital GHCBT</p>
            </div>

            <div id="form-pesan"></div>

            <form id="form-login">
                <div class="form-group">
                    <label>Developer Identity</label>
                    <div class="input-group-zenith">
                        <i class="fa fa-id-badge"></i>
                        <input type="text" name="username" id="username" placeholder="Enter username..." autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label>Security Key</label>
                    <div class="input-group-zenith">
                        <i class="fa fa-shield"></i>
                        <input type="password" name="password" id="password" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn-zenith" id="btn-login">
                    Authorize Session <i class="fa fa-bolt"></i>
                </button>
            </form>

            <div class="self-heal-area">
                <button class="btn-heal" onclick="selfHeal()">
                    <i class="fa fa-heartbeat"></i> Self-Heal Session
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>

    <script>
        // --- ZENITH NEURAL NARRATOR (Elegant Female Voice) ---
        var ZenithVoice = {
            speech: window.speechSynthesis,
            voices: [],
            elegantVoice: null,
            isReady: false,

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

        // --- PARTICLE BACKGROUND ---
        tsParticles.load("tsparticles", {
            particles: {
                number: { value: 60, density: { enable: true, value_area: 800 } },
                color: { value: "#f59e0b" },
                shape: { type: "circle" },
                opacity: { value: 0.2, random: true },
                size: { value: 3, random: true },
                move: { enable: true, speed: 1.5, direction: "top", out_mode: "out" },
                links: { enable: true, distance: 150, color: "#f59e0b", opacity: 0.1, width: 1 }
            },
            interactivity: {
                events: { onhover: { enable: true, mode: "grab" }, onclick: { enable: true, mode: "push" } },
                modes: { grab: { distance: 200, line_linked: { opacity: 0.3 } } }
            }
        });

        $(function(){
            $('#username').focus();

            $('#form-login').submit(function(e){
                e.preventDefault();
                var btn = $('#btn-login');
                btn.prop('disabled', true).html('<i class="fa fa-refresh fa-spin"></i> AUTHENTICATING...');
                
                $.ajax({
                    url: "<?php echo site_url('maul/login'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(obj){
                        if(obj.status == 1){
                            $('#zenith-loading-overlay').css('display', 'flex').hide().fadeIn(800);
                            btn.html('<i class="fa fa-check"></i> IDENTITY VERIFIED');
                            
                            // Combined Neural Greeting
                            ZenithVoice.speak("Otorisasi Sesi Berhasil. Selamat datang Master, di portal developer.");
                            
                            setTimeout(function(){ 
                                window.location.href = obj.target; 
                            }, 3000);
                        } else {
                            ZenithVoice.speak("Akses Ditolak. Portal ini hanya untuk level Developer.");
                            $('#form-pesan').html('<div class="alert-zenith"><i class="fa fa-warning"></i> ' + obj.error.toUpperCase() + '</div>');
                            btn.prop('disabled', false).html('AUTHORIZE SESSION <i class="fa fa-bolt"></i>');
                            $('#password').val('');
                        }
                    },
                    error: function(){
                        btn.prop('disabled', false).html('AUTHORIZE SESSION <i class="fa fa-bolt"></i>');
                        Swal.fire('Error', 'Gateway connection failed.', 'error');
                    }
                });
            });
        });

        function selfHeal() {
            Swal.fire({
                title: 'Initialize Self-Heal?',
                text: 'This will reset your login cookies and local session tokens.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                confirmButtonText: 'Yes, Reset System',
                background: '#020617',
                color: '#f1f5f9'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.getJSON("<?php echo site_url('maul/self_heal'); ?>", function(res){
                        ZenithVoice.speak("System reset successful. Recovery complete.");
                        Swal.fire({
                            title: 'Success',
                            text: res.pesan,
                            icon: 'success',
                            background: '#020617',
                            color: '#f1f5f9'
                        }).then(() => {
                            location.reload();
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>
</html>
