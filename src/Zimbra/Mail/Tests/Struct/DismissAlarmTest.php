<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DismissAlarm;

/**
 * Testcase class for DismissAlarm.
 */
class DismissAlarmTest extends ZimbraMailTestCase
{
    public function testDismissAlarm()
    {
        $id = $this->faker->word;
        $at = mt_rand(1, 100);

        $alarm = new DismissAlarm($id, $at);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($at, $alarm->getDismissedAt());

        $alarm->setId($id)
              ->setDismissedAt($at);
        $this->assertSame($id, $alarm->getId());
        $this->assertSame($at, $alarm->getDismissedAt());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<alarm id="' . $id . '" dismissedAt="' . $at . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'id' => $id,
                'dismissedAt' => $at,
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }
}
