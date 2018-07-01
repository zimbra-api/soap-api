<?php

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

        $match = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$match]);
        $query = new QueueQuery([$field], $limit, $offset);

        $action = new MailQueueAction($query, QueueAction::HOLD()->value(), QueueActionBy::QUERY()->value());
        $queue = new MailQueueWithAction($action, $name);

        $server = new ServerWithQueueAction($queue, $name);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $server = new ServerWithQueueAction(new MailQueueWithAction($action, $name), '');
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));

        $server = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ServerWithQueueAction', 'xml');
        $queue = $server->getQueue();
        $action = $queue->getAction();
        $query = $action->getQuery();
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame($name, $server->getName());
        $this->assertSame($name, $queue->getName());
        $this->assertSame(QueueAction::HOLD()->value(), $action->getOp());
        $this->assertSame(QueueActionBy::QUERY()->value(), $action->getBy());
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
