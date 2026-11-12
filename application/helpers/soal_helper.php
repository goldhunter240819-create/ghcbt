<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('render_soal_premium')) {
    /**
     * Merender soal dengan tampilan modern/premium
     * 
     * @param int $soal_id
     * @return string HTML
     */
    function render_soal_premium($soal_id, $mode = 'admin', $old_jawab = null) {
        $CI =& get_instance();
        $CI->load->model('cbt_soal_model');
        $CI->load->model('cbt_jawaban_model');
        $CI->load->model('cbt_soal_matching_model');

        $query_soal = $CI->cbt_soal_model->get_by_kolom('soal_id', $soal_id);
        if ($query_soal->num_rows() > 0) {
            $soal_data = $query_soal->row();
            $soal_html = str_replace("[base_url]", base_url(), $soal_data->soal_detail);
            
            // Generate Instruksi berdasarkan tipe soal
            $instruksi_html = '';
            $icon = 'fa-info-circle';
            $text = '';
            
            if ($soal_data->soal_tipe == 1) {
                $icon = 'fa-dot-circle-o';
                $text = '<strong>Instruksi:</strong> Pilih satu jawaban yang Anda anggap paling benar. <b>(Hanya dapat memilih 1 opsi)</b>';
            } else if ($soal_data->soal_tipe == 2) {
                $icon = 'fa-pencil';
                $text = '<strong>Instruksi:</strong> Ketikkan jawaban panjang/uraian Anda pada kotak yang disediakan di bawah ini.';
            } else if ($soal_data->soal_tipe == 3) {
                $icon = 'fa-terminal';
                $kunci_length = strlen(trim($soal_data->soal_kunci));
                $text = '<strong>Instruksi:</strong> Ketikkan <b>Jawaban Singkat</b> Anda pada kotak di bawah (isian maksimal '.$kunci_length.' huruf / angka). Tekan tombol Simpan Jawaban jika sudah selesai.';
            } else if ($soal_data->soal_tipe == 4) {
                $icon = 'fa-exchange';
                if($mode == 'admin') {
                    $text = '<strong>Mode Preview:</strong> Garis penghubung jawaban (Kunci) ditampilkan secara otomatis.';
                } else {
                    $text = '<strong>Instruksi Menjodohkan:</strong> Silakan klik satu kotak pada <b>Sisi Kiri</b>, lalu klik pasangan jawaban yang menurut Anda paling tepat pada <b>Sisi Kanan</b> untuk menghubungkannya.';
                }
            } else if ($soal_data->soal_tipe == 5) {
                $icon = 'fa-check-square-o';
                $text = '<strong>Instruksi:</strong> Pilih jawaban yang Anda anggap paling benar. <b>(Anda dapat mencentang lebih dari 1 pilihan jawaban)</b>';
            } else if ($soal_data->soal_tipe == 6) {
                $icon = 'fa-balance-scale';
                $text = '<strong>Instruksi:</strong> Tentukan apakah pernyataan/soal di atas bernilai <b>BENAR</b> atau <b>SALAH</b>.';
            }

            if(!empty($text)){
                $instruksi_html = '
                <div style="background: rgba(var(--primary-rgb), 0.05); border: 1px dashed var(--border-color); border-radius: 12px; padding: 12px 20px; margin-bottom: 20px; font-size: 13px; color: var(--text-main); display: flex; align-items: flex-start; gap: 12px;">
                    <div style="background: var(--primary-gradient); color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(var(--primary-rgb), 0.3);"><i class="fa '.$icon.'"></i></div>
                    <div style="line-height: 1.6;">'.$text.'</div>
                </div>';
            }

            $html = '<div class="soal-container mode-'.$mode.'" style="padding-bottom: 20px;">';
            
            // Tampilkan Instruksi di ATAS
            $html .= $instruksi_html;
            
            // Tampilkan Detail Soal
            $html .= '  <div class="soal-detail" style="margin-bottom: 25px; line-height: 1.6;">' . $soal_html . '</div>';

            if ($soal_data->soal_tipe == 1) {
                $query_jawaban = $CI->cbt_jawaban_model->get_by_kolom('jawaban_soal_id', $soal_id);
                if ($query_jawaban->num_rows() > 0) {
                    $labels = ['A', 'B', 'C', 'D', 'E'];
                    $idx = 0;
                    
                    $html .= '<div class="options-group" style="margin-top: 15px;">';
                    foreach ($query_jawaban->result() as $j) {
                        $jawaban_text = str_replace("[base_url]", base_url(), $j->jawaban_detail);
                        $label_txt = (isset($labels[$idx]) ? $labels[$idx].'. ' : '');
                        
                        $is_checked = ($old_jawab == $j->jawaban_id) ? 'checked' : '';
                        
                        // Handle potential string vs int difference safely
                        if (!$is_checked && !empty($old_jawab) && !is_array($old_jawab)) {
                            if (strval($old_jawab) === strval($j->jawaban_id)) {
                                $is_checked = 'checked';
                            }
                        }
                        
                        $active_class = $is_checked ? 'active' : '';
                        
                        $is_kunci_style = ($mode == 'admin' && $j->jawaban_benar == 1) ? 'border: 2px solid var(--accent-color); background: rgba(var(--primary-rgb), 0.05);' : '';
                        $kunci_tag = ($mode == 'admin' && $j->jawaban_benar == 1) ? ' <span class="label label-success" style="float: right;">KUNCI JAWABAN</span>' : '';

                        $html .= '<div class="opsi-checklist opsi-bulat-multi '.$active_class.'" style="'.$is_kunci_style.'">';
                        $html .= '  <div class="indicator-bulat"></div>';
                        $html .= '  <input type="radio" id="rad-'.$j->jawaban_id.'" name="soal-jawaban" value="'.$j->jawaban_id.'" '.$is_checked.' onchange="if(typeof jawab === \'function\') jawab();" style="display:none;"> ';
                        $html .= '  <label for="rad-'.$j->jawaban_id.'" style="cursor: pointer; width:100%; margin-left:10px; display: flex; align-items: flex-start;">';
                        $html .= '      <span style="font-weight: 700; margin-right: 8px; flex-shrink: 0; margin-top: -2px;">'.$label_txt.'</span>';
                        $html .= '      <div style="flex-grow: 1; word-break: break-word;">'.$jawaban_text.'</div>';
                        $html .=        $kunci_tag;
                        $html .= '  </label>';
                        $html .= '</div>';
                        $idx++;
                    }
                    $html .= '</div>';
                }
            } 
            // Essay (Tipe 2)
            else if ($soal_data->soal_tipe == 2) {
                $val = !empty($old_jawab) ? $old_jawab : '';
                $html .= '
                    <div class="essay-wrapper">
                        <textarea id="soal-jawaban" name="soal-jawaban" class="form-control essay-input" placeholder="Ketik jawaban lengkap Anda di sini..." '.($mode == 'admin' ? 'readonly' : '').'>'.$val.'</textarea>
                    </div>';
            } 
            // Jawaban Singkat (Tipe 3)
            else if ($soal_data->soal_tipe == 3) {
                $val = !empty($old_jawab) ? $old_jawab : '';
                $html .= '
                    <div class="short-answer-wrapper">
                        <input type="text" id="soal-jawaban" name="soal-jawaban" class="form-control short-answer-input" value="'.$val.'" maxlength="'.$kunci_length.'" autocomplete="off" placeholder="..." '.($mode == 'admin' ? 'readonly' : '').' />
                        '.($mode == 'siswa' ? '<div style="margin-top:20px;"><button type="button" onclick="jawab()" class="btn btn-primary btn-lg" style="border-radius:12px; padding:10px 30px;"><i class="fa fa-save"></i> Simpan Jawaban</button></div>' : '').'
                    </div>';
            } 
            // Menjodohkan (Tipe 4)
            else if ($soal_data->soal_tipe == 4) {
                $query_matching = $CI->cbt_soal_matching_model->get_by_kolom('matching_soal_id', $soal_id);
                if ($query_matching->num_rows() > 0) {
                    $matching_data = $query_matching->result();
                    $unique_id = 'matching-' . $soal_id . '-' . time();
                    
                    $answered_pairs = [];
                    if (!empty($old_jawab)) {
                        $decoded = json_decode($old_jawab, true);
                        if (is_array($decoded)) $answered_pairs = $decoded;
                    }

                    $html .= '<div class="matching-container-wrapper" id="'.$unique_id.'" style="position: relative; padding: 20px 0;">';
                    $html .= '  <div class="matching-grid-wrapper" style="position: relative; z-index: 2;">';
                    $html .= '    <div class="matching-column q-column">';
                    $html .= '      <div class="matching-header-label">SISI KIRI</div>';
                    foreach ($matching_data as $m) {
                        $check_kiri = trim(strip_tags(html_entity_decode($m->matching_kiri), '<img>'));
                        if (!empty($check_kiri)) {
                            $kiri_text = str_replace("[base_url]", base_url(), $m->matching_kiri);
                            $selected_val = isset($answered_pairs[$m->matching_id]) ? $answered_pairs[$m->matching_id] : '';
                            $html .= '<div class="matching-card q-item" data-match-id="'.$m->matching_id.'">
                                        '.$kiri_text.'
                                        <input type="hidden" name="soal-jawaban['.$m->matching_id.']" value="'.htmlspecialchars($selected_val).'" class="match-input">
                                      </div>';
                        }
                    }
                    $html .= '    </div>';

                    $html .= '    <div class="matching-column a-column">';
                    $html .= '      <div class="matching-header-label">SISI KANAN</div>';
                    
                    $kanan_list = [];
                    foreach($matching_data as $m) { 
                        $check_kanan = trim(strip_tags(html_entity_decode($m->matching_kanan), '<img>'));
                        if(!empty($check_kanan)) $kanan_list[] = $m; 
                    }
                    if($mode == 'siswa') shuffle($kanan_list);

                    foreach ($kanan_list as $m) {
                        $kanan_text = str_replace("[base_url]", base_url(), $m->matching_kanan);
                        $badge = ($mode == 'admin') ? '<span class="matching-badge">KUNCI</span>' : '';
                        $html .= '<div class="matching-card a-item" data-kanan-text="'.htmlspecialchars($m->matching_kanan).'">'.$badge.$kanan_text.'</div>';
                    }
                    $html .= '    </div>';
                    $html .= '  </div>';
                    $html .= '  <canvas class="matching-canvas" style="position: absolute; top:0; left:0; width:100%; height:100%; pointer-events: none; z-index: 1;"></canvas>';
                    $html .= '</div>';
                    
                    if($mode == 'admin') {
                        $html .= '<script>setTimeout(function(){ if(typeof drawMatchingLines === "function") drawMatchingLines("'.$unique_id.'"); }, 300);</script>';
                    } else {
                        $html .= '<script>setTimeout(function(){ if(typeof initInteractiveMatching === "function") initInteractiveMatching("'.$unique_id.'"); }, 300);</script>';
                    }
                }
            } 
            // Checklist (Tipe 5)
            else if ($soal_data->soal_tipe == 5) {
                $query_jawaban = $CI->cbt_jawaban_model->get_by_kolom('jawaban_soal_id', $soal_id);
                if ($query_jawaban->num_rows() > 0) {
                    $html .= '<div class="options-group" style="margin-top: 15px;">';
                    foreach ($query_jawaban->result() as $j) {
                        $jawaban_text = str_replace("[base_url]", base_url(), $j->jawaban_detail);
                        
                        $answered_arr = is_array($old_jawab) ? $old_jawab : (!empty($old_jawab) ? [$old_jawab] : []);
                        
                        // Robust comparison
                        $is_checked = '';
                        $current_id = strval($j->jawaban_id);
                        foreach($answered_arr as $ans_id) {
                            if (strval($ans_id) === $current_id) {
                                $is_checked = 'checked';
                                break;
                            }
                        }
                        
                        $active_class = $is_checked ? 'active' : '';

                        $is_kunci_style = ($mode == 'admin' && $j->jawaban_benar == 1) ? 'border: 2px solid var(--accent-color); background: rgba(var(--primary-rgb), 0.05);' : '';
                        $kunci_tag = ($mode == 'admin' && $j->jawaban_benar == 1) ? ' <span class="label label-success" style="float: right;">KUNCI</span>' : '';

                        $html .= '<div class="opsi-checklist opsi-bulat-multi '.$active_class.'" style="'.$is_kunci_style.'">';
                        $html .= '  <div class="indicator-bulat"></div>';
                        $html .= '  <input type="checkbox" id="chk-'.$j->jawaban_id.'" name="soal-jawaban[]" value="'.$j->jawaban_id.'" '.$is_checked.' onchange="if(typeof jawab === \'function\') jawab();" style="display:none;"> ';
                        $html .= '  <label for="chk-'.$j->jawaban_id.'" style="cursor: pointer; width:100%; margin-left: 10px;">'.$jawaban_text.$kunci_tag.'</label>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
            } 
            // Benar/Salah (Tipe 6)
            else if ($soal_data->soal_tipe == 6) {
                $query_jawaban = $CI->cbt_jawaban_model->get_by_kolom('jawaban_soal_id', $soal_id);
                if ($query_jawaban->num_rows() > 0) {
                    $html .= '<div class="options-group" style="margin-top: 15px;">';
                    foreach ($query_jawaban->result() as $j) {
                        $jawaban_text = str_replace("[base_url]", base_url(), $j->jawaban_detail);
                        
                        $is_checked = (strval($old_jawab) === strval($j->jawaban_id)) ? 'checked' : '';
                        $active_class = $is_checked ? 'active' : '';

                        $is_kunci_style = ($mode == 'admin' && $j->jawaban_benar == 1) ? 'border: 2px solid var(--accent-color); background: rgba(var(--primary-rgb), 0.05);' : '';
                        $kunci_tag = ($mode == 'admin' && $j->jawaban_benar == 1) ? ' <span class="label label-success" style="float: right;">BENAR</span>' : '';

                        $html .= '<div class="opsi-checklist opsi-bulat-multi '.$active_class.'" style="'.$is_kunci_style.'">';
                        $html .= '  <div class="indicator-bulat"></div>';
                        $html .= '  <input type="radio" id="bs-'.$j->jawaban_id.'" name="soal-jawaban" value="'.$j->jawaban_id.'" '.$is_checked.' onchange="if(typeof jawab === \'function\') jawab();" style="display:none;"> ';
                        $html .= '  <label for="bs-'.$j->jawaban_id.'" style="cursor: pointer; width:100%; margin-left: 10px;">'.$jawaban_text.$kunci_tag.'</label>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
            }

            $html .= '</div>';
            return $html;
        }
        return '<div class="alert alert-danger">Soal tidak ditemukan!</div>';
    }
}
