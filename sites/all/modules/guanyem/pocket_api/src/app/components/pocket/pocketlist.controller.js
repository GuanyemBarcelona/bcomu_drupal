angular.module('bcomupocket')
.controller('pocketlistCtrl', function($scope, pocketServ){
    var self = this;

    $scope.itemsPerPage = 24;
    $scope.fullList = [];
    $scope.ready = false;
    $scope.listLoading = false;
    $scope.minSearchLength = 2;
    $scope.maxItems = -1;
    $scope.originalTagsList = [];
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

    $scope.chooseTag = function(tagname, count){
        if (count > 0){
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
        }
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
                    $scope.refreshTagList();
                }
            });
            return true;
        }
        // there are no tags to filter, do the normal data loading
        $scope.loadListProcess();
        $scope.tagsList = angular.copy($scope.originalTagsList);
        return false;
    };

    /*
    * Refresh the tags list counts (items) after loadTaggedList data (items) has been received
    + so we know which of these items have whatever tags
    */
    $scope.refreshTagList = function(){
        var itemsPerTag = [];
        angular.forEach($scope.fullList, function(item, key) {
            angular.forEach(item.tags, function(tag, key2) {
                if (angular.isUndefined(itemsPerTag[tag.tag])){
                    itemsPerTag[tag.tag] = 1;
                }else{
                    itemsPerTag[tag.tag]++;
                }
            });
        });

        angular.forEach($scope.tagsList, function(tag, key) {
            if (angular.isUndefined(itemsPerTag[key])){
                $scope.tagsList[key].count = 0;
            }else{
                $scope.tagsList[key].count = itemsPerTag[key];
            }
        });
    };

    $scope.loadTags = function(){
        pocketServ.getTags(function(data){
            if (data.status == 200){
                $scope.originalTagsList = data.data;
                $scope.tagsList = angular.copy($scope.originalTagsList);
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