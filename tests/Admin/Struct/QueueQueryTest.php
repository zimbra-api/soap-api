<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueueQuery.
 */
class QueueQueryTest extends ZimbraTestCase
{
    public function testQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $match = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$match]);

        $query = new StubQueueQuery([$field], $limit, $offset);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields());

        $query = new StubQueueQuery();
        $query->setLimit($limit)
              ->setOffset($offset)
              ->addField($field);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields());

        $xml = <<<EOT
<?xml version="1.0"?>
<result limit="$limit" offset="$offset" xmlns:urn="urn:zimbraAdmin">
    <urn:field name="$name">
        <urn:match value="$value" />
    </urn:field>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($query, 'xml'));
        $this->assertEquals($query, $this->serializer->deserialize($xml, StubQueueQuery::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubQueueQuery extends QueueQuery
{
}
