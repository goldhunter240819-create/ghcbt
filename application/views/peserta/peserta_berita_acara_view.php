


<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #10b981 0%, #10b981 100%);
        --accent-color: #10b981;
        --shadow-premium: var(--shadow-main);
    }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); }
    .content-header h1 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: var(--text-bright); letter-spacing: -0.5px; }
    .premium-card {
        background: var(--bg-box);
        backdrop-filter: var(--glass-blur);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-premium);
        margin-bottom: 30px;
        overflow: hidden;
    }
    .premium-header {
        padding: 25px 30px;
        background: rgba(var(--primary-rgb), 0.03);
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .premium-header i { font-size: 24px; color: var(--accent-color); }
    .premium-header .title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-bright); }
    .premium-body { padding: 30px; color: var(--text-main); }
    
    .btn-premium {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 12px 30px !important;
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        transition: all 0.3s;
    }
    .btn-premium:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5) !important;
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }
</style>

<section class="content-header">
    <h1>
        Cetak Berita Acara
        <small>Cetak berita acara pelaksanaan ujian per mata pelajaran dan kelas</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="premium-card">
                <div class="premium-header">
                    <i data-lucide="file-text"></i>
                    <div class="title">KONFIGURASI CETAK BERITA ACARA</div>
                </div>
                <div class="premium-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block;">1. Pilih Topik Ujian</label>
                            <select id="filter-modul" class="form-control select2" style="width: 100%;">
                                <option value="all">-- Semua Topik --</option>
                                <?php if(!empty($select_modul)){ foreach($select_modul as $m){ 
                                    echo '<option value="'.$m->modul_id.'">'.$m->modul_nama.'</option>'; 
                                } } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block;">2. Pilih Kelas</label>
                            <select id="filter-grup" class="form-control select2" style="width: 100%;">
                                <option value="all">-- Semua Kelas --</option>
                                <?php if(!empty($select_grup)){ foreach($select_grup as $g){ 
                                    echo '<option value="'.$g->grup_id.'">'.$g->grup_nama.'</option>'; 
                                } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block;">3. Pilih Mata Pelajaran</label>
                            <select name="topik" id="topik" class="form-control select2" style="width: 100%;">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block;">4. Tanggal & Pengawas</label>
                            <div style="display: flex; gap: 10px;">
                                <input type="date" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="flex: 1; border-radius: 10px; height: 45px;">
                                <select id="pengawas" class="form-control select2" style="flex: 2;">
                                    <option value="">-- Pilih Pengawas --</option>
                                    <?php if(!empty($select_guru)){ foreach($select_guru as $guru){ echo '<option value="'.$guru->nama_lengkap.'">'.$guru->nama_lengkap.'</option>'; } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer" style="background: white; border-top: 1px solid #f1f5f9; padding: 25px 30px;">
                    <button type="button" class="btn btn-premium pull-right" id="btn-cetak">
                        <i class="fa fa-print" style="margin-right: 8px;"></i> CETAK BERITA ACARA
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $('.select2').select2();

        function refresh_topik(){
            var modul = $('#filter-modul').val();
            var grup = $('#filter-grup').val();
            
            $.ajax({
                url: "<?php echo site_url('manager/peserta_berita_acara/get_topik_by_filter'); ?>",
                type: 'POST',
                data: { modul: modul, grup: grup },
                success: function(data) {
                    $('#topik').html(data).trigger('change');
                }
            });
        }

        $('#filter-modul, #filter-grup').on('change', function() {
            refresh_topik();
        });

        $('#btn-cetak').on('click', function() {
            var topik = $('#topik').val();
            var grup = $('#filter-grup').val();
            var tanggal = $('#tanggal').val();
            var pengawas = $('#pengawas').val();

            if(!topik || topik == '' || topik == 'kosong') {
                Swal.fire('Perhatian', 'Silahkan pilih Mata Pelajaran terlebih dahulu.', 'warning');
                return;
            }
            if(!grup || grup == '' || grup == 'all') {
                Swal.fire('Perhatian', 'Silahkan pilih Kelas terlebih dahulu.', 'warning');
                return;
            }

            window.open("<?php echo site_url('manager/peserta_berita_acara/cetak'); ?>/" + topik + "/" + grup + "?tanggal=" + tanggal + "&pengawas=" + encodeURIComponent(pengawas), "_blank");
        });

        // Trigger initial refresh if needed
        refresh_topik();
    });
</script>

