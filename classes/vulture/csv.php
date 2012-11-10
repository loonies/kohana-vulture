<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Creates CSV from an array of data
 *
 * @package    Vulture
 * @category   Helpers
 * @author     Miodrag Tokić <mtokic@gmail.com>
 * @copyright  (c) 2012, Miodrag Tokić
 * @license    MIT
 */
class Vulture_CSV {

	/**
	 * @var  array  Header column names
	 */
	protected $_header = array();

	/**
	 * @var  array  Data to be exported
	 */
	protected $_data = array();

	/**
	 * @var  string  Value delimeter
	 */
	public static $delimeter = ',';

	/**
	 * Creates a new CSV instance
	 *
	 * @param   array   Header column names
	 * @return  void
	 */
	public function __construct(array $header = NULL)
	{
		if ($header !== NULL)
		{
			$this->header($header);
		}
	}

	/**
	 * Sets header column names
	 *
	 * @param   array   Header column names
	 * @return  void
	 */
	public function header(array $header)
	{
		$this->_header = $header;
	}

	/**
	 * Adds a line to the data to be exported
	 *
	 * @param   array  Data to be exported
	 * @return  void
	 */
	public function add(array $line)
	{
		$this->_data[] = $line;
	}

	/**
	 * Returns properly escaped value
	 *
	 * @param   string  Value to escape
	 * @param   string
	 */
	public function escape($value)
	{
		$value = str_replace('"', '""', $value);

		if (preg_match('/^ |[\n\r\t,]| $/', $value) === 1)
		{
			$value = '"'.$value.'"';
		}

		return $value;
	}

	/**
	 * Returns CSV representation of data
	 *
	 * @return  string
	 */
	public function render()
	{
		$output = '';

		$data = $this->_data;

		$header = array_map(array($this, 'escape'), $this->_header);

		// Add header
		array_unshift($data, $header);

		foreach ($data as $line)
		{
			$line = array_map(array($this, 'escape'), $line);

			// Add line
			$output .= implode(self::$delimeter, $line).PHP_EOL;
		}

		return $output;
	}

	/**
	 * Returns rendered CSV representation of data
	 *
	 * This magic method allows this object to be
	 * rendered when casting to string.
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return $this->render();
	}
}
