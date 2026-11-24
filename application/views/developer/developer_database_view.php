<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-database"></i>
        </div>
        <div>
            <h2>Database Forge</h2>
            <p>Storage Node Manipulation & Point-in-Time Recovery System</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> ENGINE HEALTHY
    </div>
</div>

<section class="content" style="padding: 0;">
    <div class="row row-flex-eq">
        <!-- Database Stats & Health -->
        <div class="col-md-8">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                    <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 10px;">
                        <i class="fa fa-server" style="color: var(--gold-primary);"></i> Status Skema Penyimpanan
                    </h3>
                    <span style="background: #ecfdf5; color: #059669; padding: 5px 14px; border-radius: 12px; font-size: 11px; font-weight: 800; border: 1px solid #a7f3d0;">HEALTHY</span>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 16px; padding: 18px; text-align: center;">
                            <div style="font-size: 11px; color: #92400e; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 6px;">Total Tabel</div>
                            <div style="font-size: 30px; font-weight: 900; color: #b45309; line-height: 1;"><?php echo count($tables); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="background: #f8fafc; border: 1px solid var(--border-light); border-radius: 16px; padding: 18px; text-align: center;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 6px;">Engine Node</div>
                            <div style="font-size: 22px; font-weight: 900; color: #0f172a; line-height: 1.3;">InnoDB</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 16px; padding: 18px; text-align: center;">
                            <div style="font-size: 11px; color: #065f46; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 6px;">Status Koneksi</div>
                            <div style="font-size: 22px; font-weight: 900; color: #059669; line-height: 1.3;">Online</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <h5 style="color: #475569; font-weight: 800; margin-bottom: 15px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Topologi Tabel Database</h5>
                    <div style="max-height: 320px; overflow-y: auto; border: 1px solid var(--border-light); border-radius: 14px; padding: 5px;">
                        <table class="table elite-table" style="margin: 0;">
                            <thead>
                                <tr>
                                    <th>Nama Objek / Tabel</th>
                                    <th style="text-align: right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tables as $table): ?>
                                <tr>
                                    <td style="padding: 12px 15px; font-size: 13px; font-weight: 700; color: #0f172a;">
                                        <i class="fa fa-database" style="color: var(--gold-primary); margin-right: 12px;"></i> <?php echo $table; ?>
                                    </td>
                                    <td style="padding: 12px 15px; text-align: right;">
                                        <span style="background: #ecfdf5; color: #059669; padding: 3px 10px; border-radius: 8px; font-size: 10px; font-weight: 800;">ACTIVE</span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Snapshot + Danger Zone -->
        <div class="col-md-4">
            <!-- Quick Snapshot Creator -->
            <div class="elite-card" style="margin-bottom: 20px;">
                <div style="display: flex; align-items: center; margin-bottom: 18px; border-left: 4px solid #0891b2; padding-left: 14px;">
                    <div>
                        <h4 style="color: #0891b2; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                            <i class="fa fa-camera" style="margin-right: 6px;"></i> Quick Snapshot
                        </h4>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">Backup instan sebelum oprek sistem</p>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 15px;">
                    <input type="text" id="snap-label" class="form-control elite-input" placeholder="Label (opsional, e.g. pre-update)" style="border-radius: 10px 0 0 10px !important;">
                    <span class="input-group-btn">
                        <button class="btn" id="btn-create-snap" style="background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; font-weight: 900; border-radius: 0 10px 10px 0; padding: 11px 18px; border: none; height: 100%; transition: all 0.3s ease;">
                            <i class="fa fa-bolt"></i> Go
                        </button>
                    </span>
                </div>
                <div id="snap-status"></div>
            </div>

            <!-- Danger Zone -->
            <div class="elite-card" style="border: 1px solid #fecdd3 !important;">
                <h4 style="color: #dc2626; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; margin: 0 0 18px 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-warning"></i> Danger Zone
                </h4>
                <div style="background: #fef2f2; padding: 18px; border-radius: 14px; border-left: 4px solid #ef4444; margin-bottom: 18px;">
                    <h5 style="color: #991b1b; font-weight: 800; margin: 0 0 6px 0; font-size: 13px;">Deep Reset Exam Data</h5>
                    <p style="color: #b91c1c; font-size: 12px; line-height: 1.6; margin: 0;">
                        Aksi ini akan menghapus seluruh rekaman jawaban, nilai, dan log aktivitas ujian secara permanen.
                    </p>
                </div>
                <button class="btn btn-block" id="btn-nuke-data" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; font-weight: 800; border-radius: 12px; padding: 12px; border: none; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fa fa-bolt" style="margin-right: 6px;"></i> Nuke Exam Data
                </button>
                <p style="text-align: center; color: #94a3b8; font-size: 11px; margin-top: 12px; margin-bottom: 0; font-style: italic;">"Tindakan ini permanen & tidak dapat dibatalkan."</p>
            </div>
        </div>
    </div>

    <!-- SNAPSHOT NODE PANEL -->
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <div class="elite-card" id="snapshot-panel">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light); flex-wrap: wrap; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 45px; height: 45px; border-radius: 14px; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                            <i class="fa fa-history" style="font-size: 18px; color: white;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-weight: 900; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px;">Snapshot Registry</h3>
                            <p style="margin: 3px 0 0; font-size: 12px; color: #64748b; font-weight: 600;">Point-in-Time Recovery & Cadangan Database</p>
                        </div>
                    </div>
                    <button class="btn btn-gold-elite" id="btn-refresh-snaps" style="padding: 8px 18px !important; font-size: 11px !important;">
                        <i class="fa fa-refresh" style="margin-right: 5px;"></i> Segarkan Daftar
                    </button>
                </div>

                <!-- Snapshot List -->
                <div id="snapshot-list-container">
                    <div class="text-center" style="padding: 40px; color: #64748b;">
                        <i class="fa fa-circle-o-notch fa-spin" style="font-size: 26px; margin-bottom: 12px; display: block; color: var(--gold-primary);"></i>
                        Memuat data snapshot...
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(function(){
    // === CREATE SNAPSHOT ===
    $('#btn-create-snap').click(function(){
        var btn = $(this);
        var label = $('#snap-label').val() || 'snap';
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $('#snap-status').html('<div style="color: #0891b2; font-size: 12px; text-align:center; padding: 8px;"><i class="fa fa-circle-o-notch fa-spin"></i> Membuat snapshot...</div>');

        $.post('<?php echo site_url("developer/create_snapshot"); ?>', {label: label}, function(res){
            btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Go');
            if(res.status == 1){
                notify_success(res.pesan);
                $('#snap-status').html('<div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 10px; margin-top: 5px; color: #059669; font-size: 12px; font-weight: 700;"><i class="fa fa-check-circle"></i> ' + res.pesan + '</div>');
                $('#snap-label').val('');
                loadSnapshots();
                $(document).trigger('ghcbt:snapshot-created', [res.size]);
            } else {
                notify_error(res.pesan);
                $('#snap-status').html('<div style="background: #fef2f2; border: 1px solid #fecdd3; border-radius: 10px; padding: 10px; margin-top: 5px; color: #dc2626; font-size: 12px; font-weight: 700;"><i class="fa fa-times-circle"></i> ' + res.pesan + '</div>');
            }
        }, 'json').fail(function(){
            btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Go');
            notify_error('Gagal menghubungi server');
        });
    });

    // === LOAD SNAPSHOTS ===
    function loadSnapshots(){
        $.getJSON('<?php echo site_url("developer/get_snapshots"); ?>', function(res){
            if(!res.status || res.snapshots.length === 0){
                $('#snapshot-list-container').html(
                    '<div class="text-center" style="padding: 40px; color: #94a3b8;">' +
                    '<i class="fa fa-archive" style="font-size: 36px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>' +
                    'Belum ada snapshot database yang dibuat. Klik <b>Go</b> di atas untuk membuat snapshot pertama.' +
                    '</div>'
                );
                return;
            }
            var html = '<table class="table elite-table">';
            html += '<thead><tr><th>Label / Waktu</th><th>Ukuran</th><th>Checksum</th><th style="text-align:right;">Aksi</th></tr></thead><tbody>';
            $.each(res.snapshots, function(i, s){
                html += '<tr>';
                html += '<td><div style="font-weight: 700; color: #0f172a;"><i class="fa fa-file-archive-o" style="color: var(--gold-primary); margin-right: 8px;"></i>' + s.filename + '</div><div style="font-size: 11px; color: #64748b;">' + s.date + '</div></td>';
                html += '<td style="font-weight: 600; color: #475569;">' + s.size_formatted + '</td>';
                html += '<td><code style="background: #f1f5f9; color: #b45309; padding: 2px 6px; border-radius: 4px; font-size: 11px;">' + s.checksum.substring(0, 12) + '...</code></td>';
                html += '<td style="text-align: right;">';
                html += '<a href="<?php echo site_url("developer/download_snapshot"); ?>/' + s.filename + '" class="btn btn-xs" style="background: #0284c7; color: white; border-radius: 8px; padding: 6px 12px; margin-right: 5px; font-weight: 700;"><i class="fa fa-download"></i> Unduh</a>';
                html += '<button class="btn btn-xs btn-restore-snap" data-file="' + s.filename + '" style="background: #b45309; color: white; border-radius: 8px; padding: 6px 12px; margin-right: 5px; font-weight: 700;"><i class="fa fa-undo"></i> Restore</button>';
                html += '<button class="btn btn-xs btn-del-snap" data-file="' + s.filename + '" style="background: #ef4444; color: white; border-radius: 8px; padding: 6px 10px; font-weight: 700;"><i class="fa fa-trash"></i></button>';
                html += '</td>';
                html += '</tr>';
            });
            html += '</tbody></table>';
            $('#snapshot-list-container').html(html);
        });
    }

    loadSnapshots();
    $('#btn-refresh-snaps').click(loadSnapshots);

    // === RESTORE SNAPSHOT ===
    $(document).on('click', '.btn-restore-snap', function(){
        var file = $(this).data('file');
        if(!confirm('PERINGATAN: Memulihkan snapshot "' + file + '" akan MENIMPA seluruh database saat ini!\n\nLanjutkan?')) return;
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.post('<?php echo site_url("developer/restore_snapshot"); ?>', {filename: file}, function(res){
            btn.prop('disabled', false).html('<i class="fa fa-undo"></i> Restore');
            if(res.status == 1){
                notify_success(res.pesan);
                setTimeout(function(){ location.reload(); }, 1500);
            } else {
                notify_error(res.pesan);
            }
        }, 'json');
    });

    // === DELETE SNAPSHOT ===
    $(document).on('click', '.btn-del-snap', function(){
        var file = $(this).data('file');
        if(!confirm('Hapus snapshot "' + file + '"?')) return;
        $.post('<?php echo site_url("developer/delete_snapshot"); ?>', {filename: file}, function(res){
            if(res.status == 1){
                notify_success(res.pesan);
                loadSnapshots();
            } else {
                notify_error(res.pesan);
            }
        }, 'json');
    });

    // === NUKE EXAM DATA ===
    $('#btn-nuke-data').click(function(){
        if(!confirm('KONFIRMASI TERAKHIR: Anda yakin ingin menghapus SEMUA hasil ujian, nilai, jawaban siswa, dan log aktivitas?\n\nData tidak dapat dikembalikan!')) return;
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mereset data...');
        $.post('<?php echo site_url("developer/nuke_exam_data"); ?>', {}, function(res){
            btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Nuke Exam Data');
            if(res.status == 1){
                notify_success(res.pesan);
            } else {
                notify_error(res.pesan);
            }
        }, 'json');
    });
});
</script>
