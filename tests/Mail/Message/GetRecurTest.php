<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\Frequency;
use Zimbra\Common\Struct\TzOnsetInfo;

use Zimbra\Mail\Message\GetRecurEnvelope;
use Zimbra\Mail\Message\GetRecurBody;
use Zimbra\Mail\Message\GetRecurRequest;
use Zimbra\Mail\Message\GetRecurResponse;

use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExceptionRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\SimpleRepeatingRule;

use Zimbra\Mail\Struct\{
    CalTZInfo,
    CancelItemRecur,
    ExceptionItemRecur,
    InviteItemRecur,
};

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetRecur.
 */
class GetRecurTest extends ZimbraTestCase
{
    public function testGetRecur()
    {
        $id = $this->faker->uuid;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = $this->faker->numberBetween(1, 12);
        $hour = $this->faker->numberBetween(0, 23);
        $min = $this->faker->numberBetween(0, 59);
        $sec = $this->faker->numberBetween(0, 59);
        $mday = $this->faker->numberBetween(1, 31);
        $week = $this->faker->numberBetween(1, 4);
        $wkday = $this->faker->numberBetween(1, 7);

        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = $this->faker->numberBetween(1, 3);
        $utcTime = $this->faker->unixTime;
        $weeks = $this->faker->numberBetween(1, 100);
        $days = $this->faker->numberBetween(1, 30);
        $hours = $this->faker->numberBetween(0, 23);
        $minutes = $this->faker->numberBetween(0, 59);
        $seconds = $this->faker->numberBetween(0, 59);

        $request = new GetRecurRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetRecurRequest();
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );

        $exceptionId = new ExceptionRecurIdInfo($dateTime, $timezone, $recurrenceRangeType);
        $dtStart = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $dtEnd = new DtTimeInfo($dateTime, $timezone, $utcTime);
        $duration = new DurationInfo($weeks, $days, $hours, $minutes, $seconds);
        $recurrence = new RecurrenceInfo([new SimpleRepeatingRule(Frequency::HOUR)]);
        $cancel = new CancelItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);
        $except = new ExceptionItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);
        $invite = new InviteItemRecur($exceptionId, $dtStart, $dtEnd, $duration, $recurrence);

        $response = new GetRecurResponse($tz, $cancel, $except, $invite);
        $this->assertSame($tz, $response->getTimezone());
        $this->assertSame($cancel, $response->getCancelComponent());
        $this->assertSame($except, $response->getExceptComponent());
        $this->assertSame($invite, $response->getInviteComponent());
        $response = new GetRecurResponse();
        $response->setTimezone($tz)
            ->setCancelComponent($cancel)
            ->setExceptComponent($except)
            ->setInviteComponent($invite);
        $this->assertSame($tz, $response->getTimezone());
        $this->assertSame($cancel, $response->getCancelComponent());
        $this->assertSame($except, $response->getExceptComponent());
        $this->assertSame($invite, $response->getInviteComponent());

        $body = new GetRecurBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetRecurBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetRecurEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetRecurEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetRecurRequest id="$id" />
        <urn:GetRecurResponse>
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
            </urn:tz>
            <urn:cancel>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:cancel>
            <urn:except>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:except>
            <urn:comp>
                <urn:exceptId d="$dateTime" tz="$timezone" rangeType="$recurrenceRangeType" />
                <urn:s d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:e d="$dateTime" tz="$timezone" u="$utcTime" />
                <urn:dur w="$weeks" d="$days" h="$hours" m="$minutes" s="$seconds" />
                <urn:recur>
                    <urn:rule freq="HOU" />
                </urn:recur>
            </urn:comp>
        </urn:GetRecurResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetRecurEnvelope::class, 'xml'));
    }
}
