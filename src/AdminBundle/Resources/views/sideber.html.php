
<?php $view['slots']->start('sideber') ?>



        <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar nav-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->        
                <ul class="page-sidebar-menu">
                    <li>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler hidden-phone"></div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li>
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <form class="sidebar-search">
                            <div class="input-box">
                                <a href="javascript:;" class="remove"></a>
                                <input type="text" placeholder="Search..." />
                                <input type="button" class="submit" value=" " />
                            </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                    </li>
                    <li class="start ">
                        <a href="<?php echo $view['router']->generate('_dahboard_index'); ?>" > <!-- target= "_cashier"--> 
                            <i class="icon-home"></i> 
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li  >
                        <a href="javascript:;">
                            <i class="icon-briefcase"></i> 
                            <span class="title">Instrument Family</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li >
                                <a href="<?php echo $view['router']->generate('_add_family'); ?>">
                                    <i class="icon-cogs"></i>
                                    Add Family </a>
                            </li>
                            <li >
                                <a href="<?php echo $view['router']->generate('_view_music_family'); ?>">
                                    <i class="icon-cogs"></i>
                                    Manage Family </a>
                            </li>
                        </ul>
                    </li>
                    <li  >
                        <a href="javascript:;">
                            <i class="icon-briefcase"></i> 
                            <span class="title">Instrument</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li >
                                <a href="<?php echo $view['router']->generate('_add_sound'); ?>">
                                    <i class="icon-cogs"></i>
                                    Add Instrument</a>
                            </li>
                            <li >
                                <a href="<?php echo $view['router']->generate('_view_family_sound'); ?>">
                                    <i class="icon-cogs"></i>
                                    Manage Instrument </a>
                            </li>
                        </ul>
                    </li>
                    <li  >
                        <a href="javascript:;">
                            <i class="icon-briefcase"></i>
                            <span class="title">Advertisements</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li >
                                <a href="<?php echo $view['router']->generate('add_advertisements'); ?>">
                                    <i class="icon-cogs"></i>
                                    Add Advertisements</a>
                            </li>
                            <li >
                                <a href="<?php echo $view['router']->generate('view_advertisemets'); ?>">
                                    <i class="icon-cogs"></i>
                                    Manage Advertisements </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN PAGE -->
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div id="portlet-config" class="modal hide">
                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button"></button>
                        <h3>portlet Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here will be a configuration form</p>
                    </div>
                </div>
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<?php $view['slots']->stop('sideber') ?>

                