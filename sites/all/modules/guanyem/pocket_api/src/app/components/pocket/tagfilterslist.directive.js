angular.module('bcomupocket')
.directive('tagFiltersList', function(APP_CONFIG){
    return {
        restrict: 'E',
        replace: true,
        templateUrl: APP_CONFIG.baseHref + '/app/components/pocket/tagfilterslist.directive.html',
        link: function(scope, elem, attr) {
            scope.loadTags();
        }
    };
});