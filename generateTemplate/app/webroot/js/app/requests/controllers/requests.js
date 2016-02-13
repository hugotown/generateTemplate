'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:RequestsCtrl
 * @description
 * # RequestsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('RequestsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Request';
                $state.current.cObjType = 'Request';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.buildingspot_id){
    $scope.selectedBuildingspot.selected = data.buildingspot_id;
}

                            
if(data.workstation_id){
    $scope.selectedWorkstation.selected = data.workstation_id;
}

                            
event = null;
data = null;
        });


    $scope.getRequests = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/requests?';

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
                                        
{'buildingspot_id': $translate.instant('request-buildingspot_id')} ,

                                
{'name': $translate.instant('request-name')} ,

                                
{'lov_request_status': $translate.instant('request-lov_request_status')} ,

                                
{'lov_request_type': $translate.instant('request-lov_request_type')} ,

                                
{'lov_request_subtype': $translate.instant('request-lov_request_subtype')} ,

                                
{'lov_request_priority': $translate.instant('request-lov_request_priority')} ,

                                
{'lov_request_severity': $translate.instant('request-lov_request_severity')} ,

                                
{'workstation_id': $translate.instant('request-workstation_id')} ,

                                
{'description': $translate.instant('request-description')} ,

                                {'actions': $translate.instant('request-actions')}
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

    var Requests = $injector.get('Requests');

    $scope.requests = [];
    $scope.find = function()
    {
        return Requests.query(function(requests)
        {
            $scope.requests = requests;
            $scope.$emit('findLoaded', { data: requests });
            return $scope.requests;
        });
    };

    $scope.request = {};
    $scope.findOne = function()
    {
        return Requests.get({
            requestId: $stateParams.requestId
        }, function(request)
        {
            $scope.request = request;
            $scope.$emit('findOneLoaded', request);
            return $scope.request;
        });
    };

                                
        $scope.buildingspots = [];
        $scope.buildingspot = {};
        $scope.selectedBuildingspot = {};

        
var Buildingspots = $injector.get('Buildingspots');

            
        $scope.findBuildingspots = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Buildingspots.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_buildingspot_status : 'active'
                          }
                      },function(buildingspots)
                        {
                            $scope.buildingspots = buildingspots.items;
                            $scope.$emit('findBuildingspotsLoaded', { data: buildingspots });
                            return $scope.buildingspots;
                        });
                } else {
                    return Buildingspots.query({
                          where: {
                            lov_buildingspot_status : 'active'
                          }
                      },function(buildingspots)
                        {
                            $scope.buildingspots = buildingspots.items;
                            $scope.$emit('findBuildingspotsLoaded', { data: buildingspots });
                            return $scope.buildingspots;
                        });
                }
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

    

$scope.lovRequestStatus = {};

    
$scope.lovRequestType = {};

    
$scope.lovRequestSubtype = {};

    
$scope.lovRequestPriority = {};

    
$scope.lovRequestSeverity = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Buildingspot'){
        $scope.selectedBuildingspot.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Workstation'){
        $scope.selectedWorkstation.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var request = new Requests({

                                
buildingspot_id: $scope.selectedBuildingspot.selected ? $scope.selectedBuildingspot.selected.id : null,

                                            
name: this.name,

                                
lov_request_status: ($scope.lovRequestStatus.selected) ? $scope.lovRequestStatus.selected.name_ : '',

                                    
lov_request_type: ($scope.lovRequestType.selected) ? $scope.lovRequestType.selected.name_ : '',

                                    
lov_request_subtype: ($scope.lovRequestSubtype.selected) ? $scope.lovRequestSubtype.selected.name_ : '',

                                    
lov_request_priority: ($scope.lovRequestPriority.selected) ? $scope.lovRequestPriority.selected.name_ : '',

                                    
lov_request_severity: ($scope.lovRequestSeverity.selected) ? $scope.lovRequestSeverity.selected.name_ : '',

                                    
workstation_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null,

                                            
description: this.description,

                                
forctrl: 'ok'
            });

            request.$save(function(response)
            {
            $location.path('requests/view/' + response.id);
                Notification.success({
                    title:'Request',
                    message: 'Request has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var request = $scope.request;
                
request.buildingspot_id = $scope.selectedBuildingspot.selected ? $scope.selectedBuildingspot.selected.id : null;

                                        
request.lov_request_status = ($scope.lovRequestStatus.selected) ? $scope.lovRequestStatus.selected.name_ : '';

                            
request.lov_request_type = ($scope.lovRequestType.selected) ? $scope.lovRequestType.selected.name_ : '';

                            
request.lov_request_subtype = ($scope.lovRequestSubtype.selected) ? $scope.lovRequestSubtype.selected.name_ : '';

                            
request.lov_request_priority = ($scope.lovRequestPriority.selected) ? $scope.lovRequestPriority.selected.name_ : '';

                            
request.lov_request_severity = ($scope.lovRequestSeverity.selected) ? $scope.lovRequestSeverity.selected.name_ : '';

                            
request.workstation_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null;

                                        
        request.$update(function() {
          $location.path('requests/view/' + request.id);
          Notification.success({
                    title:'Request',
                    message: 'Request has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
