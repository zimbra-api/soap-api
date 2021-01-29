<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailQueueQuery.
 */
class MailQueueQueryTest extends ZimbraTestCase
{
    public function testMailQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$attr]);
        $query = new QueueQuery([$field], $limit, $offset);

        $queue = new MailQueueQuery($query, $name, FALSE, $wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertFalse($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $queue = new MailQueueQuery(new QueueQuery(), '', FALSE, 0);
        $queue->setQuery($query)
              ->setQueueName($name)
              ->setScan(TRUE)
              ->setWaitSeconds($wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertTrue($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $xml = <<<EOT
<?xml version="1.0"?>
<queue name="$name" scan="true" wait="$wait">
    <query limit="$limit" offset="$offset">
        <field name="$name">
            <match value="$value" />
        </field>
    </query>
</queue>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, MailQueueQuery::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($queue, 'json'));
        $this->assertEquals($queue, $this->serializer->deserialize($json, MailQueueQuery::class, 'json'));
    }
}
