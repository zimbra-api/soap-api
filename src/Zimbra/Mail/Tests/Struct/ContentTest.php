<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\Content;

/**
 * Testcase class for Content.
 */
class ContentTest extends ZimbraMailTestCase
{
    public function testContent()
    {
        $value = $this->faker->word;
        $aid = $this->faker->uuid;

        $content = new Content(
            $value, $aid
        );
        $this->assertSame($aid, $content->getAttachUploadId());

        $content->setAttachUploadId($aid);
        $this->assertSame($aid, $content->getAttachUploadId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<content aid="' . $aid . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_content' => $value,
                'aid' => $aid,
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }
}
