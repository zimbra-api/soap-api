<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllSkins;

/**
 * Testcase class for GetAllSkins.
 */
class GetAllSkinsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllSkinsRequest()
    {
        $req = new \Zimbra\Admin\Request\GetAllSkins();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllSkinsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllSkinsApi()
    {
        $this->api->getAllSkins();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllSkinsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
