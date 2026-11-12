<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Guru
		<small>Daftar guru yang terdaftar dalam sistem CBT</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i data-lucide="layout-dashboard"></i> Home</a></li>
		<li class="active">Data Guru</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="box-title">Daftar Guru</div>
                        <div class="box-tools">
                            <a href="<?php echo site_url('manager/useratur/index/add'); ?>" class="btn btn-sm btn-primary" style="font-weight: 700; margin-right: 8px; border-radius: 8px;">
                                <i class="fa fa-plus-circle"></i> Tambah Guru
                            </a>
                            <a href="javascript:void(0)" onclick="hapus_terpilih()" class="btn btn-sm btn-danger" style="font-weight: 700; border-radius: 8px;">
                                <i class="fa fa-trash"></i> Hapus Terpilih
                            </a>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <?php echo form_open($url.'/hapus_guru','id="form-hapus"'); ?>
                        <table id="table-guru" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th class="all">Nama Guru</th>
                                    <th>Level</th>
                                    <th class="all">Aksi</th>
                                    <th width="20px"><input type="checkbox" id="check-all"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>  
                        </form>                      
                    </div>
                </div>
        </div>
    </div>
</section>

<script lang="javascript">
    $(function(){
        $('#table-guru').DataTable({
            "paging": true,
            "iDisplayLength":10,
            "bProcessing": false,
            "bServerSide": true, 
            "searching": true,
            "aoColumns": [
                {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                {"bSearchable": true, "bSortable": false},
                {"bSearchable": true, "bSortable": false},
                {"bSearchable": true, "bSortable": false},
                {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                {"bSearchable": false, "bSortable": false, "sWidth":"20px"}
            ],
            "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable",
            "fnServerParams": function ( aoData ) {
                // aoData.push( { "name": "group", "value": $('#group').val() } );
            }
        });
    });

    $('#check-all').click(function(){
        $('input[name^="edit-user-id"]').prop('checked', this.checked);
    });

    function hapus_terpilih() {
        if($('input[name^="edit-user-id"]:checked').length > 0){
            Swal.fire({
                title: 'Hapus Guru?',
                text: "Anda yakin ingin menghapus guru yang dipilih?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $('#form-hapus').submit();
                }
            });
        } else {
            Swal.fire('Perhatian', 'Pilih minimal satu guru yang akan dihapus!', 'warning');
        }
    }
</script>

