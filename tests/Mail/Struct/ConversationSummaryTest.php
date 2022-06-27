<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $conv = new ConversationSummary(
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

        $conv = new ConversationSummary();
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
            ->addMetadata($metadata)
            ->setSubject($subject)
            ->setFragment($fragment)
            ->setEmails([$email])
            ->addEmail($email);
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
        $this->assertSame([$metadata, $metadata], $conv->getMetadatas());
        $this->assertSame($subject, $conv->getSubject());
        $this->assertSame($fragment, $conv->getFragment());
        $this->assertSame([$email, $email], $conv->getEmails());
        $conv = new ConversationSummary(
            $id, $num, $numUnread, $totalSize, $flags, $tags, $tagNames, $date, TRUE, $changeDate, $modifiedSequence, [$metadata], $subject, $fragment, [$email]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" n="$num" u="$numUnread" total="$totalSize" f="$flags" t="$tags" tn="$tagNames" d="$date" elided="true" md="$changeDate" ms="$modifiedSequence">
    <meta section="$section">
        <a n="$key">$value</a>
    </meta>
    <su>$subject</su>
    <fr>$fragment</fr>
    <e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conv, 'xml'));
        $this->assertEquals($conv, $this->serializer->deserialize($xml, ConversationSummary::class, 'xml'));
    }
}
