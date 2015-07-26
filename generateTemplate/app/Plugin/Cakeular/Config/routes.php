<?php
/**
 * ... connect Cakeular RESTful URLs to JSON API.
 */
	$request_uri =strtok($_SERVER["REQUEST_URI"],'?');

	if(strpos($request_uri, 'api') === FALSE) {

		Router::connect('/:controller/*', array('action' => 'index'));
	}
	else {
		Router::connect('/api/:controller/*', array('action' => 'api'));
	}