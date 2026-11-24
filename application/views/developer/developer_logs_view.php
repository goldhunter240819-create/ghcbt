<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-terminal"></i>
        </div>
        <div>
            <h2>Log Explorer</h2>
            <p>Pemeriksaan Forensik Catatan Aktivitas & Riwayat Error Engine GHCBT</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> FORENSIC STREAM ACTIVE
    </div>
</div>

<section class="content" style="padding: 0;">
    <div class="row">
        <div class="col-xs-12">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light); flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-file-text-o" style="color: var(--gold-primary);"></i> Daily System Logs
                        </h3>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 12px;">Daftar berkas log runtime yang tersimpan di direktori aplikasi</p>
                    </div>
                    <button class="btn" id="btn-clear-logs" style="border-radius: 12px; font-weight: 800; background: #fef2f2; border: 1px solid #fecdd3; color: #dc2626; padding: 10px 20px; transition: all 0.25s ease; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa fa-trash" style="margin-right: 6px;"></i> Nuke All Logs
                    </button>
                </div>

                <div class="table-responsive" style="border:none;">
                    <table class="table elite-table">
                        <thead>
                            <tr>
                                <th style="padding: 12px 15px;">Source Filename</th>
                                <th style="padding: 12px 15px; text-align: center;">Size</th>
                                <th style="padding: 12px 15px; text-align: center;">Timestamp</th>
                                <th style="padding: 12px 15px; text-align: right;">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($logs)): foreach($logs as $log): ?>
                            <tr>
                                <td style="padding: 14px 15px; font-weight: 700; color: #0f172a;">
                                    <i class="fa fa-file-code-o" style="margin-right: 12px; color: var(--gold-primary);"></i> 
                                    <?php echo $log['filename']; ?>
                                </td>
                                <td style="padding: 14px 15px; text-align: center;">
                                    <span style="background: #fffbeb; color: #b45309; padding: 4px 12px; border-radius: 10px; font-size: 11px; font-weight: 800; border: 1px solid #fde68a;">
                                        <?php echo $log['size']; ?> KB
                                    </span>
                                </td>
                                <td style="padding: 14px 15px; text-align: center; font-size: 12px; font-family: 'JetBrains Mono', monospace; color: #64748b; font-weight: 600;">
                                    <?php echo $log['date']; ?>
                                </td>
                                <td style="padding: 14px 15px; text-align: right;">
                                    <button class="btn btn-gold-elite btn-view-log" data-file="<?php echo $log['filename']; ?>" style="padding: 7px 16px !important; font-size: 11px !important;">
                                        <i class="fa fa-terminal" style="margin-right: 5px;"></i> Read Log
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="text-center" style="padding: 60px 20px; color: #64748b;">
                                    <i class="fa fa-shield" style="font-size: 50px; margin-bottom: 15px; display: block; color: #cbd5e1;"></i>
                                    <strong style="color: #0f172a; font-size: 14px; display: block; margin-bottom: 5px;">Sistem Bersih</strong>
                                    Tidak ada catatan error atau berkas log harian yang terdeteksi.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Baca Log -->
<div class="modal fade" id="modal-view-log" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #0f172a !important; border: 2px solid var(--gold-primary) !important; border-radius: 20px !important; color: #f1f5f9 !important; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.5) !important;">
            <div class="modal-header" style="background: rgba(245, 158, 11, 0.1); color: white; padding: 20px 25px; border-bottom: 1px solid rgba(245, 158, 11, 0.2);">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 0.7;"><span>&times;</span></button>
                <h4 class="modal-title" id="log-title" style="font-weight: 800; color: #fbbf24; letter-spacing: 1px;"><i class="fa fa-terminal"></i> LOG DECRYPTOR</h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <pre id="log-content" style="background: #020617 !important; color: #fbbf24 !important; border: 1px solid rgba(245, 158, 11, 0.2) !important; border-radius: 14px; padding: 20px; font-family: 'JetBrains Mono', 'Consolas', monospace; font-size: 12px; max-height: 480px; overflow-y: auto; line-height: 1.8;">Memuat berkas log...</pre>
            </div>
            <div class="modal-footer" style="padding: 15px 25px; border-top: 1px solid rgba(255,255,255,0.08);">
                <button type="button" class="btn" data-dismiss="modal" style="background: rgba(255,255,255,0.1); color: #ffffff; border: none; border-radius: 10px; padding: 8px 20px; font-weight: 700;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        // Baca Log Detail
        $('.btn-view-log').click(function(){
            var filename = $(this).data('file');
            $('#log-title').html('<i class="fa fa-terminal"></i> ' + filename);
            $('#log-content').html('Membaca isi berkas log...');
            $('#modal-view-log').modal('show');
            
            $.get('<?php echo site_url("developer/get_log_detail"); ?>/' + filename, function(data){
                $('#log-content').text(data);
            });
        });

        // Bersihkan Semua Log
        $('#btn-clear-logs').click(function(){
            if(confirm('Peringatan: Anda yakin ingin menghapus SEMUA berkas log sistem?')){
                $.post('<?php echo site_url("developer/clear_logs"); ?>', function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1){
                        notify_success(obj.pesan);
                        setTimeout(function(){ location.reload(); }, 1000);
                    }else{
                        notify_error(obj.pesan);
                    }
                });
            }
        });
    });
</script>