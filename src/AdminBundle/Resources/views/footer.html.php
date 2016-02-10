
<?php $view['slots']->start('footer') ?>
<!-- BEGIN FOOTER -->
        <div class="footer">
            <div class="footer-inner">
                2015 &copy; Music Sheet.
            </div>
            <div class="footer-tools">
                <span class="go-top">
                    <i class="icon-angle-up"></i>
                </span>
            </div>
        </div>
        
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->   
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery-1.10.1.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js'); ?>" type="text/javascript"></script>      
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript" ></script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script src="assets/plugins/respond.min.js"></script>  
        <![endif]-->   
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>  
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/jquery.cookie.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript" ></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/select2/select2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/data-tables/jquery.dataTables.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/assets/plugins/data-tables/DT_bootstrap.js'); ?>"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/scripts/app.js'); ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('SheetMusic/assets/scripts/table-editable.js'); ?>"></script>    
        <script>
            jQuery(document).ready(function () {
                App.init();
                TableEditable.init();
                
                var type_original = $('#type_original').val();
                //alert(type_original);
                if(type_original == 1 || type_original == 2 || type_original == 3){
                    $('#advtype_val').val('1');
                    $('#advertisements_file_upload').show('slow');
                    $('#video_link').hide('slow');
                }
                if(type_original == 4){
                     $('#advtype_val').val('2');
                    $('#advertisements_file_upload').hide('slow');
                    $('#video_link').show('slow');
                }
            });

        </script>
        
        <script>
function changeStatus(id,table){ 
    //alert(table);
    //return false;
        $.ajax({
            url: "<?php echo $view['router']->generate('_status_update'); ?>",
            type: "POST",
            data: {
                dataId: id,
                table:table
            },
            success: function (response) {        
                if(response == 1){
                    $('span.status_'+id).html('<a href="" title="Inactive"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/inactive.png') ?>"></a>');
                }
                if(response == 2){
                    $('span.status_'+id).html('<a href="" title="Active"><img src="<?php echo $view['assets']->getUrl('SheetMusic/assets/img/active.png');?>"></a>');
                }
            }
        });
        return false;
        }
</script>


    </body>
    <!-- END BODY -->
</html>
<?php $view['slots']->stop('footer') ?>

                