<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Suite Branding</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Isolated Visual Identity</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <!-- Developer Logo & Favicon Unified Control -->
        <div class="col-md-8 col-md-offset-2">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <div>
                        <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase;">Central Branding Logo</h3>
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">Logo ini akan digunakan sebagai identitas Sidebar sekaligus Icon Tab Browser.</p>
                    </div>
                </div>

                <div style="background: rgba(2, 6, 23, 0.4); border-radius: 24px; padding: 60px; text-align: center; border: 2px dashed rgba(245, 158, 11, 0.2); position: relative; margin-bottom: 35px;">
                    <div style="position: absolute; top: 15px; left: 20px; font-size: 9px; color: rgba(245, 158, 11, 0.5); font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">Visual Preview</div>
                    <img id="preview-logo" src="<?php echo base_url().$dev_logo; ?>?t=<?php echo time(); ?>" style="max-height: 120px; filter: drop-shadow(0 0 30px rgba(245, 158, 11, 0.4));" />
                </div>

                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="file" id="file-logo" style="display:none;" accept="image/*">
                    <button class="btn btn-gold-elite" style="width: 100%; padding: 20px !important; font-size: 13px !important;" onclick="$('#file-logo').click()">
                        <i class="fa fa-cloud-upload"></i> Upload & Sync Branding
                    </button>
                    
                    <div id="progress-logo" style="display:none;">
                        <div class="progress" style="height: 6px; background: rgba(255,255,255,0.05); border-radius: 10px; margin: 0;">
                            <div class="progress-bar" style="background: var(--gold-gradient); width: 0%; transition: width 0.3s ease;"></div>
                        </div>
                        <p style="text-align: center; font-size: 10px; color: var(--gold-primary); margin-top: 10px; font-weight: 800; letter-spacing: 1px;">OPTIMIZING ASSETS...</p>
                    </div>
                </div>
            </div>

            <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 24px; padding: 30px; box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.05); margin-top: 30px;">
                <h4 style="color: var(--gold-primary); font-weight: 900; font-size: 14px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;"><i class="fa fa-refresh"></i> Unified Sync Protocol</h4>
                <p style="color: #94a3b8; line-height: 1.8; font-size: 13px; margin: 0;">
                    Untuk efisiensi, gambar yang Anda unggah di sini akan secara otomatis ditarik sebagai <b class="gold-text">Favicon (Icon Tab)</b>. Sistem Zenith akan meluncurkan pembaruan visual secara instan pada Sidebar dan Tab Browser Anda setelah proses sinkronisasi selesai.
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
            $("#modal-proses").modal('show');

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
                    $("#modal-proses").modal('hide');
                    $('#progress-logo').delay(500).fadeOut();
                    
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
                    } catch(e) { notify_error('Respon sistem tidak valid.'); }
                },
                error: function(){
                    $("#modal-proses").modal('hide');
                    $('#progress-logo').hide();
                    notify_error('Gagal melakukan sinkronisasi branding.');
                }
            });
        });
    });
</script>
