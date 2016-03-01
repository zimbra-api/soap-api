<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\BodyTest;

/**
 * Testcase class for BodyTest.
 */
class BodyTestTest extends ZimbraMailTestCase
{
    public function testBodyTest()
    {
        $index = mt_rand(0, 10);
        $value = $this->faker->word;

        $bodyTest = new BodyTest(
            $index, $value, true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $bodyTest);
        $this->assertSame($value, $bodyTest->getValue());
        $this->assertTrue($bodyTest->getCaseSensitive());

        $bodyTest->setValue($value)
                 ->setCaseSensitive(true);
        $this->assertSame($value, $bodyTest->getValue());
        $this->assertTrue($bodyTest->getCaseSensitive());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bodyTest index="' . $index . '" negative="true" value="' . $value . '" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bodyTest);

        $array = array(
            'bodyTest' => array(
                'index' => $index,
                'negative' => true,
                'value' => $value,
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $bodyTest->toArray());
    }
}
