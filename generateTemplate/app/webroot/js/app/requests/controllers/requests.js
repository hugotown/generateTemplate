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
            
if(data.buildingspot_id){
    $scope.selectedBuildingspot.selected = data.buildingspot_id;
}

                            
if (data.lov_request_status && data.lov_request_status !== '') {
    var lovRequestStatuses = $scope.fgetLovs('equals', '', 'REQUEST_STATUS', 'lovRequestStatuses', data.lov_request_status);
    lovRequestStatuses.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRequestStatus.selected = datapromise.items[0];
        }
    });
}

                    
if (data.lov_request_type && data.lov_request_type !== '') {
    var lovRequestTypes = $scope.fgetLovs('equals', '', 'REQUEST_TYPE', 'lovRequestTypes', data.lov_request_type);
    lovRequestTypes.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRequestType.selected = datapromise.items[0];
        }
    });
}

                    
if (data.lov_request_subtype && data.lov_request_subtype !== '') {
    var lovRequestSubtypes = $scope.fgetLovs('equals', '', 'REQUEST_SUBTYPE', 'lovRequestSubtypes', data.lov_request_subtype);
    lovRequestSubtypes.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRequestSubtype.selected = datapromise.items[0];
        }
    });
}

                    
if (data.lov_request_priority && data.lov_request_priority !== '') {
    var lovRequestPriorities = $scope.fgetLovs('equals', '', 'REQUEST_PRIORITY', 'lovRequestPriorities', data.lov_request_priority);
    lovRequestPriorities.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRequestPriority.selected = datapromise.items[0];
        }
    });
}

                    
if (data.lov_request_severity && data.lov_request_severity !== '') {
    var lovRequestSeverities = $scope.fgetLovs('equals', '', 'REQUEST_SEVERITY', 'lovRequestSeverities', data.lov_request_severity);
    lovRequestSeverities.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRequestSeverity.selected = datapromise.items[0];
        }
    });
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

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        
{'request-buildingspot_id': $translate.instant('request-buildingspot_id')} ,

                                
{'request-name': $translate.instant('request-name')} ,

                                
{'request-lov_request_status': $translate.instant('request-lov_request_status')} ,

                                
{'request-lov_request_type': $translate.instant('request-lov_request_type')} ,

                                
{'request-lov_request_subtype': $translate.instant('request-lov_request_subtype')} ,

                                
{'request-lov_request_priority': $translate.instant('request-lov_request_priority')} ,

                                
{'request-lov_request_severity': $translate.instant('request-lov_request_severity')} ,

                                
{'request-workstation_id': $translate.instant('request-workstation_id')} ,

                                
{'request-description': $translate.instant('request-description')} ,

                                {'request-actions': $translate.instant('request-actions')}
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
