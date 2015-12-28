<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ServerMailQueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for ServerMailQueueQuery.
 */
class ServerMailQueueQueryTest extends ZimbraAdminTestCase
{
    public function testServerMailQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $queue = new MailQueueQuery($query, $name, true, $wait);

        $server = new ServerMailQueueQuery($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server->setServerName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server name="' . $name . '">'
                . '<queue name="' . $name . '" scan="true" wait="' . $wait . '">'
                    . '<query limit="' . $limit . '" offset="' . $offset . '">'
                        . '<field name="' . $name . '">'
                            . '<match value="' . $value . '" />'
                        . '</field>'
                    . '</query>'
                . '</queue>'
            . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'name' => $name,
                'queue' => [
                    'name' => $name,
                    'scan' => true,
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
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }
}
