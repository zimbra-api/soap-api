<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\ModifyVoiceMailPin;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\ModifyVoiceMailPinSpec;

/**
 * Testcase class for ModifyVoiceMailPin.
 */
class ModifyVoiceMailPinTest extends ZimbraVoiceApiTestCase
{
    public function testModifyVoiceMailPinRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPin = $this->faker->word;
        $pin = $this->faker->word;
        $phone = new ModifyVoiceMailPinSpec(
            $oldPin, $pin, $name
        );

        $req = new ModifyVoiceMailPin(
            $storeprincipal, $phone
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($phone, $req->getPhone());
        $req->setStorePrincipal($storeprincipal)
            ->setPhone($phone);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($phone, $req->getPhone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVoiceMailPinRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />'
            .'</ModifyVoiceMailPinRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVoiceMailPinRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'oldPin' => $oldPin,
                    'pin' => $pin,
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceMailPinApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPin = $this->faker->word;
        $pin = $this->faker->word;
        $phone = new ModifyVoiceMailPinSpec(
            $oldPin, $pin, $name
        );

        $this->api->modifyVoiceMailPin($storeprincipal, $phone);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPinRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone oldPin="' . $oldPin . '" pin="' . $pin . '" name="' . $name . '" />'
                    .'</urn1:ModifyVoiceMailPinRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
