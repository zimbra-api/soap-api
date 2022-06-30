<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\FreeBusyStatus;

use Zimbra\Mail\Message\ExpandRecurEnvelope;
use Zimbra\Mail\Message\ExpandRecurBody;
use Zimbra\Mail\Message\ExpandRecurRequest;
use Zimbra\Mail\Message\ExpandRecurResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceInstance;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExpandRecur.
 */
class ExpandRecurTest extends ZimbraTestCase
{
    public function testExpandRecur()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $duration = $this->faker->randomNumber;
        $tzOffset = $this->faker->randomNumber;
        $recurIdZ = $this->faker->iso8601;

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $cancel = new ExpandedRecurrenceCancel(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $invite = new ExpandedRecurrenceInvite(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $except = new ExpandedRecurrenceException(new InstanceRecurIdInfo($range, $dateTime, $tz), $startTime, $endTime);
        $components = [
            $cancel,
            $invite,
            $except,
        ];

        $request = new ExpandRecurRequest(
            $startTime, $endTime, [$timezone], $components
        );
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame([$timezone], $request->getTimezones());
        $this->assertEquals($components, $request->getComponents());

        $request = new ExpandRecurRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setComponents([
                $cancel,
                $invite,
            ])
            ->addComponent($except);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame([$timezone, $timezone], $request->getTimezones());
        $this->assertEquals($components, $request->getComponents());

        $instance = new ExpandedRecurrenceInstance($startTime, $duration, TRUE, $tzOffset, $recurIdZ);

        $response = new ExpandRecurResponse([$instance]);
        $this->assertSame([$instance], $response->getInstances());
        $response = new ExpandRecurResponse();
        $response->setInstances([$instance])
            ->addInstance($instance);
        $this->assertSame([$instance, $instance], $response->getInstances());

        $request = new ExpandRecurRequest(
            $startTime, $endTime, [$timezone], $components
        );
        $response = new ExpandRecurResponse([$instance]);
        $body = new ExpandRecurBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ExpandRecurBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ExpandRecurEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ExpandRecurEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ExpandRecurRequest s="$startTime" e="$endTime">
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
            <urn:comp s="$startTime" e="$endTime">
                <urn:exceptId range="$range" d="$dateTime" tz="$tz" />
            </urn:comp>
            <urn:except s="$startTime" e="$endTime">
                <urn:exceptId range="$range" d="$dateTime" tz="$tz" />
            </urn:except>
            <urn:cancel s="$startTime" e="$endTime">
                <urn:exceptId range="$range" d="$dateTime" tz="$tz" />
            </urn:cancel>
        </urn:ExpandRecurRequest>
        <urn:ExpandRecurResponse>
            <urn:inst s="$startTime" dur="$duration" allDay="true" tzo="$tzOffset" ridZ="$recurIdZ" />
        </urn:ExpandRecurResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ExpandRecurEnvelope::class, 'xml'));
    }
}
