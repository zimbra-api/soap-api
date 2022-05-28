<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailQueueWithAction;
use Zimbra\Admin\Struct\MailQueueAction;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Common\Enum\QueueAction;
use Zimbra\Common\Enum\QueueActionBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueWithAction.
 */
class MailQueueWithActionTest extends ZimbraTestCase
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

        $queue = new MailQueueWithAction(new MailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID()), '');
        $queue->setAction($action)
              ->setName($name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $op = QueueAction::HOLD()->getValue();
        $by = QueueActionBy::QUERY()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">
    <action op="$op" by="$by">
        <query limit="$limit" offset="$offset">
            <field name="$name">
                <match value="$value" />
            </field>
        </query>
    </action>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, MailQueueWithAction::class, 'xml'));

        $json = json_encode([
            'action' => [
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
            ],
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($queue, 'json'));
        $this->assertEquals($queue, $this->serializer->deserialize($json, MailQueueWithAction::class, 'json'));
    }
}
