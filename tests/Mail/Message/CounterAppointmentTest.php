<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Mail\Message\CounterAppointmentEnvelope;
use Zimbra\Mail\Message\CounterAppointmentBody;
use Zimbra\Mail\Message\CounterAppointmentRequest;
use Zimbra\Mail\Message\CounterAppointmentResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CounterAppointment.
 */
class CounterAppointmentTest extends ZimbraTestCase
{
    public function testCounterAppointment()
    {
        $id = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

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
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject,
            [new Header($name, $value)], $inReplyTo, $folderId, $flags, $content,
            new MimePartInfo($contentType, $content, $contentId),
            new AttachmentsInfo($id),
            new InvitationInfo($method, $componentNum, TRUE),
            [new EmailAddrInfo($address, AddressType::TO, $personal)],
            [new CalTZInfo($id, $tzStdOffset, $tzDayOffset)],
            $fragment
        );

        $request = new CounterAppointmentRequest(
            $id, $componentNum, $modifiedSequence, $revision, $msg
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($modifiedSequence, $request->getModifiedSequence());
        $this->assertSame($revision, $request->getRevision());
        $this->assertSame($msg, $request->getMsg());
        $request = new CounterAppointmentRequest();
        $request->setId($id)
            ->setComponentNum($componentNum)
            ->setModifiedSequence($modifiedSequence)
            ->setRevision($revision)
            ->setMsg($msg);
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($modifiedSequence, $request->getModifiedSequence());
        $this->assertSame($revision, $request->getRevision());
        $this->assertSame($msg, $request->getMsg());

        $response = new CounterAppointmentResponse();

        $body = new CounterAppointmentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CounterAppointmentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CounterAppointmentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CounterAppointmentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CounterAppointmentRequest id="$id" comp="$componentNum" ms="$modifiedSequence" rev="$revision">
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
        </urn:CounterAppointmentRequest>
        <urn:CounterAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CounterAppointmentEnvelope::class, 'xml'));
    }
}
