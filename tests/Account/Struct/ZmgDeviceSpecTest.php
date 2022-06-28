<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\ZmgDeviceSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZmgDeviceSpec.
 */
class ZmgDeviceSpecTest extends ZimbraTestCase
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

        $device = new ZmgDeviceSpec();
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result appId="$appId" registrationId="$registrationId" pushProvider="$pushProvider" osName="$osName" osVersion="$osVersion" maxPayloadSize="$maxPayloadSize" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($device, 'xml'));
        $this->assertEquals($device, $this->serializer->deserialize($xml, ZmgDeviceSpec::class, 'xml'));
    }
}
