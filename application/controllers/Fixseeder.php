<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fixseeder extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('cbt_topik_model');
        $this->load->model('cbt_soal_model');
        $this->load->model('cbt_jawaban_model');
    }

    public function generate() {
        echo "Memulai Perbaikan Seeding Menjodohkan...<br/>";
        $topik_nama = "Matematika Kelas 2 SD (Uji Coba)";
        $topik = $this->db->where('topik_nama', $topik_nama)->get('cbt_topik')->row();
        if(!$topik) {
            echo "Topik tidak ditemukan!";
            return;
        }
        $topik_id = $topik->topik_id;
        
        $soals = $this->db->where('soal_topik_id', $topik_id)->where('soal_tipe', 4)->get('cbt_soal')->result();

        foreach($soals as $soal) {
            $a = rand(1, 10);
            $b = rand(1, 10);
            $c = rand(11, 20);
            $d = rand(1, 5);

            $detail = "<p>Tarik garis untuk menjodohkan operasi hitung di sebelah kiri dengan hasil yang tepat di sebelah kanan!</p>";

            // Update detail text just in case
            $this->db->where('soal_id', $soal->soal_id)->update('cbt_soal', ['soal_detail' => $detail]);

            // Clear old garbage
            $this->db->where('jawaban_soal_id', $soal->soal_id)->delete('cbt_jawaban');
            $this->db->where('matching_soal_id', $soal->soal_id)->delete('cbt_soal_matching');

            // Insert correct template pairs
            $this->db->insert('cbt_soal_matching', [
                'matching_soal_id' => $soal->soal_id,
                'matching_kiri' => "$a + $b",
                'matching_kanan' => ($a + $b)
            ]);
            
            $this->db->insert('cbt_soal_matching', [
                'matching_soal_id' => $soal->soal_id,
                'matching_kiri' => "$c - $d",
                'matching_kanan' => ($c - $d)
            ]);
        }
        
        echo "Seeding selesai untuk Menjodohkan (Total: ".count($soals)." Soal) diperbaiki inline.<br/>";
    }
}
