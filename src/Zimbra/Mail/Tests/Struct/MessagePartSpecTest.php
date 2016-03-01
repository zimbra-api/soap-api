<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MessagePartSpec;

/**
 * Testcase class for MessagePartSpec.
 */
class MessagePartSpecTest extends ZimbraMailTestCase
{
    public function testMessagePartSpec()
    {
        $id = $this->faker->uuid;
        $part = $this->faker->word;
        $m = new MessagePartSpec(
            $id, $part
        );
        $this->assertSame($id, $m->getId());
        $this->assertSame($part, $m->getPart());

        $m->setId($id)
          ->setPart($part);
        $this->assertSame($id, $m->getId());
        $this->assertSame($part, $m->getPart());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m id="' . $id . '" part="' . $part . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => $id,
                'part' => $part,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
