'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Workareas
 * @description
 * # Workareas 
 * Service in the appviewproject0001App.
 */
//Workareas service used for workareas REST endpoint
angular.module('appviewproject0001App')
.service('Workareas',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/workareas/:workareaId', {
        workareaId: '@id'
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
