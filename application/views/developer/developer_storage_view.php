<style>
    .storage-progress-container {
        height: 12px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        overflow: hidden;
        margin: 15px 0 25px 0;
        border: 1px solid rgba(245, 158, 11, 0.1);
    }

    .storage-progress-bar {
        height: 100%;
        background: var(--gold-gradient);
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(245, 158, 11, 0.5);
    }

    .cleanup-box {
        background: rgba(245, 158, 11, 0.03);
        border: 1px solid rgba(245, 158, 11, 0.1);
        border-radius: 24px;
        padding: 35px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .cleanup-box:hover {
        background: rgba(245, 158, 11, 0.08);
        border-color: var(--gold-primary);
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--gold-glow);
    }
</style>

<section class="content-header" style="padding: 35px 35px 10px 35px;">
	<h1 style="color: #f1f5f9; font-weight: 900; letter-spacing: -0.5px;">
		<span class="gold-text">Storage Hub</span>
		<small style="color: rgba(245, 158, 11, 0.6); font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Node Capacity & Waste Management</small>
	</h1>
</section>

<section class="content" style="padding: 20px 30px;">
    <div class="row">
        <!-- Main Stats -->
        <div class="col-md-4">
            <div class="elite-card">
                <div style="display: flex; align-items: center; margin-bottom: 35px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Data Storage</h3>
                </div>

                <div style="margin-bottom: 35px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                        <label style="color: rgba(245, 158, 11, 0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;">Upload Assets</label>
                        <span style="color: var(--gold-primary); font-weight: 900; font-size: 18px; text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);"><?php echo $uploads_size; ?> <small style="font-size: 10px; opacity: 0.5;">MB</small></span>
                    </div>
                    <div class="storage-progress-container">
                        <div class="storage-progress-bar" style="width: <?php echo min(100, $uploads_size / 2); ?>%;"></div>
                    </div>
                </div>

                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                        <label style="color: rgba(245, 158, 11, 0.6); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;">System Recovery</label>
                        <span style="color: #10b981; font-weight: 900; font-size: 18px; text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);"><?php echo $backups_size; ?> <small style="font-size: 10px; opacity: 0.5;">MB</small></span>
                    </div>
                    <div class="storage-progress-container">
                        <div class="storage-progress-bar" style="width: <?php echo min(100, $backups_size / 2); ?>%; background: linear-gradient(to right, #10b981, #059669); box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);"></div>
                    </div>
                </div>

                <div style="margin-top: 40px; text-align: center; opacity: 0.5;">
                    <i class="fa fa-hdd-o" style="font-size: 60px; color: var(--gold-primary); filter: drop-shadow(0 0 15px rgba(245, 158, 11, 0.3));"></i>
                </div>
            </div>
        </div>

        <!-- Cleanup Tools -->
        <div class="col-md-8">
            <div class="elite-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; border-left: 4px solid var(--gold-primary); padding-left: 20px;">
                    <h3 style="margin:0; font-weight: 900; color: #f8fafc; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Cleanup Engineering</h3>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="cleanup-box">
                            <h4 style="color: #f1f5f9; font-weight: 800; font-size: 16px; margin-top: 0;">Purge Core Cache</h4>
                            <p style="color: #64748b; font-size: 13px; line-height: 1.6; min-height: 40px;">Hapus file cache internal CodeIgniter di folder <code>application/cache</code> untuk refresh data.</p>
                            <button class="btn btn-block btn-gold-elite btn-cleanup" data-type="cache" style="padding: 12px !important; font-size: 11px !important;">
                                <i class="fa fa-fire"></i> Cache Nuke
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="cleanup-box">
                            <h4 style="color: #f1f5f9; font-weight: 800; font-size: 16px; margin-top: 0;">Purge Temp Files</h4>
                            <p style="color: #64748b; font-size: 13px; line-height: 1.6; min-height: 40px;">Bersihkan sisa update dan file fragmentasi sementara hasil sinkronisasi sistem.</p>
                            <button class="btn btn-block btn-gold-elite btn-cleanup" data-type="temp" style="padding: 12px !important; font-size: 11px !important;">
                                <i class="fa fa-refresh"></i> Temp Flush
                            </button>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; background: rgba(245, 158, 11, 0.03); border-radius: 20px; padding: 25px; border: 1px solid rgba(245, 158, 11, 0.1); box-shadow: inset 0 0 20px rgba(245, 158, 11, 0.05);">
                    <h5 style="color: var(--gold-primary); font-weight: 900; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">Diagnostic Note</h5>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.8;">Pembersihan rutin membantu menjaga <b class="gold-text">LATENCY</b> database dan engine tetap rendah. Fragmentasi file temp yang menumpuk bisa memperlambat proses <code>GHCBT_SYNC</code>.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.btn-cleanup').click(function(){
            var type = $(this).data('type');
            if(confirm("Apakah Anda yakin ingin melakukan pembersihan " + type + "?")){
                $("#modal-proses").modal('show');
                setTimeout(function(){
                    $("#modal-proses").modal('hide');
                    notify_success("Pembersihan " + type + " berhasil diselesaikan.");
                    setTimeout(function(){ location.reload(); }, 1000);
                }, 1500);
            }
        });
    });
</script>
