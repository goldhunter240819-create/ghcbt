<section class="content-header">
	<h1>Cetak Lain-lain <small>Cetak kelengkapan ruangan ujian CBT</small></h1>
    <ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i data-lucide="layout-dashboard"></i> Home</a></li>
		<li class="active">Cetak Lain-lain</li>
	</ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pilih Jenis Cetakan</h3>
                </div>
                <div class="box-body">
                    <form action="<?php echo site_url($url.'/cetak'); ?>" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipe Cetakan</label>
                                    <select name="tipe" id="tipe-cetak" class="form-control" required>
                                        <option value="">- Pilih Jenis Cetakan -</option>
                                        <option value="ruang">1. Papan Nama Ruangan</option>
                                        <option value="harap-tenang">2. Poster Harap Tenang</option>
                                        <option value="nomor-meja">3. Label Nomor Meja</option>
                                        <option value="denah">4. Denah Tempat Duduk</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Opsi Tambahan -->
                        <div class="row" id="opsi-ruang" style="display:none; background: #f8fafc; padding: 15px; border-radius: 8px; margin: 0 0 20px 0;">
                            <div class="col-md-6" id="input-nama-ruang">
                                <div class="form-group">
                                    <label>Nama Ruang / Teks Utama</label>
                                    <input type="text" name="nama_ruang" class="form-control" placeholder="Contoh: RUANG 01, LAB KOMPUTER">
                                </div>
                            </div>
                            <div class="col-md-6" id="input-keterangan">
                                <div class="form-group">
                                    <label>Keterangan Tambahan (Opsional)</label>
                                    <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Ujian Akhir Semester Ganjil">
                                </div>
                            </div>
                            <div class="col-md-6" id="input-jumlah-meja" style="display:none;">
                                <div class="form-group">
                                    <label>Jumlah Meja/Label</label>
                                    <input type="number" name="jumlah_meja" class="form-control" value="40" min="1" max="100">
                                </div>
                            </div>
                        </div>
                        <div id="opsi-denah" style="display:none; background: #f8fafc; padding: 15px; border-radius: 8px; margin: 0 0 20px 0;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pilih Topik/Modul Ujian</label>
                                        <select name="modul_id" id="filter-modul" class="form-control select2" style="width: 100%;" data-placeholder="- Pilih Topik Ujian -">
                                            <option value="">- Tanpa Topik (Kosong) -</option>
                                            <?php if(!empty($select_modul)){ foreach($select_modul as $m){
                                                echo '<option value="'.$m->modul_id.'">'.$m->modul_nama.'</option>';
                                            } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pilih Kelas (Bisa Lebih Dari 1)</label>
                                        <select name="grup_id[]" id="filter-grup" class="form-control select2" style="width: 100%;" multiple="multiple" data-placeholder="- Pilih Kelas -">
                                        <?php if(!empty($select_grup)){ foreach($select_grup as $g){
                                            echo '<option value="'.$g->grup_id.'">'.$g->grup_nama.'</option>';
                                        } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Lajur Kolom</label>
                                        <input type="number" name="kolom" id="filter-kolom" class="form-control" value="5" min="1" max="15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Baris</label>
                                        <input type="number" name="baris" id="filter-baris" class="form-control" value="6" min="1" max="20">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: white !important; font-weight: bold; border-radius: 12px; padding: 12px 30px; border: none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);"><i data-lucide="printer"></i> CETAK DOKUMEN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.select2').select2();

        $('#tipe-cetak').on('change', function(){
            var val = $(this).val();
            var form = $(this).closest('form');
            
            // Default Action
            form.attr('action', '<?php echo site_url($url."/cetak"); ?>');
            
            $('#opsi-ruang').hide();
            $('#opsi-denah').hide();
            $('#filter-grup').prop('required', false);

            if(val == 'ruang') {
                $('#opsi-ruang').show();
                $('#input-nama-ruang').show();
                $('#input-keterangan').show();
                $('#input-jumlah-meja').hide();
            } else if(val == 'nomor-meja') {
                $('#opsi-ruang').show();
                $('#input-nama-ruang').show();
                $('#input-keterangan').hide();
                $('#input-jumlah-meja').show();
            } else if(val == 'denah') {
                $('#opsi-denah').show();
                $('#filter-grup').prop('required', true);
                form.attr('action', '<?php echo site_url("manager/peserta_denah/cetak"); ?>');
            }
        });

        $('form').on('submit', function(e){
            if($('#tipe-cetak').val() == 'denah'){
                var grup_id = $('#filter-grup').val();
                if(!grup_id || grup_id.length === 0){
                    e.preventDefault();
                    Swal.fire('Perhatian', 'Pilih minimal 1 Kelas terlebih dahulu!', 'warning');
                }
            }
        });
    });
</script>

