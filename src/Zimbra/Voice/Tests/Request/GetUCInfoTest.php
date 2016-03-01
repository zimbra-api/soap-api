<?php

namespace Zimbra\Voice\Tests\Request;

use Zimbra\Voice\Tests\ZimbraVoiceApiTestCase;
use Zimbra\Voice\Request\GetUCInfo;

/**
 * Testcase class for GetUCInfo.
 */
class GetUCInfoTest extends ZimbraVoiceApiTestCase
{
    public function testGetUCInfoRequest()
    {
        $req = new GetUCInfo();
        $this->assertInstanceOf('Zimbra\Voice\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetUCInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetUCInfoRequest' => [
                '_jsns' => 'urn:zimbraVoice',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCInfoApi()
    {
        $this->api->getUCInfo();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraVoice">'
                .'<env:Body>'
                    .'<urn1:GetUCInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
