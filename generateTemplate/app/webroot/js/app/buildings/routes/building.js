'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('buildings', {
        url: '/buildings',
        templateUrl: '/js/app/buildings/views/home.html'
    });
    $stateProvider.state('buildingsList', {
        url: '/buildings/list',
        templateUrl: '/js/app/buildings/views/list.html'
    });
    $stateProvider.state('buildingsView', {
        url: '/buildings/view/:id',
        templateUrl: '/js/app/buildings/views/view.html'
    });
    $stateProvider.state('buildingsCreate', {
        url: '/buildings/create',
        templateUrl: '/js/app/buildings/views/add.html'
    });
    $stateProvider.state('buildingsEdit', {
        url: '/buildings/edit/:id',
        templateUrl: '/js/app/buildings/views/edit.html'
    });
}
]);