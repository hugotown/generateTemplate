'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:BuildingsCtrl
 * @description
 * # BuildingsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('BuildingsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Building';
                $state.current.cObjType = 'Building';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.workstation_id){
    $scope.selectedWorkstation.selected = data.workstation_id;
}

                            
event = null;
data = null;
        });


    $scope.getBuildings = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/buildings?';

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
                                        
{'name': $translate.instant('building-name')} ,

                                
{'taxNumber': $translate.instant('building-taxNumber')} ,

                                
{'workstation_id': $translate.instant('building-workstation_id')} ,

                                
{'lov_building_status': $translate.instant('building-lov_building_status')} ,

                                
{'description': $translate.instant('building-description')} ,

                                {'actions': $translate.instant('building-actions')}
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

    var Buildings = $injector.get('Buildings');

    $scope.buildings = [];
    $scope.find = function()
    {
        return Buildings.query(function(buildings)
        {
            $scope.buildings = buildings;
            $scope.$emit('findLoaded', { data: buildings });
            return $scope.buildings;
        });
    };

    $scope.building = {};
    $scope.findOne = function()
    {
        return Buildings.get({
            buildingId: $stateParams.buildingId
        }, function(building)
        {
            $scope.building = building;
            $scope.$emit('findOneLoaded', building);
            return $scope.building;
        });
    };

                                
        $scope.workstations = [];
        $scope.workstation = {};
        $scope.selectedWorkstation = {};

        
var Workstations = $injector.get('Workstations');

            
        $scope.findWorkstations = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Workstations.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_workstation_status : 'active'
                          }
                      },function(workstations)
                        {
                            $scope.workstations = workstations.items;
                            $scope.$emit('findWorkstationsLoaded', { data: workstations });
                            return $scope.workstations;
                        });
                } else {
                    return Workstations.query({
                          where: {
                            lov_workstation_status : 'active'
                          }
                      },function(workstations)
                        {
                            $scope.workstations = workstations.items;
                            $scope.$emit('findWorkstationsLoaded', { data: workstations });
                            return $scope.workstations;
                        });
                }
            };

    

$scope.lovBuildingStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Workstation'){
        $scope.selectedWorkstation.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var building = new Buildings({

                                
name: this.name,

                                
taxNumber: this.taxNumber,

                                
workstation_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null,

                                            
lov_building_status: ($scope.lovBuildingStatus.selected) ? $scope.lovBuildingStatus.selected.name_ : '',

                                    
description: this.description,

                                
forctrl: 'ok'
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
                
building.workstation_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null;

                                        
building.lov_building_status = ($scope.lovBuildingStatus.selected) ? $scope.lovBuildingStatus.selected.name_ : '';

                            
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
