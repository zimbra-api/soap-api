<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\RegisterDevice;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for RegisterDevice.
 */
class RegisterDeviceTest extends ZimbraMailApiTestCase
{
    public function testRegisterDeviceRequest()
    {
        $name = $this->faker->word;
        $device = new NamedElement($name);

        $req = new RegisterDevice(
            $device
        );
        $this->assertSame($device, $req->getDevice());

        $req = new RegisterDevice(
            new NamedElement('')
        );
        $req->setDevice($device);
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RegisterDeviceRequest>'
                .'<device name="' . $name . '" />'
            .'</RegisterDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RegisterDeviceRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'device' => array(
                    'name' => $name,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRegisterDeviceApi()
    {
        $name = $this->faker->word;
        $device = new NamedElement($name);
        $this->api->registerDevice(
            $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RegisterDeviceRequest>'
                        .'<urn1:device name="' . $name . '" />'
                    .'</urn1:RegisterDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
