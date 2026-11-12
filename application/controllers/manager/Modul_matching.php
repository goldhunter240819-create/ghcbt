<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_matching extends Member_Controller {
	private $kode_menu = 'modul-menjodohkan';
	private $kelompok = 'modul';
	private $url = 'manager/modul_matching';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_soal_matching_model');
		$this->load->model('cbt_soal_model');
		$this->load->helper('directory');
		$this->load->helper('file');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index($id_soal=null, $id_matching=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        if($id_soal!=null){
        	$is_edit = 0;

	        if($id_matching!=null){
	        	$query_matching = $this->cbt_soal_matching_model->get_by_kolom_limit('matching_id', $id_matching, 1);
	        	if($query_matching->num_rows()>0){
	        		$query_matching = $query_matching->row();
	        		$data['data_id'] = $query_matching->matching_id;
	        		$data['data_kiri'] = $query_matching->matching_kiri;
	        		$data['data_kanan'] = $query_matching->matching_kanan;

	        		$is_edit = 1;
	        	}
	        }

        	$query_soal = $this->cbt_soal_model->get_by_kolom_limit('soal_id', $id_soal, 1);
        	if($query_soal->num_rows()>0){
        		$query_soal = $query_soal->row();

        		if($query_soal->soal_tipe==4){ // Only for tipe 4 (Menjodohkan)
        			$data['id_soal'] = $query_soal->soal_id;
	        		$soal = $query_soal->soal_detail;
					$soal = str_replace("[base_url]", base_url(), $soal);

					if(!empty($query_soal->soal_audio)){
						$posisi = $this->config->item('upload_path').'/topik_'.$query_soal->soal_topik_id;
						$soal = $soal.'
							<audio controls>
							  <source src="'.base_url().$posisi.'/'.$query_soal->soal_audio.'" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio>
						';
					}

					$data['soal'] = $soal;

					$query_topik = $this->cbt_topik_model->get_by_kolom_limit('topik_id', $query_soal->soal_topik_id, 1)->row();
					$data['topik'] = $query_topik->topik_nama;
					$data['id_topik'] = $query_topik->topik_id;
        		}else{
        			redirect('manager/modul_soal');
        		}

        	}else{
        		redirect('manager/modul_soal');
        	}
        }else{
        	redirect('manager/modul_soal');
        }

        if($is_edit==1){
        	$data['data_matching'] = '
        		edit(\''.$id_matching.'\');
        	';
        }
        
        $this->template->display_admin($this->kelompok.'/modul_matching_view', 'Mengelola Pasangan Menjodohkan', $data);
    }

    function tambah(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-soal-id', 'Soal','required|strip_tags');
        $this->form_validation->set_rules('tambah-kiri', 'Kiri/Pertanyaan','required');
        $this->form_validation->set_rules('tambah-kanan', 'Kanan/Jawaban','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
        	$id_soal = $this->input->post('tambah-soal-id', TRUE);
        	$id_matching = $this->input->post('tambah-matching-id', TRUE);

        	$kiri = $this->input->post('tambah-kiri', FALSE);
			$kanan = $this->input->post('tambah-kanan', TRUE);

        	$data['matching_soal_id'] = $id_soal;
	        $data['matching_kanan'] = $kanan;

	        $id_topik = $this->cbt_soal_model->get_by_kolom_limit('soal_id', $id_soal, 1)->row()->soal_topik_id;
	        $posisi = $this->config->item('upload_path').'/topik_'.$id_topik.'';

	        $doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="utf-8" ?>' . $kiri);
			$tags = $doc->getElementsByTagName('img');
			foreach ($tags as $tag) {
				$kiri_image = $tag->getAttribute('src');
				if (strpos($kiri_image, 'data:image/') !== false) {
					$kiri_image_array = preg_split("@[:;,]+@", $kiri_image);
					$extensi = explode('/', $kiri_image_array[1]);

					$file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

					if(!is_dir($posisi)){
			        	mkdir($posisi);
			        }

					file_put_contents($file_name, base64_decode($kiri_image_array[3]));
					$kiri = str_replace($kiri_image, base_url().$file_name, $kiri);
				}
			}

	        $kiri = str_replace(base_url(),"[base_url]", $kiri);

	        $data['matching_kiri'] = $kiri;

	        if(!empty($id_matching)){
	        	$this->cbt_soal_matching_model->update('matching_id', $id_matching, $data);
	        	$status['status'] = 1;
	        	$status['pesan'] = 'Pasangan berhasil disimpan';
	        }else{
	        	$this->cbt_soal_matching_model->save($data);	
	        	$status['status'] = 1;
	        	$status['pesan'] = 'Pasangan berhasil ditambahkan';
	        }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function hapus_matching(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('hapus-id', 'Matching','required');
        
        if($this->form_validation->run() == TRUE){
        	$id = $this->input->post('hapus-id', TRUE);
        	$this->cbt_soal_matching_model->delete('matching_id', $id);
        	$status['status'] = 1;
        	$status['pesan'] = 'Pasangan berhasil dihapus';
        }else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_soal_matching_model->get_by_kolom_limit('matching_id', $id, 1);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->matching_id;
				$data['id_soal'] = $query->matching_soal_id;
				$kiri = $query->matching_kiri;
				$kiri = str_replace("[base_url]", base_url(), $kiri);
				$data['kiri'] = $kiri;
				$data['kanan'] = $query->matching_kanan;
			}
		}
		echo json_encode($data);
    }
    
    function get_datatable(){
		$soal = $this->input->get('soal');

		$search = "";
		$start = 0;
		$rows = 10;
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}
		$start = $this->get_start();
		$rows = $this->get_rows();

		$query = $this->cbt_soal_matching_model->get_datatable($start, $rows, 'matching_kiri', $search, $soal);
		
		$iTotal= $this->cbt_soal_matching_model->get_datatable_count('matching_kiri', $search, $soal)->row()->hasil;
	    
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
			$kiri = $temp->matching_kiri;
			$kiri = str_replace("[base_url]", base_url(), $kiri);
            $record[] = $kiri;
			$record[] = $temp->matching_kanan;

            $record[] = '<div style="text-align: center;">
            	<a onclick="edit(\''.$temp->matching_id.'\')" title="Edit" style="cursor: pointer;"><span class="glyphicon glyphicon-edit"></span></a>
            	<a onclick="hapus(\''.$temp->matching_id.'\')" title="Hapus" style="cursor: pointer;"><span class="glyphicon glyphicon-remove"></span></a>
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
			if ($rows < 5 || $rows > 500) { $rows = 10; }
		}
		return $rows;
	}
}
