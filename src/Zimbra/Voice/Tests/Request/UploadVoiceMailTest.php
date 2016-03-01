<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\UploadVoiceMail;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\VoiceMsgUploadSpec;

/**
 * Testcase class for UploadVoiceMail.
 */
class UploadVoiceMailTest extends ZimbraVoiceApiTestCase
{
    public function testUploadVoiceMailRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $phone = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $vm = new VoiceMsgUploadSpec(
            $id, $phone
        );

        $req = new UploadVoiceMail(
            $storeprincipal, $vm
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($vm, $req->getVoiceMsg());
        $req->setStorePrincipal($storeprincipal)
            ->setVoiceMsg($vm);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame($vm, $req->getVoiceMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UploadVoiceMailRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<vm id="' . $id . '" phone="' . $phone . '" />'
            .'</UploadVoiceMailRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadVoiceMailRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'vm' => [
                    'id' => $id,
                    'phone' => $phone,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadVoiceMailApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $phone = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $vm = new VoiceMsgUploadSpec(
            $id, $phone
        );

        $this->api->uploadVoiceMail($storeprincipal, $vm);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:UploadVoiceMailRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:vm id="' . $id . '" phone="' . $phone . '" />'
                    .'</urn1:UploadVoiceMailRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
