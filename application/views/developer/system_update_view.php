<section class="content-header" style="margin-bottom: 20px;">
	<h1 style="font-weight: 800; letter-spacing: -0.5px; display: flex; align-items: center; gap: 12px;">
        <div style="width: 40px; height: 40px; background: var(--primary-gradient); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 15px rgba(var(--primary-rgb), 0.3);">
            <i class="fa fa-refresh" style="color: white; font-size: 20px;"></i>
        </div>
        <span>Maintenance & Update</span>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Update</li>
	</ol>
</section>

<section class="content">
	<div class="row" style="display: flex; flex-wrap: wrap; gap: 15px; margin: 0;">
        
		<div style="flex: 1.5; min-width: 400px;">
			<div class="box" style="height: 100%; display: flex; flex-direction: column; border-radius: 16px;">
				<div class="box-header" style="border-bottom: 1px solid var(--border-light); padding: 15px 20px;">
					<h3 class="box-title" style="font-weight: 700; color: var(--text-bright); display: flex; align-items: center; gap: 10px; font-size: 16px;">
                        <i class="fa fa-cloud-upload"></i> Upload Update Package
                    </h3>
				</div>
				<div class="box-body" style="padding: 20px;">
					<div class="callout" style="background: rgba(var(--primary-rgb), 0.03) !important; border: 1px dashed var(--accent-color) !important; border-radius: 12px !important; padding: 15px !important; margin-bottom: 20px;">
						<p style="color: var(--text-muted); line-height: 1.5; font-size: 13px; margin: 0;">Sistem otomatis membackup database & media sebelum update. Aset <b>Foto, Logo, & Koneksi DB</b> tetap aman.</p>
					</div>

					<?php echo form_open_multipart('', 'id="form-update"'); ?>
						<div class="form-group" style="background: var(--bg-body); border: 2px dashed var(--border-light); border-radius: 16px; padding: 25px; text-align: center; transition: all 0.3s ease; position: relative;" id="drop-zone">
							<i class="fa fa-file-archive-o" style="font-size: 40px; color: var(--accent-color); opacity: 0.5; margin-bottom: 10px; display: block;"></i>
                            <label style="display: block; font-size: 15px; font-weight: 700; margin-bottom: 5px; color: var(--text-main);">Pilih File Update (.zip)</label>
                            <p style="color: var(--text-muted); margin-bottom: 15px; font-size: 12px;">Pilih atau drag file update resmi di sini</p>
							
                            <div style="max-width: 350px; margin: 0 auto;">
                                <input type="file" name="update_file" id="update_file" class="form-control" accept=".zip" style="text-align: center; font-size: 13px;">
                            </div>
						</div>
						
						<div style="margin-top: 20px;">
							<button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-submit-update" style="height: 50px; font-size: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-radius: 12px !important;">
								<i class="fa fa-bolt"></i> JALANKAN UPDATE
							</button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; gap: 15px;">
			<div class="box" style="border-radius: 16px;">
				<div class="box-header" style="padding: 12px 18px; border-bottom: 1px solid var(--border-light);">
					<h3 class="box-title" style="font-size: 14px; font-weight: 700;"><i class="fa fa-info-circle"></i> Status Sistem</h3>
				</div>
				<div class="box-body" style="padding: 15px 18px;">
					<div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.03); padding: 10px 15px; border-radius: 10px; min-height: 45px;">
                            <span style="color: var(--text-muted); font-size: 12px;">Versi Terpasang</span>
                            <span style="font-weight: 800; color: var(--text-bright); text-align: right; margin-left: auto;"><?php echo $site_version; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.03); padding: 10px 15px; border-radius: 10px;">
                            <span style="color: var(--text-muted); font-size: 12px;">Engine Status</span>
                            <span style="color: #10b981; font-weight: 700; font-size: 12px;"><i class="fa fa-check-circle"></i> ZIP READY</span>
                        </div>
                    </div>
				</div>
			</div>

            <div class="box" style="padding: 20px !important; border-radius: 16px; background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.08) 0%, rgba(var(--primary-rgb), 0.02) 100%) !important;">
                <h4 style="margin-top: 0; margin-bottom: 15px; font-weight: 800; color: var(--text-bright); font-size: 15px; text-transform: uppercase;">
                    <i class="fa fa-gears"></i> Maintenance Tools
                </h4>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <button id="btn-backup-db" class="btn btn-default" style="display: flex; align-items: center; gap: 10px; padding: 12px !important; text-align: left; background: var(--bg-box) !important; border: 1px solid var(--border-light) !important; border-radius: 12px !important;">
                        <div style="width: 30px; height: 30px; background: rgba(var(--primary-rgb), 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-database" style="color: var(--text-bright); font-size: 13px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; font-size: 13px; color: var(--text-main);">Backup Database</div>
                        </div>
                    </button>

                    <button id="btn-backup-files" class="btn btn-default" style="display: flex; align-items: center; gap: 10px; padding: 12px !important; text-align: left; background: var(--bg-box) !important; border: 1px solid var(--border-light) !important; border-radius: 12px !important;">
                        <div style="width: 30px; height: 30px; background: rgba(16, 185, 129, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-file-photo-o" style="color: #10b981; font-size: 13px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; font-size: 13px; color: var(--text-main);">Backup Data Asset</div>
                        </div>
                    </button>

                    <button id="btn-clear-session" class="btn btn-default" style="display: flex; align-items: center; gap: 10px; padding: 12px !important; text-align: left; background: var(--bg-box) !important; border: 1px solid var(--border-light) !important; border-radius: 12px !important;">
                        <div style="width: 30px; height: 30px; background: rgba(244, 63, 94, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-trash" style="color: #f43f5e; font-size: 13px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 700; font-size: 13px; color: var(--text-main);">Flush Sessions</div>
                        </div>
                    </button>
                </div>
            </div>
		</div>
	</div>
