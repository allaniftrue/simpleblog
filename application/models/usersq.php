<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Usersq extends CI_Model {

	public function fetch_confirmed_user_profile($username) {
            
            $sql = $this->db->get_where('pre_users', array('username'=>$username,'confirmation'=> '1'));
            return $sql->result();
            
	}
}