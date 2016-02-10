
<?php $view['slots']->start('header') ?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php $view['slots']->output('title', 'Sheet Music') ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/custom/css/style.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap/css/bootstrap.min.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap/css/bootstrap-responsive.min.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/font-awesome/css/font-awesome.min.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/css/style-metro.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/css/style.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/css/style-responsive.css') ;?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/css/themes/brown.css') ;?>" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/uniform/css/uniform.default.css') ;?>" rel="stylesheet" type="text/css"/>


        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/select2/select2_metro.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/data-tables/DT_bootstrap.css'); ?>" rel="stylesheet" />
        <!-- END PAGE LEVEL STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->



    <body class="page-header-fixed">
        <!-- BEGIN HEADER -->   
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN LOGO -->
                    <a class="brand" href="index.html">
                        Sheet Music
                    </a>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/menu-toggler.png'); ?>" alt="" />
                    </a>          
                    <!-- END RESPONSIVE MENU TOGGLER -->            
                    <!-- BEGIN TOP NAVIGATION MENU -->              
                    <ul class="nav pull-right">
                        
                        
                        <li class="dropdown user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<!--                                <img alt="Sheet Music" src="" height="25px" width="25px"/>-->
                                <span class="username">
                                    Sheet Music						</span>
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $view['router']->generate('_admin_logout'); ?>"><i class="icon-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                    <!-- END TOP NAVIGATION MENU --> 
                </div>
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
<?php $view['slots']->stop('header') ?>

                