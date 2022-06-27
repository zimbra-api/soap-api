<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddMsgSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddMsgSpec.
 */
class AddMsgSpecTest extends ZimbraTestCase
{
    public function testAddMsgSpec()
    {
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $folder = $this->faker->word;
        $dateReceived = time();
        $attachmentId = $this->faker->uuid;
        $content = $this->faker->text;

        $msg = new AddMsgSpec($flags, $tags, $tagNames, $folder, FALSE, $dateReceived, $attachmentId, $content);
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($folder, $msg->getFolder());
        $this->assertFalse($msg->getNoICal());
        $this->assertSame($dateReceived, $msg->getDateReceived());
        $this->assertSame($attachmentId, $msg->getAttachmentId());
        $this->assertSame($content, $msg->getContent());

        $msg = new AddMsgSpec();
        $msg->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setFolder($folder)
            ->setNoICal(TRUE)
            ->setDateReceived($dateReceived)
            ->setAttachmentId($attachmentId)
            ->setContent($content);
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($folder, $msg->getFolder());
        $this->assertTrue($msg->getNoICal());
        $this->assertSame($dateReceived, $msg->getDateReceived());
        $this->assertSame($attachmentId, $msg->getAttachmentId());
        $this->assertSame($content, $msg->getContent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result f="$flags" t="$tags" tn="$tagNames" l="$folder" noICal="true" d="$dateReceived" aid="$attachmentId">
    <content>$content</content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, AddMsgSpec::class, 'xml'));
    }
}
