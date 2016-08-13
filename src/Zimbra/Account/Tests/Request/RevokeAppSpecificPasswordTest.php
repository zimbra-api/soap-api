<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RevokeAppSpecificPassword;

/**
 * Testcase class for RevokeAppSpecificPassword.
 */
class RevokeAppSpecificPasswordTest extends ZimbraAccountApiTestCase
{
    public function testRevokeAppSpecificPasswordRequest()
    {
        $appName = $this->faker->word;

        $req = new RevokeAppSpecificPassword(
            $appName
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($appName, $req->getAppName());

        $req = new RevokeAppSpecificPassword();
        $req->setAppName($appName);
        $this->assertSame($appName, $req->getAppName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeAppSpecificPasswordRequest appName="' . $appName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeAppSpecificPasswordRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'appName' => $appName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeAppSpecificPasswordApi()
    {
        $appName = $this->faker->word;

        $this->api->revokeAppSpecificPassword(
            $appName
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RevokeAppSpecificPasswordRequest appName="' . $appName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
