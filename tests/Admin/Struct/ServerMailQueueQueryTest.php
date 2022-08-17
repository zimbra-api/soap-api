<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ServerMailQueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServerMailQueueQuery.
 */
class ServerMailQueueQueryTest extends ZimbraTestCase
{
    public function testServerMailQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $query = new QueueQuery(
            [new QueueQueryField($name, [new ValueAttrib($value)])],
            $limit,
            $offset
        );
        $queue = new MailQueueQuery($query, $name, TRUE, $wait);

        $server = new StubServerMailQueueQuery($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server = new StubServerMailQueueQuery(new MailQueueQuery($query));
        $server->setServerName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:queue name="$name" scan="true" wait="$wait">
        <urn:query limit="$limit" offset="$offset">
            <urn:field name="$name">
                <urn:match value="$value" />
            </urn:field>
        </urn:query>
    </urn:queue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, StubServerMailQueueQuery::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubServerMailQueueQuery extends ServerMailQueueQuery
{
}
