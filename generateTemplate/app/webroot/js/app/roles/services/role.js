'use strict';

//Roles service used for roles REST endpoint
project0001App.factory('Roles', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/roles/:roleId', {
        roleId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
