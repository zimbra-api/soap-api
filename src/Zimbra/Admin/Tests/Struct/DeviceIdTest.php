<?php

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

        $device = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\DeviceId', 'xml');
        $this->assertSame($id, $device->getId());
    }
}
