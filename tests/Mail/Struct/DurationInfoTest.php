<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\AlarmRelated;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DurationInfo.
 */
class DurationInfoTest extends ZimbraTestCase
{
    public function testDurationInfo()
    {
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = AlarmRelated::START();
        $repeatCount = mt_rand(0, 59);

        $info = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $this->assertSame($weeks, $info->getWeeks());
        $this->assertSame($days, $info->getDays());
        $this->assertSame($hours, $info->getHours());
        $this->assertSame($minutes, $info->getMinutes());
        $this->assertSame($seconds, $info->getSeconds());

        $info = new DurationInfo();
        $info->setDurationNegative(TRUE)
            ->setWeeks($weeks)
            ->setDays($days)
            ->setHours($hours)
            ->setMinutes($minutes)
            ->setSeconds($seconds)
            ->setRelated($related)
            ->setRepeatCount($repeatCount);
        $this->assertTrue($info->getDurationNegative());
        $this->assertSame($weeks, $info->getWeeks());
        $this->assertSame($days, $info->getDays());
        $this->assertSame($hours, $info->getHours());
        $this->assertSame($minutes, $info->getMinutes());
        $this->assertSame($seconds, $info->getSeconds());
        $this->assertSame($related, $info->getRelated());
        $this->assertSame($repeatCount, $info->getRepeatCount());

        $xml = <<<EOT
<?xml version="1.0"?>
<result neg="true" w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" related="START" count="$repeatCount" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, DurationInfo::class, 'xml'));

        $json = json_encode([
            'neg' => TRUE,
            'w' => $weeks,
            'd' => $days,
            'h' => $hours,
            'm' => $minutes,
            's' => $seconds,
            'related' => 'START',
            'count' => $repeatCount,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, DurationInfo::class, 'json'));
    }
}
