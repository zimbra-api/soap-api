<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\ModifyVoiceMailPrefs;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\PrefInfo;
use Zimbra\Voice\Struct\PhoneInfo;

/**
 * Testcase class for ModifyVoiceMailPrefs.
 */
class ModifyVoiceMailPrefsTest extends ZimbraVoiceApiTestCase
{
    public function testModifyVoiceMailPrefsRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $value = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new PrefInfo($name, $value);
        $phone = new PhoneInfo($name, [$pref]);

        $req = new ModifyVoiceMailPrefs(
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
            .'<ModifyVoiceMailPrefsRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone name="' . $name . '">'
                    .'<pref name="' . $name . '">' . $value . '</pref>'
                .'</phone>'
            .'</ModifyVoiceMailPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVoiceMailPrefsRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'name' => $name,
                    'pref' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceMailPrefsApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $value = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );
        $pref = new PrefInfo($name, $value);
        $phone = new PhoneInfo($name, [$pref]);

        $this->api->modifyVoiceMailPrefs($storeprincipal, $phone);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyVoiceMailPrefsRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone name="' . $name . '">'
                            .'<urn1:pref name="' . $name . '">' . $value . '</urn1:pref>'
                        .'</urn1:phone>'
                    .'</urn1:ModifyVoiceMailPrefsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
