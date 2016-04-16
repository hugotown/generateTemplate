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
  <section ng-controller="<?= Inflector::humanize($pluralVar); ?>Ctrl" data-ng-init="findOne()">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-green-sharp">
              {{ 'View' | translate }}
            </div>
          </div>
          <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form name="<?= $singularVar; ?>Form" class="form-horizontal" role="form" >
              <div class="form-body">
                <?php $countIdx = 0; ?>
                <?php foreach ($fields as $key => $field)
                {
                    $fieldAlreadyPainted = false;
                    if($field !== "createdAt" && $field !== "updatedAt" && $field !== "createdBy" && $field !== "updatedBy" && $field !== "id" && $field !== "password"  )
                    {
                        if(!($schema[$field]['null'])) {
                          $required = 'required';
                        } else {
                          $required = '';
                        }
                            if(isset($associations['belongsTo']))
                            {
                                if(!empty($associations['belongsTo']))
                                {
                                    foreach ($associations['belongsTo'] as $alias => $details)
                                    {
                                        if($details['foreignKey'] == $field)
                                        {
                                            $fieldAlreadyPainted = true;
                                            $otherSingularVar = Inflector::variable($alias);
                                            $otherPluralHumanName = Inflector::humanize($details['controller']);
                                            $otherSingularHumanName = Inflector::singularize($otherPluralHumanName);
                                            $otherPluralVar = Inflector::variable($details['controller']);
                                            echo "\n";
                                            echo "<div class=\"row\">" . "\n";
                                            echo "    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">" . "\n";
                                            echo "      <div class=\"form-group\" ng-class=\"{ 'has-error' : submitted && ". $singularVar ."." . $field .".\$invalid }\">" . "\n";
                                            echo "          <label for=\"". $field ."\" class=\"col-md-4 control-label\">{{ '". $singularVar ."-". $otherSingularVar. "' | translate }}</label>" . "\n";
                                            echo "            <div class=\"col-md-8\">" . "\n";
                                            echo "              <input name=\"". $field. "\" readonly=\"readonly\" type=\"text\" class=\"form-control\" data-ng-model=\"". $singularVar. "." .$field . ".name\" id=\"". $field ."\" placeholder=\"{{ '". $singularVar . "-" . $field ."' | translate }}\" autocomplete=\"off\" " . $required ." >"  . "\n";
                                            echo "            </div>". "\n";
                                            echo "        </div>". "\n";
                                            echo "    </div>". "\n";
                                            echo "</div>". "\n";

                                        }
                                    }
                                }

                            }
                            if(!$fieldAlreadyPainted)
                            {
                                  if(strpos($field,'lov_') !== false){
                                    $fieldNameWLov = str_replace('lov_', '', $field);
                                    $upperFieldNameWLov = strtoupper($fieldNameWLov);
                                      echo "\n";
                                      echo "<div class=\"row\">". "\n";
                                      echo "    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">". "\n";
                                      echo "        <div class=\"form-group\" ng-class=\"{ 'has-error' : submitted && ". $singularVar."Form.". $field.".\$invalid }\">". "\n";
                                      echo "            <label for=\"". $field ."\" class=\"col-md-4 control-label\">{{ '" . $singularVar."-". $field."' | translate }}</label>". "\n";
                                      echo "            <div class=\"col-md-8\">". "\n";
                                      echo "                <span load-lovtype=\"". $upperFieldNameWLov."\" load-lovtype-value=\"{{" . $singularVar. "." . $field."}}\" ></span>". "\n";
                                      echo "            </div>". "\n";
                                      echo "        </div>". "\n";
                                      echo "    </div>". "\n";
                                      echo "</div>". "\n";
                                  } else{
                                      echo "\n";
                                      echo "<div class=\"row\">". "\n";
                                      echo "    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">". "\n";
                                      echo "        <div class=\"form-group\" ng-class=\"{ 'has-error' : submitted && " . $singularVar."Form.". $field.".\$invalid }\">". "\n";
                                      echo "            <label for=\"". $field."\" class=\"col-md-4 control-label\">{{ '". $singularVar ."-" . $field ."' | translate }}</label>". "\n";
                                      echo "            <div class=\"col-md-8\">". "\n";
                                      echo "                <input name=\"". $field."\" readonly=\"readonly\" type=\"text\" class=\"form-control\" data-ng-model=\"". $singularVar.".". $field."\" id=\"". $field ."\" placeholder=\"{{ '". $singularVar ."-". $field ."' | translate }}\" autocomplete=\"off\" ". $required ." >". "\n";
                                      echo "            </div>". "\n";
                                      echo "        </div>". "\n";
                                      echo "    </div>". "\n";
                                      echo "</div>". "\n";
                                }
                            }
                    $countIdx ++;
                    }
                } ?>

                <div class="form-actions">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <a acl-check="<?= $pluralVar; ?>Edit" href="/#/<?= $pluralVar; ?>/edit/{{<?= $singularVar; ?>.id}}" class="btn blue-madison ">{{ 'Edit' | translate }}</a>
                          <a href="javascript:;" ui-sref="<?= $pluralVar; ?>List" class="btn default ">{{ 'Back to <?= $pluralVar; ?> list' | translate }}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <tabset vertical="false" type="pills">
                <tab heading="{{'Object'|translate}}">
                    <div class="jumbotron">
                        <span>Related Object</span>
                    </div>
                </tab>
                <tab heading="{{'Object'|translate}}">
                    <div class="jumbotron">
                        <span>Related Object</span>
                    </div>
                </tab>
          </tabset>
        </div>
      </div>
  </section>

