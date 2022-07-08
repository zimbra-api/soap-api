<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ParticipationStatus;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\TzOnsetInfo;

use Zimbra\Mail\Message\GetTaskEnvelope;
use Zimbra\Mail\Message\GetTaskBody;
use Zimbra\Mail\Message\GetTaskRequest;
use Zimbra\Mail\Message\GetTaskResponse;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalendarItemInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\Invitation;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\TaskItemInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetTask.
 */
class GetTaskTest extends ZimbraTestCase
{
    public function testGetTask()
    {
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $revision = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $changeDate = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $nextAlarm = $this->faker->randomNumber;

        $calItemType = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $intId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;
        $recurrenceId = $this->faker->uuid;

        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $method = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $sentBy = $this->faker->email;
        $partStat = ParticipationStatus::ACCEPT();
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $comp = new InviteComponent($method, $componentNum, TRUE);
        $mimePart = new PartInfo($part, $contentType);
        $mp = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $inv = new Invitation(
            $calItemType, $sequence, $intId, $componentNum, $recurrenceId, [$tz], $comp, [$mp], [$shr], [$dlSubs]
        );
        $reply = new CalendarReply(
            $rangeType, $recurId, $seq, $date, $attendee, $sentBy, $partStat
        );
        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $appt = new CalendarItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );
        $task = new TaskItemInfo(
            $flags, $tags, $tagNames, $uid, $id, $revision, $size, $date, $folder, $changeDate, $modifiedSequence, $nextAlarm, TRUE, [$inv], [$reply], [$meta]
        );

        $request = new GetTaskRequest(TRUE, TRUE, TRUE, $uid, $id);
        $response = new GetTaskResponse($appt, $task);
        $this->assertSame($appt, $response->getApptItem());
        $this->assertSame($task, $response->getTaskItem());
        $response = new GetTaskResponse();
        $response->setApptItem($appt)
            ->setTaskItem($task);
        $this->assertSame($appt, $response->getApptItem());
        $this->assertSame($task, $response->getTaskItem());

        $body = new GetTaskBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetTaskBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetTaskEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetTaskEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetTaskRequest sync="true" includeContent="true" includeInvites="true" uid="$uid" id="$id" />
        <urn:GetTaskResponse>
            <urn:appt f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:appt>
            <urn:task f="$flags" t="$tags" tn="$tagNames" uid="$uid" id="$id" rev="$revision" s="$size" d="$date" l="$folder" md="$changeDate" ms="$modifiedSequence" nextAlarm="$nextAlarm" orphan="true">
                <urn:inv type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                        <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                        <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                    </urn:tz>
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                        <urn:mp part="$part" ct="$contentType" />
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:inv>
                <urn:replies>
                    <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" sentBy="$sentBy" ptst="AC" />
                </urn:replies>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:task>
        </urn:GetTaskResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetTaskEnvelope::class, 'xml'));
    }
}
