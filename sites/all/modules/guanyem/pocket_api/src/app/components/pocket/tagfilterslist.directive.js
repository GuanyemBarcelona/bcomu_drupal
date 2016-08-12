angular.module('bcomupocket')
.directive('tagFiltersList', function(APP_CONFIG){
    return {
        restrict: 'E',
        replace: true,
        templateUrl: APP_CONFIG.baseHref + '/app/components/pocket/tagfilterslist.directive.html',
        link: function(scope, elem, attr) {
            scope.loadTags();

            var $btn_all = elem[0].querySelector('[data-action="see-all-tags"]');
            $btn_all = angular.element($btn_all);
            $btn_all.text($btn_all.attr('data-text-more'));
            $btn_all.bind('click', function(e){
                elem.toggleClass('open');
                if (elem.hasClass('open')){
                    $btn_all.text($btn_all.attr('data-text-less'));
                }else{
                    $btn_all.text($btn_all.attr('data-text-more'));
                }
            });
        }
    };
});