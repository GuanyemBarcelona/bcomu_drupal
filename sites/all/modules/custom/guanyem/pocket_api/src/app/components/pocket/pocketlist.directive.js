angular.module('bcomupocket')
.directive('pocketList', function(APP_CONFIG){
    return {
        restrict: 'E',
        replace: true,
        templateUrl: APP_CONFIG.baseHref + '/app/components/pocket/pocketlist.directive.html',
        controller: 'pocketlistCtrl',
        scope: {}
    };
});