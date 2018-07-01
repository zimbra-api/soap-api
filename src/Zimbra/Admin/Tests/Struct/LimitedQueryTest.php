<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for LimitedQuery.
 */
class LimitedQueryTest extends ZimbraStructTestCase
{
    public function testLimitedQuery()
    {
        $limit = mt_rand(0, 10);
        $value = $this->faker->word;

        $query = new LimitedQuery($limit, $value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $query = new LimitedQuery();
        $query->setLimit($limit)
              ->setValue($value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '">' . $value . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($query, 'xml'));

        $query = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\LimitedQuery', 'xml');
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());
    }
}
