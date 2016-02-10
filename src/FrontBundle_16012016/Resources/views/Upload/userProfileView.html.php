<?php $view->extend('FrontBundle::advertisement_layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Play Video ') ?>
<?php $view['slots']->start('body') ?>     
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="col-lg-3 col-sm-3">
            <div class="tab_left_panel nano" id="savesong" ng-controller="songsController">
                <ul class="nano-content">
                    <li ng-repeat="result in results| filter:songSearch">
                        <div class="songs">{{result.song}}</div>
                        <div class="artist">by {{result.artist}}</div>                        
                        <div class="clearfix"></div>
                    </li>


                </ul>
            </div>
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
                    <div class="nano-content">&nbsp;</div>
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
<?php $userData = $app->getSession()->get('users_session'); ?>

<!-- Footer Part Start-->
<div class="footer_wrap">
    <div class="col-lg-3 col-sm-3">
        <input type="button" value="" class="foooter_search_btn" />
        <input type="text" name="search" autocomplete="off"  ng-model="songSearch" id="search" placeholder="Search" class="foooter_search Show_button" />
    </div>
    <div class="col-lg-6 col-sm-6">
        <div class="footer_button_wrap">
            <input type="button" class="foot_btn" id="savedSongsButton" value="Songs" />
            <input type="button" class="foot_btn" id="videoDisplayButton" value="Video" />
            <input type="button" class="foot_btn" value="<?php echo $user_name[0]['name'] ?>" />
            <div class="clearfix"></div>
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
        <?php if (!empty($userData)) { ?>
            <div class="notification_ico">
                <a href="javascript:void(0);" class="Show_notify"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/notify_ico.png'); ?>" alt="Notification" class="img-responsive" /></a>
            </div>
        <?php } ?>
    </div>
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
<div class="notification_wrap" id="notify"  style="display:none;" ng-controller="dashboardSubs">
    <ul>
        <li ng-repeat="subscription in subscriptions">
            <a href="#"><span class="name">{{subscription.name}}</span> <span class="upoload">uploaded</span> {{subscription.details}}</a>
        </li>

    </ul>
    <input type="button" value="Exit" class="exit" />
</div>
<div class="clearfix"></div>

<script type="text/javascript">

     app.controller('songsController', function ($scope) {
        $scope.results = <?php echo $uploadedSongs; ?>;
        //alert($scope.results);
    });
     app.config(function($sceDelegateProvider) {
     $sceDelegateProvider.resourceUrlWhitelist([
    'self','https://www.youtube.com/embed/*'
  ]);
});

app.controller('dashboardSubs', function ($scope) {
        $scope.subscriptions = <?php echo $subscription_details; ?>;

    });
    
    $(document).ready(function () {
        /* Initiate to the start position of all scroll */
        $(".slider").slider({
            range: false,
            values: [0, 0]
        });
        intervalId = 0;


        /* for Auto fit Scroll for songlist & audiolist */
        $("#savesong").css('height', ($(window).height() - 115));
        $("#audio_control_wrap").css('height', ($(window).height() - 110));
         $("#videoTabDisplay").css('height', ($(window).height() - 110));

        $(window).on("orientationchange", function () {
            //alert("The orientation has changed!");
            $("#savesong").css('height', ($(window).height() - 115));
            $("#audio_control_wrap").css('height', ($(window).height() - 110));
             $("#videoTabDisplay").css('height', ($(window).height() - 110));
        });

        $(".nano").nanoScroller();

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
        
         $('#savedSongsButton').click(function(){
            $('#savesong').show('slow');           
            $('#videoTabDisplay').hide('slow');
            $('#savedSongsButton').addClass('active');
            $('#videoDisplayButton').removeClass('active');           
            $(".nano").nanoScroller();           
        });
       
        $('#videoDisplayButton').click(function(){
            $('#videoTabDisplay').show('slow');
            $('#savesong').hide('slow');            
            $('#videoDisplayButton').addClass('active');            
            $('#savedSongsButton').removeClass('active');
            $(".nano").nanoScroller();           
            
        });

    });
            
</script>
<?php $view['slots']->stop('body') ?>

