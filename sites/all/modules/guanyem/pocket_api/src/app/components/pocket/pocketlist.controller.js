angular.module('bcomupocket')
.controller('pocketlistCtrl', function($scope, pocketServ){
    var self = this;

    $scope.itemsPerPage = 24;
    $scope.fullList = [];
    $scope.ready = false;
    $scope.listLoading = false;
    $scope.minSearchLength = 2;
    $scope.maxItems = -1;

    $scope.loadList = function(){
        if ($scope.maxItems == -1){
            // maxItems not set
            $scope.listLoading = true;
            pocketServ.getCount(function(data){
                $scope.listLoading = false;
                if (data.status == 200){
                    $scope.maxItems = parseInt(data.data);
                    if (angular.isNumber($scope.maxItems)){
                        $scope.loadListProcess();
                        return true;
                    }
                    return false;
                }
                return false;
            });
        }else{
            // maxItems already set
            if (angular.isNumber($scope.maxItems)){
                $scope.loadListProcess();
                return true;
            }
            return false;
        }
    };

    $scope.loadListProcess = function(){
        if ($scope.fullList.length == 0 || ($scope.maxItems > $scope.fullList.length + $scope.itemsPerPage)){
            $scope.listLoading = true;
            pocketServ.getList($scope.itemsPerPage, $scope.fullList.length, function(data){
                $scope.listLoading = false;
                if (data.status == 200){
                    for (var i in data.data){
                        $scope.fullList.push(data.data[i]);
                    }
                }
            });
        }
    };

    $scope.isListEmpty = function(){
        return ($scope.fullList.length == 0);
    };

    $scope.resetSearch = function(){
        $scope.searchText = '';
    };

    $scope.isThereTextToSearch = function(){
        return (!angular.isUndefined($scope.searchText) && $scope.searchText != '' && $scope.searchText.length >= $scope.minSearchLength);
    };

    $scope.showEmptySearchMessage = function(){
        return ($scope.isThereTextToSearch() && $scope.fullList.length == 0);
    };
});