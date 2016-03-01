<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SnoozeAppointmentAlarm;

/**
 * Testcase class for SnoozeAppointmentAlarm.
 */
class SnoozeAppointmentAlarmTest extends ZimbraMailTestCase
{
    public function testSnoozeAppointmentAlarm()
    {
        $id = $this->faker->uuid;
        $until = mt_rand(1, 100);
        $appt = new SnoozeAppointmentAlarm($id, $until);
        $this->assertInstanceOf('Zimbra\Mail\Struct\SnoozeAlarm', $appt);
    }
}
