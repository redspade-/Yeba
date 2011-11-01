<?php

	/**
	 *	Exception.class.php
	 *
	 *	This file contains the base exception class specific for Loader package.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba.Loader
	 *	@author			Jerry Brillante
	 *	@contributor	Eric Bondoc	 
	 *	@since			23:17 PM Saturday, October 15, 2011
	 *
	 **/
	 
	 require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
	 
	 class Yeba_Loader_Exception
		extends Yeba_Exception
	{
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for empty class names.
		 */
		const EMPTY_CLASSNAME_EXCEPTION = 'Empty class name provided.';
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for non-string class names.
		 */
		const NOT_STRING_CLASSNAME_EXCEPTION = 'Class name provided is not a string.';
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for unavailable package separator character in class name.
		 */
		const SEPARATOR_NOT_FOUND_EXCEPTION = 'Package separator character not found within the class name.';
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for empty include path.
		 */
		const CLASS_PATHS_EMPTY_EXCEPTION = 'Empty include path provided.';
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for empty file extensions set.
		 */
		const FILE_EXTENSIONS_EMPTY_EXCEPTION = 'File extensions unavailable.';
		
	} // end class Yeba_Loader_Exception