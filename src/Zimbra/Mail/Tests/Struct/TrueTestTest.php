<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\TrueTest;

/**
 * Testcase class for TrueTest.
 */
class TrueTestTest extends ZimbraMailTestCase
{
    public function testTrueTest()
    {
        $index = mt_rand(1, 10);
        $trueTest = new TrueTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $trueTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<trueTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $trueTest);

        $array = array(
            'trueTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $trueTest->toArray());
    }
}
