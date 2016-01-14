<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\MsgActionOp;
use Zimbra\Mail\Struct\MsgActionSelector;

/**
 * Testcase class for MsgActionSelector.
 */
class MsgActionSelectorTest extends ZimbraMailTestCase
{
    public function testMsgActionSelector()
    {
        $id = $this->faker->uuid;
        $tcon = $this->faker->word;
        $l = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $name = $this->faker->word;
        $f = $this->faker->word;
        $t = $this->faker->word;
        $tn = $this->faker->word;
        $tag = mt_rand(1, 10);
        $color = mt_rand(1, 127);

        $action = new MsgActionSelector(
            MsgActionOp::MOVE(), $id, $tcon, $tag, $l, $rgb, $color, $name, $f, $t, $tn
        );
        $this->assertTrue($action->getOperation()->is('move'));

        $action->setOperation(MsgActionOp::MOVE());
        $this->assertTrue($action->getOperation()->is('move'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . MsgActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $l . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => MsgActionOp::MOVE()->value(),
                'id' => $id,
                'tcon' => $tcon,
                'tag' => $tag,
                'l' => $l,
                'rgb' => $rgb,
                'color' => $color,
                'name' => $name,
                'f' => $f,
                't' => $t,
                'tn' => $tn,
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
