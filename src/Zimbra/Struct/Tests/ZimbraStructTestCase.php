<?php

namespace Zimbra\Struct\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;

/**
 * Base testcase class for all Zimbra Struct testcases.
 */
abstract class ZimbraStructTestCase extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public static function randomRange($start, $end, $quantity)
    {
        static $faker;
        if (empty($faker)) {
            $faker = FakerFactory::create();
        }
        return $faker->randomElements(range($start, $end), $quantity);
    }
}
