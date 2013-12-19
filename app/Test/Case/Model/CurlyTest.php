<?php
App::uses('Curly', 'Model');

/**
 * Curly Test Case
 *
 */
class CurlyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.curly'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Curly = ClassRegistry::init('Curly');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Curly);

		parent::tearDown();
	}

}
