
project0001App
.controller('GroupsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngtGroupsResource = {
                header: [
                                { name : $translate.instant('name') }
                			, { status : $translate.instant('status') }
                			, { description : $translate.instant('description') }
                			, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.groupFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            $scope.find();
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();
        }
    };

    var Groups = $injector.get('Groups');

    $scope.find = function()
    {
        Groups.query(function(groups)
        {
            $scope.groups = groups;
            $scope.$emit('findLoaded', { data: groups });
            $scope.ngtGroupsResource.rows = $scope.groups;
            $scope.ngtGroupsResource.pagination = {
                page: 1,
                size: $scope.groups.length
            };
        });
    };

    $scope.findOne = function()
    {
        Groups.get({
            groupId: $stateParams.groupId
        }, function(group)
        {
            $scope.group = group;
        });
    };


});
