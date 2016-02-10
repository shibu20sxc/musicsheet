<?php $view->extend('FrontBundle::music_layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || Music Display') ?>
<?php $view['slots']->start('body') ?>   
<!-- Body Part Start-->
<div class="body_wrap" ng-controller="musicDisplay">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border" id="video_ads_wrap">
        <div class="col-lg-3 col-sm-3">
            <div class="song_list nano" id="songlist">
                <ul class="nano-content" style="padding-top:30px;">
                    <?php
                    $rand_ad_ty = rand(1, 2);
                    $rand_ad_on = rand(1, 2);
                    if ($rand_ad_on == 1) {
                        if ($rand_ad_ty == 1) {
                            echo '<li>
                            	<img src="' . $view['assets']->getUrl('uploads/advertisements/') . $advertisement1[0]['advertisements'] . '" alt="Advertisment" class="img-responsive double_add" />
                            </li>';
                        } else {
                            echo '<li>
                            	<img src="' . $view['assets']->getUrl('uploads/advertisements/') . $advertisement2[0]['advertisements'] . '" alt="Advertisment" class="img-responsive singel_add" />
                            </li>';
                        }
                    }
                    ?>  

                    <li ng-repeat="result in results| filter: songSearch">
                        <div class="song_wrap">
                            <h2>{{result.song}}<span><a href="javascript:void(0);">(buy)</a></span></h2>
                            <h3>{{result.artist}}</h3>
                        </div>
                        <div class="song_catgory">
                            <ul>
                                <li ng-repeat="category in categories" ><a href="javascript:void(0);" ng-click="familySoundClick(category.id, result.song);">{{category.name}}</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>
        </div>
        <div class="col-lg-2 col-sm-2">
            <div class="instrument_wrap_default" id = "family_sound">
                <ul>
                    <li ng-repeat="instrument in instruments"><a href="javascript:void(0);" ng-click="filters.name = instrument.name" >{{instrument.name}}</a></li>
                </ul>
            </div>            
        </div>        
        <div class="col-lg-7 col-sm-7">
            <div class="audio_control_wrap nano" id="music_songs"> 
                <input type="hidden" id="music_family" value="<?php if(isset($family_id)){ echo $family_id; }?>"/>
                <input type="hidden" id="songs_name" value="<?php if(isset($songs_name)) { echo $songs_name;} ?>"/>
                <ul class="nano-content" style="padding-top:30px;">
                    <li ng-repeat="playlist in playlists| filter:filters ">
                        <div class="heading"><span><a style="color: #404041;" href="javascript:void(0);" ng-click="seeAdvertisements(playlist.id);">{{playlist.username}}: {{playlist.song}}</a></span></div>
                        <ul>                         
                            <li>{{playlist.hits}} views</li>
                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_{{playlist.id}}">Preview</a></li>
                            <li ng-if="playlist.video != ''"><a href="{{url_video}}{{playlist.id}}/{{family}}?songs={{songs_name}}" ng-click="watchVideo(playlist.id);">Watch</a></li>
                            <li ng-if="playlist.video == ''"><a style="color:#cfcfcf;" href="javascript:void(0);">Watch</a></li>
                        </ul>

                        <div class="clearfix"></div>
                        <input type="range" min=0 max=100 value=0 id="slider_{{$index}}" class="sound_bar" />
                        <div class="song_time" id="song_time_{{$index}}">{{playlist.songs_duration}}</div>
                        <div class="song_play"><a href="javascript:void(0);" ng-click="play(playlist, $index);" id="play_{{$index}}" class="play" songs-src="<?php echo $view['assets']->getUrl('uploads/songs/'); ?>{{playlist.music}}">[Play]</a></div>
                        <div class="clearfix"></div>
                    </li>                

                </ul>
                <audio class="audioDemo" controls preload="none" id="audioDemo" style="display:none" src=""> </audio>
                <div class="clearfix"></div>

            </div>

        </div> 
        <div class="clearfix"></div> 
        <div id="add_div_video">
            
        <div ng-repeat="playlist in playlists">            
            <div class="video_ads_wrap" style="display:none;" id="video_advertisement_{{playlist.id}}">               
                <div class="nano" id="video_ads_wrap">                    
                    <div class="nano-content">
                        <a href="{{url_const}}{{playlist.id}}/{{family}}?songs={{songs_name}}" title="Skip Ads" style="color: #FFF;float: right; display:none;text-decoration: none;font-weight: bold;padding: 20px;" id="skip_button">Skip</a>
                        <a href="javascript:void(0);" title="Close Ads" style="color: #FFF;float: right; padding: 20px; text-decoration: none;font-weight: bold;" ng-click="closeAddBtn(playlist.id)">X</a>
                        <div class="video">
                            <iframe width="100%" id="iframeID_{{playlist.id}}" height="380" src="" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="music_sheet">
                            <img src="<?php echo $view['assets']->getUrl('uploads/music/'); ?>{{playlist.music_sheet_name}}" alt="{{playlist.music_sheet_name}}" class="img-responsive" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal -->
    <div ng-repeat="playlist in playlists">
        <div class="modal fade" id="myModal_{{playlist.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{playlist.song}}</h4>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo $view['assets']->getUrl('uploads/music/'); ?>{{playlist.music_sheet_name}}" alt="{{playlist.music_sheet_name}}" class="img-responsive" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1 col-sm-1 fix_width1 mob_display">
        &nbsp;
    </div>
    <div class="clearfix"></div>
