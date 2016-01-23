<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Mail\Request\NoteAction;
use Zimbra\Mail\Struct\NoteActionSelector;

/**
 * Testcase class for NoteAction.
 */
class NoteActionTest extends ZimbraMailApiTestCase
{
    public function testNoteActionRequest()
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

        $req = new NoteAction(
            $action
        );
        $this->assertSame($action, $req->getAction());

        $req = new NoteAction(
            new NoteActionSelector(ItemActionOp::MOVE(), '', '', '', '', '', '', '', '', '', '')
        );
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoteActionRequest>'
                .'<action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" l="' . $l . '" rgb="' . $rgb . '" tag="' . $tag . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" content="' . $content . '" pos="' . $pos . '" />'
            .'</NoteActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoteActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoteActionApi()
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
        $this->api->noteAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:NoteActionRequest>'
                        .'<urn1:action op="' . ItemActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" l="' . $l . '" rgb="' . $rgb . '" tag="' . $tag . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" content="' . $content . '" pos="' . $pos . '" />'
                    .'</urn1:NoteActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
