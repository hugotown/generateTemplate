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
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<!-- Bootstrap -->
	<link href="/admplus/common/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	
	<!-- Bootstrap Extended -->
	<link href="/admplus/common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="/admplus/common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/admplus/common/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	
	<!-- Select2 
	<link rel="stylesheet" href="/admplus/common/theme/scripts/plugins/forms/select2/select2.css"/>-->
	
<link href="../../../assets/global/plugins/angularjs/plugins/ui-select/select.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/global/plugins/angularjs/plugins/ui-select/select2.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/angular-bootstrap-colorpicker/css/colorpicker.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/ui-iconpicker/dist/styles/ui-iconpicker.min.css" rel="stylesheet" type="text/css">
<link href="../../../assets/ng-scrolling-tabs/scrolling-tabs.css" rel="stylesheet" type="text/css">	
	<!-- Notyfy -->
	<link rel="stylesheet" href="/admplus/common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.css"/>
	<link rel="stylesheet" href="/admplus/common/theme/scripts/plugins/notifications/notyfy/themes/default.css"/>
	
	<!-- Gritter Notifications Plugin -->
	<link href="/admplus/common/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css" rel="stylesheet" />
	
	<!-- JQueryUI v1.9.2 -->
	<link rel="stylesheet" href="/admplus/common/theme/scripts/plugins/system/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css" />
	
		
	<!-- glyphicons -->
	<!-- <link rel="stylesheet" href="/admplus/common/theme/css/glyphicons.css" /> -->
	
	
	<!-- font awesome -->
	<!-- <link rel="stylesheet" href="/admplus/common/theme/css/font-awesome/css/font-awesome.min.css" /> -->
	<link href="../../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- Bootstrap Extended -->
	<link rel="stylesheet" href="/admplus/common/bootstrap/extend/bootstrap-select/bootstrap-select.css" />
	<!-- <link rel="stylesheet" href="/admplus/common/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" /> -->
	<link rel="stylesheet" href="/admplus/common/bootstrap/extend/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
	
	<!-- Uniform -->
	<link rel="stylesheet" media="screen" href="/admplus/common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" />
	
	<!-- google-code-prettify -->
	<link href="/admplus/common/theme/scripts/plugins/other/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />

	<!-- JQuery v1.8.2 -->
	<script src="/admplus/common/theme/scripts/plugins/system/jquery-1.8.2.min.js"></script>
	
	<!-- Modernizr -->
	<script src="/admplus/common/theme/scripts/plugins/system/modernizr.custom.76094.js"></script>
	
	<!-- MiniColors -->
	<link rel="stylesheet" media="screen" href="/admplus/common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css" />
	
	<!-- Theme -->
	<link rel="stylesheet" href="/admplus/common/theme/css/style.css?1382104445" />

	<!-- <link href="../../../assets/angular-material/angular-material.css" rel="stylesheet" type="text/css"/>-->
	
	<link href="../../../assets/angular-xeditable-0.1.8/css/xeditable.css" rel="stylesheet" type="text/css"/>
	<link href="../../../assets/angular-scrollable-table/scrollable-table.css" rel="stylesheet" type="text/css"/>	
	<link href="../../../assets/ng-tags-input/ng-tags-input.min.css" rel="stylesheet" type="text/css">
	<link href="../../../assets/ng-tags-input/ng-tags-input.bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../../../assets/ng-tags-input/ng-tags-input.css" rel="stylesheet" type="text/css">

	<!-- LESS 2 CSS -->
	<script src="/admplus/common/theme/scripts/plugins/system/less-1.3.3.min.js"></script>   
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
<link id="ng_load_plugins_before"/>
<!-- END DYMANICLY LOADED CSS FILES -->

