<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Cetak Soal
		<small>Cetak bank soal berdasarkan mata pelajaran/topik dan kelas/grup dengan layout kertas soal standar</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Cetak Soal</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <!-- Filter Card -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-filter"></i> Filter Cetak Soal</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter-modul">Topik Ujian / Modul</label>
                                <select id="filter-modul" class="form-control">
                                    <option value="all">-- Semua Topik / Modul --</option>
                                    <?php 
                                    if(!empty($select_modul)){
                                        foreach($select_modul as $m){
                                            echo '<option value="'.$m->modul_id.'">'.$m->modul_nama.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter-grup">Kelas / Grup</label>
                                <select id="filter-grup" class="form-control">
                                    <option value="all">-- Semua Kelas / Grup --</option>
                                    <?php 
                                    if(!empty($select_grup)) {
                                        foreach($select_grup as $grup) {
                                            echo '<option value="'.$grup->grup_id.'">'.$grup->grup_nama.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter-topik">Mata Pelajaran / Topik</label>
                                <select id="filter-topik" class="form-control">
                                    <?php echo $select_topik; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12">
                            <label style="margin-bottom: 10px; display: block;">Pilih Jenis Soal yang Ingin Dicetak</label>
                            <div style="display: flex; gap: 20px; flex-wrap: wrap; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="1" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">Pilihan Ganda</span>
                                </label>
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="5" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">PG Kompleks</span>
                                </label>
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="6" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">Benar / Salah</span>
                                </label>
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="4" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">Menjodohkan</span>
                                </label>
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="2" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">Essay / Uraian</span>
                                </label>
                                <label style="font-weight: normal; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="filter_jenis[]" value="3" checked style="width: 18px; height: 18px; cursor: pointer;"> 
                                    <span style="font-size: 1.05em;">Jawaban Singkat</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" id="btn-preview"><i class="fa fa-eye"></i> Tampilkan Preview</button>
                    <button type="button" class="btn btn-success pull-right" id="btn-print" disabled><i class="fa fa-print"></i> Cetak Sekarang</button>
                </div>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="col-md-12" id="preview-section" style="display: none;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file-text-o"></i> Preview Kertas Soal</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" style="background: #e2e8f0; padding: 20px;">
                    <div style="max-width: 940px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border-radius: 8px; overflow: hidden; background: white;">
                        <iframe id="preview-iframe" src="" style="width: 100%; height: 750px; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $("#filter-modul, #filter-grup").change(function(){
            var modul = $('#filter-modul').val();
            var grup = $('#filter-grup').val();
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url($url); ?>/get_topik_by_filter",
                type: "POST",
                data: { modul: modul, grup: grup },
                success: function(respon){
                    $("#modal-proses").modal('hide');
                    $('#filter-topik').html(respon);
                    $('#filter-topik').trigger('change');
                }
            });
        });

        $('#btn-preview').click(function() {
            var topikId = $('#filter-topik').val();
            var grupId = $('#filter-grup').val();
            
            var jenis = [];
            $("input[name='filter_jenis[]']:checked").each(function(){
                jenis.push($(this).val());
            });

            if (!topikId || topikId === 'kosong') {
                notify_error('Pilih Mata Pelajaran / Topik terlebih dahulu!');
                return;
            }

            $("#modal-proses").modal('show');
            
            var url = '<?php echo site_url($url); ?>/preview/' + topikId + '/' + (grupId ? grupId : 'all');
            if(jenis && jenis.length > 0){
                url += '/' + jenis.join(',');
            } else {
                url += '/all';
            }
            $('#preview-iframe').attr('src', url);
            $('#preview-section').show();

            $('#preview-iframe').off('load').on('load', function() {
                $("#modal-proses").modal('hide');
                $('#btn-print').removeAttr('disabled');
                // Scroll down to preview section smoothly
                $('html, body').animate({
                    scrollTop: $("#preview-section").offset().top - 20
                }, 500);
            });
        });

        $('#btn-print').click(function() {
            var iframe = document.getElementById('preview-iframe');
            if (iframe) {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            }
        });
    });
</script>
