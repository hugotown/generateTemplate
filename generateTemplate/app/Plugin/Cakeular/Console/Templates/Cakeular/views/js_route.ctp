<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
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
            pageTitle : '<?= Inflector::humanize($pluralVar); ?>',
            pageSubTitle : 'Home',
            scrollTop: true
        },
        ncyBreadcrumb: {
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-HOME-LABEL',
            skip: true
        },
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'frontappApp',
                    insertBefore: '#ng_load_plugins_before',
                    files: [
                        'scripts/controllers/<?= strtolower($pluralVar); ?>.js'
                    ]
                });
            }]
        }
    });

    $stateProvider.state('<?= strtolower($pluralVar);?>List', {
        url: '/<?= strtolower($pluralVar);?>/list',
        templateUrl: 'views/<?= strtolower($pluralVar);?>List.html',
        data: {
            pageTitle : '<?= Inflector::humanize($pluralVar); ?>',
            pageSubTitle : 'List',
            scrollTop: true
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-LIST-LABEL'
        },
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'frontappApp',
                    insertBefore: '#ng_load_plugins_before',
                    files: [
                        'scripts/controllers/<?= strtolower($pluralVar); ?>.js'
                    ]
                });
            }]
        }
    });

    $stateProvider.state('<?= strtolower($pluralVar);?>View', {
        url: '/<?= strtolower($pluralVar);?>/view/:<?= $singularVar; ?>Id',
        templateUrl: 'views/<?= strtolower($pluralVar);?>View.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'View',
            scrollTop: true
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-VIEW-LABEL'
        },
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'frontappApp',
                    insertBefore: '#ng_load_plugins_before',
                    files: [
                        'scripts/controllers/<?= strtolower($pluralVar); ?>.js'
                    ]
                });
            }]
        }
    });

    $stateProvider.state('<?= strtolower($pluralVar);?>Create', {
        url: '/<?= strtolower($pluralVar);?>/create',
        templateUrl: 'views/<?= strtolower($pluralVar);?>Add.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'Create',
            scrollTop: true
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-CREATE-LABEL'
        },
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'frontappApp',
                    insertBefore: '#ng_load_plugins_before',
                    files: [
                        'scripts/controllers/<?= strtolower($pluralVar); ?>.js'
                    ]
                });
            }]
        }
    });

    $stateProvider.state('<?= strtolower($pluralVar);?>Edit', {
        url: '/<?= strtolower($pluralVar);?>/edit/:<?= $singularVar; ?>Id',
        templateUrl: 'views/<?= strtolower($pluralVar);?>Edit.html',
        data: {
            pageTitle : '<?= Inflector::humanize($singularVar); ?>',
            pageSubTitle : 'Edit',
            scrollTop: true
        },
        ncyBreadcrumb: {
            parent: '<?= strtolower($pluralVar);?>List',
            label: 'BREADCRUMB-<?= strtoupper($pluralVar);?>-EDIT-LABEL'
        },
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'frontappApp',
                    insertBefore: '#ng_load_plugins_before',
                    files: [
                        'scripts/controllers/<?= strtolower($pluralVar); ?>.js'
                    ]
                });
            }]
        }
    });

<?php
if( empty( $associations['hasMany'] ) )
{
    $associations['hasMany'] = array();
}
if( empty( $associations['hasAndBelongsToMany'] ) )
{
    $associations['hasAndBelongsToMany'] = array();
}
$daRelationships = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany'] );


foreach($daRelationships as $alias => $details)
{
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
    $otherPluralVar = Inflector::variable($details['controller']);
    echo "\n";
    echo "\$stateProvider.state('".strtolower($pluralVar)."View.".Inflector::pluralize($otherSingularVar)."', {"."\n";
    echo "  url: '/". Inflector::pluralize($otherSingularVar)."',"."\n";
    echo "  templateUrl: '',"."\n";
    echo "  data: {"."\n";
    echo "      pageTitle : '". Inflector::humanize($singularVar)."',"."\n";
    echo "      pageSubTitle : 'View',"."\n";
    echo "      scrollTop: false"."\n";
    echo "  },"."\n";
    echo "  views: {"."\n";
    echo "      'viewTab':{templateUrl:'views/". strtolower($otherPluralVar)."List.html'}"."\n";
    echo "  },"."\n";
    echo "  ncyBreadcrumb: {"."\n";
    echo "      parent: '".strtolower($pluralVar)."List',"."\n";
    echo "      label: 'BREADCRUMB-". strtoupper($pluralVar)."-VIEW-". strtoupper( Inflector::pluralize($otherSingularVar) )."-LABEL'"."\n";
    echo "  },"."\n";
    echo "  resolve: {"."\n";
    echo "      deps: ['\$ocLazyLoad', function(\$ocLazyLoad) {"."\n";
    echo "          return \$ocLazyLoad.load({"."\n";
    echo "              name: 'frontappApp',"."\n";
    echo "              insertBefore: '#ng_load_plugins_before',"."\n";
    echo "              files: ["."\n";
    echo "                  'scripts/controllers/". strtolower($pluralVar).".js',"."\n";
    echo "                  'scripts/controllers/". Inflector::pluralize($otherSingularVar).".js'"."\n";
    echo "              ]"."\n";
    echo "          });"."\n";
    echo "      }]"."\n";
    echo "  }"."\n";
    echo "});"."\n";
}

?>

}
]);