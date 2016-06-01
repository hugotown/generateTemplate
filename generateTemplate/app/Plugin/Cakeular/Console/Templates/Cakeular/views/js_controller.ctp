<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
'use strict';

/**
 * @ngdoc function
 * @name frontappApp.controller:<?= Inflector::humanize($pluralVar); ?>Ctrl
 * @description
 * # <?= Inflector::humanize($pluralVar); ?>Ctrl
 * Controller of the appviewproject0001App
 */
angular.module('frontappApp')
 .controller('<?= Inflector::humanize($pluralVar); ?>Ctrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

<?php
foreach ($fields as $key => $field)
{
    if(isset($associations['belongsTo']))
    {
        if(!empty($associations['belongsTo']))
        {
            foreach ($associations['belongsTo'] as $alias => $details)
            {
                if($details['foreignKey'] == $field)
                {
                    $otherSingularVar = Inflector::variable($alias);
                    $otherPluralHumanName = Inflector::humanize($details['controller']);
                    $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                    $otherPluralVar = Inflector::variable($details['controller']);

                    echo "\n";
                    echo "      \$scope.". Inflector::pluralize($otherSingularVar) . ' = [];'."\n";
                    echo "      \$scope.". $otherSingularVar . ' = {};'. "\n";
                    echo "      \$scope.selected" . $alias ." = {}; "."\n";
                }
            }
        }
    }
}

echo "\n";
foreach ($fields as $key => $field)
{
    if(strpos($field,'lov_') !== false)
    {
        $fieldNameWLov = str_replace('lov_', '', $field);
        $upperFieldNameWLov = strtoupper($fieldNameWLov);
        echo "\n";
        echo "      \$scope.lov". Inflector::pluralize( Inflector::camelize( $fieldNameWLov ) ). " = [];"."\n";
        echo "      \$scope.lov". Inflector::camelize($fieldNameWLov). " = {};"."\n";
    }
}
?>


    if( $state.current.name.indexOf('List') !== -1 )
    {
        $rootScope.parentObj = null;
        $rootScope.parentObjName = null;
        $rootScope.parentObjType = null;
    }

    if( $state.current.name.indexOf('Create') !== -1 )
    {

<?php
foreach ($fields as $key => $field)
{
    if(isset($associations['belongsTo']))
    {
        if(!empty($associations['belongsTo']))
        {
            foreach ($associations['belongsTo'] as $alias => $details)
            {
                if($details['foreignKey'] == $field)
                {
                    $otherSingularVar = Inflector::variable($alias);
                    $otherPluralHumanName = Inflector::humanize($details['controller']);
                    $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                    $otherPluralVar = Inflector::variable($details['controller']);

                    echo "\n";
                    echo "          if(\$rootScope.parentObjType ===  '" . $otherSingularHumanName ."')" ."\n";
                    echo "          {"."\n";
                    echo "              \$scope.selected" . $alias .".selected = \$rootScope.parentObj; ". "\n";
                    echo "          } "."\n";
                }
            }
        }
    }
}
?>
    }

        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 )
            {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = '<?= Inflector::humanize($singularVar); ?>';
                $state.current.data.cObjType = '<?= Inflector::humanize($singularVar); ?>';
                $state.current.data.cObjName = data.name || '';
                $state.current.data.cObj = data;
                $state.current.data.pageSubTitle = data.name || '';
            }

            if( $state.current.name.indexOf('Edit') !== -1 )
            {
                $state.current.data.cObjType = '<?= Inflector::humanize($singularVar); ?>';
                $state.current.data.cObjName = data.name || '';
                $state.current.data.cObj = data;
                $state.current.data.pageSubTitle = data.name || '';
            }

            <?php 
            foreach ($fields as $key => $field)
            {
                if(isset($associations['belongsTo']))
                {
                    if(!empty($associations['belongsTo']))
                    {
                        foreach ($associations['belongsTo'] as $alias => $details)
                        {
                            if($details['foreignKey'] == $field)
                            {
                                $otherSingularVar = Inflector::variable($alias);
                                $otherPluralHumanName = Inflector::humanize($details['controller']);
                                $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                $otherPluralVar = Inflector::variable($details['controller']);
                                echo "\n";
                                echo "              \$scope.selected". $alias ." ={};". "\n";
                                echo "              if(data.". $field. ")". "\n";
                                echo "              {". "\n";
                                echo "                  \$scope.selected". $alias .".selected = data.". $field .";". "\n";
                                echo "              }". "\n";

                            }
                        }
                    }

                }

                if(strpos($field,'lov_') !== false)
                {
                    $fieldNameWLov = str_replace('lov_', '', $field);
                    $upperFieldNameWLov = strtoupper($fieldNameWLov);
                    echo "\n";
                    echo "              if (data.". $field ." && data.". $field ." !== '')"."\n";
                    echo "              {"."\n";
                    echo "                  \$scope.setSelectedLov( data.". $field .", '". $upperFieldNameWLov ."', \$scope.lov".  Inflector::camelize( $fieldNameWLov ) ." );"."\n";
                    echo "              }"."\n";
                }

            }
            echo "              event = null;". "\n";
            echo "              data = null;". "\n";
            ?>

        });

    $scope.<?= $singularVar; ?>Filters = {};
    $scope.get<?= Inflector::humanize($pluralVar); ?> = function(params, paramsObj)
    {
        var urlApi = $rootScope.appSettings.backendUrl +'/<?= $pluralVar; ?>?';

        if( paramsObj.count !== undefined )
        {
            var skip = (paramsObj.count * (paramsObj.page - 1));
            urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
        }

        if( paramsObj.sortBy !== undefined )
        {
            urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
        }

        if( paramsObj.filters !== undefined )
        {
            urlApi += '&where={';
            var strWhereCond = '';

<?php
foreach ($fields as $field)
{
    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
    {
        $fieldAlreadyPainted = false;
        if (isset($associations['belongsTo']))
        {
            if (!empty($associations['belongsTo']))
            {
                foreach ($associations['belongsTo'] as $alias => $details)
                {
                    if ($details['foreignKey'] == $field)
                    {
                        $otherSingularVar = Inflector::variable($alias);
                        $otherPluralHumanName = Inflector::humanize($details['controller']);
                        $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                        $otherPluralVar = Inflector::variable($details['controller']);
                        $fieldAlreadyPainted = true;
                        ?>

                if( $rootScope.parentObjType === '<?= $otherSingularHumanName; ?>' )
                {
                    $scope.<?= $singularVar; ?>Filters.<?= $field; ?> ={};
                    $scope.<?= $singularVar; ?>Filters.<?= $field; ?>.selected = $rootScope.parentObj;
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                    strWhereCond += '"<?= $field; ?>": ' + $scope.<?= $singularVar; ?>Filters.<?= $field; ?>.selected.id ;
                } else {
                    if( paramsObj.filters.<?= $field; ?> && paramsObj.filters.<?= $field; ?>.selected )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?>.selected.id ;
                    }
                }
                        <?php
                    }
                }
            }
        }
        if (!$fieldAlreadyPainted) {

            switch ($schema[$field]["type"]) {
                case 'string': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": {"contains":"' + paramsObj.filters.<?= $field; ?> + '"}';
                    }
                    <?php
                    break;
                }
                case 'text': {
                    break;
                }
                case 'boolean': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined  )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?>.value ;
                    }
                    <?php
                    break;
                }
                case 'decimal': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'float': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'integer': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'date': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": "' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'datetime': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                        if(strWhereCond !== '') { strWhereCond += ','; } else { strWhereCond += ''; }
                        strWhereCond += '"<?= $field; ?>": "' + paramsObj.filters.<?= $field; ?> + '"';
                    }
                    <?php
                    break;
                }

                default : {
                    //none
                    break;
                }
            }
        }
    }
}
?>

        if(strWhereCond !== '') { $scope.tableIsFiltered = true; } else { $scope.tableIsFiltered = undefined; }
        urlApi += strWhereCond;
        urlApi += '}';
      }

      return $http.get(urlApi).then(function (r) {
          var data = {
              'rows': r.data.items,
              'header': [
                    <?php $countIdx = 0; ?>
                    <?php foreach ($fields as $key => $field)
                    {
                        if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                        {


                            switch ($schema[$field]["type"])
                            {
                                case 'string': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'text': {
                                    break;
                                }
                                case 'boolean': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'decimal': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'float': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'integer': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'date': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }
                                case 'datetime': {
                                    echo "\n";
                                    echo "                  { 'key': '". $field ."', 'name': \$translate.instant('". $singularVar ."-" . $field . "'), ";
                                    echo "\n";
                                    echo "                  'style': {}, 'class': [ 'text-center' ]} ,";
                                    $countIdx ++;
                                    break;
                                }

                                default : {
                                    //none
                                }
                            }
                        }
                    }
                    ?>

                { 'key': 'actions', 'name': $translate.instant('<?= $singularVar; ?>-actions'),
                'style': {}, 'class': [ 'text-center' ]
                }
              ],
              'pagination': {
                  'count': paramsObj.count,
                  'page': paramsObj.page,
                  'pages': Math.ceil(r.data.info.total / paramsObj.count),
                  'size': r.data.info.total
              },
              'sortBy': paramsObj.sortBy,
              'sortOrder': paramsObj.sortOrder
          };
          return data;
      });
  };

    var <?= Inflector::humanize($pluralVar); ?> = $injector.get('<?= Inflector::humanize($pluralVar); ?>');

    $scope.<?= $pluralVar; ?> = [];
    $scope.find = function()
    {
        return <?= Inflector::humanize($pluralVar); ?>.query(function(<?= $pluralVar; ?>)
        {
            $scope.<?= $pluralVar; ?> = <?= $pluralVar; ?>;
            $scope.$emit('findLoaded', { data: <?= $pluralVar; ?> });
            return $scope.<?= $pluralVar; ?>;
        });
    };

    $scope.<?= $singularVar; ?> = {};
    $scope.findOne = function()
    {
        return <?= Inflector::humanize($pluralVar); ?>.get({
            <?= $singularVar; ?>Id: $stateParams.<?= $singularVar; ?>Id
        }, function(<?= $singularVar; ?>)
        {
            $scope.<?= $singularVar; ?> = <?= $singularVar; ?>;
            $scope.$emit('findOneLoaded', <?= $singularVar; ?>);
            return $scope.<?= $singularVar; ?>;
        });
    };

