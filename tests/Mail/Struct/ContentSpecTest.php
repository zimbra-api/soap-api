<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ContentSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContentSpec.
 */
class ContentSpecTest extends ZimbraTestCase
{
    public function testContentSpec()
    {
        $attachmentId = $this->faker->word;
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;
        $text = $this->faker->text;

        $content = new ContentSpec($attachmentId, $messageId, $part, $text);
        $this->assertSame($attachmentId, $content->getAttachmentId());
        $this->assertSame($messageId, $content->getMessageId());
        $this->assertSame($part, $content->getPart());
        $this->assertSame($text, $content->getText());

        $content = new ContentSpec();
        $content->setAttachmentId($attachmentId)
            ->setMessageId($messageId)
            ->setPart($part)
            ->setText($text);
        $this->assertSame($attachmentId, $content->getAttachmentId());
        $this->assertSame($messageId, $content->getMessageId());
        $this->assertSame($part, $content->getPart());
        $this->assertSame($text, $content->getText());

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$attachmentId" mid="$messageId" part="$part">$text</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, ContentSpec::class, 'xml'));
    }
}
