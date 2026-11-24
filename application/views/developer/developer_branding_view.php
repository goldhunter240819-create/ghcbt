<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-paint-brush"></i>
        </div>
        <div>
            <h2>Suite Branding</h2>
            <p>Manajemen Logo Pusat Developer Suite & Sinkronisasi Real-time Favicon Tab</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> BRANDING SYNCED
    </div>
</div>

<section class="content" style="padding: 0;">
    <div class="row">
        <!-- Developer Logo & Favicon Unified Control -->
        <div class="col-md-8 col-md-offset-2">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <div>
                        <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase;">Central Branding Logo</h3>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">Logo ini akan digunakan sebagai identitas Sidebar sekaligus Icon Tab Browser.</p>
                    </div>
                </div>

                <div style="background: #f8fafc; border-radius: 18px; padding: 40px; text-align: center; border: 2px dashed var(--border-color); position: relative; margin-bottom: 25px;">
                    <div style="position: absolute; top: 12px; left: 16px; font-size: 10px; color: #64748b; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">Visual Preview</div>
                    <img id="preview-logo" src="<?php echo base_url().$dev_logo; ?>?t=<?php echo time(); ?>" style="max-height: 100px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));" />
                </div>

                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <input type="file" id="file-logo" style="display:none;" accept="image/*">
                    <button class="btn btn-gold-elite" style="width: 100%; padding: 15px !important; font-size: 13px !important;" onclick="$('#file-logo').click()">
                        <i class="fa fa-cloud-upload" style="margin-right: 6px;"></i> Upload & Sinkronkan Branding
                    </button>
                    
                    <div id="progress-logo" style="display:none;">
                        <div class="progress" style="height: 8px; background: #e2e8f0; border-radius: 10px; margin: 0;">
                            <div class="progress-bar" style="background: var(--primary-gradient); width: 0%; transition: width 0.3s ease;"></div>
                        </div>
                        <p style="text-align: center; font-size: 11px; color: var(--gold-primary); margin-top: 8px; font-weight: 800; letter-spacing: 0.5px;">MENGUNGGAH & MENGOPTIMASI ASET...</p>
                    </div>
                </div>
            </div>

            <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 18px; padding: 22px; margin-top: 20px;">
                <h4 style="color: #92400e; font-weight: 800; font-size: 14px; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-refresh" style="color: #b45309;"></i> Unified Sync Protocol
                </h4>
                <p style="color: #78350f; line-height: 1.6; font-size: 13px; margin: 0;">
                    Untuk efisiensi, gambar yang Anda unggah di sini akan secara otomatis dijadikan sebagai <strong>Favicon (Icon Tab)</strong> dan Logo Sidebar. Sistem akan memperbarui tampilan visual secara instan pada sidebar dan tab browser setelah proses unggah selesai.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#file-logo').change(function(){
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('image_file', file_data);
            form_data.append('type', 'logo');

            $('#progress-logo').fadeIn().find('.progress-bar').css('width', '0%');

            $.ajax({
                url: "<?php echo site_url('developer/save_branding'); ?>",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                            $('#progress-logo').find('.progress-bar').css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(respon){
                    $('#progress-logo').delay(400).fadeOut();
                    
                    try {
                        var obj = $.parseJSON(respon);
                        if(obj.status == 1){
                            notify_success(obj.pesan);
                            var timestamp = new Date().getTime();
                            var newSrc = $('#preview-logo').attr('src').split('?')[0] + '?t=' + timestamp;
                            
                            // Update Visual Sidebar Preview
                            $('#preview-logo').attr('src', newSrc);
                            
                            // Sync Sidebar Logo Real-time
                            $('.sidebar-branding img').attr('src', newSrc);
                            
                            // Sync Browser Favicon Real-time
                            $('link[rel="icon"]').attr('href', newSrc);
                            
                        } else {
                            notify_error(obj.pesan);
                        }
                    } catch(e) {
                        notify_error('Respon server tidak valid.');
                    }
                },
                error: function(){
                    $('#progress-logo').hide();
                    notify_error('Koneksi terputus saat mengunggah aset.');
                }
            });
        });
    });
</script>