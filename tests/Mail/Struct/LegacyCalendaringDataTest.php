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

use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Mail\Struct\CalendaringDataInterface;
use Zimbra\Mail\Struct\CommonCalendaringData;
use Zimbra\Mail\Struct\LegacyInstanceDataInfo;
use Zimbra\Mail\Struct\LegacyCalendaringData;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LegacyCalendaringData.
 */
class LegacyCalendaringDataTest extends ZimbraTestCase
{
    public function testLegacyCalendaringData()
    {
        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $startTime = $this->faker->randomNumber;
        $category1 = $this->faker->unique()->word;
        $category2 = $this->faker->unique()->word;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $nextAlarm = $this->faker->randomNumber;
        $alarmInstanceStart = $this->faker->randomNumber;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;

        $action = AlarmAction::DISPLAY();
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

        $geo = new GeoInfo($latitude, $longitude);
        $organizer = new CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]);
        $inst = new LegacyInstanceDataInfo(
            $startTime, TRUE, $organizer, [$category1, $category2], $geo, $fragment
        );

        $data = new LegacyCalendaringData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );
        $this->assertTrue($data instanceof CalendaringDataInterface);
        $this->assertTrue($data instanceof CommonCalendaringData);

        $this->assertSame($organizer, $data->getOrganizer());
        $this->assertSame([$category1, $category2], $data->getCategories());
        $this->assertSame($geo, $data->getGeo());
        $this->assertSame($fragment, $data->getFragment());
        $this->assertSame([$inst], $data->getInstances());
        $this->assertSame($alarmData, $data->getAlarmData());

        $data = new LegacyCalendaringData($xUid, $uid);
        $data->setCategories([$category1])
            ->addCategory($category2)
            ->setOrganizer($organizer)
            ->setGeo($geo)
            ->setFragment($fragment)
            ->setAlarmData($alarmData)
            ->setInstances([$inst])
            ->addInstance($inst);
        $this->assertSame($organizer, $data->getOrganizer());
        $this->assertSame([$category1, $category2], $data->getCategories());
        $this->assertSame($geo, $data->getGeo());
        $this->assertSame($fragment, $data->getFragment());
        $this->assertSame([$inst, $inst], $data->getInstances());
        $this->assertSame($alarmData, $data->getAlarmData());
        $data->setInstances([$inst]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result x_uid="$xUid" uid="$uid">
    <or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <xparam name="$name" value="$value" />
    </or>
    <category>$category1</category>
    <category>$category2</category>
    <geo lat="$latitude" lon="$longitude" />
    <fr>$fragment</fr>
    <inst s="$startTime" ex="true">
        <or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
            <xparam name="$name" value="$value" />
        </or>
        <category>$category1</category>
        <category>$category2</category>
        <geo lat="$latitude" lon="$longitude" />
        <fr>$fragment</fr>
    </inst>
    <alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
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
    </alarmData>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, LegacyCalendaringData::class, 'xml'));
    }
}
