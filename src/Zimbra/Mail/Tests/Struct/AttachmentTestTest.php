<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AttachmentTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attachmentTest index="' . $index . '" negative="true" />';
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
