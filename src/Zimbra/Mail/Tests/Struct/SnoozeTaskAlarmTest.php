<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SnoozeTaskAlarm;

/**
 * Testcase class for SnoozeTaskAlarm.
 */
class SnoozeTaskAlarmTest extends ZimbraMailTestCase
{
    public function testSnoozeTaskAlarm()
    {
        $id = $this->faker->uuid;
        $until = mt_rand(1, 100);
        $task = new SnoozeTaskAlarm($id, $until);
        $this->assertInstanceOf('Zimbra\Mail\Struct\SnoozeAlarm', $task);
    }
}
