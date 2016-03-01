<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DurationInfo;

/**
 * Testcase class for DurationInfo.
 */
class DurationInfoTest extends ZimbraMailTestCase
{
    public function testDurationInfo()
    {
        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(0, 99);
        $rel = new DurationInfo(
            false, $weeks, $days, $hours, $minutes, $seconds, $related, $count
        );

        $this->assertFalse($rel->getDurationNegative());
        $this->assertSame($weeks, $rel->getWeeks());
        $this->assertSame($days, $rel->getDays());
        $this->assertSame($hours, $rel->getHours());
        $this->assertSame($minutes, $rel->getMinutes());
        $this->assertSame($seconds, $rel->getSeconds());
        $this->assertSame($related, $rel->getRelated());
        $this->assertSame($count, $rel->getRepeatCount());

        $rel->setDurationNegative(true)
            ->setWeeks($weeks)
            ->setDays($days)
            ->setHours($hours)
            ->setMinutes($minutes)
            ->setSeconds($seconds)
            ->setRelated($related)
            ->setRepeatCount($count);
        $this->assertTrue($rel->getDurationNegative());
        $this->assertSame($weeks, $rel->getWeeks());
        $this->assertSame($days, $rel->getDays());
        $this->assertSame($hours, $rel->getHours());
        $this->assertSame($minutes, $rel->getMinutes());
        $this->assertSame($seconds, $rel->getSeconds());
        $this->assertSame($related, $rel->getRelated());
        $this->assertSame($count, $rel->getRepeatCount());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<rel neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rel);

        $array = array(
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
        );
        $this->assertEquals($array, $rel->toArray());
    }
}
