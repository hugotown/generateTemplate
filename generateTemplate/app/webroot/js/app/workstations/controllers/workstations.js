'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:WorkstationsCtrl
 * @description
 * # WorkstationsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('WorkstationsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Workstation';
                $state.current.cObjType = 'Workstation';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.workarea_id){
    $scope.selectedWorkarea.selected = data.workarea_id;
}

                            
if(data.parentWorkstation_id){
    $scope.selectedWorkstation.selected = data.parent_id;
}

                            
if(data.building_id){
    $scope.selectedBuilding.selected = data.building_id;
}

                            
event = null;
data = null;
        });


    $scope.getWorkstations = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/workstations?';

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
                                        
{'name': $translate.instant('workstation-name')} ,

                                
{'employeeNumber': $translate.instant('workstation-employeeNumber')} ,

                                
{'workarea_id': $translate.instant('workstation-workarea_id')} ,

                                
{'lov_workstation_status': $translate.instant('workstation-lov_workstation_status')} ,

                                
{'parent_id': $translate.instant('workstation-parent_id')} ,

                                
{'building_id': $translate.instant('workstation-building_id')} ,

                                
{'description': $translate.instant('workstation-description')} ,

                                {'actions': $translate.instant('workstation-actions')}
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

    var Workstations = $injector.get('Workstations');

    $scope.workstations = [];
    $scope.find = function()
    {
        return Workstations.query(function(workstations)
        {
            $scope.workstations = workstations;
            $scope.$emit('findLoaded', { data: workstations });
            return $scope.workstations;
        });
    };

    $scope.workstation = {};
    $scope.findOne = function()
    {
        return Workstations.get({
            workstationId: $stateParams.workstationId
        }, function(workstation)
        {
            $scope.workstation = workstation;
            $scope.$emit('findOneLoaded', workstation);
            return $scope.workstation;
        });
    };

                                
        $scope.workareas = [];
        $scope.workarea = {};
        $scope.selectedWorkarea = {};

        
var Workareas = $injector.get('Workareas');

            
        $scope.findWorkareas = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Workareas.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_workarea_status : 'active'
                          }
                      },function(workareas)
                        {
                            $scope.workareas = workareas.items;
                            $scope.$emit('findWorkareasLoaded', { data: workareas });
                            return $scope.workareas;
                        });
                } else {
                    return Workareas.query({
                          where: {
                            lov_workarea_status : 'active'
                          }
                      },function(workareas)
                        {
                            $scope.workareas = workareas.items;
                            $scope.$emit('findWorkareasLoaded', { data: workareas });
                            return $scope.workareas;
                        });
                }
            };

                                    
        $scope.workstations = [];
        $scope.parentWorkstation = {};
        $scope.selectedWorkstation = {};

        
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

    

$scope.lovWorkstationStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Workarea'){
        $scope.selectedWorkarea.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Workstation'){
        $scope.selectedWorkstation.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Building'){
        $scope.selectedBuilding.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var workstation = new Workstations({

                                
name: this.name,

                                
employeeNumber: this.employeeNumber,

                                
workarea_id: $scope.selectedWorkarea.selected ? $scope.selectedWorkarea.selected.id : null,

                                            
lov_workstation_status: ($scope.lovWorkstationStatus.selected) ? $scope.lovWorkstationStatus.selected.name_ : '',

                                    
parent_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null,

                                            
building_id: $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null,

                                            
description: this.description,

                                
forctrl: 'ok'
            });

            workstation.$save(function(response)
            {
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
                
workstation.workarea_id = $scope.selectedWorkarea.selected ? $scope.selectedWorkarea.selected.id : null;

                                        
workstation.lov_workstation_status = ($scope.lovWorkstationStatus.selected) ? $scope.lovWorkstationStatus.selected.name_ : '';

                            
workstation.parent_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null;

                                        
workstation.building_id = $scope.selectedBuilding.selected ? $scope.selectedBuilding.selected.id : null;

                                        
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


}]);
