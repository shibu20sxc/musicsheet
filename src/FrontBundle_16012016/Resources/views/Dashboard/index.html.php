<?php $view->extend('FrontBundle::layout.html.php') ?>
<?php $view['slots']->set('title', 'SheetMusic || News') ?>
<?php $view['slots']->start('body') ?>
<div class="body_wrap"  ng-controller="dashboardController">
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
                    <div class="arrow"><a href="javascript:void(0);"><img src="<?php echo $view['assets']->getUrl('SheetMusic/front/images/down_arrow.png'); ?>" alt="Arrow" class="img-responsive" ng-click="showMore();" /></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1 col-sm-1 fix_width1 mob_display">
        &nbsp;
    </div>
    <div class="clearfix"></div>
</div>
<div class="notification_wrap" id="notify"  style="display:none;" ng-controller="dashboardSubs">
    <ul>
        <li ng-repeat="subscription in subscriptions">
            <a href="#"><span class="name">{{subscription.name}}</span> <span class="upoload">uploaded</span> {{subscription.details}}</a>
        </li>

    </ul>
    <input type="button" value="Exit" class="exit" />
</div>
<!-- Body Part End-->
<div class="clearfix"></div>
<script type="text/javascript">
    $(".slider").slider({
        range: false,
        values: [0, 17]
    });
    $(document).ready(function () {
        /* for Auto fit Scroll for songlist & audiolist */
        $(".all_list_wrap").css('height', ($(window).height() - 85));
        $("#audio_control_wrap").css('height', ($(window).height() - 85));     
         $(".nano").nanoScroller();

    });
</script>
<script>
    app.controller('dashboardController', function ($scope) {
        $scope.numberOfFeeds = 2; //Initial feed Limit
        $scope.musicFeeds = <?php echo $info; ?>;

        $scope.showMore = function () {
            $scope.numberOfFeeds = $scope.numberOfFeeds + 2;

        };
    });


    app.controller('dashboardSubs', function ($scope) {
        $scope.subscriptions = <?php echo $subscription_details; ?>;

    });


</script>
<?php $view['slots']->stop() ?>
