<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAggregateQuotaUsageOnServer;

/**
 * Testcase class for GetAggregateQuotaUsageOnServer.
 */
class GetAggregateQuotaUsageOnServerTest extends ZimbraAdminApiTestCase
{
    public function testGetAggregateQuotaUsageOnServerRequest()
    {
        $req = new \Zimbra\Admin\Request\GetAggregateQuotaUsageOnServer();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAggregateQuotaUsageOnServerRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAggregateQuotaUsageOnServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAggregateQuotaUsageOnServerApi()
    {
        $this->api->getAggregateQuotaUsageOnServer();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAggregateQuotaUsageOnServerRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
