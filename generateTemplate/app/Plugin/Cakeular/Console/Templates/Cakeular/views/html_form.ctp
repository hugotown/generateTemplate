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
  <style media="screen">
  /**Added in order to autocomplete works fine*/
  .md-scroll-mask
  {
    position: initial;
  }
  </style>
  <section ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Controller" data-ng-init="prepareData()">
    <div class="panel ">
      <div class="panel-heading bg-blue-madison text-center">
        <h2 class="panel-title">{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}</h2>
      </div>
    </div>
    <?php if (strpos($action, 'html_add') !== false){ ?>
    <div class="portlet box blue-madison">
      <div class="portlet-title">
        <div class="caption">
          {{ 'Create' | translate }}
        </div>
        <div class="tools">
          <a href="javascript:;" ng-click="prepareData()" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form name="<?php echo $singularVar; ?>Form" class="form-horizontal" role="form" data-ng-submit="create(<?php echo $singularVar; ?>Form.$valid)" novalidate>
          <div class="form-body">
              <?php foreach ($fields as $key => $field)
              {
                if($field !== "createdAt" && $field !== "updatedAt" 
                  && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                {
                  ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
                      <label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
                      <div class="col-md-8">
                        <input name="<?php echo $field;?>" type="text" class="form-control" data-ng-model="<?php echo $field;?>" id="<?php echo $field;?>" placeholder="{{ '<?php echo $field;?>' | translate }}" required autocomplete="off">
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
              ?>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle blue-madison">{{ 'Save' | translate }}</button>
                                    <a ng-href="/workstation/list" class="btn btn-circle default">{{ 'Cancel' | translate }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>

            <div class="portlet box blue-madison">
              <div class="portlet-title">
                <div class="caption">
                  {{ 'Edit' | translate }}
                </div>
                <div class="tools">
                  <a href="javascript:;" ng-click="prepareData()" class="reload"></a>
                </div>
              </div>
              <div class="portlet-body form">
                <!-- BEGIN FORM-->

                <?php } ?>