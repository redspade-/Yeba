<?php

	/**
	 *	AutoLoader.class.php
	 *
	 *	This file contains the autoloading wrapper class for smooth inclusion of necessary class files.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba
	 *	@author			Jerry Brillante
	 *	@contributor	Eric Bondoc	 
	 *	@since			15:11 PM Saturday, October 15, 2011
	 *
	 **/
	 
	 require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Base.abstract.php' );
	 require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Interface' . DIRECTORY_SEPARATOR . 'Constants' . DIRECTORY_SEPARATOR . 'Package.interface.php' );
	 
	 class Yeba_Loader_AutoLoader
		extends Yeba_Base
			implements Yeba_Interface_Contants_Package
	 {
		
		/**
		 *	autoLoad
		 *
		 *	Returns the resolved class file for inclusion.
		 *		 
		 *	@static
		 *	@access	public
		 *	@params	Mixed		The target class to identify and load( if possible ).
		 *	@return	Boolean		Returns the result of file inclusion.
		 *	@see	_resumeAutoLoad
		 */
		public static function autoLoad( $className = "" )
		{
			/**
			 *	Principle of least privilege:
			 *	If the parameter class name is empty, bail out and throw an exception.
			 */
			if( empty( $className ) ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Loader_Exception( Yeba_Loader_Exception::EMPTY_CLASSNAME_EXCEPTION );
			}
			
			/**
			 *	Principle of least privilege:
			 *	If the parameter class name is not a string, bail out and throw an exception.
			 */			 
			if( !is_string( $className ) ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Loader_Exception( Yeba_Loader_Exception::NOT_STRING_CLASSNAME_EXCEPTION );
			}
			
			return self::_resumeAutoLoad( $className );
			
		} // end static member autoLoad
		
		/**
		 *	_resumeAutoLoad
		 *
		 *	Main processing member on auto-loading class files. Sanitizes and eventually attempts to load the resolved class file
		 *	via the provided class name.
		 *		 
		 *	@static
		 *	@access	public
		 *	@params	Mixed		The target class to identify and load( if possible ).
		 *	@return	Boolean		Returns the result of file inclusion.
		 *	@see	autoLoad
		 */
		private static function _resumeAutoLoad( $class )
		{
		
			/**
			 *	Principle of least privilege:
			 *	If the parameter class name does not have the package separator, bail out and throw an exception.
			 */			 
			if( false === strpos( $class, Yeba_Interface_Contants_Package::CLASS_FILE_SEPARATOR ) ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Loader_Exception( Yeba_Loader_Exception::SEPARATOR_NOT_FOUND_EXCEPTION );
			}
			
			$paths = explode( PATH_SEPARATOR, get_include_path() );
			$extensions = explode( Yeba_Interface_Contants_Package::SPL_EXTENSION_SEPARATOR, spl_autoload_extensions() );
			$className = str_replace( Yeba_Interface_Contants_Package::CLASS_FILE_SEPARATOR, DIRECTORY_SEPARATOR, $class );
			
			if( empty( $paths  ) ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Loader_Exception( Yeba_Loader_Exception::CLASS_PATHS_EMPTY_EXCEPTION );
			}
			
			if( empty( $extensions  ) ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Loader' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Loader_Exception( Yeba_Loader_Exception::FILE_EXTENSIONS_EMPTY_EXCEPTION );
			}
			
			foreach( $paths as $path ) {
				foreach( $extensions as $extension ) {
					$classFile = $path . DIRECTORY_SEPARATOR . $className . DIRECTORY_SEPARATOR . $extension;
					if( file_exists( $classFile ) ) {
						return require_once( $classFile );
					}					
				}
			}
			
		} // end static member _resumeAutoLoad
		
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
		
	 } // end class Yeba_Loader_AutoLoader