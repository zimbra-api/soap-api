<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetWatchers;

/**
 * Testcase class for GetWatchers.
 */
class GetWatchersTest extends ZimbraMailApiTestCase
{
    public function testGetWatchersRequest()
    {
        $req = new GetWatchers();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWatchersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWatchersRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWatchersApi()
    {
        $this->api->getWatchers();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWatchersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
