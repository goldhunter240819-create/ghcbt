<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_daftar extends Member_Controller {
	private $kode_menu = 'peserta-daftar';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_daftar';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $query_group = $this->cbt_user_grup_model->get_group();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="100000">KOSONG</option>';
        }
        $data['select_group'] = $select;
        
        $this->template->display_admin($this->kelompok.'/peserta_daftar_view', 'Daftar Peserta', $data);
    }

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-nama', 'Nama Lengkap','required|strip_tags');
        $this->form_validation->set_rules('tambah-tmp-lahir', 'Tempat Lahir','strip_tags');
        $this->form_validation->set_rules('tambah-tgl-lahir', 'Tanggal Lahir','strip_tags');
        $this->form_validation->set_rules('tambah-email', 'Email','strip_tags');
        $this->form_validation->set_rules('tambah-detail', 'Keterangan','strip_tags|max_length[30]');
        $this->form_validation->set_rules('tambah-group', 'Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['user_name'] = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
            $data['user_password'] = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
            $data['user_email'] = $this->input->post('tambah-email', true);
            $data['user_firstname'] = $this->input->post('tambah-nama', true);
            $data['user_birth_place'] = $this->input->post('tambah-tmp-lahir', true);
            $data['user_birth_date'] = $this->input->post('tambah-tgl-lahir', true);
            $data['user_detail'] = $this->input->post('tambah-detail', true);
            $data['user_grup_id'] = $this->input->post('tambah-group', true);

            // Handle Photo Upload
            if (!empty($_FILES['tambah-foto']['name'])) {
                $config['upload_path'] = './public/uploads/siswa/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 1000;
                $config['file_name'] = $data['user_name'];
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('tambah-foto')) {
                    $upload_data = $this->upload->data();
                    $data['user_foto'] = $upload_data['file_name'];
                }
            }

            if($this->cbt_user_grup_model->count_by_kolom('grup_id', $data['user_grup_id'])->row()->hasil>0){
                while($this->cbt_user_model->count_by_kolom('user_name', $data['user_name'])->row()->hasil>0){
                    $data['user_name'] = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                }
                $this->cbt_user_model->save($data);
                $status['status'] = 1;
                $status['pesan'] = 'Data Peserta berhasil disimpan!<br/>Username: <b>'.$data['user_name'].'</b><br/>Password: <b>'.$data['user_password'].'</b>';
            }else{
                $status['status'] = 0;
                $status['pesan'] = 'Data Group tidak tersedia';
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
			$query = $this->cbt_user_model->get_by_kolom('user_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->user_id;
				$data['username'] = $query->user_name;
				$data['password'] = $query->user_password;
				$data['nama'] = $query->user_firstname;
				$data['tmp_lahir'] = $query->user_birth_place;
				$data['tgl_lahir'] = $query->user_birth_date;
				$data['alamat'] = $query->user_address;
				$data['foto'] = $query->user_foto;
				$data['email'] = $query->user_email;
				$data['detail'] = $query->user_detail;
				$data['group'] = $query->user_grup_id;
			}
		}
		echo json_encode($data);
    }

    /**
     * Menghapus peserta yang dipilih
     * @return [type] [description]
     */
    function hapus_daftar_siswa(){
    	$this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-user-id[]', 'Peserta','required|strip_tags');
		if($this->form_validation->run() == TRUE){
			$user_id = $this->input->post('edit-user-id', TRUE);
			foreach( $user_id as $kunci => $isi ) {
				if($isi=="on"){
					$this->cbt_user_model->delete('user_id', $kunci);
            	}
            }
            $status['status'] = 1;
            $status['pesan'] = 'Daftar Peserta berhasil dihapus';
		}else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function edit(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-id', 'ID','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
        $this->form_validation->set_rules('edit-password', 'Password','required|strip_tags');
        $this->form_validation->set_rules('edit-nama', 'Nama Lengkap','required|strip_tags');
        $this->form_validation->set_rules('edit-tmp-lahir', 'Tempat Lahir','strip_tags');
        $this->form_validation->set_rules('edit-tgl-lahir', 'Tanggal Lahir','strip_tags');
        $this->form_validation->set_rules('edit-email', 'Email','strip_tags');
		$this->form_validation->set_rules('edit-detail', 'Keterangan','strip_tags|max_length[30]');
        $this->form_validation->set_rules('edit-group', 'Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $id = $this->input->post('edit-id', true);
            
            if($pilihan=='hapus'){//hapus
            	$this->cbt_user_model->delete('user_id', $id);
				$status['status'] = 1;
				$status['pesan'] = 'Data Peserta berhasil dihapus !';

            }else if($pilihan=='simpan'){//simpan
                $data['user_password'] = $this->input->post('edit-password', true);
                $data['user_firstname'] = $this->input->post('edit-nama', true);
                $data['user_birth_place'] = $this->input->post('edit-tmp-lahir', true);
                $data['user_birth_date'] = $this->input->post('edit-tgl-lahir', true);
                $data['user_email'] = $this->input->post('edit-email', true);
                $data['user_grup_id'] = $this->input->post('edit-group', true);
				$data['user_detail'] = $this->input->post('edit-detail', true);

                // Handle Photo Upload
                if (!empty($_FILES['edit-foto']['name'])) {
                    $user_data = $this->cbt_user_model->get_by_kolom('user_id', $id)->row();
                    $config['upload_path'] = './public/uploads/siswa/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size'] = 1000;
                    $config['file_name'] = $user_data->user_name;
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('edit-foto')) {
                        $upload_data = $this->upload->data();
                        $data['user_foto'] = $upload_data['file_name'];
                    }
                }

                $this->cbt_user_model->update('user_id', $id, $data);

                $status['status'] = 1;
		        $status['pesan'] = 'Data Peserta berhasil disimpan ';
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_datatable(){
		// variable initialization
		$group = $this->input->get('group');

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
		$query = $this->cbt_user_model->get_datatable($start, $rows, 'user_firstname', $search, $group);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_user_model->get_datatable_count('user_firstname', $search, $group)->row()->hasil;
	    
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

            $photo_url = base_url().'public/images/avatar.png';
            if(!empty($temp->user_foto)){
                $photo_url = base_url().'public/uploads/siswa/'.$temp->user_foto;
            }
            $foto_html = '
                <div style="display:flex; align-items:center; justify-content:center; gap:8px;">
                    <div style="width: 45px; height: 50px; border-radius: 6px; overflow:hidden; border: 1px solid var(--border-light); flex-shrink: 0;">
                        <img src="'.$photo_url.'" style="width:100%; height:100%; object-fit:cover;" id="img-'.$temp->user_id.'">
                    </div>
                    <div style="display:flex; flex-direction:column; gap:4px;">
                        <button type="button" class="btn btn-xs btn-default" title="Lihat Foto Ukuran Penuh" onclick="lihatFoto(\''.$photo_url.'\')"><i class="fa fa-search-plus"></i></button>
                        <button type="button" class="btn btn-xs btn-primary" title="Ubah Foto" onclick="document.getElementById(\'upload-'.$temp->user_id.'\').click()"><i class="fa fa-upload"></i></button>
                    </div>
                </div>
                <input type="file" id="upload-'.$temp->user_id.'" style="display:none;" accept="image/*" onchange="uploadFotoInline(\''.$temp->user_id.'\', this)">
            ';
            $record[] = $foto_html;
            $record[] = stripslashes($temp->user_firstname);

            $ttl = $temp->user_birth_place.', '.$temp->user_birth_date;
            $record[] = $ttl;

            $action = '<div class="btn-group">';
            $action .= '<a href="'.site_url().'/manager/peserta_kartu/cetak_kartu_peserta/'.$temp->user_id.'" target="_blank" class="btn btn-primary btn-xs" title="Lihat Kartu">Kartu</a>';
            $action .= '<a onclick="edit(\''.$temp->user_id.'\')" style="cursor: pointer;" class="btn btn-default btn-xs" title="Edit Data">Edit</a>';
            $action .= '</div>';

            $record[] = $action;
            $record[] = '<input type="checkbox" name="edit-user-id['.$temp->user_id.']" >';

			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}

    function upload_foto_inline($id){
        $status['status'] = 0;
        $status['pesan'] = 'Gagal mengupload foto.';
        
        if(!empty($_FILES['foto']['name'])){
            $user_data = $this->cbt_user_model->get_by_kolom('user_id', $id)->row();
            
            $config['upload_path'] = './public/uploads/siswa/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; 
            $config['file_name'] = $user_data->user_name;
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['user_foto'] = $upload_data['file_name'];
                $this->cbt_user_model->update('user_id', $id, $data);
                
                $status['status'] = 1;
                $status['pesan'] = 'Foto berhasil diubah.';
                $status['image_url'] = base_url().'public/uploads/siswa/'.$data['user_foto'].'?v='.time();
            } else {
                $status['pesan'] = strip_tags($this->upload->display_errors('',''));
            }
        }
        
        echo json_encode($status);
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