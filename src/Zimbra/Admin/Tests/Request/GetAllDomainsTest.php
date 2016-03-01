<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllDomains;

/**
 * Testcase class for GetAllDomains.
 */
class GetAllDomainsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllDomainsRequest()
    {
        $req = new GetAllDomains(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getApplyConfig());
        $req->setApplyConfig(true);
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllDomainsRequest applyConfig="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllDomainsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDomainsApi()
    {
        $this->api->getAllDomains(true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllDomainsRequest applyConfig="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
