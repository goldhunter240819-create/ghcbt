<style type="text/css">
    /* Premium Matching Grid */
    .matching-grid-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-top: 20px;
        position: relative;
    }
    .matching-column {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .matching-header-label {
        text-align: center; 
        color: var(--text-muted); 
        font-size: 11px; 
        font-weight: 700; 
        text-transform: uppercase; 
        margin-bottom: 5px; 
        letter-spacing: 1.5px;
        opacity: 0.7;
    }
    .matching-card {
        background: var(--bg-box);
        border: 1px solid var(--border-light);
        padding: 10px 15px;
        border-radius: 10px;
        color: var(--text-main);
        font-weight: 500;
        text-align: center;
        transition: all 0.2s ease;
        position: relative;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
        font-size: 13px;
        cursor: pointer;
        user-select: none;
    }
    .matching-card:hover {
        border-color: var(--accent-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.15);
    }
    .matching-card.active {
        background: var(--primary-gradient) !important;
        color: white !important;
        border-color: transparent !important;
        box-shadow: 0 4px 15px rgba(var(--primary-rgb), 0.4);
    }
    .matching-card.connected {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.05);
    }

    /* Opsi Checklist / Radio Styling - COMPACT & ELEGANT */
    .options-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .opsi-checklist {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        background: var(--bg-box);
        border: 1px solid var(--border-light);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        width: fit-content;
        min-width: 280px;
        max-width: 100%;
    }
    .opsi-checklist:hover {
        border-color: var(--accent-color);
        background: rgba(var(--primary-rgb), 0.02);
    }
    .opsi-checklist.active {
        border-color: var(--accent-color);
        background: rgba(var(--primary-rgb), 0.05);
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.08);
    }
    .opsi-checklist input[type="radio"], 
    .opsi-checklist input[type="checkbox"] {
        margin: 0 12px 0 0 !important;
        transform: scale(1.1);
        cursor: pointer;
        flex-shrink: 0;
    }
    .opsi-checklist label {
        cursor: pointer;
        font-weight: 500;
        margin-bottom: 0 !important;
        display: block;
        color: var(--text-main);
        font-size: 14px;
        line-height: 1.4;
        transition: color 0.2s;
    }
    .opsi-checklist label p {
        margin: 0 !important;
        display: inline-block;
    }
    .opsi-checklist.active label {
        color: var(--text-bright);
        font-weight: 700;
    }

    /* Premium Short Answer Styling */
    .short-answer-wrapper {
        padding: 20px;
        background: rgba(var(--primary-rgb), 0.03);
        border-radius: 15px;
        border: 2px dashed var(--border-light);
        text-align: center;
    }
    .short-answer-input {
        max-width: 400px !important;
        margin: 0 auto !important;
        text-align: center;
        font-size: 18px !important;
        font-weight: 600 !important;
        padding: 10px !important;
        border-radius: 12px !important;
        height: 50px !important;
        border: 2px solid var(--border-light) !important;
    }

    /* Premium Essay Styling */
    .essay-wrapper {
        position: relative;
        background: var(--bg-box);
        border-radius: 16px;
        border: 1px solid var(--border-light);
        padding: 3px;
        transition: all 0.3s ease;
        margin-top: 15px;
    }
    .essay-input {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 15px !important;
        min-height: 200px !important;
        font-size: 15px !important;
        color: var(--text-main) !important;
    }
    .essay-footer {
        padding: 10px 15px;
        background: rgba(var(--primary-rgb), 0.05);
        border-top: 1px solid var(--border-light);
        border-radius: 0 0 16px 16px;
        font-size: 13px;
    }
    /* Checklist Round Multi-Select Styling */
    .opsi-bulat-multi {
        position: relative;
        display: flex !important;
        align-items: center;
        padding-left: 12px !important;
    }
    .indicator-bulat {
        width: 22px;
        height: 22px;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s cubic-bezier(0.18, 0.89, 0.32, 1.28);
        flex-shrink: 0;
        background: var(--bg-body);
        position: relative;
    }
    .indicator-bulat::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #ffffff;
        border-radius: 50%;
        transform: scale(0);
        transition: all 0.2s cubic-bezier(0.18, 0.89, 0.32, 1.28);
    }
    .opsi-bulat-multi.active .indicator-bulat {
        background: var(--primary-gradient);
        border-color: transparent;
        box-shadow: 0 0 10px rgba(var(--primary-rgb), 0.4);
    }
    .opsi-bulat-multi.active .indicator-bulat::after {
        transform: scale(1);
    }
    .opsi-bulat-multi:hover .indicator-bulat {
        border-color: var(--accent-color);
    }
    
    /* Footer Fix for Dark Mode */
    .box-footer {
        background: transparent !important;
        padding: 20px !important;
        border-top: 1px solid var(--border-light) !important;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }
    
    /* Ensuring Question Content Contrast */
    #isi-tes-soal, #isi-tes-soal * {
        color: var(--text-main);
    }
    [data-theme="darkblue"] #isi-tes-soal, [data-theme="darkblue"] #isi-tes-soal * {
        color: #e2e8f0;
    }
