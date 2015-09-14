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
<section data-ng-init="prepareData()" data-ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Controller">
<h3 class="page-title">{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}</h3>
  <!-- BEGIN Portlet PORTLET-->
  <div class="portlet light bordered">
    <div class="portlet-title">
      <div class="caption font-green-sharp">
        {{ 'List' | translate }}
      </div>
      <div class="actions">
        <a ng-disabled="!session.acl.<?php echo $pluralVar; ?>.postAction" ui-sref="<?php echo strtolower($pluralVar);?>Create" class="btn btn-sm green-haze {{(!session.acl.<?php echo $pluralVar; ?>.postAction) ? 'disabled' : ''}}">
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
                          <input type="text" class="form-control" placeholder="{{ 'Search' | translate }}" ng-model="<?php echo $singularVar; ?>Filters" value="">
                          <div class="form-control-focus">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div tasty-table bind-resource="ngt<?php echo $singularHumanName; ?>Resource" watch-resource="collection" bind-filters="<?php echo $singularVar; ?>Filters">
              <div class="table-responsive">
                  <table class="table table-striped table-condensed">
                      <thead tasty-thead></thead>
                      <tbody>
                          <tr ng-show="!rows.length"><td colspan="{{(header.columns).length}}"><center>{{'No data found' | translate }}</center></td></tr>
                          <tr ng-repeat="<?php echo $singularVar; ?> in rows">
                            <?php foreach ($fields as $field)
                              {
                                $fieldAlreadyPainted = false;
                                if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                                {
                                  if(isset($associations['belongsTo']))
                                  {
                                      if(!empty($associations['belongsTo']))
                                      {
                                          foreach ($associations['belongsTo'] as $alias => $details)
                                          {
                                              if($details['foreignKey'] == $field)
                                              {
                                                $fieldAlreadyPainted = true;
                                                
                                                ?>
                                                  <td class="tasty-table-td">
                                                    {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?>.name || '...' ) | translate  }}
                                                  </td>

                                                <?php
                                              }
                                          }
                                      }
                                  }
                                  if(!$fieldAlreadyPainted)
                                  {
                                    ?>
                                      <td class="tasty-table-td">
                                        {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?> || '...' ) | translate  }}
                                      </td>

                                    <?php
                                  } 
                                }
                              }?>
                              <td>
                                <div class="actions">
                                  <a ng-disabled="!session.acl.<?php echo $pluralVar; ?>.getAction" href="/#/<?php echo $pluralVar; ?>/view/{{<?php echo $singularVar; ?>.id}}"  class="btn btn-xs btn-circle btn-block blue {{(!session.acl.<?php echo $pluralVar; ?>.getAction) ? 'disabled' : ''}}">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                  <a ng-disabled="!session.acl.<?php echo $pluralVar; ?>.putAction" href="/#/<?php echo $pluralVar; ?>/edit/{{<?php echo $singularVar; ?>.id}}" class="btn btn-xs btn-circle btn-block yellow-casablanca {{(!session.acl.<?php echo $pluralVar; ?>.putAction) ? 'disabled' : ''}}" >
                                    <i class="fa fa-pencil"></i>
                                  </a>
                                </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div tasty-pagination bind-items-per-page="ngTitemsPerPage" bind-list-items-per-page="ngTlistItemsPerPage"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Portlet PORTLET-->
</section>