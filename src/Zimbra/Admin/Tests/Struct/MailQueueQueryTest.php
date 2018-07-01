<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\MailQueueQuery;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailQueueQuery.
 */
class MailQueueQueryTest extends ZimbraStructTestCase
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

        $queue = new MailQueueQuery(new QueueQuery(), '', false, 0);
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));

        $queue = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\MailQueueQuery', 'xml');
        $query = $queue->getQuery();
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame($name, $queue->getQueueName());
        $this->assertTrue($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
