<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_soal_matching_model extends CI_Model{
	public $table = 'cbt_soal_matching';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }
    
    function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_datatable($start, $rows, $kolom, $isi, $soal_id){
		if(!empty($isi)){
			$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND matching_soal_id="'.$soal_id.'")');
		}else{
			$this->db->where('matching_soal_id', $soal_id);
		}
        $this->db->from($this->table)
				 ->order_by('matching_id', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}

    function get_datatable_count($kolom, $isi, $soal_id){
		$this->db->select('COUNT(*) AS hasil');
		if(!empty($isi)){
			$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND matching_soal_id="'.$soal_id.'")');
		}else{
			$this->db->where('matching_soal_id', $soal_id);
		}
        $this->db->from($this->table);
        return $this->db->get();
	}
}
