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

                            if (data.lov_spot_section && data.lov_spot_section !== '') {
    var lovSpotSections = $scope.findLovs('equals', '', 'SPOT_SECTION', 'lovSpotSections', data.lov_spot_section);
    lovSpotSections.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovSpotSection.selected = datapromise.items[0];
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
                                        {building_id: $translate.instant('building_id')} ,
                                {name: $translate.instant('name')} ,
                                {spotNumber: $translate.instant('spotNumber')} ,
                                {lov_spot_section: $translate.instant('lov_spot_section')} ,
                                {Actions: $translate.instant('Actions')}
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
                            }
                          }
                      },function(buildings)
                        {
                            $scope.buildings = buildings.items;
                            $scope.$emit('findBuildingsLoaded', { data: buildings });
                            return $scope.buildings;
                        });
                } else {
                    return Buildings.query({
                      },function(buildings)
                        {
                            $scope.buildings = buildings.items;
                            $scope.$emit('findBuildingsLoaded', { data: buildings });
                            return $scope.buildings;
                        });
                }
            };

    
$scope.lovSpotSection = {};
    
var Lovs = $injector.get('Lovs');
$scope.findLovs = function($typeSearch, $fieldLang, $type, $svar, $param) {
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
                                lov_spot_section: ($scope.lovSpotSection.selected) ? $scope.lovSpotSection.selected.name_ : '',

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

                                        buildingspot.lov_spot_section = ($scope.lovSpotSection.selected) ? $scope.lovSpotSection.selected.name_ : '';

                            
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
