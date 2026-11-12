<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_isiansingkat extends Member_Controller {
	private $kode_menu = 'soal-isiansingkat';
	private $kelompok = 'modul';
	private $url = 'manager/modul_isiansingkat';
	
	function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('users_model');
        $this->load->model('cbt_tes_topik_set_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        // TOPIC SELECT LOGIC
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
        $this->template->display_admin('modul/modul_isiansingkat_view', 'Soal Isian Singkat', $data);
    }

    function simpan(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('topik_id', 'Mata Pelajaran','required');
        $this->form_validation->set_rules('soal_text', 'Pertanyaan','required');
        $this->form_validation->set_rules('kunci_text', 'Kunci Jawaban','required|trim');
        $this->form_validation->set_rules('bobot', 'Bobot Nilai','required|numeric');
        
        if($this->form_validation->run() == TRUE){
            $id_soal = $this->input->post('soal_id', true);
            $id_topik = $this->input->post('topik_id', true);
            $soal_text = $this->input->post('soal_text', false);
            $kunci_text = $this->input->post('kunci_text', true);
            $bobot = $this->input->post('bobot', true);

            $data_soal['soal_topik_id'] = $id_topik;
            $data_soal['soal_detail'] = str_replace(base_url(), "[base_url]", $soal_text);
            $data_soal['soal_kunci'] = $kunci_text;
            $data_soal['soal_difficulty'] = $bobot;
            $data_soal['soal_tipe'] = 3; // Isian Singkat
            $data_soal['soal_aktif'] = 1;

            if($id_topik == 'kosong'){
                $status['status'] = 0; $status['pesan'] = 'Mata Pelajaran belum tersedia';
            }else{
                if(!empty($id_soal)){
                    $this->cbt_soal_model->update('soal_id', $id_soal, $data_soal);
                }else{
                    $id_soal = $this->cbt_soal_model->save($data_soal);
                }

                if($id_soal){
                    $status['status'] = 1;
                    $status['pesan'] = 'Soal Isian Singkat berhasil disimpan';
                }else{
                    $status['status'] = 0; $status['pesan'] = 'Gagal menyimpan soal';
                }
            }
        }else{
            $status['status'] = 0; $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
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
				$data['kunci'] = $query->soal_kunci;
				$data['bobot'] = $query->soal_difficulty;
				$data['id_topik'] = $query->soal_topik_id;
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

		$query = $this->cbt_soal_model->get_datatable($start, $rows, 'soal_detail', $search, $topik, 3);
		$iTotal= $this->cbt_soal_model->get_datatable_count('soal_detail', $search, $topik, 3)->row()->hasil;
	    
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
        $record[] = str_replace("[base_url]", base_url(), $temp->soal_detail);
        $record[] = '<div style="text-align: center;"><b>'.$temp->soal_kunci.'</b></div>';
        $record[] = '<div style="text-align: center;"><span class="label label-primary">Bobot: '.$temp->soal_difficulty.'</span></div>';
        $record[] = '<div style="text-align: center;">
            <a onclick="preview_soal(\''.$temp->soal_id.'\', \'manager/modul_isiansingkat\')" title="Preview Tampilan Siswa" style="cursor: pointer;"><span class="glyphicon glyphicon-eye-open"></span></a>
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
}
