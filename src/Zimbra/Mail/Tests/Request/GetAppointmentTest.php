<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetAppointment;

/**
 * Testcase class for GetAppointment.
 */
class GetAppointmentTest extends ZimbraMailApiTestCase
{
    public function testGetAppointmentRequest()
    {
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $req = new \Zimbra\Mail\Request\GetAppointment(
            true, true, true, $uid, $id
        );
        $this->assertTrue($req->getSync());
        $this->assertTrue($req->getIncludeContent());
        $this->assertTrue($req->getIncludeInvites());
        $this->assertSame($uid, $req->getUid());
        $this->assertSame($id, $req->getId());

        $req = new GetAppointment();
        $req->setSync(true)
            ->setIncludeContent(true)
            ->setIncludeInvites(true)
            ->setUid($uid)
            ->setId($id);
        $this->assertTrue($req->getSync());
        $this->assertTrue($req->getIncludeContent());
        $this->assertTrue($req->getIncludeInvites());
        $this->assertSame($uid, $req->getUid());
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAppointmentRequest sync="true" includeContent="true" includeInvites="true" uid="' . $uid . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAppointmentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'sync' => true,
                'includeContent' => true,
                'includeInvites' => true,
                'uid' => $uid,
                'id' => $id,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAppointmentApi()
    {
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $this->api->getAppointment(true, true, true, $uid, $id);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetAppointmentRequest sync="true" includeContent="true" includeInvites="true" uid="' . $uid . '" id="' . $id . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
