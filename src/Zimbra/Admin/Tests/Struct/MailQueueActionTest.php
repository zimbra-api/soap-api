<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraStructTestCase
{
    public function testMailQueueAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);
        $action = new MailQueueAction($query, QueueAction::REQUEUE()->value(), QueueActionBy::ID()->value());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame(QueueAction::REQUEUE()->value(), $action->getOp());
        $this->assertSame(QueueActionBy::ID()->value(), $action->getBy());

        $action = new MailQueueAction(new QueueQuery(), '', '');
        $action->setQuery($query)
               ->setOp(QueueAction::HOLD()->value())
               ->setBy(QueueActionBy::QUERY()->value());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame(QueueAction::HOLD()->value(), $action->getOp());
        $this->assertSame(QueueActionBy::QUERY()->value(), $action->getBy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                . '<query limit="' . $limit . '" offset="' . $offset . '">'
                    . '<field name="' . $name . '">'
                        . '<match value="' . $value . '" />'
                    . '</field>'
                . '</query>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));

        $action = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\MailQueueAction', 'xml');
        $query = $action->getQuery();
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame(QueueAction::HOLD()->value(), $action->getOp());
        $this->assertSame(QueueActionBy::QUERY()->value(), $action->getBy());
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
