<?php $view->extend('AdminBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Advertisements ') ?>
<?php $view['slots']->start('body') ?>    
                <!-- BEGIN PAGE CONTAINER-->        
                <div class="container-fluid">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- END BEGIN STYLE CUSTOMIZER -->  
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title">
                                Show Advertisements <small>Show all Advertisements</small>
                            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <i class="icon-home"></i>
                                    <a href="">Home</a> 
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li>
                                    <a href="#">Advertisements</a>
                                    <i class="icon-angle-right"></i>
                                </li>
                                <li><a href="">Add Advertisements</a></li>
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
                                    <div class="caption"><i class="icon-asterisk"></i>Advertisements</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                        <thead>
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Image Type</th>
                                                <th>Image</th>
                                                <th>Image Details</th>
                                                <th>Status</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($advertisements)){
                                            $i = 1;
                                            $image_type ='';
                                            $image = '';
                                            foreach ($advertisements as $adver) {
                                                if($adver['advetisements_type'] == 1 ){
                                                    $image_type = 'Small Image';
                                                }else if($adver['advetisements_type'] == 2){
                                                     $image_type = 'Double Image';
                                                }else if($adver['advetisements_type'] == 3){
                                                     $image_type = 'Big Banner Image';
                                                }else if($adver['advetisements_type'] == 4){
                                                     $image_type = 'Video Link';
                                                }
                                                ?>
                                            <?php 
                                                if($adver['advetisements_type'] == 1 || $adver['advetisements_type'] == 2 || $adver['advetisements_type'] == 3){
                                                if($adver['advertisements']){
                                                //$image =    'uploads/advertisements/'.$adver['advertisements']; 
                                                $image = '<img src="'.$view['assets']->getUrl('uploads/advertisements/').$adver['advertisements'].'" width="50px"/>';
                                                }  
                                                }if($adver['advetisements_type'] == 4)
                                                {
                                                    $image = $adver['advertisements'];
                                                }
                                                ?>
                                            <tr >
                                                <td><?php echo $i; ?></td>                                                
                                                <td><?php echo $image_type; ?></td>
                                                <td><?php echo $image; ?></td>
                                                <td><?php echo $adver['details']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($adver['status'] == 1) {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $adver['id']; ?>" onclick="return changeStatus(<?php echo $adver['id']; ?>, 'advertisements');"> 
                                                            <a href="" title="Active"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/active.png') ?>" alt="Active" ></a>
                                                        </span>
                                                        <?php } else {
                                                        ?>
                                                        <span style="margin-left:35px;" class="status_<?php echo $adver['id']; ?>" onclick="return changeStatus(<?php echo $adver['id']; ?>, 'advertisements');">    
                                                            <a href="" title="Inactive"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/inactive.png') ?>" alt="Inactive" ></a>
                                                        </span>
                                                    <?php } ?>                                    
                                                </td>
                                                <td style="width:70px;">
                                                    <a href="<?php echo $view['router']->generate('update_advertisements', array('id' => $adver['id'])); ?>" ><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/edit.png'); ?>" alt="Edit" height="30" width="30"></a>
                                                    <a href="<?php echo $view['router']->generate('_delete_update', array('id' => $adver['id'],'table'=>'advertisements','route'=>'view_advertisemets')); ?>"><img src = "<?php echo $view['assets']->getUrl('SheetMusic/assets/img/delete.png'); ?>" alt="Delete" height="30" width="30"></a>
                                                </td>
                                            </tr>
                                        <?php
                                       $i++; }}
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
        