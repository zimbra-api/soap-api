<?php

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

        $server = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ServerMailQueueQuery', 'xml');
        $queue = $server->getQueue();
        $query = $queue->getQuery();
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame($name, $server->getServerName());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertTrue($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
