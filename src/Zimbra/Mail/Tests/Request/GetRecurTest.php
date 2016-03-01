<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetRecur;

/**
 * Testcase class for GetRecur.
 */
class GetRecurTest extends ZimbraMailApiTestCase
{
    public function testGetRecurRequest()
    {
        $id = $this->faker->uuid;
        $req = new GetRecur($id);
        $this->assertSame($id, $req->getId());
        $req = new GetRecur('');
        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetRecurRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetRecurRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRecurApi()
    {
        $id = $this->faker->uuid;
        $this->api->getRecur($id);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetRecurRequest id="' . $id . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
