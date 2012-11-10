<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Date helper
 *
 * @package    Vulture
 * @category   Helpers
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2011-2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_Date extends Kohana_Date {

	// Predefined date formats
	const FORMAT_DATE_TIME  = 'd.m.Y H:i';
	const FORMAT_DATE       = 'd.m.Y';
	const FORMAT_DATE_SHORT = 'd.m.';
	const FORMAT_TIME       = 'H:i';

	/**
	 * @var  string  Central timezone
	 */
	public static $central_timezone = 'UTC';
}
