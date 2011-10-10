<?php
	
	/**
	 *	Serializable.interface.php
	 *
	 *	This file contains the interface definition for classes that should have serialization process.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba.Interface
	 *	@author			Jerry Brillante
	 *	@contributor	Eric Bondoc	 
	 *	@since			20:45 PM Monday, October 10, 2011
	 *
	 **/
	interface Yeba_Interface_Serializable
	{
		/**
		 *	serialize
		 *
		 *	This method should be implemented by the classes that needs serialization.
		 *		 
		 *	@access	public
		 *	@params	Mixed	The target element to be serialized; if not set, serializes the instance itself.
		 *	@see	serialize
		 *	@todo	Must be tested thoroughly to work against faulty Session handling( http://www.php.net/manual/en/language.oop5.serialization.php )
		 */
		public function serialize( $element = NULL );
		
		/**
		 *	deserialize
		 *
		 *	This method should be implemented by the classes that needs "unserialization".
		 *		 
		 *	@access	public
		 *	@params	String	The target element to be unserialized.
		 *	@see	unserialize
		 *	@todo	Must be tested thoroughly to work against faulty Session handling( http://www.php.net/manual/en/language.oop5.serialization.php )
		 */
		public function deserialize( $element = NULL );
		
	} // end interface Yeba_Interface_Serializable