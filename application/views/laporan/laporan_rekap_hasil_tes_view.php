<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Rekapitulasi Hasil Ujian
		<small>Export Rekapitulasi Hasil Ujian ke Excel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Rekap Hasil Ujian</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4><i class="fa fa-info-circle"></i> Panduan Export Data</h4>
                <p>Silakan tentukan <strong>Kelas</strong> dan <strong>Rentang Waktu</strong> pelaksanaan tes pada panel di bawah ini untuk mendapatkan rekapitulasi nilai yang akurat.</p>
                <p>Catatan: Siswa yang tidak hadir akan ditandai dengan status <em>N/A</em> pada dokumen hasil export.</p>
            </div>
        </div>
    </div>
	<?php echo form_open($url.'/export','id="form-export"'); ?>
	<div class="row">
        <div class="col-md-4">
            <div class="box">
				<div class="box-header with-border">
					<div class="box-title">Pilih Kelas</div>
    			</div><!-- /.box-header -->
				
				<div class="box-body">
					<div class="form-group">
						<label><i class="fa fa-users" style="margin-right: 5px; color: var(--accent-color);"></i> Target Kelas</label>
						<input type="hidden" id="nama-grup" name="nama-grup">
                        <select name="pilih-grup" id="pilih-grup" class="form-control select2">
							<?php if(!empty($select_group)){ echo $select_group; } ?>
						</select>
						<span class="help-block">Pilih kelas yang ingin direkap nilainya.</span>
					</div>
                </div>
			</div>
        </div>
		
		<div class="col-md-8">
            <div class="box">
				<div class="box-header with-border">
					<div class="box-title">Rekapitulasi Hasil Ujian</div>
    			</div><!-- /.box-header -->
				
				<div class="box-body form-horizontal" style="padding: 25px !important;">
						<div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left !important; color: var(--text-muted);"><i class="fa fa-calendar-check-o" style="margin-right: 5px; color: var(--accent-color);"></i> Periode Ujian</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon" style="background: rgba(var(--primary-rgb), 0.1); border-color: var(--border-color); color: var(--accent-color); border-radius: 12px 0 0 12px;">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" name="pilih-rentang-waktu" id="pilih-rentang-waktu" class="form-control" style="border-radius: 0 12px 12px 0;" value="<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>" readonly />
                                </div>
								<span class="help-block" style="margin-top: 10px;">Tentukan rentang tanggal pengerjaan ujian untuk ditarik datanya.</span>
                            </div>
                        </div>
                </div>
				<div class="box-footer">
					<button type="button" class="btn btn-success pull-right" id="btn-export" style="margin-left: 10px;"><i class="fa fa-file-excel-o"></i> Export Excel</button>
					<button type="button" class="btn btn-danger pull-right" id="btn-export-pdf"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
                </div>
			</div>
        </div>
    </div>
	</form>
</section><!-- /.content -->



<script lang="javascript">
    $(function(){
		$('#pilih-rentang-waktu').daterangepicker({timePicker: false, timePickerIncrement: 30, format: 'YYYY-MM-DD'});  

		$('#btn-export').click(function(){
			$('#nama-grup').val($('#pilih-grup option:selected').text());
			$('#form-export').attr('action', '<?php echo site_url()."/".$url; ?>/export');
			$('#form-export').attr('target', '_self');
			$('#form-export').submit();
		});

		$('#btn-export-pdf').click(function(){
			$('#nama-grup').val($('#pilih-grup option:selected').text());
			$('#form-export').attr('action', '<?php echo site_url()."/".$url; ?>/export_pdf');
			$('#form-export').attr('target', '_blank');
			$('#form-export').submit();
		});
    });
</script>