<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\MessageHitInfo;
use Zimbra\Mail\Struct\Part;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessageHitInfo.
 */
class MessageHitInfoTest extends ZimbraTestCase
{
    public function testMessageHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;
        $part = $this->faker->word;

        $hp = new Part($part);
        $hit = new StubMessageHitInfo(
            $id, $sortField, FALSE, [$hp]
        );
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertFalse($hit->getContentMatched());
        $this->assertSame([$hp], $hit->getMessagePartHits());

        $hit = new StubMessageHitInfo();
        $hit->setSortField($sortField)
            ->setContentMatched(TRUE)
            ->setMessagePartHits([$hp]);
        $this->assertSame($sortField, $hit->getSortField());
        $this->assertTrue($hit->getContentMatched());
        $this->assertSame([$hp], $hit->getMessagePartHits());
        $hit = new StubMessageHitInfo(
            $id, $sortField, TRUE, [$hp]
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" cm="true" id="$id" xmlns:urn="urn:zimbraMail">
    <urn:hp part="$part" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, StubMessageHitInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubMessageHitInfo extends MessageHitInfo
{
}
