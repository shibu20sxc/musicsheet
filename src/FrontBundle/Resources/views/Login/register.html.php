<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || Register') ?>
<?php $view['slots']->start('body') ?>
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="nano" id="registration">
            <div class="nano-content">
                <div class="col-lg-9 col-sm-9">
                    <div class="regis_form_wrap">
                        <form action="" method="POST" onsubmit="return checkUserRegister();">
                            <div class="form-group">
                                <input type="text" name="name" id="Username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" id="Email_address" placeholder="Email Address" onchange=" return checkEmail(this.value);">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="Password" placeholder="Password">

                            </div>
                            <div class="form-group">
                                <input type="password" name="repass" id="Confirm_email_address" placeholder="Confirm Password" onblur=" return checkPasswordConfirm();">
                            </div>
                            <p id="password_error" style="color: red;  position:absolute;left:57%; top:51%; text-align:center; "></p>
                            <span id="email_check"></span>
                            <input type="hidden" id="email_error"/>
                            <div class="clearfix"></div>
                            <div class="regis_btn_wrap">
                                <input type="submit" class="regis_btn" value="Sign Up" />                                
                                <div class="forget_btn_wrap"><a  href="<?php echo $view['router']->generate('_user_forget_password') ?>">Forgot Account</a></div>
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
                <div class="col-lg-3 col-sm-3 less_rt">
                    <div class="terms_wrap">
                        <div class="top_left">&nbsp;</div>
                        <div class="top_right">&nbsp;</div>
                        <div class="clearfix"></div>

                        <div class="bottom_left">&nbsp;</div>
                        <div class="bottom_right">
                            <p>I agree that I have read and understand the term and condition stated</p>
                            <div class="btn_wrap">                                
                                <div class="check_example">
                                    <div>
                                        <input id="terms_condition" type="checkbox" name="checkbox" value="1"><label for="checkbox1"><span></span></label>
                                    </div>
                                </div>
                                <div class="privacy_wrap">
                                    Terms of Privacy
                                    <div class="blank_border">&nbsp;</div>
                                    <div class="blank_border_bottom">&nbsp;</div>
                                </div>
                                <div class="agreement_wrap">
                                    Terms of Agreement
                                    <div class="blank_border">&nbsp;</div>
                                    <div class="blank_border_bottom">&nbsp;</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
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

<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function () {
        /* for Auto fit Scroll for songlist & audiolist */
        $("#registration").css('height', ($(window).height() - 85));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));
        $(".nano").nanoScroller();

    });

    function checkUserRegister() {

        var username = $("#Username").val();
        var email = $("#Email_address").val();
        var new_pass = $("#Password").val();
        var re_pass = $("#Confirm_email_address").val();
        var email_checkq = $("#email_error").val();
        var terms_condition = document.getElementById("terms_condition").checked;
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var emailvalid = emailReg.test(email); //returns true & false
        if (username != '' && email != '' && new_pass != '' && re_pass != '' && terms_condition != '') {
            if (emailvalid) {
                if (email_checkq != 'error_email_id')
                {
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

                } else {
                    $("#email_check").html('');
                    $("#email_check").html('<p style="color:red;">Email already registered with us.</p>');
                    return false;
                }
            } else {
                

                bootbox.dialog({
                    message: '<div class="row" style=" color:#666; font-size:18px; text-align:center;"> ' +
                            'Please provide valid email.' +
                            '</div>',
                }
                );
                return false;
            }
        } else {

            bootbox.dialog({
                message: '<div class="row" style=" color:#666; font-size:18px; text-align:center;"> ' +
                        'All fields are mandatory. Please fill all fields.' +
                        '</div>',
            }
            );
            return false;

        }
    }
    function checkEmail(email) {
        $.ajax({
            url: "<?php echo $view['router']->generate('ajax_user_login_check'); ?>",
            type: "POST",
            data: {
                email_id: email,
            },
            success: function (data) {
                if ($.trim(data) != 'success') {
                    $("#email_check").html("");
                    $("#email_check").html('<p style="color:red; position:absolute; top:57%;left:57%; text-align:center;">Email already registered.</p>');
                    $("#email_error").val('error_email_id');
                    return false;

                }
                else {

                    $("#email_check").html("");
                    $("#email_check").html('');
                    $("#email_error").val('');
                    return true;
                }
            }
        });
    }
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
<?php $view['slots']->stop() ?>
