<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\GetVoiceFolder;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\PrefSpec;
use Zimbra\Voice\Struct\PhoneSpec;

/**
 * Testcase class for GetVoiceFolder.
 */
class GetVoiceFolderTest extends ZimbraVoiceApiTestCase
{
    public function testGetVoiceFolderRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new PrefSpec($name);
        $phone = new PhoneSpec($name, [$pref]);

        $req = new GetVoiceFolder(
            $storeprincipal, [$phone]
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame([$phone], $req->getPhones()->all());
        $req->setStorePrincipal($storeprincipal)
            ->addPhone($phone);
        $this->assertSame($storeprincipal, $req->getStorePrincipal());
        $this->assertSame([$phone, $phone], $req->getPhones()->all());
        $req->getPhones()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceFolderRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '" />'
                .'</phone>'
            .'</GetVoiceFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceFolderRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    [
                        'name' => $name,
                        'pref' => [
                            [
                                'name' => $name,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceFolderApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new PrefSpec($name);
        $phone = new PhoneSpec($name, [$pref]);

        $this->api->getVoiceFolder($storeprincipal, [$phone]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceFolderRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
