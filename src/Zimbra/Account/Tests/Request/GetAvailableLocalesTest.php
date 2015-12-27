<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetAvailableLocales;

/**
 * Testcase class for GetAvailableLocales.
 */
class GetAvailableLocalesTest extends ZimbraAccountApiTestCase
{
    public function testGetAvailableLocalesRequest()
    {
        $req = new GetAvailableLocales;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAvailableLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAvailableLocalesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAvailableLocalesApi()
    {
        $this->api->getAvailableLocales();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAvailableLocalesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
