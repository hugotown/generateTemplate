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
<?php if (strpos($action, 'html_add') !== false): ?>
<div class="row" ng-controller="<?php echo $singularHumanName;?>AddController">
<?php else: ?>
<div class="row" ng-controller="<?php echo $singularHumanName;?>EditController">
<?php $formAction = "update"; ?>
<?php endif; ?>
	<div class="col-md-12 content">
  <div ui-view="" class="ng-scope">
    <div class="none">
      <div class="portlet-body">
      	<div class="row">
			<div class="col-md-12 content">
				<form id="<?php echo Inflector::humanize($singularVar); ?>Form" name="<?php echo Inflector::humanize($singularVar); ?>Form" class="form-horizontal crm-form" data-ng-submit="<?php echo $formAction;?><?php echo $singularHumanName; ?>(<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>)">
					<div class="widget widget-2">
                        <!-- Widget heading start -->
                        <div class="widget-head">
                            <h4 class="heading glyphicons edit"><i></i> {{'General Information' | translate }}</h4>
                            <div class="menubar crm-menubar">
								<ul>
									<li>
									<a ui-sref="<?php echo $pluralVar; ?>.list" class="btn-crm-header btn btn-sm btn-circle btn-default" data-title="{{'All <?php echo $pluralVar; ?>' | translate}}" data-type="success" data-container="body" bs-tooltip >
										<i class="glyphicon glyphicon-list-alt"></i>
									</a>
<?php if (strpos($action, 'html_add') === false): ?>
									<a ng-if="(favorite != undefined)"href="javascript:;" class="btn-crm-header btn btn-sm btn-circle btn-default {{((favorite.flag) ? '':'')}}" data-placement="top" data-title="{{'Toggle favorite' | translate}}" ng-click="toggleFavorite()" data-container="body"  data-type="success" bs-tooltip >
										<i class="glyphicon glyphicon-star" style="{{((favorite.flag) ? 'color:#f3c200;':'')}}"></i>
									</a>
<?php endif; ?>
									</li>
								</ul>
							</div>
                        </div>
                        <!-- Widget heading end -->
                        <div class="widget-body">
<?php $fieldcount = 0; ?>
<?php foreach ($fields as $field): ?>
<?php $tabidx++; ?>
<?php if(!($schema[$field]['null'])) {
	$required = 'required';
} else {
	$required = '';
} ?>
<?php if (strpos($action, 'html_add') !== false && $field == $primaryKey): ?>
<?php continue; ?>
<?php elseif (!in_array($field, array('created', 'modified', 'updated','updated_by','created_by'))):
$belongCheck = array();?>
<?php if (!empty($associations['belongsTo'])):
foreach ($associations['belongsTo'] as $alias => $details):
if($details['foreignKey'] == $field): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
<?php $fieldcount++; ?>
<?php if(($fieldcount % 2 != 0) || $fieldcount == 0): ?>
	<div class="row">
<?php endif; ?>
	<div class="col-md-6">
			<div class="form-group {{ (<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$untouched) ? '':((<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$invalid) ? 'has-error':'has-success') }}">
			<label class="col-md-9 crm-form-label control-label">{{'<?php echo $otherSingularHumanName; ?>' | translate }}
				<span style="margin: 0;"
					class="btn-action single glyphicons circle_question_mark"
					data-trigger="hover" data-type="info" data-title="{{'form.help.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>' | translate}}"
					bs-tooltip><i></i>
				</span>
			</label>
			<div class="none">
				<span ng-if="(Parent<?php echo $otherSingularHumanName;?> == null)">
					<div class="input-group col-md-9">
						<ui-select ng-model="selected<?php echo $otherSingularHumanName; ?>.selected"
							theme="select2"
							id="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
							name="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
							tabindex="<?php echo ($tabidx + (($fieldcount % 2 == 0) ? 100:0)); ?>"
							reset-search-input="false" <?php echo $required; ?>>
							<ui-select-match placeholder="Select <?php echo $otherSingularHumanName; ?>...">{{$select.selected.<?php echo $otherSingularHumanName; ?>.name}}</ui-select-match>
					    	<ui-select-choices repeat="row in <?php echo $otherPluralVar;?> | limitTo: 10 track by $index"
					             refresh="get<?php echo $otherPluralHumanName; ?>($select.search)"
					             refresh-delay="1000">
								<span ng-bind-html="row.<?php echo $otherSingularHumanName; ?>.name | highlight: $select.search"></span>
							</ui-select-choices>
						</ui-select>
						<span class="input-group-btn">
							<a href="javascript:;" ng-click="selected<?php echo $otherSingularHumanName; ?>.selected = undefined" class="btn btn-default">
							<span class="glyphicon glyphicon-trash"></span>
							</a>
						</span>
					</div>
					<div class="input-group col-md-12">
						<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.required)">{{ 'This is a required field' | translate }}</p>
					</div>
				</span>
				<span ng-if="(Parent<?php echo $otherSingularHumanName;?> != null)">
					<p class="input-group col-md-12">
						<b>
							{{ Parent<?php echo $otherSingularHumanName;?>.name | limitTo: 20 }}{{Parent<?php echo $otherSingularHumanName;?>.name.length > 20 ? '...' : ''}}
						</b>
					</p>
				</span>
			</div>
			</div>
	</div>
