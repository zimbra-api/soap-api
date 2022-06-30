<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Enum\ReplyType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\MessageInfo;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessageInfo.
 */
class MessageInfoTest extends ZimbraTestCase
{
    public function testMessageInfo()
    {
        $id = $this->faker->uuid;
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

        $msg = new StubMessageInfo(
            $id, $imapUid, $calendarIntendedFor, $origId, $draftReplyType, $identityId, $draftAccountId, $draftAutoSendTime, $sentDate, $resentDate, $part, $fragment, [$email], $subject, $messageIdHeader, $inReplyTo, $invite, [$header], [$mp], [$shr], [$dlSubs]
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
        $this->assertSame([$mp], $msg->getPartInfos());
        $this->assertSame([$shr], $msg->getShareNotifications());
        $this->assertSame([$dlSubs], $msg->getDlSubs());

        $msg = new StubMessageInfo();
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
            ->addEmail($email)
            ->setSubject($subject)
            ->setMessageIdHeader($messageIdHeader)
            ->setInReplyTo($inReplyTo)
            ->setInvite($invite)
            ->setHeaders([$header])
            ->addHeader($header)
            ->setPartInfos([$mp])
            ->addPartInfo($mp)
            ->setShareNotifications([$shr])
            ->addShareNotification($shr)
            ->setDlSubs([$dlSubs])
            ->addDlSub($dlSubs);
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
        $this->assertSame([$email, $email], $msg->getEmails());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame($messageIdHeader, $msg->getMessageIdHeader());
        $this->assertSame($inReplyTo, $msg->getInReplyTo());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$header, $header], $msg->getHeaders());
        $this->assertSame([$mp, $mp], $msg->getPartInfos());
        $this->assertSame([$shr, $shr], $msg->getShareNotifications());
        $this->assertSame([$dlSubs, $dlSubs], $msg->getDlSubs());
        $msg->setEmails([$email])
            ->setHeaders([$header])
            ->setPartInfos([$mp])
            ->setShareNotifications([$shr])
            ->setDlSubs([$dlSubs]);

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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubMessageInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubMessageInfo extends MessageInfo
{
}
