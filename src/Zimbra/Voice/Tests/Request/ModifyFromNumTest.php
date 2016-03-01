<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\ModifyFromNum;
use Zimbra\Voice\Struct\StorePrincipalSpec;
use Zimbra\Voice\Struct\ModifyFromNumSpec;

/**
 * Testcase class for ModifyFromNum.
 */
class ModifyFromNumTest extends ZimbraVoiceApiTestCase
{
    public function testModifyFromNumRequest()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPhone = $this->faker->word;
        $newPhone = $this->faker->word;
        $label = $this->faker->word;
        $phone = new ModifyFromNumSpec(
            $oldPhone, $newPhone, $id, $label
        );

        $req = new ModifyFromNum(
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
            .'<ModifyFromNumRequest>'
                .'<storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                .'<phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />'
            .'</ModifyFromNumRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyFromNumRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'storeprincipal' => [
                    'id' => $id,
                    'name' => $name,
                    'accountNumber' => $accountNumber,
                ],
                'phone' => [
                    'oldPhone' => $oldPhone,
                    'phone' => $newPhone,
                    'id' => $id,
                    'label' => $label,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyFromNumApi()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $accountNumber = $this->faker->word;
        $storeprincipal = new StorePrincipalSpec(
            $id, $name, $accountNumber
        );

        $oldPhone = $this->faker->word;
        $newPhone = $this->faker->word;
        $label = $this->faker->word;
        $phone = new ModifyFromNumSpec(
            $oldPhone, $newPhone, $id, $label
        );

        $this->api->modifyFromNum($storeprincipal, $phone);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ModifyFromNumRequest>'
                        .'<urn1:storeprincipal id="' . $id . '" name="' . $name . '" accountNumber="' . $accountNumber . '" />'
                        .'<urn1:phone oldPhone="' . $oldPhone . '" phone="' . $newPhone . '" id="' . $id . '" label="' . $label . '" />'
                    .'</urn1:ModifyFromNumRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
