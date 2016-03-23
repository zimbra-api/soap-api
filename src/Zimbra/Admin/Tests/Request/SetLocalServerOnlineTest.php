<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SetLocalServerOnline;

/**
 * Testcase class for SetLocalServerOnline.
 */
class SetLocalServerOnlineTest extends ZimbraAdminApiTestCase
{
    public function testSetLocalServerOnlineRequest()
    {
        $req = new \Zimbra\Admin\Request\SetLocalServerOnline();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetLocalServerOnlineRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetLocalServerOnlineRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetLocalServerOnlineApi()
    {
        $this->api->setLocalServerOnline();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetLocalServerOnlineRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
