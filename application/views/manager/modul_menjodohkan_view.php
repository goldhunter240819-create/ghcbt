<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Soal Menjodohkan
		<small>Form Pembuatan Soal Menjodohkan (Fleksibel)</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Soal Menjodohkan</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="box-header with-border" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="box-title" style="color: white; font-weight: 600;"><i class="fa fa-bolt"></i> Aksi Cepat</h3>
                    <div class="pull-right">
                        <button type="button" onclick="tambah_soal()" class="btn btn-sm btn-primary" style="margin-right: 10px; border-radius: 6px; font-weight: 600; background: rgba(255,255,255,0.2) !important; border: 1px solid rgba(255,255,255,0.4) !important;">
                            <i class="fa fa-plus"></i> TAMBAH SOAL MANUAL
                        </button>
                        <a href="<?php echo site_url('manager/modul_import_word/index/4'); ?>" class="btn btn-sm btn-smart-import" style="background: white !important; color: #4f46e5 !important;"><i class="fa fa-magic"></i> SMART IMPORT WORD</a>
                    </div>
                </div>
                <div class="box-body" style="padding: 25px;">
                    <div class="form-group row" style="margin-bottom: 0;">
                        <label class="col-sm-3 control-label" style="font-size: 16px; margin-top: 8px;">Mata Pelajaran</label>
                        <div class="col-sm-9">
                            <select name="topik" id="topik" class="form-control select2" style="width: 100%;">
                                <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="modal fade" id="modal-edit-soal" role="dialog" data-backdrop="static">
                <div class="modal-dialog modal-lg" style="width: 90%; max-width: 1200px;">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; padding: 20px 25px; border-radius: 20px 20px 0 0;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                            <h4 class="modal-title" style="font-weight: 700;"><i class="fa fa-pencil-square-o"></i> <span id="judul-modal">Form Soal Menjodohkan (Manual)</span></h4>
                        </div>
                        <div class="modal-body" style="padding: 30px; max-height: calc(100vh - 200px); overflow-y: auto; background: var(--bg-wrapper);">
                            <?php echo form_open($url.'/simpan', 'id="form-menjodohkan"'); ?>
                                <input type="hidden" name="soal_id" id="soal_id">
                                <input type="hidden" name="topik_id" id="topik_id">

                                <div class="form-group">
                                    <label>Pertanyaan Utama (Instruksi)</label>
                                    <textarea id="main_question" name="main_question" class="form-control" rows="3" placeholder="Masukkan pertanyaan utama/instruksi menjodohkan..."></textarea>
                                </div>

                                <div class="row">
                                    <!-- KOLOM PERTANYAAN -->
                                    <div class="col-md-6">
                                        <div class="callout callout-info" style="border-radius: 12px; margin-bottom: 15px;">
                                            <h4 style="margin: 0; font-size: 16px;"><i class="fa fa-question-circle"></i> Daftar Pertanyaan (Sisi Kiri)</h4>
                                        </div>
                                        <div id="questions_container" style="min-height: 50px;">
                                            <!-- Dynamic rows will appear here -->
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" onclick="addQuestion()" style="margin-top: 10px;">
                                            <i class="fa fa-plus"></i> Tambah Baris Pertanyaan
                                        </button>
                                    </div>

                                    <!-- KOLOM JAWABAN -->
                                    <div class="col-md-6">
                                        <div class="callout callout-success" style="border-radius: 12px; margin-bottom: 15px;">
                                            <h4 style="margin: 0; font-size: 16px;"><i class="fa fa-check-circle"></i> Daftar Jawaban (Sisi Kanan)</h4>
                                        </div>
                                        <div id="answers_container" style="min-height: 50px;">
                                            <!-- Dynamic rows will appear here -->
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" onclick="addAnswer()" style="margin-top: 10px;">
                                            <i class="fa fa-plus"></i> Tambah Baris Jawaban
                                        </button>
                                    </div>
                                </div>

                                <div class="box-footer" style="margin-top: 30px; padding: 20px 0 0 0; display: flex; gap: 10px; background: transparent;">
                                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="flex: 1; border-radius: 12px;">Batal</button>
                                    <button type="button" class="btn btn-info btn-lg" onclick="showLivePreview()" style="flex: 1; border-radius: 12px;">
                                        <i class="fa fa-eye"></i> Live Preview Siswa
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-lg" style="flex: 2; border-radius: 12px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none;">
                                        <i class="fa fa-save"></i> Simpan Soal Sekarang
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DATATABLE DAFTAR SOAL MENJODOHKAN -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="box" style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-light);">
                <div class="box-header with-border" style="padding: 20px;">
                    <h3 class="box-title" style="font-weight: 700; color: var(--text-bright);">Daftar Soal Menjodohkan</h3>
                </div>
                <div class="box-body" style="padding: 20px;">
                    <table id="table-menjodohkan" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr style="background: var(--bg-body);">
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>Pertanyaan Utama</th>
                                <th style="width: 120px; text-align: center;">Jml Item</th>
                                <th style="width: 100px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Hapus -->
    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header" style="background: var(--bg-body);">
                    <h4 class="modal-title">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 16px;">Apakah Anda yakin ingin menghapus soal menjodohkan ini beserta semua opsi jawabannya?</p>
                    <input type="hidden" id="hapus-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-konfirmasi-hapus" class="btn btn-danger" style="background: #f43f5e !important;">Hapus Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Live Preview -->
