<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes_jadwal extends Member_Controller {
	private $kode_menu = 'tes-jadwal';
	private $kelompok = 'tes';
	private $url = 'manager/tes_jadwal';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_tes_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_soal_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $data['select_topik'] = $this->db->order_by('topik_nama', 'ASC')->get('cbt_topik')->result();
        $data['select_grup'] = $this->cbt_user_grup_model->get_group()->result();
        $data['select_modul'] = $this->cbt_modul_model->get_modul()->result();
        
        $this->template->display_admin($this->kelompok.'/tes_jadwal_view', 'Konfigurasi Jadwal', $data);
    }

    function get_jadwal_by_grup(){
        $grup_id = $this->input->get('grup_id');
        if(empty($grup_id)) return;

        $this->db->where('jadwal_grup_id', $grup_id);
        $query = $this->db->get('cbt_jadwal_template')->result();
        echo json_encode($query);
    }

    function simpan_semua_jadwal_v3(){
        $target_grup = $this->input->post('grup_id', true);
        $grid_data = json_decode($this->input->post('grid_data', false));

        if(empty($target_grup) || empty($grid_data)){
            echo json_encode(['status' => 0, 'pesan' => 'Data tidak lengkap.']);
            return;
        }

        $start_date_input = $this->input->post('start_date', true);
        $start_week = !empty($start_date_input) ? date('Y-m-d', strtotime($start_date_input)) : date('Y-m-d', strtotime('monday this week'));
        
        if($target_grup == 'all'){
            $groups = $this->cbt_user_grup_model->get_group()->result();
        } else {
            $groups = $this->cbt_user_grup_model->get_by_kolom('grup_id', $target_grup)->result();
        }

        foreach($groups as $g){
            $g_id = $g->grup_id;
            $g_name = $g->grup_nama;

            // Clear old template for this group
            $this->db->where('jadwal_grup_id', $g_id)->delete('cbt_jadwal_template');

            foreach($grid_data as $item){
                // Save to Template Table (Including ISTIRAHAT)
                $data_jadwal = [
                    'jadwal_grup_id' => $g_id,
                    'jadwal_day' => $item->day,
                    'jadwal_range' => $item->range,
                    'jadwal_topik_id' => $item->topik_id,
                    'jadwal_last_update' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('cbt_jadwal_template', $data_jadwal);

                if($item->topik_id == 'ISTIRAHAT') continue;

                // Sync to cbt_tes (Only for real topics)
                $check_topik = $this->db->where('topik_id', $item->topik_id)
                                        ->group_start()
                                            ->where('topik_grup_id', $g_id)
                                            ->or_where('topik_grup_id', 0)
                                        ->group_end()
                                        ->get('cbt_topik');
                
                if($check_topik->num_rows() == 0) continue;

                $date = date('Y-m-d', strtotime($start_week.' +'.$item->day.' days'));
                $range = explode(' - ', $item->range);
                $begin_time = $date.' '.str_replace('.', ':', $range[0]).':00';
                $end_time = $date.' '.str_replace('.', ':', $range[1]).':00';

                $this->db->select('tes_id');
                $this->db->from('cbt_tes');
                $this->db->join('cbt_tes_topik_set', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id');
                $this->db->join('cbt_tesgrup', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id');
                $this->db->where('tset_topik_id', $item->topik_id);
                $this->db->where('tstgrp_grup_id', $g_id);
                $this->db->limit(1);
                $q = $this->db->get();

                if($q->num_rows() > 0){
                    $tes_id = $q->row()->tes_id;
                    $data_tes['tes_begin_time'] = $begin_time;
                    $data_tes['tes_end_time'] = $end_time;
                    $duration = (strtotime($end_time) - strtotime($begin_time)) / 60;
                    if($duration > 0) $data_tes['tes_duration_time'] = $duration;
                    $this->cbt_tes_model->update('tes_id', $tes_id, $data_tes);
                } else {
                    $topik = $check_topik->row();
                    $data_tes['tes_nama'] = '[JADWAL] '.$g_name.' - '.$topik->topik_nama;
                    $data_tes['tes_detail'] = 'Jadwal otomatis untuk '.$topik->topik_nama;
                    $data_tes['tes_begin_time'] = $begin_time;
                    $data_tes['tes_end_time'] = $end_time;
                    $duration = (strtotime($end_time) - strtotime($begin_time)) / 60;
                    $data_tes['tes_duration_time'] = ($duration > 0) ? $duration : 90;
                    $data_tes['tes_score_right'] = 1;
                    $data_tes['tes_token'] = 1;

                    $tes_id = $this->cbt_tes_model->save($data_tes);
                    $this->cbt_tesgrup_model->save(['tstgrp_tes_id' => $tes_id, 'tstgrp_grup_id' => $g_id]);
                    $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $item->topik_id)->row()->hasil;
                    $data_set['tset_tes_id'] = $tes_id;
                    $data_set['tset_topik_id'] = $item->topik_id;
                    $data_set['tset_tipe'] = 1; 
                    $data_set['tset_jumlah'] = ($jml_soal > 0) ? $jml_soal : 1;
                    $data_set['tset_acak_soal'] = 1;
                    $data_set['tset_acak_jawaban'] = 1;
                    $this->cbt_tes_topik_set_model->save($data_set);
                    $this->cbt_tes_model->update('tes_id', $tes_id, ['tes_max_score' => $data_set['tset_jumlah']]);
                }
            }
        }

        echo json_encode(['status' => 1, 'pesan' => 'Konfigurasi Berhasil Disimpan!']);
    }

    function cetak($grup_id=null, $modul_id=null){
        if(empty($grup_id)){
            echo "Pilih grup terlebih dahulu";
            return;
        }

        $grup = $this->cbt_user_grup_model->get_by_kolom('grup_id', $grup_id)->row();
        
        $this->db->where('jadwal_grup_id', $grup_id);
        $query = $this->db->get('cbt_jadwal_template')->result();

        $jadwal = [];
        $used_days = [];
        $used_slots = [];

        foreach($query as $item){
            $range_alt = $item->jadwal_range;
            $day = $item->jadwal_day;

            if($item->jadwal_topik_id == 'ISTIRAHAT'){
                $nama = 'ISTIRAHAT';
            } else {
                $topik = $this->cbt_topik_model->get_by_kolom_limit('topik_id', $item->jadwal_topik_id, 1)->row();
                $nama = $topik ? $topik->topik_nama : '-';
            }

            $jadwal[$range_alt][$day] = $nama;
            $used_days[$day] = true;
            $used_slots[$range_alt] = true;
        }

        ksort($used_slots);

        // Get start_date from GET parameter or fallback to monday this week
        $start_date = $this->input->get('start_date');
        if (empty($start_date)) {
            $start_date = date('Y-m-d', strtotime('monday this week'));
        }

        $data['jadwal'] = $jadwal;
        $data['used_days'] = $used_days;
        $data['used_slots'] = $used_slots;
        $data['grup_name'] = $grup->grup_nama;
        $data['days_name'] = ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
        $data['start_date'] = $start_date;
        
        // Fetch Institusi Data
        $data['institusi'] = $this->db->query("SELECT * FROM core_db.institusi LIMIT 1")->row();
        
        // Fetch Active Modul (Topic)
        if (!empty($modul_id)) {
            $data['modul'] = $this->db->query("SELECT modul_nama FROM cbt_modul WHERE modul_id = ? LIMIT 1", [$modul_id])->row();
        } else {
            $data['modul'] = $this->db->query("SELECT modul_nama FROM cbt_modul WHERE modul_aktif = 1 LIMIT 1")->row();
        }

        $this->load->view($this->kelompok.'/tes_jadwal_cetak_view', $data);
    }
}
