<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $queue = new StubMailQueueQuery($query, $name, FALSE, $wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertFalse($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $queue = new StubMailQueueQuery(new QueueQuery());
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
<result name="$name" scan="true" wait="$wait" xmlns:urn="urn:zimbraAdmin">
    <urn:query limit="$limit" offset="$offset">
        <urn:field name="$name">
            <urn:match value="$value" />
        </urn:field>
    </urn:query>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($queue, 'xml'));
        $this->assertEquals($queue, $this->serializer->deserialize($xml, StubMailQueueQuery::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubMailQueueQuery extends MailQueueQuery
{
}
