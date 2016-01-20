<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetShareDetails;
use Zimbra\Struct\Id;

/**
 * Testcase class for GetShareDetails.
 */
class GetShareDetailsTest extends ZimbraMailApiTestCase
{
    public function testGetShareDetailsRequest()
    {
        $id = $this->faker->uuid;
        $item = new Id($id);
        $req = new GetShareDetails(
            $item
        );
        $this->assertSame($item, $req->getItem());
        $req->setItem($item);
        $this->assertSame($item, $req->getItem());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetShareDetailsRequest>'
                .'<item id="' . $id . '" />'
            .'</GetShareDetailsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetShareDetailsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'item' => array(
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareDetailsApi()
    {
        $id = $this->faker->uuid;
        $item = new Id($id);
        $this->api->getShareDetails(
            $item
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetShareDetailsRequest>'
                        .'<urn1:item id="' . $id . '" />'
                    .'</urn1:GetShareDetailsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
