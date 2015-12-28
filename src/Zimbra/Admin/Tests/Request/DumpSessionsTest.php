<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DumpSessions;

/**
 * Testcase class for DumpSessions.
 */
class DumpSessionsTest extends ZimbraAdminApiTestCase
{
    public function testDumpSessionsRequest()
    {
        $req = new DumpSessions(false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getListSessions());
        $this->assertTrue($req->getGroupByAccount());

        $req->setListSessions(true)
            ->setGroupByAccount(false);
        $this->assertTrue($req->getListSessions());
        $this->assertFalse($req->getGroupByAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DumpSessionsRequest listSessions="true" groupByAccount="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DumpSessionsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'listSessions' => true,
                'groupByAccount' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDumpSessionsApi()
    {
        $this->api->dumpSessions(
            true, false
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DumpSessionsRequest listSessions="true" groupByAccount="false" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
