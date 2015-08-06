<?php $pluralHumanName = Inflector::classify($pluralHumanName); ?>
<?php $singularHumanName = Inflector::classify($singularHumanName); ?>
<?php $pluralVar = strtolower($pluralVar); ?>
<?php $singularVar = strtolower($singularVar); ?>
<section data-ng-init="prepareData()" data-ng-controller="<?php echo Inflector::humanize($pluralVar); ?>Controller">
  <!-- BEGIN Portlet PORTLET-->
  <div class="portlet box blue-madison">
    <div class="portlet-title">
      <div class="caption">
        <i class="fa fa-gift"></i>{{ '<?php echo Inflector::humanize($pluralVar); ?>' | translate }}
      </div>
      <div class="actions">
        <a ui-sref="<?php echo strtolower($pluralVar);?>Create" class="btn btn-sm green-haze">
          <i class="fa fa-plus"></i>&nbsp;{{'Add' | translate}}
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
                      <!-- <a ui-sref="<?php echo $singularVar; ?>View({<?php echo $singularVar; ?>Id: '<?php echo $singularVar; ?>.id'})" class="btn btn-xs btn-circle btn-block blue ">
                      <i class="fa fa-eye"></i>
                      </a>
                      <a ui-sref="<?php echo $singularVar; ?>Edit({<?php echo $singularVar; ?>Id: '<?php echo $singularVar; ?>.id'})" class="btn btn-xs btn-circle btn-block yellow-casablanca " >
                      <i class="fa fa-pencil"></i>
                    </a> -->
                    <a href="/#/users/view/{{<?php echo $singularVar; ?>.id}}" class="btn btn-xs btn-circle btn-block blue ">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="/#/users/edit/{{<?php echo $singularVar; ?>.id}}" class="btn btn-xs btn-circle btn-block yellow-casablanca " >
                      <i class="fa fa-pencil"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- END Portlet PORTLET-->
</section>