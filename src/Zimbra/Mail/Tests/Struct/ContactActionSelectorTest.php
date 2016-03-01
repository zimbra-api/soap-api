<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ContactActionOp;
use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Mail\Struct\NewContactAttr;

/**
 * Testcase class for ContactActionSelector.
 */
class ContactActionSelectorTest extends ZimbraMailTestCase
{
    public function testContactActionSelector()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $attr_id = mt_rand(0, 10);
        $part = $this->faker->word;
        $attr = new NewContactAttr(
            $name, $value, $aid, $attr_id, $part
        );

        $id = $this->faker->word;
        $tcon = $this->faker->word;
        $tag = mt_rand(0, 10);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(0, 128);
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $action = new ContactActionSelector(
            ContactActionOp::MOVE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, [$attr]
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame([$attr], $action->getAttrs()->all());

        $action->setOperation(ContactActionOp::MOVE())
               ->addAttr($attr);
        $this->assertTrue($action->getOperation()->is('move'));
        $this->assertSame([$attr, $attr], $action->getAttrs()->all());
        $action->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . ContactActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
                .'<a n="' . $name . '" aid="' . $aid . '" id="' . $attr_id . '" part="' . $part . '">' . $value . '</a>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => ContactActionOp::MOVE()->value(),
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
                'a' => array(
                    array(
                        'n' => $name,
                        '_content' => $value,
                        'aid' => $aid,
                        'id' => $attr_id,
                        'part' => $part,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
