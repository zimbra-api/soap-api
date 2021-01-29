<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\MessageCommon;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessageCommon.
 */
class MessageCommonTest extends ZimbraTestCase
{
    public function testMessageCommon()
    {
        $size = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $folder = $this->faker->word;
        $conversationId = $this->faker->uuid;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $revision = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->unixTime;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);

        $msg = new MessageCommon(
            $size, $date, $folder, $conversationId, $flags, $tags, $tagNames, $revision, $changeDate, $modifiedSequence, [$metadata]
        );
        $this->assertSame($size, $msg->getSize());
        $this->assertSame($date, $msg->getDate());
        $this->assertSame($folder, $msg->getFolder());
        $this->assertSame($conversationId, $msg->getConversationId());
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($revision, $msg->getRevision());
        $this->assertSame($changeDate, $msg->getChangeDate());
        $this->assertSame($modifiedSequence, $msg->getModifiedSequence());
        $this->assertSame([$metadata], $msg->getMetadatas());

        $msg = new MessageCommon;
        $msg->setSize($size)
            ->setDate($date)
            ->setFolder($folder)
            ->setConversationId($conversationId)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setRevision($revision)
            ->setChangeDate($changeDate)
            ->setModifiedSequence($modifiedSequence)
            ->setMetadatas([$metadata])
            ->addMetadata($metadata);
        $this->assertSame($size, $msg->getSize());
        $this->assertSame($date, $msg->getDate());
        $this->assertSame($folder, $msg->getFolder());
        $this->assertSame($conversationId, $msg->getConversationId());
        $this->assertSame($flags, $msg->getFlags());
        $this->assertSame($tags, $msg->getTags());
        $this->assertSame($tagNames, $msg->getTagNames());
        $this->assertSame($revision, $msg->getRevision());
        $this->assertSame($changeDate, $msg->getChangeDate());
        $this->assertSame($modifiedSequence, $msg->getModifiedSequence());
        $this->assertSame([$metadata, $metadata], $msg->getMetadatas());
        $msg->setMetadatas([$metadata]);

        $xml = <<<EOT
<?xml version="1.0"?>
<msg s="$size" d="$date" l="$folder" cid="$conversationId" f="$flags" t="$tags" tn="$tagNames" rev="$revision" md="$changeDate" ms="$modifiedSequence">
    <meta section="$section">
        <a n="$key">$value</a>
    </meta>
</msg>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, MessageCommon::class, 'xml'));

        $json = json_encode([
            's' => $size,
            'd' => $date,
            'l' => $folder,
            'cid' => $conversationId,
            'f' => $flags,
            't' => $tags,
            'tn' => $tagNames,
            'rev' => $revision,
            'md' => $changeDate,
            'ms' => $modifiedSequence,
            'meta' => [
                [
                    'section' => $section,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($msg, 'json'));
        $this->assertEquals($msg, $this->serializer->deserialize($json, MessageCommon::class, 'json'));
    }
}
