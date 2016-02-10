<?php $view->extend('FrontBundle::advertisement_layout.html.php') ?>
<?php $view['slots']->set('title', 'Sheet Music | Advertisements ') ?>
<?php $view['slots']->start('body') ?>   
<!-- Body Part Start-->
<div class="body_wrap">
    <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
        <div class="nano" id="ads">
            <div class="nano-content">
                <div class="col-lg-4 col-sm-4">
                    <div class="ads_wrap">                    	
                        <div class="option">option 1</div>
                        <div class="info">
                            audio/banner/video<br />$3000/month flat fee (31days)<br />you may change your ad anytime you want
                        </div>
                        <div class="example">
                            [ <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" onclick = "return optionBtnSelect(1);">see example</a> ]
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="ads_wrap">                    	
                        <div class="option">option 2</div>
                        <div class="info">
                            audio/banner/video<br />ppc, ppi if video or audio
                        </div>
                        <div class="example">
                            [ <a href="javascript:void(0);" data-toggle="modal" data-target="#myModa2" onclick = "return optionBtnSelect(2);">see example</a> ]
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="ads_wrap">

                        <div class="option">option 3</div>
                        <div class="info">
                            audio/banner/video/ppi
                        </div>
                        <div class="example">
                            [ <a href="javascript:void(0);" data-toggle="modal" data-target="#myModa3" onclick = "return optionBtnSelect(3);">see example</a> ]
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>


                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">                          
                            <div class="modal-body">
                                <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/option1.jpg'); ?>" alt="Ads" class="img-responsive" width="100%" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">                         
                            <div class="modal-body">
                                <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/option2.jpg'); ?>" alt="Ads" class="img-responsive" width="100%" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="myModa3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/option3.jpg'); ?>" alt="Ads" class="img-responsive" width="100%" />
                            </div>
                        </div>
                    </div>
                </div>



                <div class="ads_form_wrap">
                    <form class="form-horizontal" method = "post" action = "">

                        <div class="form-group email_class">
                            <label class="col-sm-3 control-label contact_email" style="font-weight:normal;">your email</label>
                            <div class="col-sm-9 con_comment">
                                <input type="text" class="form-control email_1" id="ademail" name="ademail">
                            </div>
                            <span id="email_error" style="color: red;margin-left: 190px;"></span>
                        </div>
                        <input type="hidden" id = "option_hid_value" value = "1" name = "option">
                        <div class="form-group comment_class">
                            <label class="col-sm-3 control-label" style="font-weight:normal;">question/comment</label>
                            <div class="col-sm-9">
                                <textarea name = "adqu" class="form-control ad_text_area" id="messsage" rows="5"></textarea>
                                <input type="submit" class="btn btn-default option_btn pull-left option_submit" id="comment_id" value="Submit">
                            </div>
                            <span id="mess_error" style="color: red;margin-left: 190px;"></span>
                        </div>
                        <?php
                        if (isset($_GET['msg_success'])) {
                            echo '<span style = "color: green;">' . $_GET['msg_success'] . '</span>';
                        } else if (isset($_GET['msg_error'])) {
                            echo '<span style = "color: red;">' . $_GET['msg_error'] . '</span>';
                        }
                        ?>
                        <div class="clearfix"></div>

                    </form>
                </div>
                <div class="clearfix"></div>
            </div></div>
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
    <div class="hint">or email me directly at greybubblegum@gmail.com if you haven’t gotten a replied within 7 days</div>
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

<div class="clearfix"></div>
</div>

</body>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery-ui.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('SheetMusic/front/js/jquery.nanoscroller.js'); ?>"></script>
<script type = "text/javascript">
                                function optionBtnSelect(option) {
                                    //alert(option);
                                    $("#option_hid_value").val(option);
                                }
</script>
<script type="text/javascript">



    $('#comment_id').click(function () {
        var email = $('#ademail').val();
        var message = $('#messsage').val();
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var emailvalid = emailReg.test(email); //returns true & false
        
        if(emailvalid){
            $('#email_error').html('');
            if(message != ''){
                 $('#mess_error').html('');
                return true;
            }else{
                $('#mess_error').html('Message empty . Please fill it.');
                    return false;
            }
        }else{
            $('#email_error').html('Invalid Email.');
            return false;
        }
    });

    $(".slider").slider({
        range: false,
        values: [0, 17]
    });


    /* for Auto fit Scroll for songlist & audiolist */
    $("#ads").css('height', ($(window).height() - 85));
    $("#audio_control_wrap").css('height', ($(window).height() - 85));


    $(window).on("orientationchange", function () {
        //alert("The orientation has changed!");
        $("#ads").css('height', ($(window).height() - 85));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));
    });
    $('.Show_My_Div').click(function () {
        $("#usetting").toggle(300);
    });
    $('.col-lg-11').click(function () {
        $("#usetting").hide(300);
    });

    $(".nano").nanoScroller();


</script>
<?php $view['slots']->stop() ?>
