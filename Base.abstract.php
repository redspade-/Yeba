<?php

	/**
	 *	Base.abstract.php
	 *
	 *	This file contains the abstract definition of the foundation of classes that will be built on top of this framework.
	 *	The hierarchy of classes that will soon be written should be inheriting this base class.
	 *
	 *	For class and file naming convention, please refer to the separate documentation related to this project.
	 *
	 *	@filesource
	 *	@package		Yeba
	 *	@author			Jerry Brillante
	 *	@contributor	Eric Bondoc	 
	 *	@since			20:36 PM Monday, October 10, 2011
	 *
	 **/
	 
	 require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Interface' . DIRECTORY_SEPARATOR . 'Serializable.interface.php' );	 
	 
	 abstract class Yeba_Base 
		implements Yeba_Interface_Serializable
	 {
		
		/**
		 *	getClass
		 *
		 *	Returns the resolved class of the object referenced to. Serves as the box method that wraps the get_class native PHP method.
		 *
		 *	@access	public
		 *	@return	String	The resolved class of the referenced entity.
		 *	@see	get_class
		 */
		public function getClass()
		{
			
			return get_class( $this );
			
		} // end member getClass
		
		/**
		 *	getClassName
		 *
		 *	Returns the resolved class of the object referenced to. Serves as the box method that wraps the get_class native PHP method.
		 *		 
		 *	@access	public
		 *	@alias	getClass
		 *	@return	String	The resolved class of the referenced entity.
		 *	@see	getClass
		 */
		public function getClassName()
		{
			
			return $this->getClass();
			
		} // end member getClassName
		
		/**
		 *	serialize
		 *
		 *	Returns the serialized conversion of the provided element.
		 *		 
		 *	@access	public
		 *	@params	Mixed	The target element to be serialized; if not set, serializes the instance itself.
		 *	@return	String	The serialized conversion of the target element.
		 *	@see	serialize
		 *	@todo	Must be tested thoroughly to work against faulty Session handling( http://www.php.net/manual/en/language.oop5.serialization.php )
		 */
		public function serialize( $element = NULL )
		{
			
			if( NULL == $element ) {
				return serialize( $this );
			}
			return serialize( $element );
			
		} // end member serialize
		
		/**
		 *	deserialize
		 *
		 *	Returns the "unserialized" conversion of the provided element.
		 *		 
		 *	@access	public
		 *	@params	String	The target element to be unserialized.
		 *	@return	Mixed	The unserialized conversion or somewhat the original form.
		 *	@see	unserialize, Yeba_Serialization_Exception
		 *	@todo	Must be tested thoroughly to work against faulty Session handling( http://www.php.net/manual/en/language.oop5.serialization.php )
		 */
		public function deserialize( $element = NULL )
		{			
			
			$result = unserialize( $element );
			if( false === $result ) {
				require_once( 'Yeba' . DIRECTORY_SEPARATOR . 'Serialization' . DIRECTORY_SEPARATOR . 'Exception.class.php' );
				throw new Yeba_Serialization_Exception( "Argument cannot be unserialized." );
			}
			return $result;
			
		} // end member deserialize
		
		/**
		 *	__toString
		 *
		 *	Overrides the virtual/magic __toString method; returns the resolved class name of the target instead.
		 *		 
		 *	@access	public
		 *	@return	String	The resolved class name of the object being referenced.
		 *	@see	unserialize, Yeba_Serialization_Exception
		 *	@todo	Either use the class name notation, or use the serialized version of this object<?>.
		 */
		public function __toString()
		{
			
			return $this->getClass();
			
		} // end member __toString
		
		/**
		 *	__toString
		 *
		 *	Overrides the virtual/magic __clone method; does nothing.
		 *		 
		 *	@access	public
		 *	@see	__clone
		 */
		private function __clone()
		{
		
		} // end member __clone		
		
	 } // end abstract clss Yeba_Base