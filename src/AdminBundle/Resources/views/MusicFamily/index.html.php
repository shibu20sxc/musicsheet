<?php $view->extend('AdminBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Instrument Family ') ?>
<?php $view['slots']->start('body') ?>    
                <!-- BEGIN PAGE CONTAINER-->        
                <div class="container-fluid">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- END BEGIN STYLE CUSTOMIZER -->  
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title">
                                Show Instrument Family <small>Show all Instrument Family</small>
                            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                    <a href="">Home</a> 
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <a href="#">Instrument Family</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li><a href="">Add Instrument Family</a></li>
                            </ul>
                            <!-- END PAGE TITLE & BREADCRUMB-->
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row-fluid">
                        <div class="span12">  
                            <div class="portlet box purple">
                                <div class="portlet-title">
                                    <div class="caption"><i class="icon-asterisk"></i>Instrument Family</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <!--<th>Details</th>-->
                                                <th>Status</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                        $i = 1;
                        foreach ($music_family as $music) {
                            ?>
                                        
                                            <tr >
                                                <td><?php echo $music->getName(); ?></td>
                                                <!--<td><?php echo $music->getDetails(); ?></td>-->
                                                
                                                <td>
                                                    <?php
                                                    if ($music->getStatus() == 1) {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $music->getId(); ?>" onclick="return changeStatus(<?php echo $music->getId(); ?>, 'music_family');"> 
                                                            <a href="" title="Active"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/active.png') ?>" alt="Active" ></a>
                                                        </span>
                                                        <?php } else {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $music->getId(); ?>" onclick="return changeStatus(<?php echo $music->getId(); ?>, 'music_family');">    
                                                            <a href="" title="Inactive"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/inactive.png') ?>" alt="Inactive" ></a>
                                                        </span>
                                                    <?php } ?>                                    
                                                </td>
                                                <td style="width:70px;">
                                                    <a href="<?php echo $view['router']->generate('_update_family', array('id' => $music->getId())); ?>" ><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/edit.png'); ?>" alt="Edit" height="30" width="30"></a>
                                                    <a href="<?php echo $view['router']->generate('_delete_update', array('id' => $music->getId(),'table'=>'music_family','route'=>'_view_music_family')); ?>"><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/delete.png'); ?>" alt="Delete" height="30" width="30"></a>
                                                </td>
                                            </tr>
                                        <?php
                        }
                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT -->
                </div>
                <!-- END PAGE CONTAINER-->
            </div>
            <!-- END PAGE -->
        </div>
        <!-- END CONTAINER -->
<?php $view['slots']->stop('body') ?>       
        