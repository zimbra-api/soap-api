<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ContactActionOp;
use Zimbra\Mail\Request\ContactAction;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Mail\Struct\ContactActionSelector;

/**
 * Testcase class for ContactAction.
 */
class ContactActionTest extends ZimbraMailApiTestCase
{
    public function testContactActionRequest()
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
        $color = mt_rand(1, 127);
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $action = new ContactActionSelector(
            ContactActionOp::MOVE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, [$attr]
        );

        $req = new ContactAction(
            $action
        );
        $this->assertSame($action, $req->getAction());
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ContactActionRequest>'
                .'<action op="' . ContactActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
                    .'<a n="' . $name . '" aid="' . $aid . '" id="' . $attr_id . '" part="' . $part . '">' . $value . '</a>'
                .'</action>'
            .'</ContactActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ContactActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testContactActionApi()
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
        $color = mt_rand(0, 127);
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $action = new ContactActionSelector(
            ContactActionOp::MOVE(), $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, [$attr]
        );

        $this->api->contactAction(
           $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ContactActionRequest>'
                        .'<urn1:action op="' . ContactActionOp::MOVE() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '">'
                            .'<urn1:a n="' . $name . '" aid="' . $aid . '" id="' . $attr_id . '" part="' . $part . '">' . $value . '</urn1:a>'
                        .'</urn1:action>'
                    .'</urn1:ContactActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
