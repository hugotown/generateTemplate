
project0001App
.controller('WorkareasController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtWorkareaResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {description: $translate.instant('description')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.workareaFilters = '';
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


    var Workareas = $injector.get('Workareas');

    $scope.workareas = [];
    $scope.find = function()
    {
        Workareas.query(function(workareas)
        {
            $scope.workareas = workareas;
            $scope.$emit('findLoaded', { data: workareas });

            $scope.ngtWorkareaResource.rows = $scope.workareas;
            $scope.ngtWorkareaResource.pagination = {
                page: 1,
                size: $scope.workareas.length
            };
        });
    };

    $scope.workarea = {};
    $scope.findOne = function()
    {
        Workareas.get({
            workareaId: $stateParams.workareaId
        }, function(workarea)
        {
            $scope.workarea = workarea;
            $scope.$emit('findOneLoaded', workarea);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var workarea = new Workareas({

                                
 name: this.name
                                
, description: this.description
                                            });
            $log.info('workarea to save');
            $log.info(workarea);

            workarea.$save(function(response)
            {
                $log.info('response save workarea');
                $log.info(response);
                $location.path('workareas/view/' + response.id);
                Notification.success({
                    title:'Workarea',
                    message: 'Workarea has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var workarea = $scope.workarea;
                
        workarea.$update(function() {
          $location.path('workareas/view/' + workarea.id);
          Notification.success({
                    title:'Workarea',
                    message: 'Workarea has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(workarea)
    {
        workarea.$update(function(response)
        {
            Notification.success({
                title:'Workarea',
                message: 'Workarea has been updated',
                delay: 4000
            });
        });

    };



});
