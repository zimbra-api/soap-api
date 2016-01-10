<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MeTest;

/**
 * Testcase class for MeTest.
 */
class MeTestTest extends ZimbraMailTestCase
{
    public function testMeTest()
    {
        $index = mt_rand(1, 10);
        $header = $this->faker->word;
        $meTest = new MeTest(
            $index, $header, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $meTest);
        $this->assertSame($header, $meTest->getHeader());
        $meTest->setHeader($header);
        $this->assertSame($header, $meTest->getHeader());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<meTest index="' . $index . '" negative="true" header="' . $header . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $meTest);

        $array = array(
            'meTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
            ),
        );
        $this->assertEquals($array, $meTest->toArray());
    }
}
