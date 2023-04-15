<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\RawInvite;

use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InvitationInfo.
 */
class InvitationInfoTest extends ZimbraTestCase
{
    public function testInvitationInfo()
    {
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $id = $this->faker->uuid;
        $contentType = $this->faker->mimeType;
        $contentId = $this->faker->uuid;
        $summary = $this->faker->text;
        $value = $this->faker->text;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $content = new RawInvite($id, $summary, $value);
        $inviteComponent = new InviteComponent($method, $componentNum, TRUE);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $mimePart = new MimePartInfo($contentType, $value, $contentId);
        $attachments = new AttachmentsInfo($id);

        $inv = new StubInvitationInfo($method, $componentNum, TRUE);
        $inv->setId($id)
            ->setContentType($contentType)
            ->setContentId($contentId)
            ->setContent($content)
            ->setInviteComponent($inviteComponent)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setMimeParts([$mimePart])
            ->addMimePart($mimePart)
            ->setAttachments($attachments);
        $this->assertSame($id, $inv->getId());
        $this->assertSame($contentType, $inv->getContentType());
        $this->assertSame($contentId, $inv->getContentId());
        $this->assertSame($content, $inv->getContent());
        $this->assertSame($inviteComponent, $inv->getInviteComponent());
        $this->assertSame([$timezone, $timezone], $inv->getTimezones());
        $this->assertSame([$mimePart, $mimePart], $inv->getMimeParts());
        $this->assertSame($attachments, $inv->getAttachments());
        $inv->setTimezones([$timezone])
            ->setMimeParts([$mimePart]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result method="$method" compNum="$componentNum" rsvp="true" id="$id" ct="$contentType" ci="$contentId" xmlns:urn="urn:zimbraMail">
    <urn:content uid="$id" summary="$summary">$value</urn:content>
    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <urn:mp ct="$contentType" content="$value" ci="$contentId" />
    <urn:attach aid="$id" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, StubInvitationInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubInvitationInfo extends InvitationInfo
{
}
