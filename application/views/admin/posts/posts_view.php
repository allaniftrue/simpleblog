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
                        <h2>Blog Posts</h2>
                    </div>
                    
                    <p><a class="btn btn-primary" href="<?=base_url()?>admin/posts/add-new">Add New Post</a></p>
                    <table class="table table-stripped table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Comments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $limit = count($posts);
                                if($limit > 0){
                                    for($x=0; $x < $limit; $x++) {
                                        $summary = strip_tags(html_entity_decode($posts[$x]->post));
                            ?>
                            <tr>
                                <td><?=ucwords($posts[$x]->title)?></td>
                                <td><?=word_limiter($summary,20)?></td>
                                <td><?=$posts[$x]->username?></td>
                                <td><?=date('M d, Y', strtotime($posts[$x]->entry_date))?></td>
                                <td><?=$posts[$x]->comment_sum?></td>
                                <td id="actions">
                                    <a href="<?=base_url()?>admin/posts/edit-post/<?=$posts[$x]->id?>" title="Edit post" id="edit"><i class="icon icon-edit icon-large"></i></a>
                                    <a href="javascript:void(0);" id="delete" data-id="<?=$posts[$x]->id?>" title="Delete post"><i class="icon icon-trash icon-large"></i></a>
                                </td>
                            </tr>
                            <?php
                                    } 
                                }else {
                            ?>
                            <tr><td colspan="6"><em>No posts found</em></td></tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?=$this->pagination->create_links();?>
                </div><!--/row-->
            </div><!--/main-->
        </div><!--/span-->
    </div><!--/row-->
<?php $this->load->view("admin/posts/footer_posts_view"); ?>