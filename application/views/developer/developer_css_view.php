<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Theme Injector</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Override Application Visual DNA</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Global Style Override</h3>
                    <button class="btn btn-gold-elite" id="btn-save-css">
                        <i class="fa fa-bolt"></i> Push Changes
                    </button>
                </div>

                <div style="background: rgba(245, 158, 11, 0.03); border: 2px solid var(--gold-primary); border-radius: 16px; padding: 25px; color: #94a3b8; font-size: 13px; margin-bottom: 25px; line-height: 1.8; box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.05);">
                    <i class="fa fa-info-circle" style="color: var(--gold-primary); margin-right: 15px; font-size: 16px;"></i>
                    Aturan CSS yang Anda tulis di bawah ini akan diinjeksi langsung ke tag <code>&lt;style&gt;</code> di seluruh bagian aplikasi (<b class="gold-text">Admin, Siswa, & Tes</b>) sebagai identitas visual dasar.
                </div>

                <textarea id="css-editor" class="form-control elite-input" style="min-height: 500px; font-family: 'JetBrains Mono', 'Fira Code', monospace; line-height: 1.8; font-size: 14px; background: #000 !important; color: #fbbf24 !important;" placeholder="/* Injeksi DNA Visual Baru Anda di Sini... */"><?php echo $css_content; ?></textarea>
                
                <div style="margin-top: 25px; display: flex; align-items: center; gap: 20px;">
                    <span style="color: rgba(245, 158, 11, 0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;"><i class="fa fa-keyboard-o"></i> Tab support enabled</span>
                    <span style="color: rgba(245, 158, 11, 0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;"><i class="fa fa-code"></i> Elite DNA V3.0</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#btn-save-css').click(function(){
            var css = $('#css-editor').val();
            
            $("#modal-proses").modal('show');
            $.post('<?php echo site_url("developer/save_css"); ?>', {css_content: css}, function(respon){
                var obj = $.parseJSON(respon);
                if(obj.status == 1){
                    notify_success(obj.pesan);
                }else{
                    notify_error(obj.pesan);
                }
                $("#modal-proses").modal('hide');
            });
        });
        
        // Tab key support in textarea
        $('#css-editor').keydown(function(e) {
            if(e.keyCode === 9) { // tab was pressed
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
