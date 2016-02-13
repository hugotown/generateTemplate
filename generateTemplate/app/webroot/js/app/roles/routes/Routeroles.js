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
        templateUrl: 'views/rolesHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-ROLES-HOME-LABEL'
        }
    });
    $stateProvider.state('rolesList', {
        url: '/roles/list',
        templateUrl: 'views/ROLESList.html',
        ncyBreadcrumb: {
            parent: 'roles',
            label: 'BREADCRUMB-ROLES-LIST-LABEL'
        }
    });
    $stateProvider.state('rolesView', {
        url: '/roles/view/:roleId',
        templateUrl: 'views/rolesView.html',
        ncyBreadcrumb: {
            parent: 'rolesList',
            label: 'BREADCRUMB-ROLES-VIEW-LABEL'
        }
    });
    $stateProvider.state('rolesCreate', {
        url: '/roles/create',
        templateUrl: 'views/rolesAdd.html',
        ncyBreadcrumb: {
            parent: 'rolesList',
            label: 'BREADCRUMB-ROLES-CREATE-LABEL'
        }
    });
    $stateProvider.state('rolesEdit', {
        url: '/roles/edit/:roleId',
        templateUrl: 'views/rolesEdit.html',
        ncyBreadcrumb: {
            parent: 'rolesList',
            label: 'BREADCRUMB-ROLES-EDIT-LABEL'
        }
    });
}
]);