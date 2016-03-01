<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\BulkTest;

/**
 * Testcase class for BulkTest.
 */
class BulkTestTest extends ZimbraMailTestCase
{
    public function testBulkTest()
    {
        $index = mt_rand(0, 10);
        $bulkTest = new BulkTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $bulkTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<bulkTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bulkTest);

        $array = array(
            'bulkTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $bulkTest->toArray());
    }
}
