<?php
function base_host()
{
    $url =  parse_url(base_url());
    return $url['host'];
}