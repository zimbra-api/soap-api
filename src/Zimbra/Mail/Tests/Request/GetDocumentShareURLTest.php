<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\GetDocumentShareURL;
use Zimbra\Mail\Struct\ItemSpec;

/**
 * Testcase class for GetDocumentShareURL.
 */
class GetDocumentShareURLTest extends ZimbraMailApiTestCase
{
    public function testGetDocumentShareURLRequest()
    {
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $name = $this->faker->word;
        $path = $this->faker->word;
        $item = new ItemSpec(
            $id, $folder, $name, $path
        );

        $req = new GetDocumentShareURL(
            $item
        );
        $this->assertSame($item, $req->getItem());

        $req->setItem($item);
        $this->assertSame($item, $req->getItem());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDocumentShareURLRequest>'
                .'<item id="' . $id . '" l="' . $folder . '" name="' . $name . '" path="' . $path . '" />'
            .'</GetDocumentShareURLRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDocumentShareURLRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'item' => array(
                    'id' => $id,
                    'l' => $folder,
                    'name' => $name,
                    'path' => $path,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDocumentShareURLApi()
    {
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $name = $this->faker->word;
        $path = $this->faker->word;
        $item = new ItemSpec(
            $id, $folder, $name, $path
        );

        $this->api->getDocumentShareURL(
            $item
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetDocumentShareURLRequest>'
                        .'<urn1:item id="' . $id . '" l="' . $folder . '" name="' . $name . '" path="' . $path . '" />'
                    .'</urn1:GetDocumentShareURLRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
