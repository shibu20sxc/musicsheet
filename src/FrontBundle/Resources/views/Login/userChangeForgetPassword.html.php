<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Forget Password Change') ?>
<?php
$view['slots']->start('body');
if (isset($_GET['slug'])) {
    $hid = $_GET['slug'];
}
?>    
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="nano" id="registration">
            <div class="nano-content">
                <div class="col-lg-9 col-sm-9">
                    <div class="regis_form_wrap">
                        <form class="confirm_form" action="<?php echo $view['router']->generate('_user_forget_password_change'); ?>" method="POST" onsubmit="return checkPasswordConfirm();">                          
                            <div class="form-group">
                                <input type="password" name="password" id="Password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="repass" id="Confirm_email_address" placeholder="Confirm Password">
                            </div>
                            <input type="hidden" name="hid_id" value="<?php echo (isset($hid)) ? $hid : ''; ?>"/>
                            <span id="password_error" style="color: red;"></span>
                            <?php
                            if (isset($_GET['msg_success'])) {
                                echo "<span style = 'color: green;'>" . $_GET['msg_success'] . "</span>";
                            }
                            ?>
                            <div class="clearfix"></div>
                            <div class="forget_btn_wrap">
                                <input type="submit" class="forget_btn" value="Change Password" />                              
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">&nbsp;</div>

                <div class="clearfix"></div>

                <div class="col-lg-9 col-sm-9">
                    <div class="logo_wrap"><a href="/"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/logo.png'); ?>" alt="Aerl Nodus" class="img-responsive" /></a></div>
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
    </div>
    <div class="col-lg-1 col-sm-1 fix_width1 mob_display">
        &nbsp;
    </div>
    <div class="clearfix"></div>
</div>
<!-- Body Part End-->
<script type="text/javascript">
    $(document).ready(function () {
        /* for Auto fit Scroll for songlist & audiolist */
        $("#registration").css('height', ($(window).height() - 85));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));
        $(".nano").nanoScroller();
    });
    function checkPasswordConfirm() {
        var new_pass = $("#Password").val();
        var re_pass = $("#Confirm_email_address").val();
        if (new_pass != re_pass) {
            $("#password_error").html("Password does not match");
            return false;
        } else {
            var passReg = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
            var passwordvalid = passReg.test(new_pass);
            if (passwordvalid) {
                $("#password_error").html("");
                return true;
            } else {
                $("#password_error").html("The password at least 8 characters. Password must contain a special character, a Caps letter , a small letter and one number .");
                return false;
            }
        }
    }
</script>
<?php $view['slots']->stop('body') ?>

