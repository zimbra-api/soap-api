<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for QueueSummaryItem.
 */
class QueueSummaryItemTest extends ZimbraStructTestCase
{
    public function testQueueSummaryItem()
    {
        $count = mt_rand(1, 100);
        $term = $this->faker->word;

        $qsi = new QueueSummaryItem($count, $term);
        $this->assertSame($count, $qsi->getCount());
        $this->assertSame($term, $qsi->getTerm());

        $qsi = new QueueSummaryItem(0, '');
        $qsi->setTerm($term)
             ->setCount($count);
        $this->assertSame($count, $qsi->getCount());
        $this->assertSame($term, $qsi->getTerm());

        $xml = <<<EOT
<?xml version="1.0"?>
<qsi n="$count" t="$term" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($qsi, 'xml'));
        $this->assertEquals($qsi, $this->serializer->deserialize($xml, QueueSummaryItem::class, 'xml'));

        $json = json_encode([
            'n' => $count,
            't' => $term,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($qsi, 'json'));
        $this->assertEquals($qsi, $this->serializer->deserialize($json, QueueSummaryItem::class, 'json'));
    }
}
