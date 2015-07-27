'use strict';

//Lovs service used for lovs REST endpoint
project0001App.factory('Lovs', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/lovs/:lovId', {
        lovId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
