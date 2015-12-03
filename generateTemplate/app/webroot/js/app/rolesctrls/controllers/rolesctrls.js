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

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        {role_id: $translate.instant('role_id')} ,
                                {ctrl_id: $translate.instant('ctrl_id')} ,
                                {getAction: $translate.instant('getAction')} ,
                                {postAction: $translate.instant('postAction')} ,
                                {putAction: $translate.instant('putAction')} ,
                                {patchAction: $translate.instant('patchAction')} ,
                                {deleteAction: $translate.instant('deleteAction')} ,
                                {copyAction: $translate.instant('copyAction')} ,
                                {headAction: $translate.instant('headAction')} ,
                                {optionsAction: $translate.instant('optionsAction')} ,
                                {linkAction: $translate.instant('linkAction')} ,
                                {unlinkAction: $translate.instant('unlinkAction')} ,
                                {purgeAction: $translate.instant('purgeAction')} ,
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
                            }
                          }
                      },function(roles)
                        {
                            $scope.roles = roles.items;
                            $scope.$emit('findRolesLoaded', { data: roles });
                            return $scope.roles;
                        });
                } else {
                    return Roles.query({
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
                            }
                          }
                      },function(ctrls)
                        {
                            $scope.ctrls = ctrls.items;
                            $scope.$emit('findCtrlsLoaded', { data: ctrls });
                            return $scope.ctrls;
                        });
                } else {
                    return Ctrls.query({
                      },function(ctrls)
                        {
                            $scope.ctrls = ctrls.items;
                            $scope.$emit('findCtrlsLoaded', { data: ctrls });
                            return $scope.ctrls;
                        });
                }
            };

    

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
            var rolesctrl = new Rolesctrls({

                                role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null,

                                            ctrl_id: $scope.selectedCtrl.selected ? $scope.selectedCtrl.selected.id : null,

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
