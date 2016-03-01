<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\DeleteDevice;
use Zimbra\Struct\Id;

/**
 * Testcase class for DeleteDevice.
 */
class DeleteDeviceTest extends ZimbraMailApiTestCase
{
    public function testDeleteDeviceRequest()
    {
        $id = $this->faker->uuid;
        $device = new Id($id);
        $req = new DeleteDevice(
            $device
        );
        $this->assertSame($device, $req->getDevice());

        $req = new DeleteDevice(
            new Id('')
        );
        $req->setDevice($device);
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDeviceRequest>'
                .'<device id="' . $id . '" />'
            .'</DeleteDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDeviceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'device' => array(
                    'id' => $id,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDeviceApi()
    {
        $id = $this->faker->uuid;
        $device = new Id($id);
        $this->api->deleteDevice(
            $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeleteDeviceRequest>'
                        .'<urn1:device id="' . $id . '" />'
                    .'</urn1:DeleteDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
