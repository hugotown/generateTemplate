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
  <?php $formAction = "save"; ?>
  <?php $tabidx  = 1; ?>
  <section ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Ctrl" >
    <h3 class="page-title"></i>{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}</h3>
    <?php if (strpos($action, 'html_add') !== false){ ?>
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          {{ 'Create' | translate }}
        </div>
      </div>
      <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form name="<?php echo $singularVar; ?>Form" class="form-horizontal" role="form" data-ng-submit="create(<?php echo $singularVar; ?>Form.$valid)" novalidate>
          <div class="form-body">
            <?php foreach ($fields as $key => $field)
            {
              $fieldAlreadyPainted = false;
              if($field !== "createdAt" && $field !== "updatedAt" 
                && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
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
                      ?>
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field; ?>.$invalid }">
                              <label for="<?php echo $field; ?>" class="col-md-4 control-label">{{ '<?php echo $otherSingularVar; ?>' | translate }}</label>
                              <div class="col-md-8">
                                <div class="input-group">
                                    <ui-select <?php echo $required ; ?> ng-model="selected<?php echo $otherSingularHumanName; ?>.selected" name="<?php echo $field; ?>" reset-search-input="false" theme="bootstrap" >
                                      <ui-select-match placeholder="{{ 'Select <?php echo $otherSingularHumanName; ?>' || translate }}...">{{$select.selected.name}}</ui-select-match>
                                      <ui-select-choices repeat="item in <?php echo $otherPluralVar; ?> | limitTo: 10 track by $index"  refresh="find<?php echo $otherSingularHumanName; ?>()" refresh-delay="500" >
                                        <div ng-bind-html="item.name | highlight: $select.search"></div>
                                      </ui-select-choices>
                                    </ui-select>
                                    <span class="input-group-btn btn-right">
                                        <a class="btn grey" type="button" ng-click="selected<?php echo $otherSingularHumanName; ?>.selected = undefined">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </span>
                                </div>
                                  <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field; ?>.$invalid" class="help-block">
                                      <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field; ?>.$error.required">
                                          {{ '<?php echo $field; ?> field is required' | translate }}
                                      </p>
                                  </span>
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
                  if(strpos($field,'lov_') !== false){
                    $fieldNameWLov = str_replace('lov_', '', $field);
                    $upperFieldNameWLov = strtoupper($fieldNameWLov);

                    ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
          <label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
          <div class="col-md-8">
              <div class="input-group">
                  <ui-select ng-model="lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected" theme="bootstrap" name="<?php echo $field;?>" >
                      <ui-select-match placeholder="Select...">{{$select.selected['name_' + selectedLanguage]}}</ui-select-match>
                      <ui-select-choices repeat="item in lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>" refresh="findLovs( 'contains', 'name_' + selectedLanguage, '<?php echo strtoupper($fieldNameWLov); ?>', 'lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>', $select.search )" refresh-delay="500">
                          <div ng-bind-html="item['name_' + selectedLanguage]"></div>
                      </ui-select-choices>
                  </ui-select>
                  <span class="input-group-btn btn-right">
                      <a class="btn grey" type="button" ng-click="lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected = undefined">
                          <i class="fa fa-times"></i>
                      </a>
                  </span>
              </div>
              <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid" class="help-block">
                  <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field;?>.$error.required">
                      {{ '<?php echo $field;?> field is required' | translate }}
                  </p>
              </span>
          </div>
      </div>
  </div>
</div>
                    <?php

                  } else {

                ?>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
                      <label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
                      <div class="col-md-8">
                        <input name="<?php echo $field;?>" type="text" class="form-control" data-ng-model="<?php echo $field;?>" id="<?php echo $field;?>" placeholder="{{ '<?php echo $field;?>' | translate }}" autocomplete="off" <?php echo $required ; ?> >
                        <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid" class="help-block">
                          <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field;?>.$error.required">
                            {{ '<?php echo $field;?> field is required' | translate }}
                          </p>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                    
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
                      <button type="submit" acl-check="<?php echo $pluralVar; ?>Create" class="btn blue-madison">{{ 'Save' | translate }}</button>
                      <a ui-sref="<?php echo $pluralVar; ?>List" acl-check="<?php echo $pluralVar; ?>List" class="btn default ">{{ 'Cancel' | translate }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
            <?php }else{ ?>

            <div class="portlet light bordered">
              <div class="portlet-title">
                <div class="caption font-green-sharp">
                  {{ 'Edit' | translate }}
                </div>
              </div>
              <div class="portlet-body form" data-ng-init="findOne()">
                <!-- BEGIN FORM-->
                <form name="<?php echo $singularVar; ?>Form" class="form-horizontal" role="form" data-ng-submit="update(<?php echo $singularVar; ?>Form.$valid)" novalidate>
                  <div class="form-body">
                    <?php foreach ($fields as $key => $field)
                    {
              $fieldAlreadyPainted = false;
              if($field !== "createdAt" && $field !== "updatedAt" 
                && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
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
                      ?>
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field; ?>.$invalid }">
                              <label for="<?php echo $field; ?>" class="col-md-4 control-label">{{ '<?php echo $otherSingularVar; ?>' | translate }}</label>
                              <div class="col-md-8">
                                <div class="input-group">
                                    <ui-select <?php echo $required ; ?> ng-model="selected<?php echo $otherSingularHumanName; ?>.selected" name="<?php echo $field; ?>" reset-search-input="false" theme="bootstrap" >
                                      <ui-select-match placeholder="{{ 'Select <?php echo $otherSingularHumanName; ?>' || translate }}...">{{$select.selected.name}}</ui-select-match>
                                      <ui-select-choices repeat="item in <?php echo $otherPluralVar; ?> | limitTo: 10 track by $index"  refresh="find<?php echo $otherSingularHumanName; ?>()" refresh-delay="500" >
                                        <div ng-bind-html="item.name | highlight: $select.search"></div>
                                      </ui-select-choices>
                                    </ui-select>
                                    <span class="input-group-btn btn-right">
                                        <a class="btn grey" type="button" ng-click="selected<?php echo $otherSingularHumanName; ?>.selected = undefined">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </span>
                                </div>
                                  <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field; ?>.$invalid" class="help-block">
                                      <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field; ?>.$error.required">
                                          {{ '<?php echo $field; ?> field is required' | translate }}
                                      </p>
                                  </span>
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
                  if(strpos($field,'lov_') !== false){
                    $fieldNameWLov = str_replace('lov_', '', $field);
                    $upperFieldNameWLov = strtoupper($fieldNameWLov);

                    ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
          <label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
          <div class="col-md-8">
              <div class="input-group">
                  <ui-select ng-model="lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected" theme="bootstrap" name="<?php echo $field;?>" >
                      <ui-select-match placeholder="Select...">{{$select.selected['name_' + selectedLanguage]}}</ui-select-match>
                      <ui-select-choices repeat="item in lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>" refresh="findLovs( 'contains', 'name_' + selectedLanguage, '<?php echo strtoupper($fieldNameWLov); ?>', 'lov<?php echo Inflector::pluralize(Inflector::camelize($fieldNameWLov)); ?>', $select.search )" refresh-delay="500">
                          <div ng-bind-html="item['name_' + selectedLanguage]"></div>
                      </ui-select-choices>
                  </ui-select>
                  <span class="input-group-btn btn-right">
                      <a class="btn grey" type="button" ng-click="lov<?php echo Inflector::camelize($fieldNameWLov); ?>.selected = undefined">
                          <i class="fa fa-times"></i>
                      </a>
                  </span>
              </div>
              <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid" class="help-block">
                  <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field;?>.$error.required">
                      {{ '<?php echo $field;?> field is required' | translate }}
                  </p>
              </span>
          </div>
      </div>
  </div>
</div>
                    <?php

                  } else {
                ?>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
                      <label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
                      <div class="col-md-8">
                        <input name="<?php echo $field;?>" type="text" class="form-control" data-ng-model="<?php echo $singularVar; ?>.<?php echo $field;?>" id="<?php echo $field;?>" placeholder="{{ '<?php echo $field;?>' | translate }}" autocomplete="off" <?php echo $required ; ?> >
                        <span ng-show="submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid" class="help-block">
                          <p ng-show="<?php echo $singularVar; ?>Form.<?php echo $field;?>.$error.required">
                            {{ '<?php echo $field;?> field is required' | translate }}
                          </p>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                  }
                }
              }
                    }
                    ?>

                    <div class="form-actions">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
                              <button type="submit" acl-check="<?php echo $pluralVar; ?>Edit" class="btn blue-madison">{{ 'Save' | translate }}</button>
                              <a ui-sref="<?php echo $pluralVar; ?>List" acl-check="<?php echo $pluralVar; ?>List" class="btn default ">{{ 'Cancel' | translate }}</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

          </div>
        </form>
      </div>
    </div>

                    <?php } ?>
</section>
