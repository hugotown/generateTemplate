'use strict';

//Requests service used for requests REST endpoint
project0001App.factory('Requests', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/requests/:requestId', {
        requestId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
