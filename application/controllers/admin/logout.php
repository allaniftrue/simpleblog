<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Logout extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library("Mlib_headers");
    }
    
    public function index() {
        
        $array = array(
                'uid'=>'',
                'usertype'=>'',
                'is_login'=>FALSE,
                'email'=>''
        );

        $this->session->unset_userdata($array);
        
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect(base_url(),'refresh');
    }
}