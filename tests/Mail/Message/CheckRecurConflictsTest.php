<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\FreeBusyStatus;

use Zimbra\Mail\Message\CheckRecurConflictsEnvelope;
use Zimbra\Mail\Message\CheckRecurConflictsBody;
use Zimbra\Mail\Message\CheckRecurConflictsRequest;
use Zimbra\Mail\Message\CheckRecurConflictsResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ConflictRecurrenceInstance;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Mail\Struct\FreeBusyUserStatus;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRecurConflicts.
 */
class CheckRecurConflictsTest extends ZimbraTestCase
{
    public function testCheckRecurConflicts()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $excludeUid = $this->faker->uuid;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $folderId = $this->faker->randomNumber;
        $name = $this->faker->email;

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $cancel = new ExpandedRecurrenceCancel(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $invite = new ExpandedRecurrenceInvite(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $except = new ExpandedRecurrenceException(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $components = [
            $cancel,
            $invite,
            $except,
        ];
        $fbUser = new FreeBusyUserSpec($folderId, $id, $name);

        $request = new CheckRecurConflictsRequest(
            $startTime, $endTime, FALSE, $excludeUid, [$timezone], $components, [$fbUser]
        );
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertFalse($request->getAllInstances());
        $this->assertSame($excludeUid, $request->getExcludeUid());
        $this->assertSame([$timezone], $request->getTimezones());
        $this->assertEquals($components, $request->getComponents());
        $this->assertSame([$fbUser], $request->getFreebusyUsers());

        $request = new CheckRecurConflictsRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setAllInstances(TRUE)
            ->setExcludeUid($excludeUid)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setComponents([
                $cancel,
                $invite,
            ])
            ->addComponent($except)
            ->setFreebusyUsers([$fbUser])
            ->addFreebusyUser($fbUser);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertTrue($request->getAllInstances());
        $this->assertSame($excludeUid, $request->getExcludeUid());
        $this->assertSame([$timezone, $timezone], $request->getTimezones());
        $this->assertEquals($components, $request->getComponents());
        $this->assertSame([$fbUser, $fbUser], $request->getFreebusyUsers());

        $instance = new ConflictRecurrenceInstance(
            [new FreeBusyUserStatus($name, FreeBusyStatus::FREE())]
        );

        $response = new CheckRecurConflictsResponse([$instance]);
        $this->assertSame([$instance], $response->getInstances());
        $response = new CheckRecurConflictsResponse();
        $response->setInstances([$instance])
            ->addInstance($instance);
        $this->assertSame([$instance, $instance], $response->getInstances());

        $request = new CheckRecurConflictsRequest(
            $startTime, $endTime, TRUE, $excludeUid, [$timezone], $components, [$fbUser]
        );
        $response = new CheckRecurConflictsResponse([$instance]);
        $body = new CheckRecurConflictsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CheckRecurConflictsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckRecurConflictsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CheckRecurConflictsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckRecurConflictsRequest s="$startTime" e="$endTime" all="true" excludeUid="$excludeUid">
            <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
            <cancel s="$startTime" e="$endTime">
                <exceptId range="$range" d="$dateTime" tz="$tz" />
            </cancel>
            <comp s="$startTime" e="$endTime">
                <exceptId range="$range" d="$dateTime" tz="$tz" />
            </comp>
            <except s="$startTime" e="$endTime">
                <exceptId range="$range" d="$dateTime" tz="$tz" />
            </except>
            <usr l="$folderId" id="$id" name="$name" />
        </urn:CheckRecurConflictsRequest>
        <urn:CheckRecurConflictsResponse>
            <inst>
                <usr name="$name" fb="F" />
            </inst>
        </urn:CheckRecurConflictsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRecurConflictsEnvelope::class, 'xml'));
    }
}
