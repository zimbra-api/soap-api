<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Mail\Struct\ItemActionSelector;

/**
 * Testcase class for ItemActionSelector.
 */
class ItemActionSelectorTest extends ZimbraMailTestCase
{
    public function testItemActionSelector()
    {
        $id = $this->faker->uuid;
        $tcon = $this->faker->word;
        $tag = mt_rand(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $action = new ItemActionSelector(
            ItemActionOp::MOVE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);

        $action->setOperation(ItemActionOp::MOVE());
        $this->assertTrue($action->getOperation()->is('move'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => ItemActionOp::MOVE()->value(),
                'id' => $id,
                'tcon' => $tcon,
                'tag' => $tag,
                'l' => $folder,
                'rgb' => $rgb,
                'color' => $color,
                'name' => $name,
                'f' => $flags,
                't' => $tags,
                'tn' => $tagNames,
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
