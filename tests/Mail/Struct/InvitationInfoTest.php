<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponent;
use Zimbra\Mail\Struct\InvitationInfo;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Mail\Struct\RawInvite;

use Zimbra\Struct\TzOnsetInfo;
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

        $inv = new InvitationInfo($method, $componentNum, TRUE);
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
<inv method="$method" compNum="$componentNum" rsvp="true" id="$id" ct="$contentType" ci="$contentId">
    <content uid="$id" summary="$summary">$value</content>
    <comp method="$method" compNum="$componentNum" rsvp="true" />
    <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <mp ct="$contentType" content="$value" ci="$contentId" />
    <attach aid="$id" />
</inv>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, InvitationInfo::class, 'xml'));

        $json = json_encode([
            'method' => $method,
            'compNum' => $componentNum,
            'rsvp' => TRUE,
            'id' => $id,
            'ct' => $contentType,
            'ci' => $contentId,
            'content' => [
                'uid' => $id,
                'summary' => $summary,
                '_content' => $value,
            ],
            'comp' => [
                'method' => $method,
                'compNum' => $componentNum,
                'rsvp' => TRUE,
            ],
            'tz' => [
                [
                    'id' => $id,
                    'stdoff' => $tzStdOffset,
                    'dayoff' => $tzDayOffset,
                ],
            ],
            'mp' => [
                [
                    'ct' => $contentType,
                    'content' => $value,
                    'ci' => $contentId,
                ],
            ],
            'attach' => [
                'aid' => $id,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($inv, 'json'));
        $this->assertEquals($inv, $this->serializer->deserialize($json, InvitationInfo::class, 'json'));
    }
}
