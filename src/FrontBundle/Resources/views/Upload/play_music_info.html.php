<?php $view->extend('FrontBundle::music_details_layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music  | Music Info ') ?>
<?php $view['slots']->start('body') ?>    
<?php //print_r($songs);?>
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">

        <div class="sheet_details_wrap" id="detail">
            <div class="nano">
                <div class="nano-content">
                    <div class="comment_box">                   
                        <div class="subscribe_info">Subscribe to <span><a href="<?php echo $view['router']->generate('_user_profile_view',array('id'=>$songs[0]['user_id'])); ?>"><?php echo $songs[0]['username']; ?></a></span></div>
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
                        <div class="head">other by this song</div>
                        <?php
                        if (!empty($otherSongs)) {
                            foreach ($otherSongs as $othsong) {
                                $image = 'uploads/music/' . $othsong['music_sheet_name'];
                                ?>
                                <div class="song_wrap">
                                    <img src="<?php echo $view['assets']->getUrl('') . $image; ?>" alt="<?php echo $othsong['music_sheet_name']; ?>" class="img-responsive" />
                                    <h2><?php echo $othsong['song']; ?></h2>
                                    <p>by <?php echo $othsong['artist']; ?></p>
                                </div>
    <?php }
} ?>
                        <div class="clearfix"></div>

                        <div class="comment_wrap" id="comment_area" style="display:none;">
                            <div class="post_comment_wrap">
                                <form action="" method="">
                                    <input type="button" class="post_btn" value="Post" id="comment_post_button"/>
                                    <textarea class="comment_area" id="comment_text">Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.</textarea>
                                </form>
                            </div><div class="clearfix"></div>
                            <div class="comment_listing_area nano" id="comment_listing_area">
                                <ul class="nano-content">
                                    <?php
                                    if (!empty($comments)) {
                                        foreach ($comments as $comment) {
                                            ?>
                                            <li>
                                                <a href="javascript:void(0);"><span class="name"><?php echo $comment['name'] ?></span> <span class="upoload">Commented</span> <?php echo $comment['comments'] ?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>                                    

                                </ul>
                                <input type="button" value="Exit" class="exit" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
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
            </div>    
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-1 col-sm-1 fix_width1 mob_display">
        &nbsp;

        <div class="notification_ico">
            <a href="javascript:void(0);" class="Show_notify"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/notify_ico.png'); ?>" alt="Notification" class="img-responsive" /></a>
        </div>
        <div class="notification_wrap" id="notify"  style="display:none;">
            <ul>
                <ul>
                    <?php
                    if (!empty($subscription_details)) {
                        foreach ($subscription_details as $subs) {
                            ?>
                            <li>
                                <a href="#"><span class="name"><?php echo $subs['name']; ?></span> <span class="upoload">uploaded</span>  <?php echo $subs['details']; ?></a>

                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </ul>
            <input type="button" value="Exit" class="exit" />
        </div>

        <div class="rt_info"><a href="<?php echo $view['router']->generate('_fornt_music_details_report', array('id' => $songs[0]['id'])); ?>">info</a></div>

    </div>
    <div class="clearfix"></div>
</div>
<!-- Body Part End-->
<!-- Footer Part Start-->
<?php $userData = $app->getSession()->get('users_session'); ?>
<input type="hidden" name="user_login_id" id="user_login_id" value="<?php echo $userData['login_users_id']; ?>"/>
<input type="hidden" name="user_songs_id" id="user_songs_id" value="<?php echo $songs[0]['id']; ?>"/>
<div class="footer_wrap" ng-controller="playSingleSong">
    <div class="col-lg-3 col-sm-3">
<!--        <input type="button" value="" class="foooter_search_btn" />
        <input type="text" name="search" id="search" placeholder="Search" class="foooter_search" />-->
    </div>
    <div class="col-lg-6 col-sm-6">
        <div class="optional_footer">
            <div class="bottom_song_play">
                <a href="javascript:void(0);" ng-click="play('<?= $songs[0]['music']; ?>');" class="play" id="playSong" songs-src="<?php echo $view['assets']->getUrl('uploads/songs/') . $songs[0]['music']; ?>">Play</a> / <a href="javascript:void(0);" id="pauseSong">Pause</a></div>
            <input type="range" min=0 max=100 value=0 id="slider" class="sound_bar" style="width:45% !important;"/>
            <div class="song_time" id="song_time"><?= $songs[0]['songs_duration']; ?></div>
            <audio class="audioDemo" controls preload="none" id="audioDemo" style="display:none" src=""> </audio>
            <div class="page0f">
                <a href="#carousel-example-generic" role="button" data-slide="prev" onclick="return slideChange('prev');">&lt;</a> 
                <input type="hidden" value="<?php echo count($songs); ?>" id="total_slide"/>
                <span><span id="change_value">1</span>/<?php echo count($songs); ?> page </span>
                <a href="#carousel-example-generic" role="button" data-slide="next" onclick="return slideChange('next');">&gt;</a>
            </div>
             <?php if (!empty($userData)) { ?>
             <div class="bottom_save pull-right">
                 <a href="javascript:void(0);" id="save_user_songs" style="color:#6d6e70 !important; font-size:18px !important; line-height:16px !important;">save</a>
             </div>
             <?php } ?>
        </div>        
    </div>
    <div class="footer_nav">
        <ul>
            <li><a href="<?php echo $view['router']->generate('_fornt_play_music'); ?>">Sheet<br /> Music</a></li>
            <?php if (empty($userData)) { ?>
                <li class="odd_li"><a href="javascript:void(0);" class="login_nav">Sign In</a></li>
            <?php } else { ?>
                <a href="javascript:void(0);" class="Show_My_Div">
                    <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/signin_logo.png'); ?>" alt="Logo" class="img-responsive pull-right" style="width:48px; position:absolute; right:3%; bottom:20%;" />
                </a>
        <?php } ?>
        </ul>       
    </div>       
    <input type="hidden" id="new_val" value="1"/>
    <div class="user_setting" id="usetting"  style="display:none;" >
        <ul>
            <li><a href="#">Setting</a></li>
            <li><a href="<?php echo $view['router']->generate('_site_upload'); ?>">Upload</a></li>
            <li><a href="<?php echo $view['router']->generate('_fornt_saved'); ?>">Saved</a></li>
            <li><a href="<?php echo $view['router']->generate('_site_logout'); ?>">Logout</a></li>

        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Footer Part End-->
<script type="text/javascript">
        
        
         $('#save_user_songs').click(function () {
        var user_id = $('#user_login_id').val();
        var songs_id = $('#user_songs_id').val();

        $.ajax({
            url: "<?php echo $view['router']->generate('_save_songs_details'); ?>",
            type: "POST",
            data: {
                user_id: user_id,
                songs_id: songs_id,
            },
            success: function (data) {
                //alert(data);
                if ($.trim(data) == 'error') {
                    bootbox.dialog({
                        message: '<div class="row" style=" color:#666; font-size:18px; text-align:center;"> ' +
                                'You Have Already Saved This Song.' +
                                '</div>',
                    }
                    );

                    return false;
                }
                else if ($.trim(data) == 'success') {
                    bootbox.dialog({
                        message: '<div class="row" style=" color:#666; font-size:18px; text-align:center;"> ' +
                                'You Have Successfully Saved This Song.' +
                                '</div>',
                    }
                    );
                    return true;
                }
            }
        });
    });
     $('.Show_My_Div').click(function () {
            $("#usetting").toggle(300);
        });
        $('.col-lg-11').click(function () {
            $("#usetting").hide(300);
        });
        
    $('#suscribe_songs').click(function(){
        var logged_user_id = $('#logged_user_id').val();
        var songs_post_user_id = $('#songs_post_user_id').val();
        var songs_id = $('#songs_id').val();     
        if(logged_user_id == songs_post_user_id){
            $("#songs_check").html("");
            $("#songs_check").html('<p style="color:red">You Cannot Subscribe Your Own Songs.</p>');            
        }else{
            
            $.ajax({
            url: "<?php echo $view['router']->generate('_fornt_music_details_subscribe'); ?>",
            type: "POST",
            data: {
                logged_user_id: logged_user_id,
                songs_post_user_id: songs_post_user_id,
                songs_id: songs_id,
            },
            success: function (data) {
                //alert(data);
                if ($.trim(data) == 'error') {
                    $("#songs_check").html("");
                    $("#songs_check").html('<p style="color:red">You Have Already Subscribed This User.</p>');
                    
                    return false;

                }
                else if($.trim(data) == 'success'){

                    $("#songs_check").html("");
                    $("#songs_check").html('<p style="color:green">You Have Successfully Subscribed This User.</p>');
                    return true;
                }
            }
        });
            
        }
    });
    
    
    $('#comment_post_button').click(function(){
    var logged_user_id = $('#logged_user_id').val();
    var comment_text = $('#comment_text').val();
    var songs_id = $('#songs_id').val();    
    $.ajax({
            url: "<?php echo $view['router']->generate('_ajax_music_details_comment_post'); ?>",
            type: "POST",
            data: {
                logged_user_id: logged_user_id,
                comment_text: comment_text,
                songs_id: songs_id,
            },
            success: function (data) {
                //alert(data);
                 if($.trim(data) == 'success'){
                    $("#songs_check").html("");
                    $("#songs_check").html('<p style="color:green">You Have Successfully Post Comment.</p>');
                    return true;
                }
            }
        });
    });
    
    $('#report_post_button').click(function(){
    var report_text = $('#report_text').val();
    var logged_user_id = $('#logged_user_id').val();    
    var songs_id = $('#songs_id').val()
    $.ajax({
             url: "<?php echo $view['router']->generate('_ajax_music_details_report_post'); ?>",
             type: "POST",
             data: {
                 logged_user_id: logged_user_id,
                 report_text: report_text,
                 songs_id: songs_id,
             },
             success: function (data) {
                 //alert(data);
                  if($.trim(data) == 'success'){
                     $("#songs_check").html("");
                     $("#songs_check").html('<p style="color:green">You Have Successfully Reported To Admin.</p>');
                     return true;
                 }
             }
         });
    });


    $(document).ready(function () {
        $('.comment_div').click(function () {
            $("#comment_area").toggle(300);
             $("#report_area").hide(300);
        });
        $('.exit').click(function () {
            $("#comment_area").hide(300);
        });

        
        $('.Show_notify').click(function () {
            $("#notify").fadeIn(300);
        });

        $('.exit').click(function () {
            $("#notify").fadeOut(300);

        });
        
        
        $('.report_div').click(function () {
            $("#report_area").toggle(300);
            $("#comment_area").hide(300);
        });
        $('.exit').click(function () {
            $("#comment_area").hide(300);
        });
    });



    $(document).ready(function () {


        /* for Auto fit Scroll for songlist & audiolist */
        $("#detail").css('height', ($(window).height() - 125));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));
        $("#comment_listing_area").css('height', ($(window).height() - 555));


        $(window).on("orientationchange", function () {
            //alert("The orientation has changed!");
            $("#detail").css('height', ($(window).height() - 125));
            $("#audio_control_wrap").css('height', ($(window).height() - 85));
            $("#comment_listing_area").css('height', ($(window).height() - 555));
        });


        $(".nano").nanoScroller();

    });
    
    app.controller("playSingleSong", function ($scope, $http, $interval) {
        $scope.play = function (music) {

            $interval.cancel($scope.intervalId);
            var t = document.getElementById('slider');
            $scope.start_stop = document.getElementById('playSong').innerHTML;
            //alert($scope.start_stop);
            if (!angular.equals($scope.start_stop, 'Play'))
            {
                //alert(angular.equals($scope.start_stop, '[Play]'));

                document.getElementById('playSong').innerHTML = 'Play';
                $interval.cancel($scope.intervalId);
                t.value = 0;
                $(".audioDemo").trigger('pause');

                $(".audioDemo").prop("currentTime", 0);

            }
            else {
                //  alert('Hi');
                document.getElementById('playSong').innerHTML = 'Stop';
                $scope.song_link = '<?php echo $view['assets']->getUrl('uploads/songs/'); ?>' + music;
                //alert($scope.song_link);
                $('.audioDemo').attr('src', $scope.song_link);
                $('#audioDemo').on("canplay", function () {
                    $scope.total_second = this.duration;
                    //alert(this.duration);
                    second = Math.floor(this.duration % 60)
                    if (second < 10)
                    {
                        second = '0' + second;
                    }
                    document.getElementById('song_time').innerHTML = Math.floor(this.duration / 60) + ':' + second;

                });
                $('.audioDemo').trigger('play');
                $scope.intervalId = $interval(function () {
                    var p = $(".audioDemo").prop("currentTime");
                    p = (100 * p) / $scope.total_second;
                    t.value = p;
                }, 1 / 1000);
            }
        };
    });
</script>

<?php $view['slots']->stop('body') ?>