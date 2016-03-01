<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ComputeAggregateQuotaUsage;

/**
 * Testcase class for ComputeAggregateQuotaUsage.
 */
class ComputeAggregateQuotaUsageTest extends ZimbraAdminApiTestCase
{
    public function testComputeAggregateQuotaUsageRequest()
    {
        $req = new ComputeAggregateQuotaUsage();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ComputeAggregateQuotaUsageRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ComputeAggregateQuotaUsageRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testComputeAggregateQuotaUsageApi()
    {
        $this->api->computeAggregateQuotaUsage();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ComputeAggregateQuotaUsageRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
