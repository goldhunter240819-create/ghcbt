<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MHCBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Tes_hasil extends Member_Controller {
	private $kode_menu = 'tes-hasil';
	private $kelompok = 'tes';
	private $url = 'manager/tes_hasil';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_tes_model');
		$this->load->model('cbt_tes_token_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('cbt_tes_user_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('cbt_tes_soal_model');
		$this->load->model('cbt_tes_soal_jawaban_model');
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $tanggal_awal = date('Y-m-d H:i', strtotime('- 1 days'));
        $tanggal_akhir = date('Y-m-d H:i', strtotime('+ 1 days'));
        
        $data['rentang_waktu'] = $tanggal_awal.' - '.$tanggal_akhir;

        $query_group = $this->cbt_user_grup_model->get_group();
        $select = '<option value="semua">Semua Group</option>';
        if($query_group->num_rows()>0){
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="0">Tidak Ada Group</option>';
        }
        $data['select_group'] = $select;

        $query_tes = $this->cbt_tes_user_model->get_by_group();
        $select = '<option value="semua">Semua Ujian</option>';
        if($query_tes->num_rows()>0){
        	$query_tes = $query_tes->result();
        	foreach ($query_tes as $temp) {
        		$select = $select.'<option value="'.$temp->tes_id.'">'.$temp->tes_nama.'</option>';
        	}
        }
        $data['select_tes'] = $select;

        $query_modul = $this->cbt_modul_model->get_modul();
        $select = '<option value="semua">Semua Modul</option>';
        if($query_modul->num_rows()>0){
        	$query_modul = $query_modul->result();
        	foreach ($query_modul as $temp) {
        		$select = $select.'<option value="'.$temp->modul_id.'">'.$temp->modul_nama.'</option>';
        	}
        }
        $data['select_modul'] = $select;
        
        $this->template->display_admin($this->kelompok.'/tes_hasil_view', 'Hasil Tes', $data);
    }

    /**
     * Melakukan perubahan pada tes yang diseleksi
     */
    function edit_tes(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('edit-testuser-id[]', 'Hasil Tes','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $tesuser_id = $this->input->post('edit-testuser-id', TRUE);

            if($pilihan=='hapus'){
                foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                        $this->cbt_tes_user_model->delete('tesuser_id', $kunci);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Hasil tes berhasil dihapus';
            }else if($pilihan=='hentikan'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$data_tes['tesuser_status']=4;
            			$this->cbt_tes_user_model->update('tesuser_id', $kunci, $data_tes);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Tes berhasil dihentikan';
            }else if($pilihan=='buka'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$data_tes['tesuser_status']=1;
            			$this->cbt_tes_user_model->update('tesuser_id', $kunci, $data_tes);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Tes berhasil dibuka, user bisa mengerjakan kembali';
            }else if($pilihan=='waktu'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$waktu = intval($this->input->post('waktu-menit', TRUE));

            			$this->cbt_tes_user_model->update_menit($kunci, $waktu);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Waktu Tes berhasil ditambah';
            }

        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    /**
     * Mendapatkan daftar ujian berdasarkan modul
     */
    function get_ujian_by_modul($modul_id=null){
        $data['data'] = 0;
        if(!empty($modul_id)){
            $data['data'] = 1;
            $sql = "";
            if($modul_id != 'semua'){
                $sql = " AND tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = '".$modul_id."')";
            }
            $query_tes = $this->db->query("SELECT * FROM cbt_tes WHERE 1=1 ".$sql." ORDER BY tes_id DESC");
            $select = '<option value="semua">Semua Ujian</option>';
            if($query_tes->num_rows()>0){
                foreach($query_tes->result() as $temp){
                    $select .= '<option value="'.$temp->tes_id.'">'.$temp->tes_nama.'</option>';
                }
            }
            $data['select_tes'] = $select;
        }
        echo json_encode($data);
    }

    function export($tes_id= 'semua', $grup_id= 'semua', $waktu=null, $urutkan='nama', $status='mengerjakan', $keterangan=null, $modul_id = 'semua'){
        if(!empty($tes_id) AND !empty($grup_id)){
            $this->load->library('excel');
            $waktu =  urldecode($waktu);
            $tanggal = explode(" - ", $waktu);
			if(!empty($keterangan)){
				$keterangan =  urldecode($keterangan);
                if ($keterangan == 'semua') {
                    $keterangan = null;
                }
			}

			if($status=='mengerjakan'){
				$query = $this->cbt_tes_user_model->get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $modul_id);
			}else{
				$query = $this->cbt_user_model->get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $modul_id);
			}
            $inputFileName = './public/form/form-data-hasil-tes.xls';
            $excel = PHPExcel_IOFactory::load($inputFileName);
            $worksheet = $excel->getSheet(0);

            if($query->num_rows()>0){
                $query = $query->result();
                $row = 2;
                foreach ($query as $temp) {
                    $worksheet->setCellValueByColumnAndRow(0, $row, ($row-1));
                    $worksheet->setCellValueByColumnAndRow(1, $row, $temp->tesuser_creation_time);
                    $worksheet->setCellValueByColumnAndRow(2, $row, $temp->tes_nama);
                    $worksheet->setCellValueByColumnAndRow(3, $row, $temp->user_name);
                    $worksheet->setCellValueByColumnAndRow(4, $row, stripslashes($temp->user_firstname));
                    $worksheet->setCellValueByColumnAndRow(5, $row, $temp->grup_nama);
                    
                    $skor_akhir = $this->cbt_tes_soal_model->hitung_nilai_prorata($temp->tesuser_id, $temp->tes_id);
                    $worksheet->setCellValueByColumnAndRow(6, $row, number_format($skor_akhir, 2));

                    $row++;
                }
            }
            $filename='Data Hasil Tes - '.date('Y-m-d H:i').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
                 
            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
        }
    }

    function export_pdf($tes_id = 'semua', $grup_id = 'semua', $waktu=null, $urutkan='nama', $status='mengerjakan', $keterangan=null, $modul_id = 'semua'){
        if(!empty($tes_id) AND !empty($grup_id)){
            $waktu =  urldecode($waktu);
            $tanggal = explode(" - ", $waktu);
			if(!empty($keterangan)){
				$keterangan =  urldecode($keterangan);
                if ($keterangan == 'semua') {
                    $keterangan = null;
                }
			}

			if($status=='mengerjakan'){
				$query = $this->cbt_tes_user_model->get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $modul_id);
			}else{
				$query = $this->cbt_user_model->get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $modul_id);
			}

            $data['query'] = $query;
            
            // Mengambil Nama Tes
            $data['nama_tes'] = 'Semua Tes';
            if($tes_id!='semua'){
                $query_tes = $this->cbt_tes_model->get_by_kolom_limit('tes_id', $tes_id, 1);
                if($query_tes->num_rows()>0){
                    $data['nama_tes'] = $query_tes->row()->tes_nama;
                }
            }
            
            // Mengambil Nama Grup
            $data['nama_grup'] = 'Semua Grup';
            if($grup_id!='semua'){
                $query_grup = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $grup_id, 1);
                if($query_grup->num_rows()>0){
                    $data['nama_grup'] = $query_grup->row()->grup_nama;
                }
            }

            // Mengambil Nama Modul
            $data['nama_modul'] = 'Semua Modul';
            if($modul_id!='semua'){
                $query_modul = $this->cbt_modul_model->get_by_kolom_limit('modul_id', $modul_id, 1);
                if($query_modul->num_rows()>0){
                    $data['nama_modul'] = $query_modul->row()->modul_nama;
                }
            }

            // Ambil Nama Madrasah
            $query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama_madrasah', 1);
            $data['nama_madrasah'] = 'Madrasah Aliyah';
            if($query_konfigurasi->num_rows()>0){
                $data['nama_madrasah'] = $query_konfigurasi->row()->konfigurasi_isi;
            }

            // Ambil Tahun Ajaran
            $query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun_ajaran', 1);
            $data['tahun_ajaran'] = '2025/2026';
            if($query_konfigurasi->num_rows()>0){
                $data['tahun_ajaran'] = $query_konfigurasi->row()->konfigurasi_isi;
            }

            $this->load->view($this->kelompok.'/tes_hasil_print_view', $data);
        }
    }

    function get_datatable(){
		// variable initialization
		$tes_id = $this->input->get('tes');
		$grup_id = $this->input->get('group');
		$modul_id = $this->input->get('modul');
		$urutkan = $this->input->get('urutkan');
		$waktu = $this->input->get('waktu');
		$keterangan = $this->input->get('keterangan');
		$status = $this->input->get('status');
		$tanggal = explode(" - ", $waktu);

		$search = "";
		$start = 0;
		$rows = 10;

		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
        if ($tes_id == 'semua' || $grup_id == 'semua') {
            $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => 0,
                "iTotalDisplayRecords" => 0,
                "aaData" => array()
            );
            echo json_encode($output);
            return;
        }

		if($status=='mengerjakan'){
			$query = $this->cbt_tes_user_model->get_datatable($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id);
			$iTotal= $this->cbt_tes_user_model->get_datatable_count($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id)->row()->hasil;
		}else{
			$query = $this->cbt_user_model->get_datatable_hasiltes($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id);
			$iTotal= $this->cbt_user_model->get_datatable_hasiltes_count($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id)->row()->hasil;
		}
		
		$iFilteredTotal = $query->num_rows();
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
			$record = array();
            
			$record[] = ++$i;
			if(empty($temp->tesuser_creation_time)){
				$record[] = 'Belum memulai tes';
				$record[] = '0';
			}else{
				$record[] = $temp->tesuser_creation_time;
				$record[] = $temp->tes_duration_time.' menit';
			}
			$record[] = $temp->tes_nama;
            $record[] = $temp->grup_nama;
			if(empty($temp->tesuser_id)){
				$record[] = '<b>'.stripslashes($temp->user_firstname).'</b>';
			}else{
				$record[] = '<a href="#" title="Klik untuk mengetahui Detail Tes" onclick="detail_tes(\''.$temp->tesuser_id.'\')"><b>'.stripslashes($temp->user_firstname).'</b></a>';
			}
			if(empty($temp->nilai)){
				$record[] = '0.00';
			}else{
			    $skor_akhir = $this->cbt_tes_soal_model->hitung_nilai_prorata($temp->tesuser_id, $temp->tes_id);
				$record[] = '<b>' . number_format($skor_akhir, 2) . '</b>';
			}
			
			if(empty($temp->tesuser_status)){
				$record[] = 'Belum memulai';
			}else{
				if($temp->tesuser_status==1){
					$tanggal = new DateTime();
					// Cek apakah tes sudah melebihi batas waktu
					$tanggal_tes = new DateTime($temp->tesuser_creation_time);
					$tanggal_tes->modify('+'.$temp->tes_duration_time.' minutes');
					if($tanggal>$tanggal_tes){
						$record[] = 'Selesai';
					}else{
						$tanggal = $tanggal_tes->diff($tanggal);
						$menit_sisa = ($tanggal->h*60)+($tanggal->i);
						$record[] = 'Berjalan (-'.$menit_sisa.' menit)';
					}
				}else{
					$record[] = 'Selesai';
				}
			}
			
			// menampilkan pilihan edit untuk data yang sudah mengerjakan
			if(empty($temp->tesuser_id)){
				$record[] = '';
			}else{
				$record[] = '<input type="checkbox" name="edit-testuser-id['.$temp->tesuser_id.']" >';
			}

			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}
	
	/**
	* funsi tambahan 
	* 
	* 
*/
	
	function get_start() {
		$start = 0;
		if (isset($_GET['iDisplayStart'])) {
			$start = intval($_GET['iDisplayStart']);

			if ($start < 0)
				$start = 0;
		}

		return $start;
	}

	function get_rows() {
		$rows = 10;
		if (isset($_GET['iDisplayLength'])) {
			$rows = intval($_GET['iDisplayLength']);
			if ($rows < 5 || $rows > 500) {
				$rows = 10;
			}
		}

		return $rows;
	}

	function get_sort_dir() {
		$sort_dir = "ASC";
		$sdir = strip_tags($_GET['sSortDir_0']);
		if (isset($sdir)) {
			if ($sdir != "asc" ) {
				$sort_dir = "DESC";
			}
		}

		return $sort_dir;
	}
}