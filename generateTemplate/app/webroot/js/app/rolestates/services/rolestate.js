'use strict';

//Rolestates service used for rolestates REST endpoint
project0001App.factory('Rolestates', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/rolestates/:rolestateId', {
        rolestateId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
