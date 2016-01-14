<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ContactActionOp;
use Zimbra\Mail\Struct\ActionSelector;

/**
 * Testcase class for ActionSelector.
 */
class ActionSelectorTest extends ZimbraMailTestCase
{
    public function testActionSelector()
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

        $action = new \Zimbra\Mail\Struct\ActionSelector(
            ContactActionOp::MOVE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $this->assertSame($id, $action->getIds());
        $this->assertSame($tcon, $action->getConstraint());
        $this->assertSame($tag, $action->getTag());
        $this->assertSame($folder, $action->getFolder());
        $this->assertSame($rgb, $action->getRgb());
        $this->assertSame($color, $action->getColor());
        $this->assertSame($name, $action->getName());
        $this->assertSame($flags, $action->getFlags());
        $this->assertSame($tags, $action->getTags());
        $this->assertSame($tagNames, $action->getTagNames());

        $action->setIds($id)
               ->setConstraint($tcon)
               ->setTag($tag)
               ->setFolder($folder)
               ->setRgb($rgb)
               ->setColor($color)
               ->setName($name)
               ->setFlags($flags)
               ->setTags($tags)
               ->setTagNames($tagNames);
        $this->assertSame($id, $action->getIds());
        $this->assertSame($tcon, $action->getConstraint());
        $this->assertSame($tag, $action->getTag());
        $this->assertSame($folder, $action->getFolder());
        $this->assertSame($rgb, $action->getRgb());
        $this->assertSame($color, $action->getColor());
        $this->assertSame($name, $action->getName());
        $this->assertSame($flags, $action->getFlags());
        $this->assertSame($tags, $action->getTags());
        $this->assertSame($tagNames, $action->getTagNames());
        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . ContactActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />';
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
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }
}
