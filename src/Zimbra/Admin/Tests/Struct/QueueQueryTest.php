<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for QueueQuery.
 */
class QueueQueryTest extends ZimbraStructTestCase
{
    public function testQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $match = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$match]);

        $query = new QueueQuery([$field], $limit, $offset);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields());

        $query = new QueueQuery();
        $query->setLimit($limit)
              ->setOffset($offset)
              ->addField($field);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '" offset="' . $offset . '">'
                . '<field name="' . $name . '">'
                    . '<match value="' . $value . '" />'
                . '</field>'
            . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($query, 'xml'));

        $query = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\QueueQuery', 'xml');
        $field = $query->getFields()[0];
        $match = $field->getMatches()[0];

        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame($name, $field->getName());
        $this->assertSame($value, $match->getValue());
    }
}
