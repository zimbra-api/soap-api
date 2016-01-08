<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\HeaderTest as HeaderTestStruct;

/**
 * Testcase class for HeaderTest.
 */
class HeaderTestTest extends ZimbraMailTestCase
{
    public function testHeaderTest()
    {
        $index = mt_rand(1, 10);
        $header = $this->faker->word;
        $comparison = $this->faker->word;
        $value = $this->faker->word;

        $headerTest = new HeaderTestStruct(
            $index, $header, $comparison, $value, true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $headerTest);
        $this->assertSame($header, $headerTest->getHeaders());
        $this->assertSame($comparison, $headerTest->getStringComparison());
        $this->assertSame($value, $headerTest->getValue());
        $this->assertTrue($headerTest->getCaseSensitive());

        $headerTest->setHeaders($header)
                   ->setStringComparison($comparison)
                   ->setValue($value)
                   ->setCaseSensitive(true);
        $this->assertSame($header, $headerTest->getHeaders());
        $this->assertSame($comparison, $headerTest->getStringComparison());
        $this->assertSame($value, $headerTest->getValue());
        $this->assertTrue($headerTest->getCaseSensitive());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<headerTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $headerTest);

        $array = array(
            'headerTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
                'stringComparison' => $comparison,
                'value' => $value,
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $headerTest->toArray());
    }
}
