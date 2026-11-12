

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #065f46 0%, #10b981 100%);
        --accent-color: #10b981;
        --border-color: #e2e8f0;
    }
    body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
    .content-header h1 { font-weight: 700; color: #1e293b; letter-spacing: -0.5px; }
    
    .premium-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        margin-bottom: 30px;
    }
    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-color);
        background: #f8fafc;
        border-radius: 16px 16px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-title { font-size: 16px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 10px; }
    
    .table-grid { width: 100%; border-collapse: separate; border-spacing: 0; }
    .table-grid th {
        background: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        padding: 15px;
        text-align: center;
        border-bottom: 2px solid var(--border-color);
        border-right: 1px solid var(--border-color);
    }
    .table-grid td {
        padding: 10px;
        border-bottom: 1px solid var(--border-color);
        border-right: 1px solid var(--border-color);
        background: white;
        min-width: 150px;
    }
    .table-grid th:first-child, .table-grid td:first-child {
        position: sticky; left: 0; z-index: 10; background: #f8fafc; min-width: 140px; font-weight: 700;
    }
    
    .select-guru {
        width: 100%; border: 1px solid #cbd5e1; background: white; padding: 8px; border-radius: 8px; font-size: 13px; color: #334155; cursor: pointer; outline: none;
    }
    .select-guru:focus { border-color: var(--accent-color); }
    .select-guru.active-slot { background: #ecfdf5; color: #065f46; font-weight: 600; border-color: #a7f3d0; }
    .select-guru.break-slot { background: #fee2e2; color: #991b1b; font-weight: 600; border-color: #fca5a5; }
    
    .time-input { border: 1px solid #e2e8f0; border-radius: 6px; background: white; font-weight: 700; text-align: center; width: 100%; color: #1e293b; padding: 4px; }
    .top-filter { display: flex; align-items: center; gap: 10px; background: white; padding: 8px 15px; border-radius: 12px; border: 1px solid var(--border-color); }

    .btn-save-all {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 14px 40px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3) !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-save-all:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 15px 25px -5px rgba(16, 185, 129, 0.4) !important;
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }
</style>

<section class="content-header">
	<h1>
		Konfigurasi Jadwal Pengawas
		<small>Atur jadwal pengawas ujian mingguan per kelas atau semua kelas</small>
	</h1>
</section>

<section class="content">
    <div class="premium-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="calendar"></i> GRID JADWAL PENGAWAS
            </div>
            <div class="top-filter">
                <span style="font-weight: 600; font-size: 13px;">Filter Kelas:</span>
                <select id="filter-grup" class="form-control select2" style="width: 180px;">
                    <option value="all">ðŸŒ SEMUA KELAS</option>
                    <?php if(!empty($select_grup)){ foreach($select_grup as $g){
                        echo '<option value="'.$g->grup_id.'">'.$g->grup_nama.'</option>';
                    } } ?>
                </select>
                <span style="font-weight: 600; font-size: 13px; margin-left: 15px;">Topik Cetak:</span>
                <select id="filter-modul" class="form-control select2" style="width: 200px;">
                    <?php if(!empty($select_modul)){ foreach($select_modul as $m){
                        $selected = ($m->modul_aktif == 1) ? 'selected' : '';
                        echo '<option value="'.$m->modul_id.'" '.$selected.'>'.$m->modul_nama.'</option>';
                    } } ?>
                </select>
                <button class="btn btn-default btn-sm" id="btn-refresh" style="margin-left: 10px;"><i data-lucide="refresh-cw"></i></button>
                <button class="btn btn-warning btn-sm" id="btn-generate" style="margin-left: 5px;"><i data-lucide="settings"></i> GENERATE OTOMATIS</button>
                <button class="btn btn-info btn-sm" id="btn-cetak" style="margin-left: 5px;"><i data-lucide="printer"></i> CETAK JADWAL</button>
                <input type="date" id="start-date" class="hidden" value="<?php echo date('Y-m-d', strtotime('monday this week')); ?>">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table class="table-grid" id="grid-jadwal">
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th>SENIN</th>
                        <th>SELASA</th>
                        <th>RABU</th>
                        <th>KAMIS</th>
                        <th>JUMAT</th>
                        <th>SABTU</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $times = [
                        ['07.30', '09.00'],
                        ['09.00', '10.30'],
                        ['10.30', '11.00'],
                        ['11.00', '12.30'],
                        ['13.00', '14.30'],
                        ['14.30', '16.00']
                    ];
                    foreach($times as $i => $t){
                        echo '<tr>';
                        echo '<td><input type="text" class="time-input" value="'.$t[0].' - '.$t[1].'" id="range-'.$i.'"></td>';
                        for($d=0; $d<6; $d++){
                            echo '<td>
                                    <select class="select-guru" data-day="'.$d.'" data-slot="'.$i.'">
                                        <option value="">- Kosong -</option>
                                        <option value="ISTIRAHAT">ISTIRAHAT</option>';
                                        foreach($select_guru as $gr){
                                            echo '<option value="'.$gr->id.'">'.$gr->nama.'</option>';
                                        }
                            echo '  </select>
                                  </td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer text-center" style="background: #f8fafc !important; border-top: 1px solid #e2e8f0 !important; padding: 30px !important;">
            <button class="btn btn-save-all" id="btn-save-config">
                <i class="fa fa-save" style="margin-right: 10px;"></i> SIMPAN JADWAL PENGAWAS
            </button>
        </div>
    </div>
</section>

<!-- Modal Generate Pengawas -->
<div class="modal fade" id="modal-generate-pengawas" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header" style="background: var(--primary-gradient); color: white;">
                <h4 class="modal-title" style="font-weight: 700;"><i data-lucide="settings"></i> Generate Pengawas Otomatis</h4>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="alert alert-info" style="border-radius: 8px;">
                    <i data-lucide="info"></i> Sistem akan membagikan jadwal mengawas ke guru-guru yang dicentang secara adil tanpa bentrok.
                </div>
                <p style="font-weight: 600;">Pilih Guru yang Boleh Mengawas:</p>
                <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                    <label style="display: block; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                        <input type="checkbox" id="checkall-guru" checked> <strong>Pilih Semua</strong>
                    </label>
                    <?php foreach($select_guru as $gr): ?>
                    <label style="display: block; font-weight: normal; margin-bottom: 5px;">
                        <input type="checkbox" class="guru-checklist" value="<?php echo $gr->id; ?>" checked> <?php echo $gr->nama; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-run-generate" style="background: var(--accent-color); border: none; font-weight: 700;">Generate Sekarang</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('.select2').select2();

        function sync_dropdowns() {
            // For Pengawas, maybe we don't need to disable options like we do for Mapel, 
            // since a teacher can theoretically invigilate multiple consecutive sessions 
            // in the same room. Or maybe we shouldn't allow the same teacher in the same time slot?
            // Actually, in a single room (class), one teacher is fine for consecutive.
            // We'll leave the sync logic but maybe disable it if it causes issues.
            // Let's just color them for now without disabling.
        }

        function load_jadwal(){
            var grup_id = $('#filter-grup').val();
            $('.select-guru').val('').removeClass('active-slot break-slot').css('pointer-events', 'auto');
            if(grup_id == 'all') {
                return;
            }

            $.getJSON("<?php echo site_url($url.'/get_jadwal_by_grup'); ?>?grup_id=" + grup_id, function(data){
                var pengawas = data.pengawas;
                var ujian = data.ujian;

                // Pass 1: Extract unique time ranges from UJIAN
                var unique_ranges = [];
                $.each(ujian, function(i, item){
                    if(unique_ranges.indexOf(item.jadwal_range) === -1){
                        unique_ranges.push(item.jadwal_range);
                    }
                });
                
                unique_ranges.sort(); // Sort chronologically
                
                var time_inputs = $('.time-input');
                for(var i = 0; i < unique_ranges.length; i++){
                    if(i < time_inputs.length){
                        $(time_inputs[i]).val(unique_ranges[i]);
                    }
                }

                // Pass 2: Plot UJIAN data to lock ISTIRAHAT
                $.each(ujian, function(i, item){
                    if(item.jadwal_topik_id == 'ISTIRAHAT'){
                        var range_str = item.jadwal_range;
                        var day = item.jadwal_day;
                        $('.time-input').each(function(){
                            if($(this).val() == range_str){
                                var slot_idx = $(this).attr('id').split('-')[1];
                                var cell = $('.select-guru[data-day="'+day+'"][data-slot="'+slot_idx+'"]');
                                cell.val('ISTIRAHAT').addClass('break-slot').css('pointer-events', 'none');
                            }
                        });
                    }
                });

                // Pass 3: Plot PENGAWAS data
                $.each(pengawas, function(i, item){
                    var range_str = item.jadwal_range;
                    var day = item.jadwal_day;
                    var guru_id = item.jadwal_guru_id;

                    $('.time-input').each(function(){
                        if($(this).val() == range_str){
                            var slot_idx = $(this).attr('id').split('-')[1];
                            var cell = $('.select-guru[data-day="'+day+'"][data-slot="'+slot_idx+'"]');
                            if(cell.val() != 'ISTIRAHAT') {
                                cell.val(guru_id);
                                if(guru_id) cell.addClass('active-slot');
                            }
                        }
                    });
                });
            });
        }

        $('#filter-grup').on('change', function(){
            load_jadwal();
        });

        $('.select-guru').on('change', function(){
            var val = $(this).val();
            $(this).removeClass('active-slot break-slot');
            if(val == 'ISTIRAHAT') $(this).addClass('break-slot');
            else if(val != '') $(this).addClass('active-slot');
        });

        $('#btn-save-config').on('click', function(){
            var grup_id = $('#filter-grup').val();
            var grid_data = [];
            $('.select-guru').each(function(){
                var val = $(this).val();
                if(val){
                    grid_data.push({
                        guru_id: val,
                        day: $(this).data('day'),
                        slot: $(this).data('slot'),
                        range: $('#range-' + $(this).data('slot')).val()
                    });
                }
            });

            $(this).html('<i data-lucide="loader" class="fa-spin"></i> MENYIMPAN...').attr('disabled', true);
            var self = $(this);

            $.ajax({
                url: "<?php echo site_url($url.'/simpan_semua_jadwal_pengawas'); ?>",
                type: "POST",
                data: { grup_id: grup_id, grid_data: JSON.stringify(grid_data) },
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1) Swal.fire('Sukses', obj.pesan, 'success');
                    else Swal.fire('Gagal', obj.pesan, 'error');
                    self.html('<i data-lucide="save"></i> SIMPAN JADWAL PENGAWAS').attr('disabled', false);
                },
                error: function(){
                    Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                    self.html('<i data-lucide="save"></i> SIMPAN JADWAL PENGAWAS').attr('disabled', false);
                }
            });
        });

        $('#btn-cetak').on('click', function(){
            var grup_id = $('#filter-grup').val();
            var modul_id = $('#filter-modul').val();
            if(!grup_id || grup_id == 'all'){
                Swal.fire('Perhatian', 'Pilih Kelas yang spesifik untuk dicetak Master!', 'warning');
                return;
            }
            window.open("<?php echo site_url($url.'/cetak'); ?>/" + grup_id + "/" + modul_id, "_blank");
        });

        $('#btn-refresh').on('click', function(){
            load_jadwal();
        });

        $('#btn-generate').on('click', function(){
            var grup_id = $('#filter-grup').val();
            if(!grup_id){
                Swal.fire('Perhatian', 'Pilih kelas terlebih dahulu atau pilih Semua Kelas!', 'warning');
                return;
            }
            $('#modal-generate-pengawas').modal('show');
        });

        $('#checkall-guru').on('click', function(){
            $('.guru-checklist').prop('checked', this.checked);
        });

        $('#btn-run-generate').on('click', function(){
            var grup_id = $('#filter-grup').val();
            var guru_ids = [];
            $('.guru-checklist:checked').each(function(){
                guru_ids.push($(this).val());
            });

            if(guru_ids.length === 0){
                Swal.fire('Perhatian', 'Pilih minimal satu guru!', 'warning');
                return;
            }

            $(this).html('<i data-lucide="loader" class="fa-spin"></i> Memproses...').attr('disabled', true);
            var self = $(this);

            $.ajax({
                url: "<?php echo site_url($url.'/generate_pengawas_otomatis'); ?>",
                type: "POST",
                data: { grup_id: grup_id, guru_ids: guru_ids },
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1){
                        Swal.fire('Sukses', obj.pesan, 'success');
                        $('#modal-generate-pengawas').modal('hide');
                        load_jadwal(); // Reload grid
                    } else {
                        Swal.fire('Gagal', obj.pesan, 'error');
                    }
                    self.html('Generate Sekarang').attr('disabled', false);
                },
                error: function(){
                    Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                    self.html('Generate Sekarang').attr('disabled', false);
                }
            });
        });
    });
</script>

