<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetWorkingHoursEnvelope;
use Zimbra\Mail\Message\GetWorkingHoursBody;
use Zimbra\Mail\Message\GetWorkingHoursRequest;
use Zimbra\Mail\Message\GetWorkingHoursResponse;

use Zimbra\Mail\Struct\FreeBusyUserInfo;
use Zimbra\Mail\Struct\FreeBusyFREEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYslot;
use Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot;
use Zimbra\Mail\Struct\FreeBusyNODATAslot;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetWorkingHours.
 */
class GetWorkingHoursTest extends ZimbraTestCase
{
    public function testGetWorkingHours()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $request = new GetWorkingHoursRequest(
            $startTime, $endTime, $id, $name
        );
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());
        $request = new GetWorkingHoursRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setId($id)
            ->setName($name);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());

        $freeSlot = new FreeBusyFREEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $busySlot = new FreeBusyBUSYslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $tentativeSlot = new FreeBusyBUSYTENTATIVEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $unavailableSlot = new FreeBusyBUSYUNAVAILABLEslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $noDataSlot = new FreeBusyNODATAslot(
            $startTime, $endTime, $id, $subject, $location, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
        );
        $usr = new FreeBusyUserInfo($id, [
            $freeSlot,
            $busySlot,
            $tentativeSlot,
            $unavailableSlot,
            $noDataSlot,
        ]);
        $response = new GetWorkingHoursResponse([$usr]);
        $this->assertSame([$usr], $response->getFreebusyUsers());
        $response = new GetWorkingHoursResponse();
        $response->setFreebusyUsers([$usr]);
        $this->assertSame([$usr], $response->getFreebusyUsers());

        $body = new GetWorkingHoursBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetWorkingHoursBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetWorkingHoursEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetWorkingHoursEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetWorkingHoursRequest s="$startTime" e="$endTime" id="$id" name="$name" />
        <urn:GetWorkingHoursResponse>
            <urn:usr id="$id">
                <urn:f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <urn:n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
            </urn:usr>
        </urn:GetWorkingHoursResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetWorkingHoursEnvelope::class, 'xml'));
    }
}
