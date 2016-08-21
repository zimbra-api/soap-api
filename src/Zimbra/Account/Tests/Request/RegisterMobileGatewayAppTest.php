<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RegisterMobileGatewayApp;
use Zimbra\Account\Struct\ZmgDeviceSpec;

/**
 * Testcase class for RegisterMobileGatewayApp.
 */
class RegisterMobileGatewayAppTest extends ZimbraAccountApiTestCase
{
    public function testRegisterMobileGatewayAppRequest()
    {
        $appId = $this->faker->word;
        $registrationId = $this->faker->word;
        $pushProvider = $this->faker->word;
        $osName = $this->faker->word;
        $osVersion = $this->faker->word;
        $maxPayloadSize = mt_rand(1, 100);

        $device = new ZmgDeviceSpec(
            $appId, $registrationId, $pushProvider, $osName, $osVersion, $maxPayloadSize
        );

        $req = new RegisterMobileGatewayApp($device);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($device, $req->getZmgDevice());

        $req = new RegisterMobileGatewayApp(new ZmgDeviceSpec('', '', ''));
        $req->setZmgDevice($device);
        $this->assertSame($device, $req->getZmgDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RegisterMobileGatewayAppRequest>'
                . '<zmgDevice appId="' . $appId . '" registrationId="' . $registrationId . '" pushProvider="' . $pushProvider . '" osName="' . $osName . '" osVersion="' . $osVersion . '" maxPayloadSize="' . $maxPayloadSize . '" />'
            . '</RegisterMobileGatewayAppRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RegisterMobileGatewayAppRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'zmgDevice' => [
                    'appId' => $appId,
                    'registrationId' => $registrationId,
                    'pushProvider' => $pushProvider,
                    'osName' => $osName,
                    'osVersion' => $osVersion,
                    'maxPayloadSize' => $maxPayloadSize,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRegisterMobileGatewayAppApi()
    {
        $appId = $this->faker->word;
        $registrationId = $this->faker->word;
        $pushProvider = $this->faker->word;
        $osName = $this->faker->word;
        $osVersion = $this->faker->word;
        $maxPayloadSize = mt_rand(1, 100);

        $device = new ZmgDeviceSpec(
            $appId, $registrationId, $pushProvider, $osName, $osVersion, $maxPayloadSize
        );

        $this->api->registerMobileGatewayApp(
            $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RegisterMobileGatewayAppRequest>'
                        . '<urn1:zmgDevice appId="' . $appId . '" registrationId="' . $registrationId . '" pushProvider="' . $pushProvider . '" osName="' . $osName . '" osVersion="' . $osVersion . '" maxPayloadSize="' . $maxPayloadSize . '" />'
                    . '</urn1:RegisterMobileGatewayAppRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
