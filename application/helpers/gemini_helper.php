<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper untuk integrasi Google Gemini API
 * Digunakan untuk melakukan penilaian otomatis pada soal Essay
 */

if (!function_exists('gemini_grade_essay')) {
    function gemini_grade_essay($question, $reference, $student_answer, $max_score) {
        // Daftar API Key Gemini (Bisa ditambah banyak untuk rotasi agar tidak cepat terkena limit/429)
        $api_keys = [
            'AIzaSyBsHTZVkaJppnElebQBqhm5kBLUtsn9hmI',
            'AIzaSyBUmF8IpqjksQscr7HyADxSTey8DRZ7YLs',
            'AIzaSyBz16wyTroH9biMxNCn9VstzZT983hO_mQ',
            'AIzaSyBrt5F_EBi2Zr_fqRmR7RPpLhXyYaCPm0Q',
            'AIzaSyBGnBRbgUVd1f7B_zlymcgAStVs-xR4n1I'
        ];

        // Pilih salah satu key secara acak
        $api_key = $api_keys[array_rand($api_keys)];
        
        if ($api_key == 'GANTI_DENGAN_API_KEY_GEMINI_ANDA' || empty($api_key)) {
            return "ERROR: API Key belum dikonfigurasi.";
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $api_key;

        $prompt = "Anda adalah asisten guru yang bertugas memberikan nilai pada jawaban essay siswa. 
        Kriteria penilaian:
        - Pertanyaan: $question
        - Kunci Jawaban Referensi: $reference
        - Jawaban Siswa: $student_answer
        - Nilai Maksimal: $max_score

        Berikan nilai angka saja dalam format DESIMAL antara 0.1 sampai $max_score (Contoh: 0.1, 0.5, 0.8, 1.0) berdasarkan seberapa akurat jawaban siswa dibandingkan dengan referensi. 
        PENTING: Hanya keluarkan satu angka saja, jangan ada penjelasan atau teks lain. Gunakan titik (.) sebagai pemisah desimal. Jika jawaban salah total, berikan nilai 0.1.";

        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 0.2,
                "topK" => 1,
                "topP" => 1,
                "maxOutputTokens" => 10,
            ]
        ];

        // Pencatatan untuk retry jika terkena limit (429)
        $max_retries = 3;
        $retry_count = 0;
        $http_code = 0;
        $response = '';

        while ($retry_count < $max_retries) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error_msg = curl_error($ch);
            curl_close($ch);

            if ($http_code == 200) {
                break; // Berhasil
            } elseif ($http_code == 429) {
                $retry_count++;
                if ($retry_count < $max_retries) {
                    sleep(6); // Tunggu 6 detik sebelum coba lagi
                    continue;
                }
            } else {
                break; // Error lainnya, jangan retry
            }
        }

        if ($http_code == 200) {
            $result = json_decode($response, true);
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                $score = trim($result['candidates'][0]['content']['parts'][0]['text']);
                // Pastikan output hanya angka
                if (is_numeric($score)) {
                    return $score;
                } else {
                    // Jika AI membandel memberi teks, coba ekstrak angkanya
                    preg_match('/\d+(\.\d+)?/', $score, $matches);
                    return isset($matches[0]) ? $matches[0] : "ERROR: Format nilai tidak dikenali ($score).";
                }
            }
        }

        $debug_msg = "ERROR: Gagal menghubungi API Gemini. HTTP Code: $http_code";
        if (!empty($error_msg)) {
            $debug_msg .= " | Curl Error: $error_msg";
        }
        
        return $debug_msg;
    }
}
