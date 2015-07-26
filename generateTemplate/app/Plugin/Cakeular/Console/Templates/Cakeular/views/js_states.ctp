ObelitCRMApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
	$stateProvider.state("<?php echo strtolower($pluralVar);?>", {
	    url: "/<?php echo strtolower($pluralVar);?>",
	    templateUrl: "view/<?php echo strtolower($pluralVar);?>/index.html",
	    data: {pageTitle: '<?php echo $pluralHumanName; ?>', 
	    	pageSubTitle: '',
	    	tabPage: '/view/<?php echo $pluralVar ;?>/list.html'
	    }, 
	    resolve: {
	    deps: ['$ocLazyLoad', function($ocLazyLoad) {
	        return $ocLazyLoad.load([{
	            name: 'ObelitCRMApp',
	            insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
	            files: [
	                'js/<?php echo strtolower($pluralVar);?>.js',
<?php if (empty($associations['hasMany'])):?>
<?php $associations['hasMany'] = array();?>
<?php endif; ?>
<?php if (empty($associations['hasAndBelongsToMany'])):?>
<?php $associations['hasAndBelongsToMany'] = array();?>
<?php endif;?>
<?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);?>
<?php if (!(empty($relations))):?>
<?php foreach ($relations as $alias => $details):?>
<?php $otherSingularVar = strtolower(Inflector::variable($alias));?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']);?>
<?php $otherPluralVar = strtolower(Inflector::variable($details['controller']));?>
<?php if(array_key_exists($alias, $associations['hasAndBelongsToMany'])):?>
<?php $otherPluralVar = $pluralVar . strtolower(Inflector::variable($details['controller']));?>
<?php endif;?>
					'js/<?php echo strtolower($otherPluralVar);?>.js',
<?php endforeach;?>
<?php endif;?> 
	            ]                    
	        }]);
	    }] 
	    }         
	}); 
    $stateProvider.state("<?php echo strtolower($pluralVar);?>.list", {
        url: "/list",
        templateUrl: '',
	    data: {pageTitle: '<?php echo $pluralHumanName; ?>', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/<?php echo $pluralVar ;?>/list.html' },
        }	    
    });	

    $stateProvider.state("<?php echo strtolower($pluralVar);?>.add", {
        url: "/add",
        templateUrl: '',
	    data: {pageTitle: '<?php echo $pluralHumanName; ?>', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/<?php echo $pluralVar ;?>/add.html' },
        }
    });    

    $stateProvider.state("<?php echo strtolower($pluralVar);?>.edit", {
        url: "/edit/:id",
        templateUrl: '',
	    data: {pageTitle: '<?php echo $pluralHumanName; ?>', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            '': { templateUrl: '/view/<?php echo $pluralVar ;?>/edit.html' },
        }
    });

<?php if (empty($associations['hasMany'])): ?>
<?php $associations['hasMany'] = array(); ?>
<?php endif; ?>
<?php if (empty($associations['hasAndBelongsToMany'])): ?>
<?php $associations['hasAndBelongsToMany'] = array(); ?>
<?php endif; ?>

<?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']); ?>
<?php if (!(empty($relations))): ?>	
<?php foreach ($relations as $alias => $details): ?>
<?php $otherSingularVar = strtolower(Inflector::variable($alias)); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
<?php $otherPluralVar = strtolower(Inflector::variable($details['controller'])); ?>
<?php if(array_key_exists($alias, $associations['hasAndBelongsToMany'])): ?>
<?php $otherPluralVar = $pluralVar . strtolower(Inflector::variable($details['controller'])); ?>
<?php endif; ?>	
    $stateProvider.state("<?php echo strtolower($pluralVar);?>.edit.<?php echo $otherPluralVar; ?>", {
        url: "/<?php echo $otherPluralVar; ?>",
        templateUrl: '',
	    data: {pageTitle: '<?php echo $pluralHumanName; ?>', 
	    	pageSubTitle: '',
	    },
        views: {
            // the child views will be defined here (absolutely named)
            'editTab': { templateUrl: '/view/<?php echo $otherPluralVar; ?>/list.html' },
        }
    }); 
<?php endforeach; ?>
<?php endif; ?>	

   

}]);