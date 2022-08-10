<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ParticipationStatus;

use Zimbra\Mail\Struct\AlarmDataInfo;
use Zimbra\Mail\Struct\CalendarItemHitInfo;
use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\CalReply;
use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Mail\Struct\InstanceDataInfo;
use Zimbra\Mail\Struct\Invitation;
use Zimbra\Mail\Struct\XParam;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarItemHitInfo.
 */
class CalendarItemHitInfoTest extends ZimbraTestCase
{
    public function testCalendarItemHitInfo()
    {
        $id = $this->faker->uuid;
        $intId = $this->faker->randomNumber;
        $sortField = $this->faker->word;
        $date = $this->faker->unixTime;
        $nextAlarm = $this->faker->unixTime;
        $alarmInstanceStart = $this->faker->unixTime;
        $category1 = $this->faker->unique->word;
        $category2 = $this->faker->unique->word;
        $fragment = $this->faker->word;
        $startTime = $this->faker->unixTime;
        $invId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;
        $location = $this->faker->word;
        $calItemType = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $recurrenceId = $this->faker->uuid;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $url = $this->faker->url;
        $displayName = $this->faker->name;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;

        $attendee = $this->faker->email;
        $partStat = ParticipationStatus::ACCEPT();
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $organizer = new CalOrganizer(
            $address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]
        );
        $geo = new GeoInfo($latitude, $longitude);
        $inst = new InstanceDataInfo(
            $startTime, TRUE, $organizer, [$category1, $category2], $geo, $fragment
        );
        $alarmData = new AlarmDataInfo(
            $nextAlarm, $alarmInstanceStart, $invId, $componentNum, $name, $location
        );
        $invite = new Invitation(
            $calItemType, $sequence, $intId, $componentNum, $recurrenceId
        );
        $reply = new CalReply(
            $rangeType, $recurId, $sequence, $date, $attendee, $sentBy, $partStat
        );

        $hit = new StubCalendarItemHitInfo(
            $id, $sortField, $date, FALSE, $nextAlarm, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData, [$invite], [$reply]
        );
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame($date, $hit->getDate());
        $this->assertFalse($hit->getContentMatched());
        $this->assertSame($nextAlarm, $hit->getNextAlarm());
        $this->assertSame($organizer, $hit->getOrganizer());
        $this->assertSame([$category1, $category2], $hit->getCategories());
        $this->assertSame($geo, $hit->getGeo());
        $this->assertSame($fragment, $hit->getFragment());
        $this->assertSame([$inst], $hit->getInstances());
        $this->assertSame($alarmData, $hit->getAlarmData());
        $this->assertSame([$invite], $hit->getInvites());
        $this->assertSame([$reply], $hit->getReplies());

        $hit = new StubCalendarItemHitInfo();
        $hit->setSortField($sortField)
            ->setDate($date)
            ->setContentMatched(TRUE)
            ->setNextAlarm($nextAlarm)
            ->setOrganizer($organizer)
            ->setCategories([$category1, $category2])
            ->setGeo($geo)
            ->setFragment($fragment)
            ->setInstances([$inst])
            ->setAlarmData($alarmData)
            ->setInvites([$invite])
            ->setReplies([$reply]);
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame($date, $hit->getDate());
        $this->assertTrue($hit->getContentMatched());
        $this->assertSame($nextAlarm, $hit->getNextAlarm());
        $this->assertSame($organizer, $hit->getOrganizer());
        $this->assertSame([$category1, $category2], $hit->getCategories());
        $this->assertSame($geo, $hit->getGeo());
        $this->assertSame($fragment, $hit->getFragment());
        $this->assertSame([$inst], $hit->getInstances());
        $this->assertSame($alarmData, $hit->getAlarmData());
        $this->assertSame([$invite], $hit->getInvites());
        $this->assertSame([$reply], $hit->getReplies());
        $hit = new StubCalendarItemHitInfo(
            $id, $sortField, $date, TRUE, $nextAlarm, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData, [$invite], [$reply]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" id="$id" d="$date" cm="true" nextAlarm="$nextAlarm" xmlns:urn="urn:zimbraMail">
    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <urn:xparam name="$name" value="$value" />
    </urn:or>
    <urn:category>$category1</urn:category>
    <urn:category>$category2</urn:category>
    <urn:geo lat="$latitude" lon="$longitude" />
    <urn:fr>$fragment</urn:fr>
    <urn:inst s="$startTime" ex="true">
        <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
            <urn:xparam name="$name" value="$value" />
        </urn:or>
        <urn:category>$category1</urn:category>
        <urn:category>$category2</urn:category>
        <urn:geo lat="$latitude" lon="$longitude" />
        <urn:fr>$fragment</urn:fr>
    </urn:inst>
    <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location" />
    <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId" />
    <urn:replies>
        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$sequence" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
    </urn:replies>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, StubCalendarItemHitInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubCalendarItemHitInfo extends CalendarItemHitInfo
{
}
