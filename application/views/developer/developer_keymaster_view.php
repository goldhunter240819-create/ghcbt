<!-- Content Header Banner -->
<div class="content-header-banner">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 24px; flex-shrink: 0; backdrop-filter: blur(10px);">
            <i class="fa fa-key"></i>
        </div>
        <div>
            <h2>Keymaster Pro</h2>
            <p>Sistem Otomasi Lisensi Node-Locked Hardware ID & Manajemen Klien</p>
        </div>
    </div>
    <div class="banner-badge-status">
        <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; box-shadow: 0 0 8px #10b981;"></span> ACTIVATION ENGINE ACTIVE
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="elite-card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-light);">
                <h3 style="margin: 0; font-weight: 800; font-size: 16px; text-transform: uppercase; color: #0f172a; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-unlock-alt" style="color: var(--gold-primary);"></i> Generate Kunci Lisensi Baru
                </h3>
                <span class="badge" style="background: #fffbeb; color: var(--gold-primary); border: 1px solid #fde68a; font-weight: 700; padding: 4px 10px; border-radius: 10px;">NODE-LOCKED V3</span>
            </div>

            <?php echo form_open('developer/keymaster'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="color: #334155; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 8px; display: block;">Nama Klien / Pembeli</label>
                            <input type="text" name="client_name" class="form-control elite-input" placeholder="Contoh: SMK Nusantara 1" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="color: #334155; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; margin-bottom: 8px; display: block;">Device ID (Hardware ID)</label>
                            <input type="text" name="device_id" class="form-control elite-input" placeholder="Masukkan 16 Karakter ID Klien" required autocomplete="off">
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 10px;">
                    <button type="submit" name="generate" value="1" class="btn btn-gold-elite" style="width: 100%; padding: 14px 20px !important; font-size: 13px !important;">
                        <i class="fa fa-bolt" style="margin-right: 8px;"></i> GENERATE PULSE ACTIVATION KEY
                    </button>
                </div>
            <?php echo form_close(); ?>

            <?php if (!empty($generated_key)): ?>
                <div style="margin-top: 30px; padding: 25px; background: #fffbeb; border: 2px dashed #f59e0b; border-radius: 18px; text-align: center;">
                    <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #92400e; font-weight: 800; margin-bottom: 10px;">Kunci Aktivasi Sah Terdeteksi</div>
                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 26px; font-weight: 900; color: #b45309; letter-spacing: 3px;"><?php echo $generated_key; ?></div>
                    <p style="color: #78350f; font-size: 12px; margin-top: 12px; font-weight: 500;">Salin kunci di atas dan kirimkan ke klien. Data ini sudah otomatis tercatat ke dalam ledger riwayat di bawah.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="elite-card" style="padding: 0 !important; overflow: hidden;">
            <div style="padding: 22px 28px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center; background: #ffffff;">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="fa fa-list-alt" style="color: var(--gold-primary); margin-right: 8px;"></i> Riwayat Penjualan & Lisensi
                    </h3>
                    <p style="margin: 4px 0 0; color: #64748b; font-size: 12px;">Mendaftarkan <strong><?php echo count($history); ?></strong> aktivasi perangkat terverifikasi</p>
                </div>
                <div style="background: #fffbeb; color: #b45309; padding: 6px 14px; border-radius: 12px; font-size: 11px; font-weight: 800; border: 1px solid #fde68a;">
                    SECURE LEDGER
                </div>
            </div>
            
            <div class="table-responsive" style="padding: 15px 25px 25px;">
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
                                <td style="font-size: 12px; color: #64748b; font-weight: 600;"><?php echo date('d/m/Y H:i', strtotime($row->created_at)); ?></td>
                                <td>
                                    <div style="font-weight: 800; color: #0f172a; font-size: 13px;"><?php echo htmlspecialchars($row->client_name); ?></div>
                                    <div style="font-size: 11px; color: #059669; font-weight: 700;"><i class="fa fa-check-circle"></i> Verified Activation</div>
                                </td>
                                <td><code style="background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1; border-radius: 6px; padding: 3px 8px; font-weight: 700;"><?php echo $row->device_id; ?></code></td>
                                <td><span style="color: #b45309; font-weight: 900; font-family: monospace; letter-spacing: 1px; font-size: 13px;"><?php echo $row->activation_key; ?></span></td>
                                <td align="center">
                                    <a href="<?php echo site_url('developer/keymaster?delete='.$row->id); ?>" class="btn btn-xs" style="color: #dc2626; background: #fef2f2; border: 1px solid #fecdd3; border-radius: 8px; padding: 6px 12px; font-weight: 700;" onclick="return confirm('Hapus riwayat aktivasi ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($history)): ?>
                            <tr>
                                <td colspan="5" align="center" style="padding: 60px !important;">
                                    <i class="fa fa-folder-open-o fa-3x" style="color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                                    <div style="color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 13px;">Belum ada data Ledger Aktivasi</div>
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