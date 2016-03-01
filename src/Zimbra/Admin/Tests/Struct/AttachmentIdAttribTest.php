<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\AttachmentIdAttrib;

/**
 * Testcase class for AttachmentIdAttrib.
 */
class AttachmentIdAttribTest extends ZimbraAdminTestCase
{
    public function testAttachmentIdAttrib()
    {
        $aid = $this->faker->word;

        $content = new AttachmentIdAttrib($aid);
        $this->assertSame($aid, $content->getAttachmentId());
        $content->setAttachmentId($aid);
        $this->assertSame($aid, $content->getAttachmentId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content aid="' . $aid . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = [
            'content' => [
                'aid' => $aid,
            ],
        ];
        $this->assertEquals($array, $content->toArray());
    }
}
