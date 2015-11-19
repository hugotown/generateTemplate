'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Ctrls
 * @description
 * # Ctrls 
 * Service in the appviewproject0001App.
 */
//Ctrls service used for ctrls REST endpoint
angular.module('appviewproject0001App')
.service('Ctrls',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/ctrls/:ctrlId', {
        ctrlId: '@id'
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
