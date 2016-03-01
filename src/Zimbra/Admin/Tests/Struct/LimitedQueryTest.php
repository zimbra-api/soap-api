<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\LimitedQuery;

/**
 * Testcase class for LimitedQuery.
 */
class LimitedQueryTest extends ZimbraAdminTestCase
{
    public function testLimitedQuery()
    {
        $limit = mt_rand(0, 10);
        $value = $this->faker->word;

        $query = new LimitedQuery($limit, $value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $query->setLimit($limit);
        $this->assertSame($limit, $query->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '">' . $value . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = [
            'query' => [
                'limit' => $limit,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $query->toArray());
    }
}
