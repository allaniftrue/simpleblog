<?php
    $total_segments = $this->uri->total_segments();
    $segment = $this->uri->segment($total_segments);
    if(is_numeric($segment)) { $segment = $this->uri->segment($total_segments - 1); }
?>
<div class="span2">
  <div class="well sidebar-nav">
    <ul class="nav nav-list">
      <li class="nav-header">Blog</li>
      <li class="<?php echo ($segment==='posts') ? 'active' : ''?>"><a href="<?=base_url().'admin/posts'?>"><i class="icon icon-pushpin"></i> Posts</a>
      </li>
      <li class="<?php echo ($segment==='add-new') ? 'active' : ''?>"><a href="<?=base_url()?>admin/posts/add-new"><i class="icon icon-plus-sign"></i> Add New Post</a></li>
      <li class="nav-header"><b><?=$this->session->userdata('username')?></b></li>
      <li><a href="<?=base_url()?>admin/settings"><i class="icon icon-user"></i> Profile</a></li>
      <li><a href="<?=base_url()?>admin/settings/account"><i class="icon icon-cog"></i> Account Settings</a></li>
      <li><a href="<?=base_url()?>admin/logout"><i class="icon icon-signout"></i> Logout</a></li>
    </ul>
  </div><!--/.well -->
</div><!--/span-->