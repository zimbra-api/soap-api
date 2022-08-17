<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\AlarmTriggerInfo;
use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AlarmTriggerInfo.
 */
class AlarmTriggerInfoTest extends ZimbraTestCase
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

        $trigger = new StubAlarmTriggerInfo(
            $absolute, $relative
        );
        $this->assertSame($absolute, $trigger->getAbsolute());
        $this->assertSame($relative, $trigger->getRelative());

        $trigger = new StubAlarmTriggerInfo();
        $trigger->setAbsolute($absolute)
            ->setRelative($relative);
        $this->assertSame($absolute, $trigger->getAbsolute());
        $this->assertSame($relative, $trigger->getRelative());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:abs d="$date" />
    <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($trigger, 'xml'));
        $this->assertEquals($trigger, $this->serializer->deserialize($xml, StubAlarmTriggerInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubAlarmTriggerInfo extends AlarmTriggerInfo
{
}
