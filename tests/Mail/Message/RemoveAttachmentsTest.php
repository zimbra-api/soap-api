<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\RemoveAttachmentsEnvelope;
use Zimbra\Mail\Message\RemoveAttachmentsBody;
use Zimbra\Mail\Message\RemoveAttachmentsRequest;
use Zimbra\Mail\Message\RemoveAttachmentsResponse;

use Zimbra\Mail\Struct\MsgPartIds;
use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\MessageInfo;
use Zimbra\Mail\Struct\ChatMessageInfo;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RemoveAttachments.
 */
class RemoveAttachmentsTest extends ZimbraTestCase
{
    public function testRemoveAttachments()
    {
        $id = $this->faker->uuid;
        $partIds = $this->faker->word;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->uuid;
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $subject = $this->faker->word;
        $messageIdHeader = $this->faker->word;
        $inReplyTo = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO();

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $calItemType = InviteType::TASK();
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $msg = new MsgPartIds($id, $partIds);

        $request = new RemoveAttachmentsRequest($msg);
        $this->assertSame($msg, $request->getMsg());
        $request = new RemoveAttachmentsRequest(new MsgPartIds());
        $request->setMsg($msg);
        $this->assertSame($msg, $request->getMsg());

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new InviteComponent($method, $componentNum, TRUE);
        $calendarReply = new CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $invite = new InviteInfo($calItemType, [$timezone], $inviteComponent, [$calendarReply]);
        $header = new KeyValuePair($key, $value);
        $email = new EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $mimePart = new PartInfo($part, $contentType);
        $mp = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $msgInfo = new MessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $chatInfo = new ChatMessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );

        $response = new RemoveAttachmentsResponse($msgInfo);
        $this->assertSame($msgInfo, $response->getMsgMessage());
        $response = new RemoveAttachmentsResponse($chatInfo);
        $this->assertSame($chatInfo, $response->getChatMessage());
        $response = new RemoveAttachmentsResponse();
        $response->setChatMessage($chatInfo);
        $this->assertSame($chatInfo, $response->getChatMessage());
        $response->setMsgMessage($msgInfo);
        $this->assertSame($msgInfo, $response->getMsgMessage());
        $response = new RemoveAttachmentsResponse($msgInfo);

        $body = new RemoveAttachmentsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RemoveAttachmentsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RemoveAttachmentsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RemoveAttachmentsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RemoveAttachmentsRequest>
            <urn:m id="$id" part="$partIds" />
        </urn:RemoveAttachmentsRequest>
        <urn:RemoveAttachmentsResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part" xmlns:urn="urn:zimbraMail">
                <urn:fr>$fragment</urn:fr>
                <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
                <urn:su>$subject</urn:su>
                <urn:mid>$messageIdHeader</urn:mid>
                <urn:irt>$inReplyTo</urn:irt>
                <urn:inv type="task">
                    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
                    <urn:replies>
                        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
                    </urn:replies>
                </urn:inv>
                <urn:header n="$key">$value</urn:header>
                <urn:mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
                    <urn:content>$content</urn:content>
                    <urn:mp part="$part" ct="$contentType" />
                </urn:mp>
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
            </urn:m>
        </urn:RemoveAttachmentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RemoveAttachmentsEnvelope::class, 'xml'));
    }
}
