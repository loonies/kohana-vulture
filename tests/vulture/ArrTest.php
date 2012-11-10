<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Arr test
 *
 * @group  vulture
 * @group  vulture.helpers
 *
 * @package    Vulture
 * @category   Tests
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_ArrTest extends PHPUnit_Framework_TestCase {

	/**
	 * Provider for [test_get]
	 *
	 * @return  array
	 */
	public function provider_get()
	{
		return array(
			array(array('uno', 'dos', 'tress'), 1, NULL, 'dos'),
			array(array('we' => 'can', 'make' => 'change'), 'we', NULL, 'can'),
			array(array('we' => 'can', 'make' => NULL), 'make', 'change', NULL),

			array(array('uno', 'dos', 'tress'), 10, NULL, NULL),
			array(array('we' => 'can', 'make' => 'change'), 'he', NULL, NULL),
			array(array('we' => 'can', 'make' => 'change'), 'he', 'who', 'who'),
			array(array('we' => 'can', 'make' => 'change'), 'he', array('arrays'), array('arrays')),
		);
	}

	/**
	 * Provider for [test_rotate]
	 *
	 * @return  array
	 */
	public function provider_rotate()
	{
		return array(
			// #0
			array(
				array(
					'name' => array('bicycle.png', 'car.png'),
					'type' => array('image/png', 'image/png'),
					'size' => array(10, 30),
				),
				FALSE,
				array(
					array('name' => 'bicycle.png', 'type' => 'image/png', 'size' => 10),
					array('name' => 'car.png', 'type' => 'image/png', 'size' => 30),
				),
			),
			// #1
			array(
				array(
					'CD' => array('700', '780'),
					'DVD' => array('4700','650'),
					'BD' => array('25000','405'),
				),
				TRUE,
				array(
					array('CD' => '700', 'DVD' => '4700', 'BD' => '25000'),
					array('CD' => '780', 'DVD' => '650', 'BD' => '405'),
				),
			),
		);
	}

	/**
	 * @covers  Arr::get
	 *
	 * @dataProvider  provider_get
	 *
	 * @param    array   Array to look in
	 * @param    mixed   Key to look for
	 * @param    mixed   What to return if $key isn't set
	 * @param    mixed   The expected value returned
	 * @return   void
	 */
	public function test_get(array $array, $key, $default, $expected)
	{
		$this->assertSame($expected, Arr::get($array, $key, $default));
	}

	/**
	 * @covers  Arr::rotate
	 *
	 * @dataProvider  provider_rotate
	 *
	 * @param    array   Array to rotate
	 * @param    bool    Keep the keys
	 * @param    array   Expected array
	 * @return   void
	 */
	public function test_rotate(array $array, $keep_keys, array $expected)
	{
		$this->assertSame($expected, Arr::rotate($array, $keep_keys));
	}
}
