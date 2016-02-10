<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Dashboard ') ?>
<?php $view['slots']->start('body') ?>    

<?php //print_r($songs);?>
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 less_rt rt_border">
        <div class="sheet_details_wrap">
            <div class="comment_box">
                <div class="subscribe_info">Subscribe to <span><?php echo $songs[0]['username']; ?></span></div>
                <div class="subscribe_info">Current Song Name: <?php echo $songs[0]['song']; ?></div>
                <div class="subscribe_info">Contributor: <?php echo $songs[0]['contributor']; ?></div>
                <div class="subscribe_info">Instrument Used: <?php echo $songs[0]['name']; ?></div>
            </div>
            <?php
            $logged_in_user = $app->getSession()->get('users_session');
            if (!empty($logged_in_user)) {
                $looged_user_id = $logged_in_user['login_users_id'];
            }
            ?>
            <input type="hidden" id="logged_user_id" value="<?php echo $looged_user_id; ?>"/>
            <input type="hidden" id="songs_post_user_id" value="<?php echo $songs[0]['user_id']; ?>"/>
            <input type="hidden" id="songs_id"  value="<?php echo $songs[0]['id']; ?>"/>
            <div class="button_wrap">
                <input type="button" value="Subscribe" class="detail_btn" id="suscribe_songs"/>
                <input type="button" value="Comment" class="detail_btn comment_div" />
                <input type="button" value="Report" class="detail_btn detail_btn_bottom report_div" />
            </div>
            <div class="clearfix"></div>
            <span id="songs_check"></span>
            <div class="artist_other_wrap">
                <div class="head">other by this Song</div>
                <?php if(!empty($otherSongs)){ 
                    foreach($otherSongs as $othsong){                       
                        $image =    'uploads/music/'.$othsong['music_sheet_name'];                         
                    ?>
                
                <div class="col-lg-3 col-sm-3">
                    <div class="song_wrap">
                        <img src="<?php echo $view['assets']->getUrl('').$image; ?>" alt="<?php echo $othsong['music_sheet_name'];?>" class="img-responsive" />
                        <h2><?php echo $othsong['song'];?></h2>
                        <p>by <?php echo $othsong['artist'];?></p>
                    </div>
                </div>
                <?php } } ?>
                <div class="clearfix"></div>

                <div class="comment_wrap" id="comment_area" style="display:none;">
                    <div class="post_comment_wrap">
                        <form action="" method="">
                            <input type="button" class="post_btn exit" value="Post" id="comment_post_button" />
                            <textarea class="comment_area" id="comment_text" placeholder="Put Your Comments Here"></textarea>
                        </form>
                    </div><div class="clearfix"></div>
                    <div class="comment_listing_area">
                        <ul>
                            <?php
                            if (!empty($comments)) {
                                foreach ($comments as $comment) {
                                    ?>
                                    <li>
                                        <span class="name"><?php echo $comment['name'] ?></span> <span class="upoload">Commented</span> <?php echo $comment['comments'] ?>
                                    </li>
    <?php }
} ?>
                        </ul>
                        <input type="button" value="Exit" class="exit" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--Report Div-->

                <div class="comment_wrap" id="report_area" style="display:none;">
                    <div class="post_comment_wrap">
                        <form action="" method="">
                            <input type="button" class="post_btn exit" value="Report" id="report_post_button" />
                            <textarea class="comment_area" id="report_text" placeholder="Put Your Report Here" style="width:87% ; margin-bottom: 8%;"></textarea>
                        </form>
                    </div>
                    <div class="clearfix"></div>                    
                </div>
            </div>




            <div class="clearfix"></div>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-1 col-sm-1 mob_display">
        &nbsp;
    </div>
    <div class="clearfix"></div>
</div>
<!-- Body Part End-->
<div class="notification_wrap" id="notify"  style="display:none;">
    <ul>
        <?php if(!empty($subscription_details)) {
            foreach ($subscription_details as $subs){
            ?>
        <li>
            <!--<span class="name"><?php echo $subs['name'];?></span>--> 
            <!--<span class="upoload">uploaded</span>-->
         <?php echo $subs['details'];?>
        </li>
        <?php } }?>
    </ul>
    <input type="button" value="Exit" class="exit" />
</div>


<?php $view['slots']->stop('body') ?>