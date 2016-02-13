'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:RolesctrlsCtrl
 * @description
 * # RolesctrlsCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('RolesctrlsCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Rolesctrl';
                $state.current.cObjType = 'Rolesctrl';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.role_id){
    $scope.selectedRole.selected = data.role_id;
}

                            
if(data.ctrl_id){
    $scope.selectedCtrl.selected = data.ctrl_id;
}

                            
event = null;
data = null;
        });


    $scope.getRolesctrls = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/rolesctrls?';

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
                                        
{'role_id': $translate.instant('rolesctrl-role_id')} ,

                                
{'ctrl_id': $translate.instant('rolesctrl-ctrl_id')} ,

                                
{'lov_rolesctrl_status': $translate.instant('rolesctrl-lov_rolesctrl_status')} ,

                                
{'getAction': $translate.instant('rolesctrl-getAction')} ,

                                
{'postAction': $translate.instant('rolesctrl-postAction')} ,

                                
{'putAction': $translate.instant('rolesctrl-putAction')} ,

                                
{'patchAction': $translate.instant('rolesctrl-patchAction')} ,

                                
{'deleteAction': $translate.instant('rolesctrl-deleteAction')} ,

                                
{'copyAction': $translate.instant('rolesctrl-copyAction')} ,

                                
{'headAction': $translate.instant('rolesctrl-headAction')} ,

                                
{'optionsAction': $translate.instant('rolesctrl-optionsAction')} ,

                                
{'linkAction': $translate.instant('rolesctrl-linkAction')} ,

                                
{'unlinkAction': $translate.instant('rolesctrl-unlinkAction')} ,

                                
{'purgeAction': $translate.instant('rolesctrl-purgeAction')} ,

                                {'actions': $translate.instant('rolesctrl-actions')}
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

    var Rolesctrls = $injector.get('Rolesctrls');

    $scope.rolesctrls = [];
    $scope.find = function()
    {
        return Rolesctrls.query(function(rolesctrls)
        {
            $scope.rolesctrls = rolesctrls;
            $scope.$emit('findLoaded', { data: rolesctrls });
            return $scope.rolesctrls;
        });
    };

    $scope.rolesctrl = {};
    $scope.findOne = function()
    {
        return Rolesctrls.get({
            rolesctrlId: $stateParams.rolesctrlId
        }, function(rolesctrl)
        {
            $scope.rolesctrl = rolesctrl;
            $scope.$emit('findOneLoaded', rolesctrl);
            return $scope.rolesctrl;
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

                                    
        $scope.ctrls = [];
        $scope.ctrl = {};
        $scope.selectedCtrl = {};

        
var Ctrls = $injector.get('Ctrls');

            
        $scope.findCtrls = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return Ctrls.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_ctrl_status : 'active'
                          }
                      },function(ctrls)
                        {
                            $scope.ctrls = ctrls.items;
                            $scope.$emit('findCtrlsLoaded', { data: ctrls });
                            return $scope.ctrls;
                        });
                } else {
                    return Ctrls.query({
                          where: {
                            lov_ctrl_status : 'active'
                          }
                      },function(ctrls)
                        {
                            $scope.ctrls = ctrls.items;
                            $scope.$emit('findCtrlsLoaded', { data: ctrls });
                            return $scope.ctrls;
                        });
                }
            };

    

$scope.lovRolesctrlStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Role'){
        $scope.selectedRole.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Ctrl'){
        $scope.selectedCtrl.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var rolesctrl = new Rolesctrls({

                                
role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null,

                                            
ctrl_id: $scope.selectedCtrl.selected ? $scope.selectedCtrl.selected.id : null,

                                            
lov_rolesctrl_status: ($scope.lovRolesctrlStatus.selected) ? $scope.lovRolesctrlStatus.selected.name_ : '',

                                    
getAction: this.getAction,

                                
postAction: this.postAction,

                                
putAction: this.putAction,

                                
patchAction: this.patchAction,

                                
deleteAction: this.deleteAction,

                                
copyAction: this.copyAction,

                                
headAction: this.headAction,

                                
optionsAction: this.optionsAction,

                                
linkAction: this.linkAction,

                                
unlinkAction: this.unlinkAction,

                                
purgeAction: this.purgeAction,

                                
forctrl: 'ok'
            });

            rolesctrl.$save(function(response)
            {
            $location.path('rolesctrls/view/' + response.id);
                Notification.success({
                    title:'Rolesctrl',
                    message: 'Rolesctrl has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var rolesctrl = $scope.rolesctrl;
                
rolesctrl.role_id = $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null;

                                        
rolesctrl.ctrl_id = $scope.selectedCtrl.selected ? $scope.selectedCtrl.selected.id : null;

                                        
rolesctrl.lov_rolesctrl_status = ($scope.lovRolesctrlStatus.selected) ? $scope.lovRolesctrlStatus.selected.name_ : '';

                            
        rolesctrl.$update(function() {
          $location.path('rolesctrls/view/' + rolesctrl.id);
          Notification.success({
                    title:'Rolesctrl',
                    message: 'Rolesctrl has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
