<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * CSV test
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
class Vulture_CSVTest extends PHPUnit_Framework_TestCase {

	/**
	 * Provider for [test_it_escapes_value]
	 *
	 * @return  array
	 */
	public function provider_it_escapes_value()
	{
		return array(
			array('Trucks', 'Trucks'),
			array('Trucks and buses', 'Trucks and buses'),
			array('Super "duper" truck', 'Super ""duper"" truck'),
			array('Super, luxurious truck', '"Super, luxurious truck"'),
			array('Super, "luxurious" truck', '"Super, ""luxurious"" truck"'),
			array("Go get one now\nthey are going fast", "\"Go get one now\nthey are going fast\""),
			array(' Super luxurious truck ', '" Super luxurious truck "'),
			array('"Super, luxurious" truck', '"""Super, luxurious"" truck"'),
		);
	}

	/**
	 * @covers  CSV::__construct
	 */
	public function test_it_sets_header_on_construction()
	{
		$header = array('foo', 'bar');

		$csv = new CSV($header);

		$this->assertAttributeSame($header, '_header', $csv);
	}

	/**
	 * @covers  CSV::header
	 */
	public function test_it_sets_header()
	{
		$header = array('foo', 'bar');

		$csv = new CSV;

		$csv->header($header);

		$this->assertAttributeSame($header, '_header', $csv);
	}

	/**
	 * @covers  CSV::add
	 */
	public function test_it_adds_lines()
	{
		$expected = array(
			array('one', 'two'),
			array('foo', 'bar'),
		);

		$csv = new CSV;

		$csv->add(array('one', 'two'));
		$csv->add(array('foo', 'bar'));

		$this->assertAttributeSame($expected, '_data', $csv);
	}

	/**
	 * @covers  CSV::escape
	 *
	 * @dataProvider  provider_it_escapes_value
	 *
	 * @param   string  Value to escape
	 * @param   string  Expected value after escaping
	 * @return  void
	 */
	public function test_it_escapes_value($value, $expected)
	{
		$csv = new CSV;

		$this->assertSame($expected, $csv->escape($value));
	}

	/**
	 * @covers  CSV::render
	 */
	public function test_it_renders_data()
	{
		$csv = new CSV(array('Year', 'Make', 'Model', 'Description', 'Price'));

		$csv->add(array(2011, 'Mercedes-Benz', 'Actros', 'auto gearbox, twin fuel tanks', '85000.00'));
		$csv->add(array(2011, 'Volvo', 'FH 13 420', 'CD player, fridge', '60000.00'));
		$csv->add(array(1998, 'Iveco', '15E27', '"broken" parts', '2400.00'));

		$expected  = 'Year,Make,Model,Description,Price'.PHP_EOL;
		$expected .= '2011,Mercedes-Benz,Actros,"auto gearbox, twin fuel tanks",85000.00'.PHP_EOL;
		$expected .= '2011,Volvo,FH 13 420,"CD player, fridge",60000.00'.PHP_EOL;
		$expected .= '1998,Iveco,15E27,""broken"" parts,2400.00'.PHP_EOL;

		$this->assertSame($expected, $csv->render());
	}
}
