<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\AlarmAction;
use Zimbra\Enum\Frequency;
use Zimbra\Enum\ParticipationStatus as PartStat;

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

use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteComponent.
 */
class InviteComponentTest extends ZimbraTestCase
{
    public function testInviteComponent()
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
        $recurrenceRangeType = mt_rand(1, 3);
        $utcTime = time();
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

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

        $inv = new InviteComponent($method, $componentNum, TRUE);
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
<inv method="$method" compNum="$componentNum" rsvp="true">
    <category>$category1</category>
    <category>$category2</category>
    <comment>$comment1</comment>
    <comment>$comment2</comment>
    <contact>$contact1</contact>
    <contact>$contact2</contact>
    <geo lat="$latitude" lon="$longitude" />
    <at a="$address" d="$displayName" role="$role" ptst="AC" rsvp="true">
        <xparam name="$name" value="$value" />
    </at>
    <alarm action="DISPLAY" />
    <xprop name="$name" value="$value">
        <xparam name="$name" value="$value" />
    </xprop>
    <fr>$fragment</fr>
    <desc>$description</desc>
    <descHtml>$htmlDescription</descHtml>
    <or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <xparam name="$name" value="$value" />
    </or>
    <recur>
        <rule freq="HOU"/>
    </recur>
    <exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
    <s d="$dateTime" tz="$timezone" u="$utcTime" />
    <e d="$dateTime" tz="$timezone" u="$utcTime" />
    <dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
</inv>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, InviteComponent::class, 'xml'));

        $json = json_encode([
            'method' => $method,
            'compNum' => $componentNum,
            'rsvp' => TRUE,
            'category' => [
                [
                    '_content' => $category1,
                ],
                [
                    '_content' => $category2,
                ],
            ],
            'comment' => [
                [
                    '_content' => $comment1,
                ],
                [
                    '_content' => $comment2,
                ],
            ],
            'contact' => [
                [
                    '_content' => $contact1,
                ],
                [
                    '_content' => $contact2,
                ],
            ],
            'geo' => [
                'lat' => $latitude,
                'lon' => $longitude,
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
            'alarm' => [
                [
                    'action' => 'DISPLAY',
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
            'fr' => [
                '_content' => $fragment,
            ],
            'desc' => [
                '_content' => $description,
            ],
            'descHtml' => [
                '_content' => $htmlDescription,
            ],
            'or' => [
                'a' => $address,
                'url' => $url,
                'd' => $displayName,
                'sentBy' => $sentBy,
                'dir' => $dir,
                'lang' => $language,
                'xparam' => [
                    [
                        'name' => $name,
                        'value' => $value,
                    ],
                ],
            ],
            'recur' => [
                'rule' => [
                    [
                        'freq' => 'HOU',
                    ],
                ],
            ],
            'exceptId' => [
                'd' => $dateTime,
                'tz' => $timezone,
                'rangeType' => $recurrenceRangeType,
            ],
            's' => [
                'd' => $dateTime,
                'tz' => $timezone,
                'u' => $utcTime,
            ],
            'e' => [
                'd' => $dateTime,
                'tz' => $timezone,
                'u' => $utcTime,
            ],
            'dur' => [
                'w' => $weeks,
                'd' => $days,
                'h' => $hours,
                'm' => $minutes,
                's' => $seconds,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($inv, 'json'));
        $this->assertEquals($inv, $this->serializer->deserialize($json, InviteComponent::class, 'json'));
    }
}
