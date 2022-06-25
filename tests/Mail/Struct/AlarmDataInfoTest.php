<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $alarmData = new AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location, $alarm
        );
        $this->assertSame($nextAlarm, $alarmData->getNextAlarm());
        $this->assertSame($alarmInstanceStart, $alarmData->getAlarmInstanceStart());
        $this->assertSame($invId, $alarmData->getInvId());
        $this->assertSame($componentNum, $alarmData->getComponentNum());
        $this->assertSame($name, $alarmData->getName());
        $this->assertSame($location, $alarmData->getLocation());
        $this->assertSame($alarm, $alarmData->getAlarm());

        $alarmData = new AlarmDataInfo();
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
<result nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
    <alarm action="DISPLAY">
        <trigger>
            <abs d="$date" />
            <rel w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
        </trigger>
        <repeat w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
        <desc>$description</desc>
        <attach uri="$uri" ct="$contentType">$binaryB64Data</attach>
        <summary>$summary</summary>
        <at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
            <xparam name="$name" value="$value" />
        </at>
        <xprop name="$name" value="$value">
            <xparam name="$name" value="$value" />
        </xprop>
    </alarm>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alarmData, 'xml'));
        $this->assertEquals($alarmData, $this->serializer->deserialize($xml, AlarmDataInfo::class, 'xml'));

        $json = json_encode([
            'nextAlarm' => $nextAlarm,
            'alarmInstStart' => $alarmInstanceStart,
            'invId' => $invId,
            'compNum' => $componentNum,
            'name' => $name,
            'loc' => $location,
            'alarm' => [
                'action' => 'DISPLAY',
                'trigger' => [
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
                ],
                'repeat' => [
                    'w' => $weeks,
                    'd' => $days,
                    'h' => $hours,
                    'm' => $minutes,
                    's' => $seconds,
                ],
                'desc' => [
                    '_content' => $description,
                ],
                'attach' => [
                    'uri' => $uri,
                    'ct' => $contentType,
                    '_content' => $binaryB64Data,
                ],
                'summary' => [
                    '_content' => $summary,
                ],
                'at' => [
                    [
                        'a' => $address,
                        'd' => $displayName,
                        'role' => $role,
                        'ptst' => 'AC',
                        'rsvp' => TRUE,
                        'xparam' => [
                            [
                                'name' => $name,
                                'value' => $value,
                            ],
                        ],
                    ],
                ],
                'xprop' => [
                    [
                        'name' => $name,
                        'value' => $value,
                        'xparam' => [
                            [
                                'name' => $name,
                                'value' => $value,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($alarmData, 'json'));
        $this->assertEquals($alarmData, $this->serializer->deserialize($json, AlarmDataInfo::class, 'json'));
    }
}
