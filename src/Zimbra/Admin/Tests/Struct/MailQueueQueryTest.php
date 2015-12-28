<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for MailQueueQuery.
 */
class MailQueueQueryTest extends ZimbraAdminTestCase
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

        $queue = new MailQueueQuery($query, $name, false, $wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertFalse($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $queue->setQuery($query)
              ->setQueueName($name)
              ->setScan(true)
              ->setWaitSeconds($wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertTrue($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<queue name="' . $name . '" scan="true" wait="' . $wait . '">'
                . '<query limit="' . $limit . '" offset="' . $offset . '">'
                    . '<field name="' . $name . '">'
                        . '<match value="' . $value . '" />'
                    . '</field>'
                . '</query>'
            . '</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = [
            'queue' => [
                'name' => $name,
                'scan' => true,
                'wait' => $wait,
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
        $this->assertEquals($array, $queue->toArray());
    }
}
