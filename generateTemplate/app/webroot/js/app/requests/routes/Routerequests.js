'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:requestsRoute
 * @description
 * # requestsRoute
 * Route of the requests appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('requests', {
        url: '/requests',
        templateUrl: 'views/requestsHome.html',
        ncyBreadcrumb: {
            label: 'BREADCRUMB-REQUESTS-HOME-LABEL'
        }
    });
    $stateProvider.state('requestsList', {
        url: '/requests/list',
        templateUrl: 'views/REQUESTSList.html',
        ncyBreadcrumb: {
            parent: 'requests',
            label: 'BREADCRUMB-REQUESTS-LIST-LABEL'
        }
    });
    $stateProvider.state('requestsView', {
        url: '/requests/view/:requestId',
        templateUrl: 'views/requestsView.html',
        ncyBreadcrumb: {
            parent: 'requestsList',
            label: 'BREADCRUMB-REQUESTS-VIEW-LABEL'
        }
    });
    $stateProvider.state('requestsCreate', {
        url: '/requests/create',
        templateUrl: 'views/requestsAdd.html',
        ncyBreadcrumb: {
            parent: 'requestsList',
            label: 'BREADCRUMB-REQUESTS-CREATE-LABEL'
        }
    });
    $stateProvider.state('requestsEdit', {
        url: '/requests/edit/:requestId',
        templateUrl: 'views/requestsEdit.html',
        ncyBreadcrumb: {
            parent: 'requestsList',
            label: 'BREADCRUMB-REQUESTS-EDIT-LABEL'
        }
    });
}
]);