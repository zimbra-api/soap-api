<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllAccountLoggers;

/**
 * Testcase class for GetAllAccountLoggers.
 */
class GetAllAccountLoggersTest extends ZimbraAdminApiTestCase
{
    public function testGetAllAccountLoggersRequest()
    {
        $req = new \Zimbra\Admin\Request\GetAllAccountLoggers();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAccountLoggersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAccountLoggersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAccountLoggersApi()
    {
        $this->api->getAllAccountLoggers();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAccountLoggersRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
