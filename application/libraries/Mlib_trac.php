<?php 
/*
Description: Library is used to un-cache the header.  Library  is usually used to prevent the previous page from being seen after logging out.
Usage: Load library on pages you don't want to be cached
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mlib_trac {

    public function trac_login(){
    	$ci =& get_instance();
    	$is_login = $ci->session->userdata("is_login");

    	if($is_login != TRUE) {
    		redirect(base_url(),"refresh");
    	}
    }

}