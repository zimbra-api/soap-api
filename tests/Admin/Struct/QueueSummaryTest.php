<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $qs = new QueueSummary($type, [$qsi]);
        $this->assertSame($type, $qs->getType());
        $this->assertSame([$qsi], $qs->getItems());

        $qs = new QueueSummary('');
        $qs->setType($type)
            ->setItems([$qsi])
            ->addItem($qsi);
        $this->assertSame($type, $qs->getType());
        $this->assertSame([$qsi, $qsi], $qs->getItems());
        $qs->setItems([$qsi]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type">
    <qsi n="$count" t="$term" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($qs, 'xml'));
        $this->assertEquals($qs, $this->serializer->deserialize($xml, QueueSummary::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'qsi' => [
                [
                    'n' => $count,
                    't' => $term,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($qs, 'json'));
        $this->assertEquals($qs, $this->serializer->deserialize($json, QueueSummary::class, 'json'));
    }
}
