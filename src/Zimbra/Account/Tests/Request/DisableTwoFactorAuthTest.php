<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\DisableTwoFactorAuth;

/**
 * Testcase class for DisableTwoFactorAuth.
 */
class DisableTwoFactorAuthTest extends ZimbraAccountApiTestCase
{
    public function testGetAllLocalesRequest()
    {
        $req = new DisableTwoFactorAuth;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DisableTwoFactorAuthRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DisableTwoFactorAuthRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllLocalesApi()
    {
        $this->api->disableTwoFactorAuth();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DisableTwoFactorAuthRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
