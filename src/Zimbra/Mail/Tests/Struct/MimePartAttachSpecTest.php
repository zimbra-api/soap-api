<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MimePartAttachSpec;

/**
 * Testcase class for MimePartAttachSpec.
 */
class MimePartAttachSpecTest extends ZimbraMailTestCase
{
    public function testMimePartAttachSpec()
    {
        $mid = $this->faker->uuid;
        $part = $this->faker->word;

        $mp = new MimePartAttachSpec($mid, $part);
        $this->assertSame($mid, $mp->getMessageId());
        $this->assertSame($part, $mp->getPart());

        $mp->setMessageId($mid)
           ->setPart($part)
           ->setOptional(true);
        $this->assertSame($mid, $mp->getMessageId());
        $this->assertSame($part, $mp->getPart());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<mp mid="' . $mid . '" part="' . $part . '" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mp);

        $array = array(
            'mp' => array(
                'mid' => $mid,
                'part' => $part,
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $mp->toArray());
    }
}
