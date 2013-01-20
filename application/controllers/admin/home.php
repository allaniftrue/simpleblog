<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('string');
	}

	public function index(){
            
                if($this->session->userdata('is_login') === TRUE) {
                    redirect(base_url().'admin/dashboard'); 
                }

		$data['unique_name'] = uniqid(); 
		$csrf_session = $this->session->userdata('hash_value');
		$hash = ! empty($csrf_session) ? $csrf_session : random_string('alnum', 64);
		
		if(empty($csrf_session)) {
			$array = array(
                                        'hash_value'=>$hash
			);
			
			$this->session->set_userdata($array);
		}

		$data['hash'] = $this->session->userdata('hash_value');
		$this->load->view('admin/home_view',$data);
	}
}