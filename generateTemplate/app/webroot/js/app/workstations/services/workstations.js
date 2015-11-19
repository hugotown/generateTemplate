'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Workstations
 * @description
 * # Workstations 
 * Service in the appviewproject0001App.
 */
//Workstations service used for workstations REST endpoint
angular.module('appviewproject0001App')
.service('Workstations',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/workstations/:workstationId', {
        workstationId: '@id'
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
