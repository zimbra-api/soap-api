<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AlarmAction;
use Zimbra\Common\Enum\ParticipationStatus as PartStat;

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
 * Testcase class for AlarmInfo.
 */
class AlarmInfoTest extends ZimbraTestCase
{
    public function testAlarmInfo()
    {
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

        $alarm = new StubAlarmInfo($action, $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]);
        $this->assertSame($action, $alarm->getAction());
        $this->assertSame($trigger, $alarm->getTrigger());
        $this->assertSame($repeat, $alarm->getRepeat());
        $this->assertSame($description, $alarm->getDescription());
        $this->assertSame($attach, $alarm->getAttach());
        $this->assertSame($summary, $alarm->getSummary());
        $this->assertSame([$at], $alarm->getAttendees());
        $this->assertSame([$xprop], $alarm->getXProps());

        $alarm = new StubAlarmInfo();
        $alarm->setAction($action)
            ->setTrigger($trigger)
            ->setRepeat($repeat)
            ->setDescription($description)
            ->setAttach($attach)
            ->setSummary($summary)
            ->setAttendees([$at])
            ->addAttendee($at)
            ->setXProps([$xprop])
            ->addXProp($xprop);
        $this->assertSame($action, $alarm->getAction());
        $this->assertSame($trigger, $alarm->getTrigger());
        $this->assertSame($repeat, $alarm->getRepeat());
        $this->assertSame($description, $alarm->getDescription());
        $this->assertSame($attach, $alarm->getAttach());
        $this->assertSame($summary, $alarm->getSummary());
        $this->assertSame([$at, $at], $alarm->getAttendees());
        $this->assertSame([$xprop, $xprop], $alarm->getXProps());
        $alarm->setAttendees([$at])->setXProps([$xprop]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result action="DISPLAY" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alarm, 'xml'));
        $this->assertEquals($alarm, $this->serializer->deserialize($xml, StubAlarmInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubAlarmInfo extends AlarmInfo
{
}
