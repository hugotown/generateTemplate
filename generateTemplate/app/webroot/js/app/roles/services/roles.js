'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Roles
 * @description
 * # Roles 
 * Service in the appviewproject0001App.
 */
//Roles service used for roles REST endpoint
angular.module('appviewproject0001App')
.service('Roles',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/roles/:roleId', {
        roleId: '@id'
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
