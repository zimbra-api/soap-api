<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetMailboxStats;

/**
 * Testcase class for GetMailboxStats.
 */
class GetMailboxStatsTest extends ZimbraAdminApiTestCase
{
    public function testGetMailboxStatsRequest()
    {
        $req = new \Zimbra\Admin\Request\GetMailboxStats();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailboxStatsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailboxStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxStatsApi()
    {
        $this->api->getMailboxStats();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailboxStatsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
