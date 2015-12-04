'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Buildingspots
 * @description
 * # Buildingspots 
 * Service in the appviewproject0001App.
 */
//Buildingspots service used for buildingspots REST endpoint
angular.module('appviewproject0001App')
.service('Buildingspots',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/buildingspots/:buildingspotId', {
        buildingspotId: '@id'
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
