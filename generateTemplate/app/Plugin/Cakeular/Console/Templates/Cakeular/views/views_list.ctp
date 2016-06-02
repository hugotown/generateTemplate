<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>

<section class="none" data-ng-controller="<?= Inflector::humanize($pluralVar); ?>Ctrl">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                {{ 'List' | translate }}
            </div>
            <div class="actions">
                <a ng-init="filterPanel = 100" ng-click=" (filterPanel == 0)? filterPanel = 100 : filterPanel = 0; " class="btn btn-sm {{ tableIsFiltered ? 'green' : 'green-haze' }} " >
                    <i class="glyphicon glyphicon-filter" data-container="body" data-title="{{'Filter' | translate}}" data-animation="am-flip-x" bs-tooltip></i>
                </a>
                <a acl-check="<?= $pluralVar; ?>Create" ui-sref="<?= $pluralVar; ?>Create" class="btn btn-sm green-haze " data-container="body" data-title="{{'Create' | translate}}" data-animation="am-flip-x" bs-tooltip >
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="portlet-body">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="panel-group" ng-model="filterPanel" role="tablist" aria-multiselectable="true" bs-collapse>
                        <div class="panel panel-default" >
                            <div class="panel-collapse" role="tabpanel" bs-collapse-target>
                                <div class="panel-body">
                                    <h4>{{ 'Filters' | translate }}</h4>
                                    <form class="form-horizontal" onsubmit="return false;">
                                        <div class="form-body">
                                            <?php foreach ($fields as $field)
                                            {
                                                if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                                                {
                                                    $this->out("\n");
                                                    $this->out("field");
                                                    $this->out($field);
                                                    $this->out($schema[$field]);

                                                    $fieldAlreadyPainted = false;
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
                                                                    $fieldAlreadyPainted = true;

                                                                    //echo $otherPluralVar ."\n";
                                                                    //echo $otherPluralHumanName ."\n";
                                                                    //echo $otherSingularHumanName ."\n";
                                                                    //echo $otherPluralVar ."\n";

                                                                    ?>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group" >
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <ui-select ng-disabled="(parentObjType == '<?= $otherSingularHumanName; ?>')" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>.selected" id="<?= $field; ?>" name="<?= $field; ?>" reset-search-input="false" theme="bootstrap" >
                                        <ui-select-match placeholder="{{ 'Select <?= $alias; ?>' | translate }}...">{{$select.selected.name}}</ui-select-match>
                                        <ui-select-choices repeat="item in <?= Inflector::pluralize($otherSingularVar); ?> "  refresh="find<?= Inflector::pluralize($alias); ?>($select.search)" refresh-delay="500" >
                                            <div ng-bind-html="item.name | highlight: $select.search"></div>
                                        </ui-select-choices>
                                    </ui-select>
                                    <span class="input-group-btn btn-right">
                                        <a  class="btn grey {{ (parentObjType == '<?= $otherSingularHumanName; ?>') ? 'disabled' : '' }} " type="button" ng-click="<?= $singularVar; ?>Filters.<?= $field; ?>.selected = undefined;">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
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
                                                        if (strpos($field, 'lov_') !== false)
                                                        {
                                                            $fieldNameWLov = str_replace('lov_', '', $field);
                                                            $upperFieldNameWLov = strtoupper($fieldNameWLov);

                                                        } else {
                                                            switch ($schema[$field]["type"])
                                                            {
                                                                case 'string': {
                                                                    ?>

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                                    <input name="<?= $field; ?>" id="<?= $field; ?>" type="text" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" autocomplete="off"  ng-model-options="{ updateOn: 'default blur', debounce: {'default': 500, 'blur': 0} }" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                    break;
                                                                }
                                                                case 'text': {
                                                                    break;
                                                                }
                                                                case 'boolean': {
                                                                    ?>

                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group" >
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                                    <div class="input-group">
                                                                                        <ui-select required ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" name="<?= $field; ?>" id="<?= $field; ?>" reset-search-input="false" theme="bootstrap" >
                                                                                            <ui-select-match placeholder="{{ 'Select' | translate }}...">{{$select.selected.name}}</ui-select-match>
                                                                                            <ui-select-choices repeat="item in [{'name':'true', 'value':1},{'name':'false', value:0}] " >
                                                                                                <div ng-bind-html="item.name | highlight: $select.search"></div>
                                                                                            </ui-select-choices>
                                                                                        </ui-select>
                                                                                          <span class="input-group-btn btn-right">
                                                                                              <a class="btn btn-default" type="button" ng-click="<?= $singularVar; ?>Filters.<?= $field; ?> = undefined">
                                                                                                  <i class="fa fa-times"></i>
                                                                                              </a>
                                                                                          </span>
                                                                                    </div>
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                                    <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" autocomplete="off"  ng-model-options="{ updateOn: 'default blur', debounce: {'default': 500, 'blur': 0} }" ignore-mouse-wheel >
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                                    <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" autocomplete="off"  ng-model-options="{ updateOn: 'default blur', debounce: {'default': 500, 'blur': 0} }" ignore-mouse-wheel >
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                                    <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" autocomplete="off"  ng-model-options="{ updateOn: 'default blur', debounce: {'default': 500, 'blur': 0} }" ignore-mouse-wheel >
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-12 col-md-12 col-sm-12 " >
                                                                                    <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" id="<?= $field;?>" placeholder="{{ '<?= $field;?>' | translate }}" autocomplete="off" <?= $required ; ?> data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd HH:mm:ss" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-datepicker >
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
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class=" col-lg-6 col-md-6 col-sm-6 " style="margin: 0px !important; padding: 0px !important;" >
                                                                                    <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" id="<?= $field;?>Date" placeholder="{{ '<?= $field;?>Date' | translate }}" autocomplete="off" data-date-format="yyyy-MM-dd" data-model-date-format="yyyy-MM-dd HH:mm:ss" data-date-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-datepicker >
                                                                                </div>
                                                                                <div class=" col-lg-6 col-md-6 col-sm-6 " style="margin: 0px !important; padding: 0px !important;" >
                                                                                    <input name="<?= $field;?>" type="text" class="form-control" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" id="<?= $field;?>Time" placeholder="{{ '<?= $field;?>Time' | translate }}" autocomplete="off" data-model-time-format="yyyy-MM-dd HH:mm:ss" data-time-type="string" data-container="body" data-autoclose="1" data-animation="am-flip-x" bs-timepicker >
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

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <div tasty-table bind-resource-callback="get<?= Inflector::camelize($pluralVar); ?>" bind-filters="<?= $singularVar; ?>Filters" >
                            <table class="table table-striped table-condensed">
                                <thead tasty-thead not-sort-by="['actions']"></thead>
                                <tbody>
                                <tr ng-show="!rows.length">
                                    <td class="tasty-table-td text-center" colspan="{{(header.columns).length}}">{{'No data found' | translate }}</td>
                                </tr>
                                <tr ng-repeat="<?= $singularVar; ?> in rows" >

                                                    <?php foreach ($fields as $field)
                                                    {
                                                        if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
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
                                                                            $otherSingularVar = Inflector::variable($alias);
                                                                            $otherPluralHumanName = Inflector::humanize($details['controller']);
                                                                            $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                                                            $otherPluralVar = Inflector::variable($details['controller']);
                                                                            $fieldAlreadyPainted = true;

                                                                            ?>

                                                                            <td class="tasty-table-td text-center">
                                                                                <a ng-if="<?= $singularVar; ?>.<?= $field; ?>.id" acl-check="<?= $otherPluralVar; ?>View" href="/#/<?= $otherPluralVar; ?>/view/{{<?= $singularVar; ?>.<?= $field; ?>.id}}"  class="btn btn-xs btn-circle btn-block blue " data-container="body" data-title="{{'Go to' | translate}}&nbsp;{{<?= $singularVar; ?>.<?= $field; ?>.name}}&nbsp;{{'<?= $otherSingularVar; ?>' | translate }}" data-animation="am-flip-x" bs-tooltip >
                                                                                    {{ ( <?= $singularVar; ?>.<?= $field; ?>.name || '...' ) | translate  }}
                                                                                    <i class="fa fa-share"></i>
                                                                                </a>
                                                                                <a ng-if="!<?= $singularVar; ?>.<?= $field; ?>.id" href="javascript:;">...</a>
                                                                            </td>

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


                                                                    <td class="tasty-table-td text-center">
                                                                        <span ng-if="selectedLanguage" show-lov-value="<?= $upperFieldNameWLov; ?>" load-lovtype-value="{{<?= $singularVar; ?>.<?= $field; ?>}}" ></span>
                                                                        <span ng-if="!selectedLanguage" >{{<?= $singularVar; ?>.<?= $field; ?>}}</span>
                                                                    </td>
                                                                    <?php

                                                                } else{

                                                                    switch ($schema[$field]["type"])
                                                                    {
                                                                        case 'string': {
                                                                            ?>


                                                                            <td class="tasty-table-td text-center">
                                                                                <a href="javascript:;" editable-text="<?= $singularVar; ?>.<?= $field; ?>" onaftersave="editableUpdate(<?= $singularVar; ?>, '<?= $field; ?>')">
                                                                                    {{ ( <?= $singularVar; ?>.<?= $field; ?> || '...' ) | translate  }}
                                                                                </a>
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'text': {
                                                                            break;
                                                                        }
                                                                        case 'boolean': {
                                                                            ?>


                                                                            <td class="tasty-table-td text-center">
                                                                                <a href="javascript:;" editable-checkbox="<?= $singularVar; ?>.<?= $field; ?>" onaftersave="editableUpdate(<?= $singularVar; ?>, '<?= $field; ?>')" >
                                                                                    {{ <?= $singularVar; ?>.<?= $field; ?> && "True" || "False" | translate }}
                                                                                </a>
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'decimal': {
                                                                            ?>


                                                                            <td class="tasty-table-td">
                                                                                <a href="javascript:;" class="pull-right" editable-number="<?= $singularVar; ?>.<?= $field; ?>" e-min="1" onaftersave="editableUpdate(<?= $singularVar; ?>, '<?= $field; ?>')" >
                                                                                    {{ <?= $singularVar; ?>.<?= $field; ?> }}
                                                                                </a>
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'float': {
                                                                            ?>


                                                                            <td class="tasty-table-td">
                                                                                <a href="javascript:;" class="pull-right" editable-number="<?= $singularVar; ?>.<?= $field; ?>" e-min="1" onaftersave="editableUpdate(<?= $singularVar; ?>, '<?= $field; ?>')" >
                                                                                    {{ <?= $singularVar; ?>.<?= $field; ?> }}
                                                                                </a>
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'integer': {
                                                                            ?>


                                                                            <td class="tasty-table-td">
                                                                                <a href="javascript:;" class="pull-right" editable-number="<?= $singularVar; ?>.<?= $field; ?>" e-min="1" onaftersave="editableUpdate(<?= $singularVar; ?>, '<?= $field; ?>')" >
                                                                                    {{ <?= $singularVar; ?>.<?= $field; ?> }}
                                                                                </a>
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'date': {
                                                                            ?>


                                                                            <td class="tasty-table-td text-center">
                                                                                {{ <?= $singularVar; ?>.<?= $field; ?> }}
                                                                            </td>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        case 'datetime': {
                                                                            ?>


                                                                            <td class="tasty-table-td text-center">
                                                                                {{ <?= $singularVar; ?>.<?= $field; ?> }}
                                                                            </td>
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
                                                    }?>

                                    <td class="actions text-center" style=" min-width: 180px !important; ">
                                        <div class="btn-group">
                                            <a acl-check="<?= $pluralVar; ?>View" href="/#/<?= $pluralVar; ?>/view/{{<?= $singularVar; ?>.id}}" class="btn btn-xs btn-circle blue" data-container="body" data-title="{{'View' | translate}}" data-animation="am-flip-x" bs-tooltip >
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a acl-check="<?= $pluralVar; ?>Edit" href="/#/<?= $pluralVar; ?>/edit/{{<?= $singularVar; ?>.id}}" class="btn btn-xs btn-circle yellow-casablanca " data-container="body" data-title="{{'Edit' | translate}}" data-animation="am-flip-x" bs-tooltip >
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="btn btn-xs btn-circle red " ng-bootbox-confirm="{{ 'Are you sure want to delete' | translate }} : {{<?= $singularVar; ?>.name}} {{'<?= $singularVar; ?>'}}" ng-bootbox-confirm-action="remove(<?= $singularVar; ?>)" >
                                                <i class="glyphicon glyphicon-trash" data-container="body" data-title="{{'Delete' | translate}}" data-animation="am-flip-x" bs-tooltip></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div tasty-pagination ></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END Portlet PORTLET-->

</section>