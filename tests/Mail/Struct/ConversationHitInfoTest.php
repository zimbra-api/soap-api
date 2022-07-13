<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\ConversationHitInfo;
use Zimbra\Mail\Struct\ConversationMsgHitInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConversationHitInfo.
 */
class ConversationHitInfoTest extends ZimbraTestCase
{
    public function testConversationHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;
        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $autoSendTime = $this->faker->unixTime;
        $date = $this->faker->unixTime;

        $msgHit = new ConversationMsgHitInfo(
            $id, $size, $folderId, $flags, $autoSendTime, $date
        );
        $hit = new StubConversationHitInfo(
            $id, $sortField, [$msgHit]
        );
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame([$msgHit], $hit->getMessageHits());

        $hit = new StubConversationHitInfo($id);
        $hit->setSortField($sortField)
            ->setMessageHits([$msgHit])
            ->addMessageHit($msgHit);
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertSame([$msgHit, $msgHit], $hit->getMessageHits());
        $hit->setMessageHits([$msgHit]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" id="$id" xmlns:urn="urn:zimbraMail">
    <urn:m id="$id" s="$size" l="$folderId" f="$flags" autoSendTime="$autoSendTime" d="$date" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, StubConversationHitInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubConversationHitInfo extends ConversationHitInfo
{
}
