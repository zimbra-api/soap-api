<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Mail\Message\ForwardAppointmentEnvelope;
use Zimbra\Mail\Message\ForwardAppointmentBody;
use Zimbra\Mail\Message\ForwardAppointmentRequest;
use Zimbra\Mail\Message\ForwardAppointmentResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ForwardAppointment.
 */
class ForwardAppointmentTest extends ZimbraTestCase
{
    public function testForwardAppointment()
    {
        $id = $this->faker->word;
        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED;
        $identityId = $this->faker->uuid;
        $subject = $this->faker->text;
        $inReplyTo = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $content = $this->faker->text;
        $fragment = $this->faker->text;
        $contentType = $this->faker->word;
        $contentId = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $utcTime = $this->faker->unixTime;

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO, $personal);

        $exceptionId = new DtTimeInfo($dateTime, $tz, $utcTime);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment
        );
        $request = new ForwardAppointmentRequest($id, $exceptionId, $timezone, $msg);
        $this->assertSame($id, $request->getId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());
        $request = new ForwardAppointmentRequest();
        $request->setMsg($msg)
            ->setExceptionId($exceptionId)
            ->setTimezone($timezone)
            ->setId($id);
        $this->assertSame($id, $request->getId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());

        $response = new ForwardAppointmentResponse();

        $body = new ForwardAppointmentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ForwardAppointmentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ForwardAppointmentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ForwardAppointmentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ForwardAppointmentRequest id="$id">
            <urn:exceptId d="$dateTime" tz="$tz" u="$utcTime" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
            <urn:m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
                <urn:header name="$name">$value</urn:header>
                <urn:content>$content</urn:content>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:attach aid="$id" />
                <urn:inv method="$method" compNum="$componentNum" rsvp="true" />
                <urn:e a="$address" t="t" p="$personal" />
                <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <urn:fr>$fragment</urn:fr>
            </urn:m>
        </urn:ForwardAppointmentRequest>
        <urn:ForwardAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ForwardAppointmentEnvelope::class, 'xml'));
    }
}
