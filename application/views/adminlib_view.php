<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>restaurant search and reservation Admin Page</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/jquery/jquery.ui.all.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/lightbox/style.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/style.css" title="style_blue" media="screen"/>
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_green.css" title="style_green" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_red.css" title="style_red" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_purple.css" title="style_purple" media="screen" />


         <!--[if IE]><script type="<?php echo $url; ?>text/javascript" src="js/excanvas.js"></script><![endif]-->
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery-ui-1.8.2.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.fancybox-1.3.2.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.validate.js" ></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.wysiwyg.js" ></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery.flot.stack.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/styleswitch.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/custom.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/custom_graphs.js"></script>

        <script type="text/javascript" src="<?= $url ?>ckeditor.js"></script>
                <script type="text/javascript" src="<?=base_url() ?>ckfinder/ckfinder.js"></script>


        <link rel="stylesheet"  href="https://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
        <script src="https://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

    </head>
    <body>
        <?php
        if ($this->session->userdata('USERNAME') == "") {
            redirect('/admin/login', 'refresh');
        }
        ?>
        <div id="wrapper">

            <ul id="topbar">
                <li><a class="button white fl" title="preview" href=""><span class="icon_single preview"></span></a></li>
                <li class="s_1"></li>
              <!--  <li ><strong></strong> ADMIN</li> -->
                <li class="s_1"></li>
                <li><a class="breadcrumb underline" href="<?php echo $adminurl; ?>">Dashboard</a></li>
                <li class="fr"><a class="button red fl" title="logout" href="<?php echo $adminurl; ?>logout"><span class="icon_text logout"></span>logout</a></li>

            </ul>


            <?php echo $main ?>

        </div>

        <div id="footer">
            <p class="copy fl">Copyright 2013<strong>  </strong> All rights reserved.</p>
            <ul class="skinner fr">
                <li class="fl"><a href="#" rel="style_blue" class="styleswitch skin skin_blue fl"></a></li>
                <li class="fl"><a href="#" rel="style_green" class="styleswitch skin skin_green fl"></a></li>
                <li class="fl"><a href="#" rel="style_red" class="styleswitch skin skin_red fl"></a></li>
                <li class="fl"><a href="#" rel="style_purple" class="styleswitch skin skin_purple fl"></a></li>
                <li class="clear"></li>
            </ul>
        </div>
    </body>
</html>