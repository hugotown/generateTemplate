
project0001App
.controller('RequestsController', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{
    $scope.prepareData = function()
    {
        var path = $location.path();
        if(path.indexOf('list') !== -1)
        {
            $scope.find();
            $scope.ngtRequestResource = {
                header: [
                                        {folio: $translate.instant('folio')}
                                , {name: $translate.instant('name')}
                                , {description: $translate.instant('description')}
                                , {lov_request_status: $translate.instant('lov_request_status')}
                                , {lov_request_type: $translate.instant('lov_request_type')}
                                , {lov_request_subtype: $translate.instant('lov_request_subtype')}
                                , {lov_request_priority: $translate.instant('lov_request_priority')}
                                , {lov_request_severity: $translate.instant('lov_request_severity')}
                                , {owner: $translate.instant('owner')}
                                , {Actions: $translate.instant('Actions')}
                ]
                , rows: new Array()
                //, sortBy: "name"
                , sortOrder: "asc"
                , pagination: {}
            };

            $scope.requestFilters = '';
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


    var Requests = $injector.get('Requests');

    $scope.requests = [];
    $scope.find = function()
    {
        Requests.query(function(requests)
        {
            $scope.requests = requests;
            $scope.$emit('findLoaded', { data: requests });

            $scope.ngtRequestResource.rows = $scope.requests;
            $scope.ngtRequestResource.pagination = {
                page: 1,
                size: $scope.requests.length
            };
        });
    };

    $scope.request = {};
    $scope.findOne = function()
    {
        Requests.get({
            requestId: $stateParams.requestId
        }, function(request)
        {
            $scope.request = request;
            $scope.$emit('findOneLoaded', request);
        });
    };



    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var request = new Requests({

                                
 folio: this.folio
                                
, name: this.name
                                
, description: this.description
                                
, lov_request_status: this.lov_request_status
                                
, lov_request_type: this.lov_request_type
                                
, lov_request_subtype: this.lov_request_subtype
                                
, lov_request_priority: this.lov_request_priority
                                
, lov_request_severity: this.lov_request_severity
                                
, owner: this.owner
                                            });

            request.$save(function(response)
            {
            $location.path('requests/view/' + response.id);
                Notification.success({
                    title:'Request',
                    message: 'Request has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var request = $scope.request;
                
        request.$update(function() {
          $location.path('requests/view/' + request.id);
          Notification.success({
                    title:'Request',
                    message: 'Request has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
