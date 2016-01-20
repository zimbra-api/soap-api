<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetItem;
use Zimbra\Mail\Struct\ItemSpec;

/**
 * Testcase class for GetItem.
 */
class GetItemTest extends ZimbraMailApiTestCase
{
    public function testGetItemRequest()
    {
        $id = $this->faker->uuid;
        $l = $this->faker->word;
        $name = $this->faker->word;
        $path = $this->faker->word;
        $item = new ItemSpec(
            $id, $l, $name, $path
        );

        $req = new GetItem(
            $item
        );
        $this->assertSame($item, $req->getItem());
        $req->setItem($item);
        $this->assertSame($item, $req->getItem());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetItemRequest>'
                .'<item id="' . $id . '" l="' . $l . '" name="' . $name . '" path="' . $path . '" />'
            .'</GetItemRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetItemRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'item' => array(
                    'id' => $id,
                    'l' => $l,
                    'name' => $name,
                    'path' => $path,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetItemApi()
    {
        $id = $this->faker->uuid;
        $l = $this->faker->word;
        $name = $this->faker->word;
        $path = $this->faker->word;
        $item = new ItemSpec(
            $id, $l, $name, $path
        );

        $this->api->getItem(
            $item
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetItemRequest>'
                        .'<urn1:item id="' . $id . '" l="' . $l . '" name="' . $name . '" path="' . $path . '" />'
                    .'</urn1:GetItemRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
