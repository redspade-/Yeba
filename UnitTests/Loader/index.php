<?php
	
	set_include_path(
						get_include_path() . PATH_SEPARATOR .
						dirname( dirname( dirname( __FILE__ ) ) ) . PATH_SEPARATOR .
						dirname( dirname( __FILE__ ) )
					);
	
	require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'AutoLoader.class.php' );	
	
	$httpProtocol = isset( $_SERVER['HTTPS'] ) && !empty( $_SERVER['HTTPS'] ) && "on" == $_SERVER['HTTPS']
					?	'https://'
					:	'http://';
					
	$baseDomain = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'localhost';
	
	$requestURI = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	
	if( !empty( $requestURI ) ) {
		$requestURI = explode( '/', $requestURI );
		foreach( $requestURI as $item => $value ) {
			if( empty( $requestURI[ $item ] ) ) {
				unset( $requestURI[ $item ] );
			}
		}
		$requestURI = array_reverse( $requestURI );
		$excess = array_shift( $requestURI );		
		$requestURI = implode( '/', array_reverse( $requestURI ) ) . '/';
	}
	
	$baseURL = $httpProtocol . $baseDomain . '/' . $requestURI;	
	
	$classModule = "Loader";
	spl_autoload_extensions( '.abstract.php,.class.php,.interface.php' );	
	
	$registeredExtensions = explode( ',', spl_autoload_extensions() );
	
	spl_autoload_register( array( 'Yeba_Loader_AutoLoader', 'autoLoad' ) );
	
	$registeredAutoloadFunctions = spl_autoload_functions();
	
	require_once( 'views' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Main.template.yhtml' );