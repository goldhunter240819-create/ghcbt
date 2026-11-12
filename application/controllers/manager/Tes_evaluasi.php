<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MHCBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Tes_evaluasi extends Member_Controller {
	private $kode_menu = 'tes-evaluasi';
	private $kelompok = 'tes';
	private $url = 'manager/tes_evaluasi';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
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

		parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $query_tes = $this->cbt_tes_user_model->get_by_group();
        $select = '<option value="">-- Pilih Ujian --</option><option value="semua">Semua Ujian</option>';
        if($query_tes->num_rows()>0){
        	$query_tes = $query_tes->result();
        	foreach ($query_tes as $temp) {
        		$select = $select.'<option value="'.$temp->tes_id.'">'.$temp->tes_nama.'</option>';
        	}
        }
        $data['select_tes'] = $select;

        $query_modul = $this->cbt_modul_model->get_modul();
        $select = '<option value="">-- Pilih Modul --</option><option value="semua">Semua Modul</option>';
        if($query_modul->num_rows()>0){
        	$query_modul = $query_modul->result();
        	foreach ($query_modul as $temp) {
        		$select = $select.'<option value="'.$temp->modul_id.'">'.$temp->modul_nama.'</option>';
        	}
        }
        $data['select_modul'] = $select;
        
        $this->template->display_admin($this->kelompok.'/tes_evaluasi_view', 'Evaluasi Jawaban', $data);
    }

    function simpan_nilai(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('evaluasi-testlog-id', 'Soal','required|strip_tags');
        $this->form_validation->set_rules('evaluasi-nilai-min', 'Nilai Minimal','required|numeric|strip_tags');
        $this->form_validation->set_rules('evaluasi-nilai-max', 'Nilai Maximal','required|numeric|strip_tags');
        $this->form_validation->set_rules('evaluasi-nilai', '','required|numeric|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $nilai_persen = $this->input->post('evaluasi-nilai', TRUE); // Nilai yang masuk selalu skala 100%
            $nilai_min = $this->input->post('evaluasi-nilai-min', TRUE);
            $nilai_max = $this->input->post('evaluasi-nilai-max', TRUE);
            $tessoal_id = $this->input->post('evaluasi-testlog-id', TRUE);

            if($nilai_persen>=$nilai_min AND $nilai_persen<=$nilai_max){
                // Ambil base score / raw max score dari DB agar nilai yang disimpan sesuai parameter Pro-Rata
                $this->db->select('soal_difficulty, tes_score_right');
                $this->db->from('cbt_tes_soal');
                $this->db->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id');
                $this->db->join('cbt_tes_user', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id');
                $this->db->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
                $this->db->where('tessoal_id', $tessoal_id);
                $query = $this->db->get()->row();
                
                $real_max = ($query && $query->soal_difficulty > 0) ? $query->soal_difficulty : ($query ? $query->tes_score_right : 1);
                
                // Nilai masuk adalah skala 0.1 - 1.0
                $nilai_simpan = $nilai_persen * $real_max;

                $data['tessoal_nilai'] = $nilai_simpan;
                $data['tessoal_comment'] = 'Dinilai skala ('.$nilai_persen.') oleh '.$this->access->get_username();

                $this->cbt_tes_soal_model->update('tessoal_id', $tessoal_id, $data);

                $status['status'] = 1;
                $status['pesan'] = 'Nilai berhasil disimpan ';
            }else{
                $status['status'] = 0;
                $status['pesan'] = 'Nilai tidak boleh dibawah Nilai Minimal dan di atas Nilai Maximal !';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    /**
     * Mendapatkan soal dan jawaban berdasarkan tessoal_id
     *
     * @param      <type>  $id     The identifier
     */
    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_modul_model->get_by_kolom('modul_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->modul_id;
				$data['modul'] = $query->modul_nama;
				$data['status'] = $query->modul_aktif;
			}
		}
		echo json_encode($data);
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
            $select = '<option value="">-- Pilih Ujian --</option><option value="semua">Semua Ujian</option>';
            if($query_tes->num_rows()>0){
                foreach($query_tes->result() as $temp){
                    $select .= '<option value="'.$temp->tes_id.'">'.$temp->tes_nama.'</option>';
                }
            }
            $data['select_tes'] = $select;
        }
        echo json_encode($data);
    }
    
    function get_datatable(){
		// variable initialization
		$tes_id = $this->input->get('tes');
		$modul_id = $this->input->get('modul');
		$urutkan = $this->input->get('urutkan');

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
		$query = $this->cbt_tes_user_model->get_datatable_evaluasi($start, $rows, $tes_id, $urutkan, $modul_id);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_tes_user_model->get_datatable_evaluasi_count($tes_id, $urutkan, $modul_id)->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

        if(empty($tes_id) || empty($modul_id)){
            echo json_encode($output);
            return;
        }

	    // get result after running query and put it in array
		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
			$record = array();

            $soal = $temp->soal_detail;
            $soal = str_replace("[base_url]", base_url(), $soal);
            
			$record[] = ++$i;
            $record[] = '<div class="answer-wrapper">'.$soal.'</div>';
			// $record[] = '<div style="width:600px;"><pre style="white-space: pre-wrap;word-wrap: break-word;">'.$temp->tessoal_jawaban_text.'</pre></div>';

			$jawaban = $temp->tessoal_jawaban_text;
			// Menambah tag br untuk baris baru
			$jawaban = str_replace("\r","<br />",$jawaban);
			$jawaban = str_replace("\n","<br />",$jawaban);
			
			$record[] = '<div class="answer-wrapper">'.$jawaban.'</div>';
			
            // Skala Evaluasi baru: 0.1 - 1.0 + Tombol AI Single
			$record[] = '<a onclick="evaluasi(\''.$temp->tessoal_id.'\',\'0.1\',\'1\')" style="cursor: pointer;" class="btn btn-primary btn-xs">Manual</a> 
                         <a id="btn-ai-'.$temp->tessoal_id.'" onclick="evaluasi_ai_single(\''.$temp->tessoal_id.'\')" style="cursor: pointer;" class="btn btn-success btn-xs" title="Evaluasi Otomatis dengan AI"><i class="fa fa-magic"></i> AI</a>';
            

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

    /**
     * Penilaian otomatis menggunakan Gemini AI
     */
    function evaluasi_ai(){
        $this->load->helper('gemini');
        $tessoal_id = $this->input->post('tessoal_id', TRUE);
        $status['status'] = 0;

        if(!empty($tessoal_id)){
            // Ambil data jawaban siswa dan kuncinya
            $this->db->select('tessoal_jawaban_text, soal_detail, soal_kunci, soal_difficulty, tes_score_right')
                     ->from('cbt_tes_soal')
                     ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                     ->join('cbt_tes_user', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                     ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                     ->where('tessoal_id', $tessoal_id);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $data = $query->row();
                $question = strip_tags($data->soal_detail);
                $reference = $data->soal_kunci;
                $student_answer = $data->tessoal_jawaban_text;
                
                // Max score diatur ke 1 agar AI mengembalikan nilai antara 0-1
                $max_score = 1;

                if (empty($student_answer)) {
                    $status['pesan'] = 'Jawaban siswa kosong, tidak bisa dinilai AI.';
                } else {
                    $result = gemini_grade_essay($question, $reference, $student_answer, $max_score);

                    if (is_numeric($result)) {
                        $status['status'] = 1;
                        $status['nilai'] = $result;
                        $status['pesan'] = 'AI menyarankan nilai: ' . $result;
                    } else {
                        $status['status'] = 0;
                        $status['pesan'] = $result; // Pesan error dari helper
                    }
                }
            } else {
                $status['pesan'] = 'Data soal tidak ditemukan.';
            }
        } else {
            $status['pesan'] = 'ID Soal tidak valid.';
        }

        echo json_encode($status);
    }

    /**
     * Mengambil daftar tessoal_id yang belum dinilai
     */
    function get_unevaluated(){
        $tes_id = $this->input->post('tes', TRUE);
        $modul_id = $this->input->post('modul', TRUE);
        $sql = '';
        if(!empty($tes_id) AND $tes_id != 'semua'){
            $sql .= ' AND tesuser_tes_id="'.$tes_id.'"';
        }
        if(!empty($modul_id) AND $modul_id != 'semua'){
            $sql .= ' AND tesuser_tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = "'.$modul_id.'")';
        }
        $this->db->select('cbt_tes_soal.tessoal_id')
                 ->where('(soal_tipe="2" AND tessoal_jawaban_text IS NOT NULL AND tessoal_comment IS NULL '.$sql.' )')
                 ->from('cbt_tes_user')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->order_by('tessoal_id ASC');
        $query = $this->db->get();
        
        $ids = array();
        foreach($query->result() as $row){
            $ids[] = $row->tessoal_id;
        }
        echo json_encode(["status"=> 1, "ids" => $ids]);
    }

    /**
     * Penilaian otomatis & sekaligus simpan ke DB untuk bulk proses
     */
    function evaluasi_ai_simpan(){
        $this->load->helper('gemini');
        $tessoal_id = $this->input->post('tessoal_id', TRUE);
        $status['status'] = 0;

        if(!empty($tessoal_id)){
            $this->db->select('tessoal_jawaban_text, soal_detail, soal_kunci, soal_difficulty, tes_score_right')
                     ->from('cbt_tes_soal')
                     ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                     ->join('cbt_tes_user', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                     ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                     ->where('tessoal_id', $tessoal_id);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $data = $query->row();
                $question = strip_tags($data->soal_detail);
                $reference = $data->soal_kunci;
                $student_answer = $data->tessoal_jawaban_text;
                $max_score = 1; // Skala 0.1 - 1.0

                if (!empty($student_answer)) {
                    // Hubungi Gemini
                    $result = gemini_grade_essay($question, $reference, $student_answer, $max_score);

                    if (is_numeric($result)) {
                        // Simpan nilai (result sudah dalam skala 0.1-1.0)
                        $nilai_input = (float)$result;
                        // Pastikan minimal 0.1 sesuai regulasi baru
                        if($nilai_input < 0.1) $nilai_input = 0.1;

                        $real_max = ($data->soal_difficulty > 0) ? $data->soal_difficulty : $data->tes_score_right;
                        $nilai_simpan = $nilai_input * $real_max;

                        $update['tessoal_nilai'] = $nilai_simpan;
                        $update['tessoal_comment'] = 'Dinilai otomatis massal oleh AI Gemini ('.$nilai_input.')';

                        $this->cbt_tes_soal_model->update('tessoal_id', $tessoal_id, $update);
                        
                        $status['status'] = 1;
                        $status['pesan'] = 'Disimpan (' . $result . ')';
                    } else {
                        $status['pesan'] = $result;
                    }
                } else {
                    $status['pesan'] = 'Jawaban kosong';
                }
            } else {
                $status['pesan'] = 'Data tidak ditemukan';
            }
        }
        echo json_encode($status);
    }
    /**
     * Membatalkan penilaian (Reset tessoal_nilai dan tessoal_comment)
     */
    function reset_evaluasi(){
        $tes_id = $this->input->post('tes', TRUE);
        $modul_id = $this->input->post('modul', TRUE);
        
        $sql = '';
        if(!empty($tes_id) AND $tes_id != 'semua'){
            $sql .= ' AND tesuser_tes_id="'.$tes_id.'"';
        }
        if(!empty($modul_id) AND $modul_id != 'semua'){
            $sql .= ' AND tesuser_tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = "'.$modul_id.'")';
        }

        // Reset nilai dan komentar untuk tipe soal 2 (essay) yang sudah dinilai
        $this->db->query("
            UPDATE cbt_tes_soal 
            JOIN cbt_tes_user ON tessoal_tesuser_id = tesuser_id
            JOIN cbt_soal ON tessoal_soal_id = soal_id
            SET tessoal_nilai = 0, tessoal_comment = NULL
            WHERE soal_tipe = '2' AND tessoal_comment IS NOT NULL $sql
        ");

        $status['status'] = 1;
        $status['pesan'] = 'Skor Essay berhasil di-reset (Undo) untuk '.($tes_id=='semua' ? 'seluruh ujian di modul ini' : 'ujian terpilih').'.';
        echo json_encode($status);
    }
}