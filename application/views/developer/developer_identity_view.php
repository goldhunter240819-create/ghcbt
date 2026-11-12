<style>
    .row-flex-eq {
        display: flex;
        flex-wrap: wrap;
        margin-left: -12px;
        margin-right: -12px;
    }
    .row-flex-eq > [class*='col-'] {
        display: flex;
        flex-direction: column;
        padding-left: 12px;
        padding-right: 12px;
    }
    .row-flex-eq > [class*='col-'] > .elite-card {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
</style>

<!-- Grand Elite Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-sliders"></i>
        </div>
        <div>
            <h2>Identity Hub & Release Engine</h2>
            <p>Kelola identitas, versi rilis global, dan generator paket ZIP sistem otomatis.</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> DYNAMIC DNA ACTIVE
    </div>
</div>

<div class="row row-flex-eq">
    <!-- Left Column: Identity Configuration & Release Builder -->
    <div class="col-md-7">
        <div class="elite-card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                <h3 style="margin: 0; font-weight: 800; font-size: 16px; text-transform: uppercase; color: var(--text-main); display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-cogs" style="color: var(--gold-primary);"></i> Konfigurasi Versi Aplikasi
                </h3>
                <span class="badge" style="background: #fffbeb; color: var(--gold-primary); border: 1px solid #fde68a; font-weight: 700; padding: 4px 10px; border-radius: 10px;">CORE CONFIG</span>
            </div>
            
            <div id="form-pesan-identity"></div>
            <?php echo form_open('developer/save_identity', 'id="form-identity"'); ?>
                <div class="form-group" style="margin-bottom: 25px;">
                    <label style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 8px; display: block;">System Versioning (Versi Sistem)</label>
                    <input type="text" class="form-control elite-input" name="site_version" value="<?php echo $site_version; ?>" placeholder="Contoh: Elite Edition 2.7.0" required>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--border-light);">
                    <button type="submit" class="btn btn-gold-elite" id="btn-save-identity">
                        <i class="fa fa-save" style="margin-right: 6px;"></i> Simpan Versi Baru
                    </button>
                    <a href="<?php echo site_url('developer'); ?>" class="btn" style="background: #f1f5f9; color: var(--text-muted); border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 24px; font-weight: 700; font-size: 12px;">Batal</a>
                </div>
            <?php echo form_close(); ?>

            <!-- Release Builder Section -->
            <div style="margin-top: 30px; padding-top: 25px; border-top: 2px dashed var(--border-light);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <div>
                        <h4 style="margin: 0; font-weight: 800; color: var(--text-main); font-size: 15px; text-transform: uppercase;">
                            <i class="fa fa-archive" style="color: #059669; margin-right: 6px;"></i> Release Builder (ZIP Paket)
                        </h4>
                        <p style="margin: 4px 0 0; font-size: 12px; color: var(--text-muted);">Paketkan sistem menjadi arsip ZIP siap distribusi untuk pembeli.</p>
                    </div>
                    <button type="button" class="btn" id="btn-build-release" style="background: linear-gradient(135deg, #059669, #10b981); color: white; border: none; border-radius: 12px; padding: 10px 20px; font-weight: 700; font-size: 12px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                        <i class="fa fa-archive" style="margin-right: 6px;"></i> Build Release
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table elite-table">
                        <thead>
                            <tr>
                                <th>File Release</th>
                                <th>Size</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="release-history-body">
                            <!-- Data dimuat via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Explanations & Info Cards -->
    <div class="col-md-5">
        <div class="elite-card">
            <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 16px; padding: 22px; margin-bottom: 20px;">
                <h4 style="color: #92400e; font-weight: 900; font-size: 14px; margin: 0 0 10px 0; text-transform: uppercase; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-terminal"></i> Core Atomicity Sync
                </h4>
                <p style="color: #78350f; line-height: 1.6; font-size: 13px; margin: 0;">
                    Modifikasi di sini akan langsung merubah <b>DNA System</b> secara global. Konfigurasi akan di-injeksi ke file <code>config.php</code> dan <code>version.txt</code> secara atomik tanpa merusak struktur database.
                </p>
            </div>
            
            <div style="background: #f8fafc; border: 1px dashed var(--border-color); border-radius: 16px; text-align: center; padding: 30px 20px; margin-top: auto;">
                <div style="width: 50px; height: 50px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 22px; color: var(--gold-primary); margin-bottom: 15px;">
                    <i class="fa fa-shield"></i>
                </div>
                <h5 style="margin: 0 0 8px; font-weight: 800; color: var(--text-main);">Dynamic Node Isolation</h5>
                <p style="color: var(--text-muted); font-style: italic; font-size: 12px; margin: 0; line-height: 1.6;">
                    "App Identity has been forced into dynamic mode. Hardcoded locks are now secondary."
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        // Load Release History
        function loadReleases(){
            $.getJSON("<?php echo site_url('developer/get_releases'); ?>", function(data){
                var html = '';
                if(data.status == 1 && data.releases.length > 0){
                    $.each(data.releases, function(i, item){
                        html += '<tr>';
                        html += '<td><div style="font-weight:700; color:var(--text-main);">' + item.filename + '</div>';
                        html += '<div style="font-size:10px; color:var(--text-muted);">Built on ' + item.date + '</div></td>';
                        html += '<td style="vertical-align:middle; font-weight:600; color:var(--text-muted);">' + item.size + '</td>';
                        html += '<td style="vertical-align:middle; text-align:center;">';
                        html += '<div style="display:flex; gap:6px; justify-content:center;">';
                        html += '<a href="' + item.download_url + '" class="btn btn-xs" style="background:#059669; color:#fff; border-radius:8px; padding:6px 12px; font-weight:700;"><i class="fa fa-download"></i> Unduh</a>';
                        html += '<a href="' + item.delete_url + '" class="btn btn-xs" style="background:#ef4444; color:#fff; border-radius:8px; padding:6px 10px; font-weight:700;" onclick="return confirm(\'Hapus release ini?\')"><i class="fa fa-trash"></i></a>';
                        html += '</div></td></tr>';
                    });
                } else {
                    html = '<tr><td colspan="3" align="center" style="padding: 30px; color:var(--text-muted); font-size:12px;">Belum ada arsip release yang dibuat.</td></tr>';
                }
                $("#release-history-body").html(html);
            });
        }
        loadReleases();

        // Build Release Action
        $("#btn-build-release").click(function(){
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Building ZIP...');
            $.getJSON("<?php echo site_url('developer/build_release'); ?>", function(res){
                btn.prop('disabled', false).html('<i class="fa fa-archive"></i> Build Release');
                if(res.status == 1){
                    alert(res.pesan);
                    loadReleases();
                } else {
                    alert('Gagal: ' + res.pesan);
                }
            });
        });

        // Save Identity Form
        $("#form-identity").submit(function(e){
            e.preventDefault();
            var btn = $("#btn-save-identity");
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            $.post($(this).attr('action'), $(this).serialize(), function(res){
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Versi Baru');
                var data = JSON.parse(res);
                if(data.status == 1){
                    $("#form-pesan-identity").html('<div class="alert alert-success" style="border-radius:12px; padding:12px 18px; margin-bottom:20px; font-weight:600;"><i class="fa fa-check-circle" style="margin-right:6px;"></i> ' + data.pesan + '</div>');
                } else {
                    $("#form-pesan-identity").html('<div class="alert alert-danger" style="border-radius:12px; padding:12px 18px; margin-bottom:20px; font-weight:600;"><i class="fa fa-warning" style="margin-right:6px;"></i> ' + data.error + '</div>');
                }
            });
        });
    });
</script>
