<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ServerWithQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Enum\QueueAction;

/**
 * Testcase class for ServerWithQueueAction.
 */
class ServerWithQueueActionTest extends ZimbraAdminTestCase
{
    public function testServerWithQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);

        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new MailQueueWithAction($action, $name);

        $server = new ServerWithQueueAction($queue, $name);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $server->setName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server name="' . $name . '">'
                . '<queue name="' . $name . '">'
                    . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                        . '<query limit="' . $limit . '" offset="' . $offset . '">'
                            . '<field name="' . $name . '">'
                                . '<match value="' . $value . '" />'
                            . '</field>'
                        . '</query>'
                    . '</action>'
                . '</queue>'
            . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'name' => $name,
                'queue' => [
                    'name' => $name,
                    'action' => [
                        'op' => QueueAction::HOLD()->value(),
                        'by' => QueueActionBy::QUERY()->value(),
                        'query' => [
                            'limit' => $limit,
                            'offset' => $offset,
                            'field' => [
                                [
                                    'name' => $name,
                                    'match' => [
                                        [
                                            'value' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }
}
