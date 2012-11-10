<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Text test
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
class Vulture_TextTest extends PHPUnit_Framework_TestCase {

	/**
	 * Data provider for [test_clean_wsc]
	 *
	 * @return  array
	 */
	public function provider_clean_wsc()
	{
		return array(
			array("\tTOM!\n\rNo answer.\n\r", ' ', 'TOM! No answer.'),
			array("\tTOM!\nNo answer.\n\n", ' ', 'TOM! No answer.'),
			array("\tWhat's gone with that boy, I wonder? You TOM!", ' ', 'What\'s gone with that boy, I wonder? You TOM!'),
			array("  \n\rI never did see the beat of that boy!\n\r\n\r  ", ' ', 'I never did see the beat of that boy!'),
			array("  \n\rY-o-u-u   Tom!\n\r\n\r  ", '@', 'Y-o-u-u@Tom!'),
			array("one\n\rtwo  three\t\t", ', ', 'one, two, three'),
		);
	}

	/**
	 * @covers  Text::clean_wsc
	 *
	 * @dataProvider  provider_clean_wsc
	 *
	 * @param   string  Input string
	 * @param   string  Replacement string
	 * @param   string  Expected result
	 * @return  void
	 */
	public function test_clean_wsc($string, $replacement, $expected)
	{
		$this->assertSame($expected, Text::clean_wsc($string, $replacement));
	}
}
