
project0001App
.controller('BuildingsController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
            $scope.find();
            $scope.ngtBuildingResource = {
                header: [
                                        {name: $translate.instant('name')}
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

        }
        if (path.indexOf('edit') !== -1)
        {

            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {

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
                                
, taxNumber: this.taxNumber
                                
, manager: this.manager
                                
, lov_building_status: this.lov_building_status
                                
, description: this.description
                                            });

            building.$save(function(response)
            {
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


}]);
