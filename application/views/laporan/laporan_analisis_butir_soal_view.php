<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Laporan Analisis Butir Soal
		<small>Analisis Butir Soal seusia dengan grup dan tes yang dipilih</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Analisis Butir Soal</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <?php echo form_open($url.'/export', array('id' => 'form-export', 'name' => 'form-export')); ?>
    <div class="row" id="section-statistik" style="display: none;">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pie-chart" style="margin-right: 10px; color: var(--accent-color);"></i> Dashboard Analisis Visual</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" onclick="$('#section-statistik').slideUp()" style="color: var(--text-muted);"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="padding: 30px !important;">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h4 style="font-weight: 700; margin-bottom: 20px; color: var(--text-bright);">Ringkasan Jawaban</h4>
                            <div id="pie-chart-container" style="position: relative; width: 220px; height: 220px; margin: 0 auto;">
                                <!-- Pure CSS Pie Chart will be injected here -->
                            </div>
                            <div style="margin-top: 25px; display: flex; justify-content: center; gap: 20px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 12px; height: 12px; border-radius: 3px; background: #10b981; display: inline-block;"></span>
                                    <span style="font-size: 13px; font-weight: 600;">Benar: <span id="stat-benar">0</span></span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 12px; height: 12px; border-radius: 3px; background: #f43f5e; display: inline-block;"></span>
                                    <span style="font-size: 13px; font-weight: 600;">Salah: <span id="stat-salah">0</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 style="font-weight: 700; margin-bottom: 20px; color: var(--text-bright);">Performa Per Butir Soal</h4>
                            <div id="bar-chart-container" style="max-height: 350px; overflow-y: auto; padding-right: 15px;">
                                <!-- Bar charts will be injected here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="box-title"><i class="fa fa-filter" style="margin-right: 10px; color: var(--accent-color);"></i> Konfigurasi Analisis</div>
				</div><!-- /.box-header -->
					
				<div class="box-body">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Grup</label>
							<input type="hidden" id="nama-grup" name="nama-grup">
							<select name="pilih-grup" id="pilih-grup" class="form-control select2">
								<?php if(!empty($select_group)){ echo $select_group; } ?>
							</select>
							<span class="help-block">Tentukan Grup yang akan dianalisis</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Tes</label>
							<input type="hidden" id="nama-tes" name="nama-tes">
							<select name="pilih-tes" id="pilih-tes" class="form-control select2">
								<?php if(!empty($select_tes)){ echo $select_tes; } ?>
							</select>
							<span class="help-block">Pilih Paket Tes yang ingin dibedah butir soalnya</span>
						</div>
					</div>
				</div>
				<div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn-statistik" style="margin-right: 10px;"><i class="fa fa-line-chart"></i> Tampilkan Analisis Visual</button>
					<button type="button" class="btn btn-success pull-right" id="btn-export" style="margin-left: 10px;"><i class="fa fa-file-excel-o"></i> Excel</button>
					<button type="button" class="btn btn-danger pull-right" id="btn-export-pdf"><i class="fa fa-file-pdf-o"></i> PDF</button>
				</div>
			</div>
		</div>
    </div>
	</form>
</section><!-- /.content -->

