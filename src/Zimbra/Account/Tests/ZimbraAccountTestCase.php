<?php

namespace Zimbra\Account\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

/**
 * Base testcase class for all Zimbra Account testcases.
 */
abstract class ZimbraAccountTestCase extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }
}
