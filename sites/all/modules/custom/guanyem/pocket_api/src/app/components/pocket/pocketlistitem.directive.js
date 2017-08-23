angular.module('bcomupocket')
.directive('pocketListItem', function(APP_CONFIG){
    return {
        restrict: 'E',
        replace: true,
        templateUrl: APP_CONFIG.baseHref + '/app/components/pocket/pocketlistitem.directive.html'
    };
});