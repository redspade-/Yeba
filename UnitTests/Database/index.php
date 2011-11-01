<?php
	
	error_reporting( E_ALL );
	
	set_include_path(
						get_include_path() . PATH_SEPARATOR .
						dirname( dirname( dirname( __FILE__ ) ) ) . PATH_SEPARATOR .
						dirname( dirname( __FILE__ ) )
					);
	
	require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Composer.class.php' );	
	
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
	
	$classModule = "Composer";	
	
	$testResult = array();
	
	/**
	 *	Validate MySQL.
	 */
	$testResult['MySQL'] = array();		
	try {
		Yeba_Database_Composer::setAdapterType( Yeba_Database_Composer::DB_MYSQL );	
		$testResult['MySQL']['setAdapterType'] = 'Adapter type set to MySQL.';
		try {
			Yeba_Database_Composer::compose();
			$testResult['MySQL']['composeWithoutParameter'] = 'Yeba_Database_Compose triggered without parameters.';
			try {
				$type = Yeba_Database_Composer::getAdapterType();
				$testResult['MySQL']['getAdapterType'] = 'Type provided is ' . $type;
			} catch( Exception $exception ) {
				echo $exception->getMessage(), '<br />';
			}		
		} catch( Exception $exception ) {
			echo $exception->getMessage(), '<br />';
		}		
		try {
			$type = Yeba_Database_Composer::compose( Yeba_Database_Composer::DB_MSSQL );
			$testResult['MySQL']['composeWithParameter'] = 'Yeba_Database_Compose triggered with parameter( MsSQL type )';
			try {
				$type = Yeba_Database_Composer::getAdapterType();
				$testResult['MySQL']['getAdapterTypeAfterCompose'] = 'Type provided is ' . $type;
			} catch( Exception $exception ) {
				echo $exception->getMessage(), '<br />';
			}		
		} catch( Exception $exception ) {
			echo $exception->getMessage(), '<br />';
		}		
	} catch( Exception $exception ) {
		echo $exception->getMessage(), '<br />';
	}		
	 
	require_once( 'views' . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Main.template.yhtml' );