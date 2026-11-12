<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_import_word extends Member_Controller {
	private $kode_menu = 'modul-daftar';
	private $kelompok = 'modul';
	private $url = 'manager/modul_import_word';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('cbt_soal_model');
		$this->load->helper('directory');
		$this->load->helper('file');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index($soal_tipe = 1){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        $data['soal_tipe'] = $soal_tipe;
        
        $tipe_nama = 'Pilihan Ganda';
        if($soal_tipe==2) $tipe_nama = 'Essay / Uraian';
        else if($soal_tipe==3) $tipe_nama = 'Isian Singkat';
        else if($soal_tipe==4) $tipe_nama = 'Menjodohkan';
        else if($soal_tipe==5) $tipe_nama = 'Checklist / Multi-Answer';
        else if($soal_tipe==6) $tipe_nama = 'Benar / Salah';
        
        $data['tipe_nama'] = $tipe_nama;
		

        $query_user = $this->users_model->get_user_by_username($this->access->get_username());
        $select = '<option value="">-- Pilih Mata Pelajaran --</option>';
        $counter = 0;
        if($query_user->num_rows()>0){
            $query_user = $query_user->row();

            // Mengecek apakah user dibatasi hanya mengentry beberapa topik
            if(!empty($query_user->opsi1)){
                $user_topik = explode(',', $query_user->opsi1);
                foreach ($user_topik as $topik_id) {
                    $query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $topik_id);
                    if($query_topik->num_rows()>0){
                        $topik = $query_topik->row();
                        $counter++;

                        $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;

                        $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.' ['.$jml_soal.']</option>';
                    }
                }
            }else{
                // Jika user tidak dibatasi mengedit soal sesuai topik
                $query_modul = $this->cbt_modul_model->get_modul();
                if($query_modul->num_rows()>0){
                    $select = '<option value="">-- Pilih Mata Pelajaran --</option>';
                    $query_modul = $query_modul->result();
                    foreach ($query_modul as $temp) {
                        $query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_modul_id', $temp->modul_id);
                        if($query_topik->num_rows()){
                            $select = $select.'<optgroup label="Modul '.$temp->modul_nama.'">';

                            $query_topik = $query_topik->result();
                            foreach ($query_topik as $topik) {
                                $counter++;

                                $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;
                                $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.' ['.$jml_soal.']</option>';
                            }

                            $select = $select.'</optgroup>';
                        }
                    }
                }
            }
        }

        if($counter==0){
        	$select = '<option value="kosong">Tidak Ada Data Topik</option>';
        }
        
        $data['select_topik'] = $select;
        
        $this->template->display_admin($this->kelompok.'/modul_import_word_view', 'Mengimport Soal dari Word', $data);
    }

    public function download_template($tipe = 1){
        $this->load->helper('download');
        $topik_id = $this->input->get('topik');
        $topik_nama = 'Umum';
        
        if(!empty($topik_id) && $topik_id !== 'kosong'){
            $this->load->model('cbt_topik_model');
            $query = $this->cbt_topik_model->get_by_kolom('topik_id', $topik_id);
            if($query->num_rows() > 0){
                $topik_nama = $query->row()->topik_nama;
                $topik_nama = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $topik_nama); // sanitize filename
            }
        }

        $nama_file = "Template_Pilihan_Ganda_".$topik_nama.".docx";
        $source_file = "public/form/form-soal-ganda.docx";

        if($tipe == 2) {
            $nama_file = "Template_Essay_".$topik_nama.".docx";
            $source_file = "public/form/form-soal-essay.docx";
        } else if($tipe == 3) {
            $nama_file = "Template_Jawaban_Singkat_".$topik_nama.".docx";
            $source_file = "public/form/form-soal-singkat.docx";
        } else if($tipe == 4) {
            $nama_file = "Template_Menjodohkan_".$topik_nama.".docx";
            $source_file = "public/form/form-soal-menjodohkan.docx";
        } else if($tipe == 5) {
            $nama_file = "Template_Checklist_".$topik_nama.".docx";
            $source_file = "public/form/form-soal-checklist.docx";
        } else if($tipe == 6) {
            $nama_file = "Template_Benar_Salah_".$topik_nama.".docx";
            $source_file = "public/form/form-soal-benarsalah.docx";
        }

        if(file_exists($source_file)){
            $data = file_get_contents($source_file);
            force_download($nama_file, $data);
        }else{
            echo "File template tidak ditemukan: " . $source_file;
        }
    }

    function import(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('topik', 'Topik','required');
		$this->form_validation->set_rules('import-soal', 'Daftar Soal','required');

        if($this->form_validation->run() == TRUE){
        	$id_topik = $this->input->post('topik', true);
            $soal_tipe = $this->input->post('soal_tipe', true);
            if(empty($soal_tipe)) $soal_tipe = 1;
			$daftar_soal = $this->input->post('import-soal', false);
			
			libxml_use_internal_errors(true);
			$doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="utf-8" ?>' . $daftar_soal);
			$tables = $doc->getElementsByTagName('table');
			if($tables->length > 0 && !empty($tables->item(0)->nodeValue)){
				$rows = $tables->item(0)->getElementsByTagName('tr');
				$counter = 1;
				$soal = '<table border="0" width="100%" class="no-padding" class="table-condensed">';
				foreach ($rows as $row) {
					/*** get each column by tag name ***/ 
					$cols = $row->getElementsByTagName('td'); 
					
					// Lewati jika kolom kurang dari 2
					if($cols->length < 2) continue;

					// Cari kolom mana yang berisi indikator Jenis (SOAL/JAWABAN)
					// Biasanya di kolom 1 atau 2 (index 1 atau 2)
					$jenis_raw = '';
					$isi_raw_node = null;
					$kunci_raw = '0';

					// Loop pencarian kolom yang paling mungkin
					for($i=0; $i<$cols->length; $i++){
						$val = strtoupper($cols->item($i)->nodeValue);
						// Hapus spasi dan karakter tak terlihat untuk pencocokan yang akurat
						$val_clean = preg_replace('/[^A-Z]/', '', $val);
						
						if(strpos($val_clean, 'SOAL') !== false || strpos($val_clean, 'JAWABAN') !== false || strpos($val_clean, 'KUNCI') !== false || strpos($val_clean, 'MATCH') !== false){
							if(strpos($val_clean, 'SOAL') !== false) $jenis_raw = 'SOAL';
                            else if(strpos($val_clean, 'JAWABAN') !== false) $jenis_raw = 'JAWABAN';
                            else if(strpos($val_clean, 'KUNCI') !== false) $jenis_raw = 'KUNCI';
                            else if(strpos($val_clean, 'MATCH') !== false) $jenis_raw = 'MATCH';

							if($cols->item($i+1) !== null) $isi_raw_node = $cols->item($i+1);
							if($cols->item($i+2) !== null) $kunci_raw = trim($cols->item($i+2)->nodeValue);
                            if($jenis_raw == 'MATCH' && $cols->item($i+2) !== null) $kunci_raw_node = $cols->item($i+2);
							break;
						}
					}

					if(!empty($jenis_raw) && $isi_raw_node != null){
						$kunci = intval(preg_replace('/[^0-9]/', '', $kunci_raw));
						if($kunci > 1) $kunci = 1;

						// --- OPTIMASI PREVIEW: Hapus Base64 Raksasa ---
						// Mengirim balik 50MB base64 via JSON AJAX akan membekukan browser.
						// Kita hapus node <img> dan ganti dengan lencana (badge) yang jauh lebih ringan.
						$images = $isi_raw_node->getElementsByTagName('img');
						$to_modify = [];
						foreach($images as $img) { $to_modify[] = $img; }
						foreach($to_modify as $img) {
							if (strpos($img->getAttribute('src'), 'data:image/') !== false) {
								$badge = $doc->createElement('span', ' [Gambar Terlampir] ');
								$badge->setAttribute('style', 'background-color: #10b981; color: white; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: 700; display: inline-block; margin: 2px;');
								$img->parentNode->replaceChild($badge, $img);
							}
						}

                        if($jenis_raw == 'MATCH' && isset($kunci_raw_node)) {
                            $images2 = $kunci_raw_node->getElementsByTagName('img');
                            $to_modify2 = [];
                            foreach($images2 as $img) { $to_modify2[] = $img; }
                            foreach($to_modify2 as $img) {
                                if (strpos($img->getAttribute('src'), 'data:image/') !== false) {
                                    $badge = $doc->createElement('span', ' [Gambar Terlampir] ');
                                    $badge->setAttribute('style', 'background-color: #10b981; color: white; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: 700; display: inline-block; margin: 2px;');
                                    $img->parentNode->replaceChild($badge, $img);
                                }
                            }
                        }
						
						$html_isi = $this->innerHTML($isi_raw_node);

						if($jenis_raw == 'SOAL'){
							$soal = $soal.'
								<tr>
								<td valign="top" style="padding: 10px; border-bottom: 1px solid var(--border-light);"><p><b>'.$counter.'</b></p></td>
								<td colspan="2" style="padding: 10px; border-bottom: 1px solid var(--border-light);">'.$html_isi.'</td>
								<td width="15%" style="border-bottom: 1px solid var(--border-light);"></td>
								</tr>
							';
							$counter++;
						}else if($jenis_raw == 'JAWABAN'){
							$color = (($kunci == 1 && $soal_tipe == 1) || ($kunci == 1 && $soal_tipe == 6)) ? 'color: #2ecc71; font-weight: bold;' : (($kunci == 1 && $soal_tipe == 5) ? 'color: #3b82f6; font-weight: bold;' : '');
							$soal = $soal.'
									<tr>
										<td width="5%" style="padding: 5px;"> </td>
										<td width="5%" valign="top" style="padding: 5px; '.$color.'">'.($kunci == 1 ? '<i class="fa fa-check-circle"></i>' : '<i class="fa fa-circle-o"></i>').'</td>
										<td width="75%" style="padding: 5px; '.$color.'">'.$html_isi.'</td>
										<td width="15%" style="padding: 5px;"></td>
									</tr>
								';
						}else if($jenis_raw == 'KUNCI'){
                            $soal = $soal.'
									<tr>
										<td width="5%" style="padding: 5px;"> </td>
										<td width="15%" valign="top" style="padding: 5px;"><b>Kunci Jawaban</b></td>
										<td width="65%" style="padding: 5px;">'.$html_isi.'</td>
										<td width="15%" style="padding: 5px;"></td>
									</tr>
								';
                        }else if($jenis_raw == 'MATCH'){
                            $kanan_tampil = isset($kunci_raw_node) ? $this->innerHTML($kunci_raw_node) : $kunci_raw;
                            $soal = $soal.'
									<tr>
										<td width="5%" style="padding: 5px;"> </td>
										<td width="40%" style="padding: 5px; border-right: 1px solid var(--border-light);">'.$html_isi.'</td>
										<td width="40%" style="padding: 5px; padding-left: 15px;">'.$kanan_tampil.'</td>
										<td width="15%" style="padding: 5px;"></td>
									</tr>
								';
                        }
					}
			   }
			   $soal = $soal.'</table>';
			   
			   if($counter>1){
				   $status['topik'] = $id_topik;
				   $status['soal'] = $soal;
				   $status['soal_tipe'] = $soal_tipe;
				   $status['status'] = 1;
				   $status['pesan'] = '';
			   }else{
				   $status['status'] = 0;
				   $status['pesan'] = 'Silahkan cek format soal terlebih dahulu';
			   }
			}else{
				$status['status'] = 0;
				$status['pesan'] = 'Terjadi kesalahan format soal. Silahkan cek format soal terlebih dahulu';
			}
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }
	
	function konfirmasi(){
		$this->load->library('form_validation');
        
        $this->form_validation->set_rules('konfirmasi-topik', 'Topik','required');
		$this->form_validation->set_rules('konfirmasi-import-soal', 'Daftar Soal','required');
		if($this->form_validation->run() == TRUE){
			$id_topik = $this->input->post('konfirmasi-topik', true);
            $soal_tipe = $this->input->post('konfirmasi-soal-tipe', true);
            if(empty($soal_tipe)) $soal_tipe = 1;
			$daftar_soal = $this->input->post('konfirmasi-import-soal', false);
	    	$posisi = $this->config->item('upload_path').'/topik_'.$id_topik.'';
			
			libxml_use_internal_errors(true);
			$doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="utf-8" ?>' . $daftar_soal);
			$tables = $doc->getElementsByTagName('table');
			if($tables->length > 0 && !empty($tables->item(0)->nodeValue)){
				$rows = $tables->item(0)->getElementsByTagName('tr');
				$counter_soal = 0;
				$counter_jawaban = 0;
				$soal_id = 0;
				foreach ($rows as $row) {
					/*** get each column by tag name ***/ 
					$cols = $row->getElementsByTagName('td'); 
					
					// Lewati jika kolom kurang dari 2
					if($cols->length < 2) continue;

					// Cari kolom mana yang berisi indikator Jenis (SOAL/JAWABAN)
					$jenis_raw = '';
					$isi_raw_node = null;
					$kunci_raw = '0';

					// Loop pencarian kolom yang paling mungkin
					for($i=0; $i<$cols->length; $i++){
						$val = strtoupper($cols->item($i)->nodeValue);
						// Hapus spasi dan karakter tak terlihat untuk pencocokan yang akurat
						$val_clean = preg_replace('/[^A-Z]/', '', $val);
						
						if(strpos($val_clean, 'SOAL') !== false || strpos($val_clean, 'JAWABAN') !== false || strpos($val_clean, 'KUNCI') !== false || strpos($val_clean, 'MATCH') !== false){
							if(strpos($val_clean, 'SOAL') !== false) $jenis_raw = 'SOAL';
                            else if(strpos($val_clean, 'JAWABAN') !== false) $jenis_raw = 'JAWABAN';
                            else if(strpos($val_clean, 'KUNCI') !== false) $jenis_raw = 'KUNCI';
                            else if(strpos($val_clean, 'MATCH') !== false) $jenis_raw = 'MATCH';

							if($cols->item($i+1) !== null) $isi_raw_node = $cols->item($i+1);
							if($cols->item($i+2) !== null) $kunci_raw = trim($cols->item($i+2)->nodeValue);
                            if($jenis_raw == 'MATCH' && $cols->item($i+2) !== null) $kunci_raw_node = $cols->item($i+2);
							break;
						}
					}

					if(!empty($jenis_raw) && $isi_raw_node != null){
						$kunci = intval(preg_replace('/[^0-9]/', '', $kunci_raw));
						if($kunci > 1) $kunci = 1;

						if($jenis_raw == 'SOAL'){
							// Menyimpan image base64 menjadi file
							$soal = $this->innerHTML($isi_raw_node);
							
							$tags = $isi_raw_node->getElementsByTagName('img');
							foreach ($tags as $tag) {
								$soal_image = $tag->getAttribute('src');
								if (strpos($soal_image, 'data:image/') !== false) {
									$soal_image_array = preg_split("@[:;,]+@", $soal_image);
									$extensi = explode('/', $soal_image_array[1]);

									$file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

									if(!is_dir($posisi)){
										mkdir($posisi);
									}

									// menyimpan file dari base64
									file_put_contents($file_name, base64_decode($soal_image_array[3]));
									
									$soal = str_replace($soal_image, base_url().$file_name, $soal);
								}
							}
							$soal = str_replace(base_url(),"[base_url]", $soal);
							
							// Simpan soal
							$question['soal_topik_id'] = $id_topik;
							$question['soal_detail'] = $soal;
							$question['soal_tipe'] = $soal_tipe;
							$question['soal_difficulty'] = '1';
							$question['soal_aktif'] = 1;
							
							$soal_id = $this->cbt_soal_model->save($question);
							$counter_soal++;
						}else if($jenis_raw == 'JAWABAN'){
							if($soal_id!=0){
								$jawaban = $this->innerHTML($isi_raw_node);
								$tags = $isi_raw_node->getElementsByTagName('img');
								foreach ($tags as $tag) {
									$jawaban_image = $tag->getAttribute('src');
									if (strpos($jawaban_image, 'data:image/') !== false) {
										$jawaban_image_array = preg_split("@[:;,]+@", $jawaban_image);
										$extensi = explode('/', $jawaban_image_array[1]);

										$file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

										if(!is_dir($posisi)){
											mkdir($posisi);
										}

										// menyimpan file dari base64
										file_put_contents($file_name, base64_decode($jawaban_image_array[3]));
										
										$jawaban = str_replace($jawaban_image, base_url().$file_name, $jawaban);
									}
								}
								$jawaban = str_replace(base_url(),"[base_url]", $jawaban);
								
								$data['jawaban_soal_id'] = $soal_id;
								$data['jawaban_benar'] = $kunci;
								$data['jawaban_aktif'] = 1;
								$data['jawaban_detail'] = $jawaban;
								
								$this->cbt_jawaban_model->save($data);
								$counter_jawaban++;
							}
						}else if($jenis_raw == 'KUNCI'){
                            if($soal_id!=0){
                                $jawaban = $this->innerHTML($isi_raw_node);
                                $tags = $isi_raw_node->getElementsByTagName('img');
                                foreach ($tags as $tag) {
                                    $jawaban_image = $tag->getAttribute('src');
                                    if (strpos($jawaban_image, 'data:image/') !== false) {
                                        $jawaban_image_array = preg_split("@[:;,]+@", $jawaban_image);
                                        $extensi = explode('/', $jawaban_image_array[1]);

                                        $file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

                                        if(!is_dir($posisi)){
                                            mkdir($posisi);
                                        }

                                        // menyimpan file dari base64
                                        file_put_contents($file_name, base64_decode($jawaban_image_array[3]));
                                        
                                        $jawaban = str_replace($jawaban_image, base_url().$file_name, $jawaban);
                                    }
                                }
                                $jawaban = str_replace(base_url(),"[base_url]", $jawaban);
                                
                                $data_soal['soal_kunci'] = $jawaban;
                                $this->cbt_soal_model->update('soal_id', $soal_id, $data_soal);
                                $counter_jawaban++;
                            }
                        }else if($jenis_raw == 'MATCH'){
                            if($soal_id!=0){
                                $kiri = $this->innerHTML($isi_raw_node);
                                $tags = $isi_raw_node->getElementsByTagName('img');
                                foreach ($tags as $tag) {
                                    $kiri_image = $tag->getAttribute('src');
                                    if (strpos($kiri_image, 'data:image/') !== false) {
                                        $kiri_image_array = preg_split("@[:;,]+@", $kiri_image);
                                        $extensi = explode('/', $kiri_image_array[1]);

                                        $file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

                                        if(!is_dir($posisi)){
                                            mkdir($posisi);
                                        }

                                        // menyimpan file dari base64
                                        file_put_contents($file_name, base64_decode($kiri_image_array[3]));
                                        
                                        $kiri = str_replace($kiri_image, base_url().$file_name, $kiri);
                                    }
                                }
                                $kiri = str_replace(base_url(),"[base_url]", $kiri);
                                
                                $kanan = isset($kunci_raw_node) ? $this->innerHTML($kunci_raw_node) : $kunci_raw;
                                if(isset($kunci_raw_node)){
                                    $tags2 = $kunci_raw_node->getElementsByTagName('img');
                                    foreach ($tags2 as $tag) {
                                        $kanan_image = $tag->getAttribute('src');
                                        if (strpos($kanan_image, 'data:image/') !== false) {
                                            $kanan_image_array = preg_split("@[:;,]+@", $kanan_image);
                                            $extensi = explode('/', $kanan_image_array[1]);

                                            $file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

                                            if(!is_dir($posisi)){
                                                mkdir($posisi);
                                            }

                                            // menyimpan file dari base64
                                            file_put_contents($file_name, base64_decode($kanan_image_array[3]));
                                            
                                            $kanan = str_replace($kanan_image, base_url().$file_name, $kanan);
                                        }
                                    }
                                }
                                $kanan = str_replace(base_url(),"[base_url]", $kanan);

                                $data_match['matching_soal_id'] = $soal_id;
                                $data_match['matching_kiri'] = $kiri;
                                $data_match['matching_kanan'] = $kanan;
                                
                                $this->load->model('cbt_soal_matching_model');
                                $this->cbt_soal_matching_model->save($data_match);
                                $counter_jawaban++;
                            }
                        }
					}
			   }
			   $soal = $soal.'</table>';
			   
			   if($counter_soal>0){
					$status['counter_soal'] = $counter_soal;
					$status['counter_jawaban'] = $counter_jawaban;
					$status['status'] = 1;
					$status['pesan'] = 'Daftar soal berhasil di import';
			   }else{
					$status['status'] = 0;
					$status['pesan'] = 'Silahkan cek format soal terlebih dahulu';
			   }
			}else{
				$status['status'] = 0;
				$status['pesan'] = 'Terjadi kesalahan format soal. Silahkan cek format soal terlebih dahulu';
			}
		}else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
	}
	
	function innerHTML(DOMNode $n, $include_target_tag = false ) {
		$doc = new DOMDocument();
		$doc->appendChild( $doc->importNode( $n, true ) );
		$html = trim( $doc->saveHTML() );
		if ( $include_target_tag ) {
			return $html;
		}
		return preg_replace( '@^<' . $n->nodeName .'[^>]*>|</'. $n->nodeName .'>$@', '', $html );
	}

    function import_file($inputfile, $id_topik){
        $this->load->library('excel');
        $inputFileName = './public/uploads/'.$inputfile;

        $excel = PHPExcel_IOFactory::load($inputFileName);
        $worksheet = $excel->getSheet(0);
        $highestRow = $worksheet->getHighestRow();
        $pesan='<div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Informasi!</h4>';
        
        if($highestRow>10){
            $jmlsoalsukses=0;
            $jmlsoalerror=0;
            $row=6;
            $kosong=0;
            while($kosong<2){
                $kosong=0;
                $kolom1 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();//jenis, soal atau jawaban
                $kolom2 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();//isi 
                $kolom3 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();//jawaban benar atau salah
                $kolom4 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();//tingkat kesulitan
                
                if(empty($kolom1)){ $kosong=+2; }
                if(empty($kolom2)){ $kosong=+2; }
                if(empty($kolom4) and $kolom1=='Q'){ $kosong++; }
                
                if($kosong==0){
                	// Merubah html special char menjadi kode
                	$kolom2 = htmlspecialchars($kolom2);

                	// Menambah tag br untuk baris baru
                	$kolom2 = str_replace("\r","<br />",$kolom2);
                	$kolom2 = str_replace("\n","<br />",$kolom2);
                	/**
                	 * Jika tipe adalah Question
                	 */
                	if($kolom1=='Q'){
                		$question['soal_topik_id'] = $id_topik;
			        	$question['soal_detail'] = $kolom2;
			        	$question['soal_tipe'] = '1';
			        	$question['soal_difficulty'] = $kolom4;
			        	$question['soal_aktif'] = 1;

                		$soal_id = $this->cbt_soal_model->save($question);
                		$jmlsoalsukses++;


                	/**
                	 * Jika tipe adalah Answer
                	 */
                	}else if($kolom1=='A'){
				        $answer['jawaban_detail'] = $kolom2;
				        if(!empty($kolom3)){
				        	$answer['jawaban_benar'] = $kolom3;
				        }else{
				        	$answer['jawaban_benar'] = '0';
				        }
				        $answer['jawaban_aktif'] = 1;
				        $answer['jawaban_soal_id'] = $soal_id;

				        $this->cbt_jawaban_model->save($answer);
                	}

                }else{
                	if($kosong<2){
                		$pesan=$pesan.'Baris ke  '.$row.' GAGAL di simpan : '.$kolom2.'<br>';
                    	$jmlsoalerror++;
                	}
                }
                
                $row++;
            }
            $pesan = $pesan.'<br>Jumlah soal yang berhasil diimport adalah '.$jmlsoalsukses.'<br>
                            Jumlah soal yang gagal di dimport adalah '.$jmlsoalerror.'<br>
                            Jumlah total baris yang diproses adalah '.($row-6).'<br>';
        }else{
            $pesan = $pesan.'Tidak Ada Yang Berhasil Di IMPORT. Cek kembali file excel yang dikirim';
        }
        $pesan = $pesan.'</div>';
        
        return $pesan;
    }
	
	
	function upload_file(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('image-topik-id', 'Topik','required');

        if($this->form_validation->run() == TRUE){
        	$id_topik = $this->input->post('image-topik-id', true);
	    	$posisi = $this->config->item('upload_path').'/topik_'.$id_topik;

	    	if(!is_dir($posisi)){
	        	mkdir($posisi);
	        }

	    	$field_name = 'image-file';
	        if(!empty($_FILES[$field_name]['name'])){
		    	$config['upload_path'] = $posisi;
			    $config['allowed_types'] = 'jpg|png|jpeg|gif';
			    $config['max_size']	= '0';
			    $config['overwrite'] = true;
			    $config['file_name'] = strtolower($_FILES[$field_name]['name']);

			    if(file_exists($posisi.'/'.$config['file_name'])){
	        		$status['status'] = 0;
	            	$status['pesan'] = 'Nama file sudah terdapat pada direktori, silahkan ubah nama file yang akan di upload';
		    	}else{
			        $this->load->library('upload', $config);
		            if (!$this->upload->do_upload($field_name)){
		            	$status['status'] = 0;
		            	$status['pesan'] = $this->upload->display_errors();
		            }else{
		            	$upload_data = $this->upload->data();

		            	$status['status'] = 1;
		                $status['pesan'] = 'File '.$upload_data['file_name'].' BERHASIL di IMPORT';
		                $status['image'] = '<img src="'.base_url().$posisi.'/'.$upload_data['file_name'].'" style="max-height: 110px;" />';
		                $status['image_isi'] = '<img src="'.base_url().$posisi.'/'.$upload_data['file_name'].'" style="max-width: 600px;" />';
		            }   	
		    	}     
	        }else{
	        	$status['status'] = 0;
	            $status['pesan'] = 'Pilih terlebih dahulu file yang akan di upload';
	        }
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }
	
	function get_datatable_image(){
		$topik = $this->input->get('topik');
		if(!empty($topik)){
			$posisi = $this->config->item('upload_path').'/topik_'.$topik;
		}else{
			$posisi = $this->config->item('upload_path');
		}

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
		if(!is_dir($posisi)){
			mkdir($posisi);
	    }
		$query = directory_map($posisi, 1);

	    // get result after running query and put it in array
	    $iTotal = 0;
		$i=$start;

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );
		
	    foreach ($query as $temp) {			
			$record = array();

			$temp = str_replace("\\","", $temp);
            
			$record[] = ++$i;
			$is_dir=0;
			$is_image=0;
			$info = pathinfo($temp);

			if(!is_dir($posisi.'/'.$temp)){
            	if($info['extension']=='jpg' or $info['extension']=='png' or $info['extension']=='jpeg' or $info['extension']=='gif'){
            		$file_info = get_file_info($posisi.'/'.$temp);

            		$record[] = '<a style="cursor:pointer;" onclick="image_preview(\''.$posisi.'\',\''.$temp.'\')">'.$posisi.'/'.$temp.'</a>';
            		$record[] = '<a style="cursor:pointer;" onclick="image_preview(\''.$posisi.'\',\''.$temp.'\')"><img src="'.base_url().$posisi.'/'.$temp.'" height="40" /></a>';
            		$record[] = date('Y-m-d H:i:s', $file_info['date']);
            		$record[] = '<a onclick="image_preview(\''.$posisi.'\',\''.$temp.'\')" style="cursor: pointer;" class="btn btn-default btn-xs">Pilih</a>';
            		$output['aaData'][] = $record;

					$iTotal++;
            	}
        	}
		}

		$output['iTotalRecords'] = $iTotal;
		$output['iTotalDisplayRecords'] = $iTotal;
        
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