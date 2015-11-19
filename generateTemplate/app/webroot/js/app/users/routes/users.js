'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:usersRoute
 * @description
 * # usersRoute
 * Route of the users appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('users', {
        url: '/users',
        templateUrl: 'views/usersHome.html'
    });
    $stateProvider.state('usersList', {
        url: '/users/list',
        templateUrl: 'views/usersList.html'
    });
    $stateProvider.state('usersView', {
        url: '/users/view/:userId',
        templateUrl: 'views/usersView.html'
    });
    $stateProvider.state('usersCreate', {
        url: '/users/create',
        templateUrl: 'views/usersAdd.html'
    });
    $stateProvider.state('usersEdit', {
        url: '/users/edit/:userId',
        templateUrl: 'views/usersEdit.html'
    });
}
]);