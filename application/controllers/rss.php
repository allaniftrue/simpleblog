<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model("Postsq", "posts");
        
        $this->load->helper('xml');
        $this->load->helper('date');
        $this->load->helper('text');
    }    
    
    public function index() {
        
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = COMPANY_NAME;
        $data['feed_url'] = base_url();
        $data['page_description'] = 'A simple feed';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = 'allanjosephcagadas@gmail.com';
        $data['posts'] = $this->posts->fetch_posts();    
        $this->output->set_header("Content-Type: application/rss+xml");
       
        $this->load->view('blog/rss_view', $data);
    }
}