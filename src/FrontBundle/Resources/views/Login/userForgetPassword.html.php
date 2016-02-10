<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || Forget Password') ?>
<?php $view['slots']->start('body') ?>
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="nano" id="registration">
            <div class="nano-content">
                <div class="col-lg-9 col-sm-9">
                    <div class="regis_form_wrap">
                        <form action="<?php echo $view['router']->generate('_user_forget_password'); ?>" method="POST" onsubmit="return checkvalidEmail();" class="forget_form">                            
                            <div class="form-group">
                                <input type="text" style="width:90%;margin: 0px auto;" name="email" id="Email_address"  placeholder="Email Address">                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="forget_btn_wrap" style="">                              
                                <input type="submit" class="forget_btn" value="Submit" style="width:100%" />
                                <div class="clearfix"></div>
                            </div>
                            <span id="email_check"></span>
                            <?php
                            if (isset($_GET['msg_success'])) {
                                echo "<span style = 'color: green;'>" . $_GET['msg_success'] . "</span>";
                            }
                            ?>
                            <?php
                            if (!empty($_GET['msg_error'])) {
                                echo "<span style = 'color: red;margin-left:100px; position:absolute; top:103px;' >" . $_GET['msg_error'] . "</span>";
                            }
                            ?>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">&nbsp;</div>

                <div class="clearfix"></div>

                <div class="col-lg-9 col-sm-9">
                    <div class="logo_wrap"><a href="#"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/logo.png'); ?>" alt="Aerl Nodus" class="img-responsive" /></a></div>
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


    function checkvalidEmail() {
        var email = $("#Email_address").val();
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var emailvalid = emailReg.test(email); //returns true & false
        if (email != '') {
            if (emailvalid) {
                return true;
            } else {
                alert('Please provide a valid email.');
                return false;
            }
        } else {
            alert('Please provide your registered email.');
            return false;
        }
    }

</script>
<?php $view['slots']->stop() ?>
