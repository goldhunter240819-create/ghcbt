<div class="row">
    <div class="col-md-12">
        <div class="elite-card">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
                <div style="width: 60px; height: 60px; background: var(--gold-gradient); border-radius: 18px; display: flex; align-items: center; justify-content: center; color: #020617; box-shadow: var(--gold-glow);">
                    <i class="fa fa-key fa-2x"></i>
                </div>
                <div>
                    <h2 style="margin: 0; font-weight: 800; letter-spacing: -0.5px; color: #fff;">ZENITH KEYMASTER PRO</h2>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Sistem Otomasi Lisensi Hardware & Manajemen Penjualan</p>
                </div>
            </div>

            <?php echo form_open('developer/keymaster'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="color: var(--gold-primary); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;">Nama Klien / Pembeli</label>
                            <input type="text" name="client_name" class="form-control elite-input" placeholder="Contoh: SMK Nusantara 1" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label style="color: var(--gold-primary); font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 900;">Device ID (Hardware ID)</label>
                            <input type="text" name="device_id" class="form-control elite-input" placeholder="Masukkan 16 Karakter ID Klien" required autocomplete="off">
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 10px;">
                    <button type="submit" name="generate" value="1" class="btn btn-gold-elite" style="width: 100%;">
                        <i class="fa fa-bolt"></i> GENERATE PULSE ACTIVATION KEY
                    </button>
                </div>
            <?php echo form_close(); ?>

            <?php if (!empty($generated_key)): ?>
                <div style="margin-top: 40px; padding: 30px; background: rgba(245, 158, 11, 0.05); border: 2px dashed var(--gold-primary); border-radius: 24px; text-align: center; animation: pulseGlow 2s infinite;">
                    <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 3px; color: var(--gold-primary); font-weight: 900; margin-bottom: 10px;">Kunci Aktivasi Sah Terdeteksi</div>
                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 26px; font-weight: 900; color: #fff; letter-spacing: 4px;"><?php echo $generated_key; ?></div>
                    <p style="color: #64748b; font-size: 11px; margin-top: 15px;">Salin kunci di atas dan kirimkan ke klien. Data ini sudah otomatis masuk ke dalam riwayat.</p>
                </div>
                <style>
                    @keyframes pulseGlow {
                        0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.1); }
                        50% { box-shadow: 0 0 40px rgba(245, 158, 11, 0.3); }
                    }
                </style>
            <?php endif; ?>
        </div>

        <div class="elite-card" style="padding: 0; overflow: hidden;">
            <div style="padding: 30px 40px; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.01);">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #fff;">RIWAYAT PENJUALAN & LISENSI</h3>
                    <p style="margin: 0; color: #64748b; font-size: 11px;">Mendaftarkan <?php echo count($history); ?> aktivasi perangkat</p>
                </div>
                <div class="badge-total" style="background: rgba(245, 158, 11, 0.1); color: var(--gold-primary); padding: 5px 15px; border-radius: 10px; font-size: 10px; font-weight: 900; border: 1px solid var(--border-light);">
                    SECURE LEDGER
                </div>
            </div>
            
            <div class="table-responsive" style="padding: 20px 40px 40px;">
                <table class="table elite-table">
                    <thead>
                        <tr>
                            <th>WAKTU</th>
                            <th>KLIEN</th>
                            <th>DEVICE ID</th>
                            <th>ACTIVATION KEY</th>
                            <th style="width: 100px; text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($history as $row): ?>
                            <tr>
                                <td style="font-size: 11px;"><?php echo date('d/m/Y H:i', strtotime($row->created_at)); ?></td>
                                <td>
                                    <div style="font-weight: 800; color: #fff;"><?php echo htmlspecialchars($row->client_name); ?></div>
                                    <div style="font-size: 10px; color: #64748b;">Verified Activation</div>
                                </td>
                                <td><code><?php echo $row->device_id; ?></code></td>
                                <td><span style="color: var(--gold-secondary); font-weight: 800; font-family: monospace; letter-spacing: 1px;"><?php echo $row->activation_key; ?></span></td>
                                <td align="center">
                                    <a href="<?php echo site_url('developer/keymaster?delete='.$row->id); ?>" class="btn btn-xs" style="color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 8px; padding: 5px 12px;" onclick="return confirm('Hapus riwayat aktivasi ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($history)): ?>
                            <tr>
                                <td colspan="5" align="center" style="padding: 80px !important;">
                                    <i class="fa fa-folder-open-o fa-4x" style="color: #1e293b; margin-bottom: 20px;"></i>
                                    <div style="color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">Belum ada data Ledger</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        <?php if($this->session->flashdata('success')): ?>
            notify_success("<?php echo $this->session->flashdata('success'); ?>");
        <?php endif; ?>
    });
</script>
