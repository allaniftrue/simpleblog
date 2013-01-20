<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
                $this->load->model("Usersq","uq");
	}

	public function auth() {
		
		$this->load->library('Mlib_sec');

		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$csrf_val = $this->input->post('csrf_name',TRUE);
		$csrf_session = $this->session->userdata('hash_value');

		if($csrf_session === $csrf_val) {
                    
                        $result = $this->uq->fetch_confirmed_user_profile($username);
                        $num_res = count($result);
                        
			if($num_res === 1) {
                                
				$format = PBKDF2_HASH_ALGORITHM.":".PBKDF2_ITERATIONS.":".$result[0]->salt.":".$result[0]->password;
				$is_valid = $this->mlib_sec->validate_password($password,$format);
				
				if($is_valid === TRUE) {

					$array = array(
                                                        'uid'       =>  $result[0]->id,
                                                        'username'  =>  $username,
                                                        'is_login'  =>  TRUE
					);
                                        
					$this->session->set_userdata($array);
					redirect(base_url()."admin/dashboard");
                                        
				} else {
                                    #show error invalid username/password
                                    $array = array(
                                                    'message'   =>  'Invalid username/password',
                                                    'status'    =>  0
                                    );
                                    $this->session->set_userdata($array);
                                    redirect(base_url().'admin/');
				}

			} else {
				#show error invalid username/password
                                $array = array(
                                                'message'   =>  'Invalid username/password',
                                                'status'    =>  'Error'
                                );
                                $this->session->set_userdata($array);
                                redirect(base_url().'admin/','redirect');
                                
			}
			
			$this->session->unset_userdata('hash_value');

		} else {
			redirect(base_url().'admin/','redirect');
		}

	}
}