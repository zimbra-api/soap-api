<?php declare(strict_types=1);

namespace Zimbra\Tests\Common;

use PHPUnit\Framework\TestCase;
use Faker\Factory as FakerFactory;
use Zimbra\Common\Text;

/**
 * Testcase class for text.
 */
class TextTest extends TestCase
{
    protected $faker;

    protected function setUp(): void
    {
        $this->faker = FakerFactory::create();
    }

    public function testIsRgb()
    {
        $color = $this->faker->hexcolor;
        $this->assertTrue(Text::isRgb($color));
        $this->assertFalse(Text::isRgb('#' . $this->faker->word));
    }

    public function testBoolToString()
    {
        $number = mt_rand(1, 100);
        $string = $this->faker->word;
        $this->assertSame('true', Text::boolToString(true));
        $this->assertSame('false', Text::boolToString(false));
        $this->assertSame($number, Text::boolToString($number));
        $this->assertSame($string, Text::boolToString($string));
    }
}
