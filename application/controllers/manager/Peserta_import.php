<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_import extends Member_Controller {
	private $kode_menu = 'peserta-import';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_import';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $this->import();
    }

    public function import(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $this->load->library('form_validation');

        $data['error'] = '';
        $data['error_upload'] = '';

        if(!empty($_FILES['userfile']['name'])){
			//$config['upload_path'] = './public/uploads/';
			$config['upload_path'] = './'.$this->config->item('upload_public_path');
	        $config['allowed_types'] = 'xls|xlsx';
	        $config['max_size']	= '0';
	        $config['overwrite'] = true;
	        $config['file_name'] = $_FILES['userfile']['name'];
	            
	        $this->load->library('upload', $config);
            if (!$this->upload->do_upload()){
            	$data['error_upload'] = $this->upload->display_errors().'Tipe file yang di upload adalah '.$_FILES['userfile']['type'];
            }else{
            	$upload_data = $this->upload->data();
                $data['filename'] = 'File '.$upload_data['file_name'].' BERHASIL di IMPORT';
                        
                // disini proses import data
                $data['hasil'] = $this->import_file($upload_data['file_name']);
            }   
                    
        }else{
        	$data['error_upload'] = 'Pilih File yang akan di IMPORT';
        }
        
        $this->template->display_admin($this->kelompok.'/peserta_import_view', 'Import Peserta', $data);
    }

    function import_file($inputfile){
        $this->load->library('excel');
        //$inputFileName = './public/uploads/'.$inputfile;
		$inputFileName = './'.$this->config->item('upload_public_path').$inputfile;

        $excel = PHPExcel_IOFactory::load($inputFileName);
        $worksheet = $excel->getSheet(0);
        $highestRow = $worksheet->getHighestRow();
        $pesan='<div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Informasi!</h4>';
        
        if($highestRow>2){
            $jmldatasukses=0;
            $jmldataerror=0;
            $row=2;
            $kosong=0;
            while($kosong<4){
                $kosong=0;
                $kolom1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();//username
                $kolom2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();//password
                $kolom3 = ucwords(addslashes($worksheet->getCellByColumnAndRow(3, $row)->getValue()));//nama
                $kolom4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();//email
                $kolom5 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();//group
				$kolom6 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();//keterangan
                
                if(empty($kolom1)){ $kosong++; }
                if(empty($kolom2)){ $kosong++; }
                if(empty($kolom3)){ $kosong++; }
                if(empty($kolom5)){ $kosong++; }
                
                if($kosong==0){
                    if($this->cbt_user_grup_model->count_by_kolom('grup_nama', $kolom5)->row()->hasil>0){
                    	if($this->cbt_user_model->count_by_kolom('user_name', $kolom1)->row()->hasil>0){
                    		$pesan=$pesan.$kolom1.' - '.$kolom3.' sudah digunakan <br>';
                        	$jmldataerror++;
                    	}else{
                    		$data['user_name'] = $kolom1;
				            $data['user_password'] = $kolom2;
				            $data['user_email'] = $kolom4;
				            $data['user_firstname'] = $kolom3;
				            $data['user_grup_id'] = $this->cbt_user_grup_model->get_by_kolom_limit('grup_nama', $kolom5, 1)->row()->grup_id;
							$data['user_detail'] = $kolom6;

                    		$this->cbt_user_model->save($data);
                    		$jmldatasukses++;
                    	}
                    }else{
                        $pesan=$pesan.'Group "'.$kolom5.'" belum dibuat <br>';
                        $jmldataerror++;
                    }
                }else{
                	if($kosong<4){
                		$pesan=$pesan.'Baris ke  '.$row.' GAGAL di simpan : '.$kolom1.' - '.$kolom3.'<br>';
                    	$jmldataerror++;
                	}
                }
                
                $row++;
            }
            $pesan = $pesan.'<br>Jumlah data yang berhasil diimport adalah '.$jmldatasukses.'<br>
                            Jumlah data yang gagal di dimport adalah '.$jmldataerror.'<br>
                            Jumlah total baris yang diproses adalah '.($row-3).'<br>';
        }else{
            $pesan = $pesan.'Tidak Ada Yang Berhasil Di IMPORT. Cek kembali file excel yang dikirim';
        }
        $pesan = $pesan.'</div>';
        
        return $pesan;
    }

    public function import_word(){
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('import-siswa', 'Daftar Siswa','required');

        if($this->form_validation->run() == TRUE){
			$daftar_siswa = $this->input->post('import-siswa', false);
			
			libxml_use_internal_errors(true);
			$doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="utf-8" ?>' . $daftar_siswa);
			$tables = $doc->getElementsByTagName('table');
			if($tables->length > 0 && !empty($tables->item(0)->nodeValue)){
				$rows = $tables->item(0)->getElementsByTagName('tr');
				$counter = 1;

                $preview = '<div class="table-responsive"><table class="table" style="font-size: 12px; color: var(--text-main); background: var(--bg-box); margin-bottom: 0; width: 100%; border: 1px solid var(--border-light);">
                            <thead>
                                <tr style="background: var(--primary-gradient); color: white;">
                                    <th style="padding: 12px; border: 1px solid rgba(255,255,255,0.1);">NO</th>
                                    <th style="padding: 12px; border: 1px solid rgba(255,255,255,0.1);">NAMA</th>
                                    <th style="padding: 12px; border: 1px solid rgba(255,255,255,0.1);">TEMPAT LAHIR</th>
                                    <th style="padding: 12px; border: 1px solid rgba(255,255,255,0.1);">TGL LAHIR</th>
                                    <th style="padding: 12px; border: 1px solid rgba(255,255,255,0.1);">KELAS</th>
                                </tr>
                            </thead>
                            <tbody>';

				foreach ($rows as $row) {
					$cols = $row->getElementsByTagName('td'); 
					
                    if($cols->length < 2) continue;

					// Lewati baris header jika kolom pertama berisi kata "NAMA" atau "NO"
					$first_col = strtoupper(trim($cols->item(0)->nodeValue));
					if($first_col == 'NAMA' || $first_col == 'NO') continue;

                    // Mengambil data berdasarkan urutan kolom baru:
                    // NAMA | TEMPAT | TGL | KELAS
                    $nama = trim($cols->item(0)->nodeValue);
                    $tempat = ($cols->item(1)) ? trim($cols->item(1)->nodeValue) : '';
                    $tgl = ($cols->item(2)) ? trim($cols->item(2)->nodeValue) : '';
                    $kelas = ($cols->item(3)) ? trim($cols->item(3)->nodeValue) : '';

                    if(!empty($nama)){
                        // Cek apakah grup/kelas ada
                        $grup_info = $this->cbt_user_grup_model->get_by_kolom('grup_nama', $kelas);
                        $grup_status = ($grup_info->num_rows() > 0) ? '<span class="label label-success">OK</span>' : '<span class="label label-danger">Grup Tidak Ditemukan</span>';

                        $preview .= '<tr>
                                        <td>'.$counter.'</td>
                                        <td>'.$nama.'</td>
                                        <td>'.$tempat.'</td>
                                        <td>'.$tgl.'</td>
                                        <td>'.$kelas.' '.$grup_status.'</td>
                                    </tr>';
                        $counter++;
                    }
			   }
			   $preview .= '</tbody></table></div>';
			   
			   if($counter > 1){
				   $status['status'] = 1;
				   $status['siswa'] = $preview;
                   $status['html_raw'] = $daftar_siswa;
				   $status['pesan'] = '';
			   }else{
				   $status['status'] = 0;
				   $status['pesan'] = 'Tabel tidak dapat dideteksi atau data kosong. Pastikan Anda meng-copy tabel dari Word dengan benar.';
			   }
			}else{
				$status['status'] = 0;
				$status['pesan'] = 'Format tabel tidak valid. Silahkan cek panduan format di bawah.';
			}
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }

    public function konfirmasi_word(){
        $this->load->library('form_validation');
		$this->form_validation->set_rules('konfirmasi-import-siswa', 'Daftar Siswa','required');

        if($this->form_validation->run() == TRUE){
			$daftar_siswa = $this->input->post('konfirmasi-import-siswa', false);
			
			libxml_use_internal_errors(true);
			$doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="utf-8" ?>' . $daftar_siswa);
			$tables = $doc->getElementsByTagName('table');
			if($tables->length > 0){
				$rows = $tables->item(0)->getElementsByTagName('tr');
				$jmldatasukses = 0;
				$jmldataerror = 0;
                $pesan_error = '';

				foreach ($rows as $row) {
					$cols = $row->getElementsByTagName('td'); 
                    if($cols->length < 2) continue;

					$first_col = strtoupper(trim($cols->item(0)->nodeValue));
					if($first_col == 'NAMA' || $first_col == 'NO') continue;

                    $nama = trim($cols->item(0)->nodeValue);
                    $tempat = ($cols->item(1)) ? trim($cols->item(1)->nodeValue) : '';
                    $tgl = ($cols->item(2)) ? trim($cols->item(2)->nodeValue) : '';
                    $kelas = ($cols->item(3)) ? trim($cols->item(3)->nodeValue) : '';

                    if(!empty($nama)){
                        // Validasi Grup
                        $q_grup = $this->cbt_user_grup_model->get_by_kolom('grup_nama', $kelas);
                        if($q_grup->num_rows() > 0){
                            $grup_id = $q_grup->row()->grup_id;
                            
                            // Generate auto Username unik
                            $auto_username = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                            while($this->cbt_user_model->count_by_kolom('user_name', $auto_username)->row()->hasil > 0){
                                $auto_username = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                            }
                                
                            // Format Tanggal jika perlu (mencoba handle DD-MM-YYYY ke YYYY-MM-DD)
                            $user_birth_date = $tgl;
                            if(!empty($tgl) && strpos($tgl, '-') !== false){
                                $exp = explode('-', $tgl);
                                if(count($exp) == 3 && strlen($exp[2]) == 4){ // assume DD-MM-YYYY
                                    $user_birth_date = $exp[2].'-'.$exp[1].'-'.$exp[0];
                                }
                            }

                            // Auto-generate password
                            $password = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

                            $data_save = array(
                                'user_name' => $auto_username,
                                'user_password' => $password,
                                'user_firstname' => $nama,
                                'user_grup_id' => $grup_id,
                                'user_birth_place' => $tempat,
                                'user_birth_date' => $user_birth_date,
                                'user_regdate' => date('Y-m-d H:i:s')
                            );

                            $this->cbt_user_model->save($data_save);
                            $jmldatasukses++;
                        }else{
                            $pesan_error .= 'Kelas '.$kelas.' untuk Siswa '.$nama.' tidak ditemukan dalam sistem. <br>';
                            $jmldataerror++;
                        }
                    }
			   }
			   
			   $status['status'] = 1;
               $status['jmldatasukses'] = $jmldatasukses;
               $status['jmldataerror'] = $jmldataerror;
               $status['pesan_error'] = $pesan_error;
               $status['pesan'] = 'Proses import selesai.';
			}else{
				$status['status'] = 0;
				$status['pesan'] = 'Tidak ada tabel yang ditemukan.';
			}
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }
}