
<?php
    $this->load->view('blog/header_view');
    $total = count($posts); 
    
    $this->load->view("blog/sidebar_view");
    if($total > 0){
        for($x=0; $x<$total; $x++):
    ?>
            <div class="span8 pull-left">
                <div class="posts">
                    <div class="page-header">
                        <h2><a href="<?php echo base_url().$posts[$x]->url;?>"><?php echo ucwords($posts[$x]->title);?></a></h2>
                    </div>
                    <p align="justify">
                        <?php echo word_limiter(strip_tags(html_entity_decode($posts[$x]->post)), 150);?>
                    </p>
                </div>
                <div id="post-info" class="row-fluid">
                    <ul>
                        <li><strong>Author:</strong> <?php echo $posts[$x]->username;?></li>
                        <li><strong>Date Posted:</strong> <?php echo date('F d, Y', strtotime($posts[$x]->entry_date));?></li>
                        <li><strong>Comments:</strong> <?php echo $posts[$x]->comment_sum;?></li>
                        <li><strong><a href="<?php echo base_url().$posts[$x]->url;?>">CONTUNUE READING</a></strong></li>
                    </ul>
                </div>
            </div>
    <?php endfor;
    } else {
    ?>
    <h2>No blog post found</h2>
    <?php } ?>
<div class="span8">
<?php echo $this->pagination->create_links();?>
</div>        
<?php $this->load->view('blog/footer_view');