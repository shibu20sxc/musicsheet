<?php $view['slots']->start('upload_footer') ?>
<?php $userData = $app->getSession()->get('users_session'); ?>

<!-- Footer Part Start-->
<div class="footer_wrap">
    <div class="col-lg-4 col-sm-4">
        <input type="button" value="" class="foooter_search_btn" />
        <input type="text" name="search" ng-model="songSearch" id="search" placeholder="Search" class="foooter_search Show_button" autocomplete="off" />
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-5 col-sm-5">
<!--        <div class="footer_button_wrap">
            <input type="button" class="foot_btn" value="Video" />
            <input type="button" class="foot_btn" value="User" />
            <input type="button" class="foot_btn active" value="Songs" />
            <div class="clearfix"></div>
        </div>-->
        <div class="upload_btn_wrap">
            <input type="button" class="upload_btn" value="upload" id ="footer_upload_btn"/>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="footer_nav">
        <ul>
            <li><a href="<?php echo $view['router']->generate('_fornt_play_music'); ?>">Sheet<br /> Music</a></li>
            <?php if (empty($userData)) { ?>
                <li class="odd_li"><a href="javascript:void(0);" class="login_nav">Sign In</a></li>
            <?php } else { ?>
                <li><a href="javascript:void(0);" class="Show_My_Div">
                        <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/signin_logo.png'); ?>" alt="Logo" class="img-responsive pull-right" style="width:48px; position:absolute; right:3%; bottom:20%;" />
                    </a></li>
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
<div class="clearfix"></div>
<!-- Footer Part End-->

<script>
    $(document).ready(function () {
        $('.Show_My_Div').click(function () {
            //alert('hiii');
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
<?php $view['slots']->stop('upload_footer') ?>

