'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:usersRoute
 * @description
 * # usersRoute
 * Route of the users appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('users', {
        url: '/users',
        templateUrl: 'views/usersHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-USERS-HOME-LABEL'
        }
    });
    $stateProvider.state('usersList', {
        url: '/users/list',
        templateUrl: 'views/USERSList.html',
        ncyBreadcrumb: {
            parent: 'users',
            label: 'BREADCRUMB-USERS-LIST-LABEL'
        }
    });
    $stateProvider.state('usersView', {
        url: '/users/view/:userId',
        templateUrl: 'views/usersView.html',
        ncyBreadcrumb: {
            parent: 'usersList',
            label: 'BREADCRUMB-USERS-VIEW-LABEL'
        }
    });
    $stateProvider.state('usersCreate', {
        url: '/users/create',
        templateUrl: 'views/usersAdd.html',
        ncyBreadcrumb: {
            parent: 'usersList',
            label: 'BREADCRUMB-USERS-CREATE-LABEL'
        }
    });
    $stateProvider.state('usersEdit', {
        url: '/users/edit/:userId',
        templateUrl: 'views/usersEdit.html',
        ncyBreadcrumb: {
            parent: 'usersList',
            label: 'BREADCRUMB-USERS-EDIT-LABEL'
        }
    });
}
]);