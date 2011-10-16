<?php

	set_include_path(
						get_include_path() . PATH_SEPARATOR .
						dirname( dirname( __FILE__ ) ) . PATH_SEPARATOR .
						dirname( __FILE__ )
					);
	
	$httpProtocol = isset( $_SERVER['HTTPS'] ) && !empty( $_SERVER['HTTPS'] ) && "on" == $_SERVER['HTTPS']
					?	'https://'
					:	'http://';
					
	$baseDomain = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'localhost';
	
	$requestURI = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	
	$baseURL = $httpProtocol . $baseDomain . $requestURI;
	
	$modules = array(
						'Loader Test' => 'Loader'
					);
					
	require_once( 'views' . DIRECTORY_SEPARATOR . 'Main.template.yhtml' );