
project0001App
.controller('RolestatesController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
            $scope.find();
            $scope.ngtRolestateResource = {
                header: [
                                        {role_id: $translate.instant('role_id')}
                                , {statename: $translate.instant('statename')}
                                , {accessit: $translate.instant('accessit')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.rolestateFilters = '';
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
                    if(data.role_id){
        $scope.selectedRole.selected = data.role_id;
        }

                            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {

            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.role_id){
        $scope.selectedRole.selected = data.role_id;
        }

                            
    });
        }
    };


    var Rolestates = $injector.get('Rolestates');

    $scope.rolestates = [];
    $scope.find = function()
    {
        Rolestates.query(function(rolestates)
        {
            $scope.rolestates = rolestates;
            $scope.$emit('findLoaded', { data: rolestates });

            $scope.ngtRolestateResource.rows = $scope.rolestates;
            $scope.ngtRolestateResource.pagination = {
                page: 1,
                size: $scope.rolestates.length
            };
        });
    };

    $scope.rolestate = {};
    $scope.findOne = function()
    {
        Rolestates.get({
            rolestateId: $stateParams.rolestateId
        }, function(rolestate)
        {
            $scope.rolestate = rolestate;
            $scope.$emit('findOneLoaded', rolestate);
        });
    };

                                
        $scope.roles = [];
        $scope.role = {};
        $scope.selectedRole = {};
        var Roles = $injector.get('Roles');
            $scope.findRoles = function()
            {
                Roles.query(function(roles)
                {
                    $scope.roles = roles;
                    $scope.$emit('findRolesLoaded', { data: roles });
                });
            };

            $scope.findRoles();

    

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var rolestate = new Rolestates({

                                
         role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null

                                            
, statename: this.statename
                                
, accessit: this.accessit
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
