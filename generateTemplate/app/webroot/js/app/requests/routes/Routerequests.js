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
        templateUrl: 'views/requestsHome.html'
    });
    $stateProvider.state('requestsList', {
        url: '/requests/list',
        templateUrl: 'views/requestsList.html'
    });
    $stateProvider.state('requestsView', {
        url: '/requests/view/:requestId',
        templateUrl: 'views/requestsView.html'
    });
    $stateProvider.state('requestsCreate', {
        url: '/requests/create',
        templateUrl: 'views/requestsAdd.html'
    });
    $stateProvider.state('requestsEdit', {
        url: '/requests/edit/:requestId',
        templateUrl: 'views/requestsEdit.html'
    });
}
]);