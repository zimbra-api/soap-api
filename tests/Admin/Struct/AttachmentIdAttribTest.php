<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttachmentIdAttrib.
 */
class AttachmentIdAttribTest extends ZimbraTestCase
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
<result aid="$aid"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, AttachmentIdAttrib::class, 'xml'));
    }
}
