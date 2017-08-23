angular.module('bcomupocket')
.service('pocketServ', function ($http){
    var self = this;

    self.apiEndpoint = '/api/pocket';

    self.getData = function(uri, cb){
        $http({
            method: 'GET',
            url: uri,
            headers: {
                'Content-Type': 'application/json; charset=utf-8'
            }
        }).then(cb);
    };

    self.getCount = function(cb){
        self.getData(self.apiEndpoint + '/getcount', cb);
    };

    self.getList = function(count, offset, cb){
        self.getData(self.apiEndpoint + '/getlist/' + count + '/' + offset, cb);
    };

    self.getTags = function(cb){
        self.getData(self.apiEndpoint + '/gettags', cb);
    };

    /*
    * @param
    *   Array tagnames: expects an array of tagnames
    */
    self.getTaggedBy = function(tagnames, cb){
        var tags = encodeURIComponent(tagnames.join('+'));
        self.getData(self.apiEndpoint + '/gettaggedby/' + tags, cb);
    };

});