<?php
namespace singleton;

abstract class Singleton {

	/**
	 * An array of named instances
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * get a reference for a static instance storage
	 * @static
	 * @param string $name		Optional. The name of the instance.
	 * @return array&
	 */
	private static function &getRef($name = null) {
		$cn		= get_called_class();
		if (!isset(self::$instances[$cn])) {
			self::$instances[$cn]	= array();
		}

		$name	= $name ? $name : '_';
		if (!isset(self::$instances[$cn][$name])) {
			self::$instances[$cn][$name]	= null;
		}
		return self::$instances[$cn][$name];
	}

	/**
	 * Is an instance set?
	 * @static
	 * @param string $name		Optional.
	 * @return bool
	 */
	public static function hasInstance($name = null) {
		$cn		= get_called_class();
		$name	= $name ? $name : '_';
		return isset(self::$instances[$cn][$name]);
	}

	/**
	 * Singleton pattern
	 * @param string $name		Optional.
	 * @return mixed
	 */
	public static function getInstance($name = null) {
		if (self::hasInstance($name)) {
			return self::getRef($name);
		}
		return null;
	}

	/**
	 * @static
	 * @param Singleton $instance
	 * @param string $name			Optional. Set if you want to name this instance.
	 * @return void
	 */
	public static function setInstance(Singleton $instance, $name = null) {
		$ref = &self::getRef($name);
		$ref = $instance;
	}

	/**
	 * reset the instance to null
	 * @static
	 * @param string $name		Optional.
	 * @return void
	 */
	public static function clearInstance($name = null) {
		$cn		= get_called_class();
		$name	= $name ? $name : '_';
		unset(self::$instances[$cn][$name]);
	}

	/**
	 * @static
	 * @return array
	 */
	public static function getAllInstances() {
		$cn		= get_called_class();
		if (isset(self::$instances[$cn])) {
			return self::$instances[$cn];
		}
		return array();
	}

	/**
	 * Unset all instances
	 * @static
	 */
	public static function clearAllInstances() {
		$keysToClear = array();
		foreach (self::$instances as $className => $classInstances) {
			foreach ($classInstances as $instanceName => $instance) {
				if (!$instance instanceof GlobalSingleton) {
					$keysToClear[]	= $className;
				}
			}
		}

		foreach ($keysToClear as $key) {
			unset(self::$instances[$key]);
		}
	}
}
