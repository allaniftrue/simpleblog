<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library("Mlib_trac");
        $this->mlib_trac->trac_login();
        $this->load->library("pagination");
        
        $this->load->model("Postsq",'posts');
        
        $this->load->helper('date');
        $this->load->helper('string');
        $this->load->helper('text');
    }   
    
    public function index() {
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_page = $this->posts->user_total_posts();
        
        $config["uri_segment"] = 3;
        $config['base_url'] = base_url()."admin/posts/";
        $config['total_rows'] = $total_page;
        $config['per_page'] = 10; 
        $config['num_links'] = 20;
        $this->pagination->initialize($config);
        
        $data['posts'] = $this->posts->fetch_user_posts($this->session->userdata('uid'), $page, $config['per_page']);
        $this->load->view('admin/posts/posts_view', $data);
      
    }
    
    public function add_new() {
        $this->load->view('admin/posts/posts_new_view');
    }
    
    public function add() {
        
        $title= $this->input->post('title',TRUE);
        $blogentry= htmlspecialchars($this->input->post('blogentry',FALSE));
        $status = $this->posts->save_content($title,$blogentry);
        
        if($status['status'] === 1) {
            $this->output->set_output( 
                                    json_encode(array(
                                                        'status'    =>  1,
                                                        'message'    =>  "Content successfully saved"
            )));
        } else {
            $this->output->set_output( 
                                    json_encode(array(
                                                        'status'    =>  $status['status'],
                                                        'message'    =>  $status['msg']
            )));
        }
    }
    
    public function edit_post() {
        $total_seg = $this->uri->total_segments();
        $id = $this->uri->segment($total_seg);
        
        if(is_numeric($id)) {
            $result = $this->posts->fetch_post($id);
            $num_info = count($result);
            if($num_info > 0) {
                $data['info'] = $result;
                $this->load->view('admin/posts/posts_edit_view',$data);
            } else {
                show_404();
            }
        } else {
            show_404();
        } return;
    }
    
    public function edit() {
        $title= $this->input->post('title',TRUE);
        $blogentry= htmlspecialchars($this->input->post('blogentry',FALSE));
        $id = $this->input->post('id',TRUE);
        
        $status = $this->posts->update_content($id, $title, $blogentry);
        
        if($status['status'] === 1) {
            $this->output->set_output( 
                                    json_encode(array(
                                                        'message'    =>  $status['msg']
            )));
        } else {
            $this->output->set_output( 
                                    json_encode(array(
                                                        'message'    =>  $status['msg']
            )));
        } return;
    }
    
    public function delete() {
        $id = $this->input->post('id');
        
        if(is_numeric($id)) {
            if($this->posts->delete_post($id)) {
                $this->output->set_output( 
                        json_encode(array(
                                    'status'    =>  1
                )));
            } else {
                $this->output->set_output( 
                        json_encode(array(
                                    'status'    =>  0,
                                    'message'   =>  "Error while processing data, please send us a report to fix the problem"
                )));
            }
        } else {
            $this->output->set_output( 
                        json_encode(array(
                                    'status'    =>  0,
                                    'message'   =>  "Please properly select the post you want delete"
            )));
        } return;
    }
    
}