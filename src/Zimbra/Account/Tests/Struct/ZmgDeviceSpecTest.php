<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\ZmgDeviceSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZmgDeviceSpec.
 */
class ZmgDeviceSpecTest extends ZimbraStructTestCase
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($device, 'xml'));
        $this->assertEquals($device, $this->serializer->deserialize($xml, ZmgDeviceSpec::class, 'xml'));

        $json = json_encode([
            'appId' => $appId,
            'registrationId' => $registrationId,
            'pushProvider' => $pushProvider,
            'osName' => $osName,
            'osVersion' => $osVersion,
            'maxPayloadSize' => $maxPayloadSize,
        ]);
        $this->assertSame($json, $this->serializer->serialize($device, 'json'));
        $this->assertEquals($device, $this->serializer->deserialize($json, ZmgDeviceSpec::class, 'json'));
    }
}
