<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetICal;

/**
 * Testcase class for GetICal.
 */
class GetICalTest extends ZimbraMailApiTestCase
{
    public function testGetICalRequest()
    {
        $id = $this->faker->uuid;
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);

        $req = new GetICal(
            $id, $s, $e
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());

        $req = new GetICal();
        $req->setStartTime($s)
            ->setEndTime($e)
            ->setId($id);
        $this->assertSame($id, $req->getId());
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetICalRequest id="' . $id . '" s="' . $s . '" e="' . $e . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetICalRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
                's' => $s,
                'e' => $e,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetICalApi()
    {
        $id = $this->faker->uuid;
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $this->api->getICal(
            $id, $s, $e
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetICalRequest id="' . $id . '" s="' . $s . '" e="' . $e . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
