<?php $view->extend('AdminBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music |  Instrument Update') ?>
<?php $view['slots']->start('body') 
        
        ?>    
<!-- BEGIN PAGE CONTAINER-->        
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- END BEGIN STYLE CUSTOMIZER -->  
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
                Instrument  <small>Update Instrument</small>
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
                <li><a href="">Update Instrument</a></li>
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
                    <div class="caption"><i class="icon-asterisk"></i>Update Instrument</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="javascript:;" class="reload"></a>
                    </div>
                </div>
                <?php //print_r($family_sound);?>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="" method = "post">
                        <div class="control-group">
                            <label class="control-label">Instrument Family </label>
                            <div class="controls">
                                <select name="fid">
                                    <?php 
                                    if (!empty($families)) {
                                        foreach ($families as $family) {
                                            ?>
                                            <option value="<?php echo $family->getId(); ?>"><?php echo $family->getName(); ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                                <div id="editor2_error"></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Instrument Name <span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="name" id="category_name" class="span6 m-wrap" value="<?php echo $family_sound[0]['name']?>">
                                <span class="help-inline"></span>
                            </div>
                        </div>
<!--                        <div class="control-group">
                            <label class="control-label">Description </label>
                            <div class="controls">-->
                        <textarea class="span12 ckeditor m-wrap" style="display: none;" name="details" rows="6" data-error-container="#editor2_error"><?php echo $family_sound[0]['details']?></textarea>
<!--                                <div id="editor2_error"></div>
                            </div>
                        </div>-->
                        <div class="control-group">
                            <label class="control-label">Status </label>
                            <div class="controls">
                                <select name = "status">
                                    <option value = "1" <?php if($family_sound[0]['status'] == 1){ echo 'selected';}?>>Active</option>
                                    <option value = "0" <?php if($family_sound[0]['status'] == 0){ echo 'selected';}?>>Inactive</option>
                                </select>
                                <div id="editor2_error"></div>
                            </div>
                        </div>



                        <div class="form-actions">
                            <button type="submit" class="btn blue">Update</button>
                            <button type="button" class="btn">Cancel</button>     
                        </div>
                    </form>
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
