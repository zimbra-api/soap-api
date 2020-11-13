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

        $match = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$match]);
        $query = new QueueQuery([$field], $limit, $offset);
        $queue = new MailQueueQuery($query, $name, true, $wait);

        $server = new ServerMailQueueQuery($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server = new ServerMailQueueQuery(new MailQueueQuery($query, ''), '');
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerMailQueueQuery::class, 'xml'));

        $json = json_encode([
            'queue' => [
                'query' => [
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
                    'limit' => $limit,
                    'offset' => $offset,
                ],
                'name' => $name,
                'scan' => TRUE,
                'wait' => $wait,
            ],
            'name' => $name,
        ]);
        $this->assertSame($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerMailQueueQuery::class, 'json'));
    }
}
