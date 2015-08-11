
project0001App
.controller('WorkstationsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtWorkstationResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {lov_workstation_role: $translate.instant('lov_workstation_role')}
                                , {employeeNumber: $translate.instant('employeeNumber')}
                                , {workarea_id: $translate.instant('workarea_id')}
                                , {status: $translate.instant('status')}
                                , {parent_id: $translate.instant('parent_id')}
                                , {building_id: $translate.instant('building_id')}
                                , {description: $translate.instant('description')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.workstationFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.workarea_id){
        $scope.selectedWorkarea.selected = data.workarea_id;
        }

                                    if(data.parentWorkstation_id){
        $scope.selectedWorkstation.selected = data.parentWorkstation_id;
        }

                                    if(data.building_id){
        $scope.selectedBuilding.selected = data.building_id;
        }

                            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.workarea_id){
        $scope.selectedWorkarea.selected = data.workarea_id;
        }

                                    if(data.parentWorkstation_id){
        $scope.selectedWorkstation.selected = data.parentWorkstation_id;
        }

                                    if(data.building_id){
        $scope.selectedBuilding.selected = data.building_id;
        }

                            
    });
        }
    };


    var Workstations = $injector.get('Workstations');

    $scope.workstations = [];
    $scope.find = function()
    {
        Workstations.query(function(workstations)
        {
            $scope.workstations = workstations;
            $scope.$emit('findLoaded', { data: workstations });

            $scope.ngtWorkstationResource.rows = $scope.workstations;
            $scope.ngtWorkstationResource.pagination = {
                page: 1,
                size: $scope.workstations.length
            };
        });
    };

    $scope.workstation = {};
    $scope.findOne = function()
    {
        Workstations.get({
            workstationId: $stateParams.workstationId
        }, function(workstation)
        {
            $scope.workstation = workstation;
            $scope.$emit('findOneLoaded', workstation);
        });
    };

                                
        $scope.workareas = [];
        $scope.workarea = {};
        $scope.selectedWorkarea = {};
        var Workareas = $injector.get('Workareas');
            $scope.findWorkareas = function()
            {
                Workareas.query(function(workareas)
                {
                    $scope.workareas = workareas;
                    $scope.$emit('findWorkareasLoaded', { data: workareas });
                });
            };

            $scope.findWorkareas();

                                    
        $scope.workstations = [];
        $scope.parentWorkstation = {};
        $scope.selectedWorkstation = {};
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

                                    
        $scope.buildings = [];
        $scope.building = {};
        $scope.selectedBuilding = {};
        var Buildings = $injector.get('Buildings');
            $scope.findBuildings = function()
            {
                Buildings.query(function(buildings)
                {
                    $scope.buildings = buildings;
                    $scope.$emit('findBuildingsLoaded', { data: buildings });
                });
            };

            $scope.findBuildings();

    

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var workstation = new Workstations({

                                
 name: this.name
                                
, lov_workstation_role: this.lov_workstation_role
                                
, employeeNumber: this.employeeNumber
                                
        , workarea_id: $scope.selectedWorkarea.selected ? $scope.selectedWorkarea.selected.id : null

                                            
, status: this.status
                                
        , parent_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null

                                            
        , building_id: $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null

                                            
, description: this.description
                                            });
            $log.info('workstation to save');
            $log.info(workstation);

            workstation.$save(function(response)
            {
                $log.info('response save workstation');
                $log.info(response);
                $location.path('workstations/view/' + response.id);
                Notification.success({
                    title:'Workstation',
                    message: 'Workstation has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var workstation = $scope.workstation;
                
     workstation.workarea_id = $scope.selectedWorkarea.selected ? $scope.selectedWorkarea.selected.id : null

                                        
     workstation.parent_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null

                                        
     workstation.building_id = $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null

                                        
        workstation.$update(function() {
          $location.path('workstations/view/' + workstation.id);
          Notification.success({
                    title:'Workstation',
                    message: 'Workstation has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(workstation)
    {
        workstation.$update(function(response)
        {
            Notification.success({
                title:'Workstation',
                message: 'Workstation has been updated',
                delay: 4000
            });
        });

    };



});
