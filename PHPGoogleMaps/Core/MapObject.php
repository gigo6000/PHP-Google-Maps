<?php

namespace PHPGoogleMaps\Core;

/**
 * Base class for some map objects
 * This helps separate critical functionality of an object from its options
 */

abstract class MapObject {

	/**
	 * Holds an array of options
	 * This is data that can be output to the page
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * Sets options and restricts the setting of variables that are marked as protected
	 *
	 * @param string $var
	 * @param mixed $val
	 * @return void
	 */
	public function __set( $var, $val ) {
		$this->options[$var] = $val;
	}

	/**
	 * Also used for setting options, some people prefer object::setVar() to object->var =
	 *
	 * @param string $method
	 * @param mixed $val
	 * @return void
	 */
	public function __call( $method, $val ) {
		if ( substr( $method, 0, 3 ) == 'set' ) {
			$this->options[strtolower( substr( $method, 3 ) )] = $val[0];
		}
	}

	/**
	 * Returns an object variable
	 *
	 * @param string $var
	 * @return mixed
	 */
	public function __get( $var ) {
		if ( property_exists( $this, $var ) ) {
			return $this->$var;
		}
		else {
			return $this->options[$var];
		}
	}

	/**
	 * Return an option
	 *
	 * @param string $option Option to return
	 * @return mixed
	 */
	public function getOption( $option ) {
		return isset( $this->options[$option] ) ? $this->options[$option] : false;
	}

	/**
	 * Return the options
	 *
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Remove an option
	 *
	 * @param string $option Option to remove
	 * @return void
	 */
	public function removeOption( $option ) {
		unset( $this->options[$option] );
	}

	/**
	 * Magic isset method
	 * If a protected property with the passed variable name exists it returns isset() of that property
	 * Otherwise it will return isset() of the option
	 *
	 * @return boolean
	 */
	public function __isset( $var ) {
		if ( property_exists( $this, $var ) ) {
			return isset( $this->$var );
		}
		else {
			return isset( $this->options[$var] );
		}
	}

}