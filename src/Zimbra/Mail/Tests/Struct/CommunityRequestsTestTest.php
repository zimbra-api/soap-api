<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CommunityRequestsTest;

/**
 * Testcase class for CommunityRequestsTest.
 */
class CommunityRequestsTestTest extends ZimbraMailTestCase
{
    public function testCommunityRequestsTest()
    {
        $index = mt_rand(1, 10);
        $communityRequestsTest = new CommunityRequestsTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $communityRequestsTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<communityRequestsTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $communityRequestsTest);

        $array = array(
            'communityRequestsTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $communityRequestsTest->toArray());
    }
}
