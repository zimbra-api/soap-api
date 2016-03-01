<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetWorkingHours;

/**
 * Testcase class for GetWorkingHours.
 */
class GetWorkingHoursTest extends ZimbraMailApiTestCase
{
    public function testGetWorkingHoursRequest()
    {
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $req = new GetWorkingHours(
            $s, $e, $id, $name
        );
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());

        $req = new GetWorkingHours(0, 0);
        $req->setStartTime($s)
            ->setEndTime($e)
            ->setId($id)
            ->setName($name);
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWorkingHoursRequest s="' . $s . '" e="' . $e . '" id="' . $id . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWorkingHoursRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $s,
                'e' => $e,
                'id' => $id,
                'name' => $name,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWorkingHoursApi()
    {
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $this->api->getWorkingHours($s, $e, $id, $name);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWorkingHoursRequest s="' . $s . '" e="' . $e . '" id="' . $id . '" name="' . $name . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
