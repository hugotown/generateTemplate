<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
<div class="row" ng-controller="<?php echo $pluralHumanName; ?>IndexController">
	<div class="col-md-12 content">
  <div ui-view="" class="ng-scope">
    <div class='none'>
      <div class="portlet-body">
        <div class="row crm-tabbedview-header">
          <div class="col-md-6 col-sm-12">
          <a type="button" class="btn-crm-header btn btn-sm btn-primary btn-icon glyphicons circle_plus" ui-sref='<?php echo $pluralVar ;?>.add'"> {{'Add' | translate }} {{'<?php echo $singularHumanName; ?>' | translate }}</a>
          </div>          
          <div class="col-md-6 col-sm-12">
            <div class="input-group input-group-sm crm-header-search" style="padding-bottom:10px;">
              <span class="input-group-addon"><i class="glyphicons search"></i></span>
              <input type="text" class="form-control" placeholder="{{'Search' | translate}}" ng-model="filterBy['sSearch']">
            </div>            
          </div>
        </div>        
        <div class="crm-list-table" tasty-table bind-resource-callback="get<?php echo $pluralHumanName; ?>" bind-init="init" bind-filters="filterBy">
          <div class='table-scrollable'>
          <table class="table table-hover no-footer table-condensed">
            <thead tasty-thead not-sort-by="['actions']"></thead>
            <tbody>
              <tr ng-if="!rows.length"><td colspan="{{(header.columns).length}}"><center>{{'No data found' | translate }}</center></td></tr>
              <tr ng-repeat="row in rows track by $index">
<?php foreach ($fields as $field): ?>
<?php 
  $required = '';
  if(!($schema[$field]['null'])) {
    $required = 'e-required';
  }
  $editableType    = 'text';
  $editableAttribs = '';
  if(!($schema[$field]['null'])) {
    $required = 'e-required';
  }
  switch($schema[$field]["type"]){
    case 'text': {
      $editableType    = 'textarea';
      $editableAttribs = 'e-rows="7" e-cols="40"';
      break;
    }
    case 'boolean': {
      $editableType    = 'checkbox';
      $editableAttribs = 'e-title="' . $field . '?"';
      $required        = '';
      break;                
    }
    case 'decimal':         
    case 'float': {
      $editableType    = 'number';
      $editableAttribs = 'e-step="any"';
      break;            
    } 
    case 'integer': {
      $editableType    = 'number';
      $editableAttribs = 'e-step="1"';
      break;            
    } 
    case 'date': {
      $editableType    = 'bsdate';
      $editableAttribs = 'e-datepicker-popup="yyyy-MM-dd"';
      break;            
    }
    case 'datetime': {
      $editableType    = 'bsdatetime';
      $editableAttribs = 'e-datepicker-popup="yyyy-MM-dd"';
      break;            
    }
            
    default :{
      //none
    }
  }
