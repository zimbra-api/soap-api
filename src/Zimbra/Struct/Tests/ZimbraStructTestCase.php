<?php

namespace Zimbra\Struct\Tests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use PHPUnit\Framework\TestCase;
use Faker\Factory as FakerFactory;
use JMS\Serializer\SerializerBuilder;

/**
 * Base testcase class for all Zimbra Struct testcases.
 */
abstract class ZimbraStructTestCase extends TestCase
{
    protected $faker;
    protected $serializer;

    protected function setUp()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $this->faker = FakerFactory::create();
        $this->serializer = SerializerBuilder::create()->build();
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