<div class="modal fade" id="modal-live-preview" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: var(--bg-body) !important; border-radius: 20px; overflow: hidden;">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-light);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: var(--text-bright); opacity: 1;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: var(--text-bright); font-weight: 600;"><i class="fa fa-desktop"></i> Live Preview (Tampilan Siswa)</h4>
            </div>
            <div class="modal-body" style="padding: 30px; position: relative; min-height: 500px;">
                <p id="preview_instruction" style="color: var(--text-muted); margin-bottom: 30px; font-size: 16px;"></p>
                
                <div class="row" id="preview_container" style="position: relative; z-index: 2;">
                    <!-- Preview content generated by JS -->
                    <div class="col-xs-5" id="preview_questions"></div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-5" id="preview_answers"></div>
                </div>

                <canvas id="preview_canvas" style="position: absolute; top: 0; left: 0; pointer-events: none; z-index: 1;"></canvas>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-light); text-align: center;">
                <p style="color: var(--text-muted); font-size: 12px;"><i class="fa fa-info-circle"></i> Klik pertanyaan lalu klik jawaban untuk menarik garis.</p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Preview</button>
                <button type="button" class="btn btn-warning" onclick="resetPreviewLines()"><i class="fa fa-refresh"></i> Reset Garis</button>
            </div>
        </div>
    </div>
</div>

