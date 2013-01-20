<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php
    
            $total_segments = $this->uri->total_segments();
            $segment = $this->uri->segment($total_segments);
            
            if($total_segments === 0) {
                echo "Administration Panel";
            } else {
                if(is_numeric($segment))
                    echo ucwords(str_replace("-"," ", $this->uri->segment($total_segments-1)));
                else
                    echo ucwords(str_replace("-"," ", $this->uri->segment($total_segments)));
            }
            
    ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>css/global.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome.css" rel="stylesheet">
    
    <script>var base_url = "<?=base_url().index_page()?>";</script>
  </head>
  <body>