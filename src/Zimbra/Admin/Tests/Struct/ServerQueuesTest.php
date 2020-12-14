<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ServerQueues;
use Zimbra\Admin\Struct\MailQueueCount;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ServerQueues.
 */
class ServerQueuesTest extends ZimbraStructTestCase
{
    public function testServerQueues()
    {
        $count = mt_rand(1, 100);
        $name = $this->faker->word;

        $queue = new MailQueueCount($name, $count);

        $server = new ServerQueues($name, [$queue]);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame([$queue], $server->getQueues());

        $server = new ServerQueues('');
        $server->setServerName($name)
            ->setQueues([$queue])
            ->addQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame([$queue, $queue], $server->getQueues());
        $server->setQueues([$queue]);

        $xml = <<<EOT
<?xml version="1.0"?>
<server name="$name">
    <queue name="$name" n="$count" />
</server>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerQueues::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'queue' => [
                [
                    'name' => $name,
                    'n' => $count,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerQueues::class, 'json'));
    }
}
