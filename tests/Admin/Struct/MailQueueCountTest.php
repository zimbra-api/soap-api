<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailQueueCount;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueCount.
 */
class MailQueueCountTest extends ZimbraTestCase
{
    public function testMailQueueCount()
    {
        $name = $this->faker->word;
        $count = mt_rand(1, 100);

        $queue = new MailQueueCount($name, $count);
        $this->assertSame($count, $queue->getCount());
        $this->assertSame($name, $queue->getName());

        $queue = new MailQueueCount('', 0);
        $queue->setName($name)
             ->setCount($count);
        $this->assertSame($count, $queue->getCount());
        $this->assertSame($name, $queue->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" n="$count" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, MailQueueCount::class, 'xml'));
    }
}
