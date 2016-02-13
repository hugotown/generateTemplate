'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:BuildingspotsCtrl
 * @description
 * # BuildingspotsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('BuildingspotsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Buildingspot';
                $state.current.cObjType = 'Buildingspot';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.building_id){
    $scope.selectedBuilding.selected = data.building_id;
}

                            
event = null;
data = null;
        });


    $scope.getBuildingspots = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/buildingspots?';

      if(typeof paramsObj.count !== 'undefined'){
          var skip = (paramsObj.count * (paramsObj.page - 1));
          urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
      }

      if(typeof paramsObj.sortBy !== 'undefined'){
        urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
      }

      if(typeof paramsObj.filters !== 'undefined' ){
        urlApi += '&where={';

        if(typeof paramsObj.filters.name !== 'undefined'){
            urlApi += '"name": {"contains":"' + paramsObj.filters.name + '"}';
        }

        urlApi += '}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        
{'building_id': $translate.instant('buildingspot-building_id')} ,

                                
{'name': $translate.instant('buildingspot-name')} ,

                                
{'spotNumber': $translate.instant('buildingspot-spotNumber')} ,

                                
{'lov_buildingspot_section': $translate.instant('buildingspot-lov_buildingspot_section')} ,

                                
{'lov_buildingspot_status': $translate.instant('buildingspot-lov_buildingspot_status')} ,

                                {'actions': $translate.instant('buildingspot-actions')}
              ],
              'pagination': {
                  'count': paramsObj.count,
                  'page': paramsObj.page,
                  'pages': Math.ceil(r.data.info.total / paramsObj.count),
                  'size': r.data.info.total
              },
              'sortBy': paramsObj.sortBy,
              'sortOrder': paramsObj.sortOrder
          };
          return data;
      });
  };

    var Buildingspots = $injector.get('Buildingspots');

    $scope.buildingspots = [];
    $scope.find = function()
    {
        return Buildingspots.query(function(buildingspots)
        {
            $scope.buildingspots = buildingspots;
            $scope.$emit('findLoaded', { data: buildingspots });
            return $scope.buildingspots;
        });
    };

    $scope.buildingspot = {};
    $scope.findOne = function()
    {
        return Buildingspots.get({
            buildingspotId: $stateParams.buildingspotId
        }, function(buildingspot)
        {
            $scope.buildingspot = buildingspot;
            $scope.$emit('findOneLoaded', buildingspot);
            return $scope.buildingspot;
        });
    };

                                
        $scope.buildings = [];
        $scope.building = {};
        $scope.selectedBuilding = {};

        
var Buildings = $injector.get('Buildings');

            
        $scope.findBuildings = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Buildings.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_building_status : 'active'
                          }
                      },function(buildings)
                        {
                            $scope.buildings = buildings.items;
                            $scope.$emit('findBuildingsLoaded', { data: buildings });
                            return $scope.buildings;
                        });
                } else {
                    return Buildings.query({
                          where: {
                            lov_building_status : 'active'
                          }
                      },function(buildings)
                        {
                            $scope.buildings = buildings.items;
                            $scope.$emit('findBuildingsLoaded', { data: buildings });
                            return $scope.buildings;
                        });
                }
            };

    

$scope.lovBuildingspotSection = {};

    
$scope.lovBuildingspotStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Building'){
        $scope.selectedBuilding.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var buildingspot = new Buildingspots({

                                
building_id: $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null,

                                            
name: this.name,

                                
spotNumber: this.spotNumber,

                                
lov_buildingspot_section: ($scope.lovBuildingspotSection.selected) ? $scope.lovBuildingspotSection.selected.name_ : '',

                                    
lov_buildingspot_status: ($scope.lovBuildingspotStatus.selected) ? $scope.lovBuildingspotStatus.selected.name_ : '',

                                    
forctrl: 'ok'
            });

            buildingspot.$save(function(response)
            {
            $location.path('buildingspots/view/' + response.id);
                Notification.success({
                    title:'Buildingspot',
                    message: 'Buildingspot has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var buildingspot = $scope.buildingspot;
                
buildingspot.building_id = $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null;

                                        
buildingspot.lov_buildingspot_section = ($scope.lovBuildingspotSection.selected) ? $scope.lovBuildingspotSection.selected.name_ : '';

                            
buildingspot.lov_buildingspot_status = ($scope.lovBuildingspotStatus.selected) ? $scope.lovBuildingspotStatus.selected.name_ : '';

                            
        buildingspot.$update(function() {
          $location.path('buildingspots/view/' + buildingspot.id);
          Notification.success({
                    title:'Buildingspot',
                    message: 'Buildingspot has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
