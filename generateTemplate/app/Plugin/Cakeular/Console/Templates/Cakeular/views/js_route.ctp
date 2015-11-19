'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.route:<?php echo strtolower($pluralVar);?>Route
 * @description
 * # <?php echo strtolower($pluralVar);?>Route
 * Route of the <?php echo strtolower($pluralVar);?> appviewproject0001App
 */
angular.module('appviewproject0001App')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('<?php echo strtolower($pluralVar);?>', {
        url: '/<?php echo strtolower($pluralVar);?>',
        templateUrl: 'views/<?php echo strtolower($pluralVar);?>Home.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>List', {
        url: '/<?php echo strtolower($pluralVar);?>/list',
        templateUrl: 'views/<?php echo strtolower($pluralVar);?>List.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>View', {
        url: '/<?php echo strtolower($pluralVar);?>/view/:<?php echo $singularVar; ?>Id',
        templateUrl: 'views/<?php echo strtolower($pluralVar);?>View.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>Create', {
        url: '/<?php echo strtolower($pluralVar);?>/create',
        templateUrl: 'views/<?php echo strtolower($pluralVar);?>Add.html'
    });
    $stateProvider.state('<?php echo strtolower($pluralVar);?>Edit', {
        url: '/<?php echo strtolower($pluralVar);?>/edit/:<?php echo $singularVar; ?>Id',
        templateUrl: 'views/<?php echo strtolower($pluralVar);?>Edit.html'
    });
}
]);