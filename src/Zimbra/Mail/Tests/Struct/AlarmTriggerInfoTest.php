<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AlarmTriggerInfo;
use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Mail\Struct\DurationInfo;

/**
 * Testcase class for AlarmTriggerInfo.
 */
class AlarmTriggerInfoTest extends ZimbraMailTestCase
{
    public function testAlarmTriggerInfo()
    {
        $date = $this->faker->iso8601;

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(0, 99);

        $abs = new DateAttr($date);
        $rel = new DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $count);
        $trigger = new AlarmTriggerInfo($abs, $rel);

        $this->assertSame($abs, $trigger->getAbsolute());
        $this->assertSame($rel, $trigger->getRelative());
        $trigger->setAbsolute($abs)
                ->setRelative($rel);
        $this->assertSame($abs, $trigger->getAbsolute());
        $this->assertSame($rel, $trigger->getRelative());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<trigger>'
                .'<abs d="' . $date . '" />'
                .'<rel neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
            .'</trigger>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $trigger);

        $array = array(
            'trigger' => array(
                'abs' => array(
                    'd' => $date,
                ),
                'rel' => array(
                    'neg' => true,
                    'w' => $weeks,
                    'd' => $days,
                    'h' => $hours,
                    'm' => $minutes,
                    's' => $seconds,
                    'related' => $related,
                    'count' => $count,
                ),
            ),
        );
        $this->assertEquals($array, $trigger->toArray());
    }
}
