<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Security helper class
 *
 * @package    Vulture
 * @category   Security
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2011-2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_Security extends Kohana_Security {

	/**
	 * Checks if CSRF token is valid
	 *
	 * This is a shortcut combination of Valid::not_empty and Security::check rules
	 *
	 *     // Set CSRF validation rule
	 *     Validation::factory($array)->rule('csrf', 'Security::csrf');
	 *
	 * @uses    Valid::not_empty
	 * @uses    Security::check
	 *
	 * @param   string  CSRF token
	 * @return  bool
	 */
	public static function csrf($token)
	{
		return Valid::not_empty($token) AND Security::check($token);
	}
}
