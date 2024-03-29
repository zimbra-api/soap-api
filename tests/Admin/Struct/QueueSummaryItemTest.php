<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueueSummaryItem.
 */
class QueueSummaryItemTest extends ZimbraTestCase
{
    public function testQueueSummaryItem()
    {
        $count = mt_rand(1, 100);
        $term = $this->faker->word;

        $qsi = new QueueSummaryItem($count, $term);
        $this->assertSame($count, $qsi->getCount());
        $this->assertSame($term, $qsi->getTerm());

        $qsi = new QueueSummaryItem();
        $qsi->setTerm($term)
             ->setCount($count);
        $this->assertSame($count, $qsi->getCount());
        $this->assertSame($term, $qsi->getTerm());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$count" t="$term" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($qsi, 'xml'));
        $this->assertEquals($qsi, $this->serializer->deserialize($xml, QueueSummaryItem::class, 'xml'));
    }
}
