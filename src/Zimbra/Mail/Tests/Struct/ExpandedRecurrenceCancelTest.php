<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;

/**
 * Testcase class for ExpandedRecurrenceCancel.
 */
class ExpandedRecurrenceCancelTest extends ZimbraMailTestCase
{
    public function testExpandedRecurrenceCancel()
    {
        $range = $this->faker->word;
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(0, 99);

        $start = mt_rand(1, 1000);
        $end = mt_rand(1, 1000);

        $exceptId = new InstanceRecurIdInfo(
            $range, $date, $tz
        );
        $dur = new DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $count);
        $recur = new RecurrenceInfo;

        $cancel = new ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, $start, $end
        );
        $this->assertInstanceOf('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $cancel);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cancel s="' . $start . '" e="' . $end . '">'
                .'<exceptId range="' . $range . '" d="' . $date . '" tz="' . $tz . '" />'
                .'<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
                .'<recur />'
            .'</cancel>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cancel);

        $array = array(
            'cancel' => array(
                's' => $start,
                'e' => $end,
                'exceptId' => array(
                    'range' => $range,
                    'd' => $date,
                    'tz' => $tz,
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => $weeks,
                    'd' => $days,
                    'h' => $hours,
                    'm' => $minutes,
                    's' => $seconds,
                    'related' => $related,
                    'count' => $count,
                ),
                'recur' => array(),
            ),
        );
        $this->assertEquals($array, $cancel->toArray());
    }
}