<?php
if (isset($associations['belongsTo']))
{
    if(!empty($associations['belongsTo']))
    {
        foreach ($associations['belongsTo'] as $alias => $details)
        {
            $otherSingularVar = Inflector::variable($alias);
            $otherPluralVar = Inflector::variable($details['controller']);
            $otherPluralHumanName = Inflector::humanize($details['controller']);
            $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);

            if($singularHumanName != $otherSingularHumanName)
            {
                echo "var ". $otherPluralHumanName . " = \$injector.get('". $otherPluralHumanName."');"."\n";

            }
            ?>

        $scope.find<?= Inflector::pluralize($alias); ?> = function($param)
        {
            if(typeof $param !== 'undefined' && $param !== '')
            {
                return <?= $otherPluralHumanName; ?>.query({
                    where: {
                        name: {
                            contains: $param
                        }
                    }
                },function(<?= $otherPluralVar; ?>)
                {
                    $scope.<?= Inflector::pluralize($otherSingularVar); ?> = <?= $otherPluralVar; ?>.items;
                    $scope.$emit('find<?= $otherPluralHumanName; ?>Loaded', { data: <?= $otherPluralVar; ?> });
                    return $scope.<?= $otherPluralVar; ?>;
                });
            } else {
                return <?= $otherPluralHumanName; ?>.query({
                    limit:10
                },function(<?= $otherPluralVar; ?>)
                {
                    $scope.<?= Inflector::pluralize($otherSingularVar); ?> = <?= $otherPluralVar; ?>.items;
                    $scope.$emit('find<?= $otherPluralHumanName; ?>Loaded', { data: <?= $otherPluralVar; ?> });
                    return $scope.<?= $otherPluralVar; ?>;
                });
            }
        };

            <?php
        }
    }
}
?>

    var Lovs = $injector.get('Lovs');
    $scope.setSelectedLov = function( $lovValue, $lovType, $obj )
    {
        if( $lovType && $lovValue && $obj )
        {
            Lovs.query({
                where: {
                    lovType: $lovType,
                    name: $lovValue
                },
                sort: 'showOrder ASC'
            }, function(lovs)
            {
                $obj.selected = lovs.items[0] || [];
            });
        }
    };

    $scope.getLovs = function( $type, $svar, $param )
    {
        return Lovs.query({
            where: {
                lovType: $type,
                status: 'active',
                name:{
                    contains: $param
                }
            },
            sort: 'showOrder ASC'
        }, function( lovs )
        {
            $scope[ $svar ] = lovs.items;
            return $scope[ $svar ];
        });
    };


    $scope.create = function( isValid )
    {
        if (isValid)
        {
            var <?= $singularVar; ?> = new <?= Inflector::humanize($pluralVar); ?>({

                <?php $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    $fieldAlreadyPainted = false;
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                    {
                            if(isset($associations['belongsTo']))
                            {
                                if(!empty($associations['belongsTo']))
                                {
                                    foreach ($associations['belongsTo'] as $alias => $details)
                                    {
                                        if($details['foreignKey'] == $field)
                                        {
                                            $fieldAlreadyPainted = true;
                                            $otherSingularVar = Inflector::variable($alias);
                                            $otherPluralHumanName = Inflector::humanize($details['controller']);
                                            $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                            $otherPluralVar = Inflector::variable($details['controller']);
                                            echo "\n";
                                            echo "              ". $field . ": \$scope.selected" . $alias . ".selected ? \$scope.selected". $alias .".selected.id : null," ."\n";
                                        }
                                    }
                                }

                            }
                            if(!$fieldAlreadyPainted)
                            {
                                if(strpos($field,'lov_') !== false)
                                {
                                    $fieldNameWLov = str_replace('lov_', '', $field);
                                    $upperFieldNameWLov = strtoupper($fieldNameWLov);
                                    echo "\n";
                                    echo "              ". $field . ": (\$scope.lov" . Inflector::camelize($fieldNameWLov) . ".selected) ? \$scope.lov" . Inflector::camelize($fieldNameWLov) .".selected.name : ''," ."\n";
                                } else {
                                    echo "\n";
                                    echo "              " .  $field .": this." .$field . ","  ."\n";
                                }
                            }
                        $countIdx ++;
                    }
                }
                echo "              forctrl: 'ok'";
                ?>

            });

            <?= $singularVar; ?>.$save( function( response )
            {
            $location.path('<?= $pluralVar; ?>/view/' + response.id);
                Notification.success({
                    title:'<?= $singularHumanName; ?>',
                    message: '<?= $singularHumanName; ?> has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function( isValid )
    {
      if ( isValid )
        {
            var <?= $singularVar; ?> = $scope.<?= $singularVar; ?>;
                <?php foreach ($fields as $key => $field)
                {
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                    {
                        if(isset($associations['belongsTo']))
                        {
                            if(!empty($associations['belongsTo']))
                            {
                                foreach ($associations['belongsTo'] as $alias => $details)
                                {
                                    if($details['foreignKey'] == $field)
                                    {
                                        $fieldAlreadyPainted = true;
                                        $otherSingularVar = Inflector::variable($alias);
                                        $otherPluralHumanName = Inflector::humanize($details['controller']);
                                        $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                        $otherPluralVar = Inflector::variable($details['controller']);
                                        echo "\n";
                                        echo "              " . $singularVar ."." . $field ." = \$scope.selected" . $alias . ".selected ? \$scope.selected" . $alias . ".selected.id : null; " ."\n";
                                    }
                                }
                            }

                        }
                          if(strpos($field,'lov_') !== false)
                          {
                              $fieldNameWLov = str_replace('lov_', '', $field);
                              $upperFieldNameWLov = strtoupper($fieldNameWLov);
                              echo "\n";
                              echo "                " . $singularVar ."." . $field ." = (\$scope.lov" . Inflector::camelize($fieldNameWLov) .".selected) ? \$scope.lov". Inflector::camelize($fieldNameWLov) .".selected.name : '';" . "\n";

                          } else {
                                //echo $singularVar.'.'.$field;//Just populate foreign fields
                          }
                    }
                } ?>

            <?= $singularVar; ?>.$update(function() {
              $location.path('<?= $pluralVar; ?>/view/' + <?= $singularVar; ?>.id);
              Notification.success({
                        title:'<?= $singularHumanName; ?>',
                        message: '<?= $singularHumanName; ?> has been updated',
                        delay: 4000
                    });
            });

      } else {
        $scope.submitted = true;
      }
    };



        $scope.remove = function( <?= $singularVar; ?> )
        {
            if ( <?= $singularVar; ?>.id )
            {
                var <?= $singularVar; ?>Res = <?= Inflector::humanize($pluralVar); ?>.get({
                <?= $singularVar; ?>Id: <?= $singularVar; ?>.id
                }, function(<?= $singularVar; ?>)
                {
                    <?= $singularVar; ?>Res.$remove( function( response )
                    {
                        $location.path('<?= strtolower($pluralVar); ?>/list');
                        $scope.<?= $singularVar; ?>Filters.timestamp = new Date();
                        response = null;
                    } );
                    <?= $singularVar;?> = null;
                });
            } else {
                $location.path('<?= strtolower($pluralVar); ?>/list');
                $scope.<?= $singularVar; ?>Filters.timestamp = new Date();
            }
        };



        $scope.editableUpdate = function( $obj, $field )
        {
            if ( $obj.id )
            {
                var <?= $singularVar; ?>Res = <?= Inflector::humanize($pluralVar); ?>.get({
                <?= $singularVar; ?>Id: $obj.id
                }, function(<?= $singularVar; ?>)
                {
                    <?= $singularVar; ?>Res[ $field ] = $obj[ $field ];
                    <?= $singularVar; ?>Res.$update( function( response )
                    {
                        Notification.success({
                            title:'<?= $singularHumanName; ?>',
                            message: '<?= $singularHumanName; ?> has been updated',
                            delay: 4000
                        });
                        $scope.<?= $singularVar; ?>Filters.timestamp = new Date();
                        response = null;
                    } );
                    <?= $singularVar;?> = null;
                });
            } else {
                $location.path('<?= strtolower($pluralVar); ?>/list');
                $scope.<?= $singularVar; ?>Filters.timestamp = new Date();
            }
        };

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
        echo "  \$scope.tabs = [];";
        echo "\n";

        foreach($daRelationships as $alias => $details)
        {
            $otherSingularVar = Inflector::variable($alias);
            $otherPluralHumanName = Inflector::humanize($details['controller']);
            $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
            $otherPluralVar = Inflector::variable($details['controller']);

        echo "      \$scope.tabs.push({heading:'".Inflector::humanize(Inflector::pluralize($otherSingularVar))."', route:'".strtolower($pluralVar)."View.".Inflector::pluralize($otherSingularVar)."', disabled:false });";
        echo "\n";
        }

        ?>


        if( $state.current.name === '<?= $pluralVar; ?>View' )
        {
            var subStateGo = false;
            angular.forEach($scope.tabs, function(value, key)
            {
                if( (!subStateGo) && (!value.disabled) )
                {
                    subStateGo = value.route;
                }
                value = null;
                key = null;
            });

            if( subStateGo )
            {
                $state.go( subStateGo );
            }

        } else {
            angular.forEach($scope.tabs, function(value, key)
            {
                if(value.route === $state.current.name)
                {
                    $scope.tabs.activeTab = key;
                }
                value = null;
                key = null;
            });
        }

        $rootScope.$watch('selectedLanguage', function(newValue, oldValue)
        {
            $scope.<?= $singularVar; ?>Filters.timestamp = new Date();
            newValue = null;
            oldValue = null;
        });

}]);
