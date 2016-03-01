<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\DocumentActionOp;
use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;
use Zimbra\Mail\Request\DocumentAction;
use Zimbra\Mail\Struct\DocumentActionGrant;
use Zimbra\Mail\Struct\DocumentActionSelector;

/**
 * Testcase class for DocumentAction.
 */
class DocumentActionTest extends ZimbraMailApiTestCase
{
    public function testDocumentActionRequest()
    {
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
        $expiry = mt_rand(1, 100);

        $grant = new DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), $expiry
        );
        $action = new DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, $zid, $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );

        $req = new DocumentAction(
            $action
        );
        $this->assertSame($action, $req->getAction());
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DocumentActionRequest>'
                .'<action op="' . DocumentActionOp::WATCH() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" zid="' . $zid . '">'
                    .'<grant perm="' . DocumentPermission::READ() . '" gt="' . DocumentGrantType::ALL() . '" expiry="' . $expiry . '" />'
                .'</action>'
            .'</DocumentActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DocumentActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDocumentActionApi()
    {
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
        $expiry = mt_rand(1, 100);

        $grant = new DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), $expiry
        );
        $action = new DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, $zid, $id, $tcon, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames
        );

        $this->api->documentAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DocumentActionRequest>'
                        .'<urn1:action op="' . DocumentActionOp::WATCH() . '" id="' . $id . '" tcon="' . $tcon . '" tag="' . $tag . '" l="' . $folder . '" rgb="' . $rgb . '" color="' . $color . '" name="' . $name . '" f="' . $flags . '" t="' . $tags . '" tn="' . $tagNames . '" zid="' . $zid . '">'
                            .'<urn1:grant perm="' . DocumentPermission::READ() . '" gt="' . DocumentGrantType::ALL() . '" expiry="' . $expiry . '" />'
                        .'</urn1:action>'
                    .'</urn1:DocumentActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
