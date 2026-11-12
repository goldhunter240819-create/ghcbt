<!-- Zenith Elite Admin: Daftar Level -->
<section class="content-header">
    <h1 style="color: var(--zenith-gold); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Hub Otoritas
        <small style="color: #94a3b8;">Kelola Hak Akses Sistem & Peran Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: #94a3b8;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--zenith-gold);">Hub Otoritas</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="zenith-card">
                <div class="zenith-card-header" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-shield" style="color: var(--zenith-cyan); font-size: 20px;"></i>
                        <h3 class="zenith-card-title">Direktori Level Akses</h3>
                    </div>
                    <a href="<?php echo current_url(); ?>/index/add" class="btn-zenith" style="text-decoration: none; padding: 8px 15px !important; font-size: 11px;">
                        <i class="fa fa-plus"></i> Inisialisasi Level Baru
                    </a>
                </div>

                <div class="zenith-table-container">
                    <table id="table-level" class="zenith-table table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>COORD</th>
                                <th>NAMA LEVEL</th>
                                <th>IDENTIFIKASI</th>
                                <th>MATRIKS IZIN</th>
                                <th>OPERASI</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                        
                </div>
            </div>
        </div>
    </div>
</section>

<script lang="javascript">
    $(function(){
        $('#table-level').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"40px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"130px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo current_url();?>/get_all_level/",
                  "autoWidth": false,
				  "responsive": true
         });          
    });
</script>