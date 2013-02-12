<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title>Administration Panel</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" />
	    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.css" />
	    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap-responsive.min.css" />
	    <link rel="stylesheet" href="<?=base_url()?>css/global.css" />
        
            <script type="text/javascript">var base_url = <?=base_url()?></script>
	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
            <div class="container">
                <form method="post" action="<?=base_url()?>admin/forgot/resend" class="form-signin">
                    <h2 class="form-signin-heading">Forgot Password</h2><br />
                    <input type="hidden" name="csrf_name" value="<?=$hash?>" />
                    <input type="text" name="email" class="input input-medium input-block-level" value="" placeholder="Email Address" />
                    <input type="submit" value="Submit" name="submit" class="btn btn-medium" id="submit" data-loading-text="Processing..." /> &nbsp;&nbsp;<?php if($this->session->userdata('is_login') != TRUE){ ?><a href="<?php echo base_url(); ?>admin">Login</a> <?php } ?>
                    
                    <?php
                    
                        $status = $this->session->flashdata("status");
                        $message = $this->session->flashdata("message");
                        
                        if(is_numeric($status) && ! empty($message)): 
                            if($status == 0) { 
                    ?>
                            <br /><br />
                            <div class="alert alert-error">
                                <i class="icon-exclamation-sign"></i> <?=$message?>
                            </div>
                    <?php
                            } else { 
                    ?>
                            <br /><br />
                            <div class="alert alert-success">
                                <i class="icon-ok"></i> <?=$message?>
                            </div>
                    <?php      
                            }
                        endif;
                    ?>
                </form>
            </div>
            <script src="<?=base_url()?>js/jquery.js"></script>
            <script src="<?=base_url()?>js/bootstrap-button.js"></script>
            <script>
                $(document).ready(function(){ $('#submit').click(function(){$('#submit').button('loading')}) })
            </script>
	</body>
</html>