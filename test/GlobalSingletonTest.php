<?php
namespace singleton;

require_once 'bootstrap.php';

class GlobalSingletonTest extends \PHPUnit_Framework_TestCase {

	public function testBasics() {
		$obj = SingletonMock::getInstance();
		$this->assertNull($obj);

		SingletonMock::setInstance(new SingletonMock());
		$this->assertEquals($obj, Singleton::getInstance());

		$this->assertTrue(SingletonMock::hasInstance());
	}

	public function testNamed() {
		$obj = SingletonMock::getInstance('foobar');
		$this->assertNull($obj);

		$obj = new SingletonMock();
		SingletonMock::setInstance($obj, 'foobar');
		$this->assertEquals($obj, SingletonMock::getInstance('foobar'));

		SingletonMock::setInstance(new SingletonMock(), 'barbat');
		$this->assertTrue(SingletonMock::hasInstance('barbat'));

		$this->setExpectedException('RuntimeException');
		SingletonMock::clearInstance('barbat');
	}

	public function testGetAll() {
		for ($i = 0; $i < 15; ++$i) {
			SingletonMock::setInstance(new SingletonMock(), $i);
		}
		$this->assertEquals(17, count(SingletonMock::getAllInstances()));
	}

	public function testClear() {
		$this->setExpectedException('RuntimeException');
		SingletonMock::clearAllInstances();
	}
}

class SingletonMock extends GlobalSingleton {
}