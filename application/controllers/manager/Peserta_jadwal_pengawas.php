<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_jadwal_pengawas extends Member_Controller {
	private $kode_menu = 'peserta-jadwal-pengawas';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_jadwal_pengawas';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_modul_model');
		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();

        // Fetch teachers from cbt user table
        $data['select_guru'] = $this->db->query("SELECT id, username, nama FROM user WHERE username != 'Maul' AND level != 'developer' ORDER BY nama ASC")->result();
        
        $this->template->display_admin($this->kelompok.'/peserta_jadwal_pengawas_view', 'Jadwal Pengawas', $data);
    }

    function get_jadwal_by_grup(){
        $grup_id = $this->input->get('grup_id');
        if(empty($grup_id)) return;

        $this->db->where('jadwal_grup_id', $grup_id);
        $pengawas = $this->db->get('cbt_jadwal_pengawas_template')->result();

        $this->db->where('jadwal_grup_id', $grup_id);
        $ujian = $this->db->get('cbt_jadwal_template')->result();

        echo json_encode([
            'pengawas' => $pengawas,
            'ujian' => $ujian
        ]);
    }

    function simpan_semua_jadwal_pengawas(){
        $target_grup = $this->input->post('grup_id', true);
        $grid_data = json_decode($this->input->post('grid_data', false));

        if(empty($target_grup) || empty($grid_data)){
            echo json_encode(['status' => 0, 'pesan' => 'Data tidak lengkap.']);
            return;
        }

        if($target_grup == 'all'){
            $groups = $this->cbt_user_grup_model->get_group()->result();
        } else {
            $groups = $this->cbt_user_grup_model->get_by_kolom('grup_id', $target_grup)->result();
        }

        foreach($groups as $g){
            $g_id = $g->grup_id;

            // Delete old template
            $this->db->where('jadwal_grup_id', $g_id);
            $this->db->delete('cbt_jadwal_pengawas_template');

            // Insert new template
            foreach($grid_data as $item){
                $data_jadwal = [
                    'jadwal_grup_id' => $g_id,
                    'jadwal_day' => $item->day,
                    'jadwal_range' => $item->range,
                    'jadwal_guru_id' => $item->guru_id,
                    'jadwal_last_update' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('cbt_jadwal_pengawas_template', $data_jadwal);
            }
        }

        echo json_encode(['status' => 1, 'pesan' => 'Jadwal Pengawas Berhasil Disimpan!']);
    }

    function generate_pengawas_otomatis(){
        $target_grup = $this->input->post('grup_id', true);
        $selected_guru = $this->input->post('guru_ids'); 
        
        if(empty($selected_guru) || empty($target_grup)){
            echo json_encode(['status' => 0, 'pesan' => 'Pilih setidaknya satu guru dan pastikan kelas terpilih.']);
            return;
        }

        if($target_grup == 'all'){
            $groups = $this->cbt_user_grup_model->get_group()->result();
        } else {
            $groups = $this->cbt_user_grup_model->get_by_kolom('grup_id', $target_grup)->result();
        }

        $grup_ids = array();
        foreach($groups as $g){
            $grup_ids[] = $g->grup_id;
        }

        $this->db->where_in('jadwal_grup_id', $grup_ids);
        $jadwal_ujian = $this->db->get('cbt_jadwal_template')->result();

        $guru_pool = $selected_guru;
        $guru_count = count($guru_pool);
        $guru_index = 0;
        
        $used_slots = [];

        foreach($groups as $g){
            $g_id = $g->grup_id;
            
            $this->db->where('jadwal_grup_id', $g_id);
            $this->db->delete('cbt_jadwal_pengawas_template');

            foreach($jadwal_ujian as $u){
                if($u->jadwal_grup_id != $g_id) continue;
                
                $day = $u->jadwal_day;
                $range = $u->jadwal_range;
                $topik = $u->jadwal_topik_id;

                if($topik == 'ISTIRAHAT'){
                    $guru_id = 'ISTIRAHAT';
                } else if(!empty($topik)){
                    $attempts = 0;
                    $assigned = false;
                    
                    while($attempts < $guru_count){
                        $candidate = $guru_pool[$guru_index];
                        $guru_index = ($guru_index + 1) % $guru_count;
                        
                        $is_busy = false;
                        if(isset($used_slots[$day][$range]) && in_array($candidate, $used_slots[$day][$range])){
                            $is_busy = true;
                        }
                        
                        if(!$is_busy){
                            $guru_id = $candidate;
                            $used_slots[$day][$range][] = $guru_id;
                            $assigned = true;
                            break;
                        }
                        $attempts++;
                    }
                    
                    if(!$assigned){
                        $guru_id = $guru_pool[array_rand($guru_pool)];
                        $used_slots[$day][$range][] = $guru_id;
                    }
                } else {
                    continue; 
                }

                $data_jadwal = [
                    'jadwal_grup_id' => $g_id,
                    'jadwal_day' => $day,
                    'jadwal_range' => $range,
                    'jadwal_guru_id' => $guru_id,
                    'jadwal_last_update' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('cbt_jadwal_pengawas_template', $data_jadwal);
            }
        }

        echo json_encode(['status' => 1, 'pesan' => 'Generate Pengawas Otomatis Berhasil!']);
    }

    function cetak($grup_id=null, $modul_id=null){
        if(empty($grup_id)){
            echo "Pilih grup terlebih dahulu";
            return;
        }

        $grup = $this->cbt_user_grup_model->get_by_kolom('grup_id', $grup_id)->row();
        
        $this->db->where('jadwal_grup_id', $grup_id);
        $query = $this->db->get('cbt_jadwal_pengawas_template')->result();

        // Fetch teachers from CBT user table
        $guru_list = $this->db->query("SELECT id, nama FROM user")->result();
        $guru_map = [];
        foreach($guru_list as $gr){
            $guru_map[$gr->id] = $gr->nama;
        }

        $jadwal = [];
        $used_days = [];
        $used_slots = [];

        foreach($query as $item){
            $range_alt = $item->jadwal_range;
            $day = $item->jadwal_day;

            if($item->jadwal_guru_id == 'ISTIRAHAT'){
                $nama = 'ISTIRAHAT';
            } else {
                $nama = isset($guru_map[$item->jadwal_guru_id]) ? $guru_map[$item->jadwal_guru_id] : '-';
            }

            $jadwal[$range_alt][$day] = $nama;
            $used_days[$day] = true;
            $used_slots[$range_alt] = true;
        }

        ksort($used_slots);

        $data['jadwal'] = $jadwal;
        $data['used_days'] = $used_days;
        $data['used_slots'] = $used_slots;
        $data['grup_name'] = $grup->grup_nama;
        $data['days_name'] = ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
        
        // Fetch Institusi Data
        $data['institusi'] = $this->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();
        
        // Fetch Active Modul (Topic)
        if (!empty($modul_id)) {
            $data['modul'] = $this->db->query("SELECT modul_nama FROM cbt_modul WHERE modul_id = ? LIMIT 1", [$modul_id])->row();
        } else {
            $data['modul'] = $this->db->query("SELECT modul_nama FROM cbt_modul WHERE modul_aktif = 1 LIMIT 1")->row();
        }

        $this->load->view($this->kelompok.'/peserta_jadwal_pengawas_cetak_view', $data);
    }
}
