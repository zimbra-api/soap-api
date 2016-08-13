<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RevokeOtherTrustedDevices;

/**
 * Testcase class for RevokeOtherTrustedDevices.
 */
class RevokeOtherTrustedDevicesTest extends ZimbraAccountApiTestCase
{
    public function testRevokeOtherTrustedDevicesRequest()
    {
        $req = new RevokeOtherTrustedDevices;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeOtherTrustedDevicesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeOtherTrustedDevicesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeOtherTrustedDevicesApi()
    {
        $this->api->revokeOtherTrustedDevices();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RevokeOtherTrustedDevicesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
