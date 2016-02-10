<?php $view->extend('AdminBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Instrument List ') ?>
<?php $view['slots']->start('body') ?>    
                <!-- BEGIN PAGE CONTAINER-->        
                <div class="container-fluid">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- END BEGIN STYLE CUSTOMIZER -->  
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title">
                                Show Instrument<small>Show all Instrument</small>
                            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                    <a href="">Home</a> 
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <a href="#">Instrument</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li><a href="">Show Instrument</a></li>
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
                                    <div class="caption"><i class="icon-asterisk"></i>Instrument</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                        <thead>
                                            <tr>
                                                <th>Instrument Family</th>
                                                <th>Instrument</th>
                                                <!--<th>Details</th>-->
                                                <th>Status</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($music_sound as $music) {
                                            ?>
                                        
                                            <tr >
                                                <td><?php echo $music['family']; ?></td>
                                                <td><?php echo $music['name']; ?></td>
                                                <!--<td><?php echo $music['details']; ?></td>-->
                                                
                                                <td>
                                                    <?php
                                                    if ($music['status'] == 1) {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $music['id']; ?>" onclick="return changeStatus(<?php echo $music['id']; ?>, 'family_sound');"> 
                                                            <a href="" title="Active"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/active.png') ?>" alt="Active" ></a>
                                                        </span>
                                                        <?php } else {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $music['id']; ?>" onclick="return changeStatus(<?php echo $music['id']; ?>, 'family_sound');">    
                                                            <a href="" title="Inactive"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/inactive.png') ?>" alt="Inactive" ></a>
                                                        </span>
                                                    <?php } ?>                                    
                                                </td>
                                                <td style="width:70px;">
                                                    <a href="<?php echo $view['router']->generate('_update_sound', array('id' => $music['id'])); ?>" ><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/edit.png'); ?>" alt="Edit" height="30" width="30"></a>
                                                    <a href="<?php echo $view['router']->generate('_delete_update', array('id' => $music['id'],'table'=>'family_sound','route'=>'_view_family_sound')); ?>"><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/delete.png'); ?>" alt="Delete" height="30" width="30"></a>
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
        