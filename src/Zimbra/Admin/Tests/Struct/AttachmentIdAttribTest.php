<?php

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content aid="' . $aid . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));

        $content = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\AttachmentIdAttrib', 'xml');
        $this->assertSame($aid, $content->getAttachmentId());
    }
}