<?php if($fieldcount % 2 == 0): ?>
	</div>
<?php endif; ?>
<?php	$belongCheck[] = $details['foreignKey'];
endif;
endforeach;
endif;
if(!in_array($field, $belongCheck)): ?>
<?php $fieldcount++; ?>
<?php if(($fieldcount % 2 != 0) || $fieldcount == 0): ?>
	<div class="row">
<?php endif; ?>
<?php
$required 		 = '';
$editableType 	 = 'input type="text"';
$editableAttribs = '';
$editableOpening = '';
$editableClosing = '';
if(!($schema[$field]['null'])) {
	$required = 'required';
}
switch($schema[$field]["type"]){
	case 'text': {
		$editableType 	 = 'textarea';
		$editableAttribs = 'e-rows="7" e-cols="40"';
		$editableClosing = '</textarea>';
		break;
	}
	case 'boolean': {
		$editableType 	 = 'input apply-uniform type="checkbox"';
		$editableAttribs = '';
		$required        = '';
		break;
	}
	case 'decimal':
	case 'float': {
		$editableType 	 = 'input type="number"';
		$editableAttribs = 'step="any"';
		break;
	}
	case 'integer': {
		$editableType 	 = 'input type="number"';
		$editableAttribs = 'step="1"';
		break;
	}
	case 'date':
	case 'datetime': {
		$editableType 	 = 'input type="text"';
		$editableAttribs = 'bs-datepicker';
		$editableOpening = '<div class="input-group">';
		$editableClosing = '</div>';
		break;
	}

	default :{
		//none
	}
}
//debug($schema[$field]);
?>
<?php if($schema[$field]["type"] == "datetime" || $schema[$field]["type"] == "date"): ?>
	<div class="col-md-6">
		<div class="form-group {{(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$untouched) ? '':((<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$invalid) ? 'has-error':'has-success') }}">
		<label class="col-md-9 crm-form-label control-label">{{'<?php echo $field; ?>' | translate }}
			<span style="margin: 0;"
				class="btn-action single glyphicons circle_question_mark"
				data-trigger="hover" data-type="info" data-title="{{'form.help.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>' | translate}}"
				bs-tooltip><i></i>
			</span>
		</label>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6" style="padding-right:0;">
				<div class="input-group">
				<input type="text" readonly class="form-control"
					ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field; ?>"
					id="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
					name="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
					tabindex="<?php echo ($tabidx + (($fieldcount % 2 == 0) ? 100:0)); ?>"
					data-date-format="yyyy-MM-dd"
					data-model-date-format="<?php echo (($schema[$field]["type"] == "datetime") ? 'yyyy-MM-dd HH:mm:ss':'yyyy-MM-dd'); ?>"
					data-date-type="string"
					data-container="body" data-autoclose="false"
					bs-datepicker >
				    <span class="input-group-btn">
				        <label class="btn btn-default" for="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>">
				        <i class="glyphicon glyphicon-calendar"></i></label>
				    </span>
				</div>
				</div>
<?php if($schema[$field]["type"] == "datetime"): ?>
				<div class="col-md-6">
	            	<div class="input-group">
	         			<input readonly data-container="body" type="text"
	         			data-time-type="string"
						data-model-time-format="yyyy-MM-dd HH:mm:ss"
	         			class="form-control" ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field; ?>" id="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>Time" name="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>Time" bs-timepicker>
					    <span class="input-group-btn">
					        <label class="btn btn-default" for="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>Time">
					        <i class="glyphicon glyphicon-time"></i></label>
					    </span>
		            </div>
				</div>
<?php endif; ?>
			</div>
			<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.required)">{{ 'This is a required field' | translate }}</p>
			<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.number)">{{ 'Please enter a numeric value' | translate }}</p>
			<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.datetime)">{{ 'Please enter a numeric value' | translate }}</p>
		</div>
		</div>
	</div>
<?php endif; ?>
<?php if((strpos($field, 'lov_') === FALSE)):?>
<?php if($schema[$field]["type"] !="datetime" && $schema[$field]["type"] != "date"): ?>
	<div class="col-md-6">
		<div class="form-group {{ (<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$untouched) ? '':((<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$invalid) ? 'has-error':'has-success') }}">
			<label class="col-md-9 crm-form-label control-label">{{'<?php echo $field; ?>' | translate }}
				<span style="margin: 0;"
					class="btn-action single glyphicons circle_question_mark"
					data-trigger="hover" data-type="info" data-title="{{'form.help.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>' | translate}}"
					bs-tooltip><i></i>
				</span>
			</label>
			<div class="col-md-9">
<?php if($field != 'id'):?>
<?php if($schema[$field]["type"] == "boolean"):?>
	<label class="checkbox">