</section>

<style>
    #drop-zone:hover {
        border-color: var(--accent-color) !important;
        background: rgba(var(--primary-rgb), 0.05) !important;
    }
    .box { transition: all 0.3s ease; }
    .box:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important; }
</style>

<script type="text/javascript">
	$(function(){
		$('#btn-backup-db').click(function(){
            window.open("<?php echo site_url('updater/database'); ?>");
        });

        $('#btn-backup-files').click(function(){
            window.open("<?php echo site_url('updater/data_upload'); ?>");
        });

		$('#btn-clear-session').click(function(){
			Swal.fire({
				title: 'Flush Sesi?',
				text: "Semua login peserta akan dibersihkan.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#f43f5e',
				confirmButtonText: 'Ya, Bersihkan',
				cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#f8fafc'
			}).then((result) => {
				if (result.isConfirmed) {
					$("#modal-proses").modal('show');
					$.getJSON('<?php echo site_url('updater/clear_session'); ?>', function(data){
						$("#modal-proses").modal('hide');
						if(data.status==1){
							Swal.fire({
                                icon: 'success',
                                title: 'Selesai',
                                text: data.pesan,
                                background: '#1e293b',
                                color: '#f8fafc'
                            }).then(() => {
								window.location.reload(true);
							});
						}
					});
				}
			});
        });

		$('#form-update').submit(function(e){
			e.preventDefault();
			if($('#update_file').val() == ''){
				Swal.fire({
					icon: 'warning',
					title: 'Error',
					text: 'Pilih file .zip update.',
                    background: '#1e293b',
                    color: '#f8fafc'
				});
				return false;
			}
			Swal.fire({
				title: 'Jalankan Update?',
				text: "Sistem akan membackup dan memperbarui file.",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#6366f1',
				cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#f8fafc'
			}).then((result) => {
				if (result.isConfirmed) {
					// Setup Progress Bar
                    let progressHtml = `
                        <div style="margin-top: 20px; text-align: left;">
                            <div id="progress-text" style="margin-bottom: 10px; font-weight: 600; color: var(--text-muted); font-size: 13px;">Menyiapkan file...</div>
                            <div class="progress" style="height: 20px; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden; box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);">
                                <div id="update-progress-bar" class="progress-bar progress-bar-striped active" role="progressbar" 
                                     style="width: 0%; transition: width 0.4s ease; background: var(--primary-gradient); box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);">
                                    <span id="progress-percent">0%</span>
                                </div>
                            </div>
                        </div>
                    `;

                    Swal.fire({
                        title: 'Sedang Memperbarui Sistem',
                        html: progressHtml,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: '#1e293b',
                        color: '#f8fafc',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Logic Polling Progress
                    let progressInterval = setInterval(function() {
                        $.getJSON("<?php echo site_url('updater/get_progress'); ?>", function(data) {
                            if(data) {
                                $('#update-progress-bar').css('width', data.progress + '%');
                                $('#progress-percent').text(data.progress + '%');
                                $('#progress-text').text(data.message);
                            }
                        });
                    }, 800);

					var formData = new FormData(this);
					$.ajax({
						url: "<?php echo site_url('updater/process'); ?>",
						type: 'POST',
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						success: function (respon) {
							clearInterval(progressInterval);
							var obj = $.parseJSON(respon);
							if(obj.status == 1){
								Swal.fire({
									icon: 'success',
									title: 'Berhasil',
									text: obj.pesan,
                                    background: '#1e293b',
                                    color: '#f8fafc'
								}).then(() => {
									location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Gagal',
									text: obj.pesan,
                                    background: '#1e293b',
                                    color: '#f8fafc'
								});
							}
						},
						error: function(data){
							clearInterval(progressInterval);
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Terjadi kesalahan sistem.',
                                background: '#1e293b',
                                color: '#f8fafc'
							});
						}
					});
				}
			});
		});
	});
</script>
