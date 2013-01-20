<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
Class Postsq extends CI_Model{
    
    public function fetch_user_posts($uid="",$offset=1, $limit=10) {
        
        if(! empty($uid) && is_numeric($uid)) {
            
            $query = $this->db->query("
                                        SELECT a.username, b.*, COUNT(c.comment) as comment_sum
                                        FROM pre_users a, pre_posts b LEFT JOIN pre_comments c ON b.id=c.post_id
                                        WHERE a.id=b.author AND b.author=$uid 
                                        GROUP BY b.id ORDER BY b.entry_date DESC
                                        LIMIT $limit OFFSET $offset
                                       
           ");
            return $query->result();
            
        } else  {
            return FALSE;
        }
    }
    
    public function fetch_all_posts($offset=1, $limit=10) {
        
            $query = $this->db->query("
                                        SELECT a.username, b.*, COUNT(c.comment) as comment_sum
                                        FROM pre_users a, pre_posts b LEFT JOIN pre_comments c ON b.id=c.post_id
                                        WHERE a.id=b.author
                                        GROUP BY b.id ORDER BY b.entry_date DESC
                                        LIMIT $limit OFFSET $offset
                                       
           ");
            return $query->result();
    }
    
    private function fetch_post_comment($id) {
        $this->db->order_by('comment_date','DESC');
        $query = $this->db->get_where('pre_comments',array('post_id'=>$id));
        
        return $query->result();
    }
    
    public function fetch_post_by_url($url) {
            $stk = array();
            $query = $this->db->query("
                                        SELECT a.username, b.*, COUNT(c.comment) as comment_sum
                                        FROM pre_users a, pre_posts b LEFT JOIN pre_comments c ON b.id=c.post_id
                                        WHERE a.id=b.author AND b.url=".$this->db->escape($url)."
                                        GROUP BY b.id ORDER BY b.entry_date DESC
                                       
           ");
            $stk['post'] = $result = $query->result();
            if(! empty($result[0]->id)){
                $stk['blog_comments'] = $this->fetch_post_comment($result[0]->id);
            }
            
            return $stk;
            
    }
    
    public function user_total_posts($uid="") {
        $this->db->where('author',$uid);
        return $this->db->count_all('pre_posts');
    }
    
    public function delete_post($id="") {
        
        $this->db->query("DELETE t1,t2 FROM pre_posts AS t1 LEFT JOIN pre_comments AS t2 ON t1.id=t2.post_id WHERE t1.id=$id");
        $aff_rows = $this->db->affected_rows();
        
        if($aff_rows > 0) {
            return TRUE;
        } return FALSE;
    }
    
    public function save_content($title,$content) {
            /*
             * Status: 0(FALSE) - 1(TRUE)
             */
            $title = reduce_multiples(strtolower($title)," ");
            
            $this->db->where('title', $title);
            $num_check = $this->db->count_all_results('pre_posts');
            
            if($num_check === 0) {
                
                $data = array(
                            'title'         =>  $title,
                            'post'          =>  $content,
                            'author'        =>  $this->session->userdata('uid'),
                            'entry_date'    =>  mdate("%Y-%m-%d %H:%i:%s", time()),
                            'url'           =>  sanitize_title($title)
                );

                $this->db->insert('pre_posts', $data);
                $aff_rows = $this->db->affected_rows();
                
                if($aff_rows > 0) {
                    return array('status' => 1, 'msg' => "Blog post successfully saved");
                }else {
                    return array('status' => 0, 'msg' => "Unable to add post");
                }
                
            } else {
                return array('status' => 0, 'msg' => "Title is already in use, please enter a unique title");
            }
    }
    
    public function fetch_post($id) {
        $sql = $this->db->get_where('pre_posts',array('id'=>$id));
        return $sql->result();
        
    }
    
    public function update_content($id, $title, $content) {
        
        $title = reduce_multiples(strtolower($title)," ");
        
        $this->db->where('title',$title);
        $this->db->where('id !=',$id);
        $num_check = $this->db->count_all_results('pre_posts');
        
        if($num_check === 0) {
            
            $data = array(
                        'title'         =>  $title,
                        'post'          =>  $content,
                        'entry_date'    =>  mdate("%Y-%m-%d %H:%i:%s", time()),
                        'url'           =>  sanitize_title($title)
            );

            $this->db->where('id',$id);
            $this->db->update('pre_posts', $data);
            $aff_rows = $this->db->affected_rows();

            if($aff_rows > 0) {
                return array('status' => 1, 'msg' => "Blog post successfully updated");
            }else {
                return array('status' => 0, 'msg' => "Unable to add post");
            }
            
        } else {
            return array('status' => 0, 'msg' => "Title is already in use, please enter a unique title");
        }
    }
    
    public function add_comment($id,$name,$comment) {
        $array = array(
                        "name"          =>  $name,
                        "post_id"       =>  $id,
                        "comment"       =>  $comment,
                        "comment_date"  =>  mdate("%Y-%m-%d %H:%i:%s", time())
        );
        $this->db->insert("pre_comments",$array);
        $aff_rows = $this->db->affected_rows();
        
        if($aff_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function fetch_posts() {
        $this->db->order_by('entry_date', 'DESC');
        $query = $this->db->get("pre_posts");
        
        return $query->result();
    }
    
    public function search_all_posts($keyword, $offset=1, $limit=10) {
        
            $query = $this->db->query("
                                        SELECT a.username, b.*, COUNT(c.comment) as comment_sum
                                        FROM pre_users a, pre_posts b LEFT JOIN pre_comments c ON b.id=c.post_id
                                        WHERE a.id=b.author AND (b.title like '%$keyword%' OR b.post like '%$keyword%' OR c.comment like '%$keyword%')
                                        GROUP BY b.id ORDER BY b.entry_date DESC
                                        LIMIT $limit OFFSET $offset
                                       
           ");
            return $query->result();
    }
}