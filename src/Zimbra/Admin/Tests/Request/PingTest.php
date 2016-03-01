<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\Ping;

/**
 * Testcase class for Ping.
 */
class PingTest extends ZimbraAdminApiTestCase
{
    public function testPingRequest()
    {
        $req = new \Zimbra\Admin\Request\Ping();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PingRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PingRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPingApi()
    {
        $this->api->ping();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PingRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
