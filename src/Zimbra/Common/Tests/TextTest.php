<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;
use Zimbra\Common\Text;

/**
 * Testcase class for text.
 */
class TextTest extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public function testIsRgb()
    {
        $color = $this->faker->hexcolor;
        $this->assertTrue(Text::isRgb($color));
        $this->assertFalse(Text::isRgb('#' . $this->faker->word));
    }
    public function testIsValidTagName()
    {
        $name = $this->faker->word;
        $this->assertTrue(Text::isValidTagName($name));
        $this->assertTrue(Text::isValidTagName('_' . $name));
        $this->assertTrue(Text::isValidTagName('ns:' . $name));
        $this->assertTrue(Text::isValidTagName($name . '2000'));
        $this->assertTrue(Text::isValidTagName($name . '_2000'));
        $this->assertTrue(Text::isValidTagName($name . '-2000'));
        $this->assertTrue(Text::isValidTagName($name . '.2000'));
        $this->assertTrue(Text::isValidTagName($name . ' 2000'));

        $this->assertFalse(Text::isValidTagName(':' . $name));
        $this->assertFalse(Text::isValidTagName('.' . $name));
        $this->assertFalse(Text::isValidTagName(' ' . $name));
        $this->assertFalse(Text::isValidTagName('-' . $name));
        $this->assertFalse(Text::isValidTagName(mt_rand(1, 100)));
    }

    public function tesTextractHeaders()
    {
        $headersString = 'HTTP/1.1 200 OK' . "\r\n"
                       . 'Date: Sun, 25 Jun 2006 19:55:19 GMT' . "\r\n"
                       . 'Server: Apache' . "\r\n"
                       . 'X-powered-by: PHP/5.2.4' . "\r\n"
                       . 'Connection: close' . "\r\n"
                       . 'Transfer-encoding: chunked' . "\r\n"
                       . 'Content-type: text/html' . "\r\n";
        $headers =[
            'Date' => 'Sun, 25 Jun 2006 19:55:19 GMT',
            'Server' => 'Apache',
            'X-powered-by' => 'PHP/5.4.4',
            'Connection' => 'close',
            'Transfer-encoding' => 'chunked',
            'Content-type' => 'text/html',
        ];
       $extractHeaders = Text::extractHeaders($headersString);
       $this->assertCount(count($headers), $extractHeaders);
       foreach ($headers as $key => $value)
       {
           $this->assertArrayHasKey($key, $extractHeaders);
           $this->assertSame($value, $extractHeaders[$key]);
       }
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
