<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetWhiteBlackList;

/**
 * Testcase class for GetWhiteBlackList.
 */
class GetWhiteBlackListTest extends ZimbraAccountApiTestCase
{
    public function testGetWhiteBlackListRequest()
    {
        $req = new GetWhiteBlackList;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetWhiteBlackListRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetWhiteBlackListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWhiteBlackListApi()
    {
        $this->api->getWhiteBlackList();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetWhiteBlackListRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
