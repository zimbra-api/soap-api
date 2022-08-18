<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\CreateAppointmentEnvelope;
use Zimbra\Mail\Message\CreateAppointmentBody;
use Zimbra\Mail\Message\CreateAppointmentRequest;
use Zimbra\Mail\Message\CreateAppointmentResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;

use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MPInviteInfo;
use Zimbra\Mail\Struct\InviteAsMP;
use Zimbra\Mail\Struct\CalEcho;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateAppointment.
 */
class CreateAppointmentTest extends ZimbraTestCase
{
    public function testCreateAppointment()
    {
        $id = $this->faker->uuid;
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
        $key = $this->faker->word;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $maxSize = $this->faker->randomNumber;

        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calInvId = $this->faker->uuid;

        $part = $this->faker->word;
        $sentDate = $this->faker->unixTime;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = AddressType::TO;
        $calItemType = InviteType::TASK;

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

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

        $request = new CreateAppointmentRequest($msg, TRUE, $maxSize, TRUE, TRUE, TRUE);

        $contentElems = [
            new PartInfo(
                $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
            ),
            new ShareNotification(TRUE, $content),
            new DLSubscriptionNotification(TRUE, $content),
        ];
        $invite = new InviteAsMP(
            $id, $part, $sentDate,
            [new EmailInfo($address, $display, $personal, $addressType)],
            $subject, $messageIdHeader,
            new MPInviteInfo($calItemType), [new KeyValuePair($key, $value)],
            $contentElems
        );
        $response = new CreateAppointmentResponse(
            $calItemId, $deprecatedApptId, $calInvId, $modifiedSequence, $revision, new Id($id), new CalEcho($invite)
        );

        $body = new CreateAppointmentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateAppointmentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateAppointmentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateAppointmentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateAppointmentRequest echo="true" max="$maxSize" want="true" neuter="true" forcesend="true">
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
        </urn:CreateAppointmentRequest>
        <urn:CreateAppointmentResponse calItemId="$calItemId" apptId="$deprecatedApptId" invId="$calInvId" ms="$modifiedSequence" rev="$revision">
            <urn:m id="$id" />
            <urn:echo>
                <urn:m id="$id" part="$part" sd="$sentDate">
                    <urn:e a="$address" d="$display" p="$personal" t="t" />
                    <urn:su>$subject</urn:su>
                    <urn:mid>$messageIdHeader</urn:mid>
                    <urn:inv type="task" />
                    <urn:header n="$key">$value</urn:header>
                    <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:mp>
                    <urn:shr truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:shr>
                    <urn:dlSubs truncated="true">
                        <urn:content>$content</urn:content>
                    </urn:dlSubs>
                </urn:m>
            </urn:echo>
        </urn:CreateAppointmentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAppointmentEnvelope::class, 'xml'));
    }
}
