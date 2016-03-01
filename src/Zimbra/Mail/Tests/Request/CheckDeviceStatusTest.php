<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CheckDeviceStatus;
use Zimbra\Struct\Id;

/**
 * Testcase class for CheckDeviceStatus.
 */
class CheckDeviceStatusTest extends ZimbraMailApiTestCase
{
    public function testCheckDeviceStatusRequest()
    {
        $id = $this->faker->uuid;
        $device = new Id($id);
        $req = new CheckDeviceStatus($device);
        $this->assertSame($device, $req->getDevice());
        $req->setDevice($device);
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckDeviceStatusRequest>'
                .'<device id="' . $id . '" />'
            .'</CheckDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckDeviceStatusRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'device' => array(
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDeviceStatusApi()
    {
        $id = $this->faker->uuid;
        $device = new Id($id);

        $this->api->checkDeviceStatus($device);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckDeviceStatusRequest>'
                        .'<urn1:device id="' . $id . '" />'
                    .'</urn1:CheckDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
