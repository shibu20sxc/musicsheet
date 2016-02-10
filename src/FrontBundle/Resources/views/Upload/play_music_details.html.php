<?php $view->extend('FrontBundle::music_details_layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || Music Details') ?>
<?php $view['slots']->start('body') ?>   
<!-- Body Part Start-->
<?php //print_r($songs);?>
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border" id="musicsheet">
        <a href = "<?php echo $view['router']->generate('_fornt_play_music'); ?>?family=<?php echo $music_family;?>&songs_name=<?php echo $songsName;?>" ><input type="button" class="btn_back" value="< back" /></a>
        <a href = "<?php echo $view['router']->generate('_fornt_play_video', array('id' => $songs[0]['id'])); ?>" ><input type="button" class="btn_back pull-right" value="Video >" /></a>
        <div class="nano">
            <div class="nano-content">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">                 
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        if (!empty($songs)) {
                            foreach ($songs as $key => $song) {
                                if ($key == 0) {
                                    echo '<div class="item active">';
                                } else {
                                    echo '<div class="item">';
                                }
                                ?> 
                        
                        <?php if(!empty($song['music_sheet'])) { ?>
                                <img src="<?php echo $view['assets']->getUrl('uploads/music/') . $song['music_sheet']; ?>" alt="Music Sheet" class="img-responsive">
                           
                        <?php } else { ?>
                                
                                <h1>Ooppp's "<?php echo $song['song']?>" - Music Sheet is not available..</h1>
                        <?php } ?>
                    </div>
                            <?php
                        }
                    }
                    ?>
                </div> 
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $userData = $app->getSession()->get('users_session'); ?>
<div class="col-lg-1 col-sm-1 fix_width1 mob_display">
    &nbsp;
    <?php if (!empty($userData)) { ?>
        <div class="rt_info"><a href="<?php echo $view['router']->generate('_fornt_music_details_report', array('id' => $songs[0]['id'])); ?>">info</a></div>
    <?php } ?>
</div>
<div class="clearfix"></div>

<!-- Body Part End-->
<!-- Footer Part Start-->
<?php
$userData = $app->getSession()->get('users_session');
//print_r($userData['login_users_id']);
?>
<input type="hidden" name="user_login_id" id="user_login_id" value="<?php echo $userData['login_users_id']; ?>"/>
<input type="hidden" name="user_songs_id" id="user_songs_id" value="<?php echo $songs[0]['id']; ?>"/>
<div class="footer_wrap" ng-controller="playSingleSong">
    <div class="col-lg-3 col-sm-3">
        <!--<input type="button" value="" class="foooter_search_btn" />-->
        <!--<input type="text" name="search" id="search" placeholder="Search" class="foooter_search" />-->
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

<script>
    function slideChange(state) {
        var totalVal = $('#total_slide').val();
        var a = $('#new_val').val();
        var new_val = parseInt(a);
        if (state == 'next') {
            if (new_val < totalVal) {
                new_val = new_val + 1;
                $('#new_val').val(new_val);
                $('#change_value').html();
                $('#change_value').html(new_val);
            } else {
                $('#new_val').val('1');
                var a = $('#new_val').val();
                var new_val = parseInt(a);
                $('#change_value').html();
                $('#change_value').html(new_val);
            }
        }

        if (state == 'prev') {
            var a = $('#new_val').val();
            var last_page_val = parseInt(a);
            if (last_page_val == 1) {
                $('#new_val').val(totalVal);
                $('#change_value').html(totalVal);
                $('#new_prev_val').val(totalVal);
            } else {
                var a = $('#new_val').val();
                var last_page_val = parseInt(a);
                if (last_page_val <= totalVal) {

                    last_page_val = last_page_val - 1;

                    $('#new_val').val(last_page_val);
                    $('#change_value').html(last_page_val);
                    $('#new_prev_val').val(last_page_val);
                }
            }
        }
    }

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


    $(document).ready(function () {
        $('.Show_My_Div').click(function () {

            $("#usetting").toggle(300);
        });
        $('.col-lg-11').click(function () {
            $("#usetting").hide(300);
        });

        $('.Show_notify').click(function () {

            $("#notify").fadeIn(300);
        });

        $('.exit').click(function () {
            $("#notify").fadeOut(300);

        });
        $(".nano").nanoScroller();

    });
</script>
<!-- Footer Part End-->
<script type="text/javascript">

    $(document).ready(function () {
        /* Initiate to the start position of all scroll */
        $(".slider").slider({
            range: false,
            values: [0, 0]
        });
        intervalId = 0;

        /* for Auto fit Scroll for songlist & audiolist */
        $("#musicsheet").css('height', ($(window).height() - 85));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));


        $(window).on("orientationchange", function () {
            //alert("The orientation has changed!");
            $("#musicsheet").css('height', ($(window).height() - 85));
            $("#audio_control_wrap").css('height', ($(window).height() - 85));
        });

        $(".nano").nanoScroller();

    });

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
</script>

<?php $view['slots']->stop('body') ?>    
