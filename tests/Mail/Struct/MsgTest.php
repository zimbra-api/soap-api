<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Msg.
 */
class MsgTest extends ZimbraTestCase
{
    public function testMsg()
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
        $value = $this->faker->word;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO(), $personal);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);

        $msg = new Msg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment
        );
        $this->assertSame($id, $msg->getAttachmentId());
        $this->assertSame($origId, $msg->getOrigId());
        $this->assertSame($replyType, $msg->getReplyType());
        $this->assertSame($identityId, $msg->getIdentityId());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame([$header], $msg->getHeaders());
        $this->assertSame($inReplyTo, $msg->getInReplyTo());
        $this->assertSame($folderId, $msg->getFolderId());
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($content, $msg->getContent());
        $this->assertSame($mimePart, $msg->getMimePart());
        $this->assertSame($attachments, $msg->getAttachments());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$emailAddress], $msg->getEmailAddresses());
        $this->assertSame([$timezone], $msg->getTimezones());
        $this->assertSame($fragment, $msg->getFragment());

        $msg = new Msg();
        $msg->setAttachmentId($id)
            ->setOrigId($origId)
            ->setReplyType($replyType)
            ->setIdentityId($identityId)
            ->setSubject($subject)
            ->setHeaders([$header])
            ->addHeader($header)
            ->setInReplyTo($inReplyTo)
            ->setFolderId($folderId)
            ->setFlags($flags)
            ->setContent($content)
            ->setMimePart($mimePart)
            ->setAttachments($attachments)
            ->setInvite($invite)
            ->setEmailAddresses([$emailAddress])
            ->addEmailAddress($emailAddress)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setFragment($fragment);
        $this->assertSame($id, $msg->getAttachmentId());
        $this->assertSame($origId, $msg->getOrigId());
        $this->assertSame($replyType, $msg->getReplyType());
        $this->assertSame($identityId, $msg->getIdentityId());
        $this->assertSame($subject, $msg->getSubject());
        $this->assertSame([$header, $header], $msg->getHeaders());
        $this->assertSame($inReplyTo, $msg->getInReplyTo());
        $this->assertSame($folderId, $msg->getFolderId());
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($content, $msg->getContent());
        $this->assertSame($mimePart, $msg->getMimePart());
        $this->assertSame($attachments, $msg->getAttachments());
        $this->assertSame($invite, $msg->getInvite());
        $this->assertSame([$emailAddress, $emailAddress], $msg->getEmailAddresses());
        $this->assertSame([$timezone, $timezone], $msg->getTimezones());
        $this->assertSame($fragment, $msg->getFragment());
        $msg->setHeaders([$header])
            ->setEmailAddresses([$emailAddress])
            ->setTimezones([$timezone]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags">
    <header name="$name">$value</header>
    <content>$content</content>
    <mp ct="$contentType" content="$content" ci="$contentId" />
    <attach aid="$id" />
    <inv method="$method" compNum="$componentNum" rsvp="true" />
    <e a="$address" t="t" p="$personal" />
    <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <fr>$fragment</fr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, Msg::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($msg, 'json'));
        $this->assertEquals($msg, $this->serializer->deserialize($json, Msg::class, 'json'));
    }
}
