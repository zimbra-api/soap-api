<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CommunityConnectionsTest;

/**
 * Testcase class for CommunityConnectionsTest.
 */
class CommunityConnectionsTestTest extends ZimbraMailTestCase
{
    public function testCommunityConnectionsTest()
    {
        $index = mt_rand(1, 10);
        $communityConnectionsTest = new CommunityConnectionsTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $communityConnectionsTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<communityConnectionsTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $communityConnectionsTest);

        $array = array(
            'communityConnectionsTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $communityConnectionsTest->toArray());
    }
}
