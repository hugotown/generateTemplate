
project0001App
.controller('UsersController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            var DTOptionsBuilder = $injector.get('DTOptionsBuilder');
            var DTColumnDefBuilder = $injector.get('DTColumnDefBuilder');
            $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('rowCallback', function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                // Unbind first in order to avoid any duplicate handler
                $('td', nRow).unbind('click');
                $('td', nRow).bind('click', function() {
                    $scope.$apply(function() {
                        console.log('some click handler', aData);
                    });
                });
                return nRow;
            })
            .withOption("oLanguage", {
                "sLengthMenu": "_MENU_ " + $translate.instant("records per page"),
                "oPaginate": {
                    "sPrevious": ""+$translate.instant("Previous"),
                    "sNext": ""+$translate.instant("Next")
                },
                "sSearch": $translate.instant("Search")+":",
                "sEmptyTable": $translate.instant("No data available on table")+"...",
                "sInfo": $translate.instant("Showing records")+" _START_ "+ $translate.instant("to") + " _END_",
                "sInfoEmpty": "",
                "sInfoFiltered": "("+$translate.instant("Filtered of")+" _MAX_)"
            })
            .withDOM('<lf<"table-scrollable"t>ip>')
            .withBootstrap()
            // Add ColVis compatibility
            .withColVis()
            // Add Table tools compatibility
            .withTableTools('/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf')
            .withTableToolsButtons([{
                'sExtends': 'csv'
            },{
                'sExtends': 'pdf'
            }])
            .withBootstrapOptions({
                TableTools: {
                    classes: {
                        container: 'btn-group',
                        buttons: {
                            normal: 'btn btn-default'
                        }
                    }
                },
                ColVis: {
                    classes: {
                        container: 'btn-group',
                        masterButton: 'btn btn-default'
                    }
                },
                pagination: {
                    classes: {
                        ul: 'pagination pagination-sm'
                    }
                }
            });
            $scope.dtColumnDefs = [
                                DTColumnDefBuilder.newColumnDef(0).withTitle("username")
                            , DTColumnDefBuilder.newColumnDef(1).withTitle("email")
                            , DTColumnDefBuilder.newColumnDef(2).withTitle("password")
                            , DTColumnDefBuilder.newColumnDef(3).withTitle("name")
                            , DTColumnDefBuilder.newColumnDef(4).withTitle("firstName")
                            , DTColumnDefBuilder.newColumnDef(5).withTitle("lastName")
                            , DTColumnDefBuilder.newColumnDef(6).withTitle("lov_user_gender")
                            , DTColumnDefBuilder.newColumnDef(7).withTitle("group_id")
                            , DTColumnDefBuilder.newColumnDef(8).withTitle("workstation_id")
                            , DTColumnDefBuilder.newColumnDef(9).withTitle("lov_user_status")
                            , DTColumnDefBuilder.newColumnDef(10).withTitle("Actions")
            ];
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            $scope.findOne();
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();
        }
    };


    var Users = $injector.get('Users');

    $scope.users = [];
    $scope.find = function()
    {
        Users.query(function(users)
        {
            $scope.users = users;
            $scope.$emit('findLoaded', { data: users });
        });
    };

    $scope.user = {};
    $scope.findOne = function()
    {
        Users.get({
            userId: $stateParams.userId
        }, function(user)
        {
            $scope.user = user;
            $scope.$emit('findOneLoaded', { data: user });
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
	        });
	    };

        $scope.findGroups();

    $scope.selectedGroup = {};
    $scope.searchGroup = '';
    $scope.getGroups = function(query)
    {
        var createFilterForGroups = function(query)
        {
            return function filterFn(groups) {
                return (groups.name.indexOf(query) === 0);
            };
        };
        var results = query ? $scope.groups.filter( createFilterForGroups(query) ) : $scope.groups;
        return results;
    };
    $scope.searchGroupChange = function(text) {
        //$log.info('group changed to ' + text);
    };
    $scope.selectedGroupChange = function(item) {
        if(item){
            if(item.Group){
                $log.info(item.Group);
            }
        }
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
	        });
	    };

        $scope.findWorkstations();

    $scope.selectedWorkstation = {};
    $scope.searchWorkstation = '';
    $scope.getWorkstations = function(query)
    {
        var createFilterForWorkstations = function(query)
        {
            return function filterFn(workstations) {
                return (workstations.name.indexOf(query) === 0);
            };
        };
        var results = query ? $scope.workstations.filter( createFilterForWorkstations(query) ) : $scope.workstations;
        return results;
    };
    $scope.searchWorkstationChange = function(text) {
        //$log.info('workstation changed to ' + text);
    };
    $scope.selectedWorkstationChange = function(item) {
        if(item){
            if(item.Workstation){
                $log.info(item.Workstation);
            }
        }
    };


    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var user = new Users({
                createdBy: 1
                , updatedBy: 1
                , createdAt: moment().format('YYYY-MM-DD')
                , updatedAt: moment().format('YYYY-MM-DD')
                , name: this.name
                , role: this.role
                , employeeNumber: this.employeeNumber
                , workarea: this.workarea
                , description: this.description
                , status: "active"//$scope.lovStatus.selected ? $scope.lovStatus.selected.id : null,
                , parent_id: $scope.selectedParentWorkstation.Workstation ? $scope.selectedParentWorkstation.Workstation.id : null
                , store_id: $scope.selectedStore.Store ? $scope.selectedStore.Store.id : null
            });
            $log.info('user to save');
            $log.info(user);

            user.$save(function(response)
            {
                $log.info('response save user');
                $log.info(response);
                Notification.success({
                    title:'User',
                    message: 'User has been saved',
                    delay: 4000
                });
            });

            this.name = '';
            this.role = '';
            this.employeeNumber = '';
            this.workarea = null;
            this.description = '';
            this.status = 'active';
            $scope.selectedParentWorkstation = {};
            $scope.selectedStore = {};
        } else {
            $scope.submitted = true;
        }
    };



});
