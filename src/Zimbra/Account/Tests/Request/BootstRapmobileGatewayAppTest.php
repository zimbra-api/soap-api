<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\BootstrapMobileGatewayApp;

/**
 * Testcase class for BootstrapMobileGatewayApp.
 */
class BootstRapmobileGatewayAppTest extends ZimbraAccountApiTestCase
{
    public function testBootstrapMobileGatewayAppRequest()
    {
        $req = new BootstrapMobileGatewayApp(false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertFalse($req->getWantAppToken());

        $req->setWantAppToken(true);
        $this->assertTrue($req->getWantAppToken());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<BootstrapMobileGatewayAppRequest wantAppToken="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'BootstrapMobileGatewayAppRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'wantAppToken' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testBootstRapmobileGatewayAppApi()
    {
        $this->api->bootstrapMobileGatewayApp(
            true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:BootstrapMobileGatewayAppRequest wantAppToken="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
