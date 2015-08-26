'use strict';

//Ctrls service used for ctrls REST endpoint
project0001App.factory('Ctrls', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/ctrls/:ctrlId', {
        ctrlId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
