<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Array helper
 *
 * @package    Vulture
 * @category   Helpers
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2011-2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_Arr extends Kohana_Arr {

	/**
	 * Retrieve a single key from an array or an object
	 * implementing ArrayAccess. If the key does not exist
	 * in the array or object, the default value will be returned instead.
	 *
	 * [!!] Ported from Kohana 3.3
	 *
	 *     // Get the value "username" from $_POST, if it exists
	 *     $username = Arr::get($_POST, 'username');
	 *
	 *     // Get the value "sorting" from $_GET, if it exists
	 *     $sorting = Arr::get($_GET, 'sorting');
	 *
	 *     // Get the value "orange" from an object implementing ArrayAccess
	 *     $fruits = new Fruits(array('apple' => new Apple, 'orange' => new Orange));
	 *     $fruit = Arr::get($fruits, 'orange');
	 *
	 * @author  Kohana Team
	 * @link    http://dev.kohanaframework.org/issues/4012
	 * @link    http://dev.kohanaframework.org/issues/4564
	 *
	 * @param   array   Array or object implementing ArrayAccess
	 * @param   string  Key name
	 * @param   mixed   Default value
	 * @return  mixed
	 */
	public static function get($array, $key, $default = NULL)
	{
		if (isset($array[$key])
			OR array_key_exists($key, $array)
			OR ($array instanceof ArrayAccess AND $array->offsetExists($key)))
		{
			return $array[$key];
		}
		else
		{
			return $default;
		}
	}

	/**
	 * Rotates a 2D array clockwise.
	 * For example, turns a 2x3 array into a 3x2 array.
	 *
	 * [!!] Ported from Kohana 2.4
	 *
	 *     // Upload multiple files
	 *     foreach(Arr::rotate($_FILES['images']) as $image)
	 *     {
	 *         Upload::save($image);
	 *     }
	 *
	 * @author  Kohana Team
	 * @link    http://dev.kohanaframework.org/issues/4262
	 *
	 * @param   array    Array to rotate
	 * @param   boolean  Keep the keys in the final rotated array.
	 *                   The sub arrays of the source array need to have the same key values.
	 *                   If your subkeys might not match, you need to pass FALSE here!
	 * @return  array
	 */
	public static function rotate($array, $keep_keys = TRUE)
	{
		$rotated = array();

		foreach ($array as $key => $value)
		{
			$value = ($keep_keys === TRUE) ? $value : array_values($value);

			foreach ($value as $k => $v)
			{
				$rotated[$k][$key] = $v;
			}
		}

		return $rotated;
	}
}
