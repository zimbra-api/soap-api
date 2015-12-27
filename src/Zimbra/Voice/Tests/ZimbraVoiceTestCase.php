<?php

namespace Zimbra\Voice\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

/**
 * Base testcase class for all Zimbra Voice testcases.
 */
abstract class ZimbraVoiceTestCase extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }
}
