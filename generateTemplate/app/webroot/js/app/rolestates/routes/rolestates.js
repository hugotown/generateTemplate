'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:rolestatesRoute
 * @description
 * # rolestatesRoute
 * Route of the rolestates appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('rolestates', {
        url: '/rolestates',
        templateUrl: 'views/rolestatesHome.html'
    });
    $stateProvider.state('rolestatesList', {
        url: '/rolestates/list',
        templateUrl: 'views/rolestatesList.html'
    });
    $stateProvider.state('rolestatesView', {
        url: '/rolestates/view/:rolestateId',
        templateUrl: 'views/rolestatesView.html'
    });
    $stateProvider.state('rolestatesCreate', {
        url: '/rolestates/create',
        templateUrl: 'views/rolestatesAdd.html'
    });
    $stateProvider.state('rolestatesEdit', {
        url: '/rolestates/edit/:rolestateId',
        templateUrl: 'views/rolestatesEdit.html'
    });
}
]);