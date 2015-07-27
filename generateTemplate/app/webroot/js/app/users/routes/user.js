'use strict';

project0001App.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('users', {
        url: '/users',
        templateUrl: '/js/app/users/views/home.html'
    });
    $stateProvider.state('usersList', {
        url: '/users/list',
        templateUrl: '/js/app/users/views/list.html'
    });
    $stateProvider.state('usersView', {
        url: '/users/view/:id',
        templateUrl: '/js/app/users/views/view.html'
    });
    $stateProvider.state('usersCreate', {
        url: '/users/create',
        templateUrl: '/js/app/users/views/add.html'
    });
    $stateProvider.state('usersEdit', {
        url: '/users/edit/:id',
        templateUrl: '/js/app/users/views/edit.html'
    });
}
]);