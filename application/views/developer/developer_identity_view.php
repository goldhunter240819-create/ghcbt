<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Identity Hub</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Override Application Brain DNA</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <div class="col-md-7">
            <div class="elite-card">
                <div style="display: flex; align-items: center; margin-bottom: 35px; border-left: 4px solid #f59e0b; padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Identity Configuration</h3>
                </div>
                
                <div id="form-pesan-identity"></div>
                <?php echo form_open('developer/save_identity', 'id="form-identity"'); ?>

                    
                    <div class="form-group" style="margin-bottom: 35px;">
                        <label style="color: rgba(245, 158, 11, 0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900; margin-bottom: 12px; display: block;">System Versioning</label>
                        <input type="text" class="form-control elite-input" name="site_version" value="<?php echo $site_version; ?>" placeholder="Version Name (e.g. Elite 3.0)" style="padding: 25px 20px !important; font-size: 15px !important; font-weight: 600 !important;">
                    </div>

                    <div style="display: flex; gap: 15px; margin-top: 40px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
                        <button type="submit" class="btn btn-gold-elite" id="btn-save-identity">
                            <i class="fa fa-save"></i> Pulse Update
                        </button>
                        <a href="<?php echo site_url('developer'); ?>" class="btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 15px 30px; font-weight: 700;">Cancel</a>
                    </div>
                <?php echo form_close(); ?>
            </div>

            <!-- Release Builder Section -->
            <div class="elite-card" style="margin-top: 30px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-left: 4px solid #10b981; padding-left: 20px;">
                    <div>
                        <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase;">Release Builder</h3>
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">Paketkan sistem menjadi ZIP siap distribusi.</p>
                    </div>
                    <button type="button" class="btn" id="btn-build-release" style="background: #10b981; color: white; border-radius: 12px; padding: 12px 25px; font-weight: 700;">
                        <i class="fa fa-archive"></i> Build Release
                    </button>
                </div>

                <div class="table-responsive">
                    <style>
                        * {
                            -ms-overflow-style: none !important; /* IE and Edge */
                            scrollbar-width: none !important; /* Firefox */
                        }
                        *::-webkit-scrollbar {
                            display: none !important; /* Chrome, Safari and Opera */
                        }
                    </style>
                    <table class="table elite-table">
                        <thead>
                            <tr>
                                <th>File Release</th>
                                <th>Size</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="release-history-body">
                            <!-- Data dimuat via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid var(--gold-primary); border-radius: 24px; padding: 30px; box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.1);">
                <h4 style="color: var(--gold-primary); font-weight: 900; font-size: 16px; margin-bottom: 20px;"><i class="fa fa-terminal"></i> Core Syncing</h4>
                <p style="color: #94a3b8; line-height: 1.7; font-size: 14px;">Modifikasi di sini akan langsung merubah <b class="gold-text">DNA System</b> secara global. Konfigurasi akan di-injeksi ke file <code>config.php</code> dan <code>version.txt</code> secara atomik.</p>
            </div>
            
            <div class="elite-card" style="margin-top: 30px; text-align: center; padding: 40px; border-style: dashed !important;">
                <i class="fa fa-shield" style="font-size: 60px; color: var(--gold-primary); opacity: 0.2; margin-bottom: 25px;"></i>
                <p style="color: #64748b; font-style: italic; font-size: 13px;">"App Identity has been forced into dynamic mode. <span class="gold-text">Hardcoded locks</span> are now secondary."</p>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        // Load Release History
        function loadReleases(){
            $.getJSON("<?php echo site_url('developer/get_releases'); ?>", function(data){
                var html = '';
                if(data.status == 1 && data.releases.length > 0){
                    $.each(data.releases, function(i, item){
                        html += '<tr style="border-bottom: 1px solid rgba(255,255,255,0.02);">';
                        html += '<td style="border:none; padding:15px 8px;">';
                        html += '<div style="font-weight:700; color:#f1f5f9;">' + item.filename + '</div>';
                        html += '<div style="font-size:10px; color:#64748b;">Built on ' + item.date + '</div></td>';
                        html += '<td style="border:none; vertical-align:middle;">' + item.size + '</td>';
                        html += '<td style="border:none; vertical-align:middle; text-align:center;">';
                        html += '<div style="display:flex; gap:8px; justify-content:center;">';
                        html += '<a href="<?php echo site_url('developer/download_release'); ?>/' + item.encoded_filename + '" class="btn btn-xs" style="background:rgba(16, 185, 129, 0.1); color:#10b981; border:1px solid rgba(16,185,129,0.3);"><i class="fa fa-download"></i></a>';
                        html += '<button type="button" class="btn btn-xs btn-delete-release" data-file="' + item.filename + '" style="background:rgba(244, 63, 94, 0.1); color:#f43f5e; border:1px solid rgba(244,63,94,0.3);"><i class="fa fa-trash"></i></button>';
                        html += '</div></td></tr>';
                    });
                } else {
                    html = '<tr><td colspan="3" style="text-align:center; padding:30px; color:#64748b; border:none;">No builds found.</td></tr>';
                }
                $('#release-history-body').html(html);
            });
        }
        loadReleases();

        // Build Release Process
        var buildInterval;
        $('#btn-build-release').click(function(){
            $("#build-progress-bar").css('width', '0%');
            $("#build-progress-text").text('0% COMPLETION');
            $("#build-progress-container").show();
            $("#modal-divider").hide();
            $("#modal-proses").modal('show');

            // Polling Progress
            buildInterval = setInterval(function(){
                $.getJSON("<?php echo site_url('developer/get_build_progress'); ?>", function(res){
                    if(res.percent){
                        var p = res.percent + '%';
                        $("#build-progress-bar").css('width', p);
                        $("#build-progress-text").text(p + ' COMPLETION');
                    }
                });
            }, 800);

            $.ajax({
                url:"<?php echo site_url('developer/build_release'); ?>",
                type:"POST",
                cache: false,
                success:function(respon){
                    clearInterval(buildInterval);
                    $("#modal-proses").modal('hide');
                    $("#build-progress-container").hide();
                    $("#modal-divider").show();
                    
                    try {
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            Swal.fire('Success!', obj.pesan, 'success');
                            loadReleases();
                        } else {
                            Swal.fire('Error!', obj.pesan, 'error');
                        }
                    } catch(e) { Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error'); }
                },
                error:function(){ 
                    clearInterval(buildInterval);
                    $("#modal-proses").modal('hide'); 
                    $("#build-progress-container").hide();
                    $("#modal-divider").show();
                    Swal.fire('Error!', 'Gagal terhubung ke server.', 'error'); 
                }
            });
        });

        // Delete Release
        $(document).on('click', '.btn-delete-release', function(){
            var file = $(this).data('file');
            Swal.fire({
                title: 'Hapus build ini?',
                text: "File ZIP akan dihapus selamanya dari server.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?php echo site_url('developer/delete_release'); ?>",
                        type:"POST",
                        data: {filename: file},
                        success:function(){ loadReleases(); }
                    });
                }
            });
        });

        $('#form-identity').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                url:"<?php echo site_url('developer/save_identity'); ?>",
                type:"POST",
                data:$('#form-identity').serialize(),
                cache: false,
                success:function(respon){
                    $("#modal-proses").modal('hide'); // Tutup modal duluan agar tidak nyangkut
                    try {
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $('#form-pesan-identity').html(pesan_succ(obj.pesan));
                            setTimeout(function(){ location.reload(); }, 1500);
                        }else{
                            $('#form-pesan-identity').html(pesan_err(obj.pesan));
                        }
                    } catch(e) {
                        console.error("JSON Parse Error:", respon);
                        $('#form-pesan-identity').html(pesan_err("Terjadi kesalahan teknis saat membaca respon server."));
                    }
                },
                error:function(){
                    $("#modal-proses").modal('hide');
                    $('#form-pesan-identity').html(pesan_err("Gagal terhubung ke server."));
                }
            });
            return false;
        });
    });
</script>
