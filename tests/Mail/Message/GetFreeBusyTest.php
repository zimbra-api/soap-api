<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;

use Zimbra\Mail\Message\GetFreeBusyEnvelope;
use Zimbra\Mail\Message\GetFreeBusyBody;
use Zimbra\Mail\Message\GetFreeBusyRequest;
use Zimbra\Mail\Message\GetFreeBusyResponse;

use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Mail\Struct\FreeBusyUserInfo;
use Zimbra\Mail\Struct\FreeBusyFREEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYslot;
use Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot;
use Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot;
use Zimbra\Mail\Struct\FreeBusyNODATAslot;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFreeBusy.
 */
class GetFreeBusyTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testGetFreeBusy()
    {
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $excludeUid = $this->faker->uuid;
        $folderId = $this->faker->randomNumber;
        $subject = $this->faker->text;
        $location = $this->faker->text;

        $usr = new FreeBusyUserSpec($folderId, $id, $name);
        $request = new GetFreeBusyRequest(
            $startTime, $endTime, $uid, $id, $name, $excludeUid, [$usr]
        );
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($uid, $request->getUid());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());
        $this->assertSame($excludeUid, $request->getExcludeUid());
        $this->assertSame([$usr], $request->getFreebusyUsers());
        $request = new GetFreeBusyRequest(0, 0);
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setUid($uid)
            ->setId($id)
            ->setName($name)
            ->setExcludeUid($excludeUid)
            ->setFreebusyUsers([$usr])
            ->addFreebusyUser($usr);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame($uid, $request->getUid());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());
        $this->assertSame($excludeUid, $request->getExcludeUid());
        $this->assertSame([$usr, $usr], $request->getFreebusyUsers());
        $request->setFreebusyUsers([$usr]);

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
        $response = new GetFreeBusyResponse([$usr]);
        $this->assertSame([$usr], $response->getFreebusyUsers());
        $response = new GetFreeBusyResponse();
        $response->setFreebusyUsers([$usr])
            ->addFreebusyUser($usr);
        $this->assertSame([$usr, $usr], $response->getFreebusyUsers());
        $response->setFreebusyUsers([$usr]);

        $body = new GetFreeBusyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetFreeBusyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetFreeBusyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetFreeBusyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetFreeBusyRequest s="$startTime" e="$endTime" uid="$uid" id="$id" name="$name" excludeUid="$excludeUid">
            <usr l="$folderId" id="$id" name="$name" />
        </urn:GetFreeBusyRequest>
        <urn:GetFreeBusyResponse>
            <usr id="$id">
                <f s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <b s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <t s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <u s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
                <n s="$startTime" e="$endTime" eventId="$id" subject="$subject" location="$location" isMeeting="true" isRecurring="true" isException="true" isReminderSet="true" isPrivate="true" hasPermission="true" />
            </usr>
        </urn:GetFreeBusyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetFreeBusyEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetFreeBusyRequest' => [
                    's' => $startTime,
                    'e' => $endTime,
                    'uid' => $uid,
                    'id' => $id,
                    'name' => $name,
                    'excludeUid' => $excludeUid,
                    'usr' => [
                        [
                            'l' => $folderId,
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetFreeBusyResponse' => [
                    'usr' => [
                        [
                            'id' => $id,
                            'f' => [
                                [
                                    's' => $startTime,
                                    'e' => $endTime,
                                    'eventId' => $id,
                                    'subject' => $subject,
                                    'location' => $location,
                                    'isMeeting' => TRUE,
                                    'isRecurring' => TRUE,
                                    'isException' => TRUE,
                                    'isReminderSet' => TRUE,
                                    'isPrivate' => TRUE,
                                    'hasPermission' => TRUE,
                                ],
                            ],
                            'b' => [
                                [
                                    's' => $startTime,
                                    'e' => $endTime,
                                    'eventId' => $id,
                                    'subject' => $subject,
                                    'location' => $location,
                                    'isMeeting' => TRUE,
                                    'isRecurring' => TRUE,
                                    'isException' => TRUE,
                                    'isReminderSet' => TRUE,
                                    'isPrivate' => TRUE,
                                    'hasPermission' => TRUE,
                                ],
                            ],
                            't' => [
                                [
                                    's' => $startTime,
                                    'e' => $endTime,
                                    'eventId' => $id,
                                    'subject' => $subject,
                                    'location' => $location,
                                    'isMeeting' => TRUE,
                                    'isRecurring' => TRUE,
                                    'isException' => TRUE,
                                    'isReminderSet' => TRUE,
                                    'isPrivate' => TRUE,
                                    'hasPermission' => TRUE,
                                ],
                            ],
                            'u' => [
                                [
                                    's' => $startTime,
                                    'e' => $endTime,
                                    'eventId' => $id,
                                    'subject' => $subject,
                                    'location' => $location,
                                    'isMeeting' => TRUE,
                                    'isRecurring' => TRUE,
                                    'isException' => TRUE,
                                    'isReminderSet' => TRUE,
                                    'isPrivate' => TRUE,
                                    'hasPermission' => TRUE,
                                ],
                            ],
                            'n' => [
                                [
                                    's' => $startTime,
                                    'e' => $endTime,
                                    'eventId' => $id,
                                    'subject' => $subject,
                                    'location' => $location,
                                    'isMeeting' => TRUE,
                                    'isRecurring' => TRUE,
                                    'isException' => TRUE,
                                    'isReminderSet' => TRUE,
                                    'isPrivate' => TRUE,
                                    'hasPermission' => TRUE,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetFreeBusyEnvelope::class, 'json'));
    }
}
