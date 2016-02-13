<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
<style>
/* Contextual table row variants */
/* Override from template */
.table > thead > tr > td,
.table > thead > tr > th,
.table > thead > tr > td,
.table > thead > tr > th {
    background: #FFFFFF !important;
    color: #004b54 !important;
    cursor: pointer;
}
.editable-click, a.editable-click {
    cursor: pointer;
}
</style>
<section data-ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Ctrl">
  <!-- BEGIN Portlet PORTLET-->
  <div class="portlet light bordered">
    <div class="portlet-title">
      <div class="caption font-green-sharp">
        {{ 'List' | translate }}
      </div>
      <div class="actions">
        <a acl-check="<?php echo $pluralVar; ?>Create" ui-sref="<?php echo strtolower($pluralVar);?>Create" class="btn btn-sm green-haze ">
          <i class="fa fa-plus"></i>&nbsp;{{'Add' | translate}}
        </a>
      </div>
    </div>
    <div class="portlet-body">
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group form-md-line-input has-info">
                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="input-group-control col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <input type="text" class="form-control" placeholder="{{ 'Search' | translate }}" ng-model="<?php echo $singularVar; ?>Filters.name" >
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
            <div tasty-table bind-resource-callback="get<?php echo Inflector::camelize($pluralVar); ?>" bind-filters="<?php echo $singularVar; ?>Filters" >
                  <table class="table table-striped table-condensed">
                      <thead tasty-thead></thead>
                      <tbody>
                          <tr ng-show="!rows.length"><td colspan="{{(header.columns).length}}"><center>{{'No data found' | translate }}</center></td></tr>
                          <tr ng-repeat="<?php echo $singularVar; ?> in rows">
                            <?php foreach ($fields as $field)
                              {
                                $fieldAlreadyPainted = false;
                                if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                                {
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
  <a ng-if="<?php echo $singularVar; ?>.<?php echo $field; ?>.id" ng-disabled="!session.aclstates.<?php echo $otherPluralVar; ?>View" href="/#/<?php echo $otherPluralVar; ?>/view/{{<?php echo $singularVar; ?>.<?php echo $field; ?>.id}}"  class="btn btn-xs btn-circle btn-block blue {{(!session.aclstates.<?php echo $otherPluralVar; ?>View) ? 'disabled' : ''}}">
      {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?>.name || '...' ) | translate  }}
      <i class="fa fa-share"></i>
  </a>
  <a ng-if="!<?php echo $singularVar; ?>.<?php echo $field; ?>.id" href="javascript:;">...</a>
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
<span load-lovtype="<?php echo $upperFieldNameWLov; ?>" load-lovtype-value="{{<?php echo $singularVar; ?>.<?php echo $field; ?>}}" ></span>
</td>

                                    <?php

                                    } else{
                                    ?>

<td class="tasty-table-td">
  {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?> || '...' ) | translate  }}
</td>

                                    <?php

                                    }
                                  } 
                                }
                              }?>
                              <td>
                                <div class="actions tbl-actions">
                                    <a acl-check="<?php echo $pluralVar; ?>View" href="/#/<?php echo $pluralVar; ?>/view/{{<?php echo $singularVar; ?>.id}}" class="btn btn-xs btn-circle btn-block blue">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a acl-check="<?php echo $pluralVar; ?>Edit" href="/#/<?php echo $pluralVar; ?>/edit/{{<?php echo $singularVar; ?>.id}}" class="btn btn-xs btn-circle btn-block yellow-casablanca" >
                                        <i class="fa fa-pencil"></i>
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