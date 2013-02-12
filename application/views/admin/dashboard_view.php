<?php $this->load->view("admin/header_view"); ?>
<?php $this->load->view("admin/top_menu/top_nav_view"); ?>
    <div class="container-fluid">
      <div class="row-fluid">
        <?php $this->load->view("admin/sidebar/sidebar_profile_view"); ?>
        <div class="span9">
          <div class="main">
          <div class="row-fluid">
              <div class="page-header">
                <h2>Dashboard</h2>
              </div>
          </div><!--/row-->
          </div><!--/main-->
        </div><!--/span-->
      </div><!--/row-->
      <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
      <script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
      <script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
    <?php $this->load->view("admin/footer_view"); ?>