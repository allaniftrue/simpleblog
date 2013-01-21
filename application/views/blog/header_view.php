<?php
    $title = $this->uri->segment(1);
    $title = ucwords(str_replace("-", " ", $title));
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title><?php if(!empty($title)) echo ucwords($title); else echo COMPANY_NAME;?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
	    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css" />
	    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
	    <link rel="stylesheet" href="<?php echo base_url();?>css/blog.css" />
	</head>
	<body>
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <div class="nav-collapse collapse">
                        <ul class="nav">
                          <li class="">
                            <a href="<?php echo base_url();?>">Home</a>
                          </li>
                          <li class="">
                            <a href="#">About Us</a>
                          </li>
                          <li class="">
                            <a href="#">Contact Us</a>
                          </li>

                        </ul>
                      </div>
                  </div>
            </div>
            <div class="container">