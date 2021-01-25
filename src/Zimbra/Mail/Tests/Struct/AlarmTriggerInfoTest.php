<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AlarmTriggerInfo;
use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AlarmTriggerInfo.
 */
class AlarmTriggerInfoTest extends ZimbraStructTestCase
{
    public function testAlarmTriggerInfo()
    {
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $absolute = new DateAttr($date);
        $relative = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);

        $trigger = new AlarmTriggerInfo(
            $absolute, $relative
        );
        $this->assertSame($absolute, $trigger->getAbsolute());
        $this->assertSame($relative, $trigger->getRelative());

        $trigger = new AlarmTriggerInfo();
        $trigger->setAbsolute($absolute)
            ->setRelative($relative);
        $this->assertSame($absolute, $trigger->getAbsolute());
        $this->assertSame($relative, $trigger->getRelative());

        $xml = <<<EOT
<?xml version="1.0"?>
<trigger>
    <abs d="$date" />
    <rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</trigger>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($trigger, 'xml'));
        $this->assertEquals($trigger, $this->serializer->deserialize($xml, AlarmTriggerInfo::class, 'xml'));

        $json = json_encode([
            'abs' => [
                'd' => $date,
            ],
            'rel' => [
                'w' => $weeks,
                'd' => $days,
                'h' => $hours,
                'm' => $minutes,
                's' => $seconds,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($trigger, 'json'));
        $this->assertEquals($trigger, $this->serializer->deserialize($json, AlarmTriggerInfo::class, 'json'));
    }
}
