<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\ReplyType;

use Zimbra\Mail\Message\CancelAppointmentEnvelope;
use Zimbra\Mail\Message\CancelAppointmentBody;
use Zimbra\Mail\Message\CancelAppointmentRequest;
use Zimbra\Mail\Message\CancelAppointmentResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CancelAppointment.
 */
class CancelAppointmentTest extends ZimbraTestCase
{
    public function testCancelAppointment()
    {
        $id = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $range = $this->faker->randomElement(['THISANDFUTURE', 'THISANDPRIOR']);
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED();
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

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO(), $personal);

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment
        );
        $instance = new InstanceRecurIdInfo($range, $dateTime, $tz);

        $request = new CancelAppointmentRequest(
            $id, $componentNum, $modifiedSequence, $revision, $instance, $timezone, $msg
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($modifiedSequence, $request->getModifiedSequence());
        $this->assertSame($revision, $request->getRevision());
        $this->assertSame($instance, $request->getInstance());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());
        $request = new CancelAppointmentRequest();
        $request->setId($id)
            ->setComponentNum($componentNum)
            ->setModifiedSequence($modifiedSequence)
            ->setRevision($revision)
            ->setInstance($instance)
            ->setTimezone($timezone)
            ->setMsg($msg);
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($modifiedSequence, $request->getModifiedSequence());
        $this->assertSame($revision, $request->getRevision());
        $this->assertSame($instance, $request->getInstance());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());

        $response = new CancelAppointmentResponse();

        $body = new CancelAppointmentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CancelAppointmentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CancelAppointmentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CancelAppointmentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CancelAppointmentRequest id="$id" comp="$componentNum" ms="$modifiedSequence" rev="$revision">
            <inst range="$range" d="$dateTime" tz="$tz" />
            <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
            <m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
                <header name="$name">$value</header>
                <content>$content</content>
                <mp ct="$contentType" content="$content" ci="$contentId" />
                <attach aid="$id" />
                <inv method="$method" compNum="$componentNum" rsvp="true" />
                <e a="$address" t="t" p="$personal" />
                <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <fr>$fragment</fr>
            </m>
        </urn:CancelAppointmentRequest>
        <urn:CancelAppointmentResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CancelAppointmentEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CancelAppointmentRequest' => [
                    'id' => $id,
                    'comp' => $componentNum,
                    'ms' => $modifiedSequence,
                    'rev' => $revision,
                    'inst' => [
                        'range' => $range,
                        'd' => $dateTime,
                        'tz' => $tz,
                    ],
                    'tz' => [
                        'id' => $id,
                        'stdoff' => $tzStdOffset,
                        'dayoff' => $tzDayOffset,
                    ],
                    'm' => [
                        'aid' => $id,
                        'origid' => $origId,
                        'rt' => 'r',
                        'idnt' => $identityId,
                        'su' => $subject,
                        'irt' => $inReplyTo,
                        'l' => $folderId,
                        'f' => $flags,
                        'header' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                            ],
                        ],
                        'content' => [
                            '_content' => $content,
                        ],
                        'mp' => [
                            'ct' => $contentType,
                            'content' => $content,
                            'ci' => $contentId,
                        ],
                        'attach' => [
                            'aid' => $id,
                        ],
                        'inv' => [
                            'method' => $method,
                            'compNum' => $componentNum,
                            'rsvp' => TRUE,
                        ],
                        'e' => [
                            [
                                'a' => $address,
                                't' => 't',
                                'p' => $personal,
                            ],
                        ],
                        'tz' => [
                            [
                                'id' => $id,
                                'stdoff' => $tzStdOffset,
                                'dayoff' => $tzDayOffset,
                            ],
                        ],
                        'fr' => [
                            '_content' => $fragment,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'CancelAppointmentResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CancelAppointmentEnvelope::class, 'json'));
    }
}
