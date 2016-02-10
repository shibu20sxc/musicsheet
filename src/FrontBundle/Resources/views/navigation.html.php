<?php $view['slots']->start('navigation') ?>
	<!-- Header Part Start-->
        <?php $userData = $app->getSession()->get('users_session'); ?>
    	<div class="header_wrap">
        	<div class="col-lg-8 col-sm-4">&nbsp;</div>
            <div class="col-lg-4 col-sm-8 menu_wrap">
            	<nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      
                    </div>
                
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                          <?php if(!empty($userData)) { ?>
                              <li><a href="<?php echo $view['router']->generate('_front_dashboard'); ?>">News</a></li>
                          <?php }else{  ?>
                        <li><a href="<?php echo $view['router']->generate('_front_login'); ?>">News</a></li>
                          <?php } ?>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="<?php echo $view['router']->generate('_fornt_advertisement'); ?>">Contact</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Terms</a></li>  
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    <!-- Header Part End-->

<?php $view['slots']->stop('navigation') ?>

                