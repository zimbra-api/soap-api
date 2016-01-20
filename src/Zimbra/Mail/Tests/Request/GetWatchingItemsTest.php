<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetWatchingItems;

/**
 * Testcase class for GetWatchingItems.
 */
class GetWatchingItemsTest extends ZimbraMailApiTestCase
{
    public function testGetWatchingItemsRequest()
    {
        $req = new GetWatchingItems();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWatchingItemsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWatchingItemsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWatchingItemsApi()
    {
        $this->api->getWatchingItems();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWatchingItemsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
