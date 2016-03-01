<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ConvActionOp;
use Zimbra\Mail\Request\ConvAction;
use Zimbra\Mail\Struct\ConvActionSelector;

/**
 * Testcase class for ConvAction.
 */
class ConvActionTest extends ZimbraMailApiTestCase
{
    public function testConvActionRequest()
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

        $req = new ConvAction(
            $action
        );
        $this->assertSame($action, $req->getAction());
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ConvActionRequest>'
                .'<action op="' . ConvActionOp::DELETE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />'
            .'</ConvActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ConvActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testConvActionApi()
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

        $this->api->convAction(
           $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ConvActionRequest>'
                        .'<urn1:action op="' . ConvActionOp::DELETE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" />'
                    .'</urn1:ConvActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
