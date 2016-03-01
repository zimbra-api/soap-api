<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DismissAppointmentAlarm;

/**
 * Testcase class for DismissAppointmentAlarm.
 */
class DismissAppointmentAlarmTest extends ZimbraMailTestCase
{
    public function testDismissAppointmentAlarm()
    {
        $id = $this->faker->word;
        $at = mt_rand(1, 100);

        $appt = new DismissAppointmentAlarm($id, $at);
        $this->assertInstanceOf('Zimbra\Mail\Struct\DismissAlarm', $appt);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<appt id="' . $id . '" dismissedAt="' . $at . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $appt);

        $array = array(
            'appt' => array(
                'id' => $id,
                'dismissedAt' => $at,
            ),
        );
        $this->assertEquals($array, $appt->toArray());
    }
}
