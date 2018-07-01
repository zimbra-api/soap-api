<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailQueueWithAction.
 */
class MailQueueWithActionTest extends ZimbraStructTestCase
{
    public function testMailQueueWithAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new MailQueueAction($query, QueueAction::HOLD()->value(), QueueActionBy::QUERY()->value());

        $queue = new MailQueueWithAction($action, $name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $queue = new MailQueueWithAction(new MailQueueAction($query, '', ''), '');
        $queue->setAction($action)
              ->setName($name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<queue name="' . $name . '">'
                . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                    . '<query limit="' . $limit . '" offset="' . $offset . '">'
                        . '<field name="' . $name . '">'
                            . '<match value="' . $value . '" />'
                        . '</field>'
                    . '</query>'
                . '</action>'
            . '</queue>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));

        $queue = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\MailQueueWithAction', 'xml');
        $action = $queue->getAction();
        $query = $action->getQuery();
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame($name, $queue->getName());
        $this->assertSame(QueueAction::HOLD()->value(), $action->getOp());
        $this->assertSame(QueueActionBy::QUERY()->value(), $action->getBy());
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
