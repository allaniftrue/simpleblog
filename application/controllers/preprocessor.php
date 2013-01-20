<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Preprocessor extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Postsq","posts");
        $this->load->helper('date');
    }    
    
    public function index() {
        
        $segment = $this->uri->segment(1);
        $segment = $this->security->xss_clean($segment);
        
        $data['posts'] = $this->posts->fetch_post_by_url($segment);
        $exist = count($data['posts']['post']);
        
        if($exist > 0) {
            $this->load->view('blog/single_view', $data);
        } else {
            show_404();
        }
    }
}