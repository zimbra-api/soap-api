<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Enum\MsgContent;

use Zimbra\Common\Struct\AttributeName;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\UrlAndValue;

use Zimbra\Mail\Message\GetMsgEnvelope;
use Zimbra\Mail\Message\GetMsgBody;
use Zimbra\Mail\Message\GetMsgRequest;
use Zimbra\Mail\Message\GetMsgResponse;

use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponentWithGroupInfo;
use Zimbra\Mail\Struct\InviteWithGroupInfo;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\MsgWithGroupInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMsg.
 */
class GetMsgTest extends ZimbraTestCase
{
    public function testGetMsg()
    {
        $id = $this->faker->uuid;
        $recurIdZ = $this->faker->uuid;
        $name = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;
        $wantContent = MsgContent::FULL;

        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = ReplyType::REPLIED;
        $identityId = $this->faker->uuid;
        $draftAccountId = $this->faker->email;
        $draftAutoSendTime = $this->faker->unixTime;
        $sentDate = $this->faker->unixTime;
        $resentDate = $this->faker->unixTime;
        $part = $this->faker->word;
        $fragment = $this->faker->word;
        $subject = $this->faker->word;
        $messageIdHeader = $this->faker->uuid;
        $inReplyTo = $this->faker->uuid;
        $key = $this->faker->name;
        $value = $this->faker->word;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO;

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
        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $content = $this->faker->text;
        $contentId = $this->faker->uuid;
        $location = $this->faker->word;
        $url = $this->faker->url;

        $header = new AttributeName($name);
        $msgSpec = new MsgSpec(
            $id, $part, TRUE, TRUE, $maxInlinedLength, TRUE, TRUE, TRUE, TRUE, TRUE, $recurIdZ, TRUE, $wantContent, [$header]
        );
        $request = new GetMsgRequest($msgSpec);
        $this->assertSame($msgSpec, $request->getMsg());
        $request = new GetMsgRequest(new MsgSpec());
        $request->setMsg($msgSpec);
        $this->assertSame($msgSpec, $request->getMsg());

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new InviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $calendarReply = new CalendarReply($rangeType, $recurId, $seq, $date, $attendee);
        $email = new EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);
        $invite = new InviteWithGroupInfo(
            $calItemType, [$timezone], [$inviteComponent], [$calendarReply]
        );
        $header = new KeyValuePair($key, $value);
        $mimePart = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content
        );
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);
        $urlValue = new UrlAndValue($url, $value);
        $msgInfo = new MsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );
        $response = new GetMsgResponse($msgInfo);
        $this->assertSame($msgInfo, $response->getMsg());
        $response = new GetMsgResponse();
        $response->setMsg($msgInfo);
        $this->assertSame($msgInfo, $response->getMsg());

        $body = new GetMsgBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetMsgBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMsgEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetMsgEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMsgRequest>
            <urn:m id="$id" part="$part" raw="true" read="true" max="$maxInlinedLength" useContentUrl="true" html="true" wantImapUid="true" wantModSeq="true" neuter="true" ridZ="$recurIdZ" needExp="true" wantContent="full">
                <urn:header n="$name" />
            </urn:m>
        </urn:GetMsgRequest>
        <urn:GetMsgResponse>
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
                </urn:mp>
                <urn:shr truncated="true">
                    <urn:content>$content</urn:content>
                </urn:shr>
                <urn:dlSubs truncated="true">
                    <urn:content>$content</urn:content>
                </urn:dlSubs>
                <urn:content url="$url">$value</urn:content>
            </urn:m>
        </urn:GetMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMsgEnvelope::class, 'xml'));
    }
}
