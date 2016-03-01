<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\HeaderExistsTest;

/**
 * Testcase class for HeaderExistsTest.
 */
class HeaderExistsTestTest extends ZimbraMailTestCase
{
    public function testHeaderExistsTest()
    {
        $index = mt_rand(1, 10);
        $header = $this->faker->word;

        $headerExistsTest = new HeaderExistsTest(
            $index, $header, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $headerExistsTest);
        $this->assertSame($header, $headerExistsTest->getHeader());
        $headerExistsTest->setHeader($header);
        $this->assertSame($header, $headerExistsTest->getHeader());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<headerExistsTest index="' . $index . '" negative="true" header="' . $header . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $headerExistsTest);

        $array = array(
            'headerExistsTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
            ),
        );
        $this->assertEquals($array, $headerExistsTest->toArray());
    }
}
