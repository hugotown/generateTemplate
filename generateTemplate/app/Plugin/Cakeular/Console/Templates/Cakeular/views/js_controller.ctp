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


        $scope.$on('findOneLoaded', function(event, data)
        {
            if( $state.current.name.indexOf('View') !== -1 ) {
                $rootScope.parentObj = data;
                $rootScope.parentObjName = data.name || '';
                $rootScope.parentObjType = '<?= Inflector::humanize($singularVar); ?>';
                $state.current.cObjType = '<?= Inflector::humanize($singularVar); ?>';
                $state.current.cObjName = data.name || '';
                $state.current.cObj = data;
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
                                echo "              \$scope.selected". $otherSingularHumanName ." ={};". "\n";
                                echo "          if(data.". $otherSingularVar. "_id){". "\n";
                                echo "              \$scope.selected". $otherSingularHumanName .".selected = data.". $field .";". "\n";
                                echo "          }". "\n";

                            }
                        }
                    }

                }

            }
            echo "          event = null;". "\n";
            echo "          data = null;". "\n";
            ?>

        });

$scope.<?= $singularVar; ?>Filters = {};

    $scope.get<?= Inflector::humanize($pluralVar); ?> = function(params, paramsObj) {

      var urlApi = $rootScope.backendUrl +'/<?= $pluralVar; ?>?';

      if( paramsObj.count !== undefined ){
          var skip = (paramsObj.count * (paramsObj.page - 1));
          urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
      }

      if( paramsObj.sortBy !== undefined ){
        urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
      }

      if( paramsObj.filters !== undefined ){
        urlApi += '&where={';
        var strWhereCond = '';

<?php
foreach ($fields as $field)
{
    $fieldAlreadyPainted = false;
    if (isset($associations['belongsTo'])) {
        if (!empty($associations['belongsTo'])) {
            foreach ($associations['belongsTo'] as $alias => $details) {
                if ($details['foreignKey'] == $field) {
                    $otherSingularVar = Inflector::variable($alias);
                    $otherPluralHumanName = Inflector::humanize($details['controller']);
                    $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                    $otherPluralVar = Inflector::variable($details['controller']);
                    $fieldAlreadyPainted = true;
                }
            }
        }
    }
    if (!$fieldAlreadyPainted) {
        if (strpos($field, 'lov_') !== false) {
            $fieldNameWLov = str_replace('lov_', '', $field);
            $upperFieldNameWLov = strtoupper($fieldNameWLov);

        } else {

            switch ($schema[$field]["type"]) {
                case 'text': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": {"contains":"' + paramsObj.filters.<?= $field; ?> + '"}';
                    }
                    <?php
                    break;
                }
                case 'boolean': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined  )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?>.value ;
                    }
                    <?php
                    break;
                }
                case 'decimal': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'float': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'integer': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": ' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'date': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": "' + paramsObj.filters.<?= $field; ?> ;
                    }
                    <?php
                    break;
                }
                case 'datetime': {
                    ?>

                    if( paramsObj.filters.<?= $field; ?> !== undefined && paramsObj.filters.<?= $field; ?> && ( '' !== paramsObj.filters.<?= $field; ?> ) )
                    {
                     (strWhereCond !== '') ? strWhereCond += ',' : strWhereCond += '';
                    strWhereCond += '"<?= $field; ?>": "' + paramsObj.filters.<?= $field; ?> + '"';
                    }
                    <?php
                    break;
                }

                default : {
                    //none
                }
            }

        }
    }
}
?>

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
                        echo "\n";
                        echo "                  {'". $field ."': \$translate.instant('". $singularVar ."-" . $field . "')} ,";
                        $countIdx ++;
                    }
                    ?>

                        {'actions': $translate.instant('<?= $singularVar; ?>-actions')}
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
foreach ($fields as $key => $field)
{
  if(strpos($field,'lov_') !== false)
  {
      $fieldNameWLov = str_replace('lov_', '', $field);
      $upperFieldNameWLov = strtoupper($fieldNameWLov);
      echo "\n";
      echo "    \$scope.lov". Inflector::camelize($fieldNameWLov). " = {};"."\n";
  }
}
?>


if( $state.current.name.indexOf('Create') !== -1 )
{
    $scope.parentObj = $rootScope.parentObj;
    $scope.parentObjName = $rootScope.parentObjName;
    $scope.parentObjType = $rootScope.parentObjType;

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
                                echo "  if(\$scope.parentObjType ===  '" . $otherSingularHumanName ."'){" ."\n";
                                echo "    \$scope.selected" . $otherSingularHumanName .".selected = \$scope.parentObj; ". "\n";
                                echo "  } "."\n";
                            }
                        }
                    }
                }
            }
            ?>
}

    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var <?= $singularVar; ?> = new <?= Inflector::humanize($pluralVar); ?>({

                <?php $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    $fieldAlreadyPainted = false;
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
                                            echo "              ". $field . ": \$scope.selected" . $otherSingularHumanName . ".selected ? \$scope.selected". $otherSingularHumanName .".selected.id : null," ."\n";
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
                                    echo "          ". $field . ": (\$scope.lov" . Inflector::camelize($fieldNameWLov) . ".selected) ? \$scope.lov" . Inflector::camelize($fieldNameWLov) .".selected.name_ : ''," ."\n";
                                } else {
                                    echo "\n";
                                    echo "          " .  $field .": this." .$field . ","  ."\n";
                                }
                            }
                        $countIdx ++;
                }
                echo "          forctrl: 'ok'";
                ?>

            });

            <?= $singularVar; ?>.$save(function(response)
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

    $scope.update = function(isValid)
    {
      if (isValid)
        {
      var <?= $singularVar; ?> = $scope.<?= $singularVar; ?>;
                <?php foreach ($fields as $key => $field)
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
                                        echo "          " . $singularVar ."." . $field ." = \$scope.selected" . $otherSingularHumanName . ".selected ? \$scope.selected" . $otherSingularHumanName . ".selected.id : null; " ."\n";
                                    }
                                }
                            }

                        }
                          if(strpos($field,'lov_') !== false)
                          {
                              $fieldNameWLov = str_replace('lov_', '', $field);
                              $upperFieldNameWLov = strtoupper($fieldNameWLov);
                              echo "\n";
                              echo "            " . $singularVar ."." . $field ." = (\$scope.lov" . Inflector::camelize($fieldNameWLov) .".selected) ? \$scope.lov". Inflector::camelize($fieldNameWLov) .".selected.name_ : '';" . "\n";

                          } else {

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
            } );
        });
    } else {
        $location.path('<?= strtolower($pluralVar); ?>/list');
    }
};



}]);
