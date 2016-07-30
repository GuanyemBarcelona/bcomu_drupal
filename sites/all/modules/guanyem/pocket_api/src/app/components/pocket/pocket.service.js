angular.module('bcomupocket')
.service('pocketServ', function ($http){
    var self = this;

    self.apiEndpoint = '/api/pocket';

    self.getCount = function(cb){
        var uri = self.apiEndpoint + '/getcount';
        $http({
            method: 'GET',
            url: uri,
            headers: {
                'Content-Type': 'application/json; charset=utf-8'
            }
        }).then(cb);
    };

    self.getList = function(count, offset, cb){
        var uri = self.apiEndpoint + '/getlist/' + count + '/' + offset;
        $http({
            method: 'GET',
            url: uri,
            headers: {
                'Content-Type': 'application/json; charset=utf-8'
            }
        }).then(cb);
    };
});