'use strict';

//Users service used for users REST endpoint
project0001App.factory('Users', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/users/:userId', {
        userId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
