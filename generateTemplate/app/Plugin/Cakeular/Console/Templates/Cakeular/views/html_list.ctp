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
  md-toolbar.demo-toolbar {
    border-radius: 3px 3px 0 0;
    box-shadow: 0 1px rgba(255, 255, 255, 0.1);
}
</style>
<section data-ng-init="prepareData()" data-ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Controller">
  <!-- BEGIN Portlet PORTLET-->
  <div class="portlet box green-haze">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-gift"></i>{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}
      </div>
      <div class="tools">
        <a href="javascript:;" class="collapse">
        </a>
        <a href="#portlet-config" data-toggle="modal" class="config">
        </a>
        <a href="javascript:;" class="reload">
        </a>
      </div>
    </div>
    <div class="portlet-body">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group form-md-line-input has-info form-md-floating-label">
          <div class="input-group">
            <div class="input-group-control">
              <input type="text" name="fSearch" class="form-control" ng-model="<?php echo $singularVar; ?>Filters" value="">
              <label for="fSearch">{{ 'Search' | translate }}</label>
            </div>
            <span class="input-group-btn btn-right">
              <md-menu>
                <md-button class="md-icon-button" ng-click="$mdOpenMenu()">
                  <i class="fa fa-bars"></i>
                </md-button>
                <md-menu-content>
                  <md-menu-item>
                    <md-button ui-sref="<?php echo strtolower($pluralVar);?>Create">
                      {{ 'Add <?php echo $singularVar; ?>' | translate }}
                    </md-button>
                  </md-menu-item>
                  <md-menu-divider></md-menu-divider>
                  <md-menu-item>
                    <md-button ng-click="ExportToExcel()">
                      <i class='fa fa-file-excel-o'></i>
                      {{ 'Export to Excel' | translate }}
                    </md-button>
                  </md-menu-item>
                  <md-menu-item>
                    <md-button ng-click="ExportToPDF()">
                      <i class='fa fa-file-pdf-o'></i>
                      {{ 'Export to PDF' | translate }}
                    </md-button>
                  </md-menu-item>
                </md-menu-content>
              </md-menu>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div tasty-table bind-resource="ngt<?php echo Inflector::humanize($pluralVar); ?>Resource" watch-resource="collection" bind-filters="<?php echo $singularVar; ?>Filters">
          <div class='table-responsive'>
            <table class="table table-striped table-condensed">
              <thead tasty-thead></thead>
              <tbody>
                <tr ng-show="!rows.length">
                  <td colspan="{{(header.columns).length}}">
                    <center>{{'No data found' | translate }}</center>
                  </td>
                </tr>
                <tr ng-repeat="<?php echo $singularVar; ?> in rows">
                  <?php foreach ($fields as $field)
                    {
                      if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                      {
                        ?>
                  <td class="tasty-table-td">
                    <span onaftersave="editableUpdate(<?php echo $singularVar; ?>)" editable-text="<?php echo $singularVar; ?>.<?php echo $field; ?>">
                    {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?> || '...' ) | translate  }}
                    </span>
                  </td>
                  <?php 
                    }
                    }?>
                  <td>
                    <div class="actions">
                      <a ng-href="/<?php echo $singularVar; ?>/view/{{<?php echo $singularVar; ?>.id}}" class="btn btn-circle btn-icon-only blue ">
                      <i class="fa fa-eye"></i>
                      </a>
                      <a ng-href="/<?php echo $singularVar; ?>/edit/{{<?php echo $singularVar; ?>.id}}" class="btn btn-circle btn-icon-only yellow-casablanca " >
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