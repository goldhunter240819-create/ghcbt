<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Pelanggaran
		<small>Daftar Siswa Terkunci Karena Pelanggaran/Kecurangan</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Pelanggaran</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
                <div class="callout callout-warning">
                    <h4>Perhatian</h4>
                    <p>Halaman ini menampilkan seluruh data ujian siswa yang dikunci oleh sistem akibat terdeteksi terlalu sering berpindah tab atau memminimize browser (fitur deteksi anti-cheat lebih dari 3 kali). Silakan verifikasi ke siswa terkait dan gunakan tombol 'Buka Kunci' jika ingin memberikan kesempatan melanjutkan.</p>
                </div>
                <div class="box">
                    <div class="box-header with-border">
    					<div class="box-title">Daftar Pelanggaran Siswa</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="table-pelanggaran" class="table table-bordered table-hover">
                            <thead>
                                <tr style="background: rgba(244, 63, 94, 0.05);">
                                    <th class="all">No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Ujian</th>
                                    <th>Waktu Mulai</th>
                                    <th>Alasan Terakhir</th>
									<th class="all">Aksi</th>
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
                    </div>
                </div>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    function refresh_table(){
        $('#table-pelanggaran').dataTable().fnReloadAjax();
    }
	
	function buka_kunci(tesuser_id){
        Swal.fire({
            title: 'Konfirmasi Buka Kunci',
            text: 'Anda yakin ingin MEMBUKA KEMBALI ujian siswa ini? Mereka dapat login dan melanjutkan ujian kembali.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0ea5e9',
            cancelButtonColor: '#f43f5e',
            confirmButtonText: '<i class="fa fa-unlock"></i> Ya, Buka Kunci',
            cancelButtonText: 'Batal',
            backdrop: `rgba(15, 23, 42, 0.8)`
        }).then((result) => {
            if (result.isConfirmed) {
                $("#modal-proses").modal('show');
                $.ajax({
                        url:"<?php echo site_url().'/'.$url; ?>/buka_kunci",
                        type:"POST",
                        data: "tesuser_id="+tesuser_id,
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $("#modal-proses").modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: obj.pesan,
                                    timer: 2500,
                                    showConfirmButton: false
                                });
                                refresh_table();
                            }else{
                                $("#modal-proses").modal('hide');
                                Swal.fire('Gagal!', obj.pesan, 'error');
                            }
                        }
                });
            }
        });
    }

    $(function(){
        $('#table-pelanggaran').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
				  "responsive": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": true, "bSortable": false},
    					{"bSearchable": true, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false
         }); 
         
         // Auto refresh radar setiap 5 detik untuk memantau kecurangan secara live
         setInterval(function() {
             var dt = $('#table-pelanggaran').DataTable();
             if (dt != null) {
                 dt.ajax.reload(null, false);
             }
         }, 5000);
    });
</script>
