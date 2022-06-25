<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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
        $mp = new MimePartInfo($contentType, $content, $contentId, $attachments, [$mimePart]);
        $this->assertSame($contentType, $mp->getContentType());
        $this->assertSame($content, $mp->getContent());
        $this->assertSame($contentId, $mp->getContentId());
        $this->assertSame($attachments, $mp->getAttachments());
        $this->assertSame([$mimePart], $mp->getMimeParts());

        $mp = new MimePartInfo();
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
<result ct="$contentType" content="$content" ci="$contentId">
    <mp ct="$contentType" content="$content" ci="$contentId" />
    <attach aid="$attachmentId">
        <mp mid="$messageId" part="$part" optional="true" />
        <m id="$id" optional="true" />
        <cn id="$id" optional="true" />
        <doc path="$path" id="$id" ver="$version" optional="true" />
    </attach>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mp, 'xml'));
        $this->assertEquals($mp, $this->serializer->deserialize($xml, MimePartInfo::class, 'xml'));

        $json = json_encode([
            'ct' => $contentType,
            'content' => $content,
            'ci' => $contentId,
            'mp' => [
                [
                    'ct' => $contentType,
                    'content' => $content,
                    'ci' => $contentId,
                ],
            ],
            'attach' => [
                'aid' => $attachmentId,
                'mp' => [
                    [
                        'mid' => $messageId,
                        'part' => $part,
                        'optional' => TRUE,
                    ],
                ],
                'm' => [
                    [
                        'id' => $id,
                        'optional' => TRUE,
                    ],
                ],
                'cn' => [
                    [
                        'id' => $id,
                        'optional' => TRUE,
                    ],
                ],
                'doc' => [
                    [
                        'path' => $path,
                        'id' => $id,
                        'ver' => $version,
                        'optional' => TRUE,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mp, 'json'));
        $this->assertEquals($mp, $this->serializer->deserialize($json, MimePartInfo::class, 'json'));
    }
}
