<?php $this->load->view("admin/header_view"); ?>
<?php $this->load->view("admin/top_menu/top_nav_view"); ?>
<?php
    $atts = array(
                    'width'      => '600',
                    'height'     => '700',
                    'scrollbars' => 'yes',
                    'status'     => 'yes',
                    'resizable'  => 'no',
                    'screenx'    => '0',
                    'screeny'    => '0'
                  );

?>
<div class="container-fluid">
  <div class="row-fluid">
    <?php $this->load->view("admin/sidebar/sidebar_profile_view"); ?>
    <div class="span9">
      <div class="main">
        <div class="row-fluid">
          
          <h2>Change Password</h2>
          <form method="POST" action="" id="accountform">
            <p>
              <label for="oldpassword"  class="required"><strong>Old Password </strong></label>
              <input type="password" class="input input-large span5" id="oldpassword" name="oldpassword" />
            </p>

            <p>
              <label for="newpassword" class="required"><strong>New Password <?=anchor_popup('https://accounts.google.com/PasswordHelp', '<i class="icon-question-sign" id="tooltip-right" title="Password Guidelines"></i>', $atts)?></strong></label>
              <input type="password" class="input input-large span5" id="newpassword" name="newpassword" title="At least 8 characters long" />
            </p>
            <p>
              <label for="newpassword_c" class="required"><strong>Confirm New Password </strong></label>
              <input type="password" class="input input-large span5" id="newpassword_c" name="newpassword_c" />
            </p>
            <p>
              <button class="btn" type="submit" id="updatepassword">Update Password</button> &nbsp;&nbsp; <a href="">I forgot my password</a>
            </p> 
          </form>
        </div><!--/row-->
      </div><!--/main-->
    </div><!--/span-->
  </div><!--/row-->
</div><!--/.fluid-container-->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel">Result</h3>
</div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button></div></div>
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/account.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.min.js"></script>
<?php $this->load->view("admin/footer_view"); ?>