<style>
    .analytics-bar-item { margin-bottom: 12px; }
    .analytics-bar-label { font-size: 13px; font-weight: 700; color: var(--text-bright); margin-bottom: 6px; display: flex; justify-content: space-between; }
    .analytics-progress { height: 14px; background: rgba(var(--primary-rgb), 0.1); border-radius: 50px; overflow: hidden; display: flex; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
    .bar-benar { height: 100%; background: linear-gradient(90deg, #10b981, #059669); transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); border-radius: 50px 0 0 50px; }
    .bar-salah { height: 100%; background: linear-gradient(90deg, #f43f5e, #e11d48); transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); border-radius: 0 50px 50px 0; }
    
    .pie-wrap { position: relative; width: 100%; height: 100%; border-radius: 50%; background: #f43f5e; overflow: hidden; }
    .pie-segment { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #10b981; transform-origin: center; transition: transform 0.8s ease; }
</style>

<script lang="javascript">
    $(function(){
        $('#btn-statistik').click(function(){
            var tes_id = $('#pilih-tes').val();
            var grup_id = $('#pilih-grup').val();
            
            $("#modal-proses").modal('show');
            $.getJSON('<?php echo site_url()."/".$url; ?>/get_chart_data/' + tes_id + '/' + grup_id, function(data){
                $('#stat-benar').text(data.total_benar);
                $('#stat-salah').text(data.total_salah);
                
                // Render Pie Chart (CSS conic-gradient approach for modern browsers fallback to semi-circle)
                var total = data.total_benar + data.total_salah;
                var percentBenar = total > 0 ? Math.round((data.total_benar / total) * 100) : 0;
                $('#pie-chart-container').html('<div style="width:100%; height:100%; border-radius:50%; background:conic-gradient(#10b981 0% '+percentBenar+'%, #f43f5e '+percentBenar+'% 100%); box-shadow: 0 15px 35px rgba(0,0,0,0.2); border: 8px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center;"><div style="width: 75%; height: 75%; background: var(--bg-box); border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: inset 0 5px 15px rgba(0,0,0,0.1);"><div style="font-size: 32px; font-weight: 900; line-height: 1; color: var(--text-bright);">' + percentBenar + '%</div><div style="font-size: 10px; font-weight: 700; color: #10b981; opacity: 0.8; text-transform: uppercase; margin-top: 4px;">Success</div></div></div>');
                
                // Render Bar Charts
                var barHtml = '';
                var counter = 1;
                $.each(data.soal_stats, function(id, stat){
                    var b = stat.benar || 0;
                    var s = stat.salah || 0;
                    var t = b + s;
                    var pb = t > 0 ? (b / t * 100) : 0;
                    var ps = t > 0 ? (s / t * 100) : 0;
                    
                    barHtml += '<div class="analytics-bar-item">';
                    barHtml += '  <div class="analytics-bar-label"><span>Soal #' + counter + '</span> <span class="text-muted">' + b + ' Benar / ' + s + ' Salah</span></div>';
                    barHtml += '  <div class="analytics-progress">';
                    barHtml += '    <div class="bar-benar" style="width: ' + pb + '%;" title="Benar: ' + b + '"></div>';
                    barHtml += '    <div class="bar-salah" style="width: ' + ps + '%;" title="Salah: ' + s + '"></div>';
                    barHtml += '  </div>';
                    barHtml += '</div>';
                    counter++;
                });
                
                if(barHtml == '') barHtml = '<div class="text-center" style="padding: 20px; color: #94a3b8;">Tidak ada data soal untuk ditampilkan.</div>';
                $('#bar-chart-container').html(barHtml);
                
                $('#section-statistik').slideDown();
                $("#modal-proses").modal('hide');
            });
        });

		$('#btn-export').click(function(){
            var tes = $('#pilih-tes').val();
            if(tes == 'kosong' || tes == '' || tes == null){
                notify_error("Pilih Tes terlebih dahulu.");
            } else {
                $('#nama-grup').val($('#pilih-grup option:selected').text());
                $('#nama-tes').val($('#pilih-tes option:selected').text());
                $('#form-export').attr('action', '<?php echo site_url($url."/export"); ?>');
                $('#form-export').attr('target', '_self');
                $('#form-export').submit();
            }
		});

		$('#btn-export-pdf').click(function(){
            var tes = $('#pilih-tes').val();
            if(tes == 'kosong' || tes == '' || tes == null){
                notify_error("Pilih Tes terlebih dahulu.");
            } else {
                $('#nama-grup').val($('#pilih-grup option:selected').text());
                $('#nama-tes').val($('#pilih-tes option:selected').text());
                $('#form-export').attr('action', '<?php echo site_url($url."/export_pdf"); ?>');
                $('#form-export').attr('target', '_blank');
                $('#form-export').submit();
            }
		});
    });
</script>