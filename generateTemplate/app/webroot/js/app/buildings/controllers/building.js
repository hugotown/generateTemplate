
project0001App
.controller('BuildingsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngtBuildingsResource = {
                header: [
                                { name : $translate.instant('name') }
                			, { alias : $translate.instant('alias') }
                			, { taxNumber : $translate.instant('taxNumber') }
                			, { manager : $translate.instant('manager') }
                			, { status : $translate.instant('status') }
                			, { description : $translate.instant('description') }
                			, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.buildingFilters = '';
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

    var Buildings = $injector.get('Buildings');

    $scope.find = function()
    {
        Buildings.query(function(buildings)
        {
            $scope.buildings = buildings;
            $scope.$emit('findLoaded', { data: buildings });
            $scope.ngtBuildingsResource.rows = $scope.buildings;
            $scope.ngtBuildingsResource.pagination = {
                page: 1,
                size: $scope.buildings.length
            };
        });
    };

    $scope.findOne = function()
    {
        Buildings.get({
            buildingId: $stateParams.buildingId
        }, function(building)
        {
            $scope.building = building;
        });
    };


});
