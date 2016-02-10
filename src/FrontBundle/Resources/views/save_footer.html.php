<?php $view['slots']->start('save_footer') ?>
<!-- Footer Part Start aaaaa-->
<?php $userData = $app->getSession()->get('users_session'); ?>
<div class="footer_wrap">
    <div class="col-lg-3 col-sm-3">
<!--        <input type="button" value="" class="foooter_search_btn" />
        <input type="text" name="search" ng-model="songSearch" id="search" placeholder="Search" class="foooter_search Show_button" />
        <div class="clearfix"></div>-->
    </div>
    <div class="col-lg-6 col-sm-6">
         <?php if (!empty($userData)) { ?>
<!--        <div class="optional_footer">
            <div class="page0f pull-right"><a href="#">save</a></div>
        </div>-->
         <?php } ?>
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
    <div class="clearfix"></div>
    <?php if (!empty($userData)) { ?>
        <div class="rt_info"><a href="<?php echo $view['router']->generate('_fornt_music_details_report', array( 'id' => $songs[0]['id'] )); ?>">info</a></div>
    <?php } ?>

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
<?php $view['slots']->stop('save_footer') ?>

