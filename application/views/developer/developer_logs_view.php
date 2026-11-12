<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Log Explorer</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Neural System Forensics</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Daily System Logs</h3>
                    <button class="btn" id="btn-clear-logs" style="border-radius: 12px; font-weight: 700; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.2); color: #f43f5e; padding: 10px 20px; transition: all 0.3s ease;">
                        <i class="fa fa-trash"></i> Nuke All Logs
                    </button>
                </div>

                <div class="table-responsive" style="border:none;">
                    <table class="table elite-table">
                        <thead>
                            <tr>
                                <th style="padding: 15px;">Source Filename</th>
                                <th style="padding: 15px; text-align: center;">Size</th>
                                <th style="padding: 15px; text-align: center;">Timestamp</th>
                                <th style="padding: 15px; text-align: right;">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($logs)): foreach($logs as $log): ?>
                            <tr>
                                <td style="padding: 18px 15px; font-weight: 600; color: #e2e8f0;">
                                    <i class="fa fa-file-code-o" style="margin-right: 15px; color: var(--gold-primary); opacity: 0.7;"></i> 
                                    <?php echo $log['filename']; ?>
                                </td>
                                <td style="padding: 18px 15px; text-align: center;">
                                    <span style="background: rgba(245, 158, 11, 0.15); color: var(--gold-primary); padding: 4px 12px; border-radius: 10px; font-size: 10px; font-weight: 900; border: 1px solid rgba(245, 158, 11, 0.3);">
                                        <?php echo $log['size']; ?> KB
                                    </span>
                                </td>
                                <td style="padding: 18px 15px; text-align: center; font-size: 12px; font-family: 'JetBrains Mono', monospace; color: #64748b;">
                                    <?php echo $log['date']; ?>
                                </td>
                                <td style="padding: 18px 15px; text-align: right;">
                                    <button class="btn btn-gold-elite btn-view-log" data-file="<?php echo $log['filename']; ?>" style="padding: 6px 15px !important; font-size: 11px !important;">
                                        <i class="fa fa-terminal"></i> Read Log
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="text-center" style="padding: 80px; color: #475569;">
                                    <i class="fa fa-shield" style="font-size: 60px; margin-bottom: 20px; display: block; opacity: 0.1;"></i>
                                    Neural pathways are clear. No system logs detected.
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
        <div class="modal-content" style="background: #020617 !important; border: 2px solid var(--gold-primary) !important; border-radius: 28px !important; color: #e2e8f0 !important; overflow: hidden; box-shadow: var(--gold-glow-strong) !important;">
            <div class="modal-header" style="background: rgba(245, 158, 11, 0.03); color: white; padding: 25px; border-bottom: 1px solid rgba(245, 158, 11, 0.2);">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 0.5;"><span>&times;</span></button>
                <h4 class="modal-title" id="log-title" style="font-weight: 900; color: var(--gold-primary); letter-spacing: 2px; text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);"><i class="fa fa-terminal"></i> LOG DECRYPTOR</h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <pre id="log-content" style="background: #000000 !important; color: var(--gold-secondary) !important; border: 1px solid rgba(245, 158, 11, 0.2) !important; border-radius: 16px; padding: 25px; font-family: 'JetBrains Mono', 'Fira Code', monospace; font-size: 12px; max-height: 500px; overflow-y: auto; line-height: 1.8; box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.05);">Initializing neural log stream...</pre>
            </div>
            <div class="modal-footer" style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.05);">
                <button type="button" class="btn" data-dismiss="modal" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border:none; border-radius: 12px; padding: 10px 25px; font-weight: 700;">Close Shield</button>
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
            $('#log-content').html('Decrypting data blocks...');
            $('#modal-view-log').modal('show');
            
            $.get('<?php echo site_url("developer/get_log_detail"); ?>/' + filename, function(data){
                $('#log-content').text(data);
            });
        });

        // Bersihkan Semua Log
        $('#btn-clear-logs').click(function(){
            if(confirm('Are you sure you want to NUKE ALL system logs? This action is irreversible.')){
                $("#modal-proses").modal('show');
                $.getJSON('<?php echo site_url("developer/clear_logs"); ?>', function(data){
                    if(data.status == 1){
                        notify_success(data.pesan);
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                    $("#modal-proses").modal('hide');
                });
            }
        });
    });
</script>
