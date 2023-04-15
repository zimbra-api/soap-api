<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Mail\Struct\NoteInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NoteInfo.
 */
class NoteInfoTest extends ZimbraTestCase
{
    public function testNoteInfo()
    {
        $id = $this->faker->uuid;
        $revision =  $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $bounds = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $changeDate =  $this->faker->unixTime;
        $modifiedSequence =  $this->faker->randomNumber;
        $content = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $note = new StubNoteInfo(
            $id,
            $revision,
            $folder,
            $date,
            $flags,
            $tags,
            $tagNames,
            $bounds,
            $color,
            $rgb,
            $changeDate,
            $modifiedSequence,
            $content,
            [$metadata]
        );
        $this->assertSame($id, $note->getId());
        $this->assertSame($revision, $note->getRevision());
        $this->assertSame($folder, $note->getFolder());
        $this->assertSame($date, $note->getDate());
        $this->assertSame($flags, $note->getFlags());
        $this->assertSame($tags, $note->getTags());
        $this->assertSame($tagNames, $note->getTagNames());
        $this->assertSame($bounds, $note->getBounds());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($rgb, $note->getRgb());
        $this->assertSame($changeDate, $note->getChangeDate());
        $this->assertSame($modifiedSequence, $note->getModifiedSequence());
        $this->assertSame($content, $note->getContent());
        $this->assertSame([$metadata], $note->getMetadatas());

        $note = new StubNoteInfo();
        $note->setId($id)
            ->setRevision($revision)
            ->setFolder($folder)
            ->setDate($date)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setBounds($bounds)
            ->setColor($color)
            ->setRgb($rgb)
            ->setChangeDate($changeDate)
            ->setModifiedSequence($modifiedSequence)
            ->setContent($content)
            ->setMetadatas([$metadata]);

        $this->assertSame($id, $note->getId());
        $this->assertSame($revision, $note->getRevision());
        $this->assertSame($folder, $note->getFolder());
        $this->assertSame($date, $note->getDate());
        $this->assertSame($flags, $note->getFlags());
        $this->assertSame($tags, $note->getTags());
        $this->assertSame($tagNames, $note->getTagNames());
        $this->assertSame($bounds, $note->getBounds());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($rgb, $note->getRgb());
        $this->assertSame($changeDate, $note->getChangeDate());
        $this->assertSame($modifiedSequence, $note->getModifiedSequence());
        $this->assertSame($content, $note->getContent());
        $this->assertSame([$metadata], $note->getMetadatas());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" rev="$revision" l="$folder" d="$date" f="$flags" t="$tags" tn="$tagNames" pos="$bounds" color="$color" rgb="$rgb" md="$changeDate" ms="$modifiedSequence" xmlns:urn="urn:zimbraMail">
    <urn:content>$content</urn:content>
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($note, 'xml'));
        $this->assertEquals($note, $this->serializer->deserialize($xml, StubNoteInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubNoteInfo extends NoteInfo
{
}
