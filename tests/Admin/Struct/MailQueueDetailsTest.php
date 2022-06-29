<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\MailQueueDetails;
use Zimbra\Admin\Struct\QueueSummary;
use Zimbra\Admin\Struct\QueueSummaryItem;
use Zimbra\Admin\Struct\QueueItem;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueDetails.
 */
class MailQueueDetailsTest extends ZimbraTestCase
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

        $queue = new StubMailQueueDetails($name, $scanTime, FALSE, $total, FALSE, [$qs], [$qi]);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($scanTime, $queue->getTime());
        $this->assertFalse($queue->getStillScanning());
        $this->assertSame($total, $queue->getTotal());
        $this->assertFalse($queue->getMore());
        $this->assertSame([$qs], $queue->getQueueSummaries());
        $this->assertSame([$qi], $queue->getQueueItems());

        $queue = new StubMailQueueDetails();
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
<result name="$name" time="$scanTime" scan="true" total="$total" more="true" xmlns:urn="urn:zimbraAdmin">
    <urn:qs type="$type">
        <urn:qsi n="$count" t="$term" />
    </urn:qs>
    <urn:qi id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, StubMailQueueDetails::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubMailQueueDetails extends MailQueueDetails
{
}
