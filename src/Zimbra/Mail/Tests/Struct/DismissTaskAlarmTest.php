<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DismissTaskAlarm;

/**
 * Testcase class for DismissTaskAlarm.
 */
class DismissTaskAlarmTest extends ZimbraMailTestCase
{
    public function testDismissTaskAlarm()
    {
        $id = $this->faker->word;
        $at = mt_rand(1, 100);

        $task = new DismissTaskAlarm($id, $at);
        $this->assertInstanceOf('Zimbra\Mail\Struct\DismissAlarm', $task);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<task id="' . $id . '" dismissedAt="' . $at . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $task);

        $array = array(
            'task' => array(
                'id' => $id,
                'dismissedAt' => $at,
            ),
        );
        $this->assertEquals($array, $task->toArray());
    }
}
