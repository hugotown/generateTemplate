'use strict';

//Rolesctrls service used for rolesctrls REST endpoint
project0001App.factory('Rolesctrls', ['$resource', function($resource)
{
    //var $resource = $injector.get('$resource');
    return $resource('/rolesctrls/:rolesctrlId', {
        rolesctrlId: '@id'
    }, {
      update: {
        method: 'PUT'
      }
    });
}]);
