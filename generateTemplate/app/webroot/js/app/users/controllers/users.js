'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:UsersCtrl
 * @description
 * # UsersCtrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('UsersCtrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = 'User';
                $state.current.cObjType = 'User';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
            }

            
if(data.role_id){
    $scope.selectedRole.selected = data.role_id;
}

                            
if(data.workstation_id){
    $scope.selectedWorkstation.selected = data.workstation_id;
}

                            
if(data.buildingspot_id){
    $scope.selectedBuildingspot.selected = data.buildingspot_id;
}

                            
event = null;
data = null;
        });


    $scope.getUsers = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/users?';

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
                                        
{'username': $translate.instant('user-username')} ,

                                
{'email': $translate.instant('user-email')} ,

                                
{'name': $translate.instant('user-name')} ,

                                
{'firstName': $translate.instant('user-firstName')} ,

                                
{'lastName': $translate.instant('user-lastName')} ,

                                
{'lov_user_gender': $translate.instant('user-lov_user_gender')} ,

                                
{'lov_user_status': $translate.instant('user-lov_user_status')} ,

                                
{'lov_user_type': $translate.instant('user-lov_user_type')} ,

                                
{'role_id': $translate.instant('user-role_id')} ,

                                
{'workstation_id': $translate.instant('user-workstation_id')} ,

                                
{'buildingspot_id': $translate.instant('user-buildingspot_id')} ,

                                
{'avatar': $translate.instant('user-avatar')} ,

                                {'actions': $translate.instant('user-actions')}
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

    var Users = $injector.get('Users');

    $scope.users = [];
    $scope.find = function()
    {
        return Users.query(function(users)
        {
            $scope.users = users;
            $scope.$emit('findLoaded', { data: users });
            return $scope.users;
        });
    };

    $scope.user = {};
    $scope.findOne = function()
    {
        return Users.get({
            userId: $stateParams.userId
        }, function(user)
        {
            $scope.user = user;
            $scope.$emit('findOneLoaded', user);
            return $scope.user;
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

    

$scope.lovUserGender = {};

    
$scope.lovUserStatus = {};

    
$scope.lovUserType = {};

    

if( $state.current.name.indexOf('Create') !== -1 ) {
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

        
    if($scope.parentObjType ===  'Role'){
        $scope.selectedRole.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Workstation'){
        $scope.selectedWorkstation.selected = $scope.parentObj;
    }

                            
    if($scope.parentObjType ===  'Buildingspot'){
        $scope.selectedBuildingspot.selected = $scope.parentObj;
    }

                            
}



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var user = new Users({

                                
username: this.username,

                                
email: this.email,

                                
name: this.name,

                                
firstName: this.firstName,

                                
lastName: this.lastName,

                                
lov_user_gender: ($scope.lovUserGender.selected) ? $scope.lovUserGender.selected.name_ : '',

                                    
lov_user_status: ($scope.lovUserStatus.selected) ? $scope.lovUserStatus.selected.name_ : '',

                                    
lov_user_type: ($scope.lovUserType.selected) ? $scope.lovUserType.selected.name_ : '',

                                    
role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null,

                                            
workstation_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null,

                                            
buildingspot_id: $scope.selectedBuildingspot.selected ? $scope.selectedBuildingspot.selected.id : null,

                                            
avatar: this.avatar,

                                
forctrl: 'ok'
            });

            user.$save(function(response)
            {
            $location.path('users/view/' + response.id);
                Notification.success({
                    title:'User',
                    message: 'User has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var user = $scope.user;
                
user.lov_user_gender = ($scope.lovUserGender.selected) ? $scope.lovUserGender.selected.name_ : '';

                            
user.lov_user_status = ($scope.lovUserStatus.selected) ? $scope.lovUserStatus.selected.name_ : '';

                            
user.lov_user_type = ($scope.lovUserType.selected) ? $scope.lovUserType.selected.name_ : '';

                            
user.role_id = $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null;

                                        
user.workstation_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null;

                                        
user.buildingspot_id = $scope.selectedBuildingspot.selected ? $scope.selectedBuildingspot.selected.id : null;

                                        
        user.$update(function() {
          $location.path('users/view/' + user.id);
          Notification.success({
                    title:'User',
                    message: 'User has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
