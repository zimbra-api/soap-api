<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ServerQueues;
use Zimbra\Admin\Struct\MailQueueCount;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServerQueues.
 */
class ServerQueuesTest extends ZimbraTestCase
{
    public function testServerQueues()
    {
        $count = mt_rand(1, 100);
        $name = $this->faker->word;

        $queue = new MailQueueCount($name, $count);

        $server = new StubServerQueues($name, [$queue]);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame([$queue], $server->getQueues());

        $server = new StubServerQueues();
        $server->setServerName($name)
            ->setQueues([$queue]);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame([$queue], $server->getQueues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:queue name="$name" n="$count" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, StubServerQueues::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubServerQueues extends ServerQueues
{
}
