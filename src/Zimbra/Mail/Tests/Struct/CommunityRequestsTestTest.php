<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\CommunityRequestsTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CommunityRequestsTest.
 */
class CommunityRequestsTestTest extends ZimbraStructTestCase
{
    public function testCommunityRequestsTest()
    {
        $index = mt_rand(1, 99);

        $test = new CommunityRequestsTest(
            $index, TRUE
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<communityRequestsTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CommunityRequestsTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, CommunityRequestsTest::class, 'json'));
    }
}
