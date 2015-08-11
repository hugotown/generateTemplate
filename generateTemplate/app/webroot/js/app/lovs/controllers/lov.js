
project0001App
.controller('LovsController', function ($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
        $log.info('list mode');
            $scope.find();
            $scope.ngtLovResource = {
                header: [
                                        {orderShow: $translate.instant('orderShow')}
                                , {lovType: $translate.instant('lovType')}
                                , {name_: $translate.instant('name_')}
                                , {name_es_MX: $translate.instant('name_es_MX')}
                                , {name_en_US: $translate.instant('name_en_US')}
                                , {status: $translate.instant('status')}
                                , {parent_id: $translate.instant('parent_id')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.lovFilters = '';
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
                    if(data.parentLov_id){
        $scope.selectedLov.selected = data.parentLov_id;
        }

                            
    });
            
        }
        if(path.indexOf('view') !== -1)
        {
        $log.info('view mode');
            $scope.findOne();

        $scope.$on('findOneLoaded', function(event, data)
        {
                    if(data.parentLov_id){
        $scope.selectedLov.selected = data.parentLov_id;
        }

                            
    });
        }
    };


    var Lovs = $injector.get('Lovs');

    $scope.lovs = [];
    $scope.find = function()
    {
        Lovs.query(function(lovs)
        {
            $scope.lovs = lovs;
            $scope.$emit('findLoaded', { data: lovs });

            $scope.ngtLovResource.rows = $scope.lovs;
            $scope.ngtLovResource.pagination = {
                page: 1,
                size: $scope.lovs.length
            };
        });
    };

    $scope.lov = {};
    $scope.findOne = function()
    {
        Lovs.get({
            lovId: $stateParams.lovId
        }, function(lov)
        {
            $scope.lov = lov;
            $scope.$emit('findOneLoaded', lov);
        });
    };

                                
        $scope.lovs = [];
        $scope.parentLov = {};
        $scope.selectedLov = {};
        var Lovs = $injector.get('Lovs');
            $scope.findLovs = function()
            {
                Lovs.query(function(lovs)
                {
                    $scope.lovs = lovs;
                    $scope.$emit('findLovsLoaded', { data: lovs });
                });
            };

            $scope.findLovs();

    

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var lov = new Lovs({

                                
 orderShow: this.orderShow
                                
, lovType: this.lovType
                                
, name_: this.name_
                                
, name_es_MX: this.name_es_MX
                                
, name_en_US: this.name_en_US
                                
, status: this.status
                                
        , parent_id: $scope.selectedLov.selected ? $scope.selectedLov.selected.id : null

                                                        });
            $log.info('lov to save');
            $log.info(lov);

            lov.$save(function(response)
            {
                $log.info('response save lov');
                $log.info(response);
                $location.path('lovs/view/' + response.id);
                Notification.success({
                    title:'Lov',
                    message: 'Lov has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var lov = $scope.lov;
                
     lov.parent_id = $scope.selectedLov.selected ? $scope.selectedLov.selected.id : null

                                        
        lov.$update(function() {
          $location.path('lovs/view/' + lov.id);
          Notification.success({
                    title:'Lov',
                    message: 'Lov has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


    $scope.editableUpdate = function(lov)
    {
        lov.$update(function(response)
        {
            Notification.success({
                title:'Lov',
                message: 'Lov has been updated',
                delay: 4000
            });
        });

    };



});
