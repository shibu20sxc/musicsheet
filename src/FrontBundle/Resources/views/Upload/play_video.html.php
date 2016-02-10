<?php $view->extend('FrontBundle::save_layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Play Video ') ?>
<?php $view['slots']->start('body') ?>     
    <!-- Body Part Start-->
    	<div class="body_wrap">
            <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
            	<a href = "<?php echo $view['router']->generate('_fornt_play_music'); ?>?family=<?php echo $music_family;?>&songs_name=<?php echo $songsName;?>" ><input type="button" class="btn_back" value="< back" /></a>
                <a href = "<?php echo $view['router']->generate('_fornt_sheet_music_details', array( 'id' => $songs[0]['id'] )); ?>" ><input type="button" class="btn_back pull-right" value="Sheet Music >" /></a>
            	
                <div class="nano music_video_wrap" id="video_song">
            	<div class="embed-responsive embed-responsive-16by9 nano-content">
                    <iframe class="embed-responsive-item" height="380" src="<?php echo $songs[0]['video']; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-1 col-sm-1 fix_width1 mob_display">
            	&nbsp;
            </div>
            <div class="clearfix"></div>
        </div>
    <!-- Body Part End-->
<script type="text/javascript">

    $(document).ready(function() {
		/* Initiate to the start position of all scroll */
		$( ".slider" ).slider({
			range: false,
			values: [ 0,0]
			});	
			intervalId = 0;	
		
		/* for Auto fit Scroll for songlist & audiolist */
		$("#video_song").css('height',($( window ).height()-85));
		$("#audio_control_wrap").css('height',($( window ).height()-85));	
		$(window).on("orientationchange",function(){
			//alert("The orientation has changed!");
		  	$("#video_song").css('height',($( window ).height()-85));
			$("#audio_control_wrap").css('height',($( window ).height()-85));
		});
		
		$(".nano").nanoScroller();
			
	});
</script>
<?php $view['slots']->stop('body') ?>

