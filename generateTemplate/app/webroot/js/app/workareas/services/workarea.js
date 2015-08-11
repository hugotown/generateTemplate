'use strict';

//Workareas service used for workareas REST endpoint
project0001App.factory('Workareas', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/workareas/:workareaId', {
        workareaId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
