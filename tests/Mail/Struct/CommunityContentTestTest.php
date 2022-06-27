<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CommunityContentTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommunityContentTest.
 */
class CommunityContentTestTest extends ZimbraTestCase
{
    public function testCommunityContentTest()
    {
        $index = mt_rand(1, 99);

        $test = new CommunityContentTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CommunityContentTest::class, 'xml'));
    }
}
