'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Buildings
 * @description
 * # Buildings 
 * Service in the appviewproject0001App.
 */
//Buildings service used for buildings REST endpoint
angular.module('appviewproject0001App')
.service('Buildings',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/buildings/:buildingId', {
        buildingId: '@id'
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
