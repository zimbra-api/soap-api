<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\UrlAndValue;

use Zimbra\Mail\Message\SendMsgEnvelope;
use Zimbra\Mail\Message\SendMsgBody;
use Zimbra\Mail\Message\SendMsgRequest;
use Zimbra\Mail\Message\SendMsgResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\MsgToSend;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\InviteComponentWithGroupInfo;
use Zimbra\Mail\Struct\InviteWithGroupInfo;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\MsgWithGroupInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SendMsg.
 */
class SendMsgTest extends ZimbraTestCase
{
    public function testSendMsg()
    {
        $id = $this->faker->word;
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
        $key = $this->faker->name;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $draftId = $this->faker->uuid;
        $dataSourceId = $this->faker->uuid;
        $sendUid = $this->faker->uuid;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $draftReplyType = ReplyType::REPLIED();
        $draftAccountId = $this->faker->email;
        $draftAutoSendTime = $this->faker->unixTime;
        $sentDate = $this->faker->unixTime;
        $resentDate = $this->faker->unixTime;
        $part = $this->faker->word;
        $messageIdHeader = $this->faker->uuid;

        $display = $this->faker->name;
        $addressType = AddressType::TO();
        $calItemType = InviteType::TASK();

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;
        $url = $this->faker->url;

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO(), $personal);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $msg = new MsgToSend(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment, $draftId, TRUE, $dataSourceId
        );

        $request = new SendMsgRequest($msg, FALSE, FALSE, FALSE, FALSE, $sendUid, FALSE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertSame($sendUid, $request->getSendUid());
        $this->assertFalse($request->getNeedCalendarSentbyFixup());
        $this->assertFalse($request->getIsCalendarForward());
        $this->assertFalse($request->getNoSaveToSent());
        $this->assertFalse($request->getFetchSavedMsg());
        $this->assertFalse($request->getDeliveryReport());
        $request = new SendMsgRequest(new MsgToSend());
        $request->setMsg($msg)
            ->setSendUid($sendUid)
            ->setNeedCalendarSentbyFixup(TRUE)
            ->setIsCalendarForward(TRUE)
            ->setNoSaveToSent(TRUE)
            ->setFetchSavedMsg(TRUE)
            ->setDeliveryReport(TRUE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertSame($sendUid, $request->getSendUid());
        $this->assertTrue($request->getNeedCalendarSentbyFixup());
        $this->assertTrue($request->getIsCalendarForward());
        $this->assertTrue($request->getNoSaveToSent());
        $this->assertTrue($request->getFetchSavedMsg());
        $this->assertTrue($request->getDeliveryReport());

        $inviteComponent = new InviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $calendarReply = new CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $email = new EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $invite = new InviteWithGroupInfo(
            $calItemType, [$timezone], [$inviteComponent], [$calendarReply]
        );
        $header = new KeyValuePair($key, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $urlValue = new UrlAndValue($url, $value);
        $msg = new MsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );

        $response = new SendMsgResponse($msg);
        $this->assertSame($msg, $response->getMsg());
        $response = new SendMsgResponse();
        $response->setMsg($msg);
        $this->assertSame($msg, $response->getMsg());

        $body = new SendMsgBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SendMsgBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SendMsgEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SendMsgEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendMsgRequest needCalendarSentByFixup="true" isCalendarForward="true" noSave="true" fetchSavedMsg="true" suid="$sendUid" deliveryReport="true">
            <urn:m did="$draftId" sfd="true" dsId="$dataSourceId" aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
                <urn:header name="$name">$value</urn:header>
                <urn:content>$content</urn:content>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:attach aid="$id" />
                <urn:inv method="$method" compNum="$componentNum" rsvp="true" />
                <urn:e a="$address" t="t" p="$personal" />
                <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <urn:fr>$fragment</urn:fr>
            </urn:m>
        </urn:SendMsgRequest>
        <urn:SendMsgResponse>
            <urn:m id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
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
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
                <urn:content url="$url">$value</urn:content>
            </urn:m>
        </urn:SendMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SendMsgEnvelope::class, 'xml'));
    }
}
