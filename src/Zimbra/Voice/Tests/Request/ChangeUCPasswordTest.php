<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\ChangeUCPassword;

/**
 * Testcase class for ChangeUCPassword.
 */
class ChangeUCPasswordTest extends ZimbraVoiceApiTestCase
{
    public function testChangeUCPasswordRequest()
    {
        $password = $this->faker->word;
        $req = new ChangeUCPassword(
            $password
        );
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);
        $this->assertSame($password, $req->getPassword());
        $req->setPassword($password);
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ChangeUCPasswordRequest password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ChangeUCPasswordRequest' => [
                '_jsns' => 'urn:zimbraVoice',
                'password' =>$password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testChangeUCPasswordApi()
    {
        $password = $this->faker->word;
        $this->api->changeUCPassword(
            $password
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:ChangeUCPasswordRequest '
                        .'password="' . $password . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
