<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('date');
        $this->load->helper('text');
        $this->load->model("Postsq","posts");
        $this->load->library('user_agent');
        $this->load->library('form_validation');
    }    
    
    public function index() {
        
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $total_page = $this->posts->user_total_posts();
        
        $config["uri_segment"] = 2;
        $config['base_url'] = base_url()."blog/";
        $config['total_rows'] = $total_page;
        $config['per_page'] = 10; 
        $config['num_links'] = 20;
        $this->pagination->initialize($config);
        
        $data['posts'] = $this->posts->fetch_all_posts($page, $config['per_page']);
        
        $this->load->view('blog/blog_view', $data);
    }
    
    public function comment() {
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[5]|xss_clean');

        
        if($this->form_validation->run() == TRUE) {
            
            $name = strip_tags($this->input->post('name',TRUE));
            $comment = strip_tags($this->input->post('comment',TRUE));
            $id = strip_tags($this->input->post('id',TRUE));
            
            if($this->posts->add_comment($id,$name,$comment)) {
                redirect($this->agent->referrer()."#comment");
            } else {
                
            }
            
        } else {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer()."#comment");
        }
        
        
    }
    
}