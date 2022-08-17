<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\QueueSummary;
use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueueSummary.
 */
class QueueSummaryTest extends ZimbraTestCase
{
    public function testQueueSummary()
    {
        $count = mt_rand(1, 100);
        $term = $this->faker->word;
        $type = $this->faker->word;

        $qsi = new QueueSummaryItem($count, $term);

        $qs = new StubQueueSummary($type, [$qsi]);
        $this->assertSame($type, $qs->getType());
        $this->assertSame([$qsi], $qs->getItems());

        $qs = new StubQueueSummary();
        $qs->setType($type)
            ->setItems([$qsi])
            ->addItem($qsi);
        $this->assertSame($type, $qs->getType());
        $this->assertSame([$qsi, $qsi], $qs->getItems());
        $qs->setItems([$qsi]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" xmlns:urn="urn:zimbraAdmin">
    <urn:qsi n="$count" t="$term" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($qs, 'xml'));
        $this->assertEquals($qs, $this->serializer->deserialize($xml, StubQueueSummary::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubQueueSummary extends QueueSummary
{
}
