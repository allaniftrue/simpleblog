<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgot extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("Usersq","uq");
        $this->load->library('email');
    }
    
    public function index() {
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
        $this->load->view("admin/forgot_view",$data);
    }
    
    public function resend() {
        
        $this->load->library('email');
        
        $csrf_val = $this->input->post('csrf_name');
        $csrf_session = $this->session->userdata('hash_value');
        $email = $this->input->post('email');
        
        if($csrf_val === $csrf_session && ! empty($email)) {
            if($this->uq->is_exist($email) >= 1) {
                
                $token = md5(uniqid(rand(), true));
                $content = file_get_contents(FCPATH.'templates/forgot.txt');
                $confirmation_link = base_url().'forgot/confirm/'.$token;
                $mailed = FALSE;
                
                $result = $this->uq->fetch_confirmed_user_profile_by_email($email);
                $array = array(
                                "id"        =>  $result[0]->id,
                                "token"     =>  $token,
                                "date"      =>  date('Y-m-d H:i:s'),
                                "source"    =>  "forgot"  
                );
                
                $aff_rows = $this->uq->generate_token($array);

                if($aff_rows >= 1) { 
                    $content = str_replace("##USERNAME##", $result[0]->username, $content);
                    $content = str_replace("##HOST##", base_host(), $content);
                    $content = str_replace("##CONFIRM_LINK##", $confirmation_link, $content);
                                       
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $this->email->from('no-reply@'.base_host(), base_host()); 
                    $this->email->to($result[0]->email); 
                    $this->email->subject('Password Recovery');
                    $this->email->message($content);	
                    
                    if($this->email->send()) {
                        $array = array('status'=>1,'message'=>"Please check your email");
                        $this->session->set_flashdata($array);
                    } else {
                        $array = array('status'=>0,'message'=>"Failed to send the password confirmation link");
                        $this->session->set_flashdata($array);
                    }
                    
                } else {
                    
                    $array = array('status'=>0,'message'=>"Failed to send the password confirmation link");
                    $this->session->set_flashdata($array);
                }
                
            } else { 
                $array = array('status'=>0,'message'=>"Email does not exist / Un-confirmed");
                $this->session->set_flashdata($array);
            }
            
        } else {
            $array = array('status'=>0,'message'=>"Invalid session");
            $this->session->set_flashdata($array);
        }
        redirect(base_url()."admin/forgot","location");
    }
    
    public function confirm() {
        
        $token = $this->uri->segment(3);

        if(! empty($token)) {
            
            if($this->uq->is_valid_token($token) === 1) {
                
                $this->load->library("Mlib_sec");
                
                $result = $sql->result();
                $password = uniqid();
                $hash = $this->mlib_sec->create_hash($password);
                
                $hash_parts = explode(":", $hash);
                
                $array = array(
                                "password"  =>  $hash_parts[3],
                                "salt"      =>  $hash_parts[2]
                );
                
                $this->db->where('id', $result[0]->id);
                $this->db->update('pre_users', $array);
                $aff_rows = $this->db->affected_rows();
                
                if($aff_rows === 1) {
                    
                    $this->load->library("email");
                    
                    $array = array(
                                "visited"  =>  '1',
                    );

                    $this->db->where('uid', $result[0]->uid);
                    $this->db->update('pre_tokens', $array);
                    $aff_rows = $this->db->affected_rows();
                    
                    if($aff_rows === 1) {
                        
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);

                        $this->email->from('no-reply@'.base_host(), base_host()); 
                        $this->email->to($result[0]->email); 
                        $this->email->subject('New Password');
                        $this->email->message("New password: ".$password);

                        if($this->email->send()) {
                            $array = array('status'=>1,'message'=>"New password sent");
                            $this->session->set_userdata($array);
                        } else {
                            $array = array('status'=>0,'message'=>"Failed to send the new password");
                            $this->session->set_userdata($array);
                        }
                        
                    } else {
                        
                        $array = array('status'=>0,'message'=>"Error updating confirmation");
                        $this->session->set_userdata($array);
                        
                    }
                    
                    redirect(base_url(),"location");
                    
                } else {
                    
                    $array = array('status'=>0,'message'=>"Failed to reset password");
                    $this->session->set_userdata($array);
                    redirect(base_url()."forgot","location");
                }
                
                
            } else {
                
                $array = array(
                                'status'    =>  0,
                                'message'   =>  "Invalid/Expired link"
                );
                $this->session->set_userdata($array);
                
                redirect(base_url()."forgot","location");
            }
            
        } else {
            
            $array = array('status'=>0,'message'=>"Direct access forbidden");
            $this->session->set_userdata($array);
            
            redirect(base_url()."admin/forgot","location");
        }
    }
    
    /*TODO
     * Create resend confirmation link 
     */
}

