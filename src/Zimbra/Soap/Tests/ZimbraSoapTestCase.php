<?php

namespace Zimbra\Soap\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

/**
 * Base testcase class for all Zimbra Struct testcases.
 */
abstract class ZimbraSoapTestCase extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }
}
