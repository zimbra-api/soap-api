<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Mail\Request\ItemAction;
use Zimbra\Mail\Struct\ItemActionSelector;

/**
 * Testcase class for ItemAction.
 */
class ItemActionTest extends ZimbraMailApiTestCase
{
    public function testItemActionRequest()
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
        $req = new ItemAction(
            $action
        );
        $this->assertSame($action, $req->getAction());

        $req = new ItemAction(
            new ItemActionSelector(ItemActionOp::MOVE(), '', '', '', '', '', '', '', '', '', '')
        );
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ItemActionRequest>'
                .'<action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />'
            .'</ItemActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ItemActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testItemActionApi()
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

        $this->api->itemAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ItemActionRequest>'
                        .'<urn1:action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />'
                    .'</urn1:ItemActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
