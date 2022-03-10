<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Enum\AddressType;
use Zimbra\Enum\ReplyType;

use Zimbra\Mail\Message\CancelTaskEnvelope;
use Zimbra\Mail\Message\CancelTaskBody;
use Zimbra\Mail\Message\CancelTaskRequest;
use Zimbra\Mail\Message\CancelTaskResponse;

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
 * Testcase class for CancelTask.
 */
class CancelTaskTest extends ZimbraTestCase
{
    public function testCancelTask()
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

        $request = new CancelTaskRequest(
            $id, $componentNum, $modifiedSequence, $revision, $instance, $timezone, $msg
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($componentNum, $request->getComponentNum());
        $this->assertSame($modifiedSequence, $request->getModifiedSequence());
        $this->assertSame($revision, $request->getRevision());
        $this->assertSame($instance, $request->getInstance());
        $this->assertSame($timezone, $request->getTimezone());
        $this->assertSame($msg, $request->getMsg());
        $request = new CancelTaskRequest();
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

        $response = new CancelTaskResponse();

        $body = new CancelTaskBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CancelTaskBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CancelTaskEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CancelTaskEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CancelTaskRequest id="$id" comp="$componentNum" ms="$modifiedSequence" rev="$revision">
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
        </urn:CancelTaskRequest>
        <urn:CancelTaskResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CancelTaskEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CancelTaskRequest' => [
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
                'CancelTaskResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CancelTaskEnvelope::class, 'json'));
    }
}
