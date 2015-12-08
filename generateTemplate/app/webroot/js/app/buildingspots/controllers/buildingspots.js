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
            
if(data.building_id){
    $scope.selectedBuilding.selected = data.building_id;
}

                            
if (data.lov_buildingspot_section && data.lov_buildingspot_section !== '') {
    var lovBuildingspotSections = $scope.fgetLovs('equals', '', 'BUILDINGSPOT_SECTION', 'lovBuildingspotSections', data.lov_buildingspot_section);
    lovBuildingspotSections.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovBuildingspotSection.selected = datapromise.items[0];
        }
    });
}

                    
if (data.lov_buildingspot_status && data.lov_buildingspot_status !== '') {
    var lovBuildingspotStatuses = $scope.fgetLovs('equals', '', 'BUILDINGSPOT_STATUS', 'lovBuildingspotStatuses', data.lov_buildingspot_status);
    lovBuildingspotStatuses.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovBuildingspotStatus.selected = datapromise.items[0];
        }
    });
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

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        
{'buildingspot-building_id': $translate.instant('buildingspot-building_id')} ,

                                
{'buildingspot-name': $translate.instant('buildingspot-name')} ,

                                
{'buildingspot-spotNumber': $translate.instant('buildingspot-spotNumber')} ,

                                
{'buildingspot-lov_buildingspot_section': $translate.instant('buildingspot-lov_buildingspot_section')} ,

                                
{'buildingspot-lov_buildingspot_status': $translate.instant('buildingspot-lov_buildingspot_status')} ,

                                {'buildingspot-actions': $translate.instant('buildingspot-actions')}
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

    
var Lovs = $injector.get('Lovs');
$scope.fgetLovs = function($typeSearch, $fieldLang, $type, $svar, $param, $obj) {
    var whereStmnt = {
        lovType: $type,
        status: 'active'
    };
    switch ($typeSearch) {
        case 'contains':
            if ($param !== '' && $fieldLang !== '') {
                whereStmnt[$fieldLang] = {
                    contains: $param
                };
            }
            break;
        default:
            if ($param !== '') {
                whereStmnt.name_ = $param;
            }
            break;
    }
    return Lovs.query({
        where: whereStmnt,
        sort: 'orderShow ASC'
    }, function(lovs) {
        $scope[$svar] = lovs.items;
        if($obj){
            $obj[$svar] = lovs.items;
        }
        return $scope[$svar];
    });
};


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
