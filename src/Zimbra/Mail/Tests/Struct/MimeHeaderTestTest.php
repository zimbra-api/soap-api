<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MimeHeaderTest;

/**
 * Testcase class for MimeHeaderTest.
 */
class MimeHeaderTestTest extends ZimbraMailTestCase
{
    public function testMimeHeaderTest()
    {
        $index = mt_rand(1, 10);
        $header = $this->faker->word;
        $stringComparison = $this->faker->word;
        $value = $this->faker->word;

        $mimeHeaderTest = new MimeHeaderTest(
            $index, $header, $stringComparison, $value, true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $mimeHeaderTest);
        $this->assertSame($header, $mimeHeaderTest->getHeaders());
        $this->assertSame($stringComparison, $mimeHeaderTest->getStringComparison());
        $this->assertSame($value, $mimeHeaderTest->getValue());
        $this->assertTrue($mimeHeaderTest->getCaseSensitive());

        $mimeHeaderTest->setHeaders($header)
                       ->setStringComparison($stringComparison)
                       ->setValue($value)
                       ->setCaseSensitive(true);
        $this->assertSame($header, $mimeHeaderTest->getHeaders());
        $this->assertSame($stringComparison, $mimeHeaderTest->getStringComparison());
        $this->assertSame($value, $mimeHeaderTest->getValue());
        $this->assertTrue($mimeHeaderTest->getCaseSensitive());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<mimeHeaderTest index="' . $index . '" negative="true" header="' . $header . '" stringComparison="' . $stringComparison . '" value="' . $value . '" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mimeHeaderTest);

        $array = array(
            'mimeHeaderTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
                'stringComparison' => $stringComparison,
                'value' => $value,
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $mimeHeaderTest->toArray());
    }
}
