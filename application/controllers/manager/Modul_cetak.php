<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_cetak extends Member_Controller {
	private $kode_menu = 'modul-cetak';
	private $kelompok = 'modul';
	private $url = 'manager/modul_cetak';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_soal_matching_model');
		$this->load->model('cbt_konfigurasi_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        // Get Modules
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();

        // Load Topic List (Respecting user scope/limits)
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
                        $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;
                        $counter++;
                        $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.' ['.$jml_soal.']</option>';
                    }
                }
            }else{
                $query_modul = $this->cbt_modul_model->get_modul();
                if($query_modul->num_rows()>0){
                    $query_modul = $query_modul->result();
                    foreach ($query_modul as $temp) {
                        $query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_modul_id', $temp->modul_id);
                        if($query_topik->num_rows()){
                            $select = $select.'<optgroup label="Topik '.$temp->modul_nama.'">';
                            $query_topik = $query_topik->result();
                            foreach ($query_topik as $topik) {
                            	$jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;
                                $counter++;
                                $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.' ['.$jml_soal.']</option>';
                            }
                            $select = $select.'</optgroup>';
                        }
                    }
                }
            }
        }
        if($counter==0){
        	$select = '<option value="kosong">Tidak Ada Data Mata Pelajaran</option>';
        }
        $data['select_topik'] = $select;

        // Load Class List (User Grup)
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();

        $this->template->display_admin($this->kelompok.'/modul_cetak_view', 'Cetak Soal', $data);
    }
	
	function preview($topik_id=null, $grup_id=null, $jenis_soal_filter=null){
		if(!empty($topik_id)){
			$query_soal = $this->cbt_soal_model->get_by_kolom('soal_topik_id', $topik_id);
			if($query_soal->num_rows()>0){
                if (empty($jenis_soal_filter)) $jenis_soal_filter = $this->input->get('jenis');
                if (empty($jenis_soal_filter) && isset($_SERVER['QUERY_STRING'])) {
                    parse_str($_SERVER['QUERY_STRING'], $qparams);
                    if (isset($qparams['jenis'])) {
                        $jenis_soal_filter = $qparams['jenis'];
                    }
                }
                if ($jenis_soal_filter === 'all') $jenis_soal_filter = null;
                $jenis_arr = !empty($jenis_soal_filter) ? explode(',', $jenis_soal_filter) : [];
                
				$query_soal = $query_soal->result();
				$query_topik = $this->cbt_topik_model->get_by_kolom_limit('topik_id', $topik_id, 1)->row();

                // Get App Configuration for Header
                $data['cbt_nama'] = $this->config->item('cbt_nama');
                $data['cbt_tahun_ajaran'] = '-';
                
                $query_konf = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun_ajaran', 1);
                if($query_konf->num_rows()>0){ $data['cbt_tahun_ajaran'] = $query_konf->row()->konfigurasi_isi; }

                // Default fallback values
                $data['kop_nama_sekolah']  = 'NAMA SEKOLAH';
                $data['kop_nama_yayasan']  = '';
                $data['kop_jenjang']       = '';
                $data['kop_alamat']        = '';
                $data['kop_kota']          = '';
                $data['kop_telepon']       = '';
                $data['kop_email']         = '';
                $data['kop_website']       = '';
                $data['kop_logo']          = base_url('public/images/logo.png');
                $data['kop_nama_kepala']   = '';
                $data['kop_nip_kepala']    = '';

                // Level 1: CBT Local Brand Logo
                $data['kop_logo'] = base_url().'public/images/logo.png';

                // Level 2: CORE institusi (if configured)
                try {
                    $db_core = $this->load->database('core', TRUE);
                    if($db_core && !empty($db_core->conn_id)){
                        $query_institusi = $db_core->limit(1)->get('institusi');
                        if($query_institusi && $query_institusi->num_rows() > 0){
                            $inst = $query_institusi->row();
                            if(!empty($inst->nama))         $data['kop_nama_sekolah'] = $inst->nama;
                            if(!empty($inst->logo))         $data['kop_logo']         = '/public/uploads/logo/'.$inst->logo;
                            if(!empty($inst->nama_kepala))  $data['kop_nama_kepala']  = $inst->nama_kepala;
                            if(!empty($inst->nip_kepala))   $data['kop_nip_kepala']   = $inst->nip_kepala;
                            if(!empty($inst->kota))         $data['kop_kota']         = $inst->kota;
                            if(!empty($inst->telepon))      $data['kop_telepon']      = $inst->telepon;
                            if(!empty($inst->email))        $data['kop_email']        = $inst->email;
                            if(!empty($inst->website))      $data['kop_website']      = $inst->website;

                            // Build full address
                            $addr_parts = [];
                            if(!empty($inst->alamat))    $addr_parts[] = $inst->alamat;
                            if(!empty($inst->desa))      $addr_parts[] = 'Desa '.$inst->desa;
                            if(!empty($inst->kecamatan)) $addr_parts[] = 'Kec. '.$inst->kecamatan;
                            if(!empty($inst->kota))      $addr_parts[] = $inst->kota;
                            if(!empty($inst->provinsi))  $addr_parts[] = $inst->provinsi;
                            if(!empty($inst->kode_pos))  $addr_parts[] = $inst->kode_pos;
                            $data['kop_alamat'] = implode(', ', $addr_parts);
                        }
                    }
                } catch(Exception $e) {}

                // Keep legacy variable for backward compatibility
                $data['cbt_logo_master']      = $data['kop_logo'];
                $data['cbt_nama_madrasah']    = $data['kop_nama_sekolah'];
                $data['cbt_alamat_madrasah']  = $data['kop_alamat'];

                $data['topik_nama'] = $query_topik->topik_nama;
                $data['modul_nama'] = '';
                $query_modul = $this->cbt_modul_model->get_by_kolom_limit('modul_id', $query_topik->topik_modul_id, 1);
                if($query_modul->num_rows()>0){ $data['modul_nama'] = $query_modul->row()->modul_nama; }

                // Group Name / Class
                $data['grup_nama'] = '';
                if(!empty($grup_id) && $grup_id != 'all' && $grup_id != 'null'){
                    $query_grup = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $grup_id, 1);
                    if($query_grup->num_rows() > 0){
                        $data['grup_nama'] = $query_grup->row()->grup_nama;
                    }
                }

                $daftar_soal = [];
                $tipe_labels = [
                    1 => 'Pilihan Ganda',
                    5 => 'Checklist / Pilihan Ganda Kompleks',
                    6 => 'Benar / Salah',
                    4 => 'Menjodohkan',
                    2 => 'Essay / Uraian',
                    3 => 'Jawaban Singkat'
                ];
                
                // Define display order
                $order_tipe = [1, 5, 6, 4, 2, 3];

				foreach($query_soal as $temp){
                    if(!empty($jenis_arr) && !in_array($temp->soal_tipe, $jenis_arr)){
                        continue; // Skip soal jika tidak termasuk dalam filter jenis
                    }

                    $soal_item = [
                        'soal_id' => $temp->soal_id,
                        'soal_detail' => $temp->soal_detail,
                        'soal_tipe' => $temp->soal_tipe,
                        'soal_kunci' => $temp->soal_kunci,
                        'jawaban' => [],
                        'matching' => []
                    ];

                    // Fetch matching pairs if type is 4
                    if($temp->soal_tipe == 4){
                        $query_matching = $this->cbt_soal_matching_model->get_by_kolom('matching_soal_id', $temp->soal_id);
                        if($query_matching->num_rows() > 0){
                            $soal_item['matching'] = $query_matching->result_array();
                        }
                    }

					$query_jawaban = $this->cbt_jawaban_model->get_by_soal($temp->soal_id);
					if($query_jawaban->num_rows()>0){
						foreach ($query_jawaban->result() as $jawaban) {
							$soal_item['jawaban'][] = [
                                'jawaban_detail' => $jawaban->jawaban_detail,
                                'jawaban_benar' => $jawaban->jawaban_benar
                            ];
						}
					}
                    
                    if(!isset($daftar_soal[$temp->soal_tipe])){
                        $daftar_soal[$temp->soal_tipe] = [
                            'label' => isset($tipe_labels[$temp->soal_tipe]) ? $tipe_labels[$temp->soal_tipe] : 'Lainnya',
                            'items' => []
                        ];
                    }
                    $daftar_soal[$temp->soal_tipe]['items'][] = $soal_item;
				}
                
                // Sort by order_tipe
                $sorted_soal = [];
                foreach($order_tipe as $tipe){
                    if(isset($daftar_soal[$tipe])){
                        $sorted_soal[$tipe] = $daftar_soal[$tipe];
                    }
                }
                // Add any types not in order_tipe
                foreach($daftar_soal as $tipe => $data_group){
                    if(!isset($sorted_soal[$tipe])){
                        $sorted_soal[$tipe] = $data_group;
                    }
                }

                $data['daftar_soal_grouped'] = $sorted_soal;

                $this->load->view($this->kelompok.'/modul_cetak_soal_view', $data);
            } else {
                echo "<div style='padding:20px; font-family:sans-serif; text-align:center; color:#e11d48;'>Tidak ada soal di dalam topik ini.</div>";
            }
		} else {
            echo "<div style='padding:20px; font-family:sans-serif; text-align:center; color:#64748b;'>Pilih topik untuk menampilkan preview.</div>";
        }
	}

    function get_topik_by_filter(){
        $modul = $this->input->post('modul', true);
        $grup = $this->input->post('grup', true);

        $this->db->select('topik_id, topik_nama');
        $this->db->from('cbt_topik');
        if($modul != 'all' && !empty($modul)){
            $this->db->where('topik_modul_id', $modul);
        }
        if($grup != 'all' && !empty($grup)){
            $this->db->where('topik_grup_id', $grup);
        }
        $this->db->order_by('topik_nama', 'ASC');
        $query = $this->db->get();

        $select = '<option value="">-- Pilih Mata Pelajaran --</option>';
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $row->topik_id)->row()->hasil;
                $select .= '<option value="'.$row->topik_id.'">'.$row->topik_nama.' ['.$jml_soal.']</option>';
            }
        }
        echo $select;
    }
}
