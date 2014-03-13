<?php
/**
 * @author Ahmed Magdy <a.magdy@a1works.com>
 * This class should be the parent class of any Enum
 */
class Enum {
	protected $name = NULL;		// String: The key of an Enum item
	protected $value = NULL;	// Mixed: The value of an Enum item
	
	/**
	 * Returns the name (key) of an Enum item as a string
	 * @return String
	 */		
	public function getName(){
		return $this->name;
	}
	
	/**
	 * Returns the value of an Enum item
	 * @return mixed
	 */		
	public function getValue(){
		return $this->value;
	}
	
	/**
	 * Returns a string representation of the enum item which is its name
	 */
	public function __toString()
    {
        return $this->name;
    }

	/**
	 * This class cannot not be instantiated using the new keyword from code outside the class 
	 */
	private function __construct($name, $val=NULL){
		$this->name = $name;
		$this->value = $val;
	}
	
	private static function is_valid_var_name($str){
		return preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $str);
	}
	
	protected static $is_initialized = false;
	protected static $enum_items = array();	// the enum items array of key names and enum item values as Enum class instances
	protected static $arr_params = array();	// the enum items keys and their original values
	
	/**
	 * Initializes the enum and it is called only once
	 */
	protected static function initialize(){
		$cls_name = get_called_class();
		if ($cls_name::$is_initialized) return true; 
		$ref_cls = new ReflectionClass($cls_name);
		if (empty($cls_name::$arr_params)) { 
			$cls_name::$arr_params = $ref_cls->getConstants();
		}
		$arr = $cls_name::$arr_params;
		foreach ($arr as $k => $v) {
			$cls_name::$enum_items[$k] = new $cls_name($k, $v);
		}
		$cls_name::$is_initialized = true;
		return true;
	}
	
	/**
	 * This is a PHP magic function called whenever we want to access an enum item 
	 * so it checks the enum item in an internal array and returns it
	 * @param $method_name String: is the enum item key name
	 * @param $arguments Null in our case here
	 * @return enum item of the same type as the current class or trigger_error if 
	 * this enum item is not found
	 */
	public static function __callStatic($method_name, $arguments){
		$cls_name = get_called_class();
		$cls_name::initialize();
		if (!in_array($method_name, array_keys($cls_name::$enum_items))) {
			return trigger_error("Invalid Enum $cls_name::$method_name", E_USER_ERROR);
		} else {
			return $cls_name::$enum_items[$method_name];
		}
	}
	
	/**
	 * Set the keys and values of the Enum items
	 * @param $arr_keys array(String => mixed) or array(String)
	 */
	public static function setKeys($arr_keys) {
		if (is_array($arr_keys)) {
			$enum_class_name = get_called_class();
			foreach ($arr_keys as $k => $v) {
				if (Enum::is_valid_var_name($k)) {
					$enum_class_name::$arr_params[$k] = $v;
				} else {
					if (Enum::is_valid_var_name($v)) {
						$enum_class_name::$arr_params[$v] = NULL;
					} else {
						return trigger_error("Invalid Enum key $enum_class_name::$v", E_USER_ERROR);
					}
				} 
			}	
		}
	}
	
	/**
	 * Returns all the keys and values
	 */
	public static function getKeys(){
		$enum_class_name = get_called_class();
		$enum_class_name::initialize();
		return $enum_class_name::$enum_items;
	}
	
}


/**
 * Utility function to create an Enum
 * @param $enum_class_name String the name of the class of the enum item it must follow the class naming standard
 * @param $keys array(String => mixed) or array(String) the keys and values of the enum items the keys must follow the variable naming standard and the values are mixed.
 * @see Enum
 */ 
function enum($enum_class_name, array $keys){
	if (!preg_match('/^[A-Z][a-zA-Z0-9_]*$/', $enum_class_name)) {
		return trigger_error("$enum_class_name is not a valid Enum name. Enum name must start with a capital letter and must follow the class naming standards.");
	}
	$str = "class $enum_class_name extends Enum {}";
	eval($str);
	$enum_class_name::setKeys($keys);
}
