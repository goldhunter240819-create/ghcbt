<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_pilihanganda extends Member_Controller {
	private $kode_menu = 'soal-pg';
	private $kelompok = 'modul';
	private $url = 'manager/modul_pilihanganda';
	
	function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('users_model');
        $this->load->model('cbt_tes_topik_set_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        // TOPIC SELECT LOGIC (same as other modules)
        $query_user = $this->users_model->get_user_by_username($this->access->get_username());
        $select = '<option value="">-- Pilih Mata Pelajaran --</option>';
        $counter = 0;
        if($query_user->num_rows()>0){
        	$query_user = $query_user->row();
        	if(!empty($query_user->opsi1)){
        		$user_topik = explode(',', $query_user->opsi1);
	        	foreach ($user_topik as $topik_id) {
	        		$query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $topik_id);
	        		if($query_topik->num_rows()>0){
	        			$topik = $query_topik->row();
	        			$counter++;
                        $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
	        		}
	        	}
        	}else{
        		$query_modul = $this->cbt_modul_model->get_modul();
		        if($query_modul->num_rows()>0){
		        	$query_modul = $query_modul->result();
		        	foreach ($query_modul as $temp) {
		        		$query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_modul_id', $temp->modul_id);
		        		if($query_topik->num_rows()){
		        			$select = $select.'<optgroup label="Modul '.$temp->modul_nama.'">';
		        			$query_topik = $query_topik->result();
		        			foreach ($query_topik as $topik) {
		        				$counter++;
                                $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
		        			}
		        			$select = $select.'</optgroup>';
		        		}
		        	}
		        }
        	}
        }
        if($counter==0) $select = '<option value="kosong">Tidak Ada Data Mata Pelajaran</option>';
        
        $data['select_topik'] = $select;
        $this->template->display_admin('modul/modul_pilihanganda_view', 'Soal Pilihan Ganda', $data);
    }

    function simpan(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('topik_id', 'Mata Pelajaran','required');
        $this->form_validation->set_rules('soal_text', 'Pertanyaan','required');
        $this->form_validation->set_rules('kunci', 'Kunci Jawaban','required');
        
        if($this->form_validation->run() == TRUE){
            $id_soal = $this->input->post('soal_id', true);
            $id_topik = $this->input->post('topik_id', true);
            $soal_text = $this->input->post('soal_text', false);
            $kunci = $this->input->post('kunci', true);
            $opsi = $this->input->post('opsi', false); // Diubah ke false agar HTML (gambar) tidak di-strip

            $posisi = $this->config->item('upload_path').'/topik_'.$id_topik;
            if(!is_dir($posisi)){ mkdir($posisi, 0777, true); }

            // Proses gambar Base64 di Pertanyaan
            $soal_text = $this->proses_base64_image($soal_text, $posisi);

            $data_soal['soal_topik_id'] = $id_topik;
            $data_soal['soal_detail'] = str_replace(base_url(), "[base_url]", $soal_text);
            $data_soal['soal_tipe'] = 1; 
            $data_soal['soal_difficulty'] = 1;
            $data_soal['soal_aktif'] = 1;

            if($id_topik == 'kosong'){
                $status['status'] = 0; $status['pesan'] = 'Mata Pelajaran belum tersedia';
            }else{
                if(!empty($id_soal)){
                    $this->cbt_soal_model->update('soal_id', $id_soal, $data_soal);
                    $this->cbt_jawaban_model->delete('jawaban_soal_id', $id_soal);
                }else{
                    $id_soal = $this->cbt_soal_model->save($data_soal);
                }

                if($id_soal){
                    foreach ($opsi as $key => $val) {
                        if($val != ""){
                            // Proses gambar Base64 di setiap Opsi
                            $val = $this->proses_base64_image($val, $posisi);

                            $data_j['jawaban_soal_id'] = $id_soal;
                            $data_j['jawaban_detail'] = str_replace(base_url(), "[base_url]", $val);
                            $data_j['jawaban_benar'] = ($key == $kunci ? 1 : 0);
                            $data_j['jawaban_aktif'] = 1;
                            $this->cbt_jawaban_model->save($data_j);
                        }
                    }
                    $status['status'] = 1;
                    $status['pesan'] = 'Soal Pilihan Ganda berhasil disimpan';
                }else{
                    $status['status'] = 0; $status['pesan'] = 'Gagal menyimpan soal';
                }
            }
        }else{
            $status['status'] = 0; $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }

    /**
     * Memproses gambar base64 dalam teks HTML
     */
    private function proses_base64_image($teks, $posisi){
        if (strpos($teks, 'data:image/') !== false) {
            $doc = new DOMDocument();
            // Gunakan @ untuk meredam error HTML5 yang tidak standar di DOMDocument
            @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $teks);
            $tags = $doc->getElementsByTagName('img');
            foreach ($tags as $tag) {
                $img_src = $tag->getAttribute('src');
                if (strpos($img_src, 'data:image/') !== false) {
                    $img_parts = preg_split("@[:;,]+@", $img_src);
                    $ext_parts = explode('/', $img_parts[1]);
                    $ext = $ext_parts[1];
                    
                    $file_name = uniqid() . '.' . $ext;
                    $full_path = $posisi . '/' . $file_name;
                    
                    file_put_contents($full_path, base64_decode($img_parts[3]));
                    $teks = str_replace($img_src, base_url() . $full_path, $teks);
                }
            }
        }
        return $teks;
    }

    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_soal_model->get_by_kolom('soal_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->soal_id;
				$data['soal'] = str_replace("[base_url]", base_url(), $query->soal_detail);
				$data['id_topik'] = $query->soal_topik_id;

                $query_jawaban = $this->cbt_jawaban_model->get_by_kolom('jawaban_soal_id', $id);
                $data['jawaban'] = $query_jawaban->result();
			}
		}
		echo json_encode($data);
    }

    function hapus_soal(){
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('hapus-id', 'Soal','required');
        if($this->form_validation->run() == TRUE){
        	$id = $this->input->post('hapus-id', TRUE);
            $query_soal = $this->cbt_soal_model->get_by_kolom_limit('soal_id', $id, 1);
        	if($query_soal->num_rows()>0){
        		$query_soal = $query_soal->row();
        		if($this->cbt_tes_topik_set_model->count_by_kolom('tset_topik_id', $query_soal->soal_topik_id)->row()->hasil>0){
	        		$status['status'] = 0;
	            	$status['pesan'] = 'Soal tidak bisa dihapus, Mata Pelajaran soal masih dipakai pada Ujian.';
	        	}else{
                    $this->cbt_jawaban_model->delete('jawaban_soal_id', $id);
                    $this->cbt_soal_model->delete('soal_id', $id);
                    $status['status'] = 1; $status['pesan'] = 'Soal berhasil dihapus';
                }
            }else{
                $status['status'] = 0; $status['pesan'] = 'Soal tidak ditemukan.';
            }
        }else{
			$status['status'] = 0; $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }

    function get_datatable(){
		$topik = $this->input->get('topik');
		$search = ""; $start = 0; $rows = 10;
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) $search = $_GET['sSearch'];
		$start = $this->get_start(); $rows = $this->get_rows();

		$query = $this->cbt_soal_model->get_datatable($start, $rows, 'soal_detail', $search, $topik, 1);
		$iTotal= $this->cbt_soal_model->get_datatable_count('soal_detail', $search, $topik, 1)->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
                $record = array();
                $record[] = ++$i;
                $soal_tampil = str_replace("[base_url]", base_url(), $temp->soal_detail);
                // Batasi tampilan di tabel agar tidak meledak (pas)
                if (strlen(strip_tags($soal_tampil)) > 150) {
                    $record[] = substr(strip_tags($soal_tampil), 0, 150) . '...';
                } else {
                    $record[] = $soal_tampil;
                }

                // Option count and key
                $query_j = $this->cbt_jawaban_model->get_by_kolom('jawaban_soal_id', $temp->soal_id);
                $count = $query_j->num_rows();
                $kunci = '-';
                $labels = ['A', 'B', 'C', 'D', 'E'];
                $idx = 0;
                foreach($query_j->result() as $j){
                    if($j->jawaban_benar == 1) $kunci = $labels[$idx];
                    $idx++;
                }

                $record[] = '<div style="text-align: center;"><span class="label label-info">'.$count.' Opsi</span> <span class="label label-success">Kunci: '.$kunci.'</span></div>';

                $record[] = '<div style="text-align: center;">
                    <a onclick="preview_soal(\''.$temp->soal_id.'\', \'manager/modul_pilihanganda\')" title="Preview Tampilan Siswa" style="cursor: pointer;"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a onclick="edit(\''.$temp->soal_id.'\')" title="Edit Soal" style="cursor: pointer;"><span class="glyphicon glyphicon-edit"></span></a>
                    <a onclick="hapus(\''.$temp->soal_id.'\')" title="Hapus Soal" style="cursor: pointer;"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                ';
                $output['aaData'][] = $record;
		}
		echo json_encode($output);
	}

	function get_start() {
		$start = 0;
		if (isset($_GET['iDisplayStart'])) {
			$start = intval($_GET['iDisplayStart']);
			if ($start < 0) $start = 0;
		}
		return $start;
	}

	function get_rows() {
		$rows = 10;
		if (isset($_GET['iDisplayLength'])) {
			$rows = intval($_GET['iDisplayLength']);
			if ($rows < 5 || $rows > 500) $rows = 10;
		}
		return $rows;
	}


    /**
     * Simpan hasil import
     */
    function import_simpan(){
        $topik_id = $this->input->post('topik_id', true);
        $questions = $this->input->post('questions', true);

        if(empty($topik_id) || empty($questions)){
            $status['status'] = 0; $status['pesan'] = 'Data tidak lengkap atau belum diproses.';
        }else{
            $this->db->trans_start();
            $berhasil = 0;
            
            foreach($questions as $q){
                if($q['error'] == "true" || $q['error'] == 1) continue;

                $data_soal['soal_topik_id'] = $topik_id;
                $data_soal['soal_detail'] = str_replace(base_url(), "[base_url]", $q['soal']);
                $data_soal['soal_tipe'] = 1;
                $data_soal['soal_difficulty'] = 1;
                $data_soal['soal_aktif'] = 1;

                $id_soal = $this->cbt_soal_model->save($data_soal);
                
                foreach($q['opsi'] as $key => $val){
                    if($val != ""){
                        $data_j['jawaban_soal_id'] = $id_soal;
                        $data_j['jawaban_detail'] = str_replace(base_url(), "[base_url]", $val);
                        $data_j['jawaban_benar'] = ($key == $q['kunci'] ? 1 : 0);
                        $data_j['jawaban_aktif'] = 1;
                        $this->cbt_jawaban_model->save($data_j);
                    }
                }
                $berhasil++;
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $status['status'] = 0; $status['pesan'] = 'Gagal menyimpan ke database.';
            } else {
                $status['status'] = 1; $status['pesan'] = $berhasil . ' Soal berhasil diimport.';
            }
        }
        echo json_encode($status);
    }

    /**
     * Preview Import Massal dari Paste Editor
     */
    function import_massal_preview(){
        $html_content = $this->input->post('html_content', false);
        if(empty($html_content)){
            $status['status'] = 0; $status['pesan'] = 'Konten paste kosong.';
            echo json_encode($status);
            return;
        }

        // Folder untuk menyimpan gambar sementara
        $posisi = $this->config->item('upload_path').'/import_temp';
        if(!is_dir($posisi)){ mkdir($posisi, 0777, true); }

        // Bersihkan HTML dari entitas yang mengganggu pemisahan
        // Mendukung penanda "soal" dan "jawaban" sesuai permintaan user
        $content = str_ireplace(['<p>soal</p>', '<p><strong>soal</strong></p>', '<h4>soal</h4>', 'soal<br>', 'soal<br />'], '[SOAL_MARKER]', $html_content);
        $content = str_ireplace(['<p>jawaban</p>', '<p><strong>jawaban</strong></p>', '<h4>jawaban</h4>', 'jawaban<br>', 'jawaban<br />'], '[JAWABAN_MARKER]', $content);

        // Pecah berdasarkan marker [SOAL_MARKER] atau double newline
        $blocks = preg_split('/\[SOAL_MARKER\]|\n\s*\n|<p>&nbsp;<\/p>|<br>\s*<br>/i', $content);
        
        $data_soal = array();
        $no = 1;

        foreach ($blocks as $block) {
            $block = trim($block);
            if (empty($block) || $block == '<p>&nbsp;</p>' || $block == '<br>' || $block == '<br />') continue;

            // Bersihkan marker Jawaban jika ada
            $block = str_ireplace('[JAWABAN_MARKER]', '', $block);

            $soal = "";
            $opsi = array('A' => '', 'B' => '', 'C' => '', 'D' => '', 'E' => '');
            $kunci = "";
            $is_error = false;
            $msg_error = "";

            // 1. Ekstrak Kunci
            if(preg_match('/Kunci:\s*([A-E])/i', $block, $match_kunci)){
                $kunci = strtoupper($match_kunci[1]);
                $block = preg_replace('/Kunci:\s*[A-E]/i', '', $block);
            }

            // 2. Ekstrak Opsi A-E menggunakan pola cerdas
            // Mencari pola A. B. C. D. E. yang mungkin dibungkus tag HTML atau ganti baris
            $temp_opsi = preg_split('/(?:<p>|<div>|\n|<br>|\s|^)([A-E])\.\s*/i', $block, -1, PREG_SPLIT_DELIM_CAPTURE);
            
            // Elemen pertama (index 0) adalah SOAL (pertanyaan)
            $soal = trim($temp_opsi[0]);
            
            // Elemen ganjil adalah Label (A, B...), elemen genap setelahnya adalah Isinya
            for($i=1; $i<count($temp_opsi); $i+=2){
                $label = strtoupper(trim(isset($temp_opsi[$i]) ? $temp_opsi[$i] : ''));
                $isi = trim(isset($temp_opsi[$i+1]) ? $temp_opsi[$i+1] : '');
                if(isset($opsi[$label])){
                    // Bersihkan tag penutup yang mungkin terbawa karena split
                    $isi = preg_replace('/<\/p>|<\/div>|<br>/i', '', $isi);
                    $opsi[$label] = trim($isi);
                }
            }

            // 3. Simpan Gambar & Validasi Akhir
            if(!empty($soal)){
                $soal = $this->proses_base64_image($soal, $posisi);
                foreach($opsi as $k => $v){
                    if(!empty($v)) $opsi[$k] = $this->proses_base64_image($v, $posisi);
                }

                if(empty($opsi['D'])) { $is_error = true; $msg_error .= "Opsi D tidak ditemukan. "; }
                if(empty($kunci)) { $is_error = true; $msg_error .= "Kunci tidak terdeteksi. "; }

                $data_soal[] = array(
                    'no' => $no++,
                    'soal' => $soal,
                    'opsi' => $opsi,
                    'kunci' => $kunci,
                    'error' => $is_error,
                    'msg' => $msg_error
                );
            }
        }

        $status['status'] = 1;
        $status['data'] = $data_soal;
        echo json_encode($status);
    }
}
