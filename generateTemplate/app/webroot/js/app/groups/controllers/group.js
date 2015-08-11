
project0001App
.controller('GroupsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtGroupResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {lov_group_status: $translate.instant('lov_group_status')}
                                , {description: $translate.instant('description')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.groupFilters = '';
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
            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
            
    });
        }
    };


    var Groups = $injector.get('Groups');

    $scope.groups = [];
    $scope.find = function()
    {
        Groups.query(function(groups)
        {
            $scope.groups = groups;
            $scope.$emit('findLoaded', { data: groups });

            $scope.ngtGroupResource.rows = $scope.groups;
            $scope.ngtGroupResource.pagination = {
                page: 1,
                size: $scope.groups.length
            };
        });
    };

    $scope.group = {};
    $scope.findOne = function()
    {
        Groups.get({
            groupId: $stateParams.groupId
        }, function(group)
        {
            $scope.group = group;
            $scope.$emit('findOneLoaded', group);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var group = new Groups({

                                
 name: this.name
                                
, lov_group_status: this.lov_group_status
                                
, description: this.description
                                            });
            $log.info('group to save');
            $log.info(group);

            group.$save(function(response)
            {
                $log.info('response save group');
                $log.info(response);
                $location.path('groups/view/' + response.id);
                Notification.success({
                    title:'Group',
                    message: 'Group has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var group = $scope.group;
                
        group.$update(function() {
          $location.path('groups/view/' + group.id);
          Notification.success({
                    title:'Group',
                    message: 'Group has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(group)
    {
        group.$update(function(response)
        {
            Notification.success({
                title:'Group',
                message: 'Group has been updated',
                delay: 4000
            });
        });

    };



});
