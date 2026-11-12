<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_guru extends Member_Controller {
	private $kode_menu = 'modul-guru';
	private $kelompok = 'modul';
	private $url = 'manager/modul_guru';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('users_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $this->template->display_admin($this->kelompok.'/modul_guru_view', 'Daftar Guru', $data);
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

		// run query to get user listing
		$query = $this->users_model->get_datatable($start, $rows, 'nama', $search, 'guru');
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->users_model->get_datatable_count('nama', $search, 'guru')->row()->hasil;
	    
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
            
			// Mengembalikan Kolom No.
			$record[] = ++$i;
            $record[] = $temp->username;
            $record[] = $temp->nama;
            $record[] = $temp->level;

            $action = '<div class="btn-group">';
            $action .= '<a href="'.site_url('manager/useratur/index/edit/'.$temp->id).'" class="btn btn-default btn-xs" title="Edit Data"><i class="fa fa-edit"></i> Edit</a>';
            $action .= '</div>';

            $record[] = $action;
            $record[] = '<input type="checkbox" name="edit-user-id['.$temp->id.']" >';

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

    function hapus_guru(){
        parent::cek_akses_crud($this->kode_menu, 0);
        $edit_user_id = $this->input->post('edit-user-id');
        if(!empty($edit_user_id)){
            foreach($edit_user_id as $id => $val){
                $user = $this->users_model->get_user_by_id($id)->row();
                if($user){
                    $this->users_model->delete($user->username);
                }
            }
        }
        redirect('manager/modul_guru');
    }
}
