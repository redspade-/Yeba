<?php

	/**
	 *	Exception.class.php
	 *
	 *	This file contains the base exception class specific for Database package.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba.Loader
	 *	@author			Jerry Brillante
	 *	@contributor	Eric Bondoc
	 *	@package		Yeba.Database
	 *	@since			06:13 AM Wednesday, November 02, 2011
	 *
	 **/
	 
	 require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
	 
	 class Yeba_Database_Exception
		extends Yeba_Exception
	{
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for empty/NULL database adapter type.
		 */
		const EMPTY_ADAPTER_TYPE = 'Empty adapter type provided.';
		
		/**
		 *
		 *	@access	public
		 *	@var	String	Exception message for invalid database adapter type.
		 */
		const INVALID_ADAPTER_TYPE = 'Invalid adapter type provided.';
		
	} // end class Yeba_Database_Exception