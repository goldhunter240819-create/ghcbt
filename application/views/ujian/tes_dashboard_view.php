<div class="container">
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
        background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
        border-radius: 24px;
        padding: 40px 35px;
        color: white;
        box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.4);
        margin-top: 10px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    .premium-welcome-banner::before {
        content: ''; position: absolute; right: -50px; top: -50px; width: 250px; height: 250px;
        background: rgba(255, 255, 255, 0.1); border-radius: 50%; filter: blur(2px);
    }
    .premium-welcome-banner::after {
        content: ''; position: absolute; right: 120px; bottom: -40px; width: 120px; height: 120px;
        background: rgba(255, 255, 255, 0.1); border-radius: 50%;
    }
    .welcome-title { font-weight: 800; font-size: 32px; margin: 0 0 10px 0; letter-spacing: 0.5px; position: relative; z-index: 10; }
    .welcome-subtitle { font-size: 16px; opacity: 0.95; margin: 0; font-weight: 500; position: relative; z-index: 10; }
    .badge-wrap { margin-top: 25px; display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 10; }
    .badge-class { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 600; border: 1px solid rgba(255,255,255,0.3); }
    
    /* Branding Capsules Sync */
    .badge-gold { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); color: #1e293b; padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 800; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4); border: 1px solid rgba(255,255,255,0.2); display: inline-flex; align-items: center; gap: 6px; }
    .badge-blue { background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%); color: white; padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 800; box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3); border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 6px; }
    
    /* Table Wrapping & Tidy Enhancements */
    #table-tes td, #table-history td {
        white-space: normal !important;
        word-wrap: break-word;
        max-width: 300px;
        vertical-align: middle !important;
    }
    #table-tes th:nth-child(2), #table-history th:nth-child(2) {
        min-width: 200px;
    }
</style>

