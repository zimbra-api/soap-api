<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ServerMailQueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ServerMailQueueQuery.
 */
class ServerMailQueueQueryTest extends ZimbraStructTestCase
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
        $queue = new MailQueueQuery($query, $name, true, $wait);

        $server = new ServerMailQueueQuery($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server = new ServerMailQueueQuery(new MailQueueQuery($query, ''), '');
        $server->setServerName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $xml = <<<EOT
<?xml version="1.0"?>
<server name="$name">
    <queue name="$name" scan="true" wait="$wait">
        <query limit="$limit" offset="$offset">
            <field name="$name">
                <match value="$value" />
            </field>
        </query>
    </queue>
</server>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerMailQueueQuery::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'queue' => [
                'name' => $name,
                'scan' => TRUE,
                'wait' => $wait,
                'query' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    'field' => [
                        [
                            'name' => $name,
                            'match' => [
                                [
                                    'value' => $value
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerMailQueueQuery::class, 'json'));
    }
}
