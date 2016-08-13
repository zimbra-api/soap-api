<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RevokeTrustedDevice;

/**
 * Testcase class for RevokeTrustedDevice.
 */
class RevokeTrustedDeviceTest extends ZimbraAccountApiTestCase
{
    public function testRevokeTrustedDeviceRequest()
    {
        $req = new RevokeTrustedDevice;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeTrustedDeviceRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeTrustedDeviceRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeTrustedDeviceApi()
    {
        $this->api->revokeTrustedDevice();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RevokeTrustedDeviceRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
