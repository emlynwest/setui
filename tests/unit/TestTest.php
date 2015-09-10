<?php
/**
 * This file is part of the SetUI module.
 *
 * @license Proprietary
 * @author Steve "uru" West <steven.david.west@gmail.com>
 */

namespace SetUI;

use Codeception\TestCase\Test as TestBase;

class TestTest extends TestBase
{

	/**
	 * @var Test
	 */
	protected $instance;

	protected function _before()
	{
		$this->instance = new Test;
	}

	public function testTrue()
	{
		$this->assertTrue($this->instance->returnTrue());
	}
}
