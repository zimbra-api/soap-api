<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CommunityContentTest;

/**
 * Testcase class for CommunityContentTest.
 */
class CommunityContentTestTest extends ZimbraMailTestCase
{
    public function testCommunityContentTest()
    {
        $index = mt_rand(1, 10);
        $communityContentTest = new CommunityContentTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $communityContentTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<communityContentTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $communityContentTest);

        $array = array(
            'communityContentTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $communityContentTest->toArray());
    }
}
