'use strict';

/**
 * @ngdoc function
 * @name frontappApp.route:<?= strtolower($pluralVar);?>Route
 * @description
 * # <?= strtolower($pluralVar);?>Route
 * Route of the <?= strtolower($pluralVar);?> frontappApp
 */
angular.module('frontappApp')
.config(['$stateProvider',
function($stateProvider) {
    $stateProvider.state('<?= strtolower($pluralVar);?>', {
        url: '/<?= strtolower($pluralVar);?>',
        templateUrl: 'views/<?= strtolower($pluralVar);?>Home.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'Home'
        },
        ncyBreadcrumb: {
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-HOME-LABEL',
            skip: true
        }
    });
    $stateProvider.state('<?= strtolower($pluralVar);?>List', {
        url: '/<?= strtolower($pluralVar);?>/list',
        templateUrl: 'views/<?= strtolower($pluralVar);?>List.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'List'
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-LIST-LABEL'
        }
    });
    $stateProvider.state('<?= strtolower($pluralVar);?>View', {
        url: '/<?= strtolower($pluralVar);?>/view/:<?= $singularVar; ?>Id',
        templateUrl: 'views/<?= strtolower($pluralVar);?>View.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'View'
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-VIEW-LABEL'
        }
    });
    $stateProvider.state('<?= strtolower($pluralVar);?>Create', {
        url: '/<?= strtolower($pluralVar);?>/create',
        templateUrl: 'views/<?= strtolower($pluralVar);?>Add.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'Add'
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-CREATE-LABEL'
        }
    });
    $stateProvider.state('<?= strtolower($pluralVar);?>Edit', {
        url: '/<?= strtolower($pluralVar);?>/edit/:<?= $singularVar; ?>Id',
        templateUrl: 'views/<?= strtolower($pluralVar);?>Edit.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'Edit'
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-EDIT-LABEL'
        }
    });
}
]);