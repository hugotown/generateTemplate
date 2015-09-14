
project0001App
.controller('RolesController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
            $scope.find();
            $scope.ngtRoleResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {lov_role_status: $translate.instant('lov_role_status')}
                                , {description: $translate.instant('description')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.roleFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            
        }
        if(path.indexOf('create') !== -1)
        {

        }
        if (path.indexOf('edit') !== -1)
        {

            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {

            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            
    });
        }
    };


    var Roles = $injector.get('Roles');

    $scope.roles = [];
    $scope.find = function()
    {
        Roles.query(function(roles)
        {
            $scope.roles = roles;
            $scope.$emit('findLoaded', { data: roles });

            $scope.ngtRoleResource.rows = $scope.roles;
            $scope.ngtRoleResource.pagination = {
                page: 1,
                size: $scope.roles.length
            };
        });
    };

    $scope.role = {};
    $scope.findOne = function()
    {
        Roles.get({
            roleId: $stateParams.roleId
        }, function(role)
        {
            $scope.role = role;
            $scope.$emit('findOneLoaded', role);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var role = new Roles({

                                
 name: this.name
                                
, lov_role_status: this.lov_role_status
                                
, description: this.description
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
