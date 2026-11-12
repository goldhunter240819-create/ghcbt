<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tes_pelanggaran extends Member_Controller {
	private $kode_menu = 'tes-pelanggaran';
	private $kelompok = 'tes';
	private $url = 'manager/tes_pelanggaran';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_tes_model');
		$this->load->model('cbt_tes_user_model');
		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $this->template->display_admin($this->kelompok.'/tes_pelanggaran_view', 'Daftar Pelanggaran', $data);
    }

    function get_datatable(){
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

		// run query to get list
		$query = $this->cbt_tes_user_model->get_datatable_pelanggaran($start, $rows, $search);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_tes_user_model->get_datatable_pelanggaran_count($search)->row()->hasil;
	    
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
            $record[] = $temp->user_firstname;
            $record[] = $temp->tes_nama;
            $record[] = $temp->tesuser_creation_time;
            $record[] = '<span class="text-danger" style="font-weight:600;">'.($temp->tesuser_comment ? $temp->tesuser_comment : 'Pindah Layar/Aplikasi').'</span>';
            
            // Kolom Aksi
            if($temp->tesuser_unlock_request == 1){
			    $record[] = '<a onclick="buka_kunci('.$temp->tesuser_id.')" style="cursor: pointer;" class="btn btn-success btn-xs" title="Buka Kunci"><i class="fa fa-unlock"></i> Buka Kunci</a>';
            } else {
                $record[] = '<span class="label label-danger"><i class="fa fa-lock"></i> Terkunci (Belum Request)</span>';
            }

			$output['aaData'][] = $record;
		}
        
		echo json_encode($output);
	}

    function buka_kunci(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tesuser_id', 'Tesuser ID','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $tesuser_id = $this->input->post('tesuser_id', TRUE);
            
            $data_tes['tesuser_status'] = 1;
            $data_tes['tesuser_unlock_request'] = 0;
            $data_tes['tesuser_lock_time'] = NULL;
            
            $this->cbt_tes_user_model->update('tesuser_id', $tesuser_id, $data_tes);

            $status['status'] = 1;
            $status['pesan'] = 'Ujian berhasil dibuka kembali. Peserta dapat melanjutkan ujiannya.';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
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
