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
  <section ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Controller" data-ng-init="prepareData()">
  	<div class="panel ">
  		<div class="panel-heading bg-blue-madison text-center">
  			<h2 class="panel-title">{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}</h2>
  		</div>
  	</div>
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
  			<form name="<?php echo $singularVar; ?>Form" class="form-horizontal" role="form" >
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
  											<div class="form-group" ng-class="{ 'has-error' : submitted && workstationForm.parent.$invalid }">
  												<label for="parent" class="col-md-4 control-label">{{ '<?php echo $otherSingularVar; ?>' | translate }}</label>
  												<div class="col-md-8">
  													<input name="<?php echo $field;?>" readonly="readonly" type="text" class="form-control" data-ng-model="<?php echo $singularVar; ?>.<?php echo $field;?>.name" id="<?php echo $field;?>" placeholder="{{ '<?php echo $field;?>' | translate }}" autocomplete="off" <?php echo $required ; ?> >
  												</div>
  											</div>
  										</div>
  									</div>
  									<?php
  								}
  							}
  							if(!$fieldAlreadyPainted)
  							{
  								?>
  								<div class="row">
  									<div class="col-md-12">
  										<div class="form-group" ng-class="{ 'has-error' : submitted && <?php echo $singularVar; ?>Form.<?php echo $field;?>.$invalid }">
  											<label for="<?php echo $field;?>" class="col-md-4 control-label">{{ '<?php echo $field;?>' | translate }}</label>
  											<div class="col-md-8">
  												<input name="<?php echo $field;?>" readonly="readonly" type="text" class="form-control" data-ng-model="<?php echo $singularVar; ?>.<?php echo $field;?>" id="<?php echo $field;?>" placeholder="{{ '<?php echo $field;?>' | translate }}" autocomplete="off" <?php echo $required ; ?> >
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
  					?>
  					<div class="form-actions">
  						<div class="row">
  							<div class="col-md-6">
  							</div>
  							<div class="col-md-6">
  								<div class="row">
  									<div class="col-md-offset-3 col-md-9">
  										<a href="/#/<?php echo $pluralVar; ?>/edit/{{<?php echo $singularVar; ?>.id}}" class="btn btn-circle blue-madison">{{ 'Edit' | translate }}</a>
  										<a ui-sref="<?php echo $pluralVar; ?>List" class="btn btn-circle default">{{ 'Cancel' | translate }}</a>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>