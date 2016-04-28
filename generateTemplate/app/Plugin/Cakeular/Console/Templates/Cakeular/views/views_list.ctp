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
                <a acl-check="<?= $pluralVar; ?>Create" ui-sref="<?= $pluralVar; ?>Create" class="btn btn-sm green-haze ">
                    <i class="fa fa-plus"></i>&nbsp;{{'Add' | translate}}
                </a>
            </div>
        </div>
        <div class="portlet-body">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">

                        <div tasty-table bind-resource-callback="get<?= Inflector::camelize($pluralVar); ?>" bind-filters="<?= $singularVar; ?>Filters" >
                            <table class="table table-striped table-condensed">
                                <thead tasty-thead></thead>
                                <tbody>
                                <tr>
                                    <td class="tasty-table-td text-center" colspan="{{(header.columns).length}}">{{'Filters' | translate }}</td>
                                </tr>
                                <tr>
                                    <?php foreach ($fields as $field)
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

                                                        <td class="tasty-table-td">
                                                            <div class="form-group">
                                                                <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                    <input name="<?= $field; ?>" id="<?= $field; ?>" type="text" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        if(!$fieldAlreadyPainted) {
                                            if (strpos($field, 'lov_') !== false) {
                                                $fieldNameWLov = str_replace('lov_', '', $field);
                                                $upperFieldNameWLov = strtoupper($fieldNameWLov);

                                            } else {
                                                switch ($schema[$field]["type"]) {
                                                    case 'text': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="text" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <?php
                                                        break;
                                                    }
                                                    case 'boolean': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group" >
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <div class="input-group">
                                                                    <ui-select required ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" name="<?= $field; ?>" id="<?= $field; ?>" reset-search-input="false" theme="bootstrap"  style=" min-width: 126px !important; " >
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
                                                        </td>

                                                        <?php
                                                        break;
                                                    }
                                                    case 'decimal': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>

                                                        <?php
                                                    }
                                                    case 'float': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>

                                                        <?php
                                                        break;
                                                    }
                                                    case 'integer': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="number" min="0" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>

                                                        <?php
                                                        break;
                                                    }
                                                    case 'date': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="text" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>

                                                        <?php
                                                        break;
                                                    }
                                                    case 'datetime': {
                                                        ?>

                                                        <td class="tasty-table-td">
                                                        <div class="form-group">
                                                            <div class=" col-lg-12 col-md-12 col-sm-12 ">
                                                                <input name="<?= $field; ?>" id="<?= $field; ?>" type="text" class="form-control" placeholder="{{ '<?= $singularVar ."-" .$field; ?>' | translate }}" ng-model="<?= $singularVar; ?>Filters.<?= $field; ?>" style=" min-width: 126px !important; " >
                                                            </div>
                                                        </div>
                                                        </td>

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
                                    <!--ACTIONS COLUMN-->
                                    <td class="tasty-table-td"></td>
                                </tr>
                                <tr ng-show="!rows.length">
                                    <td class="tasty-table-td text-center" colspan="{{(header.columns).length}}">{{'No data found' | translate }}</td>
                                </tr>
                                <tr ng-repeat="<?= $singularVar; ?> in rows">
                                    <?php foreach ($fields as $field)
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

                                                        <td class="tasty-table-td">
                                                            <a ng-if="<?= $singularVar; ?>.<?= $field; ?>.id" ng-disabled="!session.aclstates.<?= $otherPluralVar; ?>View" href="/#/<?= $otherPluralVar; ?>/view/{{<?= $singularVar; ?>.<?= $field; ?>.id}}"  class="btn btn-xs btn-circle btn-block blue {{(!session.aclstates.<?= $otherPluralVar; ?>View) ? 'disabled' : ''}}">
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

                                                <td class="tasty-table-td">
                                                    <span load-lovtype="<?= $upperFieldNameWLov; ?>" load-lovtype-value="{{<?= $singularVar; ?>.<?= $field; ?>}}" ></span>
                                                </td>

                                                <?php

                                            } else{
                                                ?>

                                                <td class="tasty-table-td text-center">
                                                    {{ ( <?= $singularVar; ?>.<?= $field; ?> || '...' ) | translate  }}
                                                </td>

                                                <?php

                                            }
                                        }
                                    }?>
                                    <td class="actions" style=" min-width: 126px !important; ">
                                        <div class="btn-group">
                                            <a acl-check="<?= $pluralVar; ?>View" href="/#/<?= $pluralVar; ?>/view/{{<?= $singularVar; ?>.id}}" class="btn btn-xs btn-circle blue">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a acl-check="<?= $pluralVar; ?>Edit" href="/#/<?= $pluralVar; ?>/edit/{{<?= $singularVar; ?>.id}}" class="btn btn-xs btn-circle yellow-casablanca " >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a ng-click="remove(<?= $singularVar; ?>)" class="btn btn-xs btn-circle red " >
                                                <i class="fa fa-trash-o"></i>
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