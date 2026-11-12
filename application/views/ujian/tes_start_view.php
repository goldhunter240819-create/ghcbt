<div class="container animate__animated animate__fadeIn">
    <style>
        .zenith-confirm-card {
            background: var(--bg-box) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 30px !important;
            box-shadow: var(--shadow-main) !important;
            padding: 40px !important;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
            backdrop-filter: var(--glass-blur);
        }
        .zenith-confirm-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 6px;
            background: var(--primary-gradient);
        }
        
        .confirm-header { text-align: center; margin-bottom: 40px; }
        .confirm-header h2 { font-weight: 800; color: var(--text-bright); margin-bottom: 10px; font-size: 28px; }
        .confirm-header p { color: var(--text-muted); font-size: 15px; }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }
        .info-tile {
            background: rgba(var(--primary-rgb), 0.03);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }
        .info-tile:hover {
            transform: translateY(-2px);
            background: rgba(var(--primary-rgb), 0.06);
            border-color: var(--accent-color);
        }
        .info-icon {
            width: 45px; height: 45px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px;
            box-shadow: 0 8px 15px rgba(var(--primary-rgb), 0.3);
        }
        .info-content .label { 
            display: block; font-size: 11px; font-weight: 700; color: var(--text-muted); 
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px;
            background: transparent !important; padding: 0 !important; text-align: left !important;
        }
        .info-content .value { 
            display: block; font-size: 15px; font-weight: 800; color: var(--text-main); 
            line-height: 1.4; word-break: break-word; white-space: normal; 
        }

        /* Full width for Exam Name Tile */
        .info-tile.full-width { grid-column: span 2; }

        /* Token Section Overhaul */
        .zenith-token-container {
            margin-top: 20px;
            padding: 30px;
            background: rgba(var(--primary-rgb), 0.05);
            border: 1px dashed var(--accent-color);
            border-radius: 24px;
            text-align: center;
            position: relative;
        }
        .token-label {
            font-size: 13px; font-weight: 800; color: var(--accent-color);
            letter-spacing: 2px; margin-bottom: 15px;
        }
        .zenith-token-container .form-control {
            max-width: 400px;
            margin: 0 auto;
            height: 70px !important;
            font-size: 32px !important;
            font-weight: 900 !important;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 6px;
            border: 2px solid var(--accent-color) !important;
            border-radius: 18px !important;
            box-shadow: 0 15px 35px rgba(var(--primary-rgb), 0.2) !important;
            color: var(--text-bright) !important;
        }
        .zenith-token-container .form-control::placeholder {
            font-size: 14px; letter-spacing: 1px; opacity: 0.5; font-weight: 600;
        }

        .action-container { text-align: center; margin-top: 40px; }
        .btn-zenith-start {
            min-width: 250px;
            padding: 18px 40px !important;
            font-size: 18px !important;
            border-radius: 50px !important;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: var(--primary-gradient) !important;
            box-shadow: 0 15px 30px rgba(var(--primary-rgb), 0.4) !important;
        }
        .btn-zenith-start:hover { transform: translateY(-3px) scale(1.02); }

        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
            .info-tile.full-width { grid-column: span 1; }
            .zenith-confirm-card { padding: 25px !important; }
        }
    </style>

    <section class="content">
        <?php echo form_open($url.'/mulai_tes', array('id' => 'form-konfirmasi-tes')); ?>
        <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
        
        <div class="zenith-confirm-card">
            <div class="confirm-header">
                <h2>Konfirmasi Otorisasi Ujian</h2>
                <p>Silahkan validasi data kredensial Anda sebelum memulai sesi</p>
            </div>

            <div id="form-pesan"></div>

            <div class="info-grid">
                <!-- Siswa Info -->
                <div class="info-tile">
                    <div class="info-icon"><i class="fa fa-user-secret"></i></div>
                    <div class="info-content">
                        <span class="label">Identitas Siswa</span>
                        <span class="value"><?php if(!empty($nama)){ echo $nama; } ?></span>
                    </div>
                </div>

                <!-- Waktu Info -->
                <div class="info-tile">
                    <div class="info-icon"><i class="fa fa-clock-o"></i></div>
                    <div class="info-content">
                        <span class="label">Alokasi Waktu</span>
                        <span class="value"><?php if(!empty($tes_waktu)){ echo $tes_waktu; } ?></span>
                    </div>
                </div>

                <!-- Ujian Info (Full Width) -->
                <div class="info-tile full-width">
                    <div class="info-icon"><i class="fa fa-graduation-cap"></i></div>
                    <div class="info-content">
                        <span class="label">Mata Uji Terdaftar</span>
                        <span class="value"><?php if(!empty($tes_nama)){ echo $tes_nama; } ?></span>
                    </div>
                </div>

                <!-- Poin Info (Secondary) -->
                <div class="info-tile" style="opacity: 0.8;">
                    <div class="info-icon"><i class="fa fa-trophy"></i></div>
                    <div class="info-content">
                        <span class="label">Skor Maksimal</span>
                        <span class="value">100.00 (Pro-rata)</span>
                    </div>
                </div>
            </div>

            <!-- Token Section Slot -->
            <?php if(!empty($tes_token)){ echo $tes_token; } ?>

            <div class="action-container">
                <button type="submit" id="btn-tambah-simpan" class="btn btn-primary btn-zenith-start">
                    MULAI SESI UJIAN <i class="fa fa-rocket" style="margin-left: 10px;"></i>
                </button>
            </div>
        </div>
        </form>
    </section>
</div>

<script type="text/javascript">
    $(function () {
        $('#form-konfirmasi-tes').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/mulai_tes",
                    type:"POST",
                    data:$('#form-konfirmasi-tes').serialize(),
                    cache: false,
                    timeout: 60000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html('');
                            window.open("<?php echo site_url(); ?>/tes_kerjakan/index/"+obj.tes_id, "_self");
                        }else if(obj.status==2){
                            window.open("<?php echo site_url().'/'.$url; ?>/", "_self");
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    statusCode: {
                        500: function(respon) {
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('Terjadi kesalahan pada persiapan Ujian. Silahkan hubungi petugas.'));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyiapkan Ujian, Halaman akan di Refresh !");
                            setInterval(function() {
                                window.location.reload();
                            }, 4000);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                            setInterval(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }
            });
            return false;
        });
    });
</script>