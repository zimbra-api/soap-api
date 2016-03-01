<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ConvActionOp;
use Zimbra\Mail\Struct\ConvActionSelector;

/**
 * Testcase class for ConvActionSelector.
 */
class ConvActionSelectorTest extends ZimbraMailTestCase
{
    public function testConvActionSelector()
    {
        $id = $this->faker->word;
        $tcon = $this->faker->word;
        $tag = mt_rand(0, 10);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $action = new ConvActionSelector(
            ConvActionOp::DELETE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->getOperation()->is('delete'));
        $action->setOperation(ConvActionOp::DELETE());
        $this->assertTrue($action->getOperation()->is('delete'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . ConvActionOp::DELETE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => ConvActionOp::DELETE()->value(),
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
