<?php

namespace Zimbra\Mail\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

/**
 * Base testcase class for all Zimbra Mail testcases.
 */
abstract class ZimbraMailTestCase extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }
}
