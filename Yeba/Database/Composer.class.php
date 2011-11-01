<?php
	
	/**
	 *	Composer.class.php
	 *
	 *	This file contains the factory class that manages the database adapter to be used by the application.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba
	 *	@author			Jerry Brillante	 
	 *	@contributor	Eric Bondoc	 
	 *	@package		Yeba.Database
	 *	@since			06:05 AM Wednesday, November 02, 2011
	 *
	 **/
	
	require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Base.abstract.php' );
	
	class Yeba_Database_Composer
		extends Yeba_Base
	{
		
		/**
		 *	@access	public
		 *	@var	String	MySQL Database Constant
		 */
		const DB_MYSQL = 'MySQL';
		
		/**
		 *	@access	public
		 *	@var	String	MsSQL Database Constant
		 */
		const DB_MSSQL = 'MsSQL';
		
		/**
		 *	@access	public
		 *	@var	String	PostGreSQL Database Constant
		 */
		const DB_PGSQL = 'PostGreSQL';
		
		/**
		 *	@access	private
		 *	@var	String	Database adapter type.
		 */
		private static $_adapterType = NULL;
		
		/**
		 *	@access	private
		 *	@var	Array	List of available supported database types.
		 */
		private static $_adapterTypes = array(
												self::DB_MYSQL,
												self::DB_MSSQL,
												self::DB_PGSQL
											);
		
		/**
		 *	setAdapterType
		 *
		 *	Static mutator that sets the adapter type. Logically called before composition.
		 *		 
		 *	@static
		 *	@final
		 *	@access	public
		 *	@params	Mixed		The type of database adapter to be created.
		 */
		public static final function setAdapterType( $adapter = NULL )
		{
			
			if( NULL == $adapter ) {				
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Database_Exception( Yeba_Database_Exception::EMPTY_ADAPTER_TYPE );
			}
			
			if( self::isValidAdapter( $adapter ) ) {			
				self::$_adapterType = $adapter;
			} else {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Database_Exception( Yeba_Database_Exception::INVALID_ADAPTER_TYPE );
			}			
			
		} // end static member setAdapterType
		
		/**
		 *	getAdapterType
		 *
		 *	Static accessor that returns the adapter type.
		 *		 
		 *	@static
		 *	@final
		 *	@access	public
		 *	@params	Mixed		The type of database adapter set.
		 */
		public static final function getAdapterType()
		{
			
			return self::$_adapterType;
			
		} // end static member setAdapterType
		
		/**
		 *	compose
		 *
		 *	Returns the composed instance of the database adapter.
		 *		 
		 *	@static
		 *	@final
		 *	@access	public
		 *	@params	Mixed		The type of database adapter to be created.
		 *	@return	Mixed		Returns the instance of database adapter.
		 */
		public static final function compose( $type = NULL )
		{
			
			if( NULL == $type || empty( $type ) ) {				
				if( NULL == self::getAdapterType() ) {
					require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
					throw new Yeba_Database_Exception( Yeba_Database_Exception::EMPTY_ADAPTER_TYPE );
				}
			} else {
				self::setAdapterType( $type );
			}
			
			$adapterType = self::getAdapterType();
			$generate = false;
			
		} // end static member compose
		
		/**
		 *	isValidAdapter
		 *
		 *	Checks if the provided adapter type is available/supported. This is the interface on checking type adapter's availability.
		 *		 
		 *	@static
		 *	@final
		 *	@access	public
		 *	@params	Mixed		The type of database adapter to be verified.
		 *	@return	Boolean		Returns true if database adapter is valid, false otherwise.
		 *	@see	_isValidAdapter
		 */
		public static final function isValidAdapter( $adapter = NULL )
		{
			
			if( NULL == $adapter ) {
				return false;
			}
			
			return self::_isValidAdapter( $adapter );
			
		} // end static member isValidAdapter
		
		/**
		 *	_generateAdapter
		 *
		 *	Main processing member of the class responsible for generating the required adapter.
		 *		 
		 *	@static
		 *	@final
		 *	@access	private
		 *	@params	Mixed		The type of database adapter to be created.
		 *	@return	Mixed		Returns the instance of database adapter.
		 */
		private static function _generateAdapter( $type = NULL )
		{
				
		} // end static member _generateAdapter
		
		/**
		 *	_isValidAdapter
		 *
		 *	Checks if the provided adapter type is available/supported. This is the verifying member( mostly used by the interface isValidAdapter ).
		 *		 
		 *	@static
		 *	@final
		 *	@access	private
		 *	@params	Mixed		The type of database adapter to be verified.
		 *	@return	Boolean		Returns true if database adapter is valid, false otherwise.
		 *	@see	isValidAdapter, _resolveAdapterClass
		 */
		private static function _isValidAdapter( $adapter )
		{
			
			$adapterType = self::_resolveAdapterClass( $adapter );
			return in_array( $adapterType, self::$_adapterTypes );
			
		} // end static member _isValidAdapter
		
		/**
		 *	_resolveAdapterClass
		 *
		 *	Resolves the provided adapter class( from different types to string ) to verify availability.
		 *		 
		 *	@static
		 *	@final
		 *	@access	private
		 *	@params	Mixed		The type of database adapter to be verified.
		 *	@return	String		Returns the resolved database adapter type.
		 *	@see	_isValidAdapter
		 */
		private static function _resolveAdapterClass( $adapter )
		{
			
			if( is_string( $adapter ) ) {				
				return $adapter;
			}
			
			if( is_object( $adapter ) ) {
				// TODO
			}
			
		} // end static member _resolveAdapterClass
		 
		/**
		 *	Constructor
		 *
		 *	Default class constructor.
		 *	Set to private visibility - the only useful member for this class should be the static member autoLoad.
		 *
		 *	@access	private
		 */
		private function __construct()
		{
		
		} // end constructor
		
		/**
		 *	__clone
		 *
		 *	Override default class/object member cloning utility method. 
		 *
		 *	@access	private
		 */
		private function __clone()
		{
		
		} // end member __clone
		
		
		/**
		 *	Destructor
		 *
		 *	Default class destructor.
		 *
		 *	@access	public
		 */
		public function __destruct()
		{
			
		} // end destructor
		
	} // end class Yeba_Database_Composer