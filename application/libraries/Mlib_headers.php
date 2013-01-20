<?php 
/*
Description: Library is used to un-cache the header.  Library  is usually used to prevent the previous page from being seen after logging out.
Usage: Load library on pages you don't want to be cached
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mlib_headers {

	public function __construct(){
		$this->clear_cache();
	}

    public function clear_cache(){
    	$ci =& get_instance();
    	$ci->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $ci->output->set_header("Pragma: no-cache");
    }

}