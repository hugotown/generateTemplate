'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:RolesCtrl
 * @description
 * # RolesCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('RolesCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'Role';
                $state.current.cObjType = 'Role';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
event = null;
data = null;
        });


    $scope.getRoles = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/roles?';

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
                                        
{'name': $translate.instant('role-name')} ,

                                
{'lov_role_status': $translate.instant('role-lov_role_status')} ,

                                
{'description': $translate.instant('role-description')} ,

                                {'actions': $translate.instant('role-actions')}
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

    var Roles = $injector.get('Roles');

    $scope.roles = [];
    $scope.find = function()
    {
        return Roles.query(function(roles)
        {
            $scope.roles = roles;
            $scope.$emit('findLoaded', { data: roles });
            return $scope.roles;
        });
    };

    $scope.role = {};
    $scope.findOne = function()
    {
        return Roles.get({
            roleId: $stateParams.roleId
        }, function(role)
        {
            $scope.role = role;
            $scope.$emit('findOneLoaded', role);
            return $scope.role;
        });
    };



$scope.lovRoleStatus = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var role = new Roles({

                                
name: this.name,

                                
lov_role_status: ($scope.lovRoleStatus.selected) ? $scope.lovRoleStatus.selected.name_ : '',

                                    
description: this.description,

                                
forctrl: 'ok'
            });

            role.$save(function(response)
            {
            $location.path('roles/view/' + response.id);
                Notification.success({
                    title:'Role',
                    message: 'Role has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var role = $scope.role;
                
role.lov_role_status = ($scope.lovRoleStatus.selected) ? $scope.lovRoleStatus.selected.name_ : '';

                            
        role.$update(function() {
          $location.path('roles/view/' + role.id);
          Notification.success({
                    title:'Role',
                    message: 'Role has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
