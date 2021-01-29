<?php declare(strict_types=1);

namespace Zimbra\Tests;

use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;
use Zimbra\Common\SerializerFactory;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraTestCase extends TestCase
{
    protected $faker;
    protected $serializer;

    protected function setUp(): void
    {
        $this->faker = FakerFactory::create();
        $this->serializer = SerializerFactory::create();
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
