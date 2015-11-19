'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Requests
 * @description
 * # Requests 
 * Service in the appviewproject0001App.
 */
//Requests service used for requests REST endpoint
angular.module('appviewproject0001App')
.service('Requests',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/requests/:requestId', {
        requestId: '@id'
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
