<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{	
	function __construct(){
		parent::__construct();
	}
    
    function save($data){
        $this->db->insert('user', $data);
    }
    
    function delete($username){
        $this->db->where('username', $username)
                 ->delete('user');
    }
    
    function update($data, $username){
        $this->db->where('username', $username)
                 ->update('user', $data);
    }
    
    function get_user_by_id($id){
        $this->db->where('id', $id)
                 ->from('user')
                 ->limit(1);
        return $this->db->get();
    }
	
	function get_tanggal(){
        $this->db->select('NOW() AS tanggal');
        return $this->db->get();
    }

    function get_user_by_username($username){
        $this->db->where('username', $username)
                 ->from('user')
                 ->limit(1);
        return $this->db->get();
    }
	
	function get_login_info($username){
		$this->db->where('username',$username);
		$this->db->limit(1);
		$query = $this->db->get('user');
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
    
    /**
     * Change Password
     * 
     */ 
    function change_password($username, $password){
        $this->db->where('username', $username);
        $this->db->update('user', array('password' => password_hash($password, PASSWORD_BCRYPT)));
	}
    
    function get_user_count($username, $password){
        $user = $this->get_login_info($username);
        if(!$user) return 0;
        if(password_verify($password, $user->password) || sha1($password) === $user->password){
            return 1;
        }
        return 0;	
	}
    
    function get_user_count_by_level($level){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('level', $level)
                 ->from('user');
        return $this->db->get();
    }
    
    /*
	 * mendapatkan hak akses suatu menu
	 */
	function cek_akses($kode_menu, $level){
		if($level == 'developer') return 1;
		$sql='SELECT COUNT(*) AS hasil FROM user_akses WHERE user_akses.kode_menu="'.$kode_menu.'" AND user_akses.level="'.$level.'"';
		$hasil=$this->db->query($sql)->row()->hasil;

		return $hasil;
	}
    
    /*
	 * mendapatkan hak akses crud menu
	 */
	function cek_akses_crud($kode_menu, $level, $tipe){
		if($level == 'developer') return 1;
        if($tipe==0){
            $sql='SELECT COUNT(*) AS hasil FROM user_akses WHERE user_akses.kode_menu="'.$kode_menu.'" AND user_akses.level="'.$level.'" AND user_akses.add=1';
        }else{
            $sql='SELECT COUNT(*) AS hasil FROM user_akses WHERE user_akses.kode_menu="'.$kode_menu.'" AND user_akses.level="'.$level.'" AND user_akses.edit=1';
        }
		$hasil=$this->db->query($sql)->row()->hasil;

		return $hasil;
	}
    
    function get_all_user($start, $rows, $search){
        $this->db->where('(username LIKE "%'.$search.'%" OR nama LIKE "%'.$search.'%")')
                 ->from('user')
                 ->limit($rows, $start);    
        
        return $this->db->get();
    }
    
    function get_all_user_count($search){
        $this->db->select('COUNT(*) AS hasil')
                 ->like('user.username', $search)
                 ->or_like('user.nama', $search)
                 ->from('user');
        return $this->db->get();
    }
    
    function get_parent_menu($child_menu){
        $sql = 'SELECT `user_menu`.`parent` FROM user_menu WHERE `user_menu`.`kode_menu`="'.$child_menu.'"';
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            $hasil = $query->row()->parent;
        }else{
            $hasil = 'KOSONG';
        }
        return $hasil;
        
    }
    
    function get_menu_detail($kode_menu){
        $sql = 'SELECT `user_menu`.* FROM user_menu WHERE `user_menu`.`kode_menu`="'.$kode_menu.'" LIMIT 1';
        return $this->db->query($sql);
    }
    
    /**
     * Mendapatkan menu dashboard secara dynamic 
     */ 
    function get_menu($kode_menu, $level){
        if($level == 'developer' && defined('GHCBT_DEV_SUITE') && GHCBT_DEV_SUITE === true){
            // Khusus Developer: Buat menu flat (tanpa dropdown) sesuai permintaan user
            $sql = 'SELECT user_menu.* FROM `user_akses` 
                INNER JOIN `user_menu` ON (`user_akses`.`kode_menu` = `user_menu`.`kode_menu`) 
                WHERE user_akses.`level`="'.$level.'"
                AND user_menu.kode_menu != "tool-update"
                ORDER BY user_menu.urutan ASC';
            
            $result=$this->db->query($sql);
            $menu = '';
            if($result->num_rows()>0){
                foreach ($result->result() as $temp){
                    // Zenith Shield: Hide non-functional menus by partial name matching
                    if(strpos($temp->nama_menu, 'Berita Acara') !== false || strpos($temp->nama_menu, 'Laporan Pelaksanaan') !== false || strpos($temp->nama_menu, 'Daftar Hadir') !== false || $temp->nama_menu == 'Jadwal Ujian') continue;
                    $active = ($kode_menu == $temp->kode_menu) ? 'active' : '';
                    $icon_db = !empty($temp->icon) ? $temp->icon : 'fa fa-cube'; // Fallback icon
                    $icon = '<i class="'.$icon_db.'"></i> ';
                    
                    $menu .= '<li class="'.$active.'">
                        <a href="'.site_url().'/'.$temp->url.'">
                            '.$icon.'
                            <span>'.$temp->nama_menu.'</span>
                        </a>
                    </li>';
                }
            }
            return $menu;
        }

        // Logic Standar untuk level selain developer (menggunakan dropdown/treeview)
        $sql = 'SELECT DISTINCT parent_menu.* 
                FROM `user_menu` AS parent_menu
                INNER JOIN `user_menu` AS child_menu ON (child_menu.parent = parent_menu.kode_menu OR parent_menu.kode_menu = child_menu.kode_menu)
                INNER JOIN `user_akses` ON (`user_akses`.`kode_menu` = child_menu.kode_menu)
                WHERE user_akses.`level` = ?
                  AND parent_menu.`tipe` = 0
                  AND parent_menu.kode_menu != "tool-update"
                ORDER BY parent_menu.`urutan` ASC';

        $result = $this->db->query($sql, array($level));
        $parent_kode_menu = $this->get_parent_menu($kode_menu);
        
        $menu = '';
        
        if($result->num_rows() > 0){
            foreach ($result->result() as $parent){
                $parent_active = '';
                if($parent->kode_menu == $parent_kode_menu){
                    $parent_active = ' active ';
                }
                
                $sql_child = 'SELECT user_menu.* FROM `user_akses` 
                    INNER JOIN `user_level` ON (`user_akses`.`level` = `user_level`.`level`) 
                    INNER JOIN `user_menu` ON (`user_akses`.`kode_menu` = `user_menu`.`kode_menu`) 
                    WHERE user_akses.`level` = ? 
                    AND user_menu.`tipe` = 1 
                    AND user_menu.parent = ? 
                    ORDER BY user_menu.`urutan` ASC';
                $result_child = $this->db->query($sql_child, array($level, $parent->kode_menu));
                
                $menu_child = '';
                $menu_child_count = 0;
                if($result_child->num_rows() > 0){
                    $menu_child .= '<ul class="treeview-menu">';
                    foreach ($result_child->result() as $child){
                        $child_active = '';
                        if($kode_menu == $child->kode_menu){
                            $child_active = 'active';
                        }
                        $icon_db_child = !empty($child->icon) ? $child->icon : 'fa fa-circle-o'; // Fallback circle
                        $icon_child = '<i class="'.$icon_db_child.'"></i> ';
                        
                        $menu_child .= '<li class="'.$child_active.'"><a href="'.site_url().'/'.$child->url.'">'.$icon_child.$child->nama_menu.'</a></li>';
                        $menu_child_count++;
                    }
                    $menu_child .= '</ul>';
                }
                
                $parent_icon = !empty($parent->icon) ? $parent->icon : 'fa fa-folder';
                $menu .= '<li class="treeview '.$parent_active.'">
                    <a href="'.site_url().'/'.$parent->url.'">
                        <i class="'.$parent_icon.'"></i>
                        <span>'.$parent->nama_menu.'</span>';
                if($menu_child_count > 0){
                    $menu .= '<i class="fa fa-angle-left pull-right"></i>';
                }
                
                $menu .= '</a>';
                $menu .= $menu_child;
                $menu .= '</li>';
            }
        }
        
        return $menu;
    }
}