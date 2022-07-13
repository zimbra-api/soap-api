<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\MessagePartHitInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessagePartHitInfo.
 */
class MessagePartHitInfoTest extends ZimbraTestCase
{
    public function testMessagePartHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;
        $size = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $conversationId = $this->faker->randomNumber;
        $messageId = $this->faker->randomNumber;
        $contentType = $this->faker->mimeType;
        $contentName = $this->faker->word;
        $part = $this->faker->word;
        $subject = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO();
        $email = new EmailInfo($address, $display, $personal, $addressType, TRUE, TRUE);

        $hit = new StubMessagePartHitInfo(
            $id, $sortField, $size, $date, $conversationId, $messageId, $contentType, $contentName, $part, $email, $subject
        );
        $this->assertSame($id, $hit->getId());
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame($size, $hit->getSize());
        $this->assertSame($date, $hit->getDate());
        $this->assertSame($conversationId, $hit->getConversationId());
        $this->assertSame($messageId, $hit->getMessageId());
        $this->assertSame($contentType, $hit->getContentType());
        $this->assertSame($contentName, $hit->getContentName());
        $this->assertSame($part, $hit->getPart());
        $this->assertSame($email, $hit->getEmail());
        $this->assertSame($subject, $hit->getSubject());

        $hit = new StubMessagePartHitInfo();
        $hit->setId($id)
            ->setSortField($sortField)
            ->setSize($size)
            ->setDate($date)
            ->setConversationId($conversationId)
            ->setMessageId($messageId)
            ->setContentType($contentType)
            ->setContentName($contentName)
            ->setPart($part)
            ->setEmail($email)
            ->setSubject($subject);
        $this->assertSame($id, $hit->getId());
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame($size, $hit->getSize());
        $this->assertSame($date, $hit->getDate());
        $this->assertSame($conversationId, $hit->getConversationId());
        $this->assertSame($messageId, $hit->getMessageId());
        $this->assertSame($contentType, $hit->getContentType());
        $this->assertSame($contentName, $hit->getContentName());
        $this->assertSame($part, $hit->getPart());
        $this->assertSame($email, $hit->getEmail());
        $this->assertSame($subject, $hit->getSubject());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" sf="$sortField" s="$size" d="$date" cid="$conversationId" mid="$messageId" ct="$contentType" name="$contentName" part="$part" xmlns:urn="urn:zimbraMail">
    <urn:e a="$address" d="$display" p="$personal" t="t" isGroup="true" exp="true" />
    <urn:su>$subject</urn:su>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, StubMessagePartHitInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubMessagePartHitInfo extends MessagePartHitInfo
{
}
