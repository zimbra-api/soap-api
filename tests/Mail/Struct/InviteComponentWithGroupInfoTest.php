<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AlarmAction;
use Zimbra\Common\Enum\Frequency;
use Zimbra\Common\Enum\ParticipationStatus as PartStat;

use Zimbra\Mail\Struct\AlarmInfo;
use Zimbra\Mail\Struct\CalendarAttendee;
use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExceptionRecurIdInfo;
use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Mail\Struct\XProp;

use Zimbra\Mail\Struct\InviteComponentWithGroupInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteComponentWithGroupInfo.
 */
class InviteComponentWithGroupInfoTest extends ZimbraTestCase
{
    public function testInviteComponentWithGroupInfo()
    {
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $category1 = $this->faker->unique()->word;
        $category2 = $this->faker->unique()->word;
        $comment1 = $this->faker->unique()->word;
        $comment2 = $this->faker->unique()->word;
        $contact1 = $this->faker->unique()->email;
        $contact2 = $this->faker->unique()->email;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;
        $description = $this->faker->text;
        $htmlDescription = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $role = $this->faker->word;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $utcTime = $this->faker->unixTime;
        $weeks = $this->faker->numberBetween(1, 100);
        $days = $this->faker->numberBetween(1, 30);
        $hours = $this->faker->numberBetween(0, 23);
        $minutes = $this->faker->numberBetween(0, 59);
        $seconds = $this->faker->numberBetween(0, 59);

        $geo = new GeoInfo($latitude, $longitude);
        $attendee = new CalendarAttendee($address, $displayName, $role, PartStat::ACCEPT(), TRUE, [new XParam($name, $value)]);
        $alarm = new AlarmInfo(AlarmAction::DISPLAY());
        $xprop = new XProp($name, $value, [new XParam($name, $value)]);
        $organizer = new CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]);
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR())]);
        $exceptionId = new ExceptionRecurIdInfo($dateTime, $timezone, $recurrenceRangeType);
        $dtStart = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $dtEnd = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);

        $inv = new StubInviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $inv->setCategories([$category1])
            ->addCategory($category2)
            ->setComments([$comment1])
            ->addComment($comment2)
            ->setContacts([$contact1])
            ->addContact($contact2)
            ->setGeo($geo)
            ->setAttendees([$attendee])
            ->addAttendee($attendee)
            ->setAlarms([$alarm])
            ->addAlarm($alarm)
            ->setXProps([$xprop])
            ->addXProp($xprop)
            ->setFragment($fragment)
            ->setDescription($description)
            ->setHtmlDescription($htmlDescription)
            ->setOrganizer($organizer)
            ->setRecurrence($recurrence)
            ->setExceptionId($exceptionId)
            ->setDtStart($dtStart)
            ->setDtEnd($dtEnd)
            ->setDuration($duration);
        $this->assertSame([$category1, $category2], $inv->getCategories());
        $this->assertSame([$comment1, $comment2], $inv->getComments());
        $this->assertSame([$contact1, $contact2], $inv->getContacts());
        $this->assertSame($geo, $inv->getGeo());
        $this->assertSame([$attendee, $attendee], $inv->getAttendees());
        $this->assertSame([$alarm, $alarm], $inv->getAlarms());
        $this->assertSame([$xprop, $xprop], $inv->getXProps());
        $this->assertSame($fragment, $inv->getFragment());
        $this->assertSame($description, $inv->getDescription());
        $this->assertSame($htmlDescription, $inv->getHtmlDescription());
        $this->assertSame($organizer, $inv->getOrganizer());
        $this->assertSame($recurrence, $inv->getRecurrence());
        $this->assertSame($exceptionId, $inv->getExceptionId());
        $this->assertSame($dtStart, $inv->getDtStart());
        $this->assertSame($dtEnd, $inv->getDtEnd());
        $this->assertSame($duration, $inv->getDuration());
        $inv->setAttendees([$attendee])
            ->setAlarms([$alarm])
            ->setXProps([$xprop]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result method="$method" compNum="$componentNum" rsvp="true" xmlns:urn="urn:zimbraMail">
    <urn:category>$category1</urn:category>
    <urn:category>$category2</urn:category>
    <urn:comment>$comment1</urn:comment>
    <urn:comment>$comment2</urn:comment>
    <urn:contact>$contact1</urn:contact>
    <urn:contact>$contact2</urn:contact>
    <urn:geo lat="$latitude" lon="$longitude" />
    <urn:at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
        <urn:xparam name="$name" value="$value" />
    </urn:at>
    <urn:alarm action="DISPLAY" />
    <urn:xprop name="$name" value="$value">
        <urn:xparam name="$name" value="$value" />
    </urn:xprop>
    <urn:fr>$fragment</urn:fr>
    <urn:desc>$description</urn:desc>
    <urn:descHtml>$htmlDescription</urn:descHtml>
    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <urn:xparam name="$name" value="$value" />
    </urn:or>
    <urn:recur>
        <urn:rule freq="HOU"/>
    </urn:recur>
    <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
    <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
    <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, StubInviteComponentWithGroupInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubInviteComponentWithGroupInfo extends InviteComponentWithGroupInfo
{
}
