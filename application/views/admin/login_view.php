<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>中原通識中心 Admin Page</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/jquery/jquery.ui.all.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/lightbox/style.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/style.css" title="style_blue" media="screen"/>
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_green.css" title="style_green" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_red.css" title="style_red" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="<?php echo $url; ?>css/style_purple.css" title="style_purple" media="screen" />

       <!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
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

        <?php //if ($fail == "1"): ?>
            <script type="text/javascript">
                $(document).ready(function() {

                    //BOX LOGIN ERROR TEST//
                    //$("#content-login .error").hide();
                       function a(){
                    $("#box-login").show('shake', 55);
                    $(".header-login").show('shake', 55);
                    $("#content-login .error").show('blind', 500);
}

                   <?php echo $fail; ?>
            });

            </script>

    </head>
    <body>
        <div id="wrapper">
            <ul id="topbar">
                <li><a class="button white fl" title="preview" href="<?=base_url()?>/index.php/admin"><span class="icon_single preview"></span></a></li>
                <li class="s_1"></li>
                <li > ADMIN</li>
            </ul>

            <div id="content-login">
                <div ></div>
                <h2 class="header-login">Login </h2>
                <form id="box-login" action="<?php echo base_url(); ?>index.php/admin/logining" method="post">
                    <p>
                        <label class="req"> 帳號 </label>
                        <br/>
                        <input type="text" name="user" value="" id="username"/>
                    </p>
                    <p>
                        <label class="req"> 密碼 </label>
                        <br/>
                        <input type="password" name="pass" value="" id="password"/>
                    </p>

                    <p class="fr">

                        <input type="submit" value="Login" class="button themed" id="login"/>
                    </p>

                    <div class="clear"></div>
                </form>

                <span id="err" class="message error"> <strong>Username</strong> and/or <strong>Password</strong> are wrong</span>

            </div>

        </div>

        <div id="footer">
            <p class="copy fl">Copyright 2013  All rights reserved.</p>
            <ul class="button language_button white fr">
                <li class="icon_single language fl"></li>
                <li class="flag en fl"></li>
                <li class="flag es fl"></li>
                <li class="flag de fl"></li>
                <li class="flag it fl"></li>
                <li class="clear"></li>
            </ul>

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