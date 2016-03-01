<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\MsgActionOp;
use Zimbra\Mail\Request\MsgAction;
use Zimbra\Mail\Struct\MsgActionSelector;

/**
 * Testcase class for MsgAction.
 */
class MsgActionTest extends ZimbraMailApiTestCase
{
    public function testMsgActionRequest()
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

        $req = new MsgAction(
            $action
        );
        $this->assertSame($action, $req->getAction());

        $req = new MsgAction(
            new MsgActionSelector(MsgActionOp::MOVE(), '', '', '', '', '', '', '', '', '', '')
        );
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MsgActionRequest>'
                .'<action op="' . MsgActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $l . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" />'
            .'</MsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MsgActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMsgActionApi()
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
        $this->api->msgAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:MsgActionRequest>'
                        .'<urn1:action op="' . MsgActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $l . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $f . '" t="' . $t . '" tn="' . $tn . '" />'
                    .'</urn1:MsgActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
