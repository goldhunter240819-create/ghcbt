<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_master extends Member_Controller {
	private $kode_menu = 'master-modul';
	private $kelompok = 'modul';
	private $url = 'manager/modul_master';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        // Cek jika default modul kosong
		if($this->cbt_modul_model->count_all()->row()->hasil==0){
			$data_modul['modul_nama'] = 'Default';
	        $data_modul['modul_aktif'] = 1;
	        $this->cbt_modul_model->save($data_modul);
		}
        
        $this->template->display_admin($this->kelompok.'/modul_view', 'Data Modul', $data);
    }

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-modul', 'Nama Modul','required|strip_tags');
        $this->form_validation->set_rules('tambah-status', 'Status','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['modul_nama'] = $this->input->post('tambah-modul', true);
            $status_input = $this->input->post('tambah-status', true);
            $data['modul_aktif'] = ($status_input == 'AKTIF') ? 1 : 0;

            if($this->cbt_modul_model->count_by_kolom('modul_nama', $data['modul_nama'])->row()->hasil>0){
                $status['status'] = 0;
                $status['pesan'] = 'Nama Modul sudah terpakai !';
            }else{
				$this->cbt_modul_model->save($data);
                
                $status['status'] = 1;
                $status['pesan'] = 'Data Modul berhasil disimpan ';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_modul_model->get_by_kolom('modul_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->modul_id;
				$data['modul'] = $query->modul_nama;
				$data['status'] = ($query->modul_aktif == 1) ? 'AKTIF' : 'TIDAK AKTIF';
			}
		}
		echo json_encode($data);
    }

    function hapus_daftar_modul(){
    	$this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-modul-id[]', 'Modul','required|strip_tags');
		if($this->form_validation->run() == TRUE){
			$modul_id = $this->input->post('edit-modul-id', TRUE);
			$error_hapus = 0;
			foreach( $modul_id as $kunci => $isi ) {
				if($isi=="on"){
                    // Cek jika modul sedang dipakai oleh mata pelajaran (topik)
					if($this->cbt_topik_model->count_by_kolom('topik_modul_id', $kunci)->row()->hasil>0){
	            		$error_hapus++;
	            	}else{
	            		$this->cbt_modul_model->delete('modul_id', $kunci);
	            	}
            	}
            }
            $status['status'] = 1;
            if($error_hapus>0){
            	$status['pesan'] = 'Beberapa Modul tidak dihapus karena masih menampung Mata Pelajaran !';
            }else{
            	$status['pesan'] = 'Daftar Modul berhasil dihapus';
            }
		}else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function edit(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-id', 'ID','required|strip_tags');
		$this->form_validation->set_rules('edit-modul', 'Nama Modul','required|strip_tags');
		$this->form_validation->set_rules('edit-status', 'Status','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
        $this->form_validation->set_rules('edit-modul-asli', 'Nama Modul Asli','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $id = $this->input->post('edit-id', true);
            
            if($pilihan=='hapus'){//hapus
            	if($this->cbt_topik_model->count_by_kolom('topik_modul_id', $id)->row()->hasil>0){
            		$status['status'] = 0;
                	$status['pesan'] = 'Modul masih berisi Mata Pelajaran, tidak bisa dihapus.';
            	}else{
            		$this->cbt_modul_model->delete('modul_id', $id);
					$status['status'] = 1;
					$status['pesan'] = 'Modul berhasil dihapus !';
            	}
            }else if($pilihan=='simpan'){//simpan
				$modul_asli = $this->input->post('edit-modul-asli', true);
                $data['modul_nama'] = $this->input->post('edit-modul', true);
                $status_input = $this->input->post('edit-status', true);
                $data['modul_aktif'] = ($status_input == 'AKTIF') ? 1 : 0;
                
                // Cek nama kembar selain namanya sendiri
                $cek_kembar = $this->cbt_modul_model->get_by_kolom('modul_nama', $data['modul_nama']);
                if($cek_kembar->num_rows()>0 && $modul_asli != $data['modul_nama']){
                    $status['status'] = 0;
                    $status['pesan'] = 'Nama Modul sudah terpakai !';
                }else{
                    $this->cbt_modul_model->update('modul_id', $id, $data);
                    
                    $status['status'] = 1;
                    $status['pesan'] = 'Data Modul berhasil diupdate ';
                }
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_datatable(){
		$search = "";
		$start = 0;
		$rows = 10;

		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		$start = $this->get_start();
		$rows = $this->get_rows();

		$query = $this->cbt_modul_model->get_datatable($start, $rows, 'modul_nama', $search);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_modul_model->get_datatable_count('modul_nama', $search)->row()->hasil;
	    
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

            $record[] = $temp->modul_nama;
            if($temp->modul_aktif==1){
            	$record[] = 'Aktif';
            }else{
            	$record[] = 'Tidak Aktif';
            }
            $record[] = '<a onclick="edit(\''.$temp->modul_id.'\')" style="cursor: pointer;" class="btn btn-default btn-xs">Edit</a>';
            $record[] = '<input type="checkbox" name="edit-modul-id['.$temp->modul_id.']" >';

			$output['aaData'][] = $record;
		}
		echo json_encode($output);
	}
	
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
}
