'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('rolestates', {
        url: '/rolestates',
        templateUrl: '/js/app/rolestates/views/home.html'
    });
    $stateProvider.state('rolestatesList', {
        url: '/rolestates/list',
        templateUrl: '/js/app/rolestates/views/list.html'
    });
    $stateProvider.state('rolestatesView', {
        url: '/rolestates/view/:rolestateId',
        templateUrl: '/js/app/rolestates/views/view.html'
    });
    $stateProvider.state('rolestatesCreate', {
        url: '/rolestates/create',
        templateUrl: '/js/app/rolestates/views/add.html'
    });
    $stateProvider.state('rolestatesEdit', {
        url: '/rolestates/edit/:rolestateId',
        templateUrl: '/js/app/rolestates/views/edit.html'
    });
}
]);