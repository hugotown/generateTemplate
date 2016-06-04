<?php
  /**
   *
   * PHP 5
   *
   * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
   * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
   *
   * Licensed under The MIT License
   * Redistributions of files must retain the above copyright notice.
   *
   * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
   * @link          http://cakephp.org CakePHP(tm) Project
   * @package       Cake.Console.Templates.default.views
   * @since         CakePHP(tm) v 1.2.0.5234
   * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
   */
  ?>
  <?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
  <?php $singularHumanName = Inflector::classify($singularHumanName); ?>
  <?php $pluralVar = strtolower($pluralVar); ?>
  <?php $singularVar = strtolower($singularVar); ?>
  <section ng-controller="<?= Inflector::humanize($pluralVar); ?>Ctrl" ng-init="findOne()">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-green-sharp">
              {{ 'View' | translate }}
            </div>
              <div class="actions">
                  <a href="javascript:;" class="btn btn-sm green-haze " ui-sref="<?php echo $pluralVar; ?>List" acl-check="<?= $pluralVar; ?>List">
                      <i class="glyphicon glyphicon-arrow-left " data-container="body" data-title="{{'Back to list' | translate}}" data-animation="am-flip-x" bs-tooltip ></i>
                  </a>
                  <a acl-check="<?= $pluralVar; ?>Edit" href="/#/<?= $pluralVar; ?>/edit/{{<?= $singularVar; ?>.id}}" class="btn yellow-casablanca ">
                      <i class="glyphicon glyphicon-pencil" data-container="body" data-title="{{'Edit' | translate}}" data-animation="am-flip-x" bs-tooltip ></i>
                  </a>
              </div>
          </div>
          <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form name="<?= $singularVar; ?>Form" class="form-horizontal" role="form" >
              <div class="form-body">
                <?php $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  && $field !== "password"  )
                    {
                        $fieldAlreadyPainted = false;
                        if(!($schema[$field]['null'])) {
                            $required = 'required';
                        } else {
                            $required = '';
                        }
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
                                        ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
            <label class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $otherSingularVar;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <p class="form-control">
                    {{selected<?= $alias; ?>.selected.name}}
                </p>
            </div>
        </div>
    </div>
</div>
                                        <?php

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
                                echo "<div class=\"row\">". "\n";
                                echo "    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">". "\n";
                                echo "        <div class=\"form-group\" ng-class=\"{ 'has-error' : submitted && ". $singularVar."Form.". $field.".\$invalid }\">". "\n";
                                echo "            <label class=\" col-lg-4 col-md-4 col-sm-4 control-label\">{{ '" . $singularVar."-". $field."' | translate }}</label>". "\n";
                                echo "            <div class=\" col-lg-8 col-md-8 col-sm-8 \">". "\n";
                                echo "                <p class=\"form-control\" show-lov-value=\"". $upperFieldNameWLov."\" load-lovtype-value=\"{{" . $singularVar. "." . $field."}}\" ></p>". "\n";
                                echo "            </div>". "\n";
                                echo "        </div>". "\n";
                                echo "    </div>". "\n";
                                echo "</div>". "\n";
                            } else{
                                switch ($schema[$field]["type"]) {
                                    case 'string': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <p class="form-control" >
                                                            {{<?= $singularVar; ?>.<?= $field;?>}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'text': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <textarea name="<?= $field; ?>" id="<?= $field; ?>" ng-model="<?= $singularVar; ?>.<?= $field; ?>" readonly="readonly" class="form-control disabled"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'boolean': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label" >&nbsp;{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom: 6px !important;" >
                                                            <input name="<?= $field;?>" type="checkbox" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" readonly="readonly" disabled />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'decimal': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <p class="form-control" >
                                                            {{<?= $singularVar; ?>.<?= $field;?>}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'float': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <p class="form-control" >
                                                            {{<?= $singularVar; ?>.<?= $field;?>}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'integer': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <p class="form-control" >
                                                            {{<?= $singularVar; ?>.<?= $field;?>}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'date': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" >
                                                                <div class="input-group">
                                                                    <p class="form-control" >
                                                                        {{<?= $singularVar; ?>.<?= $field;?>}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                    }
                                    case 'datetime': {
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                    <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-". $field;?>' | translate }}</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6" >
                                                                <div class="input-group">
                                                                    <p class="form-control" >
                                                                        {{<?= $singularVar; ?>.<?= $field;?>}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6" >
                                                                <div class="input-group">
                                                                    <p class="form-control" >
                                                                        {{<?= $singularVar; ?>.<?= $field;?>}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        $countIdx ++;
                    }
                } ?>


              </div>
            </form>
          </div>
        </div>
      </div>
        </div>
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

if( !empty($daRelationships) )
{
    echo "<div class=\"row\" ng-if=\"".strtolower($singularVar).".id\">"."\n";
    echo "    <div class=\"col-lg-12 col-md-12 col-sm-12\">"."\n";
    echo "        <!-- BEGIN Portlet PORTLET-->"."\n";
    echo "        <div class=\"portlet light\">"."\n";
    echo "            <tabs data=\"tabs\" type=\"none\" template-url=\"ui-router-tabs-default-template.html\"></tabs>"."\n";
    echo "            <div class=\"portlet-body\">"."\n";
    echo "                <div class=\"tab-content\">"."\n";
    echo "                    <ui-view name=\"viewTab\"></ui-view>"."\n";
    echo "                </div>"."\n";
    echo "            </div>"."\n";
    echo "        </div>"."\n";
    echo "    </div>"."\n";
    echo "</div>"."\n";
}

?>
  </section>

