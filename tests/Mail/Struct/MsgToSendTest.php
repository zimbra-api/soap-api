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
use Zimbra\Mail\Struct\MsgToSend;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgToSend.
 */
class MsgToSendTest extends ZimbraTestCase
{
    public function testMsgToSend()
    {
        $id = $this->faker->word;
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
        $draftId = $this->faker->uuid;
        $dataSourceId = $this->faker->uuid;

        $header = new Header($name, $value);
        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $attachments = new AttachmentsInfo($id);
        $invite = new InvitationInfo($method, $componentNum, TRUE);
        $emailAddress = new EmailAddrInfo($address, AddressType::TO, $personal);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);

        $msg = new StubMsgToSend(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment, $draftId, FALSE, $dataSourceId
        );
        $this->assertSame($draftId, $msg->getDraftId());
        $this->assertFalse($msg->getSendFromDraft());
        $this->assertSame($dataSourceId, $msg->getDataSourceId());

        $msg = new StubMsgToSend(
            $id, $origId, $replyType, $identityId, $subject, [$header], $inReplyTo, $folderId, $flags, $content, $mimePart, $attachments, $invite, [$emailAddress], [$timezone], $fragment
        );
        $msg->setDraftId($draftId)
            ->setSendFromDraft(TRUE)
            ->setDataSourceId($dataSourceId);
        $this->assertSame($draftId, $msg->getDraftId());
        $this->assertTrue($msg->getSendFromDraft());
        $this->assertSame($dataSourceId, $msg->getDataSourceId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result did="$draftId" sfd="true" dsId="$dataSourceId" aid="$id" origid="$origId" rt="r" idnt="$identityId" su="$subject" irt="$inReplyTo" l="$folderId" f="$flags" xmlns:urn="urn:zimbraMail">
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
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubMsgToSend::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubMsgToSend extends MsgToSend
{
}
