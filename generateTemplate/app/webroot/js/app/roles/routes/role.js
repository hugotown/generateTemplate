'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('roles', {
        url: '/roles',
        templateUrl: '/js/app/roles/views/home.html'
    });
    $stateProvider.state('rolesList', {
        url: '/roles/list',
        templateUrl: '/js/app/roles/views/list.html'
    });
    $stateProvider.state('rolesView', {
        url: '/roles/view/:roleId',
        templateUrl: '/js/app/roles/views/view.html'
    });
    $stateProvider.state('rolesCreate', {
        url: '/roles/create',
        templateUrl: '/js/app/roles/views/add.html'
    });
    $stateProvider.state('rolesEdit', {
        url: '/roles/edit/:roleId',
        templateUrl: '/js/app/roles/views/edit.html'
    });
}
]);