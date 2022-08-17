<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Mail\Struct\MsgAttachSpec;
use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Mail\Struct\DocAttachSpec;
use Zimbra\Mail\Struct\MimePartInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MimePartInfo.
 */
class MimePartInfoTest extends ZimbraTestCase
{
    public function testMimePartInfo()
    {
        $id = $this->faker->uuid;
        $attachmentId = $this->faker->uuid;
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;
        $path = $this->faker->word;
        $version = mt_rand(1, 100);
        $contentType = $this->faker->word;
        $content = $this->faker->text;
        $contentId = $this->faker->uuid;

        $attachments = new AttachmentsInfo($attachmentId, [
            new MimePartAttachSpec($messageId, $part, TRUE),
            new MsgAttachSpec($id, TRUE),
            new ContactAttachSpec($id, TRUE),
            new DocAttachSpec($path, $id, $version, TRUE),
        ]);

        $mimePart = new MimePartInfo($contentType, $content, $contentId);
        $mp = new StubMimePartInfo($contentType, $content, $contentId, $attachments, [$mimePart]);
        $this->assertSame($contentType, $mp->getContentType());
        $this->assertSame($content, $mp->getContent());
        $this->assertSame($contentId, $mp->getContentId());
        $this->assertSame($attachments, $mp->getAttachments());
        $this->assertSame([$mimePart], $mp->getMimeParts());

        $mp = new StubMimePartInfo();
        $mp->setContentType($contentType)
            ->setContent($content)
            ->setContentId($contentId)
            ->setAttachments($attachments)
            ->setMimeParts([$mimePart])
            ->addMimePart($mimePart);
        $this->assertSame($contentType, $mp->getContentType());
        $this->assertSame($content, $mp->getContent());
        $this->assertSame($contentId, $mp->getContentId());
        $this->assertSame($attachments, $mp->getAttachments());
        $this->assertSame([$mimePart, $mimePart], $mp->getMimeParts());
        $mp->setMimeParts([$mimePart]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result ct="$contentType" content="$content" ci="$contentId" xmlns:urn="urn:zimbraMail">
    <urn:mp ct="$contentType" content="$content" ci="$contentId" />
    <urn:attach aid="$attachmentId">
        <urn:mp mid="$messageId" part="$part" optional="true" />
        <urn:m id="$id" optional="true" />
        <urn:cn id="$id" optional="true" />
        <urn:doc path="$path" id="$id" ver="$version" optional="true" />
    </urn:attach>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mp, 'xml'));
        $this->assertEquals($mp, $this->serializer->deserialize($xml, StubMimePartInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubMimePartInfo extends MimePartInfo
{
}
