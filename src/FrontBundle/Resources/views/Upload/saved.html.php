<?php $view->extend('FrontBundle::save_music_layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Saved Songs ') ?>
<?php $view['slots']->start('body') ?>    
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="col-lg-3 col-sm-3">
            <!--Songs tab display start-->
            <div class="tab_left_panel nano" id="savesong" ng-controller="songsController">

                <ul class="nano-content">
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
                    <li ng-repeat="result in results| filter:songSearch" id="songs_{{result.id}}">                        
                        <div class="songs">{{result.song}}</div>
                        <div class="artist">by {{result.artist}}</div>
                        <div class="liclose"><a href="javascript:void(0);" ng-click="removeSongs(result.id);"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/close_btn.png'); ?>" alt="Close" /></a></div>
                        <div class="clearfix"></div>                        
                    </li>

                </ul>
            </div>
            <!--Songs tab display End-->
            <!--User tab display start-->
            <div class="tab_left_panel nano" id="userTabDisply" ng-controller="songsController" style="display: none;">
                <ul class="nano-content">
                    <li ng-repeat="result in results| filter:songSearch">
                        <div class="songs">{{result.name}}</div>   

                        <div class="artist" id="" ng-repeat="song in result.songs| limitTo:result.numberOfSongs">{{song.song}}</div>                        
                        <div class="see_all"><a href="javascript:void(0);" ng-click="showMoreSongs($index)">(see all)</a></div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>
            <!--User tab display End-->
            <!--Video tab display start-->
            <div class="tab_left_panel nano" id="videoTabDisplay" ng-controller="songsController" style="display: none;">
                <ul class="nano-content">
                    <li ng-repeat="result in results| filter:songSearch">
                        <div class="songs">{{result.artist}} - {{result.song}}</div>
                        <div class="artist"><iframe width="100%" id="iframeID" height="100" ng-src="{{result.video}}" frameborder="0" allowfullscreen></iframe></div>
                        <div class="see_all">by {{result.name}}<br />{{result.hits}} Views</div>
                        <div class="clearfix"></div>
                    </li>


                </ul>
            </div>
            <!--Video tab display End-->
        </div>
        <div class="col-lg-9 col-sm-9">
            <div class="" id="song">
                <div class="tab_right_panel nano">
                    <div class="nano-content">
                        <?php
                        $rand_ad_ty = rand(1, 2);
                        $rand_ad_on = rand(1, 2);
                        if ($rand_ad_on == 1) {
                            if ($rand_ad_ty == 1) {
                                echo '
                                        <img src="' . $view['assets']->getUrl('uploads/advertisements/') . $advertisement3[0]['advertisements'] . '" alt="Advertisment" class="img-responsive" />
                                    ';
                            } else {
                                echo '
                                        <iframe width="100%" id="iframeID" height="100%;" ng-src="' . $advertisement4[0]['advertisements'] . '" frameborder="0" allowfullscreen></iframe>
                                    ';
                            }
                        }
                        ?>                        

                    </div>
                </div>
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
<script>

    app.controller('songsController', function ($scope) {
        $scope.results = <?php echo $songs; ?>;

        var i;
        for (i = 0; i < $scope.results.length; i++) {
            $scope.results[i].numberOfSongs = 2; // Initial Value Limit
        }

        $scope.showMoreSongs = function ($index) {
            $scope.results[$index].numberOfSongs++; // Increment Value Limit       

        };

        $scope.removeSongs = function (songs_id) {
            $.ajax({
                type: "POST",
                url: "<?php echo $view['router']->generate('_remove_saved_songs') ?>",
                data: {
                    songs_id: songs_id,
                },
                success: function (response) {
                    if(response){                        
                        $('#songs_'+songs_id).hide();
                    }

                }
            });
        };
    });

    app.config(function ($sceDelegateProvider) {
        $sceDelegateProvider.resourceUrlWhitelist([
            'self', 'https://www.youtube.com/embed/*'
        ]);
    });


    $(document).ready(function () {


        $('.Show_button').click(function () {
            $("#button_warp").fadeIn(300);
        });

        $('.footer_button_wrap').click(function () {
            $("#button_warp").fadeOut(300);

        });


        /* for Auto fit Scroll for songlist & audiolist */
        $("#savesong").css('height', ($(window).height() - 115));

        $("#userTabDisply").css('height', ($(window).height() - 110));
        $("#videoTabDisplay").css('height', ($(window).height() - 110));

        $("#song").css('height', ($(window).height() - 105));


        $(window).on("orientationchange", function () {
            //alert("The orientation has changed!");
            $("#savesong").css('height', ($(window).height() - 115));

            $("#userTabDisply").css('height', ($(window).height() - 110));
            $("#videoTabDisplay").css('height', ($(window).height() - 110));

            $("#song").css('height', ($(window).height() - 105));
        });

        $(".nano").nanoScroller();


        $('#savedSongsButton').click(function () {
            $('#savesong').show('slow');
            $('#userTabDisply').hide('slow');
            $('#videoTabDisplay').hide('slow');
            $('#savedSongsButton').addClass('active');
            $('#videoDisplayButton').removeClass('active');
            $('#userDisplayButton').removeClass('active');
            $(".nano").nanoScroller();
            //$('#search').attr("ng-model", "songSearch");
        });
        $('#userDisplayButton').click(function () {
            $('#userTabDisply').show('slow');
            $('#savesong').hide('slow');
            $('#videoTabDisplay').hide('slow');
            $('#userDisplayButton').addClass('active');
            $('#videoDisplayButton').removeClass('active');
            $('#savedSongsButton').removeClass('active');
            // $('#search').attr("ng-model", "userSearch");
            $(".nano").nanoScroller();

        });
        $('#videoDisplayButton').click(function () {
            $('#videoTabDisplay').show('slow');
            $('#savesong').hide('slow');
            $('#userTabDisply').hide('slow');
            $('#videoDisplayButton').addClass('active');
            $('#userDisplayButton').removeClass('active');
            $('#savedSongsButton').removeClass('active');
            $(".nano").nanoScroller();
            //$('#search').attr("ng-model", "videoSearch");

        });

    });

</script>
<?php $view['slots']->stop('body') ?>    
