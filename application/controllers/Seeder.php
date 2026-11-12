<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seeder extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('cbt_topik_model');
        $this->load->model('cbt_soal_model');
        $this->load->model('cbt_jawaban_model');
    }

    public function generate() {
        echo "Memulai Seeding Soal Matematika...<br/>";
        $topik_nama = "Matematika Kelas 2 SD (Uji Coba)";
        
        // Cek Topik
        $topik = $this->db->where('topik_nama', $topik_nama)->get('cbt_topik')->row();
        if(!$topik) {
            $data_topik = [
                'topik_modul_id' => 9,
                'topik_nama' => $topik_nama,
                'topik_detail' => 'Bank Soal Simulasi Multi Tipe untuk pengujian Pro Rata',
                'topik_aktif' => 1
            ];
            $this->db->insert('cbt_topik', $data_topik);
            $topik_id = $this->db->insert_id();
        } else {
            $topik_id = $topik->topik_id;
        }

        // Generate Soal
        $types = [1 => 'Pilihan Ganda', 2 => 'Essay', 4 => 'Menjodohkan', 5 => 'Checklist', 6 => 'Benar Salah'];

        foreach ($types as $tipe_num => $tipe_nama) {
            // Hapus yang lama jika ada
            $this->db->where('soal_topik_id', $topik_id)->where('soal_tipe', $tipe_num)->delete('cbt_soal');

            for ($i = 1; $i <= 50; $i++) {
                $a = rand(1, 10);
                $b = rand(1, 10);
                $jawaban_benar = $a + $b;

                // Teks Spesifik Tipe
                if ($tipe_num == 1) {
                    $detail = "<p>Berapakah hasil dari $a + $b  ?</p><p>(Soal Pilihan Ganda no $i)</p>";
                } else if ($tipe_num == 2) {
                    $detail = "<p>Jelaskan cara kamu menghitung $a + $b !</p><p>(Soal Essay no $i)</p>";
                } else if ($tipe_num == 4) {
                    $detail = "<p>Jodohkanlah operasi bilangan di bawah ini dengan hasil yang tepat:</p><p>A. $a + $b <br/>B. $a x 2</p><p>(Soal Menjodohkan no $i)</p>";
                } else if ($tipe_num == 5) {
                    $detail = "<p>Pilih semua angka yang merupakan hasil kelipatan dari ".rand(2,5)." !</p><p>(Soal Checklist no $i)</p>";
                } else if ($tipe_num == 6) {
                    $salah = $jawaban_benar + rand(1,5);
                    $rand_boolean = rand(0,1) ? $jawaban_benar : $salah;
                    $detail = "<p>Apakah pernyataan ini Benar? $a + $b = $rand_boolean.</p><p>(Soal Benar Salah no $i)</p>";
                }

                $data_soal = [
                    'soal_topik_id' => $topik_id,
                    'soal_detail' => $detail,
                    'soal_tipe' => $tipe_num,
                    'soal_kunci' => '',
                    'soal_difficulty' => 1,
                    'soal_aktif' => 1,
                    'soal_timer' => 0
                ];

                $this->db->insert('cbt_soal', $data_soal);
                $soal_id = $this->db->insert_id();

                // Generate Jawaban Pilihan untuk tipe tertentu
                if ($tipe_num == 1) {
                    // PG - 4 opsi
                    for ($j = 0; $j < 4; $j++) {
                        $is_benar = ($j == 0) ? 1 : 0;
                        $opsi = ($j == 0) ? $jawaban_benar : ($jawaban_benar + rand(1, 10) + $j);
                        $this->db->insert('cbt_jawaban', [
                            'jawaban_soal_id' => $soal_id,
                            'jawaban_detail' => "<p>$opsi</p>",
                            'jawaban_benar' => $is_benar,
                            'jawaban_aktif' => 1
                        ]);
                    }
                } else if ($tipe_num == 5) {
                    // Checklist
                    for ($j = 0; $j < 4; $j++) {
                        $is_benar = rand(0, 1);
                        $this->db->insert('cbt_jawaban', [
                            'jawaban_soal_id' => $soal_id,
                            'jawaban_detail' => "<p>Opsi Ceklist $j ".($is_benar?"(Benar)":"(Salah)")."</p>",
                            'jawaban_benar' => $is_benar,
                            'jawaban_aktif' => 1
                        ]);
                    }
                } else if ($tipe_num == 6) {
                    // Benar Salah
                    $this->db->insert('cbt_jawaban', [
                        'jawaban_soal_id' => $soal_id,
                        'jawaban_detail' => "<p>Benar</p>",
                        'jawaban_benar' => 1,
                        'jawaban_aktif' => 1
                    ]);
                    $this->db->insert('cbt_jawaban', [
                        'jawaban_soal_id' => $soal_id,
                        'jawaban_detail' => "<p>Salah</p>",
                        'jawaban_benar' => 0,
                        'jawaban_aktif' => 1
                    ]);
                } else if ($tipe_num == 4) {
                    // Menjodohkan
                    $this->db->insert('cbt_jawaban', [
                        'jawaban_soal_id' => $soal_id,
                        'jawaban_detail' => "Jawaban Pasangan A",
                        'jawaban_benar' => 1,
                        'jawaban_aktif' => 1
                    ]);
                    $this->db->insert('cbt_jawaban', [
                        'jawaban_soal_id' => $soal_id,
                        'jawaban_detail' => "Jawaban Pasangan B",
                        'jawaban_benar' => 1,
                        'jawaban_aktif' => 1
                    ]);
                }
            }
            echo "Seeding selesai untuk $tipe_nama (Total: 50 Soal).<br/>";
        }
        echo "<b>Seeding Keseluruhan Sukses! Total 250 Soal.</b>";
    }
}
