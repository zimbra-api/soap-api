<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllAdminAccounts;

/**
 * Testcase class for GetAllAdminAccounts.
 */
class GetAllAdminAccountsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllAdminAccountsRequest()
    {
        $req = new GetAllAdminAccounts(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getApplyCos());
        $req->setApplyCos(true);
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAdminAccountsRequest applyCos="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAdminAccountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAdminAccountsApi()
    {
        $this->api->getAllAdminAccounts(true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAdminAccountsRequest applyCos="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
