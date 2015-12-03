'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:rolesRoute
 * @description
 * # rolesRoute
 * Route of the roles appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('roles', {
        url: '/roles',
        templateUrl: 'views/rolesHome.html'
    });
    $stateProvider.state('rolesList', {
        url: '/roles/list',
        templateUrl: 'views/rolesList.html'
    });
    $stateProvider.state('rolesView', {
        url: '/roles/view/:roleId',
        templateUrl: 'views/rolesView.html'
    });
    $stateProvider.state('rolesCreate', {
        url: '/roles/create',
        templateUrl: 'views/rolesAdd.html'
    });
    $stateProvider.state('rolesEdit', {
        url: '/roles/edit/:roleId',
        templateUrl: 'views/rolesEdit.html'
    });
}
]);