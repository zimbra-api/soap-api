<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\AttributeName;

use Zimbra\Mail\Message\GetConvEnvelope;
use Zimbra\Mail\Message\GetConvBody;
use Zimbra\Mail\Message\GetConvRequest;
use Zimbra\Mail\Message\GetConvResponse;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ChatMessageInfo;
use Zimbra\Mail\Struct\ConversationInfo;
use Zimbra\Mail\Struct\ConversationSpec;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\MessageInfo;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetConv.
 */
class GetConvTest extends ZimbraTestCase
{
    public function testGetConv()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $inlineRule = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;

        $num = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $subject = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = ReplyType::REPLIED;
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->uuid;
        $draftAutoSendTime = $this->faker->randomNumber;
        $sentDate = $this->faker->randomNumber;
        $resentDate = $this->faker->randomNumber;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $messageIdHeader = $this->faker->word;
        $inReplyTo = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO;

        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $calItemType = InviteType::TASK;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

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
        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $chat = new ChatMessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );
        $msg = new MessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
        );

        $spec = new ConversationSpec(
            $id, $inlineRule, TRUE, $maxInlinedLength, TRUE, [new AttributeName($name)]
        );
        $info = new ConversationInfo(
            $id, $num, $totalSize, $flags, $tags, $tagNames, $subject, [$metadata], [$chat], [$msg]
        );

        $request = new GetConvRequest($spec);
        $this->assertSame($spec, $request->getConversation());
        $request = new GetConvRequest(new ConversationSpec());
        $request->setConversation($spec);
        $this->assertSame($spec, $request->getConversation());

        $response = new GetConvResponse($info);
        $this->assertSame($info, $response->getConversation());
        $response = new GetConvResponse();
        $response->setConversation($info);
        $this->assertSame($info, $response->getConversation());

        $body = new GetConvBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetConvBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetConvEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetConvEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetConvRequest>
            <urn:c id="$id" fetch="$inlineRule" html="true" max="$maxInlinedLength" needExp="true">
                <urn:header n="$name" />
            </urn:c>
        </urn:GetConvRequest>
        <urn:GetConvResponse>
            <urn:c id="$id" n="$num" total="$totalSize" f="$flags" t="$tags" tn="$tagNames">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:su>$subject</urn:su>
                <urn:chat id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part">
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
                </urn:chat>
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
            </urn:c>
        </urn:GetConvResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetConvEnvelope::class, 'xml'));
    }
}
