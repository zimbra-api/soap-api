<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ServerWithQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Enum\QueueAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ServerWithQueueAction.
 */
class ServerWithQueueActionTest extends ZimbraStructTestCase
{
    public function testServerWithQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $query = new QueueQuery(
            [new QueueQueryField($name, [new ValueAttrib($value)])], $limit, $offset
        );
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new MailQueueWithAction($action, $name);

        $server = new ServerWithQueueAction($queue, $name);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $server = new ServerWithQueueAction(new MailQueueWithAction($action, $name), '');
        $server->setName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $xml = <<<EOT
<?xml version="1.0"?>
<server name="$name">
    <queue name="$name">
        <action op="hold" by="query">
            <query limit="$limit" offset="$offset">
                <field name="$name">
                    <match value="$value" />
                </field>
            </query>
        </action>
    </queue>
</server>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerWithQueueAction::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'queue' => [
                'name' => $name,
                'action' => [
                    'op' => 'hold',
                    'by' => 'query',
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerWithQueueAction::class, 'json'));
    }
}
