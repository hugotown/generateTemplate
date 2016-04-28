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

<section ng-controller="<?= Inflector::humanize($pluralVar); ?>Ctrl" >
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                {{ 'Create' | translate }}
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form name="<?= $singularVar; ?>Form" class="form-horizontal" role="form" data-ng-submit="create(<?= $pluralVar; ?>Form.$valid)" novalidate>
                <div class="form-body">
                    <?php foreach ($fields as $key => $field)
                    {
                        $fieldAlreadyPainted = false;
                        if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
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

                                        }
                                    }
                                }
                            }
                            if(!$fieldAlreadyPainted)
                            {
                                switch ($schema[$field]["type"]) {
                                    case 'text': {
                                        ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group" ng-class="{ 'has-error' : submitted && <?= $singularVar; ?>Form.<?= $field;?>.$invalid }">
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> >
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label" >&nbsp;{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom: 6px !important;" >
                    <input name="<?= $field;?>" type="checkbox" ng-model="<?= $field;?>" id="<?= $field;?>" />
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="number" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> ignore-mouse-wheel >
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd HH:mm:ss" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-fade" bs-datepicker >
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
            <label for="<?= $field;?>" class="col-lg-4 col-md-4 col-sm-4 control-label">{{ '<?= $field;?>' | translate }}</label>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd HH:mm:ss" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-fade" bs-datepicker >
                <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $field;?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-model-time-format="yyyy-MM-dd HH:mm:ss" data-time-type="string" data-container="body" data-autoclose="1" data-animation="am-fade" bs-timepicker >
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
                                    }
                                }
                            }
                        }
                    }
                    ?>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" ng-disabled="!session.acl.<?= $pluralVar; ?>.postAction" class="btn blue-madison">{{ 'Save' | translate }}</button>
                                        <a ui-sref="<?= $pluralVar; ?>List" ng-disabled="!session.acl.<?= $pluralVar; ?>.getAction" class="btn default {{(!session.acl.<?= $pluralVar; ?>.getAction) ? 'disabled' : ''}}">{{ 'Cancel' | translate }}</a>
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
