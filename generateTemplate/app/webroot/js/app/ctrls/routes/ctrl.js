'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('ctrls', {
        url: '/ctrls',
        templateUrl: '/js/app/ctrls/views/home.html'
    });
    $stateProvider.state('ctrlsList', {
        url: '/ctrls/list',
        templateUrl: '/js/app/ctrls/views/list.html'
    });
    $stateProvider.state('ctrlsView', {
        url: '/ctrls/view/:ctrlId',
        templateUrl: '/js/app/ctrls/views/view.html'
    });
    $stateProvider.state('ctrlsCreate', {
        url: '/ctrls/create',
        templateUrl: '/js/app/ctrls/views/add.html'
    });
    $stateProvider.state('ctrlsEdit', {
        url: '/ctrls/edit/:ctrlId',
        templateUrl: '/js/app/ctrls/views/edit.html'
    });
}
]);