<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetAvailableSkins;

/**
 * Testcase class for GetAvailableSkins.
 */
class GetAvailableSkinsTest extends ZimbraAccountApiTestCase
{
    public function testGetAvailableSkinsRequest()
    {
        $req = new GetAvailableSkins;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAvailableSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAvailableSkinsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableSkinsApi()
    {
        $this->api->getAvailableSkins();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAvailableSkinsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