?>
<?php if(!in_array($field, array('updated', 'created', 'updated_by','created_by'))): ?>
<?php if((strpos($field, 'lov_') === FALSE)):?>
<?php if($field == 'name'){ 
?>
        <td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
          ng-mouseleave="(editingField = undefined)">
          <span editable-text="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" onaftersave="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)" <?php echo $required; ?> <?php echo $editableAttribs; ?> e-form="<?php echo $singularHumanName ;?><?php echo $field ;?>">
              <a ui-sref="<?php echo $pluralVar ;?>.edit({ id: row.<?php echo $singularHumanName ;?>.id })">{{row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>}}</a>
          </span>
          <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="<?php echo $singularHumanName ;?><?php echo $field ;?>.$show()" ng-hide="<?php echo $singularHumanName ;?><?php echo $field ;?>.$visible">
            <i class="glyphicon glyphicon-pencil"></i>
          </a>
        </td>
<?php } else { ?>
<?php $isKey = false; ?>
<?php if (!empty($associations['belongsTo'])): ?>
<?php foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherSingularHumanName = Inflector::singularize($otherPluralHumanName); ?>
<?php $otherPluralVar = Inflector::variable($details['controller']); ?>
<?php if ($field === $details['foreignKey']): ?>
<?php $isKey = true; ?>
          <td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
            ng-mouseleave="(editingField = undefined)">
            <span ng-if="!(editingCustomField == '<?php echo $field; ?>_' + $index)">
              <a href="/#/<?php echo strtolower($alias)?>s/edit/{{row.<?php echo $singularHumanName; ?>.<?php echo $otherSingularVar;?>_id}}">{{row.<?php echo $otherSingularHumanName; ?>.name || '&nbsp;'}}</a>
            </span>
            <div ng-if="(editingCustomField == '<?php echo $field; ?>_' + $index)" class="button-group" style="width:164px !important;">           
                <ui-select ng-model="row.<?php echo $otherSingularHumanName ;?>" 
                  theme="select2"
                  append-to-body="true"
                  search-enabled="true"
                  reset-search-input="true" 
                  on-select="set<?php echo $singularHumanName; ?><?php echo $otherSingularHumanName; ?>(row.<?php echo $singularHumanName; ?>, row.<?php echo $otherSingularHumanName; ?>)"
                  required>
                  <ui-select-match placeholder="{{'Select' | translate}}&nbsp;<?php echo $otherSingularHumanName; ?>...">{{row.<?php echo $otherSingularHumanName; ?>.name}}</ui-select-match>
                    <ui-select-choices style="white-space:nowrap;" repeat="irow in <?php echo $otherPluralVar; ?> track by $index"
                           refresh="($select.search) ? get<?php echo $otherPluralHumanName; ?>($select.search):''"
                           refresh-delay="1000">
                    <span ng-bind-html="irow.name | translate | highlight: $select.search"></span>
                  </ui-select-choices>
                </ui-select>
                <span class="editable-buttons">
                  <button type="button" class="btn blue btn-xs" ng-click="editCustomField(undefined)" tabindex="0"><span class="glyphicon glyphicon-remove"></span>
                  </button>
                </span>              
            </div>
            <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index) && !(editingCustomField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="editCustomField('<?php echo $field; ?>_' + $index)">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </td>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if (!$isKey): ?>
<?php if ($editableType != "checkbox"): ?>
<?php if ($editableType == "bsdate"): ?>
          <td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
            ng-mouseleave="(editingField = undefined)">
            <span ng-if="!(editingCustomField == '<?php echo $field; ?>_' + $index)">
              {{ row.<?php echo $singularHumanName ;?>.<?php echo $field ;?> | date:'yyyy-MM-dd' }}
            </span>
            <div ng-if="(editingCustomField == '<?php echo $field; ?>_' + $index)" class="form-inline editable-wrap editable-text">
            <div class="editable-controls form-group">
            <div class="input-group" style="width:109px !important;">
            <input type="text" readonly class="form-control input-sm" 
              ng-model="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" 
              id="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}"
              name="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}"
              data-date-format="yyyy-MM-dd"
              data-model-date-format="yyyy-MM-dd"
              data-date-type="string"
              data-container="body" data-autoclose="false"
              ng-change="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)"
              bs-datepicker 
              style="font-size:12px;">
                <span class="input-group-btn">
                    <label class="btn btn-default btn-dt-sm" for="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}">
                    <i class="glyphicon glyphicon-calendar"></i></label>
                </span>                   
            </div>
            </div> 
            <span class="editable-buttons">
              <button type="button" class="btn blue btn-xs" ng-click="editCustomField(undefined)" tabindex="0"><span class="glyphicon glyphicon-remove"></span>
              </button>
            </span> 
          </div>
            <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index) && !(editingCustomField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="editCustomField('<?php echo $field; ?>_' + $index)">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </td>
<?php elseif ($editableType == "bsdatetime"): ?>
          <td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
            ng-mouseleave="(editingField = undefined)">
            <span ng-if="!(editingCustomField == '<?php echo $field; ?>_' + $index)">
              {{ row.<?php echo $singularHumanName ;?>.<?php echo $field ;?> | date:'yyyy-MM-dd HH:mm:ss' }}
            </span>
            <div ng-if="(editingCustomField == '<?php echo $field; ?>_' + $index)" class="form-inline editable-wrap editable-text">
            <div class="editable-controls form-group">
            <div class="input-group" style="width:109px !important;">
            <input type="text" readonly class="form-control input-sm" 
              ng-model="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" 
              id="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}"
              name="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}"
              data-date-format="yyyy-MM-dd"
              data-model-date-format="yyyy-MM-dd HH:mm:ss"
              data-date-type="string"
              data-container="body" data-autoclose="false"
              ng-change="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)"
              bs-datepicker 
              style="font-size:12px;">
                <span class="input-group-btn">
                    <label class="btn btn-default btn-dt-sm" for="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}">
                    <i class="glyphicon glyphicon-calendar"></i></label>
                </span>                   
            </div>          
            <div class="input-group" style="width:98px !important;">
            <input readonly data-container="body" type="text"
                data-time-type="string"
                data-model-time-format="yyyy-MM-dd HH:mm:ss"
                class="form-control input-sm" ng-model="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" 
                id="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}Time" 
                name="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}Time" bs-timepicker
                ng-change="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)"
                style="font-size:12px;">
            <span class="input-group-btn">
              <label class="btn btn-default btn-dt-sm" for="<?php echo $singularHumanName ;?><?php echo $field ;?>{{row.<?php echo $singularHumanName ;?>.id}}Time">
              <i class="glyphicon glyphicon-time"></i></label>
            </span>     
            </div>
            </div> 
            <span class="editable-buttons">
              <button type="button" class="btn blue btn-xs" ng-click="editCustomField(undefined)" tabindex="0"><span class="glyphicon glyphicon-remove"></span>
              </button>
            </span> 
          </div>
            <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index) && !(editingCustomField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="editCustomField('<?php echo $field; ?>_' + $index)">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </td>
<?php else: ?>
<?php if($field != 'id'): ?>
				<td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
          ng-mouseleave="(editingField = undefined)">
          <span editable-<?php echo $editableType; ?>="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" onaftersave="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)"
            <?php echo $required; ?> <?php echo $editableAttribs; ?> e-form="<?php echo $singularHumanName ;?><?php echo $field ;?>">
              {{ row.<?php echo $singularHumanName ;?>.<?php echo $field ;?> || '&nbsp;' }}
          </span>
          <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="<?php echo $singularHumanName ;?><?php echo $field ;?>.$show()" ng-hide="<?php echo $singularHumanName ;?><?php echo $field ;?>.$visible">
            <i class="glyphicon glyphicon-pencil"></i>
          </a>
        </td>
<?php endif; ?>
<?php endif; ?>
<?php else: ?>
          <td class="tasty-table-td">
            <label class="checkbox">
              <input apply-uniform type="checkbox" placeholder=""        
              ng-model="row.<?php echo $singularHumanName ;?>.<?php echo $field ;?>" ng-change="update<?php echo $singularHumanName;?>(row.<?php echo $singularHumanName ;?>)"
            >
            </label>
          </td>
<?php endif; ?>

<?php else: ?>
<?php $isKey = false; ?>
<?php endif; ?>
<?php } ?>
<?php else: ?>
<?php $lovSingularVar = Inflector::variable($field); ?>  
          <td class="tasty-table-td" ng-mouseenter="(editingField = '<?php echo $field; ?>_' + $index)"
            ng-mouseleave="(editingField = undefined)">
            <span ng-if="!(editingCustomField == '<?php echo $field; ?>_' + $index)">
              {{row.<?php echo $singularHumanName; ?>.<?php echo $field;?> | translate}}
            </span>
            <div ng-if="(editingCustomField == '<?php echo $field; ?>_' + $index)" class="button-group" style="width:164px !important;">           
                <ui-select ng-model="row.<?php echo $singularHumanName;?>.<?php echo $field;?>" 
                  theme="select2"
                  append-to-body="true"
                  search-enabled="true"
                  reset-search-input="true" 
                  on-select="setLovField(row.<?php echo $singularHumanName; ?>,'<?php echo $field;?>', $select.selected.Lov.value)"
                  <?php echo $required; ?>>
                  <ui-select-match placeholder="{{'Select' | translate}}&nbsp;{{'one' | translate}}...">{{(($select.selected.Lov.value) ? ($select.selected.Lov.value | translate):(row.<?php echo $singularHumanName; ?>.<?php echo $field;?> | translate))}}</ui-select-match>
                    <ui-select-choices style="white-space:nowrap;" repeat="irow in <?php echo $lovSingularVar;?> track by $index"
                           refresh="($select.search) ? getLovValues('<?php echo str_replace("LOV_","",strtoupper($field));?>','<?php echo $lovSingularVar;?>', $select.search):''"
                           refresh-delay="1000">
                    <span ng-bind-html="irow.Lov.value | highlight: $select.search"></span>
                  </ui-select-choices>
                </ui-select>
                <span class="editable-buttons">
                  <button type="button" class="btn blue btn-xs" ng-click="editCustomField(undefined)" tabindex="0"><span class="glyphicon glyphicon-remove"></span>
                  </button>
                </span>              
            </div>
            <a href="javascript:;" ng-if="(editingField == '<?php echo $field; ?>_' + $index) && !(editingCustomField == '<?php echo $field; ?>_' + $index)" class="btn-crm-inline-edit btn-crm-default btn btn-circle btn-xs btn-default" ng-click="editCustomField('<?php echo $field; ?>_' + $index)">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
                <td class="tasty-table-td actions">
                  <div class="btn-group btn-group-circle">
                    <a href="#/<?php echo $pluralVar ;?>/edit/{{row.<?php echo $singularHumanName ;?>.id}}" class="btn-crm-default btn btn-default btn-xs" >
                      <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="#" class="btn-crm-default btn btn-default btn-xs" ng-click="delete<?php echo $singularHumanName ;?>(row.<?php echo $singularHumanName ;?>)">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                    <a href="#" class="btn-crm-default btn btn-default btn-xs" ng-click="setAboutRecord(header, row)" data-animation="am-fade-and-slide-top" data-toogle="modal" data-template="../tpl/modal-about-record.html" bs-modal="modal">
                        <i class="glyphicon glyphicon-info-sign"></i>                     
                    </a>                       
                  </div>
                </td>                
              </tr>
            </tbody>
          </table>
          </div> 
          <div class="crm-list-pagination" tasty-pagination list-items-per-page="[10,15,30,50]"></div>
        </div> 
       <div class="separator line"></div>
       <div class="separator line"></div>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
		</div>
    </div>
	</div>	
</div>