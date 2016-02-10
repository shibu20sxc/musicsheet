<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php $view['slots']->output('title', 'Sheet Music') ?></title>
        <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('SheetMusic/front/css/bootstrap.css'); ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('SheetMusic/front/css/bootstrap-theme.css'); ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('SheetMusic/front/css/style.css'); ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo $view['assets']->getUrl('SheetMusic/front/fonts/styles.css'); ?>" />
        <link type="text/css" href="<?php echo $view['assets']->getUrl('SheetMusic/front/css/jquery-ui.css'); ?>" rel="stylesheet">
            <link type="text/css" href="<?php echo $view['assets']->getUrl('SheetMusic/front/css/nanoscroller.css'); ?>" rel="stylesheet" />
    </head>

    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/angular.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/progressbar.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery.nanoscroller.js'); ?>"></script>
    <script>
        var app = angular.module('globalApp', []);
    </script>
    <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/bootbox.min.js'); ?>"></script>
    <body>
        <div class="container-fluid main_wrapper" ng-app="globalApp">
            <?php include_once 'navigation.html.php'; ?>              
            <?php if ($view['slots']->has('navigation'))  ?>
            <?php $view['slots']->output('navigation') ?>
            <?php if ($view['slots']->has('body'))  ?>
            <?php $view['slots']->output('body') ?>
            
        </div>
        <div class="login_wrap posion" id="login_box" style="display:none;background: #fff;">
            <form action="<?php echo $view['router']->generate('_front_login'); ?>" method="post" class="login_form">

                <input type="text" value="" name="email" id="email" placeholder="email address" class="email" />
                <input type="password" value="" name="password" id="password" placeholder="password" class="pswd" />
                <input type="submit" value="Sign In" class="btn_sin" />

                <div class="clearfix"></div>
                <a href="<?php echo $view['router']->generate('_user_forget_password'); ?>">forgot password</a><br />
                <a href="<?php echo $view['router']->generate('_site_register'); ?>">sign up</a>
            </form>

            <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/logo.png'); ?>" alt="Logo" class="img-responsive pull-right" style="width:60%; margin:40px 15px 20px;" />
            <div class="clearfix"></div>
        </div>
    </body>    
    <script type="text/javascript">
        $(document).ready(function () {
            $('.login_nav').click(function () {
                $("#login_box").toggle(300);
            });
            $('.col-lg-11').click(function () {
                $("#login_box").hide(300);
            });
            $('.fix_width1').click(function () {
                $("#login_box").hide(300);
            });
        });
    </script>
</html>