</style>
<div class="container">
	<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ujian : <?php if(!empty($tes_name)){ echo $tes_name; } ?>
        </h1>
        <div class="breadcrumb">
            <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="20" onclick="zoomnormal()" title="Klik ukuran font normal" />&nbsp;&nbsp;
            <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="26" onclick="zoombesar()" title="Klik ukuran font lebih besar" />
        </div>
    </section>

	<!-- Main content -->
    <section class="content">
    	<div class="row">
        <?php echo form_open('tes_kerjakan/simpan_jawaban','id="form-kerjakan"')?>
            <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
            <input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
            <input type="hidden" name="tes-soal-id" id="tes-soal-id" value="<?php if(!empty($tes_soal_id)){ echo $tes_soal_id; } ?>">
            <input type="hidden" name="tes-soal-nomor" id="tes-soal-nomor"  value="<?php if(!empty($tes_soal_nomor)){ echo $tes_soal_nomor; } ?>">
            <input type="hidden" name="tes-soal-jml" id="tes-soal-jml" value="<?php if(!empty($tes_soal_jml)){ echo $tes_soal_jml; } ?>">
            <input type="hidden" name="tes-soal-ragu" id="tes-soal-ragu" value="<?php if(!empty($tes_ragu)){ echo $tes_ragu; } ?>">
    		<div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Soal <span id="judul-soal"><?php if(!empty($tes_soal_nomor)){ echo 'ke '.$tes_soal_nomor; } ?></span></h3>
                    <div class="box-tools pull-right">
                        <div class="pull-right">
                            <div id="sisa-waktu"></div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div id="isi-tes-soal" style="font-size: 15px; position: relative;">
                        <?php if(!empty($tes_soal)){ echo $tes_soal; } ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" class="btn btn-default hide" id="btn-sebelumnya">Soal Sebelumnya</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" id="btn-simpan-manual" onclick="jawab_manual()" style="font-weight: 600; border-radius: 8px;">
                        <i class="fa fa-save"></i> Simpan Jawaban
                    </button>&nbsp;&nbsp;&nbsp;
                    <div class="btn btn-warning" id="btn-ragu" onclick="ragu()">
                        <input type="checkbox" style="width:10px;height:10px;" name="btn-ragu-checkbox" id="btn-ragu-checkbox" <?php if(!empty($tes_ragu)){ echo "checked"; } ?> /> Ragu-ragu
                    </div>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-default" id="btn-selanjutnya">Soal Selanjutnya</button>
                </div>
            </div><!-- /.box -->
        </form>
    	</div>
        <div class="row">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Soal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php if(!empty($tes_daftar_soal)){ echo $tes_daftar_soal; } ?>
                    <p class="help-block">Soal yang sudah dijawab akan berwarna Biru.</p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default pull-right" id="btn-hentikan">Hentikan Ujian</button>
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->

    <div class="modal" style="max-height: 100%;overflow-y: auto;" id="modal-hentikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hentikan_tes','id="form-hentikan"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Konfirmasi Hentikan Ujian</div>
                </div>
                <div class="modal-body" >
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="callout callout-info">
                                <p>Apakah anda yakin mengakhiri mata uji ini ?
								<br />Jawaban Ujian yang sudah selesai tidak dapat diubah.
								</p>
								
                            </div>
                            <div class="form-group">
                                <label>Nama Ujian</label>
                                <input type="hidden" name="hentikan-tes-id" id="hentikan-tes-id" >
                                <input type="hidden" name="hentikan-tes-user-id" id="hentikan-tes-user-id" >
                                <input type="text" class="form-control" id="hentikan-tes-nama" name="hentikan-tes-nama" readonly>
                            </div>

                            <div class="form-group">
                                <label>Keterangan Soal</label>
                                <input type="text" class="form-control" id="hentikan-dijawab" name="hentikan-dijawab" readonly>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="hentikan-centang" name="hentikan-centang" value="1"> Centang dan klik tombol Hentikan Ujian.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="box-footer">
					<button type="submit" id="tambah-simpan" class="btn btn-primary">Hentikan Ujian</button>
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				</div>
            </div>
        </div>

    </form>
    </div>

    <!-- Modal Anti Cheat Layout -->
    <div class="modal" id="modal-anticheat" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="z-index: 99999;">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 2px solid #f43f5e;">
                <div class="modal-header" style="background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); color: #ffffff;">
                    <h4 class="modal-title" id="anticheat-title" style="color: white; font-weight: bold;">PERINGATAN PELANGGARAN!</h4>
                </div>
                <div class="modal-body" style="font-size: 16px; text-align: center; padding: 30px;">
                    <i class="fa fa-warning fa-4x" style="color: #f43f5e; margin-bottom: 20px;"></i>
                    <div id="anticheat-msg" style="white-space: pre-line; padding: 15px; border-radius: 8px; background-color: rgba(244, 63, 94, 0.1); color: var(--text-main); font-weight: 600;"></div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-mengerti" style="width: 150px; font-weight: bold;">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Anti Cheat -->