<link rel="shortcut icon" href="favicon.ico"/>
<base href="/">
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
<body ng-controller="AppController">
	<!-- BEGIN PAGE SPINNER -->
	<div ng-spinner-bar class="page-spinner-bar">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
	<!-- END PAGE SPINNER -->
	<div data-ng-if="(isTokenPage())" data-ng-cloak="" class="no-print">
		<!-- BEGIN HEADER -->
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
		<!-- END FOOTER -->
				
	</div>	
	<div data-ng-if="(isSpecificPage() && !isTokenPage())" data-ng-cloak="" class="no-print">
		<div ui-view class="fade-in-up">
		</div> 
	</div>
	<div data-ng-if="(!isSpecificPage() && !isTokenPage())" data-ng-cloak="" class="no-print">
		<div class="first-container container fluid">
		<!-- BEGIN HEADER -->
		<div data-ng-include="'tpl/header-plus.html'" data-ng-controller="HeaderController">
		</div>
		<!-- END HEADER -->

		<!-- BEGIN WRAPPER -->
		<div id="wrapper">
			<!-- BEGIN SIDEBAR -->
			<div data-ng-include="'tpl/sidebar-plus.html'" data-ng-controller="SidebarController">			
			</div>
			<!-- END SIDEBAR -->
			<div id="content">
				<div ncy-breadcrumb></div>
				<div class="separator bottom"></div>
				<!-- BEGIN PAGE HEAD 
				<div data-ng-include="'tpl/page-head.html'" data-ng-controller="PageHeadController" class="page-head" style="float:right;">			
				</div>-->
				<!-- END PAGE HEAD!!! -->
				<!-- BEGIN ACTUAL CONTENT -->
				<div ui-view >
				</div> 
				<!-- END ACTUAL CONTENT -->
			</div>
		</div>
		<!-- END WRAPPER -->
		
		<!-- BEGIN FOOTER -->
		<div data-ng-include="'tpl/footer-plus.html'" data-ng-controller="FooterController" class="page-footer">
		</div>
		<!-- END FOOTER -->
		<div id="themer" class="collapse">
			<div class="wrapper">
				<span class="close2">&times; close</span>
				<h4>Themer <span>color options</span></h4>
				<ul>
					<li>Theme: <select id="themer-theme" class="pull-right"></select><div class="clearfix"></div></li>
					<li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" /><div class="clearfix"></div></li>
					<li>
						<span class="link" id="themer-custom-reset">reset theme</span>
						<span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
					</li>
				</ul>
				<div id="themer-getcode" class="hide">
					<hr class="separator" />
					<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
					<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		</div>
	</div>

	<ul id="notyfy_container_topRight" class="notyfy_container" style="width:50% !important;">
	</ul>

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- JQueryUI v1.9.2 -->
	<script src="/admplus/common/theme/scripts/plugins/system/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="/admplus/common/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- MiniColors -->
	<script src="/admplus/common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js"></script>
	
	<!-- Select2 
	<script src="/admplus/common/theme/scripts/plugins/forms/select2/select2.js"></script>-->
	
	<!-- jQuery Slim Scroll Plugin -->
	<script src="/admplus/common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js"></script>
	
	<!-- Global -->
	
	<script src="../../../assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/highcharts.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/highcharts-more.js" type="text/javascript"></script>
    <script src="../../../assets/highcharts/funnel.js" type="text/javascript"></script>

	<!-- Resize Script -->
	<!--<script src="/admplus/common/theme/scripts/plugins/other/jquery.ba-resize.js"></script>-->
	
	<!-- Uniform -->
	<script src="/admplus/common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script>
	
	<!-- Bootstrap Script -->
	<script src="/admplus/common/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Bootstrap Extended -->
	<script src="/admplus/common/bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<!-- <script src="/admplus/common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script> -->
	<script src="/admplus/common/bootstrap/extend/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
	<script src="/admplus/common/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="/admplus/common/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="/admplus/common/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="/admplus/common/bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<script src="/admplus/common/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="/admplus/common/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
	
	<!-- google-code-prettify -->
	<script src="/admplus/common/theme/scripts/plugins/other/google-code-prettify/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="/admplus/common/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js"></script>
	
	<!-- Notyfy -->
	<script type="text/javascript" src="/admplus/common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.js"></script>

	<!-- BEGIN CORE ANGULARJS PLUGINS -->
	<script src="../../../assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-resource.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-animate.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/angular-aria.min.js" type="text/javascript"></script>	
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
	<script src="../../../assets/angular-strap/angular-strap.tpl.js" type="text/javascript"></script>
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
   	<script src="../../../assets/ui-router-tabs/src/ui-router-tabs.js" type="text/javascript"></script>
    <script src="../../../assets/global/plugins/angularjs/plugins/ui-datetimepicker/datetimepicker.js" type="text/javascript"></script>
     <script src="../../../assets/global/plugins/angularjs/plugins/flow/ng-flow-standalone.js" type="text/javascript"></script>
    <script src="../../../assets/angular-modal-service/angular-modal-service.js" type="text/javascript"></script>
    <script src="../../../assets/ng-tags-input/ng-tags-input.min.js" type="text/javascript"></script>
    <script src="../../../assets/angular-drag-and-drop-lists/angular-drag-and-drop-lists.js" type="text/javascript"></script>
    <script src="../../../assets/angular-autoFields/autofields.min.js" type="text/javascript"></script>
    <script src="../../../assets/angular-autoFields/autofields-bootstrap.min.js" type="text/javascript"></script> 
    <script src="../../../assets/angular-scrollable-table/angular-scrollable-table.js" type="text/javascript"></script>    
	<script src="../../../assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
	<!--<script src="../../../assets/ui.js" type="text/javascript"></script>
	<script src="../../../assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.js" type="text/javascript"></script>-->
	<script src="../../../assets/global/plugins/angularjs/plugins/ui-select/select.min.js" type="text/javascript"></script>	
	<script src="../../../assets/angular-material/angular-material.min.js" type="text/javascript"></script>	
	<script src="../../../assets/angular-bootstrap-colorpicker/js/bootstrap-colorpicker-module.min.js" type="text/javascript"></script>	
	<script src="../../../assets/angular-bootstrap/ui-bootstrap.js" type="text/javascript"></script>
	<script src="../../../assets/angular-bootstrap/ui-bootstrap-tpls.js" type="text/javascript"></script>
	<script src="../../../assets/ui-iconpicker/dist/scripts/ui-iconpicker.min.js" type="text/javascript"></script>	
	<script src="../../../assets/ng-scrolling-tabs/scrolling-tabs.js" type="text/javascript"></script>	
	<!-- END CORE ANGULARJS PLUGINS -->

	<!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
	<script src="js/app-services.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
	<script src="js/directives.js" type="text/javascript"></script>
	<script src="js/ui-states/states.php" type="text/javascript"></script>
	<script src="js/favorites-custom.js" type="text/javascript"></script>
	<script src="js/settings.js" type="text/javascript"></script>	
	<!-- END APP LEVEL ANGULARJS SCRIPTS -->

	<!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
	<script src="/admplus/common/theme/scripts/demo/common.js?1382104445"></script>
	<script src="/admplus/common/theme/scripts/plugins/other/holder/holder.js"></script>
	<script>Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9})</script>
	
	<!-- Colors -->
	<script>
	var primaryColor = '#4a8bc2',
		dangerColor = '#b55151',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	var themerPrimaryColor = '#DA4C4C';
	</script>

	<script src="/admplus/common/theme/scripts/plugins/system/jquery.cookie.js"></script>
	<script src="/admplus/common/theme/scripts/demo/themer.js"></script>
	<script src="/admplus/common/theme/scripts/demo/layout.js"></script>
	
	<!-- END APP LEVEL JQUERY SCRIPTS -->

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