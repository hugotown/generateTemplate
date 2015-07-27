
project0001App
.controller('UsersController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.ngtUsersResource = {
                header: [
                                { username : $translate.instant('username') }
                			, { email : $translate.instant('email') }
                			, { password : $translate.instant('password') }
                			, { name : $translate.instant('name') }
                			, { firstName : $translate.instant('firstName') }
                			, { lastName : $translate.instant('lastName') }
                			, { gender : $translate.instant('gender') }
                			, { group_id : $translate.instant('group_id') }
                			, { workstation_id : $translate.instant('workstation_id') }
                			, { status : $translate.instant('status') }
                			, { actions : $translate.instant('Actions') }
                ]
                , rows: [],
                sortBy: "",
                sortOrder: "",
                pagination: {}
            };

            $scope.userFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            $scope.find();
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
					    $scope.findGroups();

					    $scope.findWorkstations();

            
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

    var Users = $injector.get('Users');

    $scope.find = function()
    {
        Users.query(function(users)
        {
            $scope.users = users;
            $scope.$emit('findLoaded', { data: users });
            $scope.ngtUsersResource.rows = $scope.users;
            $scope.ngtUsersResource.pagination = {
                page: 1,
                size: $scope.users.length
            };
        });
    };

    $scope.findOne = function()
    {
        Users.get({
            userId: $stateParams.userId
        }, function(user)
        {
            $scope.user = user;
        });
    };

				
	$scope.groups = [];
	$scope.group = {};
	var Groups = $injector.get('Groups');
	    $scope.findGroups = function()
	    {
	        Groups.query(function(groups)
	        {
	            $scope.groups = groups;
	            $scope.$emit('findGroupsLoaded', { data: groups });
	            $log.info('findGroupsLoaded');
	        });
	    };

				
	$scope.workstations = [];
	$scope.workstation = {};
	var Workstations = $injector.get('Workstations');
	    $scope.findWorkstations = function()
	    {
	        Workstations.query(function(workstations)
	        {
	            $scope.workstations = workstations;
	            $scope.$emit('findWorkstationsLoaded', { data: workstations });
	            $log.info('findWorkstationsLoaded');
	        });
	    };


});
