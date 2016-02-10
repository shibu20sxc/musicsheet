<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || News') ?>
<?php $view['slots']->start('body') ?>
<!-- Body Part Start-->
<div class="body_wrap"  ng-controller="loginController">
    <div class="col-lg-11 col-sm-11 less_rt rt_border fix_width11">
        <div class="nano" id="login">
            <div class="nano-content">
                <div class="col-lg-9 col-sm-8" style="border:0px solid red;">
                    <div class="all_list_wrap">
                        <h2>(what apple music should have been )<span>-Ive would agree</span></h2>
                        <p>&nbsp;</p>
                        <ul>
                            <li class="animate-repeat" ng-repeat="musicFeed in musicFeeds| limitTo:numberOfFeeds">{{musicFeed.log_date}}: {{musicFeed.details}}</li>
                            <div class="clearfix"></div>
                        </ul>
                        <p>&nbsp;</p>
                        <div class="more_list">
                            <div class="arrow"><a href="javascript:void(0);"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/down_arrow.png'); ?>" alt="Arrow" class="img-responsive" ng-click="showMore();"/></a></div>
                        </div>

                    </div>
                    
                </div>
                <div class="col-lg-3 col-sm-4 less_rt">
                    <div class="login_blk_wrap mob_display">&nbsp;</div>

                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-1 col-sm-1 fix_width1 mob_display" style="position:relative;">
        &nbsp;           
    </div>
    <div class="clearfix"></div>
</div>
<!-- Body Part End-->


<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function () {
        /* for Auto fit Scroll for songlist & audiolist */
        $("#login").css('height', ($(window).height() - 90));
        $("#audio_control_wrap").css('height', ($(window).height() - 95));
        $(".nano").nanoScroller();
    });
</script>
<script>
    //var app = angular.module('siteLogin', []);
    app.controller('loginController', function ($scope,$rootElement) {
        $rootElement.data("$$ngAnimateState").running = false;
        $scope.numberOfFeeds = 10;//Initial feed Limit
        $scope.musicFeeds = <?php echo $info; ?>;
        $scope.showMore = function () {
            $scope.numberOfFeeds = $scope.numberOfFeeds + 10;
        };
    });
</script>
<?php $view['slots']->stop() ?>
