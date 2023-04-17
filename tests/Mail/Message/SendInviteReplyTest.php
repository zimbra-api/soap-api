<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{ReplyType, VerbType};
use Zimbra\Common\Struct\{Id, TzOnsetInfo};

use Zimbra\Mail\Message\SendInviteReplyEnvelope;
use Zimbra\Mail\Message\SendInviteReplyBody;
use Zimbra\Mail\Message\SendInviteReplyRequest;
use Zimbra\Mail\Message\SendInviteReplyResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\CalEcho;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SendInviteReply.
 */
class SendInviteReplyTest extends ZimbraTestCase
{
    public function testSendInviteReply()
    {
        $id = $this->faker->uuid;
        $componentNum = $this->faker->randomNumber;
        $verb = VerbType::ACCEPT;
        $identityId = $this->faker->uuid;

        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED;
        $subject = $this->faker->text;

        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $utcTime = $this->faker->unixTime;

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

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $exceptionId = new DtTimeInfo($dateTime, $tz, $utcTime);
        $timezone = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject
        );

        $request = new SendInviteReplyRequest(
            $id, $componentNum, $verb, FALSE, $identityId, $exceptionId, $timezone, $msg
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($verb, $request->getVerb());
        $this->assertFalse($request->getUpdateOrganizer());
        $this->assertSame($identityId, $request->getIdentityId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());
        $request = new SendInviteReplyRequest();
        $request->setId($id)
            ->setComponentNum($componentNum)
            ->setVerb($verb)
            ->setUpdateOrganizer(TRUE)
            ->setIdentityId($identityId)
            ->setExceptionId($exceptionId)
            ->setTimezone($timezone)
            ->setMsg($msg);
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($verb, $request->getVerb());
        $this->assertTrue($request->getUpdateOrganizer());
        $this->assertSame($identityId, $request->getIdentityId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());

        $response = new SendInviteReplyResponse(
            $calItemId, $deprecatedApptId, $calInvId, $modifiedSequence, $revision, new Id($id), new CalEcho(new InviteAsMP($id, $part, $sentDate))
        );

        $body = new SendInviteReplyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SendInviteReplyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SendInviteReplyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SendInviteReplyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendInviteReplyRequest id="$id" comp="$componentNum" verb="ACCEPT" updateOrganizer="true" idnt="$identityId">
            <urn:exceptId d="$dateTime" tz="$tz" u="$utcTime" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
                <urn:standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
                <urn:daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
            </urn:tz>
            <urn:m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" />
        </urn:SendInviteReplyRequest>
        <urn:SendInviteReplyResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate" />
            </urn:echo>
        </urn:SendInviteReplyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SendInviteReplyEnvelope::class, 'xml'));
    }
}
