<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || Login') ?>
<?php $view['slots']->start('body') ?>
<!-- Body Part Start-->
    	<div class="body_wrap" ng-controller="loginController">
            <div class="col-lg-11 col-sm-11 fix_width11 less_rt rt_border">
            	<div class="all_list_wrap nano" id="all_list_wrap">
                	<div class="nano-content">
                        <h2>(what apple music should have been )<span>-Ive would agree</span></h2>
                        <p>&nbsp;</p>
                        <ul>
                           <li ng-repeat="musicFeed in musicFeeds| limitTo:numberOfFeeds">{{musicFeed.log_date}}: {{musicFeed.details}}</li>
                            <div class="clearfix"></div>
                        </ul>
                        <p>&nbsp;</p>
                        <div class="more_list">
                            <div class="arrow"><a href="javascript:void(0);"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/down_arrow.png');?>" alt="Arrow" class="img-responsive" ng-click="showMore();"/></a></div>
                        </div>
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
            $( ".slider" ).slider({
                    range: false,
                    values: [ 0,17]
            });
            /* for Auto fit Scroll for songlist & audiolist */
            $("#all_list_wrap").css('height',($( window ).height()-85));
            $(".nano").nanoScroller();
        });
    </script>
<script>
    //var app = angular.module('siteLogin', []);
    app.controller('loginController', function ($scope) {
        $scope.numberOfFeeds = 2;//Initial feed Limit
        $scope.musicFeeds = <?php echo $info; ?>;
        $scope.showMore = function () {
            $scope.numberOfFeeds = $scope.numberOfFeeds + 2;
        };
    });
</script>
<?php $view['slots']->stop() ?>
