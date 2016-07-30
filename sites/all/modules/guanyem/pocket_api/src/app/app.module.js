/**
* TODO:
- Fix baseHref bug
*/
angular.module('bcomupocket', ['ngRoute', 'ngSanitize', 'ngAnimate', 'infinite-scroll'])
.constant('APP_CONFIG', {
    baseHref: ''
})
.controller('appCtrl', function($attrs, APP_CONFIG){
    APP_CONFIG.baseHref = $attrs.baseHref;
})
.config(function ($httpProvider, $routeProvider) {
    $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/json'
    };

    //var baseHref = APP_CONFIG.baseHref;// TOFIX: this is done too soon
    var baseHref = '/sites/all/modules/guanyem/pocket_api/src';
    $routeProvider
        .when('/', {
            templateUrl: baseHref + '/app/components/pages/home.page.html'
        })

        .otherwise({redirectTo: '/'});
});