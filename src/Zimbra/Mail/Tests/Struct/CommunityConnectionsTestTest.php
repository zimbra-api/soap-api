<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\CommunityConnectionsTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CommunityConnectionsTest.
 */
class CommunityConnectionsTestTest extends ZimbraStructTestCase
{
    public function testCommunityConnectionsTest()
    {
        $index = mt_rand(1, 99);

        $test = new CommunityConnectionsTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<communityConnectionsTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CommunityConnectionsTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, CommunityConnectionsTest::class, 'json'));
    }
}
