
project0001App
.controller('CtrlsController', 
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
            $scope.ngtCtrlResource = {
                header: [
                                        {name: $translate.instant('name')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.ctrlFilters = '';
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


    var Ctrls = $injector.get('Ctrls');

    $scope.ctrls = [];
    $scope.find = function()
    {
        Ctrls.query(function(ctrls)
        {
            $scope.ctrls = ctrls;
            $scope.$emit('findLoaded', { data: ctrls });

            $scope.ngtCtrlResource.rows = $scope.ctrls;
            $scope.ngtCtrlResource.pagination = {
                page: 1,
                size: $scope.ctrls.length
            };
        });
    };

    $scope.ctrl = {};
    $scope.findOne = function()
    {
        Ctrls.get({
            ctrlId: $stateParams.ctrlId
        }, function(ctrl)
        {
            $scope.ctrl = ctrl;
            $scope.$emit('findOneLoaded', ctrl);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var ctrl = new Ctrls({

                                
 name: this.name
                                            });
            $log.info('ctrl to save');
            $log.info(ctrl);

            ctrl.$save(function(response)
            {
                $log.info('response save ctrl');
                $log.info(response);
                $location.path('ctrls/view/' + response.id);
                Notification.success({
                    title:'Ctrl',
                    message: 'Ctrl has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var ctrl = $scope.ctrl;
                
        ctrl.$update(function() {
          $location.path('ctrls/view/' + ctrl.id);
          Notification.success({
                    title:'Ctrl',
                    message: 'Ctrl has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(ctrl)
    {
        ctrl.$update(function(response)
        {
            Notification.success({
                title:'Ctrl',
                message: 'Ctrl has been updated',
                delay: 4000
            });
        });

    };



}]);
