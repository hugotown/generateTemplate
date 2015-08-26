'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('requests', {
        url: '/requests',
        templateUrl: '/js/app/requests/views/home.html'
    });
    $stateProvider.state('requestsList', {
        url: '/requests/list',
        templateUrl: '/js/app/requests/views/list.html'
    });
    $stateProvider.state('requestsView', {
        url: '/requests/view/:requestId',
        templateUrl: '/js/app/requests/views/view.html'
    });
    $stateProvider.state('requestsCreate', {
        url: '/requests/create',
        templateUrl: '/js/app/requests/views/add.html'
    });
    $stateProvider.state('requestsEdit', {
        url: '/requests/edit/:requestId',
        templateUrl: '/js/app/requests/views/edit.html'
    });
}
]);