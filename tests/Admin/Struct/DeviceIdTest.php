<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DeviceId;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeviceId.
 */
class DeviceIdTest extends ZimbraTestCase
{
    public function testDeviceId()
    {
        $id = $this->faker->uuid;
        $device = new DeviceId($id);
        $this->assertSame($id, $device->getId());

        $device = new DeviceId('');
        $device->setId($id);
        $this->assertSame($id, $device->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($device, 'xml'));
        $this->assertEquals($device, $this->serializer->deserialize($xml, DeviceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($device, 'json'));
        $this->assertEquals($device, $this->serializer->deserialize($json, DeviceId::class, 'json'));
    }
}
