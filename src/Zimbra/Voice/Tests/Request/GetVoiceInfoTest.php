<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\GetVoiceInfo;
use Zimbra\Voice\Struct\PrefSpec;
use Zimbra\Voice\Struct\PhoneSpec;

/**
 * Testcase class for GetVoiceInfo.
 */
class GetVoiceInfoTest extends ZimbraVoiceApiTestCase
{
    public function testGetVoiceInfoRequest()
    {
        $name = $this->faker->word;
        $pref = new PrefSpec($name);
        $phone = new PhoneSpec($name, [$pref]);

        $req = new GetVoiceInfo(
            [$phone]
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame([$phone], $req->getPhones()->all());
        $req->addPhone($phone);
        $this->assertSame([$phone, $phone], $req->getPhones()->all());
        $req->getPhones()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceInfoRequest>'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '" />'
                .'</phone>'
            .'</GetVoiceInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVoiceInfoRequest' => [
                '_jsns' => 'urn:zimbraVoice',
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

    public function testGetVoiceInfoApi()
    {
        $name = $this->faker->word;
        $pref = new PrefSpec($name);
        $phone = new PhoneSpec($name, [$pref]);

        $this->api->getVoiceInfo([$phone]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetVoiceInfoRequest>'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '" />'
                        .'</urn1:phone>'
                    .'</urn1:GetVoiceInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
