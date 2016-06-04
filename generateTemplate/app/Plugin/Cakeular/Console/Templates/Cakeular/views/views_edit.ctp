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

<section ng-controller="<?= Inflector::humanize($pluralVar); ?>Ctrl" ng-init="findOne()" >
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                {{ 'Edit' | translate }}
            </div>
            <div class="actions">
                <a href="javascript:;" class="btn btn-sm green-haze " ui-sref="<?php echo $pluralVar; ?>List" acl-check="<?= $pluralVar; ?>List">
                    <i class="glyphicon glyphicon-arrow-left " data-container="body" data-title="{{'Back to list' | translate}}" data-animation="am-flip-x" bs-tooltip ></i>
                </a>
                <a class="btn btn-sm red " rest-action="<?= Inflector::humanize($pluralVar); ?>|delete" ng-bootbox-confirm="{{ 'Are you sure want to delete this record?' | translate }}" ng-bootbox-confirm-action="remove(<?= $singularVar; ?>)" >
                    <i class="glyphicon glyphicon-trash" data-container="body" data-title="{{'Delete' | translate}}" data-animation="am-flip-x" bs-tooltip></i>
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form name="<?php echo $singularVar; ?>Form" class="form-horizontal" role="form" data-ng-submit="update(<?php echo $singularVar; ?>Form.$valid)" novalidate>
                <div class="form-body">
                    <?php foreach ($fields as $key => $field)
                    {
                        $fieldAlreadyPainted = false;
                        if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                        {
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

                                            echo "<div class=\"row\">"."\n";
                                            echo "    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">"."\n";
                                            echo "        <div class=\"form-group\" ng-class=\"{ 'has-error' : submitted && ".$singularVar."Form.".$field.".\$invalid }\">"."\n";
                                            echo "            <label for=\"".$field."\" class=\" col-lg-4 col-md-4 col-sm-4 control-label\">{{ '".$singularVar."-".$otherSingularVar."' | translate }}</label>"."\n";
                                            echo "            <div class=\" col-lg-8 col-md-8 col-sm-8 \">"."\n";
                                            echo "                <div class=\"input-group\">"."\n";
                                            echo "                    <ui-select ".$required." ng-model=\"selected".$alias.".selected\" id=\"".$field."\" name=\"".$field."\" reset-search-input=\"false\" theme=\"bootstrap\" >"."\n";
                                            echo "                        <ui-select-match placeholder=\"{{ 'Search ".$alias."' | translate }}...\">{{\$select.selected.name}}</ui-select-match>"."\n";
                                            echo "                        <ui-select-choices repeat=\"item in ".Inflector::pluralize($otherSingularVar)." \"  refresh=\"find".Inflector::pluralize($alias)."(\$select.search)\" refresh-delay=\"500\" >"."\n";
                                            echo "                            <div ng-bind-html=\"item.name | highlight: \$select.search\"></div>"."\n";
                                            echo "                        </ui-select-choices>"."\n";
                                            echo "                    </ui-select>"."\n";
                                            echo "                    <span class=\"input-group-btn btn-right\">"."\n";
                                            echo "                        <a class=\"btn grey\" type=\"button\" ng-click=\"selected".$alias.".selected = undefined\">"."\n";
                                            echo "                            <i class=\"fa fa-times\"></i>"."\n";
                                            echo "                        </a>"."\n";
                                            echo "                    </span>"."\n";
                                            echo "                </div>"."\n";
                                            echo "                <span ng-show=\"submitted && ".$singularVar."Form.parent_id.\$invalid\" class=\"help-block\">"."\n";
                                            echo "                    <p ng-show=\"".$singularVar."Form.".$field.".\$error.required\">"."\n";
                                            echo "                          {{ '".$singularVar."-".$otherSingularVar." field is required' | translate }}"."\n";
                                            echo "                    </p>"."\n";
                                            echo "                </span>"."\n";
                                            echo "            </div>"."\n";
                                            echo "        </div>"."\n";
                                            echo "    </div>"."\n";
                                            echo "</div>"."\n";
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
                                    ?>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                <label for="<?= $field; ?>" class=" col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar; ?>-<?= $field; ?>' | translate }}</label>
                                                <div class=" col-lg-8 col-md-8 col-sm-8 ">
                                                    <div class="input-group">
                                                        <ui-select <?= $required; ?> ng-model="lov<?= Inflector::camelize( $fieldNameWLov ); ?>.selected" theme="bootstrap" name="<?= $field ?>" id="<?= $field; ?>" >
                                                            <ui-select-match placeholder="{{ 'Search <?= $field; ?>' | translate }} ...">
                                                                {{$select.selected['name' + ( (selectedLanguage) ? '_' + selectedLanguage : '' ) ]}}
                                                            </ui-select-match>
                                                            <ui-select-choices repeat="item in lov<?= Inflector::pluralize( Inflector::camelize( $fieldNameWLov ) ); ?>" refresh="getLovs( '<?= $upperFieldNameWLov; ?>', 'lov<?= Inflector::pluralize( Inflector::camelize( $fieldNameWLov ) ); ?>', $select.search )" refresh-delay="500">
                                                                <div ng-if="selectedLanguage" ng-bind-html="item['name' + '_' + selectedLanguage]"></div>
                                                                <div ng-if="!selectedLanguage" ng-bind-html="item['name']"></div>
                                                            </ui-select-choices>
                                                        </ui-select>
                                                          <span class="input-group-btn btn-right">
                                                              <a class="btn grey" type="button" ng-click="lov<?= Inflector::camelize( $fieldNameWLov ); ?>.selected = undefined">
                                                                  <i class="fa fa-times"></i>
                                                              </a>
                                                          </span>
                                                    </div>
                                                      <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                          <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                              {{ '<?= $singularVar . '-' . $field;?> field is required' | translate }}
                                                          </p>
                                                      </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                }else{
                                    switch ($schema[$field]["type"])
                                    {
                                        case 'string': {
                                            ?>

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> >
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <textarea name="<?= $field;?>" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ></textarea>
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label" >&nbsp;{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom: 6px !important;" >
                                                                <input name="<?= $field;?>" type="checkbox" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" />
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12" >
                                                                    <div class="input-group">
                                                                        <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-datepicker >
                                                                        <div class="input-group-btn">
                                                                            <label for="<?= $field;?>" class="btn btn-default">
                                                                                <i class=" glyphicon glyphicon-calendar" ></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                                                        <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $singularVar."-".$field;?>' | translate }}</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6" >
                                                                    <div class="input-group">
                                                                        <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd HH:mm:ss" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-datepicker >
                                                                        <div class="input-group-btn">
                                                                            <label for="<?= $field;?>" class="btn btn-default">
                                                                                <i class=" glyphicon glyphicon-calendar" ></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6" >
                                                                    <div class="input-group">
                                                                        <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>.<?= $field;?>" id="<?= $field;?>-Time" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-model-time-format="yyyy-MM-dd HH:mm:ss" data-time-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-timepicker >
                                                                        <div class="input-group-btn">
                                                                            <label for="<?= $field;?>-Time" class="btn btn-default">
                                                                                <i class=" glyphicon glyphicon-time" ></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span ng-show="submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid" class="help-block">
                                                              <p ng-show="<?= $singularVar; ?>Form.<?= $field;?>.$error.required">
                                                                  {{ '<?= $field;?> field is required' | translate }}
                                                              </p>
                                                            </span>
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
                        }
                    }
                    ?>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
                                        <button type="submit" rest-action="<?= Inflector::humanize($pluralVar); ?>|put" class="btn blue-madison">{{ 'Save' | translate }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>