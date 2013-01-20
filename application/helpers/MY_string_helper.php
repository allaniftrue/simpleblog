<?php
if ( ! function_exists('sanitize_title')) {
    function sanitize_title($str) {
        
        $ci =& get_instance();
        
        $ci->load->helper("string");
        $str = reduce_multiples(preg_replace("/[^A-Za-z0-9 ]/", " ", $str)," ");
        return strtolower(str_replace(" ", "-", $str));
    }
}
?>