<?php $view['slots']->start('common_footer') ?>
<!-- Footer Part Start-->
<?php $userData = $app->getSession()->get('users_session'); ?>
<div class="footer_wrap">
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

<script>
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
<?php $view['slots']->stop('common_footer') ?>

