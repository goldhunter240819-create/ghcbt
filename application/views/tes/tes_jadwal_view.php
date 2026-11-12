

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
    
    .select-mapel {
        width: 100%; border: 1px solid #cbd5e1; background: white; padding: 8px; border-radius: 8px; font-size: 13px; color: #334155; cursor: pointer; outline: none;
    }
    .select-mapel:focus { border-color: var(--accent-color); }
    .select-mapel.active-slot { background: #ecfdf5; color: #065f46; font-weight: 600; border-color: #a7f3d0; }
    .select-mapel.break-slot { background: #fee2e2; color: #991b1b; font-weight: 600; border-color: #fca5a5; }
    
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
		Konfigurasi Jadwal Ujian
		<small>Atur jadwal pelajaran/ujian mingguan per kelas atau semua kelas</small>
	</h1>
</section>

<section class="content">
    <div class="premium-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="calendar"></i> GRID JADWAL PELAJARAN
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
                <button class="btn btn-sm" id="btn-cetak" style="margin-left: 5px; background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; color: #ffffff !important; font-weight: bold; border-radius: 8px; border: none !important; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2) !important;"><i data-lucide="printer"></i> CETAK JADWAL</button>
                <div style="margin-left: auto; display: flex; align-items: center; gap: 8px;">
                    <span style="font-weight: 600; font-size: 13px; color: #1e293b;">Mulai Tanggal (Senin):</span>
                    <input type="date" id="start-date" class="form-control" style="width: 140px; padding: 4px; border-radius: 6px; border: 1px solid var(--border-color); color: #0f172a; font-weight: 500;" value="<?php echo date('Y-m-d', strtotime('monday this week')); ?>">
                </div>
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table class="table-grid" id="grid-jadwal">
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th id="th-day-0">SENIN (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-1">SELASA (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-2">RABU (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-3">KAMIS (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-4">JUMAT (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-5">SABTU (M1)<br><small class="th-date"></small></th>
                        <th id="th-day-7" style="border-left: 3px solid #cbd5e1;">SENIN (M2)<br><small class="th-date"></small></th>
                        <th id="th-day-8">SELASA (M2)<br><small class="th-date"></small></th>
                        <th id="th-day-9">RABU (M2)<br><small class="th-date"></small></th>
                        <th id="th-day-10">KAMIS (M2)<br><small class="th-date"></small></th>
                        <th id="th-day-11">JUMAT (M2)<br><small class="th-date"></small></th>
                        <th id="th-day-12">SABTU (M2)<br><small class="th-date"></small></th>
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
                        $days = [0, 1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12];
                        foreach($days as $d){
                            $extra_style = ($d == 7) ? 'border-left: 3px solid #cbd5e1;' : '';
                            echo '<td style="'.$extra_style.'">
                                    <select class="select-mapel" data-day="'.$d.'" data-slot="'.$i.'">
                                        <option value="">- Kosong -</option>
                                        <option value="ISTIRAHAT">☕ ISTIRAHAT</option>';
                                        foreach($select_topik as $tp){
                                            echo '<option value="'.$tp->topik_id.'">'.$tp->topik_nama.'</option>';
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
        <div class="box-footer text-center" style="background: #f8fafc; padding: 30px;">
            <button class="btn btn-save-all" id="btn-save-config">
                <i class="fa fa-save" style="margin-right: 10px;"></i> SIMPAN KONFIGURASI JADWAL
            </button>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('.select2').select2();

        function sync_dropdowns() {
            var selected_values = [];
            $('.select-mapel').each(function() {
                var val = $(this).val();
                if (val && val !== 'ISTIRAHAT') {
                    selected_values.push(val);
                }
            });

            $('.select-mapel').each(function() {
                var current_val = $(this).val();
                $(this).find('option').each(function() {
                    var opt_val = $(this).val();
                    if (opt_val && opt_val !== 'ISTIRAHAT' && opt_val !== current_val) {
                        if (selected_values.indexOf(opt_val) !== -1) {
                            $(this).hide().attr('disabled', true);
                        } else {
                            $(this).show().attr('disabled', false);
                        }
                    }
                });
            });
        }

        function load_jadwal(){
            var grup_id = $('#filter-grup').val();
            $('.select-mapel').val('').removeClass('active-slot break-slot');
            if(grup_id == 'all') {
                sync_dropdowns();
                return;
            }

            $.getJSON("<?php echo site_url($url.'/get_jadwal_by_grup'); ?>?grup_id=" + grup_id, function(data){
                // Pass 1: Extract unique time ranges and assign them to rows
                var unique_ranges = [];
                $.each(data, function(i, item){
                    if(unique_ranges.indexOf(item.jadwal_range) === -1){
                        unique_ranges.push(item.jadwal_range);
                    }
                });
                
                unique_ranges.sort(); // Sort chronologically (07.00 before 08.00)
                
                var time_inputs = $('.time-input');
                for(var i = 0; i < unique_ranges.length; i++){
                    if(i < time_inputs.length){
                        $(time_inputs[i]).val(unique_ranges[i]);
                    }
                }

                // Pass 2: Plot the items into the grid
                $.each(data, function(i, item){
                    var range_str = item.jadwal_range;
                    var day = item.jadwal_day;
                    var topik_id = item.jadwal_topik_id;

                    $('.time-input').each(function(){
                        if($(this).val() == range_str){
                            var slot_idx = $(this).attr('id').split('-')[1];
                            var cell = $('.select-mapel[data-day="'+day+'"][data-slot="'+slot_idx+'"]');
                            cell.val(topik_id);
                            
                            if(topik_id == 'ISTIRAHAT') cell.addClass('break-slot');
                            else if(topik_id) cell.addClass('active-slot');
                        }
                    });
                });
                sync_dropdowns();
            });
        }

        $('#filter-grup').on('change', function(){
            load_jadwal();
        });

        $('.select-mapel').on('change', function(){
            var val = $(this).val();
            $(this).removeClass('active-slot break-slot');
            if(val == 'ISTIRAHAT') $(this).addClass('break-slot');
            else if(val != '') $(this).addClass('active-slot');
            
            sync_dropdowns();
        });

        $('#btn-save-config').on('click', function(){
            var grup_id = $('#filter-grup').val();
            var grid_data = [];
            $('.select-mapel').each(function(){
                var val = $(this).val();
                if(val){
                    grid_data.push({
                        topik_id: val,
                        day: $(this).data('day'),
                        slot: $(this).data('slot'),
                        range: $('#range-' + $(this).data('slot')).val()
                    });
                }
            });

            $(this).html('<i data-lucide="loader" class="fa-spin"></i> MENYIMPAN...').attr('disabled', true);
            var self = $(this);
            var startDate = $('#start-date').val();

            $.ajax({
                url: "<?php echo site_url($url.'/simpan_semua_jadwal_v3'); ?>",
                type: "POST",
                data: { grup_id: grup_id, grid_data: JSON.stringify(grid_data), start_date: startDate },
                success: function(respon){
                    var obj = $.parseJSON(respon);
                    if(obj.status == 1) Swal.fire('Sukses', obj.pesan, 'success');
                    else Swal.fire('Gagal', obj.pesan, 'error');
                    self.html('<i data-lucide="save"></i> SIMPAN KONFIGURASI JADWAL').attr('disabled', false);
                },
                error: function(){
                    Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
                    self.html('<i data-lucide="save"></i> SIMPAN KONFIGURASI JADWAL').attr('disabled', false);
                }
            });
        });

        $('#btn-cetak').on('click', function(){
            var grup_id = $('#filter-grup').val();
            var modul_id = $('#filter-modul').val();
            var start_date = $('#start-date').val();
            if(!grup_id || grup_id == 'all'){
                Swal.fire('Perhatian', 'Pilih Kelas yang spesifik untuk dicetak Master!', 'warning');
                return;
            }
            window.open("<?php echo site_url($url.'/cetak'); ?>/" + grup_id + "/" + modul_id + "?start_date=" + start_date, "_blank");
        });

        $('#btn-refresh').on('click', function(){
            load_jadwal();
        });

        sync_dropdowns();
    });
</script>

