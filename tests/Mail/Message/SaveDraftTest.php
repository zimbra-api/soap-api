<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\SaveDraftEnvelope;
use Zimbra\Mail\Message\SaveDraftBody;
use Zimbra\Mail\Message\SaveDraftRequest;
use Zimbra\Mail\Message\SaveDraftResponse;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\SaveDraftMsg;

use Zimbra\Mail\Struct\MsgPartIds;
use Zimbra\Mail\Struct\CalendarReply;
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
 * Testcase class for SaveDraft.
 */
class SaveDraftTest extends ZimbraTestCase
{
    public function testSaveDraft()
    {
        $id = $this->faker->word;
        $intId = $this->faker->randomNumber;
        $origId = $this->faker->uuid;
        $replyType = ReplyType::REPLIED();
        $identityId = $this->faker->uuid;
        $subject = $this->faker->text;
        $inReplyTo = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $content = $this->faker->text;
        $fragment = $this->faker->text;
        $contentType = $this->faker->mimeType;
        $contentId = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $draftAccountId = $this->faker->uuid;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);
        $autoSendTime = $this->faker->unixTime;

        $partIds = $this->faker->word;
        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $draftReplyType = ReplyType::REPLIED();
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $messageIdHeader = $this->faker->word;

        $display = $this->faker->name;
        $addressType = AddressType::TO();

        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $location = $this->faker->word;

        $calItemType = InviteType::TASK();
        $key = $this->faker->word;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO(), $personal);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $msg = new SaveDraftMsg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment, $intId, $draftAccountId, $tags, $tagNames, $rgb, $color, $autoSendTime
        );

        $request = new SaveDraftRequest($msg, FALSE, FALSE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertFalse($request->getWantImapUid());
        $this->assertFalse($request->getWantModifiedSequence());
        $request = new SaveDraftRequest(new SaveDraftMsg());
        $request->setMsg($msg)
            ->setWantImapUid(TRUE)
            ->setWantModifiedSequence(TRUE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertTrue($request->getWantImapUid());
        $this->assertTrue($request->getWantModifiedSequence());

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

        $response = new SaveDraftResponse($msgInfo);
        $this->assertSame($msgInfo, $response->getMsgMessage());
        $response = new SaveDraftResponse($chatInfo);
        $this->assertSame($chatInfo, $response->getChatMessage());
        $response = new SaveDraftResponse();
        $response->setChatMessage($chatInfo);
        $this->assertSame($chatInfo, $response->getChatMessage());
        $response->setMsgMessage($msgInfo);
        $this->assertSame($msgInfo, $response->getMsgMessage());
        $response = new SaveDraftResponse($msgInfo);

        $body = new SaveDraftBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SaveDraftBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SaveDraftEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SaveDraftEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveDraftRequest wantImapUid="true" wantModSeq="true">
            <urn:m aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags" id="$intId" forAcct="$draftAccountId" t="$tags" tn="$tagNames" rgb="$rgb" color="$color" autoSendTime="$autoSendTime">
                <urn:header name="$name">$value</urn:header>
                <urn:content>$content</urn:content>
                <urn:mp ct="$contentType" content="$content" ci="$contentId" />
                <urn:attach aid="$id" />
                <urn:inv method="$method" compNum="$componentNum" rsvp="true" />
                <urn:e a="$address" t="t" p="$personal" />
                <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
                <urn:fr>$fragment</urn:fr>
            </urn:m>
        </urn:SaveDraftRequest>
        <urn:SaveDraftResponse>
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
        </urn:SaveDraftResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SaveDraftEnvelope::class, 'xml'));
    }
}
