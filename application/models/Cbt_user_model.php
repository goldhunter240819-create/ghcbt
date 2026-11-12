<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MHCBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Cbt_user_model extends CI_Model{
	public $table = 'cbt_user';
	
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
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function count_by_login($username){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('user_name', $username)
                 ->where('user_login', 1)
                 ->where('user_login_date = DATE(NOW())', NULL, FALSE)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom($kolom, $isi){
        $this->db->select('user_id,user_grup_id,user_name,user_password,user_email,user_firstname,user_birth_place,user_birth_date,user_address,user_foto,user_detail,user_regdate')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->select('user_id,user_grup_id,user_name,user_password,user_email,user_firstname,user_birth_place,user_birth_date,user_address,user_foto,user_detail,user_regdate')
                 ->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function count_by_username_password($username, $password){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('user_name', $username)
                 ->where('user_password', $password)
                 ->from($this->table);
        return $this->db->get()->row()->hasil;  
    }

    function get_by_username($username){
        $this->db->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
                 ->where('user_name',$username)
                 ->limit(1);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
	
	function get_datatable($start, $rows, $kolom, $isi, $group){
        if(!empty($isi)){
            $this->db->like($kolom, $isi);
        }
        if($group != 'semua'){
            $this->db->where('user_grup_id', $group);
        }
		$this->db->from($this->table)
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi, $group){
        $this->db->select('COUNT(*) AS hasil');
        if(!empty($isi)){
            $this->db->like($kolom, $isi);
        }
        if($group != 'semua'){
            $this->db->where('user_grup_id', $group);
        }
        $this->db->from($this->table);
        return $this->db->get();
	}
	
	function get_datatable_resetlogin($start, $rows, $kolom, $isi, $group){
        if(!empty($isi)){
            $this->db->like($kolom, $isi);
        }
        if($group != 'semua'){
            $this->db->where('user_grup_id', $group);
        }
		$this->db->from($this->table)
                 ->order_by('user_reset_request', 'DESC')
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_resetlogin_count($kolom, $isi, $group){
        $this->db->select('COUNT(*) AS hasil');
        if(!empty($isi)){
            $this->db->like($kolom, $isi);
        }
        if($group != 'semua'){
            $this->db->where('user_grup_id', $group);
        }
        $this->db->from($this->table);
        return $this->db->get();
	}
	
	/**
	* export data user yang belum mengerjakan
	*/
	function get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $modul_id = 'semua'){
        $sql = 'tesuser_id IS NULL';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
        if($modul_id != 'semua') {
            $sql .= ' AND tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = "'.$modul_id.'")';
        }
        if(count($tanggal)==2){
            $sql = $sql.' AND tes_begin_time BETWEEN "'.$tanggal[0].'" AND "'.$tanggal[1].'"';
        }
        $order = '';
        if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tes_begin_time DESC';
        }else{
            $order = 'tes_id ASC';
        }
		
		if(!empty($keterangan)){
			$sql = $sql.' AND user_detail LIKE "%'.$keterangan.'%"';
		}
				 
		$this->db->select('cbt_tes.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, "0" AS nilai, "Belum mengerjakan" AS tesuser_creation_time')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
				 ->order_by($order);
        return $this->db->get();
    }
	
	/**
	* datatable untuk hasil tes yang belum mengerjakan
	*
	*/
	function get_datatable_hasiltes($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id = 'semua'){
        $sql = 'tesuser_id IS NULL AND user_firstname LIKE "%'.$search.'%"';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
        if($modul_id != 'semua') {
            $sql .= ' AND tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = "'.$modul_id.'")';
        }
        if(count($tanggal)==2){
            $sql = $sql.' AND tes_begin_time BETWEEN "'.$tanggal[0].'" AND "'.$tanggal[1].'"';
        }
        $order = '';
        if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tes_begin_time DESC';
        }else{
            $order = 'tes_id ASC';
        }
		
		if(!empty($keterangan)){
			$sql = $sql.' AND user_detail LIKE "%'.$keterangan.'%"';
		}

		$this->db->select('cbt_tes.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, "0" AS nilai')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
				 ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_hasiltes_count($tes_id, $grup_id, $urutkan, $tanggal, $keterangan, $search, $modul_id = 'semua'){
        $sql = 'tesuser_id IS NULL AND user_firstname LIKE "%'.$search.'%"';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
        if($modul_id != 'semua') {
            $sql .= ' AND tes_id IN (SELECT DISTINCT tset_tes_id FROM cbt_tes_topik_set JOIN cbt_topik ON tset_topik_id = topik_id WHERE topik_modul_id = "'.$modul_id.'")';
        }
        if(count($tanggal)==2){
            $sql = $sql.' AND tes_begin_time BETWEEN "'.$tanggal[0].'" AND "'.$tanggal[1].'"';
        }
		
		if(!empty($keterangan)){
			$sql = $sql.' AND user_detail LIKE "%'.$keterangan.'%"';
		}

		$this->db->select('COUNT(*) AS hasil')
                 ->where('( '.$sql.' )')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
                 ->from($this->table);
        return $this->db->get();
	}
}