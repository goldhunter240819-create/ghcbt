<section class="content-header" style="padding: 35px 35px 10px 35px;">
    <h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
        <span class="gold-text">Database Forge</span>
        <small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Storage Node Manipulation</small>
    </h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <!-- Database Stats & Health -->
        <div class="col-md-8">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Storage Schema Status</h3>
                    <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 5px 15px; border-radius: 10px; font-size: 10px; font-weight: 900; border: 1px solid rgba(16, 185, 129, 0.2);">HEALTHY</span>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 20px; padding: 20px; text-align: center;">
                            <div style="font-size: 10px; color: rgba(245, 158, 11, 0.6); text-transform: uppercase; letter-spacing: 2px; font-weight: 900; margin-bottom: 10px;">Total Tables</div>
                            <div style="font-size: 32px; font-weight: 900; color: var(--gold-primary); text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);"><?php echo count($tables); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 20px; padding: 20px; text-align: center;">
                            <div style="font-size: 10px; color: rgba(245, 158, 11, 0.6); text-transform: uppercase; letter-spacing: 2px; font-weight: 900; margin-bottom: 10px;">Engine Node</div>
                            <div style="font-size: 22px; font-weight: 900; color: #f8fafc; margin-top: 5px;">InnoDB</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.2); border-radius: 20px; padding: 20px; text-align: center;">
                            <div style="font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Brain Pulse</div>
                            <div style="font-size: 22px; font-weight: 900; color: #10b981; margin-top: 5px;">Online</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px;">
                    <h5 style="color: #cbd5e1; font-weight: 700; margin-bottom: 20px; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">Table Topology</h5>
                    <div style="max-height: 320px; overflow-y: auto;">
                        <table class="table elite-table">
                            <thead>
                                <tr>
                                    <th>Object Identity</th>
                                    <th style="text-align: right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tables as $table): ?>
                                <tr>
                                    <td style="padding: 15px; font-size: 13px; font-weight: 600;">
                                        <i class="fa fa-database" style="color: var(--gold-primary); margin-right: 15px;"></i> <?php echo $table; ?>
                                    </td>
                                    <td style="padding: 12px; text-align: right;">
                                        <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 2px 8px; border-radius: 6px; font-size: 9px; font-weight: 800;">ACTIVE</span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Danger Zone + Snapshot Create -->
        <div class="col-md-4">
            <!-- Quick Snapshot Creator -->
            <div class="elite-card" style="margin-bottom: 20px;">
                <div style="display: flex; align-items: center; margin-bottom: 20px; border-left: 4px solid var(--zenith-cyan, #06b6d4); padding-left: 15px;">
                    <div>
                        <h4 style="color: var(--zenith-cyan, #06b6d4); font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                            <i class="fa fa-camera"></i> Quick Snapshot
                        </h4>
                        <p style="margin: 4px 0 0 0; font-size: 11px; color: #64748b;">Backup instan sebelum oprek</p>
                    </div>
                </div>
                <div class="input-group" style="margin-bottom: 15px;">
                    <input type="text" id="snap-label" class="form-control elite-input" placeholder="Label (opsional, e.g. pre-update)" style="border-radius: 10px 0 0 10px !important;">
                    <span class="input-group-btn">
                        <button class="btn" id="btn-create-snap" style="background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; font-weight: 900; border-radius: 0 10px 10px 0; padding: 10px 18px; border: none; height: 100%; transition: all 0.3s ease;">
                            <i class="fa fa-bolt"></i> Go
                        </button>
                    </span>
                </div>
                <div id="snap-status"></div>
            </div>

            <!-- Danger Zone -->
            <div class="elite-card" style="border: 1px solid rgba(244, 63, 94, 0.4) !important;">
                <h4 style="color: #f43f5e; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px;">
                    <i class="fa fa-warning"></i> Danger Zone
                </h4>
                <div style="background: rgba(244, 63, 94, 0.05); padding: 25px; border-radius: 20px; border-left: 4px solid #f43f5e; margin-bottom: 20px;">
                    <h5 style="color: #fca5a5; font-weight: 800; margin-top: 0; font-size: 14px;">Deep Reset Exam Data</h5>
                    <p style="color: #fca5a5; font-size: 13px; line-height: 1.7; margin: 0; margin-top: 10px;">
                        Aksi ini akan menghapus seluruh rekaman jawaban, nilai, dan log aktivitas ujian secara permanen.
                    </p>
                </div>
                <button class="btn btn-block btn-gold-elite" id="btn-nuke-data" style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important; color: white !important; border-color: #fca5a5 !important; box-shadow: 0 10px 30px rgba(244, 63, 94, 0.4) !important;">
                    <i class="fa fa-bolt"></i> Nuke Exam Data
                </button>
                <p style="text-align: center; color: #475569; font-size: 11px; margin-top: 15px; font-style: italic;">"Action is irreversible. High-level clearance required."</p>
            </div>
        </div>
    </div>

    <!-- SNAPSHOT NODE PANEL -->
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <div class="elite-card" id="snapshot-panel">
                <!-- Animated Cyan Top Bar -->
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #06b6d4, var(--gold-primary), #06b6d4, transparent); opacity: 0.7; animation: zenithShimmer 5s linear infinite;"></div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 45px; height: 45px; border-radius: 14px; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(6, 182, 212, 0.4);">
                            <i class="fa fa-history" style="font-size: 20px; color: white;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Snapshot Node</h3>
                            <p style="margin: 0; font-size: 11px; color: rgba(6, 182, 212, 0.7); text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">Point-in-Time Recovery System</p>
                        </div>
                    </div>
                    <button class="btn btn-gold-elite" id="btn-refresh-snaps" style="padding: 8px 20px !important; font-size: 11px !important;">
                        <i class="fa fa-refresh"></i> Refresh List
                    </button>
                </div>

                <!-- Snapshot List -->
                <div id="snapshot-list-container">
                    <div class="text-center" style="padding: 50px; color: #475569;">
                        <i class="fa fa-circle-o-notch fa-spin" style="font-size: 30px; margin-bottom: 15px; display: block; color: rgba(6,182,212,0.4);"></i>
                        Loading snapshot registry...
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
        $('#snap-status').html('<div style="color: rgba(6,182,212,0.8); font-size: 12px; text-align:center; padding: 8px;"><i class="fa fa-circle-o-notch fa-spin"></i> Generating snapshot...</div>');

        $.post('<?php echo site_url("developer/create_snapshot"); ?>', {label: label}, function(res){
            btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Go');
            if(res.status == 1){
                notify_success(res.pesan);
                $('#snap-status').html('<div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 10px; padding: 10px; margin-top: 5px; color: #10b981; font-size: 12px; font-weight: 700;"><i class="fa fa-check-circle"></i> ' + res.pesan + '</div>');
                $('#snap-label').val('');
                loadSnapshots();
                $(document).trigger('ghcbt:snapshot-created', [res.size]);
            } else {
                notify_error(res.pesan);
                $('#snap-status').html('<div style="background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.3); border-radius: 10px; padding: 10px; margin-top:5px; color: #f43f5e; font-size:12px;"><i class="fa fa-times-circle"></i> ' + res.pesan + '</div>');
            }
        }, 'json').fail(function(){
            btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Go');
            notify_error('Koneksi gagal saat membuat snapshot.');
        });
    });

    // === LOAD SNAPSHOTS LIST ===
    function loadSnapshots(){
        $.getJSON('<?php echo site_url("developer/list_snapshots"); ?>', function(res){
            var html = '';
            if(res.snapshots && res.snapshots.length > 0){
                html += '<table class="table elite-table"><thead><tr>';
                html += '<th><i class="fa fa-file-code-o" style="color:var(--zenith-cyan, #06b6d4); margin-right:8px;"></i> Snapshot File</th>';
                html += '<th style="text-align:center;">Size</th>';
                html += '<th style="text-align:center;">Timestamp</th>';
                html += '<th style="text-align:right;">Actions</th>';
                html += '</tr></thead><tbody>';
                $.each(res.snapshots, function(i, snap){
                    html += '<tr>';
                    html += '<td style="padding:12px 15px; font-weight:700; color:#e2e8f0; font-size:13px;">';
                    html += '<i class="fa fa-database" style="color: rgba(6,182,212,0.7); margin-right:10px;"></i>';
                    html += snap.filename + '</td>';
                    html += '<td style="padding:12px 15px; text-align:center;">';
                    html += '<span style="background:rgba(6,182,212,0.1); color:#06b6d4; padding:3px 10px; border-radius:8px; font-size:10px; font-weight:900; border:1px solid rgba(6,182,212,0.3);">' + snap.size + ' KB</span>';
                    html += '</td>';
                    html += '<td style="padding:12px 15px; text-align:center; font-family:monospace; font-size:12px; color:#64748b;">' + snap.date + '</td>';
                    html += '<td style="padding:12px 15px; text-align:right;">';
                    html += '<button class="btn btn-xs btn-restore-snap" data-file="' + snap.filename + '" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); color:#10b981; border-radius:8px; padding:5px 12px; font-weight:800; font-size:11px; margin-right:5px; transition:all 0.2s;"><i class="fa fa-undo"></i> RESTORE</button>';
                    html += '<button class="btn btn-xs btn-delete-snap" data-file="' + snap.filename + '" style="background:rgba(244,63,94,0.1); border:1px solid rgba(244,63,94,0.3); color:#f43f5e; border-radius:8px; padding:5px 12px; font-weight:800; font-size:11px; transition:all 0.2s;"><i class="fa fa-trash"></i></button>';
                    html += '</td></tr>';
                });
                html += '</tbody></table>';
            } else {
                html = '<div class="text-center" style="padding:60px; color:#475569;">'
                     + '<i class="fa fa-inbox" style="font-size:60px; display:block; margin-bottom:20px; opacity:0.15; color:#06b6d4;"></i>'
                     + '<h4 style="font-weight:900; color:#cbd5e1; text-transform:uppercase; letter-spacing:2px; font-size:14px;">No Snapshots Found</h4>'
                     + '<p style="font-size:13px; margin-top:5px;">Create your first snapshot using the panel above.</p>'
                     + '</div>';
            }
            $('#snapshot-list-container').html(html);
        });
    }

    // === RESTORE SNAPSHOT ===
    $(document).on('click', '.btn-restore-snap', function(){
        var file = $(this).data('file');
        if(!confirm('⚠️ RESTORE akan menimpa SEMUA data database saat ini dengan versi dari snapshot:\n\n' + file + '\n\nLanjutkan?')) return;
        if(!confirm('KONFIRMASI TERAKHIR: Data yang ada sekarang akan DIGANTIKAN. Anda yakin?')) return;

        $(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        $("#modal-proses").modal('show');
        $.post('<?php echo site_url("developer/restore_snapshot"); ?>', {filename: file}, function(res){
            $("#modal-proses").modal('hide');
            if(res.status == 1){
                notify_success(res.pesan);
                setTimeout(function(){ location.reload(); }, 1500);
            } else {
                notify_error(res.pesan);
                loadSnapshots();
            }
        }, 'json').fail(function(){
            $("#modal-proses").modal('hide');
            notify_error('Koneksi gagal saat restore.');
        });
    });

    // === DELETE SNAPSHOT ===
    $(document).on('click', '.btn-delete-snap', function(){
        var file = $(this).data('file');
        if(!confirm('Hapus snapshot: ' + file + '?')) return;

        var row = $(this).closest('tr');
        $(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);
        $.post('<?php echo site_url("developer/delete_snapshot"); ?>', {filename: file}, function(res){
            if(res.status == 1){
                row.fadeOut(400, function(){ $(this).remove(); });
                notify_success(res.pesan);
            } else {
                notify_error(res.pesan);
                loadSnapshots();
            }
        }, 'json');
    });

    // === REFRESH BUTTON ===
    $('#btn-refresh-snaps').click(function(){
        var btn = $(this);
        btn.html('<i class="fa fa-refresh fa-spin"></i>');
        loadSnapshots();
        setTimeout(function(){ btn.html('<i class="fa fa-refresh"></i> Refresh List'); }, 1000);
    });

    // === NUKE DATA ===
    $('#btn-nuke-data').click(function(){
        if(confirm('CRITICAL WARNING: Anda akan melakukan DEEP RESET (Nuke) pada SELURUH data hasil ujian. Seluruh nilai peserta akan hilang selamanya. Lanjutkan?')){
            if(confirm('KONFIRMASI TERAKHIR: Anda benar-benar yakin?')){
                $("#modal-proses").modal('show');
                $.getJSON('<?php echo site_url("developer/reset_exam_data"); ?>', function(res){
                    $("#modal-proses").modal('hide');
                    if(res.status == 1){
                        notify_success(res.pesan);
                        setTimeout(function(){ location.reload(); }, 1500);
                    }else{
                        notify_error(res.pesan);
                    }
                });
            }
        }
    });

    // Auto-load snapshots on page ready
    loadSnapshots();
});
</script>
