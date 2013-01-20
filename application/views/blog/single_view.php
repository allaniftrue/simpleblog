<?php
$this->load->view('blog/header_view');
$this->load->view("blog/sidebar_view");
?>
    <div class="posts span8">
        <div class="page-header">
            <h2><a href="<?=base_url().$posts['post'][0]->url?>"><?=ucwords($posts['post'][0]->title)?></a></h2>
        </div>
        <?=html_entity_decode($posts['post'][0]->post)?>
    </div>
    <div id="single-view" class="span8">
        <ul>
            <li><strong>Author:</strong> <?=$posts['post'][0]->username?></li>
            <li><strong>Date Posted:</strong> <?=date('F d, Y', strtotime($posts['post'][0]->entry_date))?></li>
        </ul>
    </div>
<div class="span8">
    <h4>Comments</h4>
    <?php
        $total = count($posts['blog_comments']);
        for($x=0; $x < $total; $x++) {
    ?>
    <div class="well well-small" id="comment-wrapper">
        <ul>
            <li><strong><?=$posts['blog_comments'][$x]->name?></strong></li>
            <li><small><?=date('F d, Y H:i A', strtotime($posts['blog_comments'][$x]->comment_date))?></small></li>
        </ul>
        <hr />
        <?=$posts['blog_comments'][$x]->comment?>
    </div>
    <?php
        }
    ?>
</div>

<div class="span8" id="comment"><hr />
    <?php 
    $errors = $this->session->flashdata('errors');
    if(! empty($errors)) { ?>
    <div class="alert alert-error">
        <?=$this->session->flashdata('errors')?>
    </div>
    <?php } ?>
    <?php echo form_open(base_url().'blog/comment'); ?>
        <p>
            <label class="required" for="name"><strong>Name: </strong></label>
            <input type="text" class="input input-xlarge" name="name" value="<?php echo set_value('name'); ?>" />
        </p>
        <p>
            <label class="required" for="comment"><strong>Comment: </strong></label>
            <textarea name="comment" id="comment" class="input-xxlarge" rows="8"><?php echo set_value('comment'); ?></textarea>
        </p>
        <p>
            <input type="hidden" name="id" value="<?=$posts['post'][0]->id?>" />
            <button class="btn btn-large" type="submit">Submit Comment</button>
        </p>
    </form>
</div>
<?php $this->load->view('blog/footer_view');