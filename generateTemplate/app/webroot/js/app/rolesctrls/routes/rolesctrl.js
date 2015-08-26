'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('rolesctrls', {
        url: '/rolesctrls',
        templateUrl: '/js/app/rolesctrls/views/home.html'
    });
    $stateProvider.state('rolesctrlsList', {
        url: '/rolesctrls/list',
        templateUrl: '/js/app/rolesctrls/views/list.html'
    });
    $stateProvider.state('rolesctrlsView', {
        url: '/rolesctrls/view/:rolesctrlId',
        templateUrl: '/js/app/rolesctrls/views/view.html'
    });
    $stateProvider.state('rolesctrlsCreate', {
        url: '/rolesctrls/create',
        templateUrl: '/js/app/rolesctrls/views/add.html'
    });
    $stateProvider.state('rolesctrlsEdit', {
        url: '/rolesctrls/edit/:rolesctrlId',
        templateUrl: '/js/app/rolesctrls/views/edit.html'
    });
}
]);