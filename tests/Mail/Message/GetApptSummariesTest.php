<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

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
use Zimbra\Mail\Struct\LegacyInstanceDataInfo;
use Zimbra\Mail\Struct\LegacyAppointmentData;
use Zimbra\Mail\Struct\LegacyTaskData;

use Zimbra\Mail\Message\GetApptSummariesEnvelope;
use Zimbra\Mail\Message\GetApptSummariesBody;
use Zimbra\Mail\Message\GetApptSummariesRequest;
use Zimbra\Mail\Message\GetApptSummariesResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetApptSummaries.
 */
class GetApptSummariesTest extends ZimbraTestCase
{
    public function testGetApptSummaries()
    {
        $startTime = $this->faker->randomNumber;
        $endTime = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;

        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
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

        $appt = new LegacyAppointmentData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );
        $task = new LegacyTaskData(
            $xUid, $uid, $organizer, [$category1, $category2], $geo, $fragment, [$inst], $alarmData
        );

        $request = new GetApptSummariesRequest($startTime, $endTime, $folderId);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($folderId, $request->getFolderId());
        $request = new GetApptSummariesRequest(0, 0);
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setFolderId($folderId);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($folderId, $request->getFolderId());

        $response = new GetApptSummariesResponse([$appt], [$task]);
        $this->assertSame([$appt], $response->getApptEntries());
        $this->assertSame([$task], $response->getTaskEntries());
        $response = new GetApptSummariesResponse();
        $response->setApptEntries([$appt])
            ->addApptEntry($appt)
            ->setTaskEntries([$task])
            ->addTaskEntry($task);
        $this->assertSame([$appt, $appt], $response->getApptEntries());
        $this->assertSame([$task, $task], $response->getTaskEntries());
        $response = new GetApptSummariesResponse([$appt], [$task]);

        $body = new GetApptSummariesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetApptSummariesBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetApptSummariesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetApptSummariesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetApptSummariesRequest s="$startTime" e="$endTime" l="$folderId" />
        <urn:GetApptSummariesResponse>
            <appt x_uid="$xUid" uid="$uid">
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
            </appt>
            <task x_uid="$xUid" uid="$uid">
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
            </task>
        </urn:GetApptSummariesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetApptSummariesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetApptSummariesRequest' => [
                    's' => $startTime,
                    'e' => $endTime,
                    'l' => $folderId,
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetApptSummariesResponse' => [
                    'appt' => [
                        [
                            'x_uid' => $xUid,
                            'uid' => $uid,
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
                            'category' => [
                                [
                                    '_content' => $category1,
                                ],
                                [
                                    '_content' => $category2,
                                ],
                            ],
                            'geo' => [
                                'lat' => $latitude,
                                'lon' => $longitude,
                            ],
                            'fr' => [
                                '_content' => $fragment,
                            ],
                            'inst' => [
                                [
                                    's' => $startTime,
                                    'ex' => TRUE,
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
                                    'category' => [
                                        [
                                            '_content' => $category1,
                                        ],
                                        [
                                            '_content' => $category2,
                                        ],
                                    ],
                                    'geo' => [
                                        'lat' => $latitude,
                                        'lon' => $longitude,
                                    ],
                                    'fr' => [
                                        '_content' => $fragment,
                                    ],
                                ],
                            ],
                            'alarmData' => [
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
                            ],
                        ],
                    ],
                    'task' => [
                        [
                            'x_uid' => $xUid,
                            'uid' => $uid,
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
                            'category' => [
                                [
                                    '_content' => $category1,
                                ],
                                [
                                    '_content' => $category2,
                                ],
                            ],
                            'geo' => [
                                'lat' => $latitude,
                                'lon' => $longitude,
                            ],
                            'fr' => [
                                '_content' => $fragment,
                            ],
                            'inst' => [
                                [
                                    's' => $startTime,
                                    'ex' => TRUE,
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
                                    'category' => [
                                        [
                                            '_content' => $category1,
                                        ],
                                        [
                                            '_content' => $category2,
                                        ],
                                    ],
                                    'geo' => [
                                        'lat' => $latitude,
                                        'lon' => $longitude,
                                    ],
                                    'fr' => [
                                        '_content' => $fragment,
                                    ],
                                ],
                            ],
                            'alarmData' => [
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
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetApptSummariesEnvelope::class, 'json'));
    }
}
