<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ListTest;

/**
 * Testcase class for ListTest.
 */
class ListTestTest extends ZimbraMailTestCase
{
    public function testListTest()
    {
        $index = mt_rand(1, 10);
        $listTest = new ListTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $listTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<listTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $listTest);

        $array = array(
            'listTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $listTest->toArray());
    }
}
