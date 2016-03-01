<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Mail\Struct\NoteActionSelector;

/**
 * Testcase class for NoteActionSelector.
 */
class NoteActionSelectorTest extends ZimbraMailTestCase
{
    public function testNoteActionSelector()
    {
        $id = $this->faker->uuid;
        $tcon = $this->faker->word;
        $l = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $name = $this->faker->word;
        $f = $this->faker->word;
        $t = $this->faker->word;
        $tn = $this->faker->word;
        $content = $this->faker->word;
        $pos = $this->faker->word;
        $tag = mt_rand(1, 10);
        $color = mt_rand(1, 127);

        $action = new NoteActionSelector(
            ItemActionOp::MOVE(), $id, $tcon, $tag, $l, $rgb, $color, $name, $f, $t, $tn, $content, $pos
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($content, $action->getContent());
        $this->assertSame($pos, $action->getBounds());

        $action = new NoteActionSelector(
            ItemActionOp::DELETE(), $id, $tcon, $tag, $l, $rgb, $color, $name, $f, $t, $tn, '', ''
        );
        $action->setOperation(ItemActionOp::MOVE())
               ->setContent($content)
               ->setBounds($pos);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame($content, $action->getContent());
        $this->assertSame($pos, $action->getBounds());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" l="' . $l . '" rgb="' . $rgb . '" tag="' . $tag . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" content="' . $content . '" pos="' . $pos . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => ItemActionOp::MOVE()->value(),
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
                'content' => $content,
                'pos' => $pos,
            )
        );
        $this->assertEquals($array, $action->toArray());
    }
}
