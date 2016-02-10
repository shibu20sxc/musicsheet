 
<?php $view->extend('AdminBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Advertisements Upload ') ?>
<?php $view['slots']->start('body') ?>    
<!-- BEGIN PAGE CONTAINER-->        
<div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
        <div class="span12">
            <!-- END BEGIN STYLE CUSTOMIZER -->  
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
                Update Advertisements  <small>Update Advertisements</small>
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
                <li><a href="">Update Advertisements</a></li>
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
                    <div class="caption"><i class="icon-asterisk"></i>Update Advertisements</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="javascript:;" class="reload"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo $view['router']->generate('update_advertisements', array('id' => $advertisements[0]['id']));?>" method = "post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label">Advertisements Type </label>
                            <div class="controls">
                                <select name="advetisements_type" onchange="return changeImageSize();" id="advetisements_type">
                                    <option value="">--Select Image Type--</option>
                                    <option value="1" <?php if($advertisements[0]['advetisements_type'] == 1){ echo 'selected'; }?>>Small Image</option>
                                    <option value="2" <?php if($advertisements[0]['advetisements_type'] == 2){ echo 'selected'; }?>>Large Image</option>
                                    <option value="3" <?php if($advertisements[0]['advetisements_type'] == 3){ echo 'selected'; }?>>Body Image</option>
                                    <option value="4" <?php if($advertisements[0]['advetisements_type'] == 4){ echo 'selected'; }?>>Video Link</option>
                                </select>
                                <div id="editor2_error"></div>
                            </div>
                        </div>       
                        <input type="hidden" name="type" id="advtype_val"/>
                        <input type="hidden" id="type_original" value="<?php echo $advertisements[0]['advetisements_type'];?>"/>
                        <div class="control-group">
                            <label class="control-label">Details About Advertisements </label>
                            <div class="controls">
                                <textarea class="span12 ckeditor m-wrap" name="details" rows="6" data-error-container="#editor2_error"><?php echo $advertisements[0]['details'];?></textarea>
                                <div id="editor2_error"></div>
                            </div>
                        </div>
                        <div class="control-group" style="display:none;" id="video_link">
                           <label class="control-label">Advertisements Video Link <span class="required">*</span></label>
                           <div class="controls">
                               <input type="text" name="advertisements_link"  class="span6 m-wrap" value="<?php echo $advertisements[0]['advertisements'];?>">
                               
                               <span class="help-inline"></span>
                           </div>
                       </div>
                        <div class="control-group" id="advertisements_file_upload">
                            <label class="control-label">Advertisements Image<span class="required">*</span></label>
                            <div class="controls">
                                <?php 
                                    if($advertisements[0]['advertisements']){
                                    $image =    'uploads/advertisements/'.$advertisements[0]['advertisements']; 
                                    }  

                                    ?>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php echo!empty($advertisements[0]['advertisements']) ? $view['assets']->getUrl('').$image : ''; ?>" alt="<?php echo $advertisements[0]['advertisements']; ?>" height="150">

                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file"><span class="fileupload-new">Select Image</span>
                                            <span class="fileupload-exists">change</span>
                                            <input type="file" class="default" name="adv_image"/></span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <div id="image_size_div" style="display: none;">
                                    <span class="label label-important">Note!</span>
                                    <span id="image_size_message" style="color: red;">                            
                                    </span>
                                </div>
                                 <?php if(!empty($fileTypeError)){ echo '<span style="color:red; float:left;">Invalid File Type</span>';}?>
                                 <?php if(!empty($fileSizeError)){ echo '<span style="color:red; float:left;">Invalid File Size (1MB Max)</span>';}?>
                                <br>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Status </label>
                            <div class="controls">
                                <select name = "status">
                                    <option value = "1">Active</option>
                                    <option value = "0">Inactive</option>
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
<script>
    
      function changeImageSize() {
        var imagetype = $('#advetisements_type').val();
        //alert(imagetype);
        if(imagetype == 1){
            $('#advtype_val').val('1');
            $('#advertisements_file_upload').show('slow');            
            $('#video_link').hide('slow');
            $("#image_size_div").show('slow');
            $("#image_size_message").html("");
            $('#image_size_message').html('Please Upload Image with Size 300 X 164');
        }
        if(imagetype == 2){
            $('#advtype_val').val('1');
            $('#advertisements_file_upload').show('slow');
            $('#video_link').hide('slow');
            $("#image_size_div").show('slow');
            $("#image_size_message").html("");
            $('#image_size_message').html('Please Upload Image with Size 300 X 328');
        }
        if(imagetype == 3){
            $('#advtype_val').val('1');
            $('#advertisements_file_upload').show('slow');
            $('#video_link').hide('slow');
            $("#image_size_div").show('slow');
            $("#image_size_message").html("");
            $('#image_size_message').html('Please Upload Image with Size 800 X 600');
        }
        if(imagetype == 4){
             $('#advtype_val').val('2');
            $('#advertisements_file_upload').hide('slow');
            $('#video_link').show('slow');
            $("#image_size_div").show('slow');
            $("#image_size_message").html("");
            $('#image_size_message').html('Please Upload Video Link');
        }
        
        
    }
</script>
<?php $view['slots']->stop('body') ?>       
