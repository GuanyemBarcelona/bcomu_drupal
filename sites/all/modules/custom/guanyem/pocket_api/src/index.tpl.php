<div ng-app="bcomupocket" ng-controller="appCtrl" data-base-href="<?php print $base_path ?>">
    <link rel="stylesheet" href="<?php print $base_path ?>/assets/css/styles.css">

    <!-- Load Js libs -->
    <script src="<?php print $base_path ?>/bower_components/angular/angular.min.js"></script>
    <script src="<?php print $base_path ?>/bower_components/angular-route/angular-route.min.js"></script>
    <script src="<?php print $base_path ?>/bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script src="<?php print $base_path ?>/bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="<?php print $base_path ?>/bower_components/ngInfiniteScroll/build/ng-infinite-scroll.min.js"></script>

    <!-- The APP Js -->
    <script src="<?php print $base_path ?>/assets/js/app.min.js"></script>

    <div class="mainContent" ng-view></div>
</div>
