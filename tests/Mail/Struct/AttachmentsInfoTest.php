<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AttachmentsInfo;
use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Mail\Struct\MsgAttachSpec;
use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Mail\Struct\DocAttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttachmentsInfo.
 */
class AttachmentsInfoTest extends ZimbraTestCase
{
    public function testAttachmentsInfo()
    {
        $id = $this->faker->uuid;
        $attachmentId = $this->faker->uuid;
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;
        $path = $this->faker->word;
        $version = mt_rand(1, 100);

        $attachments = [
            new MimePartAttachSpec($messageId, $part, TRUE),
            new MsgAttachSpec($id, TRUE),
            new ContactAttachSpec($id, TRUE),
            new DocAttachSpec($path, $id, $version, TRUE),
        ];

        $attach = new AttachmentsInfo($attachmentId, $attachments);
        $this->assertSame($attachmentId, $attach->getAttachmentId());
        $this->assertEquals($attachments, $attach->getAttachments());

        $attach = new AttachmentsInfo();
        $attach->setAttachmentId($attachmentId)
               ->setAttachments($attachments);
        $this->assertSame($attachmentId, $attach->getAttachmentId());
        $this->assertEquals($attachments, $attach->getAttachments());

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$attachmentId">
    <mp mid="$messageId" part="$part" optional="true" />
    <m id="$id" optional="true" />
    <cn id="$id" optional="true" />
    <doc path="$path" id="$id" ver="$version" optional="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attach, 'xml'));
        $this->assertEquals($attach, $this->serializer->deserialize($xml, AttachmentsInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attach, 'json'));
        $this->assertEquals($attach, $this->serializer->deserialize($json, AttachmentsInfo::class, 'json'));
    }
}