<?php endif; ?>
				<<?php echo $editableType;?> class="form-control <?php echo (($schema[$field]["type"] == "boolean") ? 'checkbox':''); ?>" placeholder=""
				id="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
				name="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
				tabindex="<?php echo ($tabidx + (($fieldcount % 2 == 0) ? 100:0)); ?>"
				ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?>" <?php echo $required;?> <?php echo $editableAttribs; ?>><?php echo $editableClosing;?>
<?php if($schema[$field]["type"] == "boolean"):?>
	</label>
<?php endif; ?>
				<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.required)">{{ 'This is a required field' | translate }}</p>
				<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.number)">{{ 'Please enter a numeric value' | translate }}</p>
				<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.datetime)">{{ 'Please enter a numeric value' | translate }}</p>
<?php else: ?>
		<p class="form-control-static"><b>{{<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?>}}</b></p>
<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php else: ?>
<?php $lovSingularVar = Inflector::variable($field); ?>
	<div class="col-md-6">
		<div class="form-group {{(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$untouched) ? '':((<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$invalid) ? 'has-error':'has-success') }}">
			<label class="col-md-9 crm-form-label control-label">{{'<?php echo $field; ?>' | translate }}
				<span style="margin: 0;"
					class="btn-action single glyphicons circle_question_mark"
					data-trigger="hover" data-type="info" data-title="{{'form.help.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>' | translate}}"
					bs-tooltip><i></i>
				</span>
			</label>
			<div class="none">
				<div class="input-group col-md-9">
	                <ui-select ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?>"
	                  theme="select2"
	                  append-to-body="true"
	                  search-enabled="true"
	                  reset-search-input="true"
					  id="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
			          name="<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>"
			          tabindex="<?php echo ($tabidx + (($fieldcount % 2 == 0) ? 100:0)); ?>"
	                  on-select="setLovField(<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>,'<?php echo $field;?>', $select.selected.Lov.value)"
	                  <?php echo $required; ?>>
	                  <ui-select-match placeholder="{{'Select' | translate}}&nbsp;{{'one' | translate}}...">{{(($select.selected.Lov.value) ? ($select.selected.Lov.value | translate):(<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?> | translate))}}</ui-select-match>
	                    <ui-select-choices style="white-space:nowrap;" repeat="irow in <?php echo $lovSingularVar;?> track by $index"
	                           refresh="($select.search) ? getLovValues('<?php echo str_replace("LOV_","",strtoupper($field));?>','<?php echo $lovSingularVar;?>', $select.search):''"
	                           refresh-delay="1000">
	                    <span ng-bind-html="irow.Lov.value | translate | highlight: $select.search"></span>
	                  </ui-select-choices>
	                </ui-select>
						<span class="input-group-btn">
							<a href="javascript:;" ng-click="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?> = undefined" class="btn btn-default">
							<span class="glyphicon glyphicon-trash"></span>
							</a>
						</span>
				</div>
				<div class="col-md-offset-3 col-md-9">
					<p class="help-block" ng-show="(<?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$touched && <?php echo Inflector::humanize($singularVar); ?>Form.<?php echo Inflector::humanize($singularVar); ?><?php echo $field; ?>.$error.required)">{{ 'This is a required field' | translate }}
					</p>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if($fieldcount % 2 == 0):?>
	</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php if($fieldcount % 2 != 0):?>
	</div>
<?php endif; ?>
								<hr class="separator">
                                <div class="form-actions" style="padding-right: 15px;">
								    <a href="javascript:;" class="btn-crm-header btn btn-icon btn-primary glyphicons circle_ok" ng-disabled="!(<?php echo Inflector::humanize($singularVar); ?>Form.$valid) || <?php echo Inflector::humanize($singularVar); ?>Form.$waiting"
								    	ng-click="<?php echo $formAction;?><?php echo $singularHumanName; ?>(<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>)">{{'Save' | translate }}
								    </a>
									<a href back-button class="btn-crm-header btn btn-icon btn-default glyphicons circle_remove">{{'Cancel' | translate }}
									</a>
                                </div>
								</div>
<?php if (strpos($action, 'html_add') !== false): ?>
								<div class="separator line"></div>
                                <div class="separator line"></div>
<?php endif; ?>
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
<?php if (strpos($action, 'html_add') === false): ?>
<?php if (empty($associations['hasMany'])): ?>
<?php $associations['hasMany'] = array(); ?>
<?php endif; ?>
<?php if (empty($associations['hasAndBelongsToMany'])): ?>
<?php $associations['hasAndBelongsToMany'] = array(); ?>
<?php endif; ?>
<?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']); ?>
<?php if (!(empty($relations))): ?>

			<div class="widget widget-2 widget-tabs row row-merge margin-none" style="min-height:300px;">
				<div class="widget-head">
					<tabs data="tabs" type="none" template-url="ui-router-tabs-scrolling-template.html">
					</tabs>
				</div>

				<div class="widget-body col-md-12">
					<ui-view name='editTab'></ui-view>
				</div>
			</div>
			 <div class="separator line"></div>
             <div class="separator line"></div>
<?php else:; ?>
			<div class="separator line"></div>
            <div class="separator line"></div>
<?php endif; ?>
<?php endif; ?>
		</div>
	</div>
</div>