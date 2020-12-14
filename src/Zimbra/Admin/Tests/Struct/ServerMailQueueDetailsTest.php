<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ServerMailQueueDetails;
use Zimbra\Admin\Struct\MailQueueDetails;
use Zimbra\Admin\Struct\QueueSummary;
use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Admin\Struct\QueueItem;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ServerMailQueueDetails.
 */
class ServerMailQueueDetailsTest extends ZimbraStructTestCase
{
    public function testServerMailQueueDetails()
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
        $queue = new MailQueueDetails($name, $scanTime, TRUE, $total, TRUE, [$qs], [$qi]);

        $server = new ServerMailQueueDetails($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server = new ServerMailQueueDetails(new MailQueueDetails('', 0, FALSE, 0, FALSE), '');
        $server->setServerName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $xml = <<<EOT
<?xml version="1.0"?>
<server name="$name">
    <queue name="$name" time="$scanTime" scan="true" total="$total" more="true">
        <qs type="$type">
            <qsi n="$count" t="$term" />
        </qs>
        <qi id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
    </queue>
</server>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerMailQueueDetails::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'queue' => [
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerMailQueueDetails::class, 'json'));
    }
}
