<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DeviceId;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeviceId.
 */
class DeviceIdTest extends ZimbraStructTestCase
{
    public function testDeviceId()
    {
        $id = $this->faker->uuid;
        $device = new DeviceId($id);
        $this->assertSame($id, $device->getId());

        $device = new DeviceId('');
        $device->setId($id);
        $this->assertSame($id, $device->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($device, 'xml'));
        $this->assertEquals($device, $this->serializer->deserialize($xml, DeviceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($device, 'json'));
        $this->assertEquals($device, $this->serializer->deserialize($json, DeviceId::class, 'json'));
    }
}
