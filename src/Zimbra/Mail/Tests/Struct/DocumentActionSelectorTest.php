<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DocumentActionSelector;
use Zimbra\Mail\Struct\DocumentActionGrant;
use Zimbra\Enum\DocumentActionOp;
use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;

/**
 * Testcase class for DocumentActionSelector.
 */
class DocumentActionSelectorTest extends ZimbraMailTestCase
{
    public function testDocumentActionSelector()
    {
        $expiry = mt_rand(1, 100);
        $grant = new DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), $expiry
        );

        $zid = $this->faker->uuid;
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

        $action = new DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, $zid, $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );
        $this->assertTrue($action->getOperation()->is('watch'));
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame($zid, $action->getZimbraId());

        $action->setOperation(DocumentActionOp::WATCH())
               ->setGrant($grant)
               ->setZimbraId($zid);
        $this->assertTrue($action->getOperation()->is('watch'));
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame($zid, $action->getZimbraId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . DocumentActionOp::WATCH() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" zid="' . $zid . '">'
                .'<grant perm="' . DocumentPermission::READ() . '" gt="' . DocumentGrantType::ALL() . '" expiry="' . $expiry . '" />'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => DocumentActionOp::WATCH()->value(),
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
                'zid' => $zid,
                'grant' => array(
                    'perm' => DocumentPermission::READ()->value(),
                    'gt' => DocumentGrantType::ALL()->value(),
                    'expiry' => $expiry,
                ),
            )
        );
        $this->assertEquals($array, $action->toArray());
    }
}
