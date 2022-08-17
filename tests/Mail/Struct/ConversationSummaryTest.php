<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Struct\ConversationSummary;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConversationSummary.
 */
class ConversationSummaryTest extends ZimbraTestCase
{
    public function testConversationSummary()
    {
        $id = $this->faker->uuid;
        $num = $this->faker->randomNumber;
        $numUnread = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->name;
        $tagNames = $this->faker->name;
        $date = $this->faker->unixTime;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->unixTime;
        $subject = $this->faker->word;
        $fragment = $this->faker->word;

        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO();

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $email = new EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);

        $conv = new StubConversationSummary(
            $id, $num, $numUnread, $totalSize, $flags, $tags, $tagNames, $date, FALSE, $changeDate, $modifiedSequence, [$metadata], $subject, $fragment, [$email]
        );
        $this->assertSame($id, $conv->getId());
        $this->assertSame($num, $conv->getNum());
        $this->assertSame($numUnread, $conv->getNumUnread());
        $this->assertSame($totalSize, $conv->getTotalSize());
        $this->assertSame($flags, $conv->getFlags());
        $this->assertSame($tags, $conv->getTags());
        $this->assertSame($tagNames, $conv->getTagNames());
        $this->assertSame($date, $conv->getDate());
        $this->assertFalse($conv->getElided());
        $this->assertSame($changeDate, $conv->getChangeDate());
        $this->assertSame($modifiedSequence, $conv->getModifiedSequence());
        $this->assertSame([$metadata], $conv->getMetadatas());
        $this->assertSame($subject, $conv->getSubject());
        $this->assertSame($fragment, $conv->getFragment());
        $this->assertSame([$email], $conv->getEmails());

        $conv = new StubConversationSummary();
        $conv->setId($id)
            ->setNum($num)
            ->setNumUnread($numUnread)
            ->setTotalSize($totalSize)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setDate($date)
            ->setElided(TRUE)
            ->setChangeDate($changeDate)
            ->setModifiedSequence($modifiedSequence)
            ->setMetadatas([$metadata])
            ->setSubject($subject)
            ->setFragment($fragment)
            ->setEmails([$email]);
        $this->assertSame($id, $conv->getId());
        $this->assertSame($num, $conv->getNum());
        $this->assertSame($numUnread, $conv->getNumUnread());
        $this->assertSame($totalSize, $conv->getTotalSize());
        $this->assertSame($flags, $conv->getFlags());
        $this->assertSame($tags, $conv->getTags());
        $this->assertSame($tagNames, $conv->getTagNames());
        $this->assertSame($date, $conv->getDate());
        $this->assertTrue($conv->getElided());
        $this->assertSame($changeDate, $conv->getChangeDate());
        $this->assertSame($modifiedSequence, $conv->getModifiedSequence());
        $this->assertSame([$metadata], $conv->getMetadatas());
        $this->assertSame($subject, $conv->getSubject());
        $this->assertSame($fragment, $conv->getFragment());
        $this->assertSame([$email], $conv->getEmails());
        $conv = new StubConversationSummary(
            $id, $num, $numUnread, $totalSize, $flags, $tags, $tagNames, $date, TRUE, $changeDate, $modifiedSequence, [$metadata], $subject, $fragment, [$email]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" n="$num" u="$numUnread" total="$totalSize" f="$flags" t="$tags" tn="$tagNames" d="$date" elided="true" md="$changeDate" ms="$modifiedSequence" xmlns:urn="urn:zimbraMail">
    <urn:meta section="$section">
        <urn:a n="$key">$value</urn:a>
    </urn:meta>
    <urn:su>$subject</urn:su>
    <urn:fr>$fragment</urn:fr>
    <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conv, 'xml'));
        $this->assertEquals($conv, $this->serializer->deserialize($xml, StubConversationSummary::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubConversationSummary extends ConversationSummary
{
}
