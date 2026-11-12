<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Cetak Kartu Siswa
		<small>Mencetak Kartu Siswa berdasarkan data Siswa yang telah di inputkan.</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Kartu Siswa</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4>Informasi</h4>
                <p>Lakukan Pengaturan nama pelaksana GHCBT sebelum mencetak kartu siswa agar kartu sesuai dengan Organisasi tempat anda melaksanakan Ujian.</p>
                <p>Pastikan terlebih dahulu data Kelas dan data Siswa sudah ter-upload.</p>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-md-12">
			<?php echo form_open($url.'/kartu','id="form-kartu"'); ?>
                <div class="box">
                    <div class="box-header with-border">
    					<div class="box-title">Cetak Kartu Siswa</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="form-group col-sm-6">
                            <label>Pilih Kelas Siswa</label>
							<div id="data-group">
								<select name="group" id="group" class="form-control input-sm">
									<?php if(!empty($select_group)){ echo $select_group; } ?>
								</select>
							</div>
                            <p class="help-block">Pilih Data Kelas Siswa yang akan di cetak</p>
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Opsi Cetak</label>
                            <select name="tipe_cetak" id="tipe_cetak" class="form-control input-sm">
                                <option value="all">Depan dan Belakang</option>
                                <option value="depan">Bagian Depan Saja</option>
                            </select>
                            <p class="help-block">Pilih bagian kartu yang akan dicetak</p>
                        </div>
                        
                        <?php if(!empty($hasil)){ echo $hasil; } ?>
                    </div>
					
					<div class="box-footer">
                        <button type="button" class="btn btn-primary" id="kartu">Pratinjau Kartu</button>
                    </div>
                </div>
			<?php echo form_close(); ?> 
        </div>
    </div>

    <!-- Embedded Preview Section (Zenith Integration) -->
    <div class="row" id="preview-section" style="display: none;">
        <div class="col-md-12">
            <div class="box box-solid box-primary" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-eye"></i> Pratinjau Cetak Kartu</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" style="color: white;" onclick="$('#preview-section').slideUp()"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="padding: 0; background: #f4f4f4;">
                    <iframe id="preview-frame" style="width: 100%; height: 650px; border: none;" src="about:blank"></iframe>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
	$(function(){
        $('#kartu').click(function(){
			var grup_id = $('#group').val();
            var tipe_cetak = $('#tipe_cetak').val();
            
            if(!grup_id || grup_id == '0'){
                notify_error('Silahkan pilih kelas terlebih dahulu.');
                return;
            }

            var url = "<?php echo site_url().'/'.$url; ?>/cetak_kartu/"+grup_id+"/"+tipe_cetak;
			
            // Load into iframe instead of new tab
            $('#preview-section').slideDown();
            $('#preview-frame').attr('src', url);

            // Auto scroll to preview
            $('html, body').animate({
                scrollTop: $("#preview-section").offset().top - 20
            }, 800);
		});
    });
</script>