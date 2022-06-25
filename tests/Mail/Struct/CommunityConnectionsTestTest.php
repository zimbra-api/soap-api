<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CommunityConnectionsTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommunityConnectionsTest.
 */
class CommunityConnectionsTestTest extends ZimbraTestCase
{
    public function testCommunityConnectionsTest()
    {
        $index = mt_rand(1, 99);

        $test = new CommunityConnectionsTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CommunityConnectionsTest::class, 'xml'));
    }
}