</div>

<div class="notification_wrap" id="notify"  style="display:none;" ng-controller="dashboardSubs">
    <ul>
        <li ng-repeat="subscription in subscriptions">
            <a href="#"><span class="name">{{subscription.name}}</span> <span class="upoload">uploaded</span> {{subscription.details}}</a>
        </li>

    </ul>
    <input type="button" value="Exit" class="exit" />
</div>


<!-- Body Part End-->
<script type="text/javascript">
    
    
    $(document).ready(function () {      

        /* for Auto fit Scroll for songlist & audiolist */
        $("#songlist").css('height', ($(window).height() - 95));
        $("#music_songs").css('height', ($(window).height() - 95));
        $("#video_ads_wrap").css('height',($( window ).height()-101));

        $(window).on("orientationchange", function () {
            //alert("The orientation has changed!");
            $("#songlist").css('height', ($(window).height() - 95));
            $("#music_songs").css('height', ($(window).height() - 95));
            $("#video_ads_wrap").css('height',($( window ).height()-101));
        });        
    });    
    app.controller('dashboardSubs', function ($scope) {
        $scope.subscriptions = <?php echo $subscription_details; ?>;

    });
    app.controller("musicDisplay", function ($scope, $http, $interval) {          
        $scope.family = $('#music_family').val();                
        $scope.songs_name = $('#songs_name').val();
        //alert($scope.family);
        $scope.filters = {};
        $scope.categories = "";
        $scope.instruments = "";
        $scope.url_const = "<?php echo $view['router']->generate('_fornt_sheet_music_details', array('id' => '-9999','family'=>'-9999','song'=>'-9999')) ?>";
        var str = $scope.url_const;
        $scope.url_const = str.substring(0, ($scope.url_const.length - 22));
        
        $scope.url_video = "<?php echo $view['router']->generate('_fornt_play_video', array('id' => '-9999','family'=>'-9999','song'=>'-9999')) ?>";
        var strv = $scope.url_video;
        $scope.url_video = strv.substring(0, ($scope.url_video.length - 22));
        
        $scope.results = <?php echo $songs; ?>;

        <?php if (!empty($category)) { ?>
            $scope.categories = <?php echo $category; ?>;
            $scope.families = <?php echo $songs_family; ?>;
        <?php } ?>
        $scope.familySoundClick = function (family, songs) {         
            $('#music_family').val(family);
            $('#songs_name').val(songs);
            $scope.family = family;
            $scope.songs_name = songs; 
                       
            /* This code is written by Prasenjit Mukherjee */
            $scope.instruments = "";
            var data = $.param({
                family: family,
                songs: songs
            });
            $http({
                method: "POST",
                url: "<?php echo $view['router']->generate('_ajax_search_family_sound') ?>",
                data: {
                    family: family,
                    songs: songs
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response, status) {
                if(response != ''){
                     $('#family_sound').removeClass("instrument_wrap_default");
                     $('#family_sound').addClass("instrument_wrap");
                }else{
                    $('#family_sound').addClass("instrument_wrap_default");
                    $('#family_sound').removeClass("instrument_wrap");
                }
                $scope.instruments = response;
                $scope.playlists = response;
            });
        }
        if($scope.family != '' && $scope.songs_name != '') {
           // alert($scope.family);
        $scope.familySoundClick($scope.family,$scope.songs_name);
        }
        $scope.watchVideo = function(id){
        //alert(id);
        };

        $scope.play = function (e, index) {

            $interval.cancel($scope.intervalId);
            var t = document.getElementById('slider_' + index);
            $scope.start_stop = document.getElementById('play_' + index).innerHTML;
            //alert($scope.start_stop);
            if (!angular.equals($scope.start_stop, '[Play]'))
            {
                //alert(angular.equals($scope.start_stop, '[Play]'));

                document.getElementById('play_' + index).innerHTML = '[Play]';
                $interval.cancel($scope.intervalId);
                t.value = 0;
                $(".audioDemo").trigger('pause');

                $(".audioDemo").prop("currentTime", 0);

            }
            else {
                //  alert('Hi');
                document.getElementById('play_' + index).innerHTML = '[Stop]';
                $scope.song_link = '<?php echo $view['assets']->getUrl('uploads/songs/'); ?>' + e.music;
                //alert(e.music);
                $('.audioDemo').attr('src', $scope.song_link);
                $('#audioDemo').on("canplay", function () {
                    $scope.total_second = this.duration;
                    //alert(this.duration);
                    second = Math.floor(this.duration % 60)
                    if (second < 10)
                    {
                        second = '0' + second;
                    }
                    document.getElementById('song_time_' + index).innerHTML = Math.floor(this.duration / 60) + ':' + second;

                });
                $('.audioDemo').trigger('play');
                $scope.intervalId = $interval(function () {
                    var p = $(".audioDemo").prop("currentTime");
                    p = (100 * p) / $scope.total_second;
                    t.value = p;
                }, 1 / 1000);
            }
        };
        
        $scope.seeAdvertisements = function(songs_id){
        $(".nano").nanoScroller();
            $scope.ytsrc = '';
            <?php  if(!empty($advertisement4[0]['advertisements'])){ ?>
                    $scope.ytsrc = '<?php echo $advertisement4[0]['advertisements']; ?>';                   
            <?php } ?>
                
            var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
            var youtubeid = reg.exec($scope.ytsrc)[1]            
            //alert(youtubeid);          
            $.ajax({                    
                    type: "POST",
                    url: "<?php echo $view['router']->generate('_youtube_video_duration') ?>",
                    data: {
                        youtubeid: youtubeid,                        
                    },
                    success: function (response) {
                        var totaltime_in_sec = parseInt(response);
                        //alert(totaltime_in_sec);
                        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                            window.location.href = $scope.url_const+songs_id+'/'+$scope.family+'?songs='+$scope.songs_name;
                        }, totaltime_in_sec*1000);
                        
                       
                        window.setTimeout(function(){
                            // Move to a new location or you can do something else
                             $('#skip_button').show('slow');
                        }, 5000);
                        
                    }
                    
                    
                });
            
            
            $('#iframeID_'+songs_id).removeAttr("src","");
            $('#iframeID_'+songs_id).attr("src", $scope.ytsrc);
            $('#video_advertisement_'+songs_id).show();
            $('#iframeID_'+songs_id).attr("src","<?php echo $advertisement4[0]['advertisements'];?>");
  
        }
        $scope.closeAddBtn = function(songs_id){        
            $('#video_advertisement_'+songs_id).hide();
            $('#iframeID_'+songs_id).removeAttr("src","");
        }
        
    });
</script>
<?php $view['slots']->stop('body') ?>    
