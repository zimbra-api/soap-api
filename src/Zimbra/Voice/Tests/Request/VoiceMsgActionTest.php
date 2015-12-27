<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Voice\Request\VoiceMsgAction;
use Zimbra\Voice\Struct\VoiceMsgActionSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * Testcase class for VoiceMsgAction.
 */
class VoiceMsgActionTest extends ZimbraVoiceApiTestCase
{
    public function testVoiceMsgActionRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $phone = $this->faker->word;
        $folderId = $this->faker->word;
        $action = new VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), $phone, $id, $folderId
        );
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $req = new VoiceMsgAction(
            $action, $storeprincipal
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($action, $req->getAction());
        $req->setStorePrincipal($storeprincipal)
            ->setAction($action);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VoiceMsgActionRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />'
            .'</VoiceMsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VoiceMsgActionRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'action' => [
                    'op' => VoiceMsgActionOp::MOVE()->value(),
                    'phone' => $phone,
                    'id' => $id,
                    'l' => $folderId,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVoiceMsgActionApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $phone = $this->faker->word;
        $folderId = $this->faker->word;
        $action = new VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), $phone, $id, $folderId
        );
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $this->api->voiceMsgAction($action, $storeprincipal);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:VoiceMsgActionRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:action op="' . VoiceMsgActionOp::MOVE() . '" phone="' . $phone . '" id="' . $id . '" l="' . $folderId . '" />'
                    .'</urn1:VoiceMsgActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
