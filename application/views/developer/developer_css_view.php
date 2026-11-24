<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-magic"></i>
        </div>
        <div>
            <h2>Design Studio &bull; Theme Injector</h2>
            <p>Injeksi CSS Kustom Dinamis ke Seluruh Antarmuka Sistem CBT (Admin, Guru, Siswa)</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> CSS ENGINE ACTIVE
    </div>
</div>

<section class="content" style="padding: 0;">
    <div class="row">
        <div class="col-xs-12">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light); flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-paint-brush" style="color: var(--gold-primary);"></i> Global Style Override
                        </h3>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 12px;">Aturan styling langsung disimpan ke berkas CSS kustom publik</p>
                    </div>
                    <button class="btn btn-gold-elite" id="btn-save-css">
                        <i class="fa fa-bolt" style="margin-right: 6px;"></i> Push CSS Changes
                    </button>
                </div>

                <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 14px; padding: 18px; color: #92400e; font-size: 13px; margin-bottom: 20px; line-height: 1.6;">
                    <i class="fa fa-info-circle" style="color: #b45309; margin-right: 8px; font-size: 15px;"></i>
                    Aturan CSS yang Anda tulis di bawah ini akan diinjeksi langsung ke tag <code>&lt;style&gt;</code> di seluruh bagian aplikasi (<strong>Admin, Siswa, & Pengawas</strong>) sebagai identitas visual dasar.
                </div>

                <textarea id="css-editor" class="form-control" style="min-height: 480px; font-family: 'JetBrains Mono', 'Consolas', monospace; line-height: 1.7; font-size: 13px; background: #0f172a !important; color: #fbbf24 !important; border: 1px solid #334155; border-radius: 14px; padding: 20px;" placeholder="/* Tulis aturan CSS kustom di sini... */"><?php echo $css_content; ?></textarea>
                
                <div style="margin-top: 15px; display: flex; align-items: center; justify-content: space-between;">
                    <span style="color: #64748b; font-size: 12px; font-weight: 700;"><i class="fa fa-keyboard-o" style="margin-right: 4px;"></i> Tab key indent support aktif</span>
                    <span style="color: var(--gold-primary); font-size: 12px; font-weight: 800;"><i class="fa fa-code"></i> CSS ENGINE V3</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#btn-save-css').click(function(){
            var css = $('#css-editor').val();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            
            $.post('<?php echo site_url("developer/save_css"); ?>', {css_content: css}, function(respon){
                btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Push CSS Changes');
                var obj = $.parseJSON(respon);
                if(obj.status == 1){
                    notify_success(obj.pesan);
                }else{
                    notify_error(obj.pesan);
                }
            });
        });
        
        // Tab key support in textarea
        $('#css-editor').keydown(function(e) {
            if(e.keyCode === 9) {
                var start = this.selectionStart;
                var end = this.selectionEnd;
                var target = $(this);
                var value = target.val();
                target.val(value.substring(0, start) + "    " + value.substring(end));
                this.selectionStart = this.selectionEnd = start + 4;
                e.preventDefault();
            }
        });
    });
</script>