<style>
    .item-row {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
        animation: fadeIn 0.3s ease-out;
    }
    
    .item-row .form-control {
        flex: 1;
        background: rgba(var(--primary-rgb), 0.05) !important;
        border: 1px solid var(--border-light) !important;
    }
    
    .btn-remove-row {
        width: 42px;
        height: 42px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(244, 63, 94, 0.1) !important;
        color: #f43f5e !important;
        border: 1px solid rgba(244, 63, 94, 0.2) !important;
        transition: all 0.2s;
    }
    
    .btn-remove-row:hover { background: #f43f5e !important; color: white !important; }
    
    /* Preview Styles */
    .preview-item {
        background: var(--bg-box) !important;
        border: 1px solid var(--border-color);
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 12px;
        color: var(--text-main);
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        font-weight: 500;
        position: relative;
    }
    .preview-item:hover { transform: scale(1.02); border-color: var(--accent-color); }
    .preview-item.active { 
        background: var(--primary-gradient) !important; 
        color: white !important;
        box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
    }
    .preview-item.connected { border-color: #10b981; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
    let qCount = 0;
    let aCount = 0;

    function addQuestion(val = '') {
        qCount++;
        const container = document.getElementById('questions_container');
        const div = document.createElement('div');
        div.className = 'item-row';
        div.id = 'q-row-' + qCount;
        div.innerHTML = `
            <input type="text" class="form-control" name="question[]" placeholder="Pertanyaan ke-${qCount}" value="${$('<div>').text(val).html().replace(/"/g, '&quot;')}">
            <button type="button" class="btn btn-remove-row" onclick="removeItem('q-row-${qCount}')"><i class="fa fa-times"></i></button>
        `;
        container.appendChild(div);
    }

    function addAnswer(val = '') {
        aCount++;
        const container = document.getElementById('answers_container');
        const div = document.createElement('div');
        div.className = 'item-row';
        div.id = 'a-row-' + aCount;
        div.innerHTML = `
            <input type="text" class="form-control" name="answer[]" placeholder="Jawaban ke-${aCount}" value="${$('<div>').text(val).html().replace(/"/g, '&quot;')}">
            <button type="button" class="btn btn-remove-row" onclick="removeItem('a-row-${aCount}')"><i class="fa fa-times"></i></button>
        `;
        container.appendChild(div);
    }

    function removeItem(id) {
        const el = document.getElementById(id);
        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'scale(0.9)';
            setTimeout(() => el.remove(), 200);
        }
    }

    // Modal Live Preview Logic
    let selectedQ = null;
    let pairs = [];
    const canvas = document.getElementById('preview_canvas');
    const ctx = canvas.getContext('2d');

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function showLivePreview() {
        const instruction = $('#main_question').val() || "Hubungkanlah pernyataan di kiri dengan jawaban yang benar di kanan!";
        $('#preview_instruction').text(instruction);
        
        const qs = [];
        $('input[name="question[]"]').each(function() { if($(this).val()) qs.push($(this).val()); });
        const as = [];
        $('input[name="answer[]"]').each(function() { if($(this).val()) as.push($(this).val()); });

        if(qs.length == 0 || as.length == 0) {
            notify_error("Harap isi minimal 1 pertanyaan dan 1 jawaban!");
            return;
        }

        $('#preview_questions').empty();
        $('#preview_answers').empty();
        pairs = [];
        selectedQ = null;

        qs.forEach((q, i) => {
            $('#preview_questions').append(`<div class="preview-item q-item" data-id="q${i}">${q}</div>`);
        });

        const shuffledAs = shuffle([...as]);
        shuffledAs.forEach((a, i) => {
            $('#preview_answers').append(`<div class="preview-item a-item" data-id="a${i}">${a}</div>`);
        });

        $('#modal-live-preview').modal('show');
        setTimeout(initCanvas, 500);
    }

    function initCanvas() {
        const modalBody = document.querySelector('#modal-live-preview .modal-body');
        canvas.width = modalBody.offsetWidth;
        canvas.height = modalBody.offsetHeight;
        drawLines();
    }

    function resetPreviewLines() {
        pairs = [];
        $('.preview-item').removeClass('active connected');
        selectedQ = null;
        drawLines();
    }

    $(document).on('click', '.q-item', function() {
        $('.q-item').removeClass('active');
        $(this).addClass('active');
        selectedQ = $(this);
    });

    $(document).on('click', '.a-item', function() {
        if (!selectedQ) return;
        
        // Remove existing link for this question
        const qId = selectedQ.data('id');
        pairs = pairs.filter(p => p.qId !== qId);

        pairs.push({
            qId: qId,
            qEl: selectedQ[0],
            aEl: $(this)[0]
        });

        selectedQ.removeClass('active').addClass('connected');
        $(this).addClass('connected');
        selectedQ = null;
        drawLines();
    });

    function drawLines() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        const bodyRect = document.querySelector('#modal-live-preview .modal-body').getBoundingClientRect();

        pairs.forEach((pair, index) => {
            const qRect = pair.qEl.getBoundingClientRect();
            const aRect = pair.aEl.getBoundingClientRect();

            const x1 = qRect.right - bodyRect.left;
            const y1 = qRect.top + qRect.height / 2 - bodyRect.top;

            const x2 = aRect.left - bodyRect.left;
            const y2 = aRect.top + aRect.height / 2 - bodyRect.top;

            const distance = Math.abs(x2 - x1);
            const curve = distance / 2;

            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.bezierCurveTo(x1 + curve, y1, x2 - curve, y2, x2, y2);

            const colors = ["#6366f1", "#10b981", "#f43f5e", "#0ea5e9", "#f59e0b"];
            ctx.strokeStyle = colors[index % colors.length];
            ctx.lineWidth = 4;
            ctx.lineCap = "round";
            ctx.stroke();
        });
    }

    $(document).ready(function() {
        var table = $('#table-menjodohkan').DataTable({
            "paging": true,
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "searching": true,
            "sAjaxSource": "<?php echo site_url($url.'/get_datatable'); ?>",
            "autoWidth": false,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "topik", "value": $('#topik').val()});
            }
        });

        $('#topik').change(function() {
            table.draw();
        });

        window.hapus = function(id) {
            $('#hapus-id').val(id);
            $('#modal-hapus').modal('show');
        };

        $('#btn-konfirmasi-hapus').click(function() {
            var id = $('#hapus-id').val();
            $('#modal-proses').modal('show');
            $.ajax({
                url: "<?php echo site_url($url.'/hapus_soal'); ?>",
                type: "POST", data: { 'hapus-id': id },
                success: function(respon) {
                    var obj = $.parseJSON(respon);
                    $('#modal-proses').modal('hide');
                    $('#modal-hapus').modal('hide');
                    if (obj.status == 1) {
                        notify_success(obj.pesan);
                        table.draw();
                    } else {
                        notify_error(obj.pesan);
                    }
                }
            });
        });

        window.tambah_soal = function() {
            var topik_id = $('#topik').val();
            if(!topik_id || topik_id == 'kosong' || topik_id == '') {
                notify_error('Silahkan pilih Mata Pelajaran terlebih dahulu!');
                return;
            }
            $('#soal_id').val('');
            $('#main_question').val('');
            $('#questions_container').empty();
            $('#answers_container').empty();
            for(let i = 0; i < 3; i++) addQuestion();
            for(let i = 0; i < 4; i++) addAnswer();
            
            $('#judul-modal').text('Input Detail Soal Menjodohkan (Manual)');
            $('#modal-edit-soal').modal('show');
        };

        window.edit = function(id) {
            $('#modal-proses').modal('show');
            $.getJSON("<?php echo site_url($url.'/get_by_id/'); ?>" + id, function(data) {
                $('#modal-proses').modal('hide');
                if (data.data == 1) {
                    $('#topik').val(data.id_topik).trigger('change');
                    $('#soal_id').val(data.id);
                    $('#main_question').val(data.soal);
                    
                    $('#questions_container').empty();
                    $('#answers_container').empty();
                    
                    qCount = 0;
                    aCount = 0;

                    let addedPairsLeft = 0;
                    let addedPairsRight = 0;

                    if(data.pairs && data.pairs.length > 0) {
                        data.pairs.forEach(function(pair) {
                            if(pair.kiri && pair.kiri.trim() !== '') {
                                addQuestion(pair.kiri);
                                addedPairsLeft++;
                            }
                            if(pair.kanan && pair.kanan.trim() !== '') {
                                addAnswer(pair.kanan);
                                addedPairsRight++;
                            }
                        });
                    }

                    if(addedPairsLeft == 0) addQuestion();
                    if(addedPairsRight == 0) addAnswer();

                    $('#judul-modal').text('Edit Detail Soal Menjodohkan (Manual)');
                    $('#modal-edit-soal').modal('show');
                } else {
                    notify_error('Gagal mengambil data soal!');
                }
            }).fail(function() {
                $('#modal-proses').modal('hide');
                notify_error('Gagal menghubungi server!');
            });
        };

        $('.select2').select2();

        $('#form-menjodohkan').submit(function(e) {
            e.preventDefault();
            $('#topik_id').val($('#topik').val());
            $('#modal-proses').modal('show');
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                cache: false,
                success: function(respon) {
                    $('#modal-proses').modal('hide');
                    const obj = $.parseJSON(respon);
                    if (obj.status == 1) {
                        $('#modal-edit-soal').modal('hide');
                        notify_success(obj.pesan);
                        table.draw();
                    } else {
                        Swal.fire({ title: 'Gagal!', text: obj.pesan, icon: 'error' });
                    }
                },
                error: function() {
                    $('#modal-proses').modal('hide');
                    notify_error("Gagal terhubung ke server!");
                }
            });
        });
        
        // Auto-edit from URL hash
        setTimeout(function() {
            var hash = window.location.hash;
            if(hash.indexOf('#edit-') !== -1){
                var id = hash.replace('#edit-', '');
                if(id) edit(id);
            }
        }, 500);
    });
</script>
