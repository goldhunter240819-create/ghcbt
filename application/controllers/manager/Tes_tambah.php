<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MHCBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Tes_tambah extends Member_Controller {
	private $kode_menu = 'tes-tambah';
	private $kelompok = 'tes';
	private $url = 'manager/tes_tambah';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_tes_model');
        $this->load->model('cbt_tes_user_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_soal_model');
		$this->load->helper('directory');
		$this->load->helper('file');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index($tes_id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $is_edit = 0;
        if(!empty($tes_id)){
        	$query_tes = $this->cbt_tes_model->count_by_kolom('tes_id', $tes_id)->row()->hasil;
        	if($query_tes>0){
        		$is_edit = 1;
        	}
        }

        $tanggal_awal = date('Y-m-d H:i');
        $tanggal_akhir = date('Y-m-d H:i', strtotime('+ 1 days'));
        
        $data['rentang_waktu'] = $tanggal_awal.' - '.$tanggal_akhir;

        $query_group = $this->cbt_user_grup_model->get_group();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		if($is_edit!=0){
        			if($this->cbt_tesgrup_model->count_by_tes_and_group($tes_id, $temp->grup_id)->row()->hasil>0){
        				$select = $select.'<option value="'.$temp->grup_id.'" selected>'.$temp->grup_nama.'</option>';
        			}else{
        				$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        			}
        		}else{
        			$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        		}
        	}

        }else{
        	$select = '<option value="0">Tidak Ada Group</option>';
        }
        $data['select_group'] = $select;

        $query_modul = $this->cbt_modul_model->get_modul();
        $counter = 0;
        if($query_modul->num_rows()>0){
        	$select = '';
        	$query_modul = $query_modul->result();
        	foreach ($query_modul as $temp) {
                $select = $select.'<option value="'.$temp->modul_id.'">'.$temp->modul_nama.'</option>';
                $counter++;
        	}
        }
        if($counter==0){
        	$select = '<option value="kosong">Tidak Ada Modul</option>';
        }
        $data['select_modul'] = $select;

        if($is_edit!=0){
        	$data['data_tes'] = '
        		edit(\''.$tes_id.'\');
        	';
        }
        
        $this->template->display_admin($this->kelompok.'/tes_tambah_view', 'Tambah Ujian', $data);
    }

    function get_topik_by_modul($modul=null){
        $data['data']=0;

        $data['select_topik'] = '<option value="kosong">Tidak Ada Mata Pelajaran</option>';
        if(!empty($modul)){
            $data['data']=1;
            $query_topik = $this->cbt_topik_model->get_by_kolom('topik_modul_id', $modul);
            if($query_topik->num_rows()){
                $query_topik = $query_topik->result();
                $select = '';
                foreach ($query_topik as $topik) {
                    $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;
                    $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->topik_nama.' ['.$jml_soal.' soal]</option>';
                }

                $data['select_topik'] = $select;
            }
        }

        echo json_encode($data);
    }

    function tambah_tes(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-nama', 'Nama Ujian','required|strip_tags');
        $this->form_validation->set_rules('tambah-deskripsi', 'Deskripsi Ujian','required|strip_tags');
        $this->form_validation->set_rules('tambah-rentang-waktu', 'Rentang Waktu Pengerjaan Ujian','required|strip_tags');
        $this->form_validation->set_rules('tambah-waktu', 'Waktu Pengerjaan Ujian','required|integer|strip_tags');
        $this->form_validation->set_rules('tambah-group[]', 'Grup','required|strip_tags');
        $this->form_validation->set_rules('tambah-poin', 'Poin Dasar','required|numeric|strip_tags');
        $this->form_validation->set_rules('tambah-poin-salah', 'Poin Jawaban Salah','required|numeric|strip_tags');
        $this->form_validation->set_rules('tambah-poin-kosong', 'Poin Jawaban Kosong','required|numeric|strip_tags');
        
        if($this->form_validation->run() == TRUE){
        	$tes_id = $this->input->post('tambah-id', true);
        	$nama_lama = $this->input->post('tambah-nama-lama', true);
            $data['tes_nama'] = $this->input->post('tambah-nama', true);
            $data['tes_detail'] = $this->input->post('tambah-deskripsi', true);
            $data['tes_duration_time'] = $this->input->post('tambah-waktu', true);
            $data['tes_score_right'] = $this->input->post('tambah-poin', true);
            $data['tes_score_wrong'] = $this->input->post('tambah-poin-salah', true);
            $data['tes_score_unanswered'] = $this->input->post('tambah-poin-kosong', true);

            $tunjukkan_hasil = $this->input->post('tambah-tunjukkan-hasil', true);
            if(!empty($tunjukkan_hasil)){
            	$data['tes_results_to_users'] = $tunjukkan_hasil;
            }else{
            	$data['tes_results_to_users'] = '0';
            }

            $detail_hasil = $this->input->post('tambah-detail-hasil', true);
            if(!empty($detail_hasil)){
                $data['tes_detail_to_users'] = $detail_hasil;
            }else{
                $data['tes_detail_to_users'] = '0';
            }
            
            $token = $this->input->post('tambah-token', true);
            if(!empty($token)){
            	$data['tes_token'] = $token;
            }else{
            	$data['tes_token'] = '0';
            }

            $rentang_waktu = $this->input->post('tambah-rentang-waktu', true);
            $tanggal = explode(" - ", $rentang_waktu);
            $data['tes_begin_time'] = $tanggal[0];
            $data['tes_end_time'] = $tanggal[1];

            $cek_nama = 1;
            if(!empty($nama_lama)){
            	if($nama_lama==$data['tes_nama']){
            		$cek_nama = 0;
            	}
            }
			
			$intro = $this->input->post('tambah-intro', true);
            if(!empty($intro)){
            	$intro = 1;
            }else{
            	$intro = 0;
            }
			$data['tes_intro'] = $intro;
			$intro_isi = $this->input->post('tambah-intro-isi', false);

            if($cek_nama==1 and $this->cbt_tes_model->count_by_kolom('tes_nama', $data['tes_nama'])->row()->hasil>0){
            	$status['status'] = 0;
            	$status['pesan'] = 'Nama Ujian sudah digunakan, silahkan menggunakan yang lainnya';
            }else{
                $is_process = 1;
            	// Menyimpan data tes
            	if(empty($tes_id)){
					// Jika tes baru
            		$tes_id = $this->cbt_tes_model->save($data);
					if($intro==1){
						$data_intro['tes_intro_isi'] = $this->upload_image($intro_isi, $tes_id);
						$this->cbt_tes_model->update('tes_id', $tes_id, $data_intro);
					}
            	}else{
					// Jika update
            		// Cek dulu apakah kondisi tes sudah berjalan
                    if($this->cbt_tes_user_model->count_by_kolom('tesuser_tes_id', $tes_id)->row()->hasil>0){
                        $data_time['tes_begin_time'] = $data['tes_begin_time'];
                        $data_time['tes_end_time'] = $data['tes_end_time'];
						$data_time['tes_intro'] = $intro;
						if($intro==1){
							$data_time['tes_intro_isi'] = $this->upload_image($intro_isi, $tes_id);
						}
                        $this->cbt_tes_model->update('tes_id', $tes_id, $data_time);

                        $status['status'] = 0;
                        $status['pesan'] = 'Rentang Waktu Ujian dan Intro Ujian saja yang dapat diubah, karena Ujian masih digunakan.';
                        $is_process = 0;
                    }else{
						if($intro==1){
							$data['tes_intro_isi'] = $this->upload_image($intro_isi, $tes_id);
						}
                        $this->cbt_tes_model->update('tes_id', $tes_id, $data);
                    }
            	}

                if($is_process==1){
                    // Menyimpan data group yang mengikuti tes
                    $groups = $this->input->post('tambah-group', true);
                    // menghapus data group berdasarkan tes terlebih dahulu
                    $this->cbt_tesgrup_model->delete('tstgrp_tes_id', $tes_id);
                    foreach ($groups as $group) {
                        $data_group['tstgrp_tes_id'] = $tes_id;
                        $data_group['tstgrp_grup_id'] = $group;

                        // Jika group tidak kosong
                        if($group!=0){
                            $this->cbt_tesgrup_model->save($data_group);
                        }
                    }

                    // Mengupdate score maximal
                    $data_tes['tes_max_score'] = $this->hitung_skor($tes_id);
                    $this->cbt_tes_model->update('tes_id', $tes_id, $data_tes);
                    $status['max_score']=$data_tes['tes_max_score'];
                    

                    if(!empty($tes_id)){
                        $status['status'] = 1;
                        $status['tes_id'] = $tes_id;
                        $status['tes_nama'] = $data['tes_nama'];
                        $status['pesan'] = 'Ujian berhasil disimpan, silahkan mengecek data Soal';
                    }else{
                        $status['status'] = 1;
                        $status['tes_id'] = $tes_id;
                        $status['pesan'] = 'Ujian berhasil ditambahkan, silahkan menambah data Soal';
                    }
                }
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
	
	private function upload_image($intro_isi, $tes_id){
		// menyimpan image ke folder upload
		$posisi = $this->config->item('upload_public_path').'/tes_upload';
		if(!is_dir($posisi)){
			mkdir($posisi);
		}
		$posisi = $posisi.'/tes_'.$tes_id;
		
		if(!empty($intro_isi)){
			$doc = new DOMDocument();
			$doc->loadHTML($intro_isi);
			$tags = $doc->getElementsByTagName('img');
			foreach ($tags as $tag) {
				$tes_image = $tag->getAttribute('src');
				if (strpos($tes_image, 'data:image/') !== false) {
					$tes_image_array = preg_split("@[:;,]+@", $tes_image);
					$extensi = explode('/', $tes_image_array[1]);
					
					$file_name = $posisi.'/'.uniqid().'.'.$extensi[1];
					
					if(!is_dir($posisi)){
						mkdir($posisi);
					}

					// menyimpan file dari base64
					file_put_contents($file_name, base64_decode($tes_image_array[3]));
					
					$intro_isi = str_replace($tes_image, base_url().$file_name, $intro_isi);
				}
			}

			$intro_isi = str_replace(base_url(),"[base_url]", $intro_isi);
		}
		
		return $intro_isi;
	}

    function tambah_soal(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('soal-tes-id', 'Ujian','required|strip_tags');
        $this->form_validation->set_rules('soal-topik', 'Mata Pelajaran','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
        	$tes_id = $this->input->post('soal-tes-id', true);
        	$topik_id = $this->input->post('soal-topik', true);
            
            // Cek dulu apakah kondisi tes sudah berjalan
            if($this->cbt_tes_user_model->count_by_kolom('tesuser_tes_id', $tes_id)->row()->hasil>0){
                $status['status'] = 0;
                $status['pesan'] = 'Data Soal tidak bisa di tambah. Ujian masih digunakan.';
                echo json_encode($status);
                return;
            }

            $pesan = '';
            $status_b = 1;
            
            // Definisikan Tipe Soal
            $tipes = array(1, 2, 3, 4, 5, 6);
            
            foreach ($tipes as $tipe) {
                $jml = $this->input->post('soal-jml-'.$tipe, true);
                if($jml > 0){
                    $data = array();
                    $data['tset_tes_id'] = $tes_id;
                    $data['tset_topik_id'] = $topik_id;
                    $data['tset_tipe'] = $tipe;
                    $data['tset_difficulty'] = 1; // Default
                    $data['tset_jawaban'] = 5; // Default options (only affects PG natively)
                    $data['tset_jumlah'] = $jml;
                    
                    // Fixed to ALways Random
                    $data['tset_acak_soal'] = '1';
                    $data['tset_acak_jawaban'] = '1';

                    // Hitung ketersediaan soal di database
                    $jml_tersedia = $this->db->where('soal_topik_id', $topik_id)->where('soal_tipe', $tipe)->count_all_results('cbt_soal');

                    if($jml <= $jml_tersedia){
                        if($this->cbt_tes_topik_set_model->count_by_test_topik_tipe($tes_id, $topik_id, $tipe)->row()->hasil > 0){
                            $pesan .= 'Soal Tipe '.$tipe.' sudah dimasukkan ke Ujian!<br>';
                            $status_b = 0;
                        }else{
                            $this->cbt_tes_topik_set_model->save($data);
                        }
                    }else{
                        $status_b = 0;
                        $pesan .= 'Tipe '.$tipe.': Bank Soal cuman ada '.$jml_tersedia.', tapi diminta '.$jml.'!<br>';
                    }
                }
            }

            if($status_b == 1 && $pesan == ''){
                $status['status'] = 1;
                $status['pesan'] = 'Komposisi Soal berhasil ditambahkan!';
            }else{
                // Jika sebagian gagal
                $status['status'] = ($pesan == '') ? 1 : 0;
                $status['pesan'] = ($pesan != '') ? $pesan : 'Berhasil';
            }

            // update max score
            $data_tes['tes_max_score'] = $this->hitung_skor($tes_id);
            $this->cbt_tes_model->update('tes_id', $tes_id, $data_tes);
            $status['max_score'] = $data_tes['tes_max_score'];
               
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }

        echo json_encode($status);
    }

    function hapus_soal_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			// Cek dulu apakah kondisi tes sudah berjalan
            $query_soal = $this->cbt_tes_topik_set_model->get_by_kolom_limit('tset_id', $id, 1)->row();
            if($this->cbt_tes_user_model->count_by_kolom('tesuser_tes_id', $query_soal->tset_tes_id)->row()->hasil>0){
                $data['data'] = 0;
                $data['pesan'] = 'Data Soal tidak bisa di hapus. Ujian masih digunakan.';
            }else{
                // hapus soal dari tes
                $this->cbt_tes_topik_set_model->delete('tset_id', $id);
                $data['data'] = 1;
                $data['pesan'] = 'Data Soal berhasil dihapus';

                // update max score di table ctb_test
                $data_tes['tes_max_score'] = $this->hitung_skor($query_soal->tset_tes_id);
                $this->cbt_tes_model->update('tes_id', $query_soal->tset_tes_id, $data_tes);
                $data['max_score'] = $data_tes['tes_max_score'];
            }
		}
		echo json_encode($data);
    }

    private function hitung_skor($tes_id=null){
        $max_score = 0;
        if(!empty($tes_id)){
            $query_tes = $this->cbt_tes_model->get_by_kolom_limit('tes_id', $tes_id, 1);
            if($query_tes->num_rows()>0){
                $query_tes = $query_tes->row();
                $query_soal = $this->cbt_tes_topik_set_model->get_by_kolom('tset_tes_id', $tes_id)->result();
                foreach ($query_soal as $soal) {
                    $max_score = $max_score+($soal->tset_jumlah*$query_tes->tes_score_right);
                }
            }
        }
        return $max_score;
    }
    
    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_tes_model->get_by_kolom('tes_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->tes_id;
				$data['nama'] = $query->tes_nama;
				$data['deskripsi'] = $query->tes_detail;
				$data['intro'] = $query->tes_intro;
				$data['waktu'] = $query->tes_duration_time;
	            $data['poin'] = $query->tes_score_right;
	            $data['poin_salah'] = $query->tes_score_wrong;
	            $data['poin_kosong'] = $query->tes_score_unanswered;
	            $data['tunjukkan_hasil'] = $query->tes_results_to_users;
                $data['detail_hasil'] = $query->tes_detail_to_users;
	            $data['token'] = $query->tes_token;
	            $data['rentang_waktu'] = $query->tes_begin_time.' - '.$query->tes_end_time;
			}
		}
		echo json_encode($data);
    }
	
	function get_intro_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_tes_model->get_by_kolom('tes_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->tes_id;
				$data['nama'] = $query->tes_nama;
				$data['deskripsi'] = $query->tes_detail;
				$intro_isi = $query->tes_intro_isi;
				$data['intro_isi'] = str_replace("[base_url]", base_url(), $intro_isi);
			}
		}
		echo json_encode($data);
    }
    
    function get_datatable_soal(){
    	$tes_id = $this->input->get('tes-id');

		// variable initialization
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
		$query = $this->cbt_tes_topik_set_model->get_datatable($start, $rows, $tes_id);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_tes_topik_set_model->get_datatable_count($tes_id)->row()->hasil;
	    
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
            
            $ket_acak = '';
            if($temp->tset_acak_soal==1){
                $ket_acak = $ket_acak.' Acak Soal=YA';
            }else{
                $ket_acak = $ket_acak.' Acak Soal=TDK';
            }
            if($temp->tset_acak_jawaban==1){
                $ket_acak = $ket_acak.'; Acak JWB=YA';
            }else{
                $ket_acak = $ket_acak.'; Acak JWB=TDK';
            }
			
			$query_topik = $this->cbt_topik_model->get_by_kolom_limit('topik_id', $temp->tset_topik_id, 1)->row();
			$query_modul = $this->cbt_modul_model->get_by_kolom_limit('modul_id', $query_topik->topik_modul_id, 1)->row();
			
            $nama_tipe = "Unknown";
            if($temp->tset_tipe == 1) $nama_tipe = "Pilihan Ganda";
            else if($temp->tset_tipe == 2) $nama_tipe = "Essay";
            else if($temp->tset_tipe == 3) $nama_tipe = "Jawaban Singkat";
            else if($temp->tset_tipe == 4) $nama_tipe = "Menjodohkan";
            else if($temp->tset_tipe == 5) $nama_tipe = "Checklist";
            else if($temp->tset_tipe == 6) $nama_tipe = "Benar / Salah";

			if(!empty($query_modul->modul_nama)){
				$record[] = 'Modul '.$query_modul->modul_nama.'<br /><b>'.$query_topik->topik_nama.'</b> <br>Tipe: '.$nama_tipe.'<br>Jumlah: ['.$temp->tset_jumlah.'] Soal '.$ket_acak;
			}else{
				$record[] = '<b>'.$query_topik->topik_nama.'</b> <br>Tipe: '.$nama_tipe.'<br>Jumlah: ['.$temp->tset_jumlah.'] Soal '.$ket_acak;
			}
            $record[] = '<a onclick="hapus_soal(\''.$temp->tset_id.'\')" title="Hapus Daftar Soal" style="cursor: pointer;" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>';

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