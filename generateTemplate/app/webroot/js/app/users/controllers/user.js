
project0001App
.controller('UsersController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtUserResource = {
                header: [
                                        {username: $translate.instant('username')}
                                , {email: $translate.instant('email')}
                                , {password: $translate.instant('password')}
                                , {name: $translate.instant('name')}
                                , {firstName: $translate.instant('firstName')}
                                , {lastName: $translate.instant('lastName')}
                                , {lov_user_gender: $translate.instant('lov_user_gender')}
                                , {role_id: $translate.instant('role_id')}
                                , {workstation_id: $translate.instant('workstation_id')}
                                , {lov_user_status: $translate.instant('lov_user_status')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.userFilters = '';
            $scope.ngTitemsPerPage = 10;
            $scope.ngTlistItemsPerPage = [10, 20, 40, 80];
            
        }
        if(path.indexOf('create') !== -1)
        {

        $log.info('create mode');
            
        }
        if (path.indexOf('edit') !== -1)
        {
        $log.info('edit mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.role_id){
        $scope.selectedRole.selected = data.role_id;
        }

                                    if(data.workstation_id){
        $scope.selectedWorkstation.selected = data.workstation_id;
        }

                            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.role_id){
        $scope.selectedRole.selected = data.role_id;
        }

                                    if(data.workstation_id){
        $scope.selectedWorkstation.selected = data.workstation_id;
        }

                            
    });
        }
    };


    var Users = $injector.get('Users');

    $scope.users = [];
    $scope.find = function()
    {
        Users.query(function(users)
        {
            $scope.users = users;
            $scope.$emit('findLoaded', { data: users });

            $scope.ngtUserResource.rows = $scope.users;
            $scope.ngtUserResource.pagination = {
                page: 1,
                size: $scope.users.length
            };
        });
    };

    $scope.user = {};
    $scope.findOne = function()
    {
        Users.get({
            userId: $stateParams.userId
        }, function(user)
        {
            $scope.user = user;
            $scope.$emit('findOneLoaded', user);
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

                                    
        $scope.workstations = [];
        $scope.workstation = {};
        $scope.selectedWorkstation = {};
        var Workstations = $injector.get('Workstations');
            $scope.findWorkstations = function()
            {
                Workstations.query(function(workstations)
                {
                    $scope.workstations = workstations;
                    $scope.$emit('findWorkstationsLoaded', { data: workstations });
                });
            };

            $scope.findWorkstations();

    

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var user = new Users({

                                
 username: this.username
                                
, email: this.email
                                
, password: this.password
                                
, name: this.name
                                
, firstName: this.firstName
                                
, lastName: this.lastName
                                
, lov_user_gender: this.lov_user_gender
                                
        , role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null

                                            
        , workstation_id: $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null

                                            
, lov_user_status: this.lov_user_status
                                            });
            $log.info('user to save');
            $log.info(user);

            user.$save(function(response)
            {
                $log.info('response save user');
                $log.info(response);
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
                
     user.role_id = $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null

                                        
     user.workstation_id = $scope.selectedWorkstation.selected ? $scope.selectedWorkstation.selected.id : null

                                        
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


    $scope.editableUpdate = function(user)
    {
        user.$update(function(response)
        {
            Notification.success({
                title:'User',
                message: 'User has been updated',
                delay: 4000
            });
        });

    };



}]);
