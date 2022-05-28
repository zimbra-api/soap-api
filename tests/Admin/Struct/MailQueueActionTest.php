<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueAction;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueAction.
 */
class MailQueueActionTest extends ZimbraTestCase
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
        $this->assertEquals(QueueAction::REQUEUE(), $action->getOp());
        $this->assertEquals(QueueActionBy::ID(), $action->getBy());

        $action = new MailQueueAction(new QueueQuery(), QueueAction::REQUEUE(), QueueActionBy::ID());
        $action->setQuery($query)
               ->setOp(QueueAction::HOLD())
               ->setBy(QueueActionBy::QUERY());

        $this->assertSame($query, $action->getQuery());
        $this->assertEquals(QueueAction::HOLD(), $action->getOp());
        $this->assertEquals(QueueActionBy::QUERY(), $action->getBy());

        $op = QueueAction::HOLD()->getValue();
        $by = QueueActionBy::QUERY()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result op="$op" by="$by">
    <query limit="$limit" offset="$offset">
        <field name="$name">
            <match value="$value" />
        </field>
    </query>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, MailQueueAction::class, 'xml'));

        $json = json_encode([
            'op' => $op,
            'by' => $by,
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, MailQueueAction::class, 'json'));
    }
}
