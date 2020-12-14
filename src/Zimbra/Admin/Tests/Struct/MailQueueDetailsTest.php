<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailQueueDetails;
use Zimbra\Admin\Struct\QueueSummary;
use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Admin\Struct\QueueItem;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailQueueDetails.
 */
class MailQueueDetailsTest extends ZimbraStructTestCase
{
    public function testMailQueueDetails()
    {
        $name = $this->faker->word;
        $scanTime = time();
        $total = mt_rand(1, 100);
        $id = $this->faker->word;
        $time = $this->faker->word;
        $fromdomain = $this->faker->word;
        $size = $this->faker->word;
        $from = $this->faker->word;
        $to = $this->faker->word;
        $host = $this->faker->word;
        $addr = $this->faker->word;
        $reason = $this->faker->word;
        $filter = $this->faker->word;
        $todomain = $this->faker->word;
        $received = $this->faker->word;

        $count = mt_rand(1, 100);
        $term = $this->faker->word;
        $type = $this->faker->word;

        $qs = new QueueSummary($type, [new QueueSummaryItem($count, $term)]);
        $qi = new QueueItem(
            $id, $time, $fromdomain, $size, $from, $to, $host, $addr, $reason, $filter, $todomain, $received
        );

        $queue = new MailQueueDetails($name, $scanTime, FALSE, $total, FALSE, [$qs], [$qi]);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($scanTime, $queue->getTime());
        $this->assertFalse($queue->getStillScanning());
        $this->assertSame($total, $queue->getTotal());
        $this->assertFalse($queue->getMore());
        $this->assertSame([$qs], $queue->getQueueSummaries());
        $this->assertSame([$qi], $queue->getQueueItems());

        $queue = new MailQueueDetails('', 0, FALSE, 0, FALSE);
        $queue->setName($name)
             ->setTime($scanTime)
             ->setStillScanning(TRUE)
             ->setTotal($total)
             ->setMore(TRUE)
             ->setQueueSummaries([$qs])
             ->addQueueSummary($qs)
             ->setQueueItems([$qi])
             ->addQueueItem($qi);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($scanTime, $queue->getTime());
        $this->assertTrue($queue->getStillScanning());
        $this->assertSame($total, $queue->getTotal());
        $this->assertTrue($queue->getMore());
        $this->assertSame([$qs, $qs], $queue->getQueueSummaries());
        $this->assertSame([$qi, $qi], $queue->getQueueItems());
        $queue->setQueueSummaries([$qs])
            ->setQueueItems([$qi]);

        $xml = <<<EOT
<?xml version="1.0"?>
<queue name="$name" time="$scanTime" scan="true" total="$total" more="true">
    <qs type="$type">
        <qsi n="$count" t="$term" />
    </qs>
    <qi id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
</queue>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, MailQueueDetails::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'time' => $scanTime,
            'scan' => TRUE,
            'total' => $total,
            'more' => TRUE,
            'qs' => [
                [
                    'type' => $type,
                    'qsi' => [
                        [
                            'n' => $count,
                            't' => $term,
                        ],
                    ],
                ],
            ],
            'qi' => [
                [
                    'id' => $id,
                    'time' => $time,
                    'fromdomain' => $fromdomain,
                    'size' => $size,
                    'from' => $from,
                    'to' => $to,
                    'host' => $host,
                    'addr' => $addr,
                    'reason' => $reason,
                    'filter' => $filter,
                    'todomain' => $todomain,
                    'received' => $received,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($queue, 'json'));
        $this->assertEquals($queue, $this->serializer->deserialize($json, MailQueueDetails::class, 'json'));
    }
}
