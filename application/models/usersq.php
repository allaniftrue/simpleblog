<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Usersq extends CI_Model {

	public function fetch_confirmed_user_profile($username) {
            $sql = $this->db->get_where('pre_users', array('username'=>$username,'confirmation'=> '1'));
            return $sql->result();
	}
        
        public function fetch_confirmed_user_profile_by_id($id) {
            $sql = $this->db->get_where('pre_users', array('id'=>$id,'confirmation'=> '1'));
            return $sql->result();
	}
        
        public function fetch_confirmed_user_profile_by_email($email) {
            $sql = $this->db->get_where('pre_users', array('email'=>$email,'confirmation'=> '1'));
            return $sql->result();
        }
        
        public function is_exist($email) {
            $this->db->where('email',$email);
            $this->db->where('confirmation','1');
//            $this->db->from('pre_users');
            return $this->db->count_all_results('pre_users');
        }
        
        public function generate_token($array) {
            $this->db->insert("pre_tokens", $array);
            return $this->db->affected_rows();
        }
        
        public function is_valid_token($token) {
            $sql = $this->db->query("
                                        SELECT a.*,b.email from pre_tokens a, pre_profile b
                                        WHERE 
                                        a.token=".$this->db->escape($token)." AND a.visited='0' AND a.date > DATE_SUB(NOW(),INTERVAL 24 HOUR) AND a.source='forgot' AND b.id=a.id
            ");        
            
            return $sql->num_rows();
        }
        
        public function fetch_user_picture($id) {
                $this->db->select('picture');
                $sql = $this->db->get_where('pre_users',array('id'=>$id));
                return $sql->result();
        }
        
        
}