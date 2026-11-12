<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Konfigurasi Suara Notifikasi AI
		<small>Atur kalimat notifikasi dan aktifkan suara AI</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Konfigurasi Suara AI</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid box-primary" style="margin-bottom: 20px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: none;">
                <div class="box-header with-border" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important; padding: 15px;">
                    <h3 class="box-title" style="color: #fff !important; display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 1.1rem;"><i data-lucide="volume-2"></i> Pengaturan Suara Notifikasi AI</h3>
                </div>
                <div class="box-body" style="padding: 20px;">
                    <p style="color: #64748b; margin-bottom: 15px; font-size: 13px;"><i data-lucide="info" style="width:14px; height:14px; vertical-align: middle; margin-right: 4px; color: #0284c7;"></i> Atur kalimat notifikasi suara AI dan aktifkan sesuai kebutuhan. Gunakan placeholder seperti <b>[Nama]</b> untuk nama siswa, dan <b>[X]</b> untuk angka pelanggaran.</p>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 15px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                                <label style="font-weight: 700; color: #1e293b;"><i data-lucide="alert-triangle" style="width: 14px; height: 14px; margin-right: 4px; vertical-align: middle; color: #f59e0b;"></i> Siswa Melakukan Pelanggaran</label>
                                <label class="switch" style="position: relative; display: inline-block; width: 44px; height: 22px; margin: 0;">
                                    <input type="checkbox" id="toggle-ai-pelanggaran" style="opacity: 0; width: 0; height: 0;">
                                    <span class="slider round" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 22px;"></span>
                                </label>
                            </div>
                            <input type="text" id="text-ai-pelanggaran" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; margin-bottom: 8px;" placeholder="Contoh: [Nama] melakukan pelanggaran ke-[X]">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <label style="font-size:12px; color:#64748b; margin:0;">Interval Loop (Detik):</label>
                                <input type="number" id="interval-ai-pelanggaran" class="form-control" style="width:70px; height:28px; padding:2px 8px; border-radius:6px; font-size:12px;" value="0" min="0">
                                <span style="font-size:11px; color:#94a3b8;">(0 = Sekali)</span>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 15px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                                <label style="font-weight: 700; color: #1e293b;"><i data-lucide="check-circle" style="width: 14px; height: 14px; margin-right: 4px; vertical-align: middle; color: #10b981;"></i> Siswa Selesai Ujian</label>
                                <label class="switch" style="position: relative; display: inline-block; width: 44px; height: 22px; margin: 0;">
                                    <input type="checkbox" id="toggle-ai-selesai" style="opacity: 0; width: 0; height: 0;">
                                    <span class="slider round" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 22px;"></span>
                                </label>
                            </div>
                            <input type="text" id="text-ai-selesai" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; margin-bottom: 8px;" placeholder="Contoh: [Nama] telah menyelesaikan ujian.">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <label style="font-size:12px; color:#64748b; margin:0;">Interval Loop (Detik):</label>
                                <input type="number" id="interval-ai-selesai" class="form-control" style="width:70px; height:28px; padding:2px 8px; border-radius:6px; font-size:12px;" value="0" min="0">
                                <span style="font-size:11px; color:#94a3b8;">(0 = Sekali)</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 15px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                                <label style="font-weight: 700; color: #1e293b;"><i data-lucide="key" style="width: 14px; height: 14px; margin-right: 4px; vertical-align: middle; color: #ef4444;"></i> Minta Buka Kunci (Unlock)</label>
                                <label class="switch" style="position: relative; display: inline-block; width: 44px; height: 22px; margin: 0;">
                                    <input type="checkbox" id="toggle-ai-unlock" style="opacity: 0; width: 0; height: 0;">
                                    <span class="slider round" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 22px;"></span>
                                </label>
                            </div>
                            <input type="text" id="text-ai-unlock" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; margin-bottom: 8px;" placeholder="Contoh: [Nama] meminta buka kunci">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <label style="font-size:12px; color:#64748b; margin:0;">Interval Loop (Detik):</label>
                                <input type="number" id="interval-ai-unlock" class="form-control" style="width:70px; height:28px; padding:2px 8px; border-radius:6px; font-size:12px;" value="15" min="0">
                                <span style="font-size:11px; color:#94a3b8;">(Default: 15s)</span>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 15px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                                <label style="font-weight: 700; color: #1e293b;"><i data-lucide="refresh-cw" style="width: 14px; height: 14px; margin-right: 4px; vertical-align: middle; color: #3b82f6;"></i> Minta Reset Login</label>
                                <label class="switch" style="position: relative; display: inline-block; width: 44px; height: 22px; margin: 0;">
                                    <input type="checkbox" id="toggle-ai-reset" style="opacity: 0; width: 0; height: 0;">
                                    <span class="slider round" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .4s; border-radius: 22px;"></span>
                                </label>
                            </div>
                            <input type="text" id="text-ai-reset" class="form-control" style="border-radius: 8px; border: 1px solid #cbd5e1; margin-bottom: 8px;" placeholder="Contoh: [Nama] meminta reset login">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <label style="font-size:12px; color:#64748b; margin:0;">Interval Loop (Detik):</label>
                                <input type="number" id="interval-ai-reset" class="form-control" style="width:70px; height:28px; padding:2px 8px; border-radius:6px; font-size:12px;" value="15" min="0">
                                <span style="font-size:11px; color:#94a3b8;">(Default: 15s)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 25px; display: flex; justify-content: flex-end;">
                        <button type="button" id="btn-save-ai" class="btn btn-primary" style="border-radius: 8px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important; font-weight: 600; padding: 10px 20px; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25); border: none;"><i data-lucide="save" style="width:16px; height:16px; vertical-align:middle; margin-right: 6px;"></i> Simpan Pengaturan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .slider.round:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #0284c7 !important;
    }
    input:checked + .slider:before {
        transform: translateX(22px);
    }
