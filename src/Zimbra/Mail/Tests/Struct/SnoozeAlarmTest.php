<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SnoozeAlarm;

/**
 * Testcase class for SnoozeAlarm.
 */
class SnoozeAlarmTest extends ZimbraMailTestCase
{
    public function testSnoozeAlarm()
    {
        $id = $this->faker->uuid;
        $until = mt_rand(1, 100);
        $alarm = new SnoozeAlarm($id, $until);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($until, $alarm->getSnoozeUntil());

        $alarm = new SnoozeAlarm('', 0);
        $alarm->setId($id)
              ->setSnoozeUntil($until);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($until, $alarm->getSnoozeUntil());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<alarm id="' . $id . '" until="' . $until . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'id' => $id,
                'until' => $until,
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }
}
