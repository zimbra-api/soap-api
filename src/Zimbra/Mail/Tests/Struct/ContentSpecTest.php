<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ContentSpec;

/**
 * Testcase class for ContentSpec.
 */
class ContentSpecTest extends ZimbraMailTestCase
{
    public function testContentSpec()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $mid = $this->faker->word;
        $part = $this->faker->word;

        $content = new ContentSpec(
            $value, $aid, $mid, $part
        );
        $this->assertSame($aid, $content->getAttachmentId());
        $this->assertSame($mid, $content->getMessageId());
        $this->assertSame($part, $content->getPart());

        $content->setAttachmentId($aid)
                ->setMessageId($mid)
                ->setPart($part);
        $this->assertSame($aid, $content->getAttachmentId());
        $this->assertSame($mid, $content->getMessageId());
        $this->assertSame($part, $content->getPart());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<content aid="' . $aid . '" mid="' . $mid . '" part="' . $part . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_content' => $value,
                'aid' => $aid,
                'mid' => $mid,
                'part' => $part,
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }
}
