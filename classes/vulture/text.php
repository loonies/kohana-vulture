<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Text helper class. Provides simple methods for working with text.
 *
 * @package    Vulture
 * @category   Helpers
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2011-2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_Text extends Kohana_Text {

	/**
	 * Replaces the whitespace characters (tabs, spaces, ...)
	 * with replacement from an input string
	 *
	 * @param   sting   Input string
	 * @param   string  Replacement string
	 * @return  string
	 */
	public static function clean_wsc($string, $replacement = ' ')
	{
		return (string) trim(preg_replace('/\s+/', $replacement, $string), $replacement);
	}
}
