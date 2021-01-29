<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AttachmentTest;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AttachmentTest.
 */
class AttachmentTestTest extends ZimbraStructTestCase
{
    public function testAttachmentTest()
    {
        $index = mt_rand(1, 99);

        $test = new AttachmentTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<attachmentTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, AttachmentTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, AttachmentTest::class, 'json'));
    }
}
