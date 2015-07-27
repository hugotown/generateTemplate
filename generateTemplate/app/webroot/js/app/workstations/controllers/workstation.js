
project0001App
.controller('WorkstationsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngtWorkstationsResource = {
                header: [
                                { name : $translate.instant('name') }
                			, { role : $translate.instant('role') }
                			, { employeeNumber : $translate.instant('employeeNumber') }
                			, { workarea : $translate.instant('workarea') }
                			, { status : $translate.instant('status') }
                			, { parent_id : $translate.instant('parent_id') }
                			, { building_id : $translate.instant('building_id') }
                			, { description : $translate.instant('description') }
                			, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.workstationFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            $scope.find();
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
					    $scope.findWorkstations();

					    $scope.findBuildings();

            
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

    var Workstations = $injector.get('Workstations');

    $scope.find = function()
    {
        Workstations.query(function(workstations)
        {
            $scope.workstations = workstations;
            $scope.$emit('findLoaded', { data: workstations });
            $scope.ngtWorkstationsResource.rows = $scope.workstations;
            $scope.ngtWorkstationsResource.pagination = {
                page: 1,
                size: $scope.workstations.length
            };
        });
    };

    $scope.findOne = function()
    {
        Workstations.get({
            workstationId: $stateParams.workstationId
        }, function(workstation)
        {
            $scope.workstation = workstation;
        });
    };

				
	$scope.workstations = [];
	$scope.parentWorkstation = {};
	var Workstations = $injector.get('Workstations');
	    $scope.findWorkstations = function()
	    {
	        Workstations.query(function(workstations)
	        {
	            $scope.workstations = workstations;
	            $scope.$emit('findWorkstationsLoaded', { data: workstations });
	        });
	    };

				
	$scope.buildings = [];
	$scope.building = {};
	var Buildings = $injector.get('Buildings');
	    $scope.findBuildings = function()
	    {
	        Buildings.query(function(buildings)
	        {
	            $scope.buildings = buildings;
	            $scope.$emit('findBuildingsLoaded', { data: buildings });
	        });
	    };


});
