'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:lovsRoute
 * @description
 * # lovsRoute
 * Route of the lovs appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('lovs', {
        url: '/lovs',
        templateUrl: 'views/lovsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-LOVS-HOME-LABEL'
        }
    });
    $stateProvider.state('lovsList', {
        url: '/lovs/list',
        templateUrl: 'views/LOVSList.html',
        ncyBreadcrumb: {
            parent: 'lovs',
            label: 'BREADCRUMB-LOVS-LIST-LABEL'
        }
    });
    $stateProvider.state('lovsView', {
        url: '/lovs/view/:lovId',
        templateUrl: 'views/lovsView.html',
        ncyBreadcrumb: {
            parent: 'lovsList',
            label: 'BREADCRUMB-LOVS-VIEW-LABEL'
        }
    });
    $stateProvider.state('lovsCreate', {
        url: '/lovs/create',
        templateUrl: 'views/lovsAdd.html',
        ncyBreadcrumb: {
            parent: 'lovsList',
            label: 'BREADCRUMB-LOVS-CREATE-LABEL'
        }
    });
    $stateProvider.state('lovsEdit', {
        url: '/lovs/edit/:lovId',
        templateUrl: 'views/lovsEdit.html',
        ncyBreadcrumb: {
            parent: 'lovsList',
            label: 'BREADCRUMB-LOVS-EDIT-LABEL'
        }
    });
}
]);