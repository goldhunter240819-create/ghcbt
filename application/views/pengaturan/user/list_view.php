<!-- Zenith Elite Admin: Direktori Pengguna -->
<section class="content-header">
    <h1 style="color: var(--text-bright); font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
        Direktori Pengguna
        <small style="color: var(--text-muted);">Kelola Personel & Operator Sistem</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>/manager" style="color: var(--text-muted);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="color: var(--text-bright);">Direktori Pengguna</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="zenith-card">
                <div class="zenith-card-header" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-users" style="color: var(--zenith-gold); font-size: 20px;"></i>
                        <h3 class="zenith-card-title">Basis Data Personel</h3>
                    </div>
                    <a href="<?php echo current_url(); ?>/index/add" class="btn-zenith" style="text-decoration: none; padding: 8px 15px !important; font-size: 11px;">
                        <i class="fa fa-user-plus"></i> Tambah Personel Baru
                    </a>
                </div>

                <div class="zenith-table-container">
                    <table id="table-user" class="zenith-table table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>COORD</th>
                                <th>USERNAME</th>
                                <th>NAMA LENGKAP</th>
                                <th>LEVEL AKSES</th>
                                <th>IDENTITAS FISIK</th>
                                <th>DESKRIPSI</th>
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
        $('#table-user').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"40px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo current_url();?>/get_all_user/",
                  "autoWidth": false,
				  "responsive": true
         });          
    });
</script>