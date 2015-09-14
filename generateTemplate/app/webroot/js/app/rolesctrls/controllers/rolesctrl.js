
project0001App
.controller('RolesctrlsController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
            $scope.find();
            $scope.ngtRolesctrlResource = {
                header: [
                                        {role_id: $translate.instant('role_id')}
                                , {ctrl_id: $translate.instant('ctrl_id')}
                                , {getAction: $translate.instant('getAction')}
                                , {postAction: $translate.instant('postAction')}
                                , {putAction: $translate.instant('putAction')}
                                , {patchAction: $translate.instant('patchAction')}
                                , {deleteAction: $translate.instant('deleteAction')}
                                , {copyAction: $translate.instant('copyAction')}
                                , {headAction: $translate.instant('headAction')}
                                , {optionsAction: $translate.instant('optionsAction')}
                                , {linkAction: $translate.instant('linkAction')}
                                , {unlinkAction: $translate.instant('unlinkAction')}
                                , {purgeAction: $translate.instant('purgeAction')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.rolesctrlFilters = '';
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

                                    if(data.ctrl_id){
        $scope.selectedCtrl.selected = data.ctrl_id;
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

                                    if(data.ctrl_id){
        $scope.selectedCtrl.selected = data.ctrl_id;
        }

                            
    });
        }
    };


    var Rolesctrls = $injector.get('Rolesctrls');

    $scope.rolesctrls = [];
    $scope.find = function()
    {
        Rolesctrls.query(function(rolesctrls)
        {
            $scope.rolesctrls = rolesctrls;
            $scope.$emit('findLoaded', { data: rolesctrls });

            $scope.ngtRolesctrlResource.rows = $scope.rolesctrls;
            $scope.ngtRolesctrlResource.pagination = {
                page: 1,
                size: $scope.rolesctrls.length
            };
        });
    };

    $scope.rolesctrl = {};
    $scope.findOne = function()
    {
        Rolesctrls.get({
            rolesctrlId: $stateParams.rolesctrlId
        }, function(rolesctrl)
        {
            $scope.rolesctrl = rolesctrl;
            $scope.$emit('findOneLoaded', rolesctrl);
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

                                    
        $scope.ctrls = [];
        $scope.ctrl = {};
        $scope.selectedCtrl = {};
        var Ctrls = $injector.get('Ctrls');
            $scope.findCtrls = function()
            {
                Ctrls.query(function(ctrls)
                {
                    $scope.ctrls = ctrls;
                    $scope.$emit('findCtrlsLoaded', { data: ctrls });
                });
            };

            $scope.findCtrls();

    

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var rolesctrl = new Rolesctrls({

                                
         role_id: $scope.selectedRole.selected ? $scope.selectedRole.selected.id : null

                                            
        , ctrl_id: $scope.selectedCtrl.selected ? $scope.selectedCtrl.selected.id : null

                                            
, getAction: this.getAction
                                
, postAction: this.postAction
                                
, putAction: this.putAction
                                
, patchAction: this.patchAction
                                
, deleteAction: this.deleteAction
                                
, copyAction: this.copyAction
                                
, headAction: this.headAction
                                
, optionsAction: this.optionsAction
                                
, linkAction: this.linkAction
                                
, unlinkAction: this.unlinkAction
                                
, purgeAction: this.purgeAction
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
