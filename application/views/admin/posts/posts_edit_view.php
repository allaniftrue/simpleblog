<?php $this->load->view("admin/header_view"); ?>
<?php $this->load->view("admin/top_menu/top_nav_view"); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <?php
            $this->load->view("admin/sidebar/sidebar_profile_view");
        ?>
        <div class="span9">
            <div class="main">
                <div class="row-fluid">
                    <div class="page-header">
                        <h2>Update Blog Post</h2>
                    </div>
                    <div class="input-form">
                        <form method="POST" action="" id="update-form">
                            <p><label for="title" class="required"><strong>Title</strong></label>
                                <input type="text" class="input input-xxlarge" name="title" id="title" value="<?php echo $info[0]->title;?>" />
                            </p>
                            <p><label for="blogentry" class="required" id="blogentrylabel"><strong>Post</strong></label>
                                <textarea id="blogentry" name="blogentry" class="input-block-level" rows="10"><?php echo $info[0]->post;?></textarea>
                            </p>
                            <br />
                            <p>
                                <input type="hidden" name="id" id="id" value="<?php echo $info[0]->id;?>" />
                                <button type="submit" class="btn btn-primary" id="savecontent">Update Article</button>
                            </p>
                        </form>
                    </div>
                </div><!--/row-->
            </div><!--/main-->
        </div><!--/span-->
    </div><!--/row-->
<?php $this->load->view("admin/posts/footer_edit_posts_view"); ?>