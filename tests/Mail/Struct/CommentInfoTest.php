<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Mail\Struct\CommentInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommentInfo.
 */
class CommentInfoTest extends ZimbraTestCase
{
    public function testCommentInfo()
    {
        $parentId = $this->faker->uuid;
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $creatorEmail = $this->faker->email;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $comment = new StubCommentInfo(
            $parentId,
            $id,
            $uuid,
            $creatorEmail,
            $flags,
            $tags,
            $tagNames,
            $color,
            $rgb,
            $date,
            [$metadata]
        );
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($id, $comment->getId());
        $this->assertSame($uuid, $comment->getUuid());
        $this->assertSame($creatorEmail, $comment->getCreatorEmail());
        $this->assertSame($flags, $comment->getFlags());
        $this->assertSame($tags, $comment->getTags());
        $this->assertSame($tagNames, $comment->getTagNames());
        $this->assertSame($color, $comment->getColor());
        $this->assertSame($rgb, $comment->getRgb());
        $this->assertSame($date, $comment->getDate());
        $this->assertSame([$metadata], $comment->getMetadatas());

        $comment = new StubCommentInfo();
        $comment->setId($id)
            ->setUuid($uuid)
            ->setDate($date)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setParentId($parentId)
            ->setColor($color)
            ->setRgb($rgb)
            ->setCreatorEmail($creatorEmail)
            ->setMetadatas([$metadata]);

        $this->assertSame($id, $comment->getId());
        $this->assertSame($uuid, $comment->getUuid());
        $this->assertSame($date, $comment->getDate());
        $this->assertSame($flags, $comment->getFlags());
        $this->assertSame($tags, $comment->getTags());
        $this->assertSame($tagNames, $comment->getTagNames());
        $this->assertSame($parentId, $comment->getParentId());
        $this->assertSame($color, $comment->getColor());
        $this->assertSame($rgb, $comment->getRgb());
        $this->assertSame($creatorEmail, $comment->getCreatorEmail());
        $this->assertSame([$metadata], $comment->getMetadatas());

        $xml = <<<EOT
<?xml version="1.0"?>
<result parentId="$parentId" id="$id" uuid="$uuid" email="$creatorEmail" f="$flags" t="$tags" tn="$tagNames" color="$color" rgb="$rgb" d="$date" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($comment, 'xml'));
        $this->assertEquals($comment, $this->serializer->deserialize($xml, StubCommentInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubCommentInfo extends CommentInfo
{
}
