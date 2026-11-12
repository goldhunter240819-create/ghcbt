<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Cetak Denah Tempat
		<small>Cetak denah posisi duduk ujian peserta</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i data-lucide="layout-dashboard"></i> Home</a></li>
		<li class="active">Cetak Denah Tempat</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pilihan Cetak</h3>
                </div>
                <div class="box-body">
                    <form action="<?php echo site_url($url.'/cetak'); ?>" method="POST" target="_blank" id="form-denah">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Topik/Modul Ujian</label>
                                    <select name="modul_id" id="filter-modul" class="form-control select2" data-placeholder="- Pilih Topik Ujian -">
                                        <option value="">- Tanpa Topik (Kosong) -</option>
                                        <?php if(!empty($select_modul)){ foreach($select_modul as $m){
                                            echo '<option value="'.$m->modul_id.'">'.$m->modul_nama.'</option>';
                                        } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Kelas (Bisa Lebih Dari 1)</label>
                                    <select name="grup_id[]" id="filter-grup" class="form-control select2" multiple="multiple" data-placeholder="- Pilih Kelas -" required>
                                    <?php if(!empty($select_grup)){ foreach($select_grup as $g){
                                        echo '<option value="'.$g->grup_id.'">'.$g->grup_nama.'</option>';
                                    } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jumlah Lajur Kolom</label>
                                    <input type="number" name="kolom" id="filter-kolom" class="form-control" value="5" min="1" max="15" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jumlah Baris</label>
                                    <input type="number" name="baris" id="filter-baris" class="form-control" value="6" min="1" max="20" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block" style="font-weight: bold;">
                                        <i data-lucide="printer"></i> CETAK DENAH
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.select2').select2();

        $('#form-denah').on('submit', function(e){
            var grup_id = $('#filter-grup').val();
            if(!grup_id || grup_id.length === 0){
                e.preventDefault();
                Swal.fire('Perhatian', 'Pilih minimal 1 Kelas terlebih dahulu!', 'warning');
            }
        });
    });
</script>

