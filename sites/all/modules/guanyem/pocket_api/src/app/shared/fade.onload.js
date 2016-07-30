angular.module('bcomupocket')
.directive('fadeOnload', function(){
    return {
        restrict: 'A',
        link: function($scope, $elem, $attrs) {
            $elem.addClass('image-fader');
            $elem.addClass('ng-hide-remove');
            $elem.on('load', function(e) {
                $elem.addClass('ng-hide-add');
            });
        }
    };
});