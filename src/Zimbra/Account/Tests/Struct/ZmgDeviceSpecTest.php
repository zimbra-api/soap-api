<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\ZmgDeviceSpec;

/**
 * Testcase class for ZmgDeviceSpec.
 */
class ZmgDeviceSpecTest extends ZimbraAccountTestCase
{
    public function testZmgDeviceSpec()
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
        $this->assertSame($appId, $device->getAppId());
        $this->assertSame($registrationId, $device->getRegistrationId());
        $this->assertSame($pushProvider, $device->getPushProvider());
        $this->assertSame($osName, $device->getOsName());
        $this->assertSame($osVersion, $device->getOsVersion());
        $this->assertSame($maxPayloadSize, $device->getMaxPayloadSize());

        $device = new ZmgDeviceSpec(
            '', '', ''
        );
        $device->setAppId($appId)
            ->setRegistrationId($registrationId)
            ->setPushProvider($pushProvider)
            ->setOsName($osName)
            ->setOsVersion($osVersion)
            ->setMaxPayloadSize($maxPayloadSize);
        $this->assertSame($appId, $device->getAppId());
        $this->assertSame($registrationId, $device->getRegistrationId());
        $this->assertSame($pushProvider, $device->getPushProvider());
        $this->assertSame($osName, $device->getOsName());
        $this->assertSame($osVersion, $device->getOsVersion());
        $this->assertSame($maxPayloadSize, $device->getMaxPayloadSize());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zmgDevice appId="' . $appId . '" registrationId="' . $registrationId . '" pushProvider="' . $pushProvider . '" osName="' . $osName . '" osVersion="' . $osVersion . '" maxPayloadSize="' . $maxPayloadSize . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = [
            'zmgDevice' => [
                'appId' => $appId,
                'registrationId' => $registrationId,
                'pushProvider' => $pushProvider,
                'osName' => $osName,
                'osVersion' => $osVersion,
                'maxPayloadSize' => $maxPayloadSize,
            ],
        ];
        $this->assertEquals($array, $device->toArray());
    }
}
