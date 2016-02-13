'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:ctrlsRoute
 * @description
 * # ctrlsRoute
 * Route of the ctrls appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('ctrls', {
        url: '/ctrls',
        templateUrl: 'views/ctrlsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-CTRLS-HOME-LABEL'
        }
    });
    $stateProvider.state('ctrlsList', {
        url: '/ctrls/list',
        templateUrl: 'views/CTRLSList.html',
        ncyBreadcrumb: {
            parent: 'ctrls',
            label: 'BREADCRUMB-CTRLS-LIST-LABEL'
        }
    });
    $stateProvider.state('ctrlsView', {
        url: '/ctrls/view/:ctrlId',
        templateUrl: 'views/ctrlsView.html',
        ncyBreadcrumb: {
            parent: 'ctrlsList',
            label: 'BREADCRUMB-CTRLS-VIEW-LABEL'
        }
    });
    $stateProvider.state('ctrlsCreate', {
        url: '/ctrls/create',
        templateUrl: 'views/ctrlsAdd.html',
        ncyBreadcrumb: {
            parent: 'ctrlsList',
            label: 'BREADCRUMB-CTRLS-CREATE-LABEL'
        }
    });
    $stateProvider.state('ctrlsEdit', {
        url: '/ctrls/edit/:ctrlId',
        templateUrl: 'views/ctrlsEdit.html',
        ncyBreadcrumb: {
            parent: 'ctrlsList',
            label: 'BREADCRUMB-CTRLS-EDIT-LABEL'
        }
    });
}
]);