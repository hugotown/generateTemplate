'use strict';

//Workstations service used for workstations REST endpoint
project0001App.factory('Workstations', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/workstations/:workstationId', {
        workstationId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
