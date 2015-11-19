'use strict';

/**
 * @ngdoc service
 * @name appviewproject0001App.Rolestates
 * @description
 * # Rolestates 
 * Service in the appviewproject0001App.
 */
//Rolestates service used for rolestates REST endpoint
angular.module('appviewproject0001App')
.service('Rolestates',
['$resource', 'API_URL_BASE',
function($resource, API_URL_BASE)
{
    //var $resource = $injector.get('$resource');
    return $resource( API_URL_BASE.url + '/rolestates/:rolestateId', {
        rolestateId: '@id'
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
