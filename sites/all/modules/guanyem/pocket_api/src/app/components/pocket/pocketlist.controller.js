angular.module('bcomupocket')
.controller('pocketlistCtrl', function($scope, pocketServ){
    var self = this;

    $scope.itemsPerPage = 24;
    $scope.fullList = [];
    $scope.ready = false;
    $scope.listLoading = false;
    $scope.minSearchLength = 2;
    $scope.maxItems = -1;
    $scope.tagsList = [];
    $scope.currentTags = [];

    $scope.loadList = function(){
        if ($scope.maxItems == -1){
            // maxItems not set
            $scope.listLoading = true;
            pocketServ.getCount(function(data){
                //$scope.listLoading = false;
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

    $scope.tagIsSelected = function(tagname){
        return ($scope.currentTags.indexOf(tagname) != -1);
    };

    $scope.chooseTag = function(tagname){
        $scope.fullList = [];
        var ind = $scope.currentTags.indexOf(tagname);
        if (ind == -1){
            // tag not found, add it
            $scope.currentTags.push(tagname);
            
        }else{
            // tag found, remove it
            $scope.currentTags.splice(ind, 1);
        }
        $scope.loadTaggedList();
    };

    $scope.loadTaggedList = function(){
        if ($scope.currentTags.length > 0){
            // there are tags to filter, load the tagged data
            $scope.listLoading = true;
            pocketServ.getTaggedBy($scope.currentTags, function(data){
                $scope.listLoading = false;
                if (data.status == 200){
                    for (var i in data.data){
                        $scope.fullList.push(data.data[i]);
                    }
                }
            });
            return true;
        }
        // there are no tags to filter, do the normal data loading
        $scope.loadListProcess();
        return false;
    };

    $scope.loadTags = function(){
        pocketServ.getTags(function(data){
            if (data.status == 200){
                $scope.tagsList = data.data;
            }
        });
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