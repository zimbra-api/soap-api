<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AlarmAction;
use Zimbra\Common\Enum\ParticipationStatus as PartStat;

use Zimbra\Mail\Struct\AlarmDataInfo;
use Zimbra\Mail\Struct\AlarmInfo;
use Zimbra\Mail\Struct\AlarmTriggerInfo;
use Zimbra\Mail\Struct\CalendarAttach;
use Zimbra\Mail\Struct\CalendarAttendee;
use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Mail\Struct\XProp;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AlarmDataInfo.
 */
class AlarmDataInfoTest extends ZimbraTestCase
{
    public function testAlarmDataInfo()
    {
        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = AlarmAction::DISPLAY();
        $name = $this->faker->name;
        $value = $this->faker->word;
        $date = $this->faker->date;
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);
        $description = $this->faker->text;
        $summary = $this->faker->text;
        $location = $this->faker->text;

        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $role = $this->faker->word;
        $partStat = PartStat::ACCEPT();

        $trigger = new AlarmTriggerInfo(
            new DateAttr($date), new DurationInfo($weeks, $days, $hours, $minutes, $seconds)
        );
        $repeat = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $attach = new CalendarAttach($uri, $contentType, $binaryB64Data);
        $at = new CalendarAttendee($address, $displayName, $role, $partStat, TRUE, [new XParam($name, $value)]);
        $xprop = new XProp($name, $value, [new XParam($name, $value)]);
        $alarm = new AlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);

        $alarmData = new StubAlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );
        $this->assertSame($nextAlarm, $alarmData->getNextAlarm());
        $this->assertSame($alarmInstanceStart, $alarmData->getAlarmInstanceStart());
        $this->assertSame($invId, $alarmData->getInvId());
        $this->assertSame($componentNum, $alarmData->getComponentNum());
        $this->assertSame($name, $alarmData->getName());
        $this->assertSame($location, $alarmData->getLocation());
        $this->assertSame($alarm, $alarmData->getAlarm());

        $alarmData = new StubAlarmDataInfo();
        $alarmData->setNextAlarm($nextAlarm)
            ->setAlarmInstanceStart($alarmInstanceStart)
            ->setInvId($invId)
            ->setComponentNum($componentNum)
            ->setName($name)
            ->setLocation($location)
            ->setAlarm($alarm);
        $this->assertSame($nextAlarm, $alarmData->getNextAlarm());
        $this->assertSame($alarmInstanceStart, $alarmData->getAlarmInstanceStart());
        $this->assertSame($invId, $alarmData->getInvId());
        $this->assertSame($componentNum, $alarmData->getComponentNum());
        $this->assertSame($name, $alarmData->getName());
        $this->assertSame($location, $alarmData->getLocation());
        $this->assertSame($alarm, $alarmData->getAlarm());

        $xml = <<<EOT
<?xml version="1.0"?>
<result nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location" xmlns:urn="urn:zimbraMail">
    <urn:alarm action="DISPLAY">
        <urn:trigger>
            <urn:abs d="$date" />
            <urn:rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
        </urn:trigger>
        <urn:repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
        <urn:desc>$description</urn:desc>
        <urn:attach uri="$uri" ct="$contentType">$binaryB64Data</urn:attach>
        <urn:summary>$summary</urn:summary>
        <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
            <urn:xparam name="$name" value="$value" />
        </urn:at>
        <urn:xprop name="$name" value="$value">
            <urn:xparam name="$name" value="$value" />
        </urn:xprop>
    </urn:alarm>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alarmData, 'xml'));
        $this->assertEquals($alarmData, $this->serializer->deserialize($xml, StubAlarmDataInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubAlarmDataInfo extends AlarmDataInfo
{
}