<div class="container">
    <div class="premium-welcome-banner">
        <h1 class="welcome-title">Hi, <?php if(!empty($nama)){ echo $nama; } ?>! <span style="display: inline-block; animation: wave 2.5s infinite; transform-origin: 70% 70%;">👋</span></h1>
        <p class="welcome-subtitle">Selamat Datang di Pusat Ujian Cerdas Berbasis Komputer</p>
        
        <div class="badge-wrap">
            <span class="badge-class"><i class="fa fa-graduation-cap"></i> <?php if(!empty($group)){ echo $group; } else { echo 'Siswa'; } ?> </span>
            <span class="badge-gold"><i class="fa fa-star"></i> PLATFORM PRO</span>
            <span class="badge-blue"><i class="fa fa-code-fork"></i> <?php echo $site_version; ?></span>
        </div>
    </div>

	<!-- Main content -->
    <section class="content" style="padding-top: 0;">
        <?php if(!empty($lock_status) && $lock_status == 1): ?>
            <div id="lock-alert" class="callout <?php echo ($lock_request == 1 ? 'callout-warning' : 'callout-danger'); ?> animate__animated animate__shakeX" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center;">
                    <div style="font-size: 30px; margin-right: 20px;">
                        <i class="fa <?php echo ($lock_request == 1 ? 'fa-hourglass-half' : 'fa-lock'); ?>"></i>
                    </div>
                    <div style="flex-grow: 1;">
                        <h4 style="margin-bottom: 5px; font-weight: 700;">
                            <?php echo ($lock_request == 1 ? 'Permintaan Buka Kunci Terkirim' : 'Ujian Terkunci'); ?>
                        </h4>
                        <p id="lock-message" style="font-size: 15px;">
                            <?php if($lock_request == 1): ?>
                                Permintaan sudah dikirim ke Admin. Silahkan tunggu hingga Admin membuka kunci ujian Anda.
                            <?php else: ?>
                                Ujian Anda terdeteksi melakukan pelanggaran. Silahkan klik request setelah hitungan mundur selesai.
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php if($lock_request == 0): ?>
                        <div id="lock-timer-container" style="text-align: center; min-width: 120px;">
                            <div id="lock-countdown" style="font-size: 24px; font-weight: 800; letter-spacing: 1px;">03:00</div>
                            <button id="btn-request-unlock" class="btn btn-primary btn-sm hide" onclick="requestUnlock(<?php echo $lock_tesuser_id; ?>)" style="margin-top: 5px; border-radius: 8px;">
                                <i class="fa fa-paper-plane"></i> Request Unlock
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>


        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title" style="letter-spacing: 0.5px;"><i class="fa fa-file-text-o" style="margin-right: 8px;"></i> Daftar Ujian Aktif</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-tes" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="all">Ujian</th>
                            <th>Waktu Mulai Ujian</th>
                            <th>Waktu Selesai Ujian</th>
                            <th>Status</th>
                            <th class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>   
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <?php if(isset($show_history) && $show_history == 'ya'): ?>
        <div class="box box-primary box-solid" style="margin-top: 25px;">
            <div class="box-header with-border">
                <h3 class="box-title" style="letter-spacing: 0.5px;"><i class="fa fa-history" style="margin-right: 8px;"></i> Histori Ujian Selesai</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-history" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="all">Ujian</th>
                            <th>Waktu Mulai Ujian</th>
                            <th>Waktu Selesai Ujian</th>
                            <th>Status</th>
                            <th class="all">Nilai (Skala 100)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>   
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <?php endif; ?>
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
    $(function () {
        $('#table-tes').DataTable({
                  "paging": true,
                  "iDisplayLength":25,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"5%"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"10%"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"10%"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true
         });   

         <?php if(isset($show_history) && $show_history == 'ya'): ?>
        $('#table-history').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"5%"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"10%"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"15%"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable_history/",
                  "autoWidth": false,
                  "responsive": true
         });
         <?php endif; ?>

         <?php if(!empty($lock_status) && $lock_status == 1 && $lock_request == 0): ?>
            startLockCountdown(<?php echo $lock_remaining; ?>);
         <?php endif; ?>

         // Jalankan Polling jika status saat ini sedang menunggu unlock
         <?php if(!empty($lock_status) && $lock_status == 1 && $lock_request == 1): ?>
            pollUnlockStatus(<?php echo $lock_tesuser_id; ?>);
         <?php endif; ?>
    });

    function startLockCountdown(remaining) {
        var timer = remaining, minutes, seconds;
        var interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            $('#lock-countdown').text(minutes + ":" + seconds);

            if (--timer < 0) {
                clearInterval(interval);
                $('#lock-countdown').addClass('hide');
                $('#btn-request-unlock').removeClass('hide').addClass('animate__animated animate__pulse animate__infinite');
            }
        }, 1000);
    }

    function requestUnlock(tesuserId) {
        $("#modal-proses").modal('show');
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/request_buka_kunci/",
            type: "POST",
            data: { tesuser_id: tesuserId },
            cache: false,
            success: function(respon) {
                var data = $.parseJSON(respon);
                $("#modal-proses").modal('hide');
                if(data.status == 1) {
                    notify_success(data.pesan);
                    $('#lock-alert').removeClass('callout-danger').addClass('callout-warning');
                    $('#lock-alert i').removeClass('fa-lock').addClass('fa-hourglass-half');
                    $('#lock-alert h4').text('Permintaan Buka Kunci Terkirim');
                    $('#lock-message').text('Permintaan sudah dikirim ke Admin. Silahkan tunggu hingga Admin membuka kunci ujian Anda.');
                    $('#lock-timer-container').remove();
                    
                    // Mulai Polling setelah request berhasil dikirim
                    pollUnlockStatus(tesuserId);
                } else {
                    notify_error(data.pesan);
                }
            },
            error: function() {
                $("#modal-proses").modal('hide');
                notify_error('Gagal mengirim permintaan');
            }
        });
    }

    var unlockPollingInterval;
    function pollUnlockStatus(tesuserId) {
        if (unlockPollingInterval) clearInterval(unlockPollingInterval);

        unlockPollingInterval = setInterval(function() {
            $.ajax({
                url: "<?php echo site_url().'/'.$url; ?>/ajax_check_unlock_status",
                type: "POST",
                data: { tesuser_id: tesuserId },
                success: function(resp) {
                    var obj = $.parseJSON(resp);
                    if (obj.status == 1) {
                        clearInterval(unlockPollingInterval);
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Ujian telah dibuka silahkan melanjutkan',
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
    
    // --- FITUR ASISTEN AI WELCOME MESSAGE ---
    $(function() {
        if (!sessionStorage.getItem('welcome_played')) {
            // Coba putar setelah sedikit delay
            setTimeout(function() {
                playWelcomeVoice();
            }, 800);
        }
    });

    function playWelcomeVoice() {
        // Disabled for Offline Mode to ensure performance
    }
</script>