<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
'use strict';

/**
 * @ngdoc function
 * @name appviewproject0001App.controller:<?php echo Inflector::humanize($pluralVar); ?>Ctrl
 * @description
 * # <?php echo Inflector::humanize($pluralVar); ?>Ctrl
 * Controller of the appviewproject0001App
 */
angular.module('appviewproject0001App')
 .controller('<?php echo Inflector::humanize($pluralVar); ?>Ctrl', 
[ '$rootScope', '$scope', '$http', '$location', '$log', '$state', '$stateParams', 'Notification', '$translate', '$injector',
function($rootScope, $scope, $http, $location, $log, $state, $stateParams, Notification, $translate, $injector)
{

        $scope.$on('findOneLoaded', function(event, data)
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
                                ?>

if(data.<?php echo $otherSingularVar; ?>_id){
    $scope.selected<?php echo $otherSingularHumanName; ?>.selected = data.<?php echo $field; ?>;
}

                            <?php
                            }
                        }
                    }

                }

                  if(strpos($field,'lov_') !== false){
                    $fieldNameWLov = str_replace('lov_', '', $field);
                    $upperFieldNameWLov = strtoupper($fieldNameWLov);
                    ?>

if (data.<?php echo $field; ?> && data.<?php echo $field; ?> !== '') {
    var lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?> = $scope.fgetLovs('equals', '', '<?php echo strtoupper($fieldNameWLov); ?>', 'lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>', data.<?php echo $field; ?>);
    lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>.$promise.then(function(datapromise) {
        if (datapromise.items[0]) {
            $scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected = datapromise.items[0];
        }
    });
}

                    <?php
                  }
            }
            ?>

event = null;
data = null;
        });


    $scope.get<?php echo Inflector::humanize($pluralVar); ?> = function(params, paramsObj) {

      var urlApi = $rootScope.api_url_base +'/<?php echo $pluralVar; ?>?';

      if(typeof paramsObj.count !== 'undefined'){
          var skip = (paramsObj.count * (paramsObj.page - 1));
          urlApi += 'limit=' + paramsObj.count + '&skip=' + skip;
      }

      if(typeof paramsObj.sortBy !== 'undefined'){
        urlApi += '&sort=' + paramsObj.sortBy + ' ' + ((paramsObj.sortOrder === 'dsc') ? 'DESC' : 'ASC');
      }

      if(typeof paramsObj.filters !== 'undefined' && paramsObj.filters !== ''){
        urlApi += '&where={"name": {"contains":"' + paramsObj.filters + '"}}';
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
                                ?>

{'<?php echo $singularVar; ?>-<?php echo $field; ?>': $translate.instant('<?php echo $singularVar; ?>-<?php echo $field; ?>')} ,

                                <?
                        $countIdx ++;
                        }
                    } ?>
{'<?php echo $singularVar; ?>-actions': $translate.instant('<?php echo $singularVar; ?>-actions')}
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

    var <?php echo Inflector::humanize($pluralVar); ?> = $injector.get('<?php echo Inflector::humanize($pluralVar); ?>');

    $scope.<?php echo $pluralVar; ?> = [];
    $scope.find = function()
    {
        return <?php echo Inflector::humanize($pluralVar); ?>.query(function(<?php echo $pluralVar; ?>)
        {
            $scope.<?php echo $pluralVar; ?> = <?php echo $pluralVar; ?>;
            $scope.$emit('findLoaded', { data: <?php echo $pluralVar; ?> });
            return $scope.<?php echo $pluralVar; ?>;
        });
    };

    $scope.<?php echo $singularVar; ?> = {};
    $scope.findOne = function()
    {
        return <?php echo Inflector::humanize($pluralVar); ?>.get({
            <?php echo $singularVar; ?>Id: $stateParams.<?php echo $singularVar; ?>Id
        }, function(<?php echo $singularVar; ?>)
        {
            $scope.<?php echo $singularVar; ?> = <?php echo $singularVar; ?>;
            $scope.$emit('findOneLoaded', <?php echo $singularVar; ?>);
            return $scope.<?php echo $singularVar; ?>;
        });
    };

<?php 
if (isset($associations['belongsTo']))
{
    if(!empty($associations['belongsTo']))
    {
        foreach ($associations['belongsTo'] as $alias => $details)
        {
            ?>
        <?php $otherSingularVar = Inflector::variable($alias); ?>
        <?php $otherPluralVar = Inflector::variable($details['controller']); ?>
        <?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
        <?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>

        $scope.<?php echo $otherPluralVar; ?> = [];
        $scope.<?php echo $otherSingularVar; ?> = {};
        $scope.selected<?php echo $otherSingularHumanName; ?> = {};

        <?php

        if($singularHumanName != $otherSingularHumanName)
        {
        ?>

        var <?php echo $otherPluralHumanName; ?> = $injector.get('<?php echo $otherPluralHumanName; ?>');

            <?php
        }
        ?>

        $scope.find<?php echo $otherPluralHumanName; ?> = function($param)
            {
                if(typeof $param !== 'undefined' && $param !== ''){
                    return <?php echo $otherPluralHumanName; ?>.query({
                          where: {
                              name: {
                                contains: $param
                            },
                            lov_<?php echo strtolower( $otherSingularHumanName ); ?>_status : 'active'
                          }
                      },function(<?php echo $otherPluralVar; ?>)
                        {
                            $scope.<?php echo $otherPluralVar; ?> = <?php echo $otherPluralVar; ?>.items;
                            $scope.$emit('find<?php echo $otherPluralHumanName; ?>Loaded', { data: <?php echo $otherPluralVar; ?> });
                            return $scope.<?php echo $otherPluralVar; ?>;
                        });
                } else {
                    return <?php echo $otherPluralHumanName; ?>.query({
                          where: {
                            lov_<?php echo strtolower( $otherSingularHumanName ); ?>_status : 'active'
                          }
                      },function(<?php echo $otherPluralVar; ?>)
                        {
                            $scope.<?php echo $otherPluralVar; ?> = <?php echo $otherPluralVar; ?>.items;
                            $scope.$emit('find<?php echo $otherPluralHumanName; ?>Loaded', { data: <?php echo $otherPluralVar; ?> });
                            return $scope.<?php echo $otherPluralVar; ?>;
                        });
                }
            };

    <?php
        }
    }
}
?>

<?php 
foreach ($fields as $key => $field)
{
  if(strpos($field,'lov_') !== false){
    $fieldNameWLov = str_replace('lov_', '', $field);
    $upperFieldNameWLov = strtoupper($fieldNameWLov);
    ?>

$scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?> = {};

    <?php
  }
}
?>

var Lovs = $injector.get('Lovs');
$scope.fgetLovs = function($typeSearch, $fieldLang, $type, $svar, $param, $obj) {
    var whereStmnt = {
        lovType: $type,
        status: 'active'
    };
    switch ($typeSearch) {
        case 'contains':
            if ($param !== '' && $fieldLang !== '') {
                whereStmnt[$fieldLang] = {
                    contains: $param
                };
            }
            break;
        default:
            if ($param !== '') {
                whereStmnt.name_ = $param;
            }
            break;
    }
    return Lovs.query({
        where: whereStmnt,
        sort: 'orderShow ASC'
    }, function(lovs) {
        $scope[$svar] = lovs.items;
        if($obj){
            $obj[$svar] = lovs.items;
        }
        return $scope[$svar];
    });
};


    $scope.create = function(isValid)
    {
        if (isValid)
        {
            var <?php echo $singularVar; ?> = new <?php echo Inflector::humanize($pluralVar); ?>({

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
                                            ?>

<?php echo $field; ?>: $scope.selected<?php echo $otherSingularHumanName ?>.selected ? $scope.selected<?php echo $otherSingularHumanName ?>.selected.id : null,

                                            <?

                                        }
                                    }
                                }

                            }
                            if(!$fieldAlreadyPainted)
                            {
                                  if(strpos($field,'lov_') !== false){
                                    $fieldNameWLov = str_replace('lov_', '', $field);
                                    $upperFieldNameWLov = strtoupper($fieldNameWLov);
                                    ?>

<?php echo $field; ?>: ($scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected) ? $scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected.name_ : '',

                                    <?php
                                  } else{
                                ?>

<?php echo $field; ?>: this.<?php echo $field; ?>,

                                <?php
                                }
                            }
                    $countIdx ++;
                    }
                } ?>

forctrl: 'ok'
            });

            <?php echo $singularVar; ?>.$save(function(response)
            {
            $location.path('<?php echo $pluralVar; ?>/view/' + response.id);
                Notification.success({
                    title:'<?php echo $singularHumanName; ?>',
                    message: '<?php echo $singularHumanName; ?> has been saved',
                    delay: 4000
                });
            });

        } else {
            $scope.submitted = true;
        }
    };

    $scope.update = function(isValid) {
      if (isValid) {
      var <?php echo $singularVar; ?> = $scope.<?php echo $singularVar; ?>;
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
                                        ?>

<?php echo $singularVar; ?>.<?php echo $field; ?> = $scope.selected<?php echo $otherSingularHumanName ?>.selected ? $scope.selected<?php echo $otherSingularHumanName ?>.selected.id : null;

                                        <?

                                    }
                                }
                            }

                        }
                          if(strpos($field,'lov_') !== false){
                            $fieldNameWLov = str_replace('lov_', '', $field);
                            $upperFieldNameWLov = strtoupper($fieldNameWLov);
                            ?>

<?php echo $singularVar; ?>.<?php echo $field; ?> = ($scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected) ? $scope.lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected.name_ : '';

                            <?php
                          } else {

                          }
                    }
                } ?>

        <?php echo $singularVar; ?>.$update(function() {
          $location.path('<?php echo $pluralVar; ?>/view/' + <?php echo $singularVar; ?>.id);
          Notification.success({
                    title:'<?php echo $singularHumanName; ?>',
                    message: '<?php echo $singularHumanName; ?> has been updated',
                    delay: 4000
                });
        });

      } else {
        $scope.submitted = true;
      }
    };


}]);
