<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MHCBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Cbt_topik_model extends CI_Model{
	public $table = 'cbt_topik';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
    }
    
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }

    function count_all(){
        $this->db->select('COUNT(*) AS hasil')
                 ->from($this->table);
        return $this->db->get();
    }
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_topik_modul($topik, $modul){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('(topik_modul_id='.$modul.' AND topik_nama="'.$topik.'")')
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_nama_grup_modul($topik, $grup, $modul, $exclude_id = null){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('topik_nama', $topik)
                 ->where('topik_grup_id', $grup)
                 ->where('topik_modul_id', $modul);
        if(!empty($exclude_id)){
            $this->db->where('topik_id !=', $exclude_id);
        }
        $this->db->from($this->table);
        return $this->db->get();
    }

    function count_by_nama_modul($topik, $modul, $exclude_id = null){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('topik_nama', $topik)
                 ->where('topik_modul_id', $modul);
        if(!empty($exclude_id)){
            $this->db->where('topik_id !=', $exclude_id);
        }
        $this->db->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function get_by_kolom_join_modul($kolom, $isi){
        $this->db->select('cbt_topik.*, cbt_modul.*')
                 ->join('cbt_modul', 'cbt_topik.topik_modul_id = cbt_modul.modul_id')
                 ->from($this->table)
                 ->where($kolom, $isi);
        return $this->db->get();
    }

    function get_all(){
        $this->db->from($this->table)
                 ->order_by('topik_id', 'ASC');
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $kolom, $isi, $modul){
		$this->db->select('cbt_topik.*, g.grup_nama, (SELECT COUNT(*) FROM cbt_soal WHERE soal_topik_id = cbt_topik.topik_id) AS jml_soal')
                 ->from($this->table)
                 ->join('cbt_user_grup g', 'cbt_topik.topik_grup_id = g.grup_id', 'left')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND topik_modul_id='.$modul.')')
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi, $modul){
		$this->db->select('COUNT(*) AS hasil')
                 ->from($this->table)
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND topik_modul_id='.$modul.')');
        return $this->db->get();
	}
}