'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Rolesctrls
 * @description
 * # Rolesctrls 
 * Service in the appviewproject0001App.
 */
//Rolesctrls service used for rolesctrls REST endpoint
angular.module('appviewproject0001App')
.service('Rolesctrls',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/rolesctrls/:rolesctrlId', {
        rolesctrlId: '@id'
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
