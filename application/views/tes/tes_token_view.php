<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Token
		<small>Membuat token untuk Tes</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Token</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <style>
        .zenith-token-card {
            background: rgba(var(--primary-rgb), 0.05);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 20px;
            height: 100%;
        }
        .token-capsule {
            background: var(--primary-gradient);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(var(--primary-rgb), 0.3);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .token-capsule::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate-slow 10s linear infinite;
        }
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        #isi-token { font-size: 54px; font-weight: 900; letter-spacing: 5px; text-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .token-label { font-size: 14px; text-transform: uppercase; font-weight: 700; opacity: 0.8; letter-spacing: 2px; margin-top: 5px; }
        
        .form-modern-group { margin-bottom: 20px; }
        .form-modern-group label { color: var(--text-muted); font-size: 12px; text-transform: uppercase; margin-bottom: 8px; display: block; letter-spacing: 1px; }
        .form-modern-group select { 
            background: rgba(var(--primary-rgb), 0.05) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 12px !important;
            height: 45px !important;
            color: var(--text-main) !important;
        }
    </style>

	<div class="row">
        <!-- Generator Column -->
        <div class="col-md-5">
            <?php echo form_open($url.'/token','id="form-token"'); ?>
                <div class="zenith-token-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: var(--text-bright);"><i class="fa fa-barcode"></i> Generator Token</h3>
                        <a onclick="manual()" style="cursor: pointer; font-size: 12px; font-weight: 600; color: var(--accent-color); border: 1px solid var(--accent-color); padding: 4px 12px; border-radius: 50px;">Token Manual</a>
                    </div>

                    <div class="token-capsule">
                        <div id="isi-token">0</div>
                        <div class="token-label">Zenith Active Token</div>
                    </div>

                    <div class="form-modern-group">
                        <label>Masa Aktif Token</label>
                        <select class="form-control" id="token-aktif" name="token-aktif">
                            <option value="1">1 Hari</option>
                            <option value="5">5 menit</option>
                            <option value="15">15 menit</option>
                            <option value="30">30 menit</option>
                            <option value="60">1 Jam</option>
                            <option value="120">2 Jam</option>
                            <option value="240">4 Jam</option>
                        </select>
                    </div>

                    <div class="form-modern-group">
                        <label>Target Ujian Spesifik</label>
                        <select class="form-control" id="token-tes" name="token-tes">
                            <?php if(!empty($select_tes)){ echo $select_tes; } ?>
                        </select>
                        <p style="font-size: 11px; color: var(--text-muted); margin-top: 8px;">*Pilih 'Semua TES' agar token berlaku universal.</p>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg" style="border-radius: 16px; font-weight: 700; box-shadow: 0 8px 15px rgba(var(--primary-rgb), 0.3); margin-top: 10px;">
                        <i class="fa fa-refresh"></i> Generate New Token
                    </button>
                    
                    <div style="margin-top: 25px; padding: 15px; background: rgba(var(--primary-rgb), 0.05); border-radius: 16px; border-left: 4px solid var(--accent-color);">
                        <p style="margin: 0; font-size: 12px; color: var(--text-main); line-height: 1.5;"><b>Info:</b> Token yang digenerate berlaku sesuai masa aktif yang dipilih. Klik tombol di atas untuk menyegarkan token.</p>
                    </div>
                </div>
            </form>
        </div>

        <!-- List Column (Di Sebelah Kanan) -->
        <div class="col-md-7">
            <div class="zenith-token-card" style="padding: 0; overflow: hidden;">
                <div style="padding: 20px 25px; background: rgba(var(--primary-rgb), 0.05); border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700;"><i class="fa fa-list"></i> Riwayat Token Hari Ini</h3>
                    <span class="badge" style="background: var(--accent-color); padding: 5px 12px; border-radius: 8px;">Live Data</span>
                </div>
                <div class="box-body" style="padding: 10px;">
                    <div class="table-responsive">
                        <table id="table-token" class="table table-hover" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th style="padding-left: 20px;">No.</th>
                                    <th>Token</th>
                                    <th>Generate</th>
                                    <th>Masa Aktif</th>
									<th style="padding-right: 20px;">Tes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="5" class="text-center">Memuat data...</td></tr>
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="modal-token-manual" data-backdrop="static" tabindex="-1" role="dialog">
    <?php echo form_open($url.'/token_manual','id="form-token-manual"'); ?>
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 24px; overflow: hidden; background: var(--bg-box); border: 1px solid var(--border-color);">
                <div class="modal-header" style="background: rgba(var(--primary-rgb), 0.05); border-bottom: 1px solid var(--border-color); padding: 20px 25px;">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 style="margin: 0; font-weight: 700; color: var(--text-bright);">Token Tes Manual</h4>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <div id="form-pesan-manual"></div>
                    <div class="form-modern-group">
                        <label>Input Token Kolektif</label>
                        <input type="text" class="form-control" id="manual-token" name="manual-token" placeholder="Contoh: GHCBT99" style="height: 45px; border-radius: 12px; background: rgba(var(--primary-rgb), 0.05) !important; border: 1px solid var(--border-color); color: var(--text-main);">
                        <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px;">*Pastikan token unik dan mudah dibaca siswa.</p>
                    </div>
                    
                    <div class="form-modern-group">
                        <label>Masa Aktif Manual</label>
                        <select class="form-control" id="manual-aktif" name="manual-aktif">
                            <option value="1">1 Hari</option>
                            <option value="5">5 menit</option>
                            <option value="15">15 menit</option>
                            <option value="30">30 menit</option>
                            <option value="60">1 Jam</option>
                            <option value="120">2 Jam</option>
                            <option value="240">4 Jam</option>
                        </select>
                    </div>

                    <div class="form-modern-group">
                        <label>Spesifikasi Tes</label>
                        <select class="form-control" id="manual-tes" name="manual-tes">
                            <?php if(!empty($select_tes)){ echo $select_tes; } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 20px 25px; border-top: 1px solid var(--border-color); background: rgba(var(--primary-rgb), 0.02);">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary" style="border-radius: 12px; padding: 10px 25px; font-weight: 700;">Simpan Token</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 12px; padding: 10px 20px;">Close Boris</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-token').dataTable().fnReloadAjax();
    }
	
	function manual(){
        $('#form-pesan-manual').html('');
        $('#manual-token').val('');

        $("#modal-token-manual").modal("show");
        $('#manual-token').focus();
    }

    $(function(){
        $('#form-token').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/token",
                    type:"POST",
                    data:$('#form-token').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $("#isi-token").html(obj.token);
                            notify_success(obj.pesan);
                            refresh_table();
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
		
		$('#form-token-manual').submit(function(){
            $("#modal-proses").modal('show');
			var isi_token = $('#manual-token').val();
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/token_manual",
                    type:"POST",
                    data:$('#form-token-manual').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                            refresh_table();
							$("#isi-token").html(isi_token);
							$("#modal-token-manual").modal('hide');
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-manual').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-token').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
				  "responsive": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false
         }); 
    });
</script>