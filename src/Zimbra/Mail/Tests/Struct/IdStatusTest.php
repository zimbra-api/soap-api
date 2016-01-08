<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\IdStatus;

/**
 * Testcase class for IdStatus.
 */
class IdStatusTest extends ZimbraMailTestCase
{
    public function testIdStatus()
    {
        $id = $this->faker->uuid;
        $status = $this->faker->word;
        $device = new IdStatus(
            $id, $status
        );
        $this->assertSame($id, $device->getId());
        $this->assertSame($status, $device->getStatus());

        $device->setId($id)
               ->setStatus($status);
        $this->assertSame($id, $device->getId());
        $this->assertSame($status, $device->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<device id="' . $id . '" status="' . $status . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = array(
            'device' => array(
                'id' => $id,
                'status' => $status,
            ),
        );
        $this->assertEquals($array, $device->toArray());
    }
}
