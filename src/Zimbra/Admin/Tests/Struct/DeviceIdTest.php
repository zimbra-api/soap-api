<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\DeviceId;

/**
 * Testcase class for DeviceId.
 */
class DeviceIdTest extends ZimbraAdminTestCase
{
    public function testDeviceId()
    {
        $id = $this->faker->uuid;
        $device = new DeviceId($id);
        $this->assertSame($id, $device->getId());

        $device->setId($id);
        $this->assertSame($id, $device->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = [
            'device' => [
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $device->toArray());
    }
}
