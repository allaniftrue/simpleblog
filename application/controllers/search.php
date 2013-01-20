<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Postsq","posts");
        
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->helper('text');
    }    
    
    public function index() {
        
        $referrer = $this->agent->referrer();
        $keyword = trim($this->input->post('keyword',TRUE));
        
        if(empty($keyword)) {
            redirect($referrer);
        }
        $this->session->set_userdata("keyword",$keyword);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_page = $this->posts->user_total_posts();
        
        $config["uri_segment"] = 2;
        $config['base_url'] = base_url()."search/";
        $config['total_rows'] = $total_page;
        $config['per_page'] = 10; 
        $config['num_links'] = 20;
        $this->pagination->initialize($config);
        
        $data['posts'] = $this->posts->search_all_posts($this->session->userdata('keyword'),$page, $config['per_page']);
        $this->load->view("blog/search_view",$data);
    }
}