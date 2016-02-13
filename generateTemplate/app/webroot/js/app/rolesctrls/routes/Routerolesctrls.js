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
        templateUrl: 'views/rolesctrlsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-ROLESCTRLS-HOME-LABEL'
        }
    });
    $stateProvider.state('rolesctrlsList', {
        url: '/rolesctrls/list',
        templateUrl: 'views/ROLESCTRLSList.html',
        ncyBreadcrumb: {
            parent: 'rolesctrls',
            label: 'BREADCRUMB-ROLESCTRLS-LIST-LABEL'
        }
    });
    $stateProvider.state('rolesctrlsView', {
        url: '/rolesctrls/view/:rolesctrlId',
        templateUrl: 'views/rolesctrlsView.html',
        ncyBreadcrumb: {
            parent: 'rolesctrlsList',
            label: 'BREADCRUMB-ROLESCTRLS-VIEW-LABEL'
        }
    });
    $stateProvider.state('rolesctrlsCreate', {
        url: '/rolesctrls/create',
        templateUrl: 'views/rolesctrlsAdd.html',
        ncyBreadcrumb: {
            parent: 'rolesctrlsList',
            label: 'BREADCRUMB-ROLESCTRLS-CREATE-LABEL'
        }
    });
    $stateProvider.state('rolesctrlsEdit', {
        url: '/rolesctrls/edit/:rolesctrlId',
        templateUrl: 'views/rolesctrlsEdit.html',
        ncyBreadcrumb: {
            parent: 'rolesctrlsList',
            label: 'BREADCRUMB-ROLESCTRLS-EDIT-LABEL'
        }
    });
}
]);