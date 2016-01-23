<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\UpdateDeviceStatus;
use Zimbra\Mail\Struct\IdStatus;

/**
 * Testcase class for UpdateDeviceStatus.
 */
class MailUpdateDeviceStatusTest extends ZimbraMailApiTestCase
{
    public function testUpdateDeviceStatusRequest()
    {
        $id = $this->faker->uuid;
        $status = $this->faker->word;
        $device = new IdStatus($id, $status);

        $req = new UpdateDeviceStatus(
            $device
        );
        $this->assertSame($device, $req->getDevice());

        $req = new UpdateDeviceStatus(
            new IdStatus('', '')
        );
        $req->setDevice($device);
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UpdateDeviceStatusRequest>'
                .'<device id="' . $id . '" status="' . $status . '" />'
            .'</UpdateDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UpdateDeviceStatusRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'device' => array(
                    'id' => $id,
                    'status' => $status,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdateDeviceStatusApi()
    {
        $id = $this->faker->uuid;
        $status = $this->faker->word;
        $device = new IdStatus($id, $status);
        $this->api->updateDeviceStatus(
            $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:UpdateDeviceStatusRequest>'
                        .'<urn1:device id="' . $id . '" status="' . $status . '" />'
                    .'</urn1:UpdateDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
