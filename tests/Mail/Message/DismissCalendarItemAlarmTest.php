<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AlarmAction;
use Zimbra\Common\Enum\ParticipationStatus as PartStat;

use Zimbra\Mail\Message\DismissCalendarItemAlarmEnvelope;
use Zimbra\Mail\Message\DismissCalendarItemAlarmBody;
use Zimbra\Mail\Message\DismissCalendarItemAlarmRequest;
use Zimbra\Mail\Message\DismissCalendarItemAlarmResponse;

use Zimbra\Mail\Struct\{DismissAppointmentAlarm, DismissTaskAlarm};
use Zimbra\Mail\Struct\{UpdatedAppointmentAlarmInfo, UpdatedTaskAlarmInfo};

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
 * Testcase class for DismissCalendarItemAlarm.
 */
class DismissCalendarItemAlarmTest extends ZimbraTestCase
{
    public function testDismissCalendarItemAlarm()
    {
        $id = $this->faker->uuid;
        $dismissedAt = $this->faker->randomNumber;

        $calItemId = $this->faker->uuid;

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

        $appt = new DismissAppointmentAlarm(
            $id, $dismissedAt
        );
        $task = new DismissTaskAlarm(
            $id, $dismissedAt
        );

        $request = new DismissCalendarItemAlarmRequest([$appt, $task]);
        $this->assertSame([$appt], $request->getApptAlarms());
        $this->assertSame([$task], $request->getTaskAlarms());

        $request = new DismissCalendarItemAlarmRequest();
        $request->setApptAlarms([$appt])
                ->setTaskAlarms([$task]);
        $this->assertSame([$appt], $request->getApptAlarms());
        $this->assertSame([$task], $request->getTaskAlarms());

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

        $appt = new UpdatedAppointmentAlarmInfo(
            $calItemId, $alarmData
        );
        $task = new UpdatedTaskAlarmInfo(
            $calItemId, $alarmData
        );

        $response = new DismissCalendarItemAlarmResponse([$appt, $task]);
        $this->assertSame([$appt], $response->getApptUpdatedAlarms());
        $this->assertSame([$task], $response->getTaskUpdatedAlarms());
        $response = new DismissCalendarItemAlarmResponse();
        $response->setApptUpdatedAlarms([$appt])
                 ->setTaskUpdatedAlarms([$task]);
        $this->assertSame([$appt], $response->getApptUpdatedAlarms());
        $this->assertSame([$task], $response->getTaskUpdatedAlarms());

        $body = new DismissCalendarItemAlarmBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DismissCalendarItemAlarmBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DismissCalendarItemAlarmEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DismissCalendarItemAlarmEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DismissCalendarItemAlarmRequest>
            <urn:appt id="$id" dismissedAt="$dismissedAt" />
            <urn:task id="$id" dismissedAt="$dismissedAt" />
        </urn:DismissCalendarItemAlarmRequest>
        <urn:DismissCalendarItemAlarmResponse>
            <urn:appt calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
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
                </urn:alarmData>
            </urn:appt>
            <urn:task calItemId="$calItemId">
                <urn:alarmData nextAlarm="$nextAlarm" alarmInstStart="$alarmInstanceStart" invId="$invId" compNum="$componentNum" name="$name" loc="$location">
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
                </urn:alarmData>
            </urn:task>
        </urn:DismissCalendarItemAlarmResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DismissCalendarItemAlarmEnvelope::class, 'xml'));
    }
}