</div><!-- /.container -->

<script type="text/javascript">
    function zoombesar(){
        $('#isi-tes-soal').css("font-size", "140%");
        $('#isi-tes-soal').css("line-height", "140%");
    }

    function zoomnormal(){
        $('#isi-tes-soal').css("font-size", "15px");
        $('#isi-tes-soal').css("line-height", "110%");
    }

    function ragu(){
        $("#modal-proses").modal('show');

        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_tes_soal_by_tessoal/'+$('#tes-soal-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    // Mengubah nilai ragu-ragu di database
                    if($('#tes-soal-ragu').val()==0){
                        var ragu=1;
                    }else{
                        var ragu=0;
                    }
                    $.ajax({
                            url:'<?php echo site_url().'/'.$url; ?>/update_tes_soal_ragu/'+$('#tes-soal-id').val()+'/'+ragu,
                            type:"POST",
                            cache: false,
                            timeout: 5000,
                            success:function(respon){
                                var data = $.parseJSON(respon);
                                if(data.data==1){
                                    notify_success('Jawaban Ragu-ragu berhasil diubah');
                                }
                            },
                            error: function(xmlhttprequest, textstatus, message) {
                                if(textstatus==="timeout") {
                                    $("#modal-proses").modal('hide');
                                    notify_error("Gagal mengubah Soal, Silahkan Refresh Halaman");
                                }else{
                                    $("#modal-proses").modal('hide');
                                    notify_error(textstatus);
                                }
                            }
                    });

                    // Mengubah warna daftar soal dan checkbox pada tombol ragu-ragu
                    if(data.tessoal_dikerjakan==1){
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-primary');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-primary');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }else{
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-default');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-default');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengubah soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function soal(tessoal_id){
        $("#modal-proses").modal('show');
        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_soal_by_tessoal/'+tessoal_id+'/'+$('#tes-user-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    $('#tes-soal-id').val(data.tes_soal_id);
                    $('#tes-soal-nomor').val(data.tes_soal_nomor);
                    $('#isi-tes-soal').html(data.tes_soal);
                    $('#tes-soal-ragu').val(data.tes_ragu);
                    $('#judul-soal').html('ke '+data.tes_soal_nomor);

                    if(data.tes_ragu==0){
                        // Menghilangkan checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", false);
                    }else{
                        // Menambah checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", true);
                    }

                    // menghilangkan tombol sebelum jika soal di nomor1
                    // dan menghilangkan tombol selanjutnya jika disoal terakhir
                    var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
                    var tes_soal_jml = parseInt($('#tes-soal-jml').val());
                    var tes_soal_tujuan = data.tes_soal_nomor;
                    if(tes_soal_tujuan==1){
                        $('#btn-sebelumnya').addClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }else if(tes_soal_tujuan==tes_soal_jml){
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').addClass('hide');
                    }else{
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }

                }else if(data.data==2){
                    window.location.reload();
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengambil Soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function audio(status){
        var audio_player_status = $('#audio-player-status').val();
        var audio_player_update = $('#audio-player-update').val();
        if(status==1){
            if(audio_player_update==0){
                $('#audio-player-update').val('1');
                /**
                 * Update status audio jika pemutaran audio dibatasi
                 */
                $.getJSON('<?php echo site_url().'/'.$url; ?>/update_status_audio/'+$('#tes-soal-id').val(), function(data){
                    if(data.data==1){
                        notify_success(data.pesan);
                    }
                });
            }
        }
        
        if(audio_player_status==0){
            $('#audio-player-status').val('1');
            $('#audio-player').trigger('play');
            $('#audio-player-judul').html('Pause');
            $('#audio-player-judul-logo').removeClass('fa-play');
            $('#audio-player-judul-logo').addClass('fa-pause');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player').trigger('pause');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function audio_ended(status){
        if(status==1){
            $('#audio-control').addClass('hide');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    /**
     * Fungsi untuk menyimpan jawaban secara manual (dengan notifikasi)
     */
    function jawab_manual() {
        // Trigger submit form
        $('#form-kerjakan').submit();
        
        // Berikan notifikasi sukses yang cantik
        Swal.fire({
            title: 'Tersimpan!',
            text: 'Jawaban Anda berhasil diamankan ke server.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    }

    function jawab(){
        $('#form-kerjakan').submit();
    }

    function hentikan_tes(){
        $("#modal-proses").modal('show');
        $('#hentikan-centang').prop("checked", false);
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_tes_info/'+$('#tes-id').val(), function(data){
            $("#modal-proses").modal('hide');
            if(data.data==1){
                Swal.fire({
                    title: 'Konfirmasi Selesai',
                    html: `
                        <div class="swal-custom-content" style="text-align: left; padding: 10px;">
                            <div class="callout callout-info" style="margin-bottom: 20px; border-radius: 12px; background: rgba(14, 165, 233, 0.1) !important;">
                                <p style="margin: 0;">Apakah anda yakin mengakhiri mata uji ini? <b>Jawaban tidak dapat diubah kembali.</b></p>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label style="font-size: 12px; color: #94a3b8; display: block; margin-bottom: 5px;">Nama Ujian</label>
                                <div style="font-weight: 600; font-size: 15px;">${data.tes_nama}</div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <label style="font-size: 12px; color: #94a3b8; display: block; margin-bottom: 5px;">Status Jawaban</label>
                                <div style="font-weight: 600; font-size: 15px;">${data.tes_dijawab} dijawab, ${data.tes_blum_dijawab} belum dijawab.</div>
                            </div>
                            <div style="background: rgba(244, 63, 94, 0.05); padding: 15px; border-radius: 12px; border: 1px dashed rgba(244, 63, 94, 0.3);">
                                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin: 0; color: #f43f5e; font-weight: 600;">
                                    <input type="checkbox" id="swal-hentikan-centang" style="width: 18px; height: 18px; accent-color: #f43f5e;"> 
                                    <span>Konfirmasi & Hentikan Ujian</span>
                                </label>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Selesaikan Ujian',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#f43f5e',
                    preConfirm: () => {
                        const checked = document.getElementById('swal-hentikan-centang').checked;
                        if (!checked) {
                            Swal.showValidationMessage('Anda harus mencentang kotak konfirmasi');
                            return false;
                        }
                        return true;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#hentikan-tes-id').val(data.tes_id);
                        $('#hentikan-tes-user-id').val(data.tes_user_id);
                        $('#hentikan-tes-nama').val(data.tes_nama);
                        $('#hentikan-centang').prop("checked", true);
                        $('#form-hentikan').submit();
                    }
                });
            }else{
                window.location.reload();
            }
        });
    }

    function soal_navigasi(navigasi){
        var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
        var tes_soal_jml = parseInt($('#tes-soal-jml').val());
        var tes_soal_tujuan = tes_soal_nomor+navigasi;

        if((tes_soal_tujuan>=1 && tes_soal_tujuan<=tes_soal_jml)){
            $('#btn-soal-'+tes_soal_tujuan).trigger('click');
        }
    }

    $(function () {
        var sisa_detik = <?php if(!empty($detik_sisa)){ echo $detik_sisa; } ?>;
        setInterval(function() {
            sisa_detik = sisa_detik - 1;
            
            if (sisa_detik >= 0) {
                var jam = Math.floor(sisa_detik / 3600);
                var menit = Math.floor((sisa_detik % 3600) / 60);
                var detik = Math.floor(sisa_detik % 60);

                var sisa_waktu_str = (jam < 10 ? '0' : '') + jam + ':' + 
                                     (menit < 10 ? '0' : '') + menit + ':' + 
                                     (detik < 10 ? '0' : '') + detik;
                
                // Styling based on remaining time
                var colorClass = sisa_detik < 300 ? 'text-danger' : ''; // Red if less than 5 minutes
                var iconClass = sisa_detik < 300 ? 'fa-hourglass-start animate-pulse' : 'fa-clock-o';

                $("#sisa-waktu").html(`
                    <div class="timer-display ${colorClass}" style="font-weight: bold; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa ${iconClass}"></i>
                        <span>Sisa Waktu : ${sisa_waktu_str}</span>
                    </div>
                `);
            }

            if(sisa_detik < 1){
                window.location.reload();
            }
        }, 1000);

        $('#btn-sebelumnya').click(function(){
            soal_navigasi(-1);
        });

        $('#btn-selanjutnya').click(function(){
            soal_navigasi(1);
        });

        $('#btn-hentikan').click(function(){
            hentikan_tes();
        });
        /**
         * Submit form soal saat sudah menjawab
         */
        $('#form-kerjakan').submit(function(){
            /**
             * SILENT SAVE:
             * Menyimpan jawaban di latar belakang tanpa modal loading agar UI tetap responsif.
             */
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan_jawaban",
                    type:"POST",
                    data:$('#form-kerjakan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            // Update warna tombol di daftar soal (background update)
                            if($('#tes-soal-ragu').val()==0){
                                $('#btn-soal-'+obj.nomor_soal).removeClass('btn-default').removeClass('btn-warning').addClass('btn-primary');
                            }
                        }else if(obj.status==2){
                            window.location.reload();
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        // Hanya tampilkan error jika koneksi benar-benar terputus
                        if(textstatus==="timeout") {
                            notify_error("Koneksi lambat, jawaban Anda sedang diantrekan untuk disimpan.");
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form hentikan tes
         */
        $('#form-hentikan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hentikan_tes",
                    type:"POST",
                    data:$('#form-hentikan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghentikan Tes, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });
    });

    // ===============================
    // ANTI PINDAH TAB SYSTEM
    // ===============================

    var pelanggaran_tab = 0;
    var max_pelanggaran = 3;

    // fungsi utama deteksi
    var last_pelanggaran_time = 0;

    function triggerPelanggaran(keterangan) {
        var now = Date.now();
        // Cegah eksekusi ganda: blokir SEMUA event dalam 2 detik, apapun jenisnya
        // (blur + visibilitychange terpicu hampir bersamaan saat pindah tab)
        if (now - last_pelanggaran_time < 2000) return; 
        last_pelanggaran_time = now;

        pelanggaran_tab++;
        
        var chances_left = max_pelanggaran - pelanggaran_tab;
        var msg_text = 'Terdeteksi aktivitas mencurigakan (' + keterangan + ')!\nPelanggaran ke-' + pelanggaran_tab + '. ';
        
        if (chances_left > 0) {
            msg_text += 'Sisa kesempatan Anda: ' + chances_left + ' kali lagi.';
        } else {
            msg_text += 'Batas pelanggaran habis! Ujian akan dikunci.';
        }

        if(keterangan == 'Koneksi Terputus'){
            msg_text = 'Koneksi internet terputus. Silakan hubungkan kembali!\nPelanggaran ke-' + pelanggaran_tab;
        }

        // Bunyikan Alarm
        var alarm = document.getElementById('alarm-peringatan');
        if(alarm){
            alarm.currentTime = 0;
            alarm.play().catch(function(e) { console.log("Audio error:", e); });
        }
        
        // Modal Peringatan Simple
        Swal.fire({
            title: 'Peringatan Keamanan',
            text: msg_text,
            icon: 'warning',
            confirmButtonText: 'Lanjutkan Ujian',
            confirmButtonColor: '#0ea5e9',
            allowOutsideClick: false
        }).then((result) => {
            // Hentikan alarm saat klik OK
            if(alarm){
                alarm.pause();
                alarm.currentTime = 0;
            }
        });

        // kirim log ke server
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/log_pelanggaran",
            type: "POST",
            data: {
                tes_id: $('#tes-id').val(),
                tes_user_id: $('#tes-user-id').val(),
                jumlah: pelanggaran_tab,
                keterangan: keterangan
            }
        });

        if (pelanggaran_tab >= max_pelanggaran) {
            setTimeout(function() {
                Swal.fire({
                    title: 'Ujian Dikunci',
                    text: 'Anda telah mencapai batas maksimal pelanggaran.',
                    icon: 'error',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willClose: () => {
                        $.ajax({
                            url: "<?php echo site_url().'/'.$url; ?>/kunci_ujian",
                            type: "POST",
                            data: {
                                tes_id: $('#tes-id').val(),
                                tes_user_id: $('#tes-user-id').val()
                            },
                            complete: function() {
                                window.location.href = "<?php echo site_url('welcome/logout'); ?>";
                            }
                        });
                    }
                });
            }, 2000);
        }
    }

    function deteksiPindahTab() {
        // Event 1: Browser di-minimize atau pindah tab
        document.addEventListener("visibilitychange", function () {
            if (document.hidden) {
                triggerPelanggaran('Pindah Layar/Tab');
            }
        });

        // Event 2: Blur - HANYA dihitung jika halaman MASIH terlihat (bukan pindah tab)
        // Ini mencegah double-counting saat pindah tab (visibilitychange + blur terpicu bersamaan)
        window.addEventListener("blur", function() {
            if (!document.hidden) {
                triggerPelanggaran('Aplikasi Lain/Notifikasi');
            }
        });

        // Event 3: Internet Terputus (WiFi dimatikan)
        window.addEventListener('offline', function() {
            triggerPelanggaran('Koneksi Terputus');
        });

        // Event 4: Deteksi PrintScreen & Shortcut Capture
        window.addEventListener('keydown', function(e) {
            // Print Screen
            if (e.key === "PrintScreen") {
                triggerPelanggaran('Screenshot Terdeteksi (PrintScreen)');
                e.preventDefault();
            }
            
            // Win + Shift + S (Windows Snipping Tool) - Terdeteksi sebagai Shift + S + Meta
            if (e.shiftKey && (e.metaKey || e.osKey) && e.key === 'S') {
                triggerPelanggaran('Screenshot Terdeteksi (Snipping Tool)');
            }

            // Ctrl + P (Print)
            if (e.ctrlKey && e.key === 'p') {
                triggerPelanggaran('Percobaan Print Halaman');
                e.preventDefault();
            }
        });

        // Event 5: Blokir Klik Kanan & Copy
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('copy', function(e) {
            e.preventDefault();
            return false;
        });

        // Bersihkan clipboard saat user kembali ke window
        window.addEventListener('focus', function() {
            navigator.clipboard.writeText('').catch(function() {});
        });
    }

    // ===============================
    // INTERACTIVE MATCHING SYSTEM
    // ===============================
    
    let selectedQ = null;
    let matchingPairs = [];

    function initInteractiveMatching(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        matchingPairs = [];
        selectedQ = null;

        const qItems = container.querySelectorAll('.q-item');
        const aItems = container.querySelectorAll('.a-item');
        
        // Restore existing pairs from hidden inputs
        qItems.forEach(q => {
            const input = q.querySelector('.match-input');
            const val = input.value;
            if (val) {
                const aIdx = Array.from(aItems).findIndex(a => a.getAttribute('data-kanan-text') === val);
                if (aIdx !== -1) {
                    matchingPairs.push({ q: q, a: aItems[aIdx] });
                    q.classList.add('connected');
                    aItems[aIdx].classList.add('connected');
                }
            }
        });

        // Initial draw
        setTimeout(() => drawSiswaLines(containerId), 200);

        // Click Logic
        qItems.forEach(q => {
            q.onclick = function() {
                qItems.forEach(el => el.classList.remove('active'));
                q.classList.add('active');
                selectedQ = q;
            };
        });

        aItems.forEach(a => {
            a.onclick = function() {
                if (!selectedQ) {
                    notify_error("Pilih pertanyaan di kiri terlebih dahulu!");
                    return;
                }

                const input = selectedQ.querySelector('.match-input');
                const kananstext = a.getAttribute('data-kanan-text');
                
                // Update pairs
                matchingPairs = matchingPairs.filter(p => p.q !== selectedQ);
                matchingPairs.push({ q: selectedQ, a: a });

                // Update UI
                input.value = kananstext;
                selectedQ.classList.remove('active');
                selectedQ.classList.add('connected');
                a.classList.add('connected');
                
                selectedQ = null;
                qItems.forEach(el => el.classList.remove('active'));
                
                drawSiswaLines(containerId);
                
                // Auto save
                if(typeof jawab === 'function') jawab();
            };
        });
    }

    function drawSiswaLines(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        const canvas = container.querySelector('.matching-canvas');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        canvas.width = container.offsetWidth;
        canvas.height = container.offsetHeight;

        const containerRect = container.getBoundingClientRect();
        const colors = ["#6366f1", "#10b981", "#f43f5e", "#0ea5e9", "#f59e0b", "#8b5cf6"];

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        matchingPairs.forEach((pair, index) => {
            const qRect = pair.q.getBoundingClientRect();
            const aRect = pair.a.getBoundingClientRect();

            const x1 = qRect.right - containerRect.left;
            const y1 = qRect.top + qRect.height / 2 - containerRect.top;
            const x2 = aRect.left - containerRect.left;
            const y2 = aRect.top + aRect.height / 2 - containerRect.top;

            const distance = Math.abs(x2 - x1);
            const curve = distance / 2.5;

            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.bezierCurveTo(x1 + curve, y1, x2 - curve, y2, x2, y2);
            ctx.strokeStyle = colors[index % colors.length];
            ctx.lineWidth = 4;
            ctx.lineCap = "round";
            ctx.stroke();

            // Dots
            ctx.beginPath();
            ctx.arc(x1, y1, 5, 0, Math.PI * 2);
            ctx.arc(x2, y2, 5, 0, Math.PI * 2);
            ctx.fillStyle = colors[index % colors.length];
            ctx.fill();
        });
    }

    window.addEventListener('resize', function() {
        document.querySelectorAll('.matching-container-wrapper').forEach(container => {
            drawSiswaLines(container.id);
        });
    });

    /**
     * Penanganan Klik Opsi Jawaban (Radio & Checklist)
     * Memperbarui visual 'active' pada container secara instan
     */
    $(document).on('change', '.opsi-checklist input', function() {
        const parent = $(this).closest('.opsi-checklist');
        const name = $(this).attr('name');
        const type = $(this).attr('type');

        if (type === 'radio') {
            // Untuk Radio: Bersihkan semua opsi yang satu grup (name yang sama)
            $(`input[name="${name}"]`).closest('.opsi-checklist').removeClass('active');
            if ($(this).is(':checked')) {
                parent.addClass('active');
            }
        } else {
            // Untuk Checklist: Toggle status active
            if ($(this).is(':checked')) {
                parent.addClass('active');
            } else {
                parent.removeClass('active');
            }
        }
    });

    // Menangani klik pada kontainer agar input yang tersembunyi ikut terpicu
    $(document).on('click', '.opsi-checklist', function(e) {
        if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
            const input = $(this).find('input');
            input.prop('checked', !input.prop('checked')).trigger('change');
            if(typeof jawab === 'function') jawab();
        }
    });

    // Audio Preload logic removed for Offline Alarm mode
        

    // ===============================
    // SCREEN WAKE LOCK (Keep Screen On)
    // ===============================
    let wakeLock = null;

    async function requestWakeLock() {
        if ('wakeLock' in navigator) {
            try {
                wakeLock = await navigator.wakeLock.request('screen');
                console.log('Wake Lock is active');
            } catch (err) {
                console.log('Wake Lock failed: ' + err.message);
            }
        }
    }

    // Re-request wake lock if tab becomes visible again
    document.addEventListener('visibilitychange', async () => {
        if (wakeLock !== null && document.visibilityState === 'visible') {
            requestWakeLock();
        }
    });

    // Jalankan fungsi
    deteksiPindahTab();
    requestWakeLock();
</script>