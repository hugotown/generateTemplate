<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
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
            <table datatable="ng" dt-options="dtOptions" dt-column-defs="dtColumnDefs" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <?php foreach ($fields as $field)
                    {
                      if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                      {
                        ?>
                  <th>
                    {{ <?php echo $field; ?> | translate  }}
                  </th>
                  <?php 
                    }
                    }?>
                    <th>{{ 'Actions' | translate }}</th>
                  </tr>
              </thead>
              <tbody>
                <tr ng-repeat="<?php echo $singularVar; ?> in <?php echo $pluralVar; ?>">
                  <?php foreach ($fields as $field)
                    {
                      if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id"  )
                      {
                        ?>
                  <td>
                    {{ ( <?php echo $singularVar; ?>.<?php echo $field; ?> || '...' ) | translate  }}
                  </td>
                  <?php 
                    }
                    }?>
                  <td>
                    <div class="actions">
                      <a ui-sref="<?php echo $singularVar; ?>View({<?php echo $singularVar; ?>Id: '<?php echo $singularVar; ?>.id'})" class="btn btn-xs btn-circle btn-block blue ">
                      <i class="fa fa-eye"></i>
                      </a>
                      <a ui-sref="<?php echo $singularVar; ?>Edit({<?php echo $singularVar; ?>Id: '<?php echo $singularVar; ?>.id'})" class="btn btn-xs btn-circle btn-block yellow-casablanca " >
                      <i class="fa fa-pencil"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group form-md-line-input has-info form-md-floating-label">
          <div class="input-group">
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
    </div>
  </div>
  <!-- END Portlet PORTLET-->
</section>