<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MsgPartIds;

/**
 * Testcase class for MsgPartIds.
 */
class MsgPartIdsTest extends ZimbraMailTestCase
{
    public function testMsgPartIds()
    {
        $id = $this->faker->uuid;
        $part = $this->faker->word;

        $m = new MsgPartIds(
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
            )
        );
        $this->assertEquals($array, $m->toArray());
    }
}
