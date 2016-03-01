<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\InvalidateReminderDevice;

/**
 * Testcase class for InvalidateReminderDevice.
 */
class InvalidateReminderDeviceTest extends ZimbraMailApiTestCase
{
    public function testInvalidateReminderDeviceRequest()
    {
        $email = $this->faker->email;
        $req = new InvalidateReminderDevice(
            $email
        );
        $this->assertSame($email, $req->getAddress());
        $req = new InvalidateReminderDevice('');
        $req->setAddress($email);
        $this->assertSame($email, $req->getAddress());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<InvalidateReminderDeviceRequest a="' . $email . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'InvalidateReminderDeviceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'a' => $email,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testInvalidateReminderDeviceApi()
    {
        $email = $this->faker->email;
        $this->api->invalidateReminderDevice($email);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:InvalidateReminderDeviceRequest a="' . $email . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
