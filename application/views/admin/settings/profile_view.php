<?php $this->load->view("admin/header_view"); ?>
<?php $this->load->view("admin/top_menu/top_nav_view"); ?>
<div class="container-fluid">
  <div class="row-fluid">
    <?php $this->load->view("admin/sidebar/sidebar_profile_view"); ?>
    <div class="span9">
      <div class="main">
        <div class="row-fluid">
          
          <h2>Public Profile</h2>
          <form method="POST" action="" id="profileform">
            <p>
              <label for="avatar"><strong>Avatar</strong></label>
              <div clas="" id="avatar-holder" data-original-title="Click to change avatar.  Size is 160x160">
                <div id="uploader"><center><i class="icon-upload icon-white"></i> File Select</center></div>
                <?php $img = ! empty($profile[0]->picture) ? $profile[0]->picture : "default.gif"; ?>
                <img src="<?=base_url()?>profile/<?=$img?>" class="img-polaroid" />
              </div> 
              <div id="messages"></div>
              <br />
            </p>
            <p>
              <label for="lastname"  class="required"><strong>Last Name </strong></label>
              <input type="text" class="input input-large span5" id="lastname" name="lastname" value="<?=$profile[0]->lastname ? $profile[0]->lastname : ''?>" />
            </p>

            <p>
              <label for="firstname" class="required"><strong>First Name </strong></label>
              <input type="text" class="input input-large span5" id="firstname" name="firstname" value="<?=$profile[0]->firstname ? $profile[0]->firstname : ''?>" />
            </p>

            <p>
              <label for="email" class="required"><strong>Email </strong></label>
              <input type="text" class="input input-large span5" id="email" name="email" value="<?=$profile[0]->email ? $profile[0]->email : ''?>" />
            </p>
            
            <p>
              <label for="contact" class="required"><strong>Contact Number </strong></label>
              <input type="text" class="input input-large span5" id="contact" name="contact" title="(code) number" value="<?=$profile[0]->contact ? $profile[0]->contact : ''?>" />
            </p>

            <p>
              <label for="address" class="required"><strong>Address </strong></label>
              <input type="text" class="input input-large span5" id="address" name="address" value="<?=$profile[0]->address ? $profile[0]->address : ''?>" />
            </p>

            <p>
              <button class="btn btn-success" type="submit" id="save">Save Profile</button>
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
<script type="text/javascript" src="<?=base_url()?>js/fileuploader.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/profile.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.min.js"></script>
<?php $this->load->view("admin/footer_view"); ?>