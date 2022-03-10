<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\QueueItem;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueueItem.
 */
class QueueItemTest extends ZimbraTestCase
{
    public function testQueueItem()
    {
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

        $qi = new QueueItem(
            $id, $time, $fromdomain, $size, $from, $to, $host, $addr, $reason, $filter, $todomain, $received
        );
        $this->assertSame($id, $qi->getId());
        $this->assertSame($time, $qi->getTime());
        $this->assertSame($fromdomain, $qi->getFromdomain());
        $this->assertSame($size, $qi->getSize());
        $this->assertSame($from, $qi->getFrom());
        $this->assertSame($to, $qi->getTo());
        $this->assertSame($host, $qi->getHost());
        $this->assertSame($addr, $qi->getAddr());
        $this->assertSame($reason, $qi->getReason());
        $this->assertSame($filter, $qi->getFilter());
        $this->assertSame($todomain, $qi->getTodomain());
        $this->assertSame($received, $qi->getReceived());

        $qi = new QueueItem(
            '', '', '', '', '', '', '', '', '', '', '', ''
        );
        $qi->setId($id)
            ->setTime($time)
            ->setFromdomain($fromdomain)
            ->setSize($size)
            ->setFrom($from)
            ->setTo($to)
            ->setHost($host)
            ->setAddr($addr)
            ->setReason($reason)
            ->setFilter($filter)
            ->setTodomain($todomain)
            ->setReceived($received);
        $this->assertSame($id, $qi->getId());
        $this->assertSame($time, $qi->getTime());
        $this->assertSame($fromdomain, $qi->getFromdomain());
        $this->assertSame($size, $qi->getSize());
        $this->assertSame($from, $qi->getFrom());
        $this->assertSame($to, $qi->getTo());
        $this->assertSame($host, $qi->getHost());
        $this->assertSame($addr, $qi->getAddr());
        $this->assertSame($reason, $qi->getReason());
        $this->assertSame($filter, $qi->getFilter());
        $this->assertSame($todomain, $qi->getTodomain());
        $this->assertSame($received, $qi->getReceived());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($qi, 'xml'));
        $this->assertEquals($qi, $this->serializer->deserialize($xml, QueueItem::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($qi, 'json'));
        $this->assertEquals($qi, $this->serializer->deserialize($json, QueueItem::class, 'json'));
    }
}
