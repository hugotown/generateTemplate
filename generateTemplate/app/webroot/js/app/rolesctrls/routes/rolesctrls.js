'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:rolesctrlsRoute
 * @description
 * # rolesctrlsRoute
 * Route of the rolesctrls appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('rolesctrls', {
        url: '/rolesctrls',
        templateUrl: 'views/rolesctrlsHome.html'
    });
    $stateProvider.state('rolesctrlsList', {
        url: '/rolesctrls/list',
        templateUrl: 'views/rolesctrlsList.html'
    });
    $stateProvider.state('rolesctrlsView', {
        url: '/rolesctrls/view/:rolesctrlId',
        templateUrl: 'views/rolesctrlsView.html'
    });
    $stateProvider.state('rolesctrlsCreate', {
        url: '/rolesctrls/create',
        templateUrl: 'views/rolesctrlsAdd.html'
    });
    $stateProvider.state('rolesctrlsEdit', {
        url: '/rolesctrls/edit/:rolesctrlId',
        templateUrl: 'views/rolesctrlsEdit.html'
    });
}
]);