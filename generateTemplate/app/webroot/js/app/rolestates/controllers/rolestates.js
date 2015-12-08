'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:RolestatesCtrl
 * @description
 * # RolestatesCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('RolestatesCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

        $scope.$on('findOneLoaded', function(event, data)
        {
            
if(data.role_id){
    $scope.selectedRole.selected = data.role_id;
}

                            
if (data.lov_rolestate_status && data.lov_rolestate_status !== '') {
    var lovRolestateStatuses = $scope.fgetLovs('equals', '', 'ROLESTATE_STATUS', 'lovRolestateStatuses', data.lov_rolestate_status);
    lovRolestateStatuses.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovRolestateStatus.selected = datapromise.items[0];
        }
    });
}

                    
event = null;
data = null;
        });


    $scope.getRolestates = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/rolestates?';

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
                                        
{'rolestate-role_id': $translate.instant('rolestate-role_id')} ,

                                
{'rolestate-statename': $translate.instant('rolestate-statename')} ,

                                
{'rolestate-accessit': $translate.instant('rolestate-accessit')} ,

                                
{'rolestate-lov_rolestate_status': $translate.instant('rolestate-lov_rolestate_status')} ,

                                {'rolestate-actions': $translate.instant('rolestate-actions')}
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

    var Rolestates = $injector.get('Rolestates');

    $scope.rolestates = [];
    $scope.find = function()
    {
        return Rolestates.query(function(rolestates)
        {
            $scope.rolestates = rolestates;
            $scope.$emit('findLoaded', { data: rolestates });
            return $scope.rolestates;
        });
    };

    $scope.rolestate = {};
    $scope.findOne = function()
    {
        return Rolestates.get({
            rolestateId: $stateParams.rolestateId
        }, function(rolestate)
        {
            $scope.rolestate = rolestate;
            $scope.$emit('findOneLoaded', rolestate);
            return $scope.rolestate;
        });
    };

                                
        $scope.roles = [];
        $scope.role = {};
        $scope.selectedRole = {};

        
        var Roles = $injector.get('Roles');

            
        $scope.findRoles = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Roles.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_role_status : 'active'
                          }
                      },function(roles)
                        {
                            $scope.roles = roles.items;
                            $scope.$emit('findRolesLoaded', { data: roles });
                            return $scope.roles;
                        });
                } else {
                    return Roles.query({
                          where: {
                            lov_role_status : 'active'
                          }
                      },function(roles)
                        {
                            $scope.roles = roles.items;
                            $scope.$emit('findRolesLoaded', { data: roles });
                            return $scope.roles;
                        });
                }
            };

    

$scope.lovRolestateStatus = {};

    
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
            var rolestate = new Rolestates({

                                
role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null,

                                            
statename: this.statename,

                                
accessit: this.accessit,

                                
lov_rolestate_status: ($scope.lovRolestateStatus.selected) ? $scope.lovRolestateStatus.selected.name_ : '',

                                    
forctrl: 'ok'
            });

            rolestate.$save(function(response)
            {
            $location.path('rolestates/view/' + response.id);
                Notification.success({
                    title:'Rolestate',
                    message: 'Rolestate has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var rolestate = $scope.rolestate;
                
rolestate.role_id = $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null;

                                        
rolestate.lov_rolestate_status = ($scope.lovRolestateStatus.selected) ? $scope.lovRolestateStatus.selected.name_ : '';

                            
        rolestate.$update(function() {
          $location.path('rolestates/view/' + rolestate.id);
          Notification.success({
                    title:'Rolestate',
                    message: 'Rolestate has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
