<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\UrlAndValue;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponentWithGroupInfo;
use Zimbra\Mail\Struct\InviteWithGroupInfo;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\MsgWithGroupInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgWithGroupInfo.
 */
class MsgWithGroupInfoTest extends ZimbraTestCase
{
    public function testMsgWithGroupInfo()
    {
        $id = $this->faker->uuid;
        $imapUid = $this->faker->randomNumber;
        $calendarIntendedFor = $this->faker->word;
        $origId = $this->faker->uuid;
        $draftReplyType = ReplyType::REPLIED();
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
        $addressType = AddressType::TO();

        $calItemType = InviteType::TASK();
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
        $content = $this->faker->text;
        $contentId = $this->faker->uuid;
        $url = $this->faker->url;

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
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

        $msg = new StubMsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );
        $this->assertSame($id, $msg->getId());
        $this->assertSame($imapUid, $msg->getImapUid());
        $this->assertSame($calendarIntendedFor, $msg->getCalendarIntendedFor());
        $this->assertSame($origId, $msg->getOrigId());
        $this->assertSame($draftReplyType, $msg->getDraftReplyType());
        $this->assertSame($identityId, $msg->getIdentityId());
        $this->assertSame($draftAccountId, $msg->getDraftAccountId());
        $this->assertSame($draftAutoSendTime, $msg->getDraftAutoSendTime());
        $this->assertSame($sentDate, $msg->getSentDate());
        $this->assertSame($resentDate, $msg->getResentDate());
        $this->assertSame($part, $msg->getPart());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($inReplyTo, $msg->getInReplyTo());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header], $msg->getHeaders());
        $this->assertSame($mimePart, $msg->getMimePart());
        $this->assertSame($shr, $msg->getShareNotification());
        $this->assertSame($dlSubs, $msg->getDLSubscription());
        $this->assertSame($urlValue, $msg->getContent());

        $msg = new StubMsgWithGroupInfo();
        $msg->setId($id)
            ->setImapUid($imapUid)
            ->setCalendarIntendedFor($calendarIntendedFor)
            ->setOrigId($origId)
            ->setDraftReplyType($draftReplyType)
            ->setIdentityId($identityId)
            ->setDraftAccountId($draftAccountId)
            ->setDraftAutoSendTime($draftAutoSendTime)
            ->setSentDate($sentDate)
            ->setResentDate($resentDate)
            ->setPart($part)
            ->setFragment($fragment)
            ->setEmails([$email])
            ->setSubject($subject)
            ->setMessageIdHeader($messageIdHeader)
            ->setInReplyTo($inReplyTo)
            ->setInvite($invite)
            ->setHeaders([$header])
            ->setMimePart($mimePart)
            ->setShareNotification($shr)
            ->setDLSubscription($dlSubs)
            ->setContent($urlValue);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($imapUid, $msg->getImapUid());
        $this->assertSame($calendarIntendedFor, $msg->getCalendarIntendedFor());
        $this->assertSame($origId, $msg->getOrigId());
        $this->assertSame($draftReplyType, $msg->getDraftReplyType());
        $this->assertSame($identityId, $msg->getIdentityId());
        $this->assertSame($draftAccountId, $msg->getDraftAccountId());
        $this->assertSame($draftAutoSendTime, $msg->getDraftAutoSendTime());
        $this->assertSame($sentDate, $msg->getSentDate());
        $this->assertSame($resentDate, $msg->getResentDate());
        $this->assertSame($part, $msg->getPart());
        $this->assertSame($fragment, $msg->getFragment());
        $this->assertSame([$email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($inReplyTo, $msg->getInReplyTo());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header], $msg->getHeaders());
        $this->assertSame($mimePart, $msg->getMimePart());
        $this->assertSame($shr, $msg->getShareNotification());
        $this->assertSame($dlSubs, $msg->getDLSubscription());
        $this->assertSame($urlValue, $msg->getContent());
        $msg = new StubMsgWithGroupInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], $mimePart, $shr, $dlSubs, $urlValue
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" i4uid="$imapUid" cif="$calendarIntendedFor" origid="$origId" rt="r" idnt="$identityId" forAcct="$draftAccountId" autoSendTime="$draftAutoSendTime" sd="$sentDate" rd="$resentDate" part="$part" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubMsgWithGroupInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubMsgWithGroupInfo extends MsgWithGroupInfo
{
}
