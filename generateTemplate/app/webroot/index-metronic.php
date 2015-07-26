<?php

$request_uri =strtok($_SERVER["REQUEST_URI"],'?');

//echo "here:" . $request_uri;
//echo strpos($request_uri, 'api');
//die;

if(strpos($request_uri, 'api') === FALSE){//if($subdomain != "api") {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="ObelitCRMApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="ObelitCRMApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" data-ng-app="ObelitCRMApp">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<title data-ng-bind="'ObelitCRM {{appVersion}} | ' + $state.current.data.pageTitle"></title>

<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/angular-xeditable-0.1.8/css/xeditable.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/trNgGrid/trNgGrid.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/angular-material/angular-material.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/angular-scrollable-table/scrollable-table.css" rel="stylesheet" type="text/css"/>    
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="../../../assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../../assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/angular-strap/bootstrap-additions.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/angular-strap/angular-motion.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/angularjs/plugins/ui-select/select.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/global/plugins/angularjs/plugins/ui-select/select2.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/global/plugins/angularjs/plugins/ui-datetimepicker/datetimepicker.css" rel="stylesheet" type="text/css">
<link href="../../../assets/ng-tags-input/ng-tags-input.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/ng-tags-input/ng-tags-input.bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->

<!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
<link id="ng_load_plugins_before"/>
<!-- END DYMANICLY LOADED CSS FILES -->

<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body ng-controller="AppController" 
	class="{{(isSpecificPage() ? 'login':'page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo page-on-load' )}}"
	ng-class="{'page-sidebar-closed': settings.layout.pageSidebarClosed}">
	<!-- BEGIN PAGE SPINNER -->
	<div ng-spinner-bar class="page-spinner-bar">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
	<!-- END PAGE SPINNER -->
	<div data-ng-if="(isTokenPage())" data-ng-cloak="" class="no-print">
		<!-- BEGIN HEADER -->
		<div data-ng-include="'tpl/public-header.html'" data-ng-controller="HeaderController" class="page-header navbar navbar-fixed-top">
		</div>
		<!-- END HEADER -->

		<div class="clearfix">
		</div>
		<div class="page-container" >
			<div class="col-md-12">
				<div ui-view>
				</div> 
			</div>
		</div>
		<!-- BEGIN FOOTER -->
		<div data-ng-include="'tpl/footer.html'" data-ng-controller="FooterController" class="page-footer">
		</div>
		<!-- END FOOTER -->
				
	</div>	
	<div data-ng-if="(isSpecificPage() && !isTokenPage())" data-ng-cloak="" class="no-print">
		<div ui-view class="fade-in-up">
		</div> 
	</div>
	<div data-ng-if="(!isSpecificPage() && !isTokenPage())" data-ng-cloak="" class="no-print">
		<!-- BEGIN HEADER -->
		<div data-ng-include="'tpl/header.html'" data-ng-controller="HeaderController" class="page-header navbar navbar-fixed-top">
		</div>
		<!-- END HEADER -->

		<div class="clearfix">
		</div>

		<!-- BEGIN CONTAINER -->
		<div class="page-container" >
			<!-- BEGIN SIDEBAR -->
			<div data-ng-include="'tpl/sidebar.html'" data-ng-controller="SidebarController" class="page-sidebar-wrapper">			
			</div>
			<!-- END SIDEBAR -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEAD -->
					<div data-ng-include="'tpl/page-head.html'" data-ng-controller="PageHeadController" class="page-head" style="float:right;">			
					</div>
					<!-- END PAGE HEAD!!! -->
					<!-- BEGIN ACTUAL CONTENT -->
					<div ui-view >
					</div> 
					<!-- END ACTUAL CONTENT -->
				</div>
			</div>
		</div>
		<!-- END CONTAINER -->
		
		<!-- BEGIN FOOTER -->
		<div data-ng-include="'tpl/footer.html'" data-ng-controller="FooterController" class="page-footer">
		</div>
		<!-- END FOOTER -->
	</div>

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE JQUERY PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../../assets/global/plugins/respond.min.js"></script>
	<script src="../../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="../../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/highcharts.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/highcharts-more.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/funnel.js" type="text/javascript"></script>

	<!-- END CORE JQUERY PLUGINS -->

	<!-- BEGIN CORE ANGULARJS PLUGINS -->
	<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>-->
	<script src="../../../assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-resource.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-animate.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-aria.min.js" type="text/javascript"></script>	
	<script src="../../../assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-xeditable-0.1.8/js/xeditable.js" type="text/javascript"></script>
	<script src="../../../assets/ng-tasty-tpls.js" type="text/javascript"></script>
	<script src="../../../assets/angular-dragdrop/angular-dragdrop.js" type="text/javascript"></script>
	<script src="../../../assets/angular-strap/angular-strap.js" type="text/javascript"></script>
	<script src="../../../assets/angular-strap/angular-strap.tpl.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-strap/modules/parse-options.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-breadcrumb/angular-breadcrumb.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-translate/angular-translate.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-translate-loader-url/angular-translate-loader-url.min.js" type="text/javascript"></script>
	<script src="../../../assets/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js" type="text/javascript"></script>    
    <script type="text/javascript" src="./../../assets/ct-ui-router-extras/modular/ct-ui-router-extras.core.js"></script>
    <script type="text/javascript" src="./../../assets/ct-ui-router-extras/modular/ct-ui-router-extras.statevis.js"></script>
    <script type="text/javascript" src="./../../assets/ct-ui-router-extras/modular/ct-ui-router-extras.previous.js"></script>
    <script type="text/javascript" src="./../../assets/ct-ui-router-extras/modular/ct-ui-router-extras.transition.js"></script>
    <script type="text/javascript" src="./../../assets/ct-ui-router-extras/modular/ct-ui-router-extras.sticky.js"></script>
    <script type="text/javascript" src="./../../assets/angular-base64/angular-base64.min.js"></script>
    <script src="../../../assets/global/plugins/angularjs/plugins/ui-datetimepicker/datetimepicker.js" type="text/javascript"></script>
     <script src="../../../assets/global/plugins/angularjs/plugins/flow/ng-flow-standalone.js" type="text/javascript"></script>
    <script src="../../../assets/angular-modal-service/angular-modal-service.js" type="text/javascript"></script>
    <script src="../../../assets/ng-tags-input/ng-tags-input.min.js" type="text/javascript"></script>
    <script src="../../../assets/angular-drag-and-drop-lists/angular-drag-and-drop-lists.js" type="text/javascript"></script>
    <script src="../../../assets/angular-autoFields/autofields.min.js" type="text/javascript"></script>
    <script src="../../../assets/angular-autoFields/autofields-bootstrap.min.js" type="text/javascript"></script> 
    <script src="../../../assets/angular-scrollable-table/angular-scrollable-table.js" type="text/javascript"></script>      
	<!-- END CORE ANGULARJS PLUGINS -->
	
	<!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
	<script src="../../../assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.js" type="text/javascript"></script>
	<!--<script src="../../../assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script> !-->
	<!--<script src="../../../assets/ui.js" type="text/javascript"></script>!-->
	<script src="../../../assets/global/plugins/angularjs/plugins/ui-select/select.min.js" type="text/javascript"></script>	
	<script src="../../../assets/angular-material/angular-material.min.js" type="text/javascript"></script>
	<script src="js/services.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
	<script src="js/directives.js" type="text/javascript"></script>
	<script src="js/ui-states/states.php" type="text/javascript"></script>

	<script src="js/favorites-custom.js" type="text/javascript"></script>

	<!-- END APP LEVEL ANGULARJS SCRIPTS -->

	<!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
	<script src="../../../assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="../../../assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
	<script src="../../../assets/admin/layout4/scripts/demo.js" type="text/javascript"></script> 
	<!-- END APP LEVEL JQUERY SCRIPTS -->

	<script type="text/javascript">
		/* Init Metronic's core jquery plugins and layout scripts */
		$(document).ready(function() {   
			Metronic.init(); // Run metronic theme
			Metronic.setAssetsPath('../../../assets/'); // Set the assets folder path			
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php
} else {
/**
 * Index
 *
 * The Front Controller for handling every request
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.webroot
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

/**
 * These defines should only be edited if you have CakePHP installed in
 * a directory layout other than the way it is distributed.
 * When using custom settings be sure to use the DS and do not add a trailing DS.
 */

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
if (!defined('ROOT')) {
	define('ROOT', dirname(dirname(dirname(__FILE__))));
}

/**
 * The actual directory name for the "app".
 *
 */
if (!defined('APP_DIR')) {
	define('APP_DIR', basename(dirname(dirname(__FILE__))));
}

/**
 * The absolute path to the "cake" directory, WITHOUT a trailing DS.
 *
 * Un-comment this line to specify a fixed path to CakePHP.
 * This should point at the directory containing `Cake`.
 *
 * For ease of development CakePHP uses PHP's include_path. If you
 * cannot modify your include_path set this value.
 *
 * Leaving this constant undefined will result in it being defined in Cake/bootstrap.php
 *
 * The following line differs from its sibling
 * /lib/Cake/Console/Templates/skel/webroot/index.php
 */
//define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib');

/**
 * This auto-detects CakePHP as a composer installed library.
 * You may remove this if you are not planning to use composer (not recommended, though).
 */
$vendorPath = ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'cakephp' . DS . 'cakephp' . DS . 'lib';
$dispatcher = 'Cake' . DS . 'Console' . DS . 'ShellDispatcher.php';
if (!defined('CAKE_CORE_INCLUDE_PATH') && file_exists($vendorPath . DS . $dispatcher)) {
	define('CAKE_CORE_INCLUDE_PATH', $vendorPath);
}

/**
 * Editing below this line should NOT be necessary.
 * Change at your own risk.
 *
 */
if (!defined('WEBROOT_DIR')) {
	define('WEBROOT_DIR', basename(dirname(__FILE__)));
}
if (!defined('WWW_ROOT')) {
	define('WWW_ROOT', dirname(__FILE__) . DS);
}

// for built-in server
if (php_sapi_name() === 'cli-server') {
	if ($_SERVER['REQUEST_URI'] !== '/' && file_exists(WWW_ROOT . $_SERVER['PHP_SELF'])) {
		return false;
	}
	$_SERVER['PHP_SELF'] = '/' . basename(__FILE__);
}

if (!defined('CAKE_CORE_INCLUDE_PATH')) {
	if (function_exists('ini_set')) {
		ini_set('include_path', ROOT . DS . 'lib' . PATH_SEPARATOR . ini_get('include_path'));
	}
	if (!include 'Cake' . DS . 'bootstrap.php') {
		$failed = true;
	}
} else {
	if (!include CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'bootstrap.php') {
		$failed = true;
	}
}
if (!empty($failed)) {
	trigger_error("CakePHP core could not be found. Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php. It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
}

App::uses('Dispatcher', 'Routing');

$Dispatcher = new Dispatcher();
$Dispatcher->dispatch(
	new CakeRequest(),
	new CakeResponse()
);	
}


?>