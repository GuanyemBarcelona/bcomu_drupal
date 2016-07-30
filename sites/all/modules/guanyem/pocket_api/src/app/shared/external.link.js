angular.module('bcomupocket')
.directive('externalLink', function(){
    return {
        restrict: 'A',
        link: function($scope, $elem) {
            $elem.attr('target', '_blank');
        }
    };
});