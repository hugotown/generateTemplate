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
            if (data.lov_user_gender && data.lov_user_gender !== '') {
    var lovUserGenders = $scope.findLovs('equals', '', 'USER_GENDER', 'lovUserGenders', data.lov_user_gender);
    lovUserGenders.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovUserGender.selected = datapromise.items[0];
        }
    });
}
                    if (data.lov_user_status && data.lov_user_status !== '') {
    var lovUserStatuses = $scope.findLovs('equals', '', 'USER_STATUS', 'lovUserStatuses', data.lov_user_status);
    lovUserStatuses.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovUserStatus.selected = datapromise.items[0];
        }
    });
}
                    if (data.lov_user_type && data.lov_user_type !== '') {
    var lovUserTypes = $scope.findLovs('equals', '', 'USER_TYPE', 'lovUserTypes', data.lov_user_type);
    lovUserTypes.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lovUserType.selected = datapromise.items[0];
        }
    });
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

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                                        {username: $translate.instant('username')} ,
                                {email: $translate.instant('email')} ,
                                {password: $translate.instant('password')} ,
                                {name: $translate.instant('name')} ,
                                {firstName: $translate.instant('firstName')} ,
                                {lastName: $translate.instant('lastName')} ,
                                {lov_user_gender: $translate.instant('lov_user_gender')} ,
                                {lov_user_status: $translate.instant('lov_user_status')} ,
                                {lov_user_type: $translate.instant('lov_user_type')} ,
                                {role_id: $translate.instant('role_id')} ,
                                {workstation_id: $translate.instant('workstation_id')} ,
                                {buildingspot_id: $translate.instant('buildingspot_id')} ,
                                {avatar: $translate.instant('avatar')} ,
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
                            }
                          }
                      },function(workstations)
                        {
                            $scope.workstations = workstations.items;
                            $scope.$emit('findWorkstationsLoaded', { data: workstations });
                            return $scope.workstations;
                        });
                } else {
                    return Workstations.query({
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
                            }
                          }
                      },function(buildingspots)
                        {
                            $scope.buildingspots = buildingspots.items;
                            $scope.$emit('findBuildingspotsLoaded', { data: buildingspots });
                            return $scope.buildingspots;
                        });
                } else {
                    return Buildingspots.query({
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
            var user = new Users({

                                username: this.username,
                                email: this.email,
                                password: this.password,
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
