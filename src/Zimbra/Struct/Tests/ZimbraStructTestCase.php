<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;
use Zimbra\Common\SerializerBuilder;

/**
 * Base testcase class for all Zimbra testcases.
 */
abstract class ZimbraStructTestCase extends TestCase
{
    protected $faker;
    protected $serializer;

    protected function setUp(): void
    {
        $this->faker = FakerFactory::create();
        $this->serializer = SerializerBuilder::getSerializer();
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
