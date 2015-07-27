'use strict';

//Buildings service used for buildings REST endpoint
project0001App.factory('Buildings', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/buildings/:buildingId', {
        buildingId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