</style>

<script>
$(function(){
     // Initial setup of localStorage defaults if empty
     if (localStorage.getItem('ai_p_enabled') === null) localStorage.setItem('ai_p_enabled', 'true');
     if (localStorage.getItem('ai_p_text') === null) localStorage.setItem('ai_p_text', '[Nama] melakukan pelanggaran ke-[X]');
     if (localStorage.getItem('ai_s_enabled') === null) localStorage.setItem('ai_s_enabled', 'true');
     if (localStorage.getItem('ai_s_text') === null) localStorage.setItem('ai_s_text', '[Nama] telah menyelesaikan ujian. Silahkan kembalikan hp ke pengawas lalu dipersilahkan meninggalkan ruangan');
     if (localStorage.getItem('ai_u_enabled') === null) localStorage.setItem('ai_u_enabled', 'true');
     if (localStorage.getItem('ai_u_text') === null) localStorage.setItem('ai_u_text', '[Nama], minta buka kunci');
     if (localStorage.getItem('ai_r_enabled') === null) localStorage.setItem('ai_r_enabled', 'true');
     if (localStorage.getItem('ai_r_text') === null) localStorage.setItem('ai_r_text', '[Nama], minta reset login');
     
     // Defaults for intervals
     if (localStorage.getItem('ai_p_interval') === null) localStorage.setItem('ai_p_interval', '0');
     if (localStorage.getItem('ai_s_interval') === null) localStorage.setItem('ai_s_interval', '0');
     if (localStorage.getItem('ai_u_interval') === null) localStorage.setItem('ai_u_interval', '15');
     if (localStorage.getItem('ai_r_interval') === null) localStorage.setItem('ai_r_interval', '15');

     // Populate fields from localStorage
     $('#toggle-ai-pelanggaran').prop('checked', localStorage.getItem('ai_p_enabled') !== 'false');
     $('#text-ai-pelanggaran').val(localStorage.getItem('ai_p_text'));
     
     $('#toggle-ai-selesai').prop('checked', localStorage.getItem('ai_s_enabled') !== 'false');
     $('#text-ai-selesai').val(localStorage.getItem('ai_s_text'));
     
     $('#toggle-ai-unlock').prop('checked', localStorage.getItem('ai_u_enabled') !== 'false');
     $('#text-ai-unlock').val(localStorage.getItem('ai_u_text'));
     
     $('#toggle-ai-reset').prop('checked', localStorage.getItem('ai_r_enabled') !== 'false');
     $('#text-ai-reset').val(localStorage.getItem('ai_r_text'));

     // Populate intervals
     $('#interval-ai-pelanggaran').val(localStorage.getItem('ai_p_interval') || '0');
     $('#interval-ai-selesai').val(localStorage.getItem('ai_s_interval') || '0');
     $('#interval-ai-unlock').val(localStorage.getItem('ai_u_interval') || '15');
     $('#interval-ai-reset').val(localStorage.getItem('ai_r_interval') || '15');

     // Save button callback with success notification
     $('#btn-save-ai').on('click', function() {
         localStorage.setItem('ai_p_enabled', $('#toggle-ai-pelanggaran').is(':checked'));
         localStorage.setItem('ai_p_text', $('#text-ai-pelanggaran').val());
         
         localStorage.setItem('ai_s_enabled', $('#toggle-ai-selesai').is(':checked'));
         localStorage.setItem('ai_s_text', $('#text-ai-selesai').val());
         
         localStorage.setItem('ai_u_enabled', $('#toggle-ai-unlock').is(':checked'));
         localStorage.setItem('ai_u_text', $('#text-ai-unlock').val());
         
         localStorage.setItem('ai_r_enabled', $('#toggle-ai-reset').is(':checked'));
         localStorage.setItem('ai_r_text', $('#text-ai-reset').val());
         
         // Save intervals
         localStorage.setItem('ai_p_interval', $('#interval-ai-pelanggaran').val());
         localStorage.setItem('ai_s_interval', $('#interval-ai-selesai').val());
         localStorage.setItem('ai_u_interval', $('#interval-ai-unlock').val());
         localStorage.setItem('ai_r_interval', $('#interval-ai-reset').val());
         
         if (typeof PNotify !== 'undefined') {
             new PNotify({
                 title: 'Berhasil',
                 text: 'Pengaturan notifikasi suara AI berhasil disimpan.',
                 type: 'success',
                 style: 'bootstrap3'
             });
         } else {
             alert('Pengaturan notifikasi suara AI berhasil disimpan!');
         }
     });
});
</script>
