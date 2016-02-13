'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:workareasRoute
 * @description
 * # workareasRoute
 * Route of the workareas appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('workareas', {
        url: '/workareas',
        templateUrl: 'views/workareasHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-WORKAREAS-HOME-LABEL'
        }
    });
    $stateProvider.state('workareasList', {
        url: '/workareas/list',
        templateUrl: 'views/WORKAREASList.html',
        ncyBreadcrumb: {
            parent: 'workareas',
            label: 'BREADCRUMB-WORKAREAS-LIST-LABEL'
        }
    });
    $stateProvider.state('workareasView', {
        url: '/workareas/view/:workareaId',
        templateUrl: 'views/workareasView.html',
        ncyBreadcrumb: {
            parent: 'workareasList',
            label: 'BREADCRUMB-WORKAREAS-VIEW-LABEL'
        }
    });
    $stateProvider.state('workareasCreate', {
        url: '/workareas/create',
        templateUrl: 'views/workareasAdd.html',
        ncyBreadcrumb: {
            parent: 'workareasList',
            label: 'BREADCRUMB-WORKAREAS-CREATE-LABEL'
        }
    });
    $stateProvider.state('workareasEdit', {
        url: '/workareas/edit/:workareaId',
        templateUrl: 'views/workareasEdit.html',
        ncyBreadcrumb: {
            parent: 'workareasList',
            label: 'BREADCRUMB-WORKAREAS-EDIT-LABEL'
        }
    });
}
]);