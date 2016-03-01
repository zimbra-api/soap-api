<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetTag;

/**
 * Testcase class for GetTag.
 */
class GetTagTest extends ZimbraMailApiTestCase
{
    public function testGetTagRequest()
    {
        $req = new GetTag();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTagRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTagRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTagApi()
    {
        $this->api->getTag();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetTagRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
