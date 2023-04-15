<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\ReplyType;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Mail\Struct\Header;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\SaveDraftMsg;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SaveDraftMsg.
 */
class SaveDraftMsgTest extends ZimbraTestCase
{
    public function testSaveDraftMsg()
    {
        $id = $this->faker->word;
        $intId = $this->faker->randomNumber;
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

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO, $personal);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);

        $msg = new StubSaveDraftMsg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment, $intId, $draftAccountId, $tags, $tagNames, $rgb, $color, $autoSendTime
        );
        $this->assertSame($intId, $msg->getId());
        $this->assertSame($draftAccountId, $msg->getDraftAccountId());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($rgb, $msg->getRgb());
        $this->assertSame($color, $msg->getColor());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());

        $msg = new StubSaveDraftMsg(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment
        );
        $msg->setId($intId)
            ->setDraftAccountId($draftAccountId)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setRgb($rgb)
            ->setColor($color)
            ->setAutoSendTime($autoSendTime);
        $this->assertSame($intId, $msg->getId());
        $this->assertSame($draftAccountId, $msg->getDraftAccountId());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($rgb, $msg->getRgb());
        $this->assertSame($color, $msg->getColor());
        $this->assertSame($autoSendTime, $msg->getAutoSendTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags" id="$intId" forAcct="$draftAccountId" t="$tags" tn="$tagNames" rgb="$rgb" color="$color" autoSendTime="$autoSendTime" xmlns:urn="urn:zimbraMail">
    <urn:header name="$name">$value</urn:header>
    <urn:content>$content</urn:content>
    <urn:mp ct="$contentType" content="$content" ci="$contentId" />
    <urn:attach aid="$id" />
    <urn:inv method="$method" compNum="$componentNum" rsvp="true" />
    <urn:e a="$address" t="t" p="$personal" />
    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <urn:fr>$fragment</urn:fr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubSaveDraftMsg::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubSaveDraftMsg extends SaveDraftMsg
{
}
