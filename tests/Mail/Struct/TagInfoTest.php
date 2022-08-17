<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\Type;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TagInfo.
 */
class TagInfoTest extends ZimbraTestCase
{
    public function testTagInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $unread = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revision = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->randomNumber;

        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );

        $tag = new StubTagInfo(
            $id,
            $name,
            $color,
            $rgb,
            $unread,
            $count,
            $date,
            $revision,
            $changeDate,
            $modifiedSequence,
            [$metadata],
            $retentionPolicy
        );
        $this->assertSame($id, $tag->getId());
        $this->assertSame($name, $tag->getName());
        $this->assertSame($color, $tag->getColor());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($unread, $tag->getUnread());
        $this->assertSame($count, $tag->getCount());
        $this->assertSame($date, $tag->getDate());
        $this->assertSame($revision, $tag->getRevision());
        $this->assertSame($changeDate, $tag->getChangeDate());
        $this->assertSame($modifiedSequence, $tag->getModifiedSequence());
        $this->assertSame([$metadata], $tag->getMetadatas());
        $this->assertSame($retentionPolicy, $tag->getRetentionPolicy());

        $tag = new StubTagInfo();
        $tag->setId($id)
            ->setName($name)
            ->setColor($color)
            ->setRgb($rgb)
            ->setUnread($unread)
            ->setCount($count)
            ->setDate($date)
            ->setRevision($revision)
            ->setChangeDate($changeDate)
            ->setModifiedSequence($modifiedSequence)
            ->setMetadatas([$metadata])
            ->setRetentionPolicy($retentionPolicy);

        $this->assertSame($id, $tag->getId());
        $this->assertSame($name, $tag->getName());
        $this->assertSame($color, $tag->getColor());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($unread, $tag->getUnread());
        $this->assertSame($count, $tag->getCount());
        $this->assertSame($date, $tag->getDate());
        $this->assertSame($revision, $tag->getRevision());
        $this->assertSame($changeDate, $tag->getChangeDate());
        $this->assertSame($modifiedSequence, $tag->getModifiedSequence());
        $this->assertSame([$metadata], $tag->getMetadatas());
        $this->assertSame($retentionPolicy, $tag->getRetentionPolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" color="$color" rgb="$rgb" u="$unread" n="$count" d="$date" rev="$revision" md="$changeDate" ms="$modifiedSequence" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
    <urn:retentionPolicy>
        <urn:keep>
            <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:keep>
        <urn:purge>
            <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
        </urn:purge>
    </urn:retentionPolicy>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tag, 'xml'));
        $this->assertEquals($tag, $this->serializer->deserialize($xml, StubTagInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubTagInfo extends TagInfo
{
}
