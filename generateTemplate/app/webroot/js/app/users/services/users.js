'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Users
 * @description
 * # Users 
 * Service in the appviewproject0001App.
 */
//Users service used for users REST endpoint
angular.module('appviewproject0001App')
.service('Users',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/users/:userId', {
        userId: '@id'
    }, {
        get: {
            method:'GET', isArray:false
        },
        query:{
            method:'GET', isArray:false
        },
        update: {
            method: 'PUT'
        }
    });
}]);
