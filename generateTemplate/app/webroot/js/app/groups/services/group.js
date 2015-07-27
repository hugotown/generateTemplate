'use strict';

//Groups service used for groups REST endpoint
project0001App.factory('Groups', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/groups/:groupId', {
        groupId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
