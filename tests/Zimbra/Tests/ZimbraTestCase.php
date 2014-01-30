<?php

namespace Zimbra\Tests;

use \PHPUnit_Framework_TestCase;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraTestCase extends PHPUnit_Framework_TestCase
{
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}
}
