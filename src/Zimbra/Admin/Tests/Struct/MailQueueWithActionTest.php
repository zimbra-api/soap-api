<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;

/**
 * Testcase class for MailQueueWithAction.
 */
class MailQueueWithActionTest extends ZimbraAdminTestCase
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
        $action = new MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());

        $queue = new MailQueueWithAction($action, $name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

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
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = [
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
                                        'value' => $value
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $queue->toArray());
    }
}
