<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AttachmentIdAttrib.
 */
class AttachmentIdAttribTest extends ZimbraStructTestCase
{
    public function testAttachmentIdAttrib()
    {
        $aid = $this->faker->uuid;

        $content = new AttachmentIdAttrib($aid);
        $this->assertSame($aid, $content->getAttachmentId());

        $content = new AttachmentIdAttrib('');
        $content->setAttachmentId($aid);
        $this->assertSame($aid, $content->getAttachmentId());

        $xml = <<<EOT
<?xml version="1.0"?>
<content aid="$aid"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, AttachmentIdAttrib::class, 'xml'));

        $json = json_encode([
            'aid' => $aid,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($content, 'json'));
        $this->assertEquals($content, $this->serializer->deserialize($json, AttachmentIdAttrib::class, 'json'));
    }
}
