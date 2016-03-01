<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MsgAttachSpec;

/**
 * Testcase class for MsgAttachSpec.
 */
class MsgAttachSpecTest extends ZimbraMailTestCase
{
    public function testMsgAttachSpec()
    {
        $id = $this->faker->word;
        $m = new MsgAttachSpec($id);
        $this->assertSame($id, $m->getId());

        $m->setId($id)
          ->setOptional(true);
        $this->assertSame($id, $m->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m id="' . $id . '" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => $id,
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
