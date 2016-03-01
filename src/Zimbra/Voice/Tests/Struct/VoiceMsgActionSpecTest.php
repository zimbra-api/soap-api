<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Voice\Struct\VoiceMsgActionSpec;

/**
 * Testcase class for VoiceMsgActionSpec.
 */
class VoiceMsgActionSpecTest extends ZimbraStructTestCase
{
    public function testVoiceMsgActionSpec()
    {
        $phone = $this->faker->word;
        $id = $this->faker->word;
        $folderId = $this->faker->word;
        $action = new VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), $phone, $id, $folderId
        );
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($phone, $action->getPhone());
        $this->assertSame($id, $action->getId());
        $this->assertSame($folderId, $action->getFolderId());
        $action->setOperation(VoiceMsgActionOp::MOVE())
               ->setPhone($phone)
               ->setId($id)
               ->setFolderId($folderId);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($phone, $action->getPhone());
        $this->assertSame($id, $action->getId());
        $this->assertSame($folderId, $action->getFolderId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = [
            'action' => [
                'op' => VoiceMsgActionOp::MOVE()->value(),
                'phone' => $phone,
                'id' => $id,
                'l' => $folderId,
            ],
        ];
        $this->assertEquals($array, $action->toArray());
    }
}
