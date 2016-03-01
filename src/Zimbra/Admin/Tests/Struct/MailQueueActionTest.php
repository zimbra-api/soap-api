<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraAdminTestCase
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
        $action = new MailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame('requeue', $action->getOp()->value());
        $this->assertSame('id', $action->getBy()->value());

        $action->setQuery($query)
               ->setOp(QueueAction::HOLD())
               ->setBy(QueueActionBy::QUERY());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame('hold', $action->getOp()->value());
        $this->assertSame('query', $action->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                . '<query limit="' . $limit . '" offset="' . $offset . '">'
                    . '<field name="' . $name . '">'
                        . '<match value="' . $value . '" />'
                    . '</field>'
                . '</query>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = [
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
        ];
        $this->assertEquals($array, $action->toArray());
    }
}
