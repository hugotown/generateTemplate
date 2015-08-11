
project0001App
.controller('BuildingsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtBuildingResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {alias: $translate.instant('alias')}
                                , {taxNumber: $translate.instant('taxNumber')}
                                , {manager: $translate.instant('manager')}
                                , {lov_building_status: $translate.instant('lov_building_status')}
                                , {description: $translate.instant('description')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.buildingFilters = '';
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
            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            
    });
        }
    };


    var Buildings = $injector.get('Buildings');

    $scope.buildings = [];
    $scope.find = function()
    {
        Buildings.query(function(buildings)
        {
            $scope.buildings = buildings;
            $scope.$emit('findLoaded', { data: buildings });

            $scope.ngtBuildingResource.rows = $scope.buildings;
            $scope.ngtBuildingResource.pagination = {
                page: 1,
                size: $scope.buildings.length
            };
        });
    };

    $scope.building = {};
    $scope.findOne = function()
    {
        Buildings.get({
            buildingId: $stateParams.buildingId
        }, function(building)
        {
            $scope.building = building;
            $scope.$emit('findOneLoaded', building);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var building = new Buildings({

                                
 name: this.name
                                
, alias: this.alias
                                
, taxNumber: this.taxNumber
                                
, manager: this.manager
                                
, lov_building_status: this.lov_building_status
                                
, description: this.description
                                            });
            $log.info('building to save');
            $log.info(building);

            building.$save(function(response)
            {
                $log.info('response save building');
                $log.info(response);
                $location.path('buildings/view/' + response.id);
                Notification.success({
                    title:'Building',
                    message: 'Building has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var building = $scope.building;
                
        building.$update(function() {
          $location.path('buildings/view/' + building.id);
          Notification.success({
                    title:'Building',
                    message: 'Building has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(building)
    {
        building.$update(function(response)
        {
            Notification.success({
                title:'Building',
                message: 'Building has been updated',
                delay: 4000
            });
        });

    };



});
