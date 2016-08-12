<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetScratchCodes;

/**
 * Testcase class for GetScratchCodes.
 */
class GetScratchCodesTest extends ZimbraAccountApiTestCase
{
    public function testGetScratchCodesRequest()
    {
        $req = new GetScratchCodes;
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetScratchCodesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetScratchCodesRequest' => [
                '_jsns' => 'urn:zimbraAccount',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetScratchCodesApi()
    {
        $this->api->getScratchCodes();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetScratchCodesